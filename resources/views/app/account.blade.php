@extends('base')

@section('title', 'profil')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endsection
@section('content')
    <div class="section-user-profile">
        <div class="user-profile">
            <div>
                <i class="icon fa-solid fa-user"></i>
            </div>
            @guest()
                <p>
                    Vous n’êtes pas connecté
                </p>
            @endguest
            @auth()
                <p>{{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
                <p>Votre code ami : <strong>{{ \Illuminate\Support\Facades\Auth::user()->friend_id }}</strong></p>
                <div class="disconnect-btn-container">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <form class="disconnect-btn" action="{{ route('auth.logout') }}" method="post">
                        @method("delete")
                        @csrf
                        <button class="btn-disconnect">Se déconnecter</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>

    <div class="friend-container">
        @auth
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('addFriend') }}" method="post" enctype="multipart/form-data"
                          class="add-friend-form">
                        @csrf
                        <div>
                            <label for="friend_id">Saisissez le code ami</label>
                            <input type="text" class="form-control" id="friend_id" name="friend_id">
                            @error("friend_id") <span class="text-error">{{ $message }}</span> @enderror
                        </div>
                        <x-button
                            size="small"
                            color="primary"
                            label="Valider"
                        />
                    </form>
                </div>
            </div>
            {{--            Show friends--}}
            <div>
                <p><strong>Vos amis </strong>({{count($friends)}}) :</p>
                @foreach($friends as $friend)
                    <div class="friend-card card">
                        <i class="icon fa-solid fa-user"></i>
                        <p>{{ $friend->name }}</p>
                    </div>
                @endforeach
            </div>
            <div>
                <form action="{{ route('auth.destroy', \Illuminate\Support\Facades\Auth::user()) }}" method="post">
                    @method("delete")
                    @csrf
                    <button type="submit" class="btn btn-danger">Supprimer le compte</button>
                </form>
            </div>
        @endauth
        @guest
            <div class="card">
                <p class="card-account-text">
                    Vous souhaitez partager l’expérience avec vos proches ? Créez-vous un compte pour partager votre
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
    <x-nav-bar/>
@endsection
