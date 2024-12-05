<button
    type="submit"
    class="btn {{ $classes }} {{ $sizeClass() }} {{ $colorClass() }} {{ $outlinedClass() }} {{ $expandClass() }}"
    @if($onClick) onclick="{{ $onClick }}" @endif
>
    @if($iconStart)
        <i class="icon icon-start {{ $iconEnd }}"></i>
    @endif
    @if($label)
        {{ $label }}
    @endif
    @if($iconEnd)
        <i class="icon icon-end {{ $iconEnd }}"></i>
    @endif
</button>
