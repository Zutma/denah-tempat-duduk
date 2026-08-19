<h1>Tambah Sesi — {{ $graduationEvent->name }}</h1>

<form method="POST" action="{{ route('graduation-events.sessions.store', $graduationEvent) }}">
    @csrf

    <label>Tanggal:</label><br>
    <input type="date" name="date" value="{{ old('date') }}"><br><br>

    <label>Sesi Ke- (boleh kosong):</label><br>
    <input type="number" name="session" value="{{ old('session') }}"><br><br>

    <label>Status:</label><br>
    <select name="status">
        <option value="draft">Draft</option>
        <option value="published">Published</option>
        <option value="archived">Archived</option>
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