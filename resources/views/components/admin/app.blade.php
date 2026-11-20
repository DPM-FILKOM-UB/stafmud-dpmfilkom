<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin | DPM FILKOM UB</title>
    <meta name="description"
        content="Laman resmi penyampaian aspirasi Mahasiswa FILKOM UB - Parlemen Cakrawala Mahardika DPM FILKOM UB 2026.">

    <link rel="icon" type="image/png" href="{{ asset('images/logo-dpm.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-dpm-black text-white antialiased selection:bg-dpm-orange selection:text-white">
    <div
        class="fixed left-0 top-0 bottom-0 w-[1px] bg-gradient-to-b from-transparent via-dpm-gold/20 to-transparent pointer-events-none z-40 hidden md:block">
    </div>
    <div
        class="fixed right-0 top-0 bottom-0 w-[1px] bg-gradient-to-b from-transparent via-dpm-gold/20 to-transparent pointer-events-none z-40 hidden md:block">
    </div>

    <x-admin.navbar />

    <main id="main-content">
        {{ $slot }}
    </main>

    <x-footer />
</body>

</html>
