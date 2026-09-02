@php
    $graduate = $seat->graduate;
    $color = $graduate && $graduate->faculty && $graduate->faculty->color ? $graduate->faculty->color : '#e2e8f0';

    $data = $graduate
        ? [
            'seat_id' => $seat->id,
            'seat_code' => $row->row . sprintf('%02d', $seat->number),
            'name' => $graduate->name,
            'nrp' => $graduate->nrp,
            'prodi' => $graduate->studyProgram->name ?? '-',
            'faculty' => $graduate->faculty->name ?? '-',
        ]
        : null;
@endphp

<button type="button" id="seat-{{ $seat->id }}"
    @if ($data) @click="pilihKursi({{ $seat->id }}, {{ json_encode($data) }})" @endif
    :class="{ 'seat-selected': seatIdTerpilih === {{ $seat->id }} }"
    class="w-11 h-11 rounded-lg flex items-center justify-center font-bold text-xs shadow"
    style="background-color: {{ $graduate ? $color : '#e2e8f0' }}; color: {{ $graduate ? '#fff' : '#64748b' }};">
    {{ $row->row }}{{ sprintf('%02d', $seat->number) }}
</button>
