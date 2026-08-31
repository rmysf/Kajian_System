<h1>Detail Kajian: {{ $kajian->title }}</h1>

<table border="1" cellpadding="5">
    <tr>
        <th>Kategori</th>
        <td>{{ $kajian->category->name ?? '-' }}</td>
    </tr>
    <tr>
        <th>Masjid</th>
        <td>{{ $kajian->mosque->name ?? '-' }}</td>
    </tr>
    <tr>
        <th>Pemateri</th>
        <td>{{ $kajian->speaker->name ?? '-' }}</td>
    </tr>
    <tr>
        <th>Waktu Mulai</th>
        <td>{{ $kajian->start_at }}</td>
    </tr>
    <tr>
        <th>Waktu Selesai</th>
        <td>{{ $kajian->end_at }}</td>
    </tr>
    <tr>
        <th>Audiens</th>
        <td>{{ $kajian->audience }}</td>
    </tr>
    <tr>
        <th>Alamat Lengkap</th>
        <td>{{ $kajian->address }}</td>
    </tr>
    <tr>
        <th>Koordinat (Lat, Lng)</th>
        <td>{{ $kajian->latitude }}, {{ $kajian->longitude }}</td>
    </tr>
    <tr>
        <th>QR Check-in (Untuk Jamaah)</th>
        <td>
            <div style="margin-top: 10px; margin-bottom: 10px;">
                {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate(url('/checkin/' . $kajian->uuid)) !!}
            </div>
            <small><a href="{{ url('/checkin/' . $kajian->uuid) }}">{{ url('/checkin/' . $kajian->uuid) }}</a></small>
        </td>
    </tr>
</table>

<br>
<a href="{{ route('organizer.kajian.edit', $kajian->slug) }}">Edit</a> |
<a href="{{ route('organizer.kajian.index') }}">Kembali ke Daftar</a>

