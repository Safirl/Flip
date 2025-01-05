@props(['icon', 'label', 'url'])
@php
    $isActive = request()->routeIs($url);
@endphp

<a href="{{ route($url) }}"
   class="nav-button {{ $isActive ? 'active' : '' }}">
    <img class="icon" alt="{{ $label }} icon" src="{{ asset('images/icons/'. $icon .($isActive ? '-active' : '') .'.svg') }}">
    <div class="nav-indicator"></div>
</a>
