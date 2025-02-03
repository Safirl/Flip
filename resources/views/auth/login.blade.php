@vite(['resources/css/auth.scss'])

<x-layouts.base title="Connexion">
    <h1>Connexion</h1>

    <form action="{{route('auth.login')}}" method="post">
        @csrf
        <div>
            <label for="email">Adresse E-Mail</label>
            <input type="email" name="email" id="email" required value="{{ old('email') }}">
            @error("email")
            <p class="text-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
            @error("password")
            <p class="text-error">{{ $message }}</p>
            @enderror
        </div>

        {{--        TODO(arthaud-proust): ajouter quand il y aura page mot de passe oublié --}}
        {{--        <a href="{{route('auth.register.show')}}">--}}
        {{--            Mot de passe oublie--}}
        {{--        </a>--}}

        <button>
            Connexion
        </button>
    </form>

    <nav>
        <p>Inscrivez-vous pour voir les votes de vos amis</p>

        <a href="{{route('auth.register.show')}}">
            Inscription
        </a>

        <a href="{{route('polls')}}">
            Continuer sans compte

            <img src="{{ asset('images/icons/chevron-right.svg') }}" alt=""/>
        </a>
    </nav>
</x-layouts.base>
