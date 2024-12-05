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
    {{--    Quote--}}
    <div class="card">
        <div class="card-section">
            <p style="margin-bottom: 1rem"><strong>{{$poll->author}}</strong></p>
            <p>"{{$poll->quote}}"</p>
        </div>
    </div>
    <div class="add-comment-btn">
        <x-button
            size="large"
            color="primary"
            label="Ajouter un commentaire"
            extend="true"
            iconEnd="fa-solid fa-plus"
        />
    </div>
    {{--    PopUp--}}
    {{--    <form class="card pop-up-comment" action="{{route('addComment', ['poll' => $poll])}}" method="post" class="vstack gap-3">--}}
    {{--        @csrf--}}
    {{--        <input type="hidden" name="parent_id" value="{{ null }}">--}}
    {{--        <div class="form-group">--}}
    {{--            <label for="comment">Commentaire :</label>--}}
    {{--            <input type="text" class="form-control" id="comment" name="content" value= {{ old('content') }}>--}}
    {{--            @error("content") <span class="text-error">{{ $message }}</span> @enderror--}}
    {{--        </div>--}}
    {{--    </form>--}}

    <div class="container-comments">
        @foreach($friends_comments as $comment)
            <x-user-card
                image="fa-solid fa-user"
                label="{{ $comment->user->name ?? 'Utilisateur inconnu' }}"
                text="{{ $comment->content }}"
                imageColor="rgba(60, 19, 134, 1)"
            />
            {{--            <form action="{{route('addComment', ['poll' => $poll])}}" method="post" class="vstack gap-3">--}}
            {{--                @csrf--}}
            {{--                <input type="hidden" name="parent_id" value="{{ $comment->id }}">--}}
            {{--                <div class="form-group">--}}
            {{--                    <label for="comment">Répondre :</label>--}}
            {{--                    <input type="text" class="form-control" id="comment" name="content" value= {{ old('content') }}>--}}
            {{--                    @error("content") <span class="text-error">{{ $message }}</span> @enderror--}}
            {{--                </div>--}}
            {{--                <button class="btn btn-primary">Répondre au commentaire</button>--}}
            {{--            </form>--}}
            <div class="comment">
                <button class="toggle-discussion">Voir la discussion</button>
                <div class="answers">
                    @foreach($comment->replies()->get() as $reply)
                        <x-user-card
                            image="fa-solid fa-user"
                            label="{{ $reply->user->name ?? 'Utilisateur inconnu' }}"
                            text="{{ $reply->content }}"
                            imageColor="rgba(60, 19, 134, 1)"
                            :isBackground="false"
                        />
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <x-nav-bar/>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Sélectionner tous les boutons et les réponses associées
        document.querySelectorAll('.toggle-discussion').forEach((button) => {
            button.addEventListener('click', () => {
                // Trouver la div "answers" qui suit le bouton
                const answersDiv = button.nextElementSibling
                // Vérifier si la div est visible ou cachée
                if (answersDiv.style.display === 'none') {
                    answersDiv.style.display = 'block'; // Afficher
                } else {
                    answersDiv.style.display = 'none'; // Cacher
                }
            });
        });
    });
</script>
