<h1>Tambah Wisudawan — Sesi {{ $session->date }}</h1>

<form method="POST" action="{{ route('sessions.graduates.store', $session) }}">
    @csrf

    <label>NRP:</label><br>
    <input type="text" name="nrp" value="{{ old('nrp') }}"><br><br>

    <label>Nama:</label><br>
    <input type="text" name="name" value="{{ old('name') }}"><br><br>

    <label>Fakultas:</label><br>
    <select name="faculty_id">
        <option value="">-- Pilih Fakultas --</option>
        @foreach ($faculties as $faculty)
            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
        @endforeach
    </select><br><br>

    <label>Program Studi:</label><br>
    <select name="study_program_id">
        <option value="">-- Pilih Prodi --</option>
        @foreach ($studyPrograms as $sp)
            <option value="{{ $sp->id }}">{{ $sp->name }}</option>
        @endforeach
    </select><br><br>

    <label>Kursi (opsional):</label><br>
    <select name="seat_id">
        <option value="">-- Belum Ditentukan --</option>
        @foreach ($seats as $seat)
            <option value="{{ $seat->id }}">
                Baris {{ $seat->seatRow->row }} {{ $seat->seatRow->side == 'left' ? 'Kiri' : 'Kanan' }} — No.
                {{ $seat->number }}
            </option>
        @endforeach
    </select><br><br>

    <button type="submit">Simpan</button>
</form>

@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
