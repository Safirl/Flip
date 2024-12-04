@extends('base')
@section('title', 'Login')
@section('content')
    <h1>Se connecter</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{route('auth.login')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value= {{ old('email') }}>
                    @error("email") {{ $message }} @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error("password") {{ $message }} @enderror
                </div>
                <x-button
                    size="large"
                    color="primary"
                    kind="fill"
                    label="Connexion"
                    expand="true"
                    iconEnd="fa-regular fa-chevron-left"
                />
            </form>
        </div>
        <div class="card-body">
            <p>Inscris toi pour pouvoir voir les votes de tes amis</p>
            <form action="{{route('auth.register.show')}}" method="get">
                @csrf
                <x-button
                    size="large"
                    color="primary"
                    outlined="true"
                    label="Inscription"
                    expand="true"
                />
            </form>
        </div>
    </div>

@endsection
