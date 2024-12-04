<a href="{{ route($url) }}"
   class="nav-button {{ request()->routeIs($url) ? 'active' : '' }}">
    <i class="icon {{ $icon }}"></i>
    <div class="label">
        {{ $label }}
    </div>
    <div class="nav-indicator"></div>
</a>
