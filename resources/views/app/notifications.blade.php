@vite(['resources/css/notifications.scss'])

<x-layouts.base-with-nav title="Notifications">
    <header>
        <h1>Notifications</h1>

        <p>{{ $commentsNotifications->count() }} {{ $commentsNotifications->count() > 1 ? 'nouveaux messages' : 'nouveau message' }}</p>

        <img src="{{ asset('images/covers/bell.png') }}" alt=""/>
    </header>

    <ul>
        @foreach( $commentsNotifications as $notification)
            <li>
                <article>
                    <header>
                        <h2>{{ $notification->data['author'] }}</h2>
                        <span aria-hidden="true">-</span>
                        <time datetime="{{ $notification->created_at->toISOString() }}"></time>
                    </header>

                    <section>
                        <p>"{{ $notification->data['content'] }}"</p>

                        <a href="{{ route('notifications.show', $notification->id) }}">
                            <img src="{{ asset('images/icons/chevron-right.svg') }}" alt="Voir">
                        </a>
                    </section>
                </article>
            </li>
        @endforeach
    </ul>

    @if($commentsNotifications->isEmpty())
        <section class="empty">
            <h2>Aucune notification</h2>
            <p>Ajoutez des amis pour être informé de leurs commentaires !</p>
        </section>
    @endif

    <script>
        const timeFormatter = new Intl.DateTimeFormat('fr-FR', {
            timeStyle: 'short',
        })
        const dateTimeFormatter = new Intl.DateTimeFormat('fr-FR', {
            timeStyle: 'short',
            dateStyle: 'short',
        })

        const today = new Date();
        const areSameDay = (dateA, dateB) => dateA.toDateString() === dateB.toDateString()

        document.querySelectorAll('time').forEach((el) => {
            const datetime = new Date(el.dateTime)

            el.innerText = (areSameDay(datetime, today) ? timeFormatter : dateTimeFormatter).format(datetime)
        })
    </script>
</x-layouts.base-with-nav>
