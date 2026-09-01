@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold text-gray-800">Daftar Fakultas</h1>
        <a href="{{ route('faculties.create') }}"
            class="inline-flex items-center gap-2 px-3 py-2 bg-sky-500 text-white rounded-lg text-sm font-medium hover:bg-sky-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                <path fill-rule="evenodd"
                    d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                    clip-rule="evenodd" />
            </svg>
            Tambah Fakultas
        </a>
    </div>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Tersembunyi untuk Bulk Delete -->
    <form id="bulkDeleteForm" method="POST" action="{{ route('faculties.bulkDestroy') }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        
        <!-- Header Aksi Massal -->
        <div class="p-4 border-b border-gray-200 bg-white flex justify-end items-center">
            <button type="button" onclick="submitBulkDelete()" class="px-3 py-1.5 bg-red-50 text-red-600 border border-red-200 rounded-md text-xs font-semibold hover:bg-red-100 hover:text-red-700 transition-colors">
                Hapus Terpilih
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-900">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-700 uppercase font-semibold text-xs">
                    <tr>
                        <th class="px-4 py-3 text-center w-10">
                            <input type="checkbox" id="selectAll" class="w-4 h-4 text-sky-600 border-gray-300 rounded focus:ring-sky-500 cursor-pointer">
                        </th>
                        <th class="px-6 py-3 text-left">Kode</th>
                        <th class="px-6 py-3 text-left">Nama Fakultas</th>
                        <th class="px-6 py-3 text-left">Warna</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($faculties as $faculty)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 text-center">
                                <input type="checkbox" class="rowCheckbox w-4 h-4 text-sky-600 border-gray-300 rounded focus:ring-sky-500 cursor-pointer" value="{{ $faculty->id }}">
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-800">{{ $faculty->code }}</td>
                            <td class="px-6 py-4">{{ $faculty->name }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <span class="inline-block w-4 h-4 rounded-full border border-gray-300 flex-shrink-0"
                                        style="background-color: {{ $faculty->color }}"></span>
                                    <span class="font-mono text-xs text-gray-600">{{ $faculty->color }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
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
                alert('Pilih minimal satu fakultas yang mau dihapus!');
                return;
            }

            if (confirm(`Yakin mau hapus ${checked.length} fakultas yang dipilih?`)) {
                const form = document.getElementById('bulkDeleteForm');
                checked.forEach(cb => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'ids[]';
                    input.value = cb.value;
                    form.appendChild(input);
                });
                form.submit();
            }
        }
    </script>
@endsection