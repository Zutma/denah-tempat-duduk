<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denah Kursi Wisuda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .seat-selected {
            outline: 3px solid #0284c7;
            outline-offset: 2px;
        }

        .scroll-x::-webkit-scrollbar {
            height: 6px;
        }

        .scroll-x::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 8px;
        }
    </style>
</head>

<body class="bg-slate-50 font-sans min-h-screen py-8" x-data="seatMapApp()">

    <div class="max-w-4xl mx-auto px-4">

        <h1 class="text-xl md:text-2xl font-bold text-slate-800 text-center mb-6">
            @if ($activeSession && $activeSession->event)
                {{ $activeSession->event->name }} — Sesi {{ $activeSession->session }}
            @else
                Denah Wisuda
            @endif
        </h1>

        {{-- Pilih Sesi --}}
        @if (isset($publishedSessions) && $publishedSessions->count() > 0)
            <form action="{{ route('public.home') }}" method="GET" class="mb-4">
                <select name="session_id" onchange="this.form.submit()"
                    class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg shadow-sm text-sm font-medium text-slate-700">
                    <option value="" {{ !$activeSession ? 'selected' : '' }}>-- Pilih Acara Wisuda --</option>
                    @foreach ($publishedSessions as $session)
                        <option value="{{ $session->id }}"
                            {{ $activeSession && $activeSession->id == $session->id ? 'selected' : '' }}>
                            {{ $session->event->name ?? 'Event' }} — Sesi {{ $session->session }}
                            ({{ \Carbon\Carbon::parse($session->date)->format('d M Y') }})
                        </option>
                    @endforeach
                </select>
            </form>
        @endif

        @if (!$activeSession || isset($message))
            <div class="bg-amber-50 border border-amber-200 text-amber-800 px-6 py-4 rounded-lg text-sm text-center">
                {{ $message ?? 'Belum ada data sesi wisuda yang tersedia.' }}
            </div>
        @else
            {{-- Search Bar --}}
            <form action="{{ route('public.home') }}" method="GET" class="mb-3">
                <input type="hidden" name="session_id" value="{{ $activeSession->id }}">
                <input type="text" name="search" value="{{ $searchQuery ?? '' }}"
                    placeholder="Cari nama atau NRP, lalu tekan Enter..."
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg shadow-sm text-sm">
            </form>

            {{-- Hasil Pencarian: CARD INLINE, bukan dropdown melayang --}}
            @if (!empty($searchQuery))
                <div class="mb-6 bg-white border border-slate-200 rounded-lg shadow-sm p-3">
                    <div class="flex items-center justify-between text-xs text-slate-500 px-1 mb-2">
                        <span>Ditemukan <strong class="text-slate-800">{{ count($searchResults ?? []) }}</strong>
                            hasil</span>
                        <a href="{{ route('public.home', ['session_id' => $activeSession->id]) }}"
                            class="text-sky-600 font-semibold hover:underline">Reset</a>
                    </div>

                    @if (isset($searchResults) && count($searchResults) > 0)
                        <div class="divide-y divide-slate-100">
                            @foreach ($searchResults as $result)
                                <button type="button"
                                    @click="pilihKursi({{ $result['seat_id'] }}, {{ json_encode($result) }})"
                                    class="w-full p-2.5 hover:bg-sky-50 rounded-lg text-left flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-bold text-slate-800">{{ $result['name'] }}</p>
                                        <p class="text-xs text-slate-500">NRP: {{ $result['nrp'] }} —
                                            {{ $result['prodi'] }}</p>
                                    </div>
                                    <span class="px-2.5 py-1 bg-sky-100 text-sky-700 text-xs font-bold rounded-lg">
                                        Kursi {{ $result['seat_code'] }}
                                    </span>
                                </button>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-slate-500 px-1">Tidak ada hasil untuk "{{ $searchQuery }}".</p>
                    @endif
                </div>
            @endif

            {{-- Card Info Kursi Terpilih: bagian dari alur halaman, BUKAN modal --}}
            <div x-show="dipilih" x-cloak class="mb-6 bg-white border-2 border-sky-200 rounded-lg shadow-sm p-4">
                <div class="flex items-start justify-between">
                    <div>
                        <span
                            class="inline-block px-2.5 py-1 bg-sky-100 text-sky-800 font-bold text-xs rounded-md mb-2">
                            Kursi <span x-text="dipilih?.seat_code"></span>
                        </span>
                        <h4 class="text-base font-bold text-slate-800" x-text="dipilih?.name"></h4>
                        <p class="text-xs text-slate-500" x-text="'NRP: ' + dipilih?.nrp"></p>
                        <p class="text-xs text-slate-600 mt-1" x-text="dipilih?.prodi"></p>
                        <p class="text-xs text-slate-500" x-text="dipilih?.faculty"></p>
                    </div>
                    <button @click="dipilih = null; seatIdTerpilih = null"
                        class="text-slate-400 hover:text-slate-600 text-sm">✕</button>
                </div>
            </div>

            {{-- Panggung --}}
            <div
                class="bg-slate-800 text-white text-center font-bold tracking-widest py-4 rounded-lg mb-6 text-xs md:text-sm">
                PANGGUNG UTAMA / REKTORAT
            </div>

            {{-- Denah Kursi --}}
            <div class="overflow-x-auto scroll-x pb-4">
                <div class="flex justify-center gap-8 min-w-max px-2">

                    <div class="flex flex-col gap-4">
                        @forelse ($leftRows as $row)
                            <div
                                class="flex items-center gap-2 bg-white p-2.5 rounded-lg shadow-sm border border-slate-200">
                                <span class="font-bold text-slate-400 w-5 text-sm">{{ $row->row }}</span>
                                <div class="flex gap-2">
                                    @foreach ($row->seats as $seat)
                                        @include('public.seats._seat-button', [
                                            'seat' => $seat,
                                            'row' => $row,
                                        ])
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <p class="text-slate-400 text-sm italic">Belum ada kursi sayap kiri.</p>
                        @endforelse
                    </div>

                    <div class="border-x-2 border-dashed border-slate-300"></div>

                    <div class="flex flex-col gap-4">
                        @forelse ($rightRows as $row)
                            <div
                                class="flex items-center gap-2 bg-white p-2.5 rounded-lg shadow-sm border border-slate-200">
                                <div class="flex gap-2">
                                    @foreach ($row->seats as $seat)
                                        @include('public.seats._seat-button', [
                                            'seat' => $seat,
                                            'row' => $row,
                                        ])
                                    @endforeach
                                </div>
                                <span class="font-bold text-slate-400 w-5 text-sm">{{ $row->row }}</span>
                            </div>
                        @empty
                            <p class="text-slate-400 text-sm italic">Belum ada kursi sayap kanan.</p>
                        @endforelse
                    </div>

                </div>
            </div>

            {{-- Legenda --}}
            <div class="mt-6 flex justify-center gap-4 text-xs text-slate-500">
                <div class="flex items-center gap-1"><span class="w-3 h-3 rounded bg-slate-300 inline-block"></span>
                    Kosong</div>
                <div class="flex items-center gap-1"><span class="w-3 h-3 rounded bg-sky-500 inline-block"></span>
                    Terisi (warna sesuai fakultas)</div>
            </div>

        @endif
    </div>

    <script>
        function seatMapApp() {
            return {
                dipilih: null,
                seatIdTerpilih: null,

                pilihKursi(seatId, data) {
                    this.seatIdTerpilih = seatId;
                    this.dipilih = data;

                    this.$nextTick(() => {
                        const el = document.getElementById('seat-' + seatId);
                        if (el) {
                            el.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center',
                                inline: 'center'
                            });
                        }
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    });
                }
            }
        }
    </script>
</body>

</html>