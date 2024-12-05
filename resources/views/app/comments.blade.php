@extends('base')

@section('title', 'Commentaires')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/comments.css') }}">
@endsection

@section('content')
    {{ $parentId = null }}
    <div>
        {{--        Mettre les infos liées à la carte bref on les retrouve depuis poll --}}
    </div>
    <div class="back-bar">
        <x-button
            size="large"
            color="primary"
            kind="outlined"
            label=""
            iconEnd="fa-solid fa-arrow-left"
            classes="btn-back"
        />
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
        <div class="add-comment-btn toggle-popup">
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

    <div class="popup-container" style="opacity: 0; z-index: -100">
        <div class="popup-content">
            <x-button
                size="large"
                color="primary"
                kind="outlined"
                label=""
                iconEnd="fa-solid fa-arrow-left"
                classes="btn-back close-popup"
            />
            <h3>Ajouter un commentaire</h3>
            <form action="{{ route('addComment', ['poll' => $poll]) }}" method="post">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $parentId }}">
                <textarea name="content" placeholder="Votre réponse..." required></textarea>
                <div class="popup-actions">
                    <x-button
                        size="large"
                        color="primary"
                        label="Partager !"
                        extend="false"
                    />
                </div>
            </form>
        </div>
    </div>

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
                <div class="action-btn">
                    @if($comment->replies()->exists())
                        <button class="btn-toggle-discussion">Voir la discussion</button>
                    @else
                        <div></div>
                    @endif
                    <button onclick="{{ $parentId = $comment->id }}" class="btn-response toggle-popup"
                            style="color: var(--app-primary-500)">Répondre<i
                            style="color: var(--app-primary-500); padding-left: .5rem"
                            class="fa-solid fa-paper-plane"></i></button>
                </div>
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
        document.querySelectorAll('.btn-toggle-discussion').forEach((button) => {
            button.addEventListener('click', () => {
                // Trouver le parent ".comment" du bouton
                const commentDiv = button.closest('.comment');

                // Trouver la div "answers" à l'intérieur de ce parent
                const answersDiv = commentDiv.querySelector('.answers');

                // Vérifier si la div "answers" existe et gérer l'affichage
                if (answersDiv) {
                    if (answersDiv.style.display === 'none' || answersDiv.style.display === '') {
                        answersDiv.style.display = 'block'; // Afficher
                    } else {
                        answersDiv.style.display = 'none'; // Cacher
                    }
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.close-popup').forEach((button) => {
            button.addEventListener('click', () => {
                const popup = document.querySelector('.popup-container');

                if (popup) {
                    popup.style.opacity = '0'
                    popup.style.zIndex = '-100'
                    const body = document.querySelector("body")
                    if (body) {
                        body.style.overflow = 'unset';
                    }
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.toggle-popup').forEach((button) => {
            button.addEventListener('click', () => {
                const popup = document.querySelector('.popup-container');
                if (popup) {
                    popup.style.opacity = '1'
                    popup.style.zIndex = 'unset'
                    const body = document.querySelector("body")
                    if (body) {
                        body.style.overflow = 'hidden';
                    }
                }
            });
        });
    });
</script>
