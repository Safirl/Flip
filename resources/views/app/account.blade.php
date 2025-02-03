@vite(['resources/css/account.scss'])

<x-layouts.base-with-nav title="Mon compte">
    <header>
        <h1>Mon compte</h1>

        @isset($user)
            <p>{{ $user->name }}</p>
            <p>Votre code ami : <strong>{{ $user->friend_id }}</strong></p>

            <form action="{{ route('auth.logout') }}" method="post">
                @method("delete")
                @csrf
                <button>Me déconnecter</button>
            </form>
        @else
            <p>
                Vous n’êtes pas connecté
            </p>
        @endif
    </header>

    @can('do-admin-actions')
        <div class="admin-actions">
            <h2>Actions admin</h2>

            <a href="{{ route('admin.index') }}">
                Voir tous les polls
            </a>

            <a href="{{ route('admin.create.poll') }}">
                Créer un poll
            </a>
        </div>
    @endif

    @isset($user)
        <section>
            <p>Ajoutez un ami pour voir ses votes et voir ses commentaires</p>
            <form action="{{ route('addFriend') }}" method="post">
                @csrf

                <div>
                    <label for="friend_id">Saisissez un code ami</label>
                    <input type="text" id="friend_id" name="friend_id">
                    @error("friend_id")
                    <p class="text-error">{{ $message }}</p>
                    @enderror
                </div>

                <button>Valider</button>
            </form>
        </section>

        <section class="friends">
            <h2>Vos amis ({{ count($friends) }}) :</h2>
            <ul>
                @forelse($friends as $friend)
                    <li>
                        <p>{{ $friend->name }}</p>
                        <p>Code ami: #{{ $friend->friend_id }}</p>
                    </li>
                @empty
                    <li>
                        <p>Vous n'avez pas ajouté d'ami</p>
                        <p>Ajoutez des amis via leur code !</p>
                    </li>
                @endforelse

            </ul>
        </section>
    @else
        <section>
            <p>
                Vous souhaitez partager l’expérience avec vos proches ?
                Créez-vous un compte pour partager votre code ami.
            </p>

            <a href="{{route('auth.login')}}">
                Connexion / Inscription
            </a>
        </section>
    @endif

    <nav>
        <a href="{{route('mentionslegales')}}">
            Mentions Légales
        </a>

        @isset($user)
            <form
                action="{{ route('auth.destroy', $user) }}"
                method="post"
            >
                @method("delete")
                @csrf

                <button>
                    Supprimer le compte
                </button>
            </form>
        @endif
    </nav>
</x-layouts.base-with-nav>
