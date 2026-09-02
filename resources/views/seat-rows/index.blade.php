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

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 mb-6">
        <h3 class="text-base font-semibold text-gray-800 mb-4">Tambah Baris Baru</h3>
        <form method="POST" action="{{ route('sessions.seats.store', $session) }}"
            class="grid grid-cols-1 sm:grid-cols-4 gap-4 items-end">
            @csrf
            <div>
                <label for="row" class="block text-xs font-medium text-gray-700 mb-1">Nama Baris</label>
                <select id="row" name="row"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-sky-500 outline-none"
                    required>
                    <option value="" disabled selected>Pilih Baris</option>
                    @foreach ($allLetters as $letter)
                        <option value="{{ $letter }}" {{ old('row') == $letter ? 'selected' : '' }}
                            {{ in_array($letter, $usedLetters ?? []) ? 'class=bg-gray-100 text-gray-400' : '' }}>
                            Baris {{ $letter }} {{ in_array($letter, $usedLetters ?? []) ? '(Sudah Ada)' : '' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="side" class="block text-xs font-medium text-gray-700 mb-1">Sisi</label>
                <select id="side" name="side"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                    <option value="left" {{ old('side') == 'left' ? 'selected' : '' }}>Kiri</option>
                    <option value="right" {{ old('side') == 'right' ? 'selected' : '' }}>Kanan</option>
                </select>
            </div>
            <div>
                <label for="capacity" class="block text-xs font-medium text-gray-700 mb-1">Kapasitas</label>
                <input type="number" id="capacity" name="capacity" value="{{ old('capacity') }}" placeholder="Contoh: 20"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-sky-500 outline-none"
                    min="1" max="50" required>
            </div>
            <div>
                <button type="submit"
                    class="w-full px-4 py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition-colors">
                    Tambah Baris
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-sm text-left text-gray-900">
            <thead class="bg-gray-50 border-b border-gray-200 text-gray-700 uppercase font-semibold text-xs">
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
                        <td class="px-6 py-4 text-center text-gray-600">{{ $seatRow->capacity }}</td>
                        <td class="px-6 py-4 text-center font-medium text-gray-700">{{ $seatRow->seats->count() }}</td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <form method="POST" action="{{ route('seat-rows.destroy', $seatRow) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus?')"
                                    class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-400">Belum ada baris kursi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
