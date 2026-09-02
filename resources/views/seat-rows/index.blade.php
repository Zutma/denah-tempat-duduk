@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Level 2 -->
    <nav class="flex items-center gap-2 text-xs font-medium text-gray-500 mb-3">
        <a href="{{ route('graduation-events.index') }}" class="hover:text-sky-600 transition-colors">Wisuda</a>
        <span class="text-gray-300">/</span>
        <a href="{{ route('graduation-events.sessions.index', $session->graduation_event_id) }}"
            class="hover:text-sky-600 transition-colors">
            {{ $session->event?->name ?? 'Detail Event' }}
        </a>
        <span class="text-gray-300">/</span>
        <span class="text-gray-800 font-semibold">Kelola Kursi</span>
    </nav>

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-800">
                Kelola Kursi — Sesi {{ \Carbon\Carbon::parse($session->date)->translatedFormat('d F Y') }}
            </h1>
        </div>
    </div>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg border border-red-200">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM BATCH GENERATE (Alpine.js) -->
    <div x-data="batchSeatManager()" class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 mb-6">
        <div class="flex items-center justify-between gap-4 mb-4">
            <h3 class="text-base font-bold text-gray-800">Buat Baris Kursi</h3>

            <button type="button" @click="addRow()"
                class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-sky-500 hover:bg-sky-600 rounded-lg shadow-sm transition-colors cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Tambah Baris Input</span>
            </button>
        </div>

        <form method="POST" action="{{ route('sessions.seats.store', $session) }}" x-show="rows.length > 0" x-cloak>
            @csrf

            <div class="overflow-x-auto mb-4 border border-gray-200 rounded-lg">
                <table class="w-full text-sm text-left border-collapse">
                    <thead
                        class="bg-gray-50 text-gray-700 uppercase text-[11px] font-bold tracking-wider border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 w-44">Baris</th>
                            <th class="px-4 py-3">Kapasitas Kiri</th>
                            <th class="px-4 py-3">Kapasitas Kanan</th>
                            <th class="px-4 py-3 text-center w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <template x-for="(item, index) in rows" :key="index">
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="p-3">
                                    <select :name="`rows[${index}][row]`" x-model="item.row"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-800 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-all"
                                        required>
                                        <option value="" disabled>Pilih Baris</option>
                                        @foreach ($allLetters as $letter)
                                            <option value="{{ $letter }}"
                                                :disabled="usedLetters.includes('{{ $letter }}')"
                                                class="{{ in_array($letter, $usedLetters ?? []) ? 'bg-gray-100 text-gray-400 font-normal' : '' }}">
                                                Baris {{ $letter }}
                                                {{ in_array($letter, $usedLetters ?? []) ? '(Sudah Ada)' : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="p-3">
                                    <input type="number" :name="`rows[${index}][left_capacity]`"
                                        x-model.number="item.left_capacity" placeholder="20" min="0" max="100"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-800 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-all"
                                        required>
                                </td>
                                <td class="p-3">
                                    <input type="number" :name="`rows[${index}][right_capacity]`"
                                        x-model.number="item.right_capacity" placeholder="20" min="0" max="100"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-800 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-all"
                                        required>
                                </td>
                                <td class="p-3 text-center whitespace-nowrap">
                                    <button type="button" @click="removeRow(index)"
                                        class="inline-flex items-center text-xs font-semibold text-red-600 hover:text-red-800 hover:underline transition-colors">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end pt-3 border-t border-gray-100">
                <button type="submit"
                    class="px-4 py-2.5 bg-sky-500 hover:bg-sky-600 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors">
                    Simpan Semua Baris
                </button>
            </div>
        </form>
    </div>

    <!-- TABEL DAFTAR BARIS YANG SUDAH TER-GENERATE -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-sm text-left text-gray-900">
            <thead class="bg-gray-50 border-b border-gray-200 text-gray-700 uppercase font-bold text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-3 text-left">Baris</th>
                    <th class="px-6 py-3 text-center">Sisi</th>
                    <th class="px-6 py-3 text-center">Kapasitas</th>
                    <th class="px-6 py-3 text-center">Kursi Ter-generate</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($seatRows as $seatRow)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-bold text-gray-900">{{ $seatRow->row }}</td>
                        <td class="px-6 py-4 text-center">
                            <span
                                class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-md border {{ $seatRow->side == 'left' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'bg-purple-50 text-purple-700 border-purple-200' }}">
                                {{ $seatRow->side == 'left' ? 'Kiri' : 'Kanan' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center text-gray-600 font-medium">{{ $seatRow->capacity }}</td>
                        <td class="px-6 py-4 text-center font-semibold text-gray-800">{{ $seatRow->seats->count() }}</td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <form method="POST" action="{{ route('seat-rows.destroy', $seatRow) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus?')"
                                    class="text-xs font-semibold text-red-600 hover:text-red-800 transition-colors">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-xs text-gray-400 italic">Belum ada baris kursi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Script Alpine.js Manager -->
    <script>
        function batchSeatManager() {
            return {
                allLetters: @json($allLetters),
                usedLetters: @json($usedLetters ?? []),
                rows: [],
                init() {
                    this.rows = [];
                },
                addRow() {
                    let lastRow = this.rows.length > 0 ? this.rows[this.rows.length - 1].row : '';
                    let currentIndex = lastRow ? this.allLetters.indexOf(lastRow) : -1;

                    let nextLetter = '';
                    for (let i = currentIndex + 1; i < this.allLetters.length; i++) {
                        let letter = this.allLetters[i];
                        let isAlreadyAddedInForm = this.rows.some(r => r.row === letter);

                        if (!this.usedLetters.includes(letter) && !isAlreadyAddedInForm) {
                            nextLetter = letter;
                            break;
                        }
                    }

                    if (!nextLetter) {
                        nextLetter = this.allLetters.find(l =>
                            !this.usedLetters.includes(l) && !this.rows.some(r => r.row === l)
                        ) || 'A';
                    }

                    this.rows.push({
                        row: nextLetter,
                        left_capacity: 20,
                        right_capacity: 20
                    });
                },
                removeRow(index) {
                    this.rows.splice(index, 1);
                }
            }
        }
    </script>
@endsection