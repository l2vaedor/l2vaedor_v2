@php
    $legalNavigation = [
        'terms' => 'Terms of Service',
        'privacy' => 'Privacy Policy',
        'cookies' => 'Cookie Policy',
        'server-rules' => 'Server Rules',
        'refund-policy' => 'Donation & Refund Policy',
        'fair-play' => 'Fair Play / No Pay-to-Win',
    ];

    $currentPage = request()->route('page');
@endphp

<x-layout :title="$legal['title']">
    <section class="legal">
        <div class="legal__inner">
            <aside class="legal__sidebar" aria-label="Legal pages">
                <p class="legal__sidebar-label">Legal Pages</p>

                <nav class="legal__nav">
                    @foreach ($legalNavigation as $slug => $label)
                        <a
                            href="{{ route('legal.show', ['page' => $slug]) }}"
                            @class([
                                'legal__nav-link',
                                'legal__nav-link--active' => $currentPage === $slug,
                            ])
                            @if ($currentPage === $slug) aria-current="page" @endif
                        >
                            {{ $label }}
                        </a>
                    @endforeach
                </nav>
            </aside>

            <article class="legal__content">
                <header class="legal__header">
                    <p class="legal__eyebrow">Legal</p>
                    <h1 class="legal__title">{{ $legal['title'] }}</h1>
                    <p class="legal__meta">Last updated: {{ $legal['updated'] }}</p>
                    <p class="legal__intro">{{ $legal['intro'] }}</p>
                </header>

                <div class="legal__body">
                    @foreach ($legal['sections'] as $section)
                        <section class="legal__section">
                            <h2 class="legal__heading">{{ $section['title'] }}</h2>

                            @isset($section['body'])
                                <p class="legal__text">{{ $section['body'] }}</p>
                            @endisset

                            @isset($section['items'])
                                <ul class="legal__list">
                                    @foreach ($section['items'] as $item)
                                        <li class="legal__item">{{ $item }}</li>
                                    @endforeach
                                </ul>
                            @endisset
                        </section>
                    @endforeach
                </div>

                <p class="legal__notice">
                    {{ $legal['notice'] ?? 'This page is a practical draft and should be reviewed by legal counsel before public launch.' }}
                </p>
            </article>
        </div>
    </section>
</x-layout>
