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
        <a href="{{ route('sessions.graduates.index', $session) }}" class="hover:text-sky-600">Wisudawan</a>
        <span class="mx-1">/</span>
        <span class="text-gray-700 font-medium">Tambah</span>
    </nav>

    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h1 class="text-xl font-bold text-gray-800 mb-6">
            Tambah Wisudawan — Sesi {{ \Carbon\Carbon::parse($session->date)->translatedFormat('d F Y') }}
        </h1>

        @if ($errors->any())
            <div class="p-4 mb-6 text-sm text-red-700 bg-red-100 rounded-lg border border-red-200">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('sessions.graduates.store', $session) }}" class="space-y-4">
            @csrf

            <div>
                <label for="nrp" class="block text-sm font-medium text-gray-700 mb-1">NRP</label>
                <input type="text" id="nrp" name="nrp" value="{{ old('nrp') }}" placeholder="Contoh: 5025211001"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-all" required>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nama Wisudawan"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-all" required>
            </div>

            <div>
                <label for="faculty_id" class="block text-sm font-medium text-gray-700 mb-1">Fakultas</label>
                <select id="faculty_id" name="faculty_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-all" required>
                    <option value="">-- Pilih Fakultas --</option>
                    @foreach ($faculties as $faculty)
                        <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>
                            {{ $faculty->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="study_program_id" class="block text-sm font-medium text-gray-700 mb-1">Program Studi</label>
                <select id="study_program_id" name="study_program_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-all" required>
                    <option value="">-- Pilih Prodi --</option>
                    @foreach ($studyPrograms as $sp)
                        <option value="{{ $sp->id }}" {{ old('study_program_id') == $sp->id ? 'selected' : '' }}>
                            {{ $sp->name }} ({{ $sp->degree_level }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="seat_id" class="block text-sm font-medium text-gray-700 mb-1">Kursi (Opsional)</label>
                <select id="seat_id" name="seat_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-all">
                    <option value="">-- Belum Ditentukan --</option>
                    @foreach ($seats as $seat)
                        <option value="{{ $seat->id }}" {{ old('seat_id') == $seat->id ? 'selected' : '' }}>
                            Baris {{ $seat->seatRow->row }} {{ $seat->seatRow->side == 'left' ? 'Kiri' : 'Kanan' }} — No. {{ $seat->number }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('sessions.graduates.index', $session) }}"
                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection