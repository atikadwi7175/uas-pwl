@extends('layouts.app')

@section('title', 'History Transaksi')

@section('content')
<div class="card">
    <h2>History Transaksi</h2>

    <table>
        <tr>
            <th>Tanggal</th>
            <th>Menu</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Kasir</th>
        </tr>
        @forelse($transaksis as $t)
        <tr>
            <td>{{ $t->tanggal }}</td>
            <td>{{ $t->menu->nama }}</td>
            <td>{{ $t->jumlah }}</td>
            <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
            <td>{{ $t->user->name }}</td>
        </tr>
        @empty
        <tr><td colspan="5">Belum ada transaksi.</td></tr>
        @endforelse
    </table>
</div>
@endsection
