@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-800">Wisuda</h1>
        <a href="{{ route('graduation-events.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                <path fill-rule="evenodd"
                    d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                    clip-rule="evenodd" />
            </svg>
            Tambah Event
        </a>
    </div>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg border border-red-200">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($events as $event)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                <a href="{{ route('graduation-events.sessions.index', $event) }}" class="block">
                    <div class="flex items-center gap-3 mb-1">
                        <span class="text-2xl">🏛️</span>
                        <h3 class="font-semibold text-gray-900">{{ $event->name }}</h3>
                    </div>
                    <p class="text-sm text-gray-500 ml-11">{{ $event->sessions->count() }} sesi</p>
                </a>
                <div class="flex justify-end gap-2 mt-4 pt-3 border-t border-gray-100">
                    <a href="{{ route('graduation-events.edit', $event) }}"
                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md transition-colors">
                        Edit
                    </a>
                    <form method="POST" action="{{ route('graduation-events.destroy', $event) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Yakin hapus? Semua sesi & data di dalamnya ikut terhapus.')"
                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-md transition-colors">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-gray-400">
                Belum ada event wisuda. Klik "+ Tambah Event" untuk membuat yang pertama.
            </div>
        @endforelse
    </div>
@endsection
