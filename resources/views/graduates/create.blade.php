@extends('layouts.app')

@section('content')
    <nav class="flex items-center gap-2 text-xs font-medium text-gray-500 mb-3">
        <a href="{{ route('graduation-events.index') }}" class="hover:text-sky-600 transition-colors">Wisuda</a>
        <span class="text-gray-300">/</span>
        <a href="{{ route('graduation-events.sessions.index', $session->graduation_event_id) }}"
            class="hover:text-sky-600 transition-colors">
            {{ $session->event?->name ?? 'Detail Event' }}
        </a>
        <span class="text-gray-300">/</span>
        <a href="{{ route('sessions.graduates.index', $session) }}" class="hover:text-sky-600 transition-colors">Data
            Wisudawan</a>
        <span class="text-gray-300">/</span>
        <span class="text-gray-800 font-semibold">Tambah</span>
    </nav>

    <h1 class="text-xl font-bold text-gray-800 mb-6">
        Tambah Wisudawan — Sesi {{ \Carbon\Carbon::parse($session->date)->translatedFormat('d F Y') }}
    </h1>

    <div class="max-w-screen-2xl bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg border border-red-200">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('sessions.graduates.store', $session) }}">
            @csrf

            <div class="mb-4">
                <label for="nrp" class="block text-sm font-medium text-gray-700 mb-1">NRP</label>
                <input type="text" id="nrp" name="nrp" value="{{ old('nrp') }}"
                    placeholder="Contoh: 5025211001"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-sky-500 outline-none"
                    required>
            </div>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    placeholder="Nama: Malik Gntg"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-sky-500 outline-none"
                    required>
            </div>

            <div class="mb-4">
                <label for="faculty_id" class="block text-sm font-medium text-gray-700 mb-1">Fakultas</label>
                <select id="faculty_id" name="faculty_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-sky-500 outline-none"
                    required>
                    <option value="">-- Pilih Fakultas --</option>
                    @foreach ($faculties as $faculty)
                        <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>
                            {{ $faculty->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="study_program_id" class="block text-sm font-medium text-gray-700 mb-1">Program Studi</label>
                <select id="study_program_id" name="study_program_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-sky-500 outline-none"
                    required>
                    <option value="">-- Pilih Prodi --</option>
                    @foreach ($studyPrograms as $sp)
                        <option value="{{ $sp->id }}" {{ old('study_program_id') == $sp->id ? 'selected' : '' }}>
                            {{ $sp->name }} ({{ $sp->degree_level }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="seat_id" class="block text-sm font-medium text-gray-700 mb-1">Kursi (Opsional)</label>
                <select id="seat_id" name="seat_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                    <option value="">-- Belum Ditentukan --</option>
                    @foreach ($seats as $seat)
                        <option value="{{ $seat->id }}" {{ old('seat_id') == $seat->id ? 'selected' : '' }}>
                            Baris {{ $seat->seatRow->row }} {{ $seat->seatRow->side == 'left' ? 'Kiri' : 'Kanan' }} — No.
                            {{ $seat->number }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end space-x-3 pt-2">
                <a href="{{ route('sessions.graduates.index', $session) }}"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm text-gray-600 hover:text-gray-800 font-medium transition-colors"><svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-1.5 px-4 py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition-colors shadow-sm"><svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
