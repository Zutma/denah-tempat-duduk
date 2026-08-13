@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-800">Daftar Fakultas</h1>
        <a href="{{ route('faculties.create') }}"
            class="px-4 py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition-colors">
            + Tambah Fakultas
        </a>
    </div>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-sm text-left text-gray-900">
            <thead class="bg-gray-50 border-b border-gray-200 text-gray-700 uppercase font-semibold text-xs">
                <tr>
                    <th class="px-6 py-3 text-left">Kode</th>
                    <th class="px-6 py-3 text-left">Nama Fakultas</th>
                    <th class="px-6 py-3 text-left">Warna</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($faculties as $faculty)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $faculty->code }}</td>
                        <td class="px-6 py-4">{{ $faculty->name }}</td>
                        <td class="px-6 py-4">
                            <!-- Alignment fleksibel agar lingkaran dan kode hex tegak lurus sejajar -->
                            <div class="flex items-center space-x-2">
                                <span class="inline-block w-4 h-4 rounded-full border border-gray-300 flex-shrink-0"
                                    style="background-color: {{ $faculty->color }}"></span>
                                <span class="font-mono text-xs text-gray-600">{{ $faculty->color }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('faculties.edit', $faculty) }}"
                                class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                            <form method="POST" action="{{ route('faculties.destroy', $faculty) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus?')"
                                    class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
