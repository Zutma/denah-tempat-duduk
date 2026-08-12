<h1>Daftar Program Studi</h1>

<a href="{{ route('study-programs.create') }}">+ Tambah Program Studi</a>

<table border="1" cellpadding="8">
    <tr>
        <th>Nama Prodi</th>
        <th>Jenjang</th>
        <th>Fakultas</th>
        <th>Aksi</th>
    </tr>
    @foreach ($studyPrograms as $sp)
    <tr>
        <td>{{ $sp->name }}</td>
        <td>{{ $sp->degree_level }}</td>
        <td>{{ $sp->faculty->name }}</td>
        <td>
            <a href="{{ route('study-programs.edit', $sp) }}">Edit</a>
            <form method="POST" action="{{ route('study-programs.destroy', $sp) }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>