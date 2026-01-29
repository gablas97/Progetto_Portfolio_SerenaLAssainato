<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <title>Serena L'Assainato | Architect</title>
    <meta name="description" content="Serena L'Assainato | Portfolio - {{ __('ui.site_description') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-p">
    
    @unless(request()->is('admin*') || request()->is('/') || request()->is('login'))
        <x-navbar />
    @endunless

    <main>

        <div class="min-vh-100">
            {{ $slot }}
        </div>

    </main>
    
    <x-footer />

</body>
</html>