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

        <div class="p-4 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center px-4 py-2.5 text-sm font-medium text-red-400 hover:bg-red-500/10 hover:text-red-300 rounded-lg transition-colors">
                    <span class="mr-3">🚪</span> Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- TOP NAVBAR -->
        {{-- <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 shadow-sm z-10">
            <h2 class="text-2xl font-bold text-gray-800">@yield('page-title')</h2>
            <div
                class="flex items-center space-x-2 text-sm text-gray-500 bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-200">
                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                <span class="font-medium text-gray-700">Administrator</span>
            </div>
        </header> --}}

        <!-- KONTEN HALAMAN AKAN DITAMPILKAN DI SINI -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8">
            @yield('content')
        </main>
    </div>

</body>

</html>
