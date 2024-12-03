@extends('base')


@section('title', 'profil')

@section('content')
    <h1> Votre profil</h1>
    <div class="">
        @auth
            {{ \Illuminate\Support\Facades\Auth::user()->name }}
            <form class="" action="{{ route('auth.logout') }}" method="post">
                @method("delete")
                @csrf
                <button class="">Se déconnecter</button>
            </form>
            <div>Votre code ami : {{ \Illuminate\Support\Facades\Auth::user()->getAuthIdentifier() }}</div>
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="friend">Ajouter un ami</label>
                            <input type="number" class="form-control" id="friend">
                        </div>
                        <button class="btn btn-primary">
                            Add friend
                        </button>
                    </form>
                </div>
            </div>
            {{--Show friends--}}
{{--            <div>--}}
{{--                @foreach($friends as $friend)--}}
{{--                    <article>--}}
{{--                        <h2>{{ $post->title }}</h2>--}}
{{--                        <p class="small"> @if($post->category)--}}
{{--                                Category : {{ $post->category?->name }}--}}
{{--                            @endif</p>--}}
{{--                        <p class="small">--}}
{{--                            @if(!$post->tags->isEmpty())--}}
{{--                                , Tags :--}}
{{--                                @foreach($post->tags as $tag)--}}
{{--                                    {{ $tag->name }}--}}
{{--                                @endforeach--}}
{{--                            @endif--}}

{{--                        </p>--}}
{{--                        <p>{{ $post->content }}</p>--}}
{{--                        <p>--}}
{{--                            <a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id] ) }}"--}}
{{--                               class="btn btn-primary">Lire la suite</a>--}}
{{--                        </p>--}}
{{--                    </article>--}}
{{--                @endforeach--}}
{{--            </div>--}}
        @endauth
        @guest
            <a href="{{ route('auth.login') }}">Se connecter</a>
        @endguest
    </div>

@endsection
