@php
    $features = [
        ['title' => 'Balanced Gameplay', 'text' => 'Every class has a purpose. Competitive PvP, rewarding PvE, and adjusted mechanics create an experience where skill matters.'],
        ['title' => 'Fair & Transparent', 'text' => 'Zero pay-to-win philosophy, active moderation, and clear server policies keep competition on equal ground.'],
        ['title' => 'Community Driven', 'text' => 'Vaedor grows through regular events, feedback, and continuous improvements shaped with the community.'],
        ['title' => 'Clear Progression', 'text' => 'Players should always know what to chase next: gear, raids, clans, Olympiad, sieges, and long-term achievements.'],
        ['title' => 'Stable World', 'text' => 'Infrastructure, protection, backups, and monitoring support a server made for long-term play.'],
    ];
@endphp

<x-layout title="Home">
    {{-- Hero --}}
    <section class="hero">
        <div class="hero__inner">
            <p class="hero__subtitle">Lineage II Private Server</p>
            <h1 class="hero__title">Vaedor</h1>
            <p class="hero__text">A focused Lineage II world with balanced progression, meaningful PvP, long-term PvE goals, and a fair-play economy built for players who want a serious home.</p>

            <div class="hero__actions">
                <a href="{{ url('/play') }}" class="button button--primary">Play Now</a>
                <a href="{{ url('/download') }}" class="button button--secondary">Download</a>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section class="section" id="features">
        <div class="section__inner">
            <h2 class="section__title">Why Players Stay</h2>
            <p class="section__content">Vaedor keeps the first screen clean, but gives players the details they look for before choosing a server: fairness, stability, clear progression, and real reasons to return.</p>

            <ul class="features">
                @foreach ($features as $feature)
                    <li class="features__item">
                        <h3 class="features__title">{{ $feature['title'] }}</h3>
                        <p class="features__text">{{ $feature['text'] }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- News --}}
    <section class="section" id="news">
        <div class="section__inner">
            <div class="patch-notes__header">
                <div>
                    <h2 class="section__title">Latest Updates</h2>
                    <p class="section__content">The latest server changes, fixes, and announcements from Vaedor.</p>
                </div>

                <a href="{{ url('/patch-notes') }}" class="button button--secondary">All Patch Notes</a>
            </div>

            <div class="patch-notes">
                @foreach ($patchNotes as $index => $note)
                    <article class="patch-notes__item">
                        <time class="patch-notes__date">{{ $note['published_at'] ?? '' }}</time>
                        <h3 class="patch-notes__title">{{ $index === 0 ? 'Latest Patch Notes' : 'Previous Patch Notes' }}</h3>
                        <div class="patch-notes__content">{{ $note['content'] ?? '' }}</div>

                        @if (! empty($note['discord_url']))
                            <a href="{{ $note['discord_url'] }}" class="patch-notes__link" target="_blank" rel="noopener">Read more</a>
                        @endif
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Rankings --}}
    <section class="section" id="rankings">
        <div class="section__inner">
            <div class="rankings">
                <div class="rankings__header">
                    <div>
                        <h2 class="section__title">Top Players</h2>
                        <p class="section__content">The strongest characters on Vaedor, updated from the game world.</p>
                    </div>

                    <a href="{{ url('/rankings') }}" class="button button--secondary">Full Rankings</a>
                </div>

                <p class="rankings__empty">Top players will appear here once the game database is connected.</p>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="cta">
        <div class="cta__inner">
            <h2 class="cta__title">Ready to begin your journey?</h2>
            <p class="cta__text">Create your account, download the client, and join the community on Discord.</p>

            <div class="cta__actions">
                <a href="{{ url('/register') }}" class="button button--primary">Create Account</a>
                <a href="{{ url('/download') }}" class="button button--secondary">Download</a>
            </div>
        </div>
    </section>
</x-layout>
