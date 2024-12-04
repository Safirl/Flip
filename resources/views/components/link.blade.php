<a href="{{ route($url) }}" class="link {{ $sizeClass() }} {{ $colorClass() }} {{ $noPaddingClass() }}">
    @if($iconStart)
        <i class="icon icon-start {{ $iconStart }}"></i>
    @endif
    <span class="link-text {{ $colorClass() }}">{{ $label }}</span>
    @if($iconEnd)
        <i class="icon icon-end {{ $iconEnd }}"></i>
    @endif
</a>
