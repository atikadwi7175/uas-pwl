<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        h2 { margin-bottom: 5px; }
        .periode { margin-bottom: 15px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; text-align: left; }
        th { background: #f0f0f0; }
        img.chart { width: 100%; max-width: 500px; margin-top: 10px; }
    </style>
</head>
<body>
    <h2>Laporan Penjualan Kopi</h2>
    <div class="periode">Periode: {{ $bulanMulai }} s/d {{ $bulanSampai }}</div>

    <img class="chart" src="{{ $chartFullPath }}">

    <table>
        <tr>
            <th>Menu</th>
            <th>Jumlah Terjual</th>
            <th>Total Pendapatan</th>
        </tr>
        @foreach($data as $d)
        <tr>
            <td>{{ $d->menu->nama }}</td>
            <td>{{ $d->total_jumlah }}</td>
            <td>Rp {{ number_format($d->total_pendapatan, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
