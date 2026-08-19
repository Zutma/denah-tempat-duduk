<h1>Edit Sesi</h1>

<form method="POST" action="{{ route('sessions.update', $session) }}">
    @csrf
    @method('PUT')

    <label>Tanggal:</label><br>
    <input type="date" name="date" value="{{ old('date', $session->date) }}"><br><br>

    <label>Sesi Ke- (boleh kosong):</label><br>
    <input type="number" name="session" value="{{ old('session', $session->session) }}"><br><br>

    <label>Status:</label><br>
    <select name="status">
        <option value="draft" {{ $session->status == 'draft' ? 'selected' : '' }}>Draft</option>
        <option value="published" {{ $session->status == 'published' ? 'selected' : '' }}>Published</option>
        <option value="archived" {{ $session->status == 'archived' ? 'selected' : '' }}>Archived</option>
    </select><br><br>

    <button type="submit">Update</button>
</form>