@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="card">
    <h2>Laporan Penjualan (Tren 2 Minggu Terakhir)</h2>

    <form method="GET" action="{{ route('laporan.index') }}" style="display:flex; gap:10px; align-items:flex-end; margin-top:10px;">
        <div>
            <label>Dari</label>
            <input type="date" name="dari" value="{{ $bulanMulai }}">
        </div>
        <div>
            <label>Sampai</label>
            <input type="date" name="sampai" value="{{ $bulanSampai }}">
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
</div>

<div class="card">
    <h3>Grafik Penjualan per Menu</h3>
    <canvas id="chartPenjualan" height="100"></canvas>
</div>

<div class="card">
    <h3>Tabel Penjualan</h3>
    <table>
        <tr>
            <th>Menu</th>
            <th>Jumlah Terjual</th>
            <th>Total Pendapatan</th>
        </tr>
        @forelse($data as $d)
        <tr>
            <td>{{ $d->menu->nama }}</td>
            <td>{{ $d->total_jumlah }}</td>
            <td>Rp {{ number_format($d->total_pendapatan, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr><td colspan="3">Tidak ada data pada rentang ini.</td></tr>
        @endforelse
    </table>

    <button id="btnCetak" class="btn btn-primary" style="margin-top:15px;">Cetak Laporan PDF</button>
    <span id="statusCetak" style="margin-left:10px; font-size:13px; color:#666;"></span>
</div>

<form id="formPdf" action="{{ route('laporan.pdf') }}" method="POST" style="display:none;">
    @csrf
    <input type="hidden" name="chart_path" id="chart_path">
    <input type="hidden" name="dari" value="{{ $bulanMulai }}">
    <input type="hidden" name="sampai" value="{{ $bulanSampai }}">
</form>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
    const labels = {!! json_encode($data->pluck('menu.nama')) !!};
    const jumlah = {!! json_encode($data->pluck('total_jumlah')) !!};

    const ctx = document.getElementById('chartPenjualan');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Terjual',
                data: jumlah,
                backgroundColor: '#3b2a1a'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });

    document.getElementById('btnCetak').addEventListener('click', async function () {
        const status = document.getElementById('statusCetak');
        status.textContent = 'Menyimpan grafik...';

        const chartImage = chart.toBase64Image('image/png', 1);

        try {
            const response = await fetch('{{ route('laporan.simpanGambar') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ chart_image: chartImage })
            });

            const result = await response.json();

            if (result.success) {
                status.textContent = 'Membuat PDF...';
                document.getElementById('chart_path').value = result.path;
                document.getElementById('formPdf').submit();
            } else {
                status.textContent = 'Gagal menyimpan grafik.';
            }
        } catch (err) {
            status.textContent = 'Terjadi kesalahan.';
        }
    });
</script>
@endsection
