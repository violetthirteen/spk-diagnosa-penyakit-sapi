<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sistem Pakar Diagnosa Penyakit Sapi')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" style="background:linear-gradient(135deg,#f5f7fa 0%,#c3cfe2 100%);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;">
    <div style="width:100%;max-width:480px;background:#fff;border-radius:16px;box-shadow:0 20px 60px rgba(0,0,0,.15);padding:40px 32px;">
        {{ $slot }}
    </div>
</body>
</html>
