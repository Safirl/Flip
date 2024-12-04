<div class="navbar">
    <x-nav-button icon="fas fa-home" label="Polls" url='polls'/>
    <x-nav-button icon="fas fa-home" label="Feed" url='feed'/>
{{--    <x-nav-button icon="fas fa-home" label="Notifications" url="/"/>--}}
    <x-nav-button icon="fas fa-home" label="Account" url='account'/>
</div>

<style>
    .navbar {
        position: fixed; /* Fixe la barre à un emplacement spécifique */
        height: 52px;
        top: calc(100dvh - env(safe-area-inset-bottom) - 52px); /* Place la barre en bas de l'écran */
        left: 0; /* S'assure que la barre commence à gauche */
        display: flex;
        width: 100%; /* Occupe toute la largeur de l'écran */
        padding: var(--spacing-s, 6px) 0px;
        justify-content: center;
        align-items: center;
        align-content: center;
        gap: 32px var(--spacing-xxxl, 32px);
        flex-wrap: wrap;

        border-radius: var(--spacing-l, 12px) var(--spacing-l, 12px) 0px 0px;
        background: var(--palettes-white-300, #FCFCFC);

        /* shadow-xl */
        box-shadow: 0px 0px var(--spacing-xl, 16px) 5px rgba(0, 0, 0, 0.10);
        z-index: 1000; /* Met la navbar au-dessus d'autres éléments */
    }
</style>
