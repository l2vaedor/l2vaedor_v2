@php
    $navigation = [
        ['label' => 'Home', 'path' => '/', 'pattern' => '/'],
        ['label' => 'About', 'path' => '/about', 'pattern' => 'about'],
        ['label' => 'Rankings', 'path' => '/rankings', 'pattern' => 'rankings'],
        ['label' => 'Play', 'path' => '/play', 'pattern' => 'play'],
        ['label' => 'Account', 'path' => '/login', 'pattern' => ['login', 'register', 'account/*']],
    ];
@endphp

<header class="header">
    <div class="header__inner">
        <a href="{{ url('/') }}" class="header__logo">Vaedor</a>

        <nav class="header__nav" aria-label="Main navigation">
            @foreach ($navigation as $item)
                <a
                    href="{{ url($item['path']) }}"
                    @class([
                        'header__link',
                        'header__link--active' => request()->is($item['pattern']),
                    ])
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>
    </div>
</header>
