<div class="friend-card card">
    <div class="friend-bg">
        <i class="friend-icon {{$image}}"></i>
    </div>
    <div class="friend-content">
        <p style="font-weight: lighter; font-size: 10px">{{ $label }}</p>
        <p style="font-weight: normal">{{ $text }}</p>
    </div>
</div>

<style>
    .card {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 12px;
    }

    .friend-card{
        display: flex;
        border: none;
        box-shadow: 0px 0px var(--global-blurs-blur-sm, 4px) 0px rgba(0, 0, 0, 0.10);
        margin-bottom: var(--spacing-m);
        flex-direction: row;
        justify-content: flex-start;
    }

    .friend-bg {
        background-color: {{$imageColor}};
        border-radius: .5rem;
    }

    .friend-icon {
        color: var(--app-white-300);
        font-size: 1rem;
        padding: .5rem;
    }

    .friend-content {
        margin-left: .5rem;
    }

</style>
