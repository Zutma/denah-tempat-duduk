<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denah Kursi Wisuda - Interaktif</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Ring Highlight saat kursi dipilih */
        .selected-seat-ring {
            outline: 4px solid #0284c7;
            outline-offset: 2px;
            transform: scale(1.1);
        }

        /* Custom Scrollbar Tipis */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 8px;
        }
    </style>
</head>

<body class="bg-slate-50 font-sans min-h-screen w-full flex flex-col items-center py-8" x-data="seatMapApp()">

    <div class="w-full px-4 md:px-8 text-center flex-grow flex flex-col">

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
                    <select name="session_id" id="session_id" onchange="document.getElementById('sessionForm').submit()"
                        class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl shadow-sm text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-sky-500">
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

        <!-- SEARCH BAR & CARD HASIL PENCARIAN -->
        @if ($activeSession)
            <div class="mb-8 max-w-lg mx-auto w-full">
                <form action="{{ route('public.home') }}" method="GET">
                    <input type="hidden" name="session_id" value="{{ $activeSession->id }}">
                    <input type="text" name="search" value="{{ $searchQuery ?? '' }}"
                        placeholder="🔍 Masukkan Nama atau NRP, lalu Enter..."
                        class="w-full px-5 py-3 border border-slate-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-500 text-sm text-center font-medium bg-white">
                </form>

                @if (!empty($searchQuery))
                    <div class="mt-3 flex items-center justify-between text-xs text-slate-500 px-3">
                        <span>Ditemukan <strong class="text-slate-800">{{ count($searchResults ?? []) }}</strong> hasil
                            untuk "<strong>{{ $searchQuery }}</strong>"</span>
                        <a href="{{ route('public.home', ['session_id' => $activeSession->id]) }}"
                            @click="clearSelection()" class="text-sky-600 font-semibold hover:underline">Reset</a>
                    </div>

                    <!-- Card List Hasil Pencarian -->
                    @if (isset($searchResults) && count($searchResults) > 0)
                        <div
                            class="mt-3 bg-white border border-slate-200 rounded-2xl shadow-sm p-2 text-left max-h-56 overflow-y-auto custom-scrollbar divide-y divide-slate-100">
                            @foreach ($searchResults as $result)
                                <button type="button"
                                    @click="focusSeat({{ $result['seat_id'] }}, {{ json_encode($result) }})"
                                    class="w-full p-2.5 hover:bg-sky-50/80 rounded-xl transition-colors flex items-center justify-between group cursor-pointer focus:outline-none">
                                    <div>
                                        <p class="text-xs font-bold text-slate-800 group-hover:text-sky-700">
                                            {{ $result['name'] }}</p>
                                        <p class="text-[11px] text-slate-500">NRP: {{ $result['nrp'] }} •
                                            {{ $result['prodi'] }}</p>
                                    </div>
                                    <span
                                        class="px-2.5 py-1 bg-sky-100 text-sky-700 text-xs font-bold rounded-lg group-hover:bg-sky-500 group-hover:text-white transition-colors whitespace-nowrap">
                                        Kursi {{ $result['seat_code'] }}
                                    </span>
                                </button>
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>
        @endif

        <!-- Tampilan Jika Sesi Kosong / Belum Ada Event -->
        @if (!$activeSession || isset($message))
            <div
                class="bg-amber-50 border border-amber-200 text-amber-800 px-6 py-4 rounded-xl max-w-md mx-auto my-12 text-sm">
                {{ $message ?? 'Belum ada data sesi wisuda yang tersedia.' }}
            </div>
        @else
            <!-- PANGGUNG UTAMA -->
            <div
                class="bg-slate-800 text-white font-bold tracking-widest py-4 rounded-lg mb-8 shadow-md w-full max-w-6xl mx-auto text-xs md:text-sm">
                PANGGUNG UTAMA / REKTORAT
            </div>

            <!-- AREA DENAH KURSI -->
            <div id="denahContainer"
                class="w-full overflow-x-auto pb-16 cursor-grab active:cursor-grabbing scroll-smooth">
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

                                            $graduateData = $graduate
                                                ? [
                                                    'seat_id' => $seat->id,
                                                    'seat_code' => $row->row . sprintf('%02d', $seat->number),
                                                    'name' => $graduate->name,
                                                    'nrp' => $graduate->nrp,
                                                    'prodi' => $graduate->studyProgram->name ?? '-',
                                                    'faculty' => $graduate->faculty->name ?? '-',
                                                    'color' => $facultyColor,
                                                ]
                                                : null;
                                        @endphp

                                        <div class="flex flex-col items-center">
                                            <button type="button" id="seat-{{ $seat->id }}"
                                                @click="selectSeat({{ $seat->id }}, {{ json_encode($graduateData) }})"
                                                :class="{ 'selected-seat-ring': selectedSeatId === {{ $seat->id }} }"
                                                class="w-12 h-12 md:w-14 md:h-14 rounded-lg flex items-center justify-center font-bold text-xs md:text-sm shadow transition-all duration-150 hover:scale-105 cursor-pointer focus:outline-none"
                                                style="background-color: {{ $graduate ? $facultyColor : '#e2e8f0' }}; color: {{ $graduate ? '#ffffff' : '#64748b' }};">
                                                {{ $row->row }}{{ sprintf('%02d', $seat->number) }}
                                            </button>

                                            <span
                                                class="text-[10px] mt-1.5 text-slate-700 font-medium truncate w-14 text-center">
                                                {{ $graduate ? explode(' ', trim($graduate->name))[0] : '-' }}
                                            </span>
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
                                JALAN TENGAH
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

                                            $graduateData = $graduate
                                                ? [
                                                    'seat_id' => $seat->id,
                                                    'seat_code' => $row->row . sprintf('%02d', $seat->number),
                                                    'name' => $graduate->name,
                                                    'nrp' => $graduate->nrp,
                                                    'prodi' => $graduate->studyProgram->name ?? '-',
                                                    'faculty' => $graduate->faculty->name ?? '-',
                                                    'color' => $facultyColor,
                                                ]
                                                : null;
                                        @endphp

                                        <div class="flex flex-col items-center">
                                            <button type="button" id="seat-{{ $seat->id }}"
                                                @click="selectSeat({{ $seat->id }}, {{ json_encode($graduateData) }})"
                                                :class="{ 'selected-seat-ring': selectedSeatId === {{ $seat->id }} }"
                                                class="w-12 h-12 md:w-14 md:h-14 rounded-lg flex items-center justify-center font-bold text-xs md:text-sm shadow transition-all duration-150 hover:scale-105 cursor-pointer focus:outline-none"
                                                style="background-color: {{ $graduate ? $facultyColor : '#e2e8f0' }}; color: {{ $graduate ? '#ffffff' : '#64748b' }};">
                                                {{ $row->row }}{{ sprintf('%02d', $seat->number) }}
                                            </button>

                                            <span
                                                class="text-[10px] mt-1.5 text-slate-700 font-medium truncate w-14 text-center">
                                                {{ $graduate ? explode(' ', trim($graduate->name))[0] : '-' }}
                                            </span>
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

            <!-- MODAL DETAIL KURSI -->
            <div x-show="activeModalData" x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4"
                @click.self="closeModal()">
                <div class="bg-white rounded-2xl shadow-2xl border border-slate-100 max-w-sm w-full p-6 text-left transform transition-all"
                    @keydown.escape.window="closeModal()">

                    <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full"
                                :style="`background-color: ${activeModalData?.color || '#cbd5e1'}`"></span>
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Detail Tempat
                                Duduk</span>
                        </div>
                        <button @click="closeModal()"
                            class="text-slate-400 hover:text-slate-600 font-bold text-sm cursor-pointer focus:outline-none">✕</button>
                    </div>

                    <template x-if="activeModalData">
                        <div class="space-y-3">
                            <div>
                                <span
                                    class="inline-block px-2.5 py-1 bg-sky-100 text-sky-800 font-extrabold text-sm rounded-md mb-2">
                                    Kursi <span x-text="activeModalData.seat_code"></span>
                                </span>
                                <h4 class="text-base font-bold text-slate-800" x-text="activeModalData.name"></h4>
                                <p class="text-xs text-slate-500" x-text="`NRP: ${activeModalData.nrp}`"></p>
                            </div>

                            <div class="pt-2 border-t border-slate-100 space-y-1 text-xs text-slate-600">
                                <p><span class="font-semibold text-slate-700">Program Studi:</span> <span
                                        x-text="activeModalData.prodi"></span></p>
                                <p><span class="font-semibold text-slate-700">Fakultas:</span> <span
                                        x-text="activeModalData.faculty"></span></p>
                            </div>
                        </div>
                    </template>

                    <div class="mt-5 pt-3 border-t border-slate-100 text-right">
                        <button @click="closeModal()"
                            class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-lg transition-colors cursor-pointer focus:outline-none">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        @endif

    </div>

    <!-- Script Alpine.js Manager -->
    <script>
        function seatMapApp() {
            return {
                selectedSeatId: null,
                activeModalData: null,

                selectSeat(seatId, data) {
                    if (!data) return;

                    // Toggle: Jika diklik kursi yang sama, hilangkan border sorotan
                    if (this.selectedSeatId === seatId) {
                        this.selectedSeatId = null;
                        this.activeModalData = null;
                    } else {
                        this.selectedSeatId = seatId;
                        this.activeModalData = data;
                    }
                },

                focusSeat(seatId, data) {
                    this.selectedSeatId = seatId;
                    this.activeModalData = data;

                    this.$nextTick(() => {
                        const el = document.getElementById(`seat-${seatId}`);
                        if (el) {
                            el.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center',
                                inline: 'center'
                            });
                        }
                    });
                },

                closeModal() {
                    this.activeModalData = null;
                    this.selectedSeatId = null; // Menghilangkan border biru saat modal ditutup
                },

                clearSelection() {
                    this.selectedSeatId = null;
                    this.activeModalData = null;
                }
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const container = document.getElementById('denahContainer');
            if (container) {
                container.scrollLeft = (container.scrollWidth - container.clientWidth) / 2;
            }
        });
    </script>
</body>

</html>