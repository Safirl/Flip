@extends('base')

@section('title', 'Commentaires')

@section('content')
    <div>
        {{--        Mettre les infos liées à la carte bref on les retrouve depuis poll --}}
    </div>
    <div>
        C'est une @if($poll->isIntox)
            info
        @else
            intox
        @endif
    </div>
    <form action="{{route('addComment', ['poll' => $poll])}}" method="post" class="vstack gap-3">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $parent_id ?? null }}">
        <div class="form-group">
            <label for="comment">Commentaire :</label>
            <input type="text" class="form-control" id="comment" name="content" value= {{ old('content') }}>
            @error("content") {{ $message }} @enderror
        </div>
        <button class="btn btn-primary">Ajouter le commentaire</button>
    </form>
    <div class="container-comments">
        Commentaires :
        @foreach($comments as $comment)
            <div class="comment">
                <p><strong>{{ $comment->user->name ?? 'Utilisateur inconnu' }}</strong> :</p>
                <p>{{ $comment->content }}</p>
            </div>
        @endforeach
    </div>
@endsection
