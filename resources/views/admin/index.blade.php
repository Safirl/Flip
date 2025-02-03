<x-layouts.base-with-nav title="Admin">
    <h1>
        Les polls
    </h1>
    @foreach($polls as $poll)
        <article>
            <h2>{{ $poll->title }}</h2>
            <p>
                {{ $poll->published_at }}
            </p>
            <p>
                <a href="{{ route('admin.edit.poll', ['poll' => $poll] ) }}"
                   class="btn btn-primary">Modifier le poll</a>
            </p>
        </article>
    @endforeach
    {{ $polls->links() }}
</x-layouts.base-with-nav>
