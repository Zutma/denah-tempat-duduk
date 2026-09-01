@extends('layouts.app')

@section('content')
    <nav class="flex items-center gap-2 text-xs font-medium text-gray-500 mb-3">
        <a href="{{ route('graduation-events.index') }}" class="hover:text-sky-600 transition-colors">Wisuda</a>
        <span class="text-gray-300">/</span>
        <span class="text-gray-800 font-semibold">{{ $graduationEvent->name }}</span>
    </nav>
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-800">{{ $graduationEvent->name }}</h1>
        </div>
        <a href="{{ route('graduation-events.sessions.create', $graduationEvent) }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition-colors shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
            </svg>
            Tambah Sesi
        </a>
    </div>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <form id="bulkDeleteForm" method="POST" action="{{ route('sessions.bulkDestroy') }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4 border-b border-gray-200 bg-white flex justify-end items-center">
            <button type="button" onclick="submitBulkDelete()" class="px-3 py-1.5 bg-red-50 text-red-600 border border-red-200 rounded-md text-xs font-semibold hover:bg-red-100 hover:text-red-700 transition-colors">
                Hapus Terpilih
            </button>
        </div>

        <table class="w-full text-sm text-left text-gray-900">
            <thead class="bg-gray-50 border-b border-gray-200 text-gray-700 uppercase font-semibold text-xs">
                <tr>
                    <th class="px-4 py-3 text-center w-10">
                        <input type="checkbox" id="selectAll" class="w-4 h-4 text-sky-600 border-gray-300 rounded focus:ring-sky-500 cursor-pointer">
                    </th>
                    <th class="px-6 py-3 text-left">Tanggal</th>
                    <th class="px-6 py-3 text-center">Sesi Ke-</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($sessions as $session)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-4 text-center">
                            <input type="checkbox" class="rowCheckbox w-4 h-4 text-sky-600 border-gray-300 rounded focus:ring-sky-500 cursor-pointer" value="{{ $session->id }}">
                        </td>
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
                            <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-md border capitalize {{ $badge }}">
                                {{ $session->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                            <a href="{{ route('sessions.seats.index', $session) }}" class="text-gray-600 hover:text-gray-900 font-medium">🪑 Kursi</a>
                            <a href="{{ route('sessions.graduates.index', $session) }}" class="text-gray-600 hover:text-gray-900 font-medium">🎓 Wisudawan</a>
                            <a href="{{ route('sessions.edit', $session) }}" class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                            <form method="POST" action="{{ route('sessions.destroy', $session) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-400">Belum ada sesi untuk event ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Script Checkbox & Bulk Delete -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectAll = document.getElementById('selectAll');
            const rowCheckboxes = document.querySelectorAll('.rowCheckbox');

            if(selectAll) {
                selectAll.addEventListener('change', function() {
                    rowCheckboxes.forEach(cb => cb.checked = selectAll.checked);
                });

                rowCheckboxes.forEach(cb => {
                    cb.addEventListener('change', function() {
                        selectAll.checked = Array.from(rowCheckboxes).every(c => c.checked);
                    });
                });
            }
        });

        function submitBulkDelete() {
            const checked = document.querySelectorAll('.rowCheckbox:checked');
            if (checked.length === 0) {
                alert('Pilih minimal satu sesi yang mau dihapus!');
                return;
            }

            if (confirm(`Yakin mau hapus ${checked.length} sesi terpilih?`)) {
                const form = document.getElementById('bulkDeleteForm');
                checked.forEach(cb => {
                    const input = document.createElement('input');
                    input.type = 'hidden'; input.name = 'ids[]'; input.value = cb.value;
                    form.appendChild(input);
                });
                form.submit();
            }
        }
    </script>
@endsection