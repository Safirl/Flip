@props(['poll'])

<div>
    <h3>
        <span>{{ $firstname }}</span>
        <span>{{ $lastname }}</span>
    </h3>

    <div>
        <p>{{ $poll->source }}</p>
        <p>{{ $poll->date ? \Carbon\Carbon::parse($poll->date)->format('d.m.Y') : 'Date inconnue'}}</p>
    </div>
</div>
