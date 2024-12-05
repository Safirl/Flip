@extends('base')

@section('title', 'Commentaires')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/comments.css') }}">
@endsection

@section('content')
    <div>
        {{--        Mettre les infos liées à la carte bref on les retrouve depuis poll --}}
    </div>
    <div class="back-bar">
        <form action="{{ url()->previous() }}"
              method="get">
            <x-button
                size="large"
                color="primary"
                outlined="true"
                label=""
                iconEnd="fa-solid fa-arrow-left"
                classes="btn-back"
            />
        </form>
        <div class="bulb @if($poll->isIntox) intox-bulb @else info-bulb @endif ">
            <i class="fa-solid fa-lightbulb"></i>
            <h1 style="">
                @if($poll->isIntox)
                    INTOX
                @else
                    INFO
                @endif
            </h1>
        </div>
    </div>
    <form action="{{route('addComment', ['poll' => $poll])}}" method="post" class="vstack gap-3">
        @csrf
        <input type="hidden" name="parent_id" value="{{ null }}">
        <div class="form-group">
            <label for="comment">Commentaire :</label>
            <input type="text" class="form-control" id="comment" name="content" value= {{ old('content') }}>
            @error("content") <span class="text-error">{{ $message }}</span> @enderror
        </div>
        <button class="btn btn-primary">Ajouter le commentaire</button>
    </form>

    <div class="container-comments">
        Commentaires :
        @foreach($friends_comments as $comment)
            <div class="comment">
                <p><strong>{{ $comment->user->name ?? 'Utilisateur inconnu' }}</strong> :</p>
                <p>{{ $comment->content }}</p>
                <button>Voir la discussion</button>
                <form action="{{route('addComment', ['poll' => $poll])}}" method="post" class="vstack gap-3">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <div class="form-group">
                        <label for="comment">Répondre :</label>
                        <input type="text" class="form-control" id="comment" name="content" value= {{ old('content') }}>
                        @error("content") <span class="text-error">{{ $message }}</span> @enderror
                    </div>
                    <button class="btn btn-primary">Répondre au commentaire</button>
                </form>
            </div>
            <div class="answers">
                @foreach($comment->replies()->get() as $reply)
                    <p><strong>{{ $reply->user->name ?? 'Utilisateur inconnu' }}</strong> :</p>
                    <p>{{ $reply->content }}</p>
                @endforeach
            </div>
        @endforeach
    </div>
    <x-nav-bar/>
@endsection
