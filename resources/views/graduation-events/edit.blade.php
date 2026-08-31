@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold text-gray-800 mb-6">Edit Event Wisuda</h1>

    <div class="p-6 rounded-xl shadow-sm border border-gray-200 bg-white">
        <form method="POST" action="{{ route('graduation-events.update', $graduationEvent) }}" class="flex flex-col gap-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Event</label>
                <input type="text" name="name" value="{{ old('name', $graduationEvent->name) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
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
                <a href="{{ route('graduation-events.index') }}"
                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm text-gray-600 hover:text-gray-800 font-medium transition-colors"><svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-1.5 px-6 py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition-colors shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
