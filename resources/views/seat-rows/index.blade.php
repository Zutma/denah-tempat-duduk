<p>
    <a href="{{ route('graduation-events.index') }}">Wisuda</a> &gt;
    Sesi {{ $session->date }} &gt;
    Kelola Kursi
</p>

<h1>Kelola Kursi — Sesi {{ $session->date }}</h1>

<h3>Tambah Baris Baru</h3>
<form method="POST" action="{{ route('sessions.seats.store', $session) }}">
    @csrf

    <label>Nama Baris (1 huruf):</label>
    <input type="text" name="row" maxlength="1" value="{{ old('row') }}">

    <label>Sisi:</label>
    <select name="side">
        <option value="left">Kiri</option>
        <option value="right">Kanan</option>
    </select>

    <label>Kapasitas:</label>
    <input type="number" name="capacity" value="{{ old('capacity') }}">

    <button type="submit">Tambah Baris</button>
</form>

@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<hr>

<h3>Daftar Baris</h3>
<table border="1" cellpadding="8">
    <tr>
        <th>Baris</th>
        <th>Sisi</th>
        <th>Kapasitas</th>
        <th>Jumlah Kursi Ter-generate</th>
        <th>Aksi</th>
    </tr>
    @foreach ($seatRows as $seatRow)
    <tr>
        <td>{{ $seatRow->row }}</td>
        <td>{{ $seatRow->side == 'left' ? 'Kiri' : 'Kanan' }}</td>
        <td>{{ $seatRow->capacity }}</td>
        <td>{{ $seatRow->seats->count() }}</td>
        <td>
            <form method="POST" action="{{ route('seat-rows.destroy', $seatRow) }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus? Semua kursi di baris ini juga akan terhapus.')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>