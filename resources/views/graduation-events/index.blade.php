@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-800">Daftar Event Wisuda</h1>
        <a href="{{ route('graduation-events.create') }}"
            class="px-4 py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition-colors">
            + Tambah Event
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
                    <th class="px-6 py-3 text-left">Nama Event</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($events as $event)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            <a href="#" class="hover:text-sky-600 transition-colors">{{ $event->name }}</a>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('graduation-events.edit', $event) }}"
                                class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                            <form method="POST" action="{{ route('graduation-events.destroy', $event) }}" class="inline">
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