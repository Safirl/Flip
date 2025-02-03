@vite(['resources/css/account.css'])

<x-layouts.base-with-nav title="Profil">
    <div class="section-user-profile">
        <div class="user-profile">
            <div class="title-user-profile">
                <h1>MON COMPTE</h1>
                @guest()
                    <p>
                        Vous n’êtes pas connecté
                    </p>
                @endguest
                @auth()
                    <p>{{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
                    <p>Votre code ami : <strong>{{ \Illuminate\Support\Facades\Auth::user()->friend_id }}</strong></p>
                @endauth
            </div>
            <div class="disconnect-btn-container">
                @auth()

            </div>
            @can('doAdminActions')
                <div>

                    <form action="{{ route('admin.index') }}" method="get">
                        @csrf
                        <x-button
                            size="small"
                            type="submit"
                            color="primary"
                            label="Voir tous les polls"
                            expand="true"
                            kind="clear"
                        />
                    </form>
                </div>
                <div>
                    <form action="{{ route('admin.create.poll') }}" method="get">
                        @csrf
                        <x-button
                            size="small"
                            type="submit"
                            color="primary"
                            label="Créer un poll"
                            expand="true"
                            kind="clear"
                        />
                    </form>
                </div>
            @endif
            @endauth
            <div class="friend-container">
                @auth
                    <div class="card user-card">
                        <div class="card-body">
                            <p>Rechercher un ami pour voir ses votes et voir ses commentaires</p>
                            <form action="{{ route('addFriend') }}" method="post" enctype="multipart/form-data"
                                  class="add-friend-form">
                                @csrf
                                <div class="contenaire-form">
                                    <label for="friend_id"><p><strong>Saisissez le code ami</strong></p></label>
                                    <input type="text" class="form-control" id="friend_id" name="friend_id">
                                    @error("friend_id") <span class="text-error">{{ $message }}</span> @enderror
                                </div>
                                <x-button
                                    size="large"
                                    color="primary"
                                    label="Valider"
                                    expand="true"
                                />
                            </form>
                        </div>
                    </div>
                    {{--Show friends--}}
                    <div class="flex">
                        <p class="friends-p"><strong>Vos amis </strong>({{count($friends)}}) :</p>
                        @foreach($friends as $friend)
                            <div class="friend-card card">
                                <div class="friend-content">
                                    <p style="font-weight: normal">{{ $friend->name }}</p>
                                    <p style="font-weight: lighter; font-size: 10px">{{ $friend->friend_id }}</p>
                                    <div class="decoration-contenaire-friend"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endauth
                @guest
                    <div class="card delete-btn">
                        <p class="card-account-text">
                            Vous souhaitez partager l’expérience avec vos proches ? Créez-vous un compte pour partager
                            votre
                            code ami.
                        </p>
                        <form action="{{route('auth.login')}}" method="get">
                            @csrf
                            <x-button
                                size="large"
                                color="primary"
                                label="Connexion / Inscription"
                                expand="true"
                            />
                        </form>
                    </div>
                @endguest
            </div>
        </div>
        <div class="end-link">
            <x-link color="secondary"
                    size="medium"
                    expand="true"
                    noPadding=true
                    url='mentionslegales'
                    label="Voir les mentions légales">
            </x-link>
            @auth
                <form action="{{ route('auth.logout') }}" method="post">
                    @method("delete")
                    @csrf
                    <x-button
                        size="small"
                        type="submit"
                        color="secondary"
                        label="Se déconnecter"
                        expand="true"
                        kind="clear"

                    />
                </form>
                <div class="delete-btn">
                    <form class="disconnect-btn"
                          action="{{ route('auth.destroy', \Illuminate\Support\Facades\Auth::user()) }}" method="post">
                        @method("delete")
                        @csrf
                        <x-button
                            kind="clear"
                            type="submit"
                            size="small"
                            color="secondary"
                            label="Supprimer le compte"
                            expand="true"
                        />
                    </form>
                </div>
        </div>
        @endauth
    </div>
</x-layouts.base-with-nav>
