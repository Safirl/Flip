@extends('base')
@section('title', 'Login')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection
@section('content')

    <h1>Créer un compte</h1>

        <form action="{{route('auth.register.create')}}" method="post" class="vstack gap-3">
            @csrf
            <div class="container-auth">
            <div class="auth">
                <div>
                    <div class="form-group">
                        <label for="name">Pseudo</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        @error("name") <span class="text-error">{{ $message }}</span> @enderror
                    </div>

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
                </div>

                <div>
                    <div class="text-center">
                        <span class="text">En vous inscrivant vous acceptez les</span>
                        <x-link color="primary"
                                size="medium"
                                noPadding=true
                                url='auth.register.show'
                                label="Conditions Générales d'Utilisation">
                        </x-link>
                        <x-button
                            size="large"
                            color="primary"
                            label="M'inscrire et me connecter"
                            expand="true"
                            iconEnd="fa-solid fa-chevron-right"
                        />
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
