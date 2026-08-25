<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Portal - Sistem Wisuda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-50 flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#0f172a] text-white flex flex-col justify-between hidden sm:flex">
        <div>
            <div class="h-20 flex items-center px-6 border-b border-slate-800">
                <img src="{{ asset('lambangits.png') }}" alt="Logo"
                    class="w-10 h-10 mr-3 object-contain bg-white rounded-full p-1">
                <div>
                    <h1 class="font-bold text-sm tracking-wide">Sistem Wisuda</h1>
                    <p class="text-xs text-slate-400">Admin Portal</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="mt-6 px-4 space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'font-semibold text-white bg-sky-500 shadow-md' : 'text-slate-300 hover:bg-slate-800' }}">
                    <span class="mr-3">📊</span> Dashboard
                </a>

                <!-- Data Fakultas -->
                <a href="{{ route('faculties.index') }}"
                    class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors {{ request()->routeIs('faculties.*') ? 'font-semibold text-white bg-sky-500 shadow-md' : 'text-slate-300 hover:bg-slate-800' }}">
                    <span class="mr-3">👤</span> Data Fakultas
                </a>

                <!-- Data Program Studi -->
                <a href="{{ route('study-programs.index') }}"
                    class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors {{ request()->routeIs('study-programs.*') ? 'font-semibold text-white bg-sky-500 shadow-md' : 'text-slate-300 hover:bg-slate-800' }}">
                    <span class="mr-3">🎓</span> Data Program Studi
                </a>

                <!-- Wisuda (Menggunakan request()->is() karena panggil URL mentah /wisuda) -->
                <a href="{{ route('graduation-events.index') }}"
                    class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors {{ request()->is('wisuda*') ? 'font-semibold text-white bg-sky-500 shadow-md' : 'text-slate-300 hover:bg-slate-800' }}">
                    <span class="mr-3">🏛️</span> Wisuda
                </a>
            </nav>
        </div>

        
    </aside>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- TOP NAVBAR -->
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 shadow-sm z-10">
            <h2 class="font-semibold text-gray-800">Admin Panel</h2>
            <div class="flex items-center space-x-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 font-medium">Logout</button>
                </form>
            </div>
        </header>

        <!-- KONTEN HALAMAN AKAN DITAMPILKAN DI SINI -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8">
            @yield('content')
        </main>
    </div>

</body>

</html>
