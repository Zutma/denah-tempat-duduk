<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - Sistem Wisuda</title>
    
    <!-- Fonts & Tailwind -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50 flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#0f172a] text-white flex flex-col justify-between hidden sm:flex">
        <div>
            <!-- Logo & Title -->
            <div class="h-20 flex items-center px-6 border-b border-slate-800">
                <img src="{{ asset('lambangits.png') }}" alt="Logo" class="w-10 h-10 mr-3 object-contain bg-white rounded-full p-1">
                <div>
                    <h1 class="font-bold text-sm tracking-wide">Sistem Wisuda</h1>
                    <p class="text-xs text-slate-400">Admin Portal</p>
                </div>
            </div>

            <!-- Navigation Links Baru (Sesuai Hierarki) -->
            <nav class="mt-6 px-4 space-y-2">
                <!-- Dashboard (Aktif) -->
                <a href="/dashboard" class="flex items-center px-4 py-3 text-sm font-semibold text-white bg-sky-500 rounded-lg shadow-md">
                    <span class="mr-3">📊</span> Dashboard
                </a>
                
                <a href="/data-fakultas" class="flex items-center px-4 py-3 text-sm text-slate-300 hover:bg-slate-800 rounded-lg transition-colors">
                    <span class="mr-3">👤</span> Data Fakultas
                </a>
                
                <a href="/data-prodi" class="flex items-center px-4 py-3 text-sm text-slate-300 hover:bg-slate-800 rounded-lg transition-colors">
                    <span class="mr-3">🎓</span> Data Program Studi
                </a>
                
                <!-- Pintu Masuk Utama ke Event -> Sesi -> Kursi -->
                <a href="/wisuda" class="flex items-center px-4 py-3 text-sm text-slate-300 hover:bg-slate-800 rounded-lg transition-colors">
                    <span class="mr-3">🏛️</span> Wisuda
                </a>
            </nav>
        </div>

        <!-- Bottom Links -->
        <div class="p-4 border-t border-slate-800">
            <a href="/import-excel" class="w-full flex items-center justify-center px-4 py-2.5 bg-blue-600/20 text-blue-400 hover:bg-blue-600/30 rounded-lg text-sm font-medium transition-colors border border-blue-500/30">
                <span class="mr-2">📥</span> Import Excel
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 flex flex-col overflow-hidden">
        
        <!-- TOP NAVBAR -->
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 shadow-sm z-10">
            <h2 class="font-semibold text-gray-800">Dashboard Utama</h2>
            
            <div class="flex items-center space-x-6">
                <!-- Search Bar -->
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">🔍</span>
                    <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 bg-gray-100 border-transparent rounded-full text-sm focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-200 w-64 transition-all">
                </div>
                
                <!-- Profile Dropdown (Menggunakan Alpine.js) -->
                <div class="relative flex items-center border-l pl-6 ml-2" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="flex items-center cursor-pointer focus:outline-none">
                        <div class="w-8 h-8 bg-slate-300 text-slate-700 rounded-full flex items-center justify-center text-sm font-bold mr-2">A</div>
                        <span class="text-sm font-medium text-gray-700 hover:text-sky-500 transition-colors">Admin ▾</span>
                    </button>

                    <!-- Isi Dropdown Menu -->
                    <div x-show="open" style="display: none;" class="absolute right-0 top-10 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-100 z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            👤 Profil Saya
                        </a>
                        <hr class="border-gray-100">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-medium transition-colors">
                                🚪 Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- SCROLLABLE PAGE CONTENT (Bersih dari form kursi) -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8">
            
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 uppercase tracking-wide">Overview Sistem</h3>
                    <p class="text-sm text-gray-500 mt-1">Selamat datang di panel kontrol Sistem Wisuda ITS.</p>
                </div>
                <div class="flex items-center px-4 py-2 bg-white border border-gray-200 rounded-full shadow-sm">
                    <span class="text-sm font-medium text-gray-600 mr-2">Status Sistem:</span>
                    <span class="w-2.5 h-2.5 bg-green-500 rounded-full mr-1.5 animate-pulse"></span>
                    <span class="text-sm font-bold text-green-600">Aktif</span>
                </div>
            </div>

            <!-- Welcome Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 mb-8 flex items-start space-x-4 border-l-4 border-l-sky-500">
                <div class="text-4xl">🎓</div>
                <div>
                    <h4 class="font-bold text-gray-800 text-lg mb-2">Portal Data Master & Event</h4>
                    <p class="text-sm text-gray-600 leading-relaxed max-w-3xl">
                        Gunakan menu di sebelah kiri untuk mengelola data master (Fakultas & Program Studi). 
                        <br><br>
                        <strong>Catatan:</strong> Fitur untuk manajemen tempat duduk (Import Excel & Ploting Kursi) dapat diakses melalui menu <strong>Wisuda</strong>. Anda harus memilih Event dan Sesi yang spesifik terlebih dahulu sebelum mengatur kursi.
                    </p>
                </div>
            </div>

        </main>
    </div>

</body>
</html>