@extends('base')

@section('title', 'profil')

@section('content')
    <h1>Votre profil</h1>
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
            <a href="{{ route('auth.login') }}">Se connecter</a>
        @endguest
    </div>
    <x-nav-bar/>
@endsection
