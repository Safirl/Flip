@extends('base')

@section('title', 'profil')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endsection
@section('content')
        <div class="section-user-profile">
            <div class="user-profile">
                <div>
                    <i class="icon fa-solid fa-user">
                    </i>
                </div>
                <p>
                    Vous n’êtes pas connecté
                </p>
            </div>
        </div>

        <div class="">
            @auth
                {{ \Illuminate\Support\Facades\Auth::user()->name }}
                <form class="" action="{{ route('auth.logout') }}" method="post">
                    @method("delete")
                    @csrf
                    <button class="">Se déconnecter</button>
                </form>
                <div>Votre code ami : {{ \Illuminate\Support\Facades\Auth::user()->friend_id }}</div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('addFriend') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="friend_id">Ajouter un ami</label>
                                <input type="text" class="form-control" id="friend_id" name="friend_id">
                                @error("friend_id") <span class="text-error">{{ $message }}</span> @enderror
                            </div>
                            <button class="btn btn-primary">
                                Add friend
                            </button>
                        </form>
                    </div>
                </div>
                {{--            Show friends--}}
                <div>
                    @foreach($friends as $friend)
                        <div>
                            {{ $friend->name }}
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
