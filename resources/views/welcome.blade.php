<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denah Kursi Wisuda - Interaktif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 font-sans min-h-screen w-full flex flex-col items-center py-8">

    <div class="w-full px-4 md:px-8 lg:px-12 text-center flex-grow flex flex-col">

        <!-- Header Title -->
        <h1 class="text-xl md:text-2xl font-bold text-slate-800 mb-6">
            @if ($activeSession && $activeSession->event)
                {{ $activeSession->event->name }} - Sesi {{ $activeSession->session }}
            @else
                Denah Wisuda
            @endif
        </h1>

        <!-- Dropdown Pilihan Sesi / Event Wisuda -->
        @if (isset($publishedSessions) && $publishedSessions->count() > 0)
            <div class="mb-6 max-w-md mx-auto w-full">
                <form action="{{ route('public.home') }}" method="GET" id="sessionForm">
                    {{-- <label for="session_id"
                        class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                        Pilih Acara Wisuda:
                    </label> --}}
                    <span></span>
                    <select name="session_id" id="session_id" onchange="document.getElementById('sessionForm').submit()"
                        class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl shadow-sm text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <!-- Option Default jika belum memilih -->
                        <option value="" {{ !$activeSession ? 'selected' : '' }}>
                            -- Pilih Acara Wisuda --
                        </option>

                        @foreach ($publishedSessions as $session)
                            <option value="{{ $session->id }}"
                                {{ $activeSession && $activeSession->id == $session->id ? 'selected' : '' }}>
                                {{ $session->event->name ?? 'Event' }} — Sesi {{ $session->session }}
                                ({{ \Carbon\Carbon::parse($session->date)->format('d M Y') }})
                            </option>
                        @endforeach
                    </select>

                </form>
            </div>
        @endif

        <!-- Informational Badge -->
        {{-- @if ($activeSession && $activeSession->event)
            <div
                class="inline-flex items-center gap-2 px-4 py-1.5 bg-blue-50 border border-blue-200 rounded-full text-xs font-medium text-blue-700 mb-6 mx-auto">
                <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                <span>Menampilkan Denah: <strong>{{ $activeSession->event->name }} (Sesi
                        {{ $activeSession->session }})</strong></span>
            </div>
        @endif --}}


        <!-- Search Bar -->
        @if ($activeSession)
            <div class="mb-10">
                <form action="{{ route('public.home') }}" method="GET">
                    <input type="hidden" name="session_id" value="{{ $activeSession->id }}">
                    <input type="text" name="search" value="{{ $searchQuery ?? '' }}"
                        placeholder="🔍 Masukkan Nama atau NRP, lalu Enter..."
                        class="w-full max-w-lg px-5 py-3 border border-slate-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-center">
                </form>
                @if (!empty($searchQuery))
                    <p class="text-xs text-slate-500 mt-2">
                        Hasil pencarian untuk: <span class="font-bold text-slate-700">"{{ $searchQuery }}"</span>
                        <a href="{{ route('public.home', ['session_id' => $activeSession->id]) }}"
                            class="text-blue-600 underline ml-2">Reset</a>
                    </p>
                @endif
            </div>
        @endif

        <!-- Tampilan Jika Sesi Kosong / Belum Ada Event -->
        @if (!$activeSession || isset($message))
            <div
                class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-6 py-4 rounded-xl max-w-md mx-auto my-12 shadow-sm">
                {{ $message ?? 'Belum ada data sesi wisuda yang tersedia.' }}
            </div>
        @else
            <!-- Panggung Utama -->
            <div
                class="bg-slate-800 text-white font-bold tracking-widest py-4 rounded-lg mb-8 shadow-md w-full max-w-6xl mx-auto">
                PANGGUNG UTAMA / REKTORAT
            </div>

            <!-- Area Denah Kursi -->
            <div id="denahContainer"
                class="w-full overflow-x-auto pb-12 cursor-grab active:cursor-grabbing scroll-smooth">
                <div class="flex flex-nowrap justify-center mx-auto min-w-max px-4 gap-6 md:gap-10">

                    <!-- SAYAP KIRI -->
                    <div class="flex flex-col gap-6">
                        @forelse($leftRows as $row)
                            <div
                                class="flex items-center gap-3 bg-white p-3 rounded-xl shadow-sm border border-slate-200">
                                <span class="font-bold text-slate-400 w-6 text-sm">{{ $row->row }}</span>
                                <div class="grid grid-flow-col auto-cols-max gap-3">
                                    @foreach ($row->seats as $seat)
                                        @php
                                            $graduate = $seat->graduate;
                                            $facultyColor =
                                                $graduate && $graduate->faculty && $graduate->faculty->color
                                                    ? $graduate->faculty->color
                                                    : '#cbd5e1';
                                            $isMySeat = ($mySeatId ?? null) && $mySeatId == $seat->id;
                                        @endphp

                                        <div class="flex flex-col items-center group relative cursor-pointer">
                                            <div class="w-12 h-12 md:w-14 md:h-14 rounded flex items-center justify-center font-bold text-xs md:text-sm shadow transition-all
                                                {{ $isMySeat ? 'ring-4 ring-blue-600 animate-bounce' : 'hover:-translate-y-1 hover:shadow-lg' }}"
                                                style="background-color: {{ $graduate ? $facultyColor : '#e2e8f0' }}; color: {{ $graduate ? '#ffffff' : '#64748b' }};">
                                                {{ $row->row }}{{ sprintf('%02d', $seat->number) }}
                                            </div>

                                            <span
                                                class="text-[10px] mt-1.5 text-slate-700 font-medium truncate w-14 text-center">
                                                {{ $graduate ? explode(' ', trim($graduate->name))[0] : '-' }}
                                            </span>

                                            @if ($graduate)
                                                <div
                                                    class="absolute bottom-full mb-2 hidden group-hover:block bg-slate-900 text-white text-xs px-3 py-2 rounded-lg shadow-xl whitespace-nowrap z-10 text-left">
                                                    <p class="font-bold text-yellow-300">{{ $graduate->name }}</p>
                                                    <p class="text-slate-300">NRP: {{ $graduate->nrp }}</p>
                                                    <p class="text-slate-300">Prodi:
                                                        {{ $graduate->studyProgram->name ?? '-' }}</p>
                                                    <p class="text-slate-300 font-semibold">Fakultas:
                                                        {{ $graduate->faculty->name ?? '-' }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <p class="text-slate-400 text-sm italic">Belum ada data kursi sayap kiri.</p>
                        @endforelse
                    </div>

                    <!-- LORONG TENGAH -->
                    <div class="flex items-stretch mx-2">
                        <div
                            class="w-12 md:w-16 border-x-2 border-dashed border-slate-400 opacity-60 relative flex items-center justify-center">
                            <span class="absolute -rotate-90 text-slate-400 font-bold tracking-[0.3em] text-xs">
                                LORONG
                            </span>
                        </div>
                    </div>

                    <!-- SAYAP KANAN -->
                    <div class="flex flex-col gap-6">
                        @forelse($rightRows as $row)
                            <div
                                class="flex items-center gap-3 bg-white p-3 rounded-xl shadow-sm border border-slate-200">
                                <div class="grid grid-flow-col auto-cols-max gap-3">
                                    @foreach ($row->seats as $seat)
                                        @php
                                            $graduate = $seat->graduate;
                                            $facultyColor =
                                                $graduate && $graduate->faculty && $graduate->faculty->color
                                                    ? $graduate->faculty->color
                                                    : '#cbd5e1';
                                            $isMySeat = ($mySeatId ?? null) && $mySeatId == $seat->id;
                                        @endphp

                                        <div class="flex flex-col items-center group relative cursor-pointer">
                                            <div class="w-12 h-12 md:w-14 md:h-14 rounded flex items-center justify-center font-bold text-xs md:text-sm shadow transition-all
                                                {{ $isMySeat ? 'ring-4 ring-blue-600 animate-bounce' : 'hover:-translate-y-1 hover:shadow-lg' }}"
                                                style="background-color: {{ $graduate ? $facultyColor : '#e2e8f0' }}; color: {{ $graduate ? '#ffffff' : '#64748b' }};">
                                                {{ $row->row }}{{ sprintf('%02d', $seat->number) }}
                                            </div>

                                            <span
                                                class="text-[10px] mt-1.5 text-slate-700 font-medium truncate w-14 text-center">
                                                {{ $graduate ? explode(' ', trim($graduate->name))[0] : '-' }}
                                            </span>

                                            @if ($graduate)
                                                <div
                                                    class="absolute bottom-full mb-2 hidden group-hover:block bg-slate-900 text-white text-xs px-3 py-2 rounded-lg shadow-xl whitespace-nowrap z-10 text-left">
                                                    <p class="font-bold text-yellow-300">{{ $graduate->name }}</p>
                                                    <p class="text-slate-300">NRP: {{ $graduate->nrp }}</p>
                                                    <p class="text-slate-300">Prodi:
                                                        {{ $graduate->studyProgram->name ?? '-' }}</p>
                                                    <p class="text-slate-300 font-semibold">Fakultas:
                                                        {{ $graduate->faculty->name ?? '-' }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <span class="font-bold text-slate-400 w-6 text-sm">{{ $row->row }}</span>
                            </div>
                        @empty
                            <p class="text-slate-400 text-sm italic">Belum ada data kursi sayap kanan.</p>
                        @endforelse
                    </div>

                </div>
            </div>

        @endif

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const container = document.getElementById('denahContainer');
            if (container) {
                container.scrollLeft = (container.scrollWidth - container.clientWidth) / 2;
            }
        });
    </script>
</body>

</html>
