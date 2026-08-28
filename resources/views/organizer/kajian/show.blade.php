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
</table>

<br>
<a href="{{ route('organizer.kajian.edit', $kajian->slug) }}">Edit</a> |
<a href="{{ route('organizer.kajian.index') }}">Kembali ke Daftar</a>
