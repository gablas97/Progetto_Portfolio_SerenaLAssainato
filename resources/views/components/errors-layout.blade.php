<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <title>Serena L'Assainato | Architect</title>
    <meta name="description" content="Portfolio dell'architetta Serena L'Assainato. Scopri i miei progetti e le mie news. Contattami per collaborazioni e consulenze.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-p vh-100 d-flex flex-column">
    
    @unless(request()->is('admin*') || request()->is('/') || request()->is('login'))
        <x-navbar />
    @endunless

    <main class="error-container my-auto">

        <div class="error-box">
            {{ $slot }}
        </div>

    </main>
    
    <x-footer />

</body>
</html>