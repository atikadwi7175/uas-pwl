@extends('layouts.app')

@section('title', 'Tambah Menu')

@section('content')
<div class="card" style="max-width:500px;">
    <h2>Tambah Menu</h2>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Nama Menu</label>
        <input type="text" name="nama" value="{{ old('nama') }}" required>

        <label>Kategori</label>
        <select name="kategori" required>
            <option value="food" {{ old('kategori') == 'food' ? 'selected' : '' }}>Food</option>
            <option value="beverage" {{ old('kategori') == 'beverage' ? 'selected' : '' }}>Beverage</option>
        </select>

        <label>Deskripsi</label>
        <input type="text" name="deskripsi" value="{{ old('deskripsi') }}">

        <label>Harga</label>
        <input type="number" name="harga" value="{{ old('harga') }}" required>

        <label>Gambar</label>
        <input type="file" name="gambar" accept="image/*">

        <button type="submit" class="btn btn-primary" style="margin-top:15px;">Simpan</button>
        <a href="{{ route('menu.index') }}" class="btn btn-secondary" style="margin-top:15px;">Batal</a>
    </form>
</div>
@endsection
