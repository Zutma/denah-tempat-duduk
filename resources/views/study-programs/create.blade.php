@extends('dashboard')

@section('content')
    <!-- Header Halaman -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-800">Tambah Program Studi</h1>
        <a href="{{ route('study-programs.index') }}"
            class="px-4 py-2 text-sm bg-sky-500 text-white rounded-lg font-medium hover:bg-sky-600 transition-colors">&lt;
            Kembali</a>
    </div>

    <!-- Card Form -->
    <div class="p-6 rounded-xl shadow-sm border border-gray-200 bg-white">
        <form method="POST" action="{{ route('study-programs.store') }}" class="flex flex-col gap-4">
            @csrf

            <!-- GRID 50/50: Fakultas dan Jenjang Bersebelahan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="faculty_id" class="block text-sm font-medium text-gray-700 mb-1">Fakultas</label>
                    <select id="faculty_id" name="faculty_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white">
                        <option value="">-- Pilih Fakultas --</option>
                        @foreach ($faculties as $faculty)
                            <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>
                                {{ $faculty->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="degree_level" class="block text-sm font-medium text-gray-700 mb-1">Jenjang
                        (S1/S2/S3/D4)</label>
                    <input type="text" id="degree_level" name="degree_level" value="{{ old('degree_level') }}"
                        placeholder="Contoh: S1"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 uppercase">
                </div>
            </div>

            <!-- Input Nama Prodi -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Prodi</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    placeholder="Masukkan Nama Program Studi"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>

            <!-- Tombol Submit -->
            <div class="pt-2">
                <button type="submit"
                    class="w-full py-2.5 bg-sky-500 hover:bg-sky-600 text-white font-medium text-sm rounded-lg shadow-sm transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <!-- Pesan Error -->
    @if ($errors->any())
        <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
