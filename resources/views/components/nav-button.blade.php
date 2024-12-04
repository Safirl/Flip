<a href="{{route($url)}}" class="nav-button">
    <div class="label">
        {{ $label }}
    </div>
    <div class="icon">
        <i class="{{ $icon }}"></i>
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
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .nav-button .label {
        font-size: 10px;
        font-weight: bold;
    }
</style>
