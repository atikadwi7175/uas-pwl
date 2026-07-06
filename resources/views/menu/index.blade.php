@extends('layouts.app')

@section('title', 'Menu')

@section('content')
<div class="card">
    <h2>Daftar Menu</h2>
    <a href="{{ route('menu.create') }}" class="btn btn-primary" style="margin-top:10px;">+ Tambah Menu</a>

    <table>
        <tr>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        @forelse($menus as $menu)
        <tr>
            <td>
                @if($menu->gambar)
                    <img src="{{ Storage::url($menu->gambar) }}" width="60">
                @else
                    -
                @endif
            </td>
            <td>{{ $menu->nama }}</td>
            <td>{{ ucfirst($menu->kategori) }}</td>
            <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
            <td>
                <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-secondary">Edit</a>
                <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus menu ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5">Belum ada menu.</td></tr>
        @endforelse
    </table>
</div>
@endsection
