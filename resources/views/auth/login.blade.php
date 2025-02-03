@vite(['resources/css/login.css'])

<x-layouts.base title="Login">
    <h1>Se connecter</h1>
    <div class="container-auth">
        <div class="auth">
            <form action="{{route('auth.login')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value= {{ old('email') }}>
                    @error("email") <span class="text-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error("password") <span class="text-error">{{ $message }}</span> @enderror
                </div>
                <x-button
                    size="large"
                    color="primary"
                    kind="fill"
                    label="Connexion"
                    expand="true"
                    iconEnd="fa-solid fa-chevron-right"
                />
            </form>
            <div class="text-center">
                <p>Inscris toi pour pouvoir voir les votes de tes amis</p>
                <form action="{{route('auth.register.show')}}" method="get">
                    @csrf
                    <x-button
                        size="large"
                        color="primary"
                        kind="outlined"
                        label="Inscription"
                        expand="true"
                    />
                </form>
                <x-link color="primary"
                        size="medium"
                        url='polls'
                        label="Continuer sans compte"
                        iconEnd="fa-solid fa-chevron-right">
                </x-link>
            </div>
        </div>
    </div>
</x-layouts.base>
