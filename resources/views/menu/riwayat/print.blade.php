<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi PDF</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; font-size: 18px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #007bff; color: white; }
    </style>
</head>
<body>
    <div class="header">PT POS INDONESIA</div>
    <p><strong>Nama:</strong> {{ $userName }}</p>
    <p><strong>Asal Institusi:</strong> {{ $institution }}</p>
    <p style="text-align: center;"><strong>RIWAYAT KEHADIRAN</strong></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
            </tr>
        </thead>
        <tbody>
            @php $nomor = 1; @endphp
            @forelse ($attendances as $attendance)
            <tr>
                <td>{{ $nomor ++ }}</td> <!-- Menambahkan nomor urut -->
                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}</td>
                <td>
                    @if ($attendance->is_cancelled)
                        <span style="color: red;">Absen dibatalkan oleh sistem</span>
                    @else
                    {{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H:i A') : 'Riwayat Kosong' }}
                    @endif
                </td>
                <td>
                    @if ($attendance->is_cancelled)
                        <span style="color: red;">Absen dibatalkan oleh sistem</span>
                    @else
                    {{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i A') : 'Riwayat Kosong' }}
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="2">Tidak ada data absensi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
