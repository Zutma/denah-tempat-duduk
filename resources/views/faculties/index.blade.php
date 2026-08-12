<h1>Daftar Fakultas</h1>

<a href="{{ route('faculties.create') }}">Tambah Fakultas</a>

<table border="1" cellpadding="8">
    <tr>
        <th>Kode</th>
        <th>Nama</th>
        <th>Warna</th>
        <th>Aksi</th>
    </tr>
    @foreach ($faculties as $faculty)
    <tr>
        <td>{{ $faculty->code }}</td>
        <td>{{ $faculty->name }}</td>
        <td>{{ $faculty->color }}</td>
        <td>
            <a href="{{ route('faculties.edit', $faculty) }}">Edit</a>
            <form method="POST" action="{{ route('faculties.destroy', $faculty) }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('yakin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>