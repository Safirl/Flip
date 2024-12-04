<a href="{{route($url)}}" class="nav-button">
    <div class="icon">
        <i class="{{ $icon }}"></i>
    </div>
    <div class="label">
        {{ $label }}
    </div>
</a>

<style>
    .nav-button {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: inherit;
    }

    .nav-button .icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .nav-button .label {
        font-size: 1rem;
        font-weight: bold;
    }
</style>
