@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold text-gray-800 mb-6">Edit Sesi</h1>

    <div class="max-w-lg bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ route('sessions.update', $session) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" name="date" value="{{ old('date', $session->date) }}"
                    class="w-full border-gray-300 rounded-lg text-sm focus:ring-sky-500 focus:border-sky-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sesi Ke- (boleh kosong)</label>
                <input type="number" name="session" value="{{ old('session', $session->session) }}"
                    class="w-full border-gray-300 rounded-lg text-sm focus:ring-sky-500 focus:border-sky-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status"
                    class="w-full border-gray-300 rounded-lg text-sm focus:ring-sky-500 focus:border-sky-500">
                    <option value="draft" {{ $session->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ $session->status == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="archived" {{ $session->status == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
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
                <a href="{{ route('graduation-events.sessions.index', $session->graduation_event_id) }}"
                    class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Batal</a>
                <button type="submit"
                    class="px-4 py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition-colors">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection