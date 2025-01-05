@extends('base')

@section('title', 'Commentaires')
@vite(['resources/css/comments.css'])

@section('content')
    <div>
        {{--        Mettre les infos liées à la carte bref on les retrouve depuis poll --}}
    </div>
    <form action="{{ route('app.result', ['poll' => $poll]) }}"
          method="get">
        <div class="back-bar">
            <x-button
                size="large"
                color="primary"
                kind="outlined"
                label=""
                iconEnd="fa-solid fa-arrow-left"
                classes="btn-back"
            />

            <div class="bulb @if($poll->is_intox) intox-bulb @else info-bulb @endif ">
                <i class="fa-solid fa-lightbulb"></i>
                <h1 style="">
                    @if($poll->is_intox)
                        INTOX
                    @else
                        INFO
                    @endif
                </h1>
            </div>
        </div>
    </form>
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

    <div class="popup-container" style="opacity: 0; z-index: -100">
        <div class="popup-content">
            <div class="title-bar">
                <x-button
                    size="large"
                    color="primary"
                    kind="outlined"
                    label=""
                    iconEnd="fa-solid fa-arrow-left"
                    classes="btn-back close-popup"
                />
                <h3>Ajouter un commentaire</h3>
            </div>
            <form action="{{ route('addComment', ['poll' => $poll]) }}" method="post">
                @csrf
                <input type="hidden" name="parent_id" value="{{ null }}">
                <textarea name="content" placeholder="Votre réponse..." required>{{ old('content') }}</textarea>
                @error("content") <span class="text-error">{{ $message }}</span> @enderror
                <div class="popup-actions">
                    <x-button
                        size="large"
                        type="submit"
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
            <div class="comment">
                <div class="action-btn">
                    @if($comment->replies()->exists())
                        <button class="btn-toggle-discussion">Voir la discussion</button>
                    @else
                        <div></div>
                    @endif
                    <button data-parent-id="{{ $comment->id }}" class="btn-response toggle-popup"
                            style="color: var(--app-primary)">Répondre<i
                            style="color: var(--app-primary); padding-left: .5rem"
                            class="fa-solid fa-paper-plane"></i>
                    </button>

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
                    const parentId = button.getAttribute('data-parent-id');
                    const hiddenInput = document.querySelector('input[name="parent_id"]');
                    console.log('hiddenInput :', hiddenInput);
                    if (hiddenInput) {
                        hiddenInput.value = parentId;
                    }
                    console.log('Parent ID:', parentId);
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
