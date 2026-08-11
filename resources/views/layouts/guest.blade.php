<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistem Wisuda') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        
        <!-- Tambahan relative dan pemanggilan gambar background -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative"
             style="background-image: url('{{ asset('bg-denah.png') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
            
            <!-- Lapisan putih transparan (overlay) agar form tetap terbaca jelas -->
            <div class="absolute inset-0 bg-white/40"></div>

            <!-- Bagian Logo (Z-10 agar posisinya di atas overlay) -->
            <div class="z-10">
                <a href="/">
                    <img src="{{ asset('lambangits.png') }}" alt="Logo ITS" class="w-[200px] h-auto">
                </a>
            </div>

            <!-- Bagian Form Login (Z-10 agar posisinya di atas overlay) -->
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-lg overflow-hidden sm:rounded-lg z-10">
                {{ $slot }}
            </div>
            
        </div>
    </body>
</html>