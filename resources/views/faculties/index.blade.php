<h1>Daftar Fakultas</h1>

<table border="1" cellpadding="8">
    <tr>
        <th>Kode</th>
        <th>Nama</th>
        <th>Warna</th>
    </tr>
    @foreach ($faculties as $faculty)
    <tr>
        <td>{{ $faculty->code }}</td>
        <td>{{ $faculty->name }}</td>
        <td>{{ $faculty->color }}</td>
    </tr>
    @endforeach
</table>