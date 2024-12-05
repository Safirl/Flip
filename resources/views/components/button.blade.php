<button
        type="submit"
        class="btn {{ $classes }} {{ $sizeClass() }} {{ $colorClass() }} {{ $kindClass() }} {{ $expandClass() }} @if($label && !$iconStart && !$iconEnd) btn-label-only @endif"
        @if($onClick) onclick="{{ $onClick }}" @endif>
        @if($iconStart)
                <i class="icon icon-start {{ $iconStart }}"></i>
        @endif
        @if($label)
                <span class="btnLabel">{{ $label }}</span>
        @endif
        @if($iconEnd)
                <i class="icon icon-end {{ $iconEnd }}"></i>
        @endif
</button>
