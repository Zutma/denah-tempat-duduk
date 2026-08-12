<h1>Edit Fakultas</h1>

<a href="{{ route('faculties.index') }}">Kembali</a>

<form action="{{ route('faculties.update', $faculty) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="code">Kode : </label>
    <input type="text" name="code" value="{{ old('code', $faculty->code) }}" placeholder="Masukkan Kode Fakultas"><br>

    <label for="name">Nama : </label>
    <input type="text" name="name" value="{{ old('name', $faculty->name) }}" placeholder="Masukkan Nama Fakultas"><br>

    <label for="color">Warna Hex (opsional) : </label>
    <input type="text" name="color" value="{{ old('color', $faculty->color) }}" placeholder="Masukkan Warna Hex"><br>

    <button type="submit">Update</button>
</form>

@if ($errors->any())
    <ul style="color: red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif