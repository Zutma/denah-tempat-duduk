<p>
    <a href="{{ route('graduation-events.index') }}">Wisuda</a> &gt;
    {{ $graduationEvent->name }}
</p>

<h1>Daftar Sesi — {{ $graduationEvent->name }}</h1>

<a href="{{ route('graduation-events.sessions.create', $graduationEvent) }}">+ Tambah Sesi</a>

<table border="1" cellpadding="8">
    <tr>
        <th>Tanggal</th>
        <th>Sesi Ke-</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    @foreach ($sessions as $session)
    <tr>
        <td>{{ $session->date }}</td>
        <td>{{ $session->session ?? '-' }}</td>
        <td>{{ $session->status }}</td>
        <td>
            <a href="#">Kelola Kursi</a> |
            <a href="#">Data Wisudawan</a> |
            <a href="{{ route('sessions.edit', $session) }}">Edit</a>
            <form method="POST" action="{{ route('sessions.destroy', $session) }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>