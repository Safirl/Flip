@vite(['resources/css/auth.scss'])

<x-layouts.base title="Inscription">
    <h1>Inscription</h1>

    <form action="{{route('auth.register.create')}}" method="post">
        @csrf

        <div>
            <label for="name">Pseudo</label>
            <input type="name" name="name" id="name" required value="{{ old('name') }}">
            @error("name")
            <p class="text-error">{{ $message }}</p>
            @enderror
        </div>

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
            <p class="hint">Minimum 8 caractères</p>
            @error("password")
            <p class="text-error">{{ $message }}</p>
            @enderror
        </div>

        <button>
            Inscription
        </button>
    </form>

    <nav>
        <p>
            En vous créant un compte vous acceptez les <a href="{{ route('mentionslegales') }}">Conditions Générales d’Utilisation</a>
        </p>

        <a href="{{route('auth.login')}}">
            Connexion
        </a>

        <a href="{{route('polls')}}">
            Continuer sans compte
            
            <img src="{{ asset('images/icons/chevron-right.svg') }}" alt=""/>
        </a>
    </nav>
</x-layouts.base>
