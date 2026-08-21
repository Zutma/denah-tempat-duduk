<p>
    <a href="{{ route('graduation-events.index') }}">Wisuda</a> &gt;
    Sesi {{ $session->date }} &gt;
    Data Wisudawan
</p>

<h1>Data Wisudawan — Sesi {{ $session->date }}</h1>

<a href="{{ route('sessions.graduates.create', $session) }}">+ Tambah Wisudawan</a>

<table border="1" cellpadding="8">
    <tr>
        <th>NRP</th>
        <th>Nama</th>
        <th>Fakultas</th>
        <th>Prodi</th>
        <th>Kursi</th>
        <th>Aksi</th>
    </tr>
    @foreach ($graduates as $graduate)
    <tr>
        <td>{{ $graduate->nrp }}</td>
        <td>{{ $graduate->name }}</td>
        <td>{{ $graduate->faculty->name }}</td>
        <td>{{ $graduate->studyProgram->name }}</td>
        <td>{{ $graduate->seat->number ?? '-' }}</td>
        <td>
            <form method="POST" action="{{ route('graduates.destroy', $graduate) }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>