@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h1 class="text-xl font-bold text-gray-800 mb-6">Edit Event Wisuda</h1>

        @if ($errors->any())
            <div class="p-4 mb-6 text-sm text-red-700 bg-red-100 rounded-lg border border-red-200">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('graduation-events.update', $graduationEvent) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Event</label>
                <input type="text" id="name" name="name" value="{{ old('name', $graduationEvent->name) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-all"
                    required>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('graduation-events.index') }}"
                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition-colors">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection