@extends('layouts.app')

@section('content')
    <nav class="text-sm text-gray-500 mb-3">
        <a href="{{ route('graduation-events.index') }}" class="hover:text-sky-600">Wisuda</a>
        <span class="mx-1">/</span>
        <span class="text-gray-700 font-medium">{{ $graduationEvent->name }}</span>
    </nav>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-800">{{ $graduationEvent->name }}</h1>
        <a href="{{ route('graduation-events.sessions.create', $graduationEvent) }}"
            class="px-4 py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition-colors">
            + Tambah Sesi
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-sm text-left text-gray-900">
            <thead class="bg-gray-50 border-b border-gray-200 text-gray-700 uppercase font-semibold text-xs">
                <tr>
                    <th class="px-6 py-3 text-left">Tanggal</th>
                    <th class="px-6 py-3 text-center">Sesi Ke-</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($sessions as $session)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ \Carbon\Carbon::parse($session->date)->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-6 py-4 text-center text-gray-600">{{ $session->session ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $badge = [
                                    'draft' => 'bg-gray-100 text-gray-700 border-gray-200',
                                    'published' => 'bg-green-100 text-green-700 border-green-200',
                                    'archived' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                ][$session->status];
                            @endphp
                            <span
                                class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-md border capitalize {{ $badge }}">
                                {{ $session->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                            <a href="{{ route('sessions.seats.index', $session) }}" class="text-gray-600 hover:text-gray-900 font-medium">🪑 Kursi</a>
                            <a href="{{ route('sessions.graduates.index', $session) }}" class="text-gray-600 hover:text-gray-900 font-medium">🎓 Wisudawan</a>
                            <a href="{{ route('sessions.edit', $session) }}"
                                class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                            <form method="POST" action="{{ route('sessions.destroy', $session) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus?')"
                                    class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada sesi untuk event ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
