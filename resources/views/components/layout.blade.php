<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Vaedor' }} | Vaedor</title>

        @vite(['resources/js/app.js'])
    </head>

    <body class="layout">
        <x-header />

        <main class="layout__main">
            {{ $slot }}
        </main>

        <x-footer />
    </body>
</html>
