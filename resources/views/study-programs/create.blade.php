<h1>Tambah Program Studi</h1>

<form method="POST" action="{{ route('study-programs.store') }}">
    @csrf

    <label>Fakultas:</label><br>
    <select name="faculty_id">
        <option value="">-- Pilih Fakultas --</option>
        @foreach ($faculties as $faculty)
            <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>
                {{ $faculty->name }}
            </option>
        @endforeach
    </select><br><br>

    <label>Nama Prodi:</label><br>
    <input type="text" name="name" value="{{ old('name') }}"><br><br>

    <label>Jenjang (S1/S2/S3/D4):</label><br>
    <input type="text" name="degree_level" value="{{ old('degree_level') }}"><br><br>

    <button type="submit">Simpan</button>
</form>

@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif