@extends('dashboard')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-800">Tambah Fakultas</h1>
        <a href="{{ route('faculties.index') }}"
            class="px-4 py-2 text-sm bg-sky-500 text-white rounded-lg font-medium hover:bg-sky-600 transition-colors">&lt;
            Kembali</a>
    </div>

    <div class="p-6 rounded-xl shadow-sm border border-gray-200 bg-white">
        <form method="POST" action="{{ route('faculties.store') }}" class="flex flex-col gap-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Kode : </label>
                    <input type="text" name="code" value="{{ old('code') }}" placeholder="Masukkan Kode Fakultas"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 uppercase font-semibold"><br>
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama : </label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Fakultas"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-sky-500"><br>
                </div>
            </div>

            <div x-data="{ hexColor: '{{ old('color', $faculty->color ?? '#ffffff') }}' }">
                <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Warna Hex (opsional)</label>
                <div class="flex items-center space-x-2">
                    <input type="color" x-model="hexColor"
                        class="h-9 w-10 p-0.5 border border-gray-300 rounded-lg cursor-pointer bg-white">

                    <input type="text" id="color" name="color" x-model="hexColor" placeholder="#ffffff"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                </div>
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="w-full py-2.5 bg-sky-500 hover:bg-sky-600 text-white font-medium text-sm rounded-lg shadow-sm transition-colors">
                    >Simpan
                </button>
            </div>
        </form>
    </div>

    @if ($errors->any())
        <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
