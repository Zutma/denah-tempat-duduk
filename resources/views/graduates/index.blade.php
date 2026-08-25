@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Navigasi -->
    <nav class="text-sm text-gray-500 mb-3">
        <a href="{{ route('graduation-events.index') }}" class="hover:text-sky-600">Wisuda</a>
        <span class="mx-1">/</span>
        <a href="{{ route('graduation-events.sessions.index', $session->graduation_event_id ?? $session->graduationEvent) }}" class="hover:text-sky-600">
            Sesi {{ \Carbon\Carbon::parse($session->date)->translatedFormat('d F Y') }}
        </a>
        <span class="mx-1">/</span>
        <span class="text-gray-700 font-medium">Data Wisudawan</span>
    </nav>

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <h1 class="text-xl font-bold text-gray-800">
            Data Wisudawan — Sesi {{ \Carbon\Carbon::parse($session->date)->translatedFormat('d F Y') }}
        </h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('sessions.graduates.create', $session) }}"
                class="px-4 py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition-colors">
                + Tambah Wisudawan
            </a>
        </div>
    </div>

    <!-- Alert Success -->
    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <!-- Alert Errors / Validasi Upload -->
    @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg border border-red-200">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Alert Import Failed Rows -->
    @if (session('failed') && count(session('failed')) > 0)
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg border border-red-200">
            <p class="font-semibold mb-1">Beberapa data gagal diimport:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach (session('failed') as $fail)
                    <li>{{ $fail }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card Form Import Excel -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 mb-6">
        <h3 class="text-sm font-semibold text-gray-800 mb-3">📥 Import Data Wisudawan (Excel)</h3>
        <form method="POST" action="{{ route('sessions.import.store', $session) }}" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            @csrf
            <input type="file" name="file" accept=".xlsx,.xls"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100 transition-all border border-gray-300 rounded-lg cursor-pointer" required>
            <button type="submit"
                class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition-colors whitespace-nowrap">
                Upload & Import
            </button>
        </form>
    </div>

    <!-- Tabel Data Wisudawan -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-900">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-700 uppercase font-semibold text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">NRP</th>
                        <th class="px-6 py-3 text-left">Nama</th>
                        <th class="px-6 py-3 text-left">Fakultas</th>
                        <th class="px-6 py-3 text-center">Jenjang</th>
                        <th class="px-6 py-3 text-left">Prodi</th>
                        <th class="px-6 py-3 text-center">Baris</th>
                        <th class="px-6 py-3 text-center">Sisi</th>
                        <th class="px-6 py-3 text-center">No. Kursi (Lokal)</th>
                        <th class="px-6 py-3 text-center">No. Kursi (Global)</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($graduates as $graduate)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs font-semibold text-gray-800">{{ $graduate->nrp }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $graduate->name }}</td>
                            <td class="px-6 py-4">{{ $graduate->faculty->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded bg-gray-100 text-gray-700 border border-gray-200">
                                    {{ $graduate->studyProgram->degree_level ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $graduate->studyProgram->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-center font-bold text-gray-800">{{ $graduate->seat->seatRow->row ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                @if(optional($graduate->seat->seatRow)->side)
                                    <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded {{ $graduate->seat->seatRow->side == 'left' ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-purple-50 text-purple-700 border border-purple-200' }}">
                                        {{ $graduate->seat->seatRow->side == 'left' ? 'Kiri' : 'Kanan' }}
                                    </span>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center text-gray-600">{{ $graduate->seat->position ?? '-' }}</td>
                            <td class="px-6 py-4 text-center font-semibold text-gray-700">{{ $graduate->seat->number ?? '-' }}</td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <form method="POST" action="{{ route('graduates.destroy', $graduate) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus data wisudawan ini?')"
                                        class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-6 py-8 text-center text-gray-400">
                                Belum ada data wisudawan untuk sesi ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection