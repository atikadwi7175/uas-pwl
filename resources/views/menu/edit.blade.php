@extends('layouts.app')

@section('title', 'Edit Menu')

@section('content')
<div class="card" style="max-width:500px;">
    <h2>Edit Menu</h2>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Nama Menu</label>
        <input type="text" name="nama" value="{{ old('nama', $menu->nama) }}" required>

        <label>Kategori</label>
        <select name="kategori" required>
            <option value="food" {{ old('kategori', $menu->kategori) == 'food' ? 'selected' : '' }}>Food</option>
            <option value="beverage" {{ old('kategori', $menu->kategori) == 'beverage' ? 'selected' : '' }}>Beverage</option>
        </select>

        <label>Deskripsi</label>
        <input type="text" name="deskripsi" value="{{ old('deskripsi', $menu->deskripsi) }}">

        <label>Harga</label>
        <input type="number" name="harga" value="{{ old('harga', $menu->harga) }}" required>

        @if($menu->gambar)
            <img src="{{ Storage::url($menu->gambar) }}" width="80" style="margin-top:10px;">
        @endif

        <label>Ganti Gambar (opsional)</label>
        <input type="file" name="gambar" accept="image/*">

        <button type="submit" class="btn btn-primary" style="margin-top:15px;">Update</button>
        <a href="{{ route('menu.index') }}" class="btn btn-secondary" style="margin-top:15px;">Batal</a>
    </form>
</div>
@endsection
