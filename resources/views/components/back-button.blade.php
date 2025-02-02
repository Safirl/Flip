<button onclick="history.back()" class="btn-back {{ $class }}">
    <img src="{{asset('images/icons/back-arrow.svg')}}" alt="back-button">
    @if($label !== "")
        <span>{{ $label }}</span>
    @endif
</button>
