@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Navigasi -->
    <nav class="text-sm text-gray-500 mb-3">
        <a href="{{ route('graduation-events.index') }}" class="hover:text-sky-600">Wisuda</a>
        <span class="mx-1">/</span>
        <a href="{{ route('graduation-events.sessions.index', $session->graduation_event_id ?? $session->graduationEvent) }}"
            class="hover:text-sky-600">
            Sesi {{ \Carbon\Carbon::parse($session->date)->translatedFormat('d F Y') }}
        </a>
        <span class="mx-1">/</span>
        <span class="text-gray-700 font-medium">Kelola Kursi</span>
    </nav>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-800">
            Kelola Kursi — Sesi {{ \Carbon\Carbon::parse($session->date)->translatedFormat('d F Y') }}
        </h1>
    </div>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 mb-6 text-sm text-red-700 bg-red-100 rounded-lg border border-red-200">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card Form Tambah Baris Baru -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 mb-6">
        <h3 class="text-base font-semibold text-gray-800 mb-4">Tambah Baris Baru</h3>
        <form method="POST" action="{{ route('sessions.seats.store', $session) }}"
            class="grid grid-cols-1 sm:grid-cols-4 gap-4 items-end">
            @csrf

            <div>
                <label for="row" class="block text-xs font-medium text-gray-700 mb-1">Nama Baris (1 huruf)</label>
                <input type="text" id="row" name="row" maxlength="1" value="{{ old('row') }}"
                    placeholder="A"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm uppercase focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-all"
                    required>
            </div>

            <div>
                <label for="side" class="block text-xs font-medium text-gray-700 mb-1">Sisi</label>
                <select id="side" name="side"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-all">
                    <option value="left" {{ old('side') == 'left' ? 'selected' : '' }}>Kiri</option>
                    <option value="right" {{ old('side') == 'right' ? 'selected' : '' }}>Kanan</option>
                </select>
            </div>

            <div>
                <label for="capacity" class="block text-xs font-medium text-gray-700 mb-1">Kapasitas</label>
                <input type="number" id="capacity" name="capacity" value="{{ old('capacity') }}" placeholder="10"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-all"
                    required>
            </div>

            <div>
                <button type="submit"
                    class="w-full px-4 py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition-colors">
                    + Tambah Baris
                </button>
            </div>
        </form>
    </div>

    <!-- Tabel Daftar Baris -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="font-semibold text-gray-800 text-sm">Daftar Baris Kursi</h3>
        </div>
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
                                <button type="submit"
                                    onclick="return confirm('Yakin hapus? Semua kursi di baris ini juga akan terhapus.')"
                                    class="text-red-600 hover:text-red-800 font-medium">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                            Belum ada baris kursi. Gunakan form di atas untuk menambah baris.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
