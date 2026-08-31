@extends('layouts.app')

@section('content')
    <nav class="flex items-center gap-2 text-xs font-medium text-gray-500 mb-3">
        <a href="{{ route('graduation-events.index') }}" class="hover:text-sky-600 transition-colors">Wisuda</a>
        <span class="text-gray-300">/</span>
        <a href="{{ route('graduation-events.sessions.index', $graduationEvent) }}" class="hover:text-sky-600 transition-colors">
            {{ $graduationEvent->name }}
        </a>
        <span class="text-gray-300">/</span>
        <span class="text-gray-800 font-semibold">Tambah Sesi</span>
    </nav>

    <h1 class="text-xl font-bold text-gray-800 mb-6">Tambah Sesi — {{ $graduationEvent->name }}</h1>

    <div class="p-6 rounded-xl shadow-sm border border-gray-200 bg-white">
        <form method="POST" action="{{ route('graduation-events.sessions.store', $graduationEvent) }}" class="flex flex-col gap-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="date" value="{{ old('date') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sesi Ke- (boleh kosong)</label>
                    <input type="number" name="session" value="{{ old('session') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>
            </div>

            @if ($errors->any())
                <div class="p-3 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('graduation-events.sessions.index', $graduationEvent) }}"
                    class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800 font-medium transition-colors">Batal</a>
                <button type="submit"
                    class="px-6 py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition-colors shadow-sm">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection