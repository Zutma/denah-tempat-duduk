@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-800">Daftar Program Studi</h1>
        <a href="{{ route('study-programs.create') }}"
            class="px-4 py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition-colors">
            + Tambah Program Studi
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
                    <!-- DITAMBAHKAN px-6 py-3 YANG SEBELUMNYA HILANG -->
                    <th class="px-6 py-3 text-left">Nama Prodi</th>
                    <th class="px-6 py-3 text-center">Jenjang</th>
                    <th class="px-6 py-3 text-left">Fakultas</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($studyPrograms as $sp)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $sp->name }}</td>
                        <!-- Jenjang dibuat rata tengah (text-center) agar seimbang -->
                        <td class="px-6 py-4 text-center">
                            <span
                                class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-md bg-gray-100 text-gray-800 border border-gray-200">
                                {{ $sp->degree_level }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $sp->faculty->name }}</td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('study-programs.edit', $sp) }}"
                                class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                            <form method="POST" action="{{ route('study-programs.destroy', $sp) }}" class="inline">
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
