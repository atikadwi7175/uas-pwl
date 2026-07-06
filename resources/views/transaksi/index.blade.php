@extends('layouts.app')

@section('title', 'Index Menu')

@section('content')

<style>
    .menu-section { margin-bottom: 30px; }
    .menu-section h3 { margin-bottom: 12px; }
    .menu-scroll {
        display: flex;
        gap: 15px;
        overflow-x: auto;
        padding-bottom: 10px;
        scroll-snap-type: x mandatory;
    }
    .menu-scroll::-webkit-scrollbar { height: 6px; }
    .menu-scroll::-webkit-scrollbar-thumb { background: #ccc; border-radius: 3px; }

    .menu-card {
        position: relative;
        flex: 0 0 auto;
        width: calc((100% - 4 * 15px) / 5); /* 5 card terlihat, sisanya di-swipe */
        min-width: 160px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        scroll-snap-align: start;
        overflow: hidden;
    }
    .menu-card img {
        width: 100%;
        height: 110px;
        object-fit: cover;
        display: block;
        background: #eee;
    }
    .menu-card .no-image {
        width: 100%;
        height: 110px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e8e0d5;
        color: #a08b6f;
        font-size: 13px;
    }
    .menu-card-body { padding: 10px; }
    .menu-card-body .nama { font-weight: bold; font-size: 14px; margin-bottom: 4px; }
    .menu-card-body .deskripsi { font-size: 12px; color: #777; margin-bottom: 6px; min-height: 30px; }
    .menu-card-body .harga { font-size: 13px; color: #3b2a1a; font-weight: bold; }

    .btn-add {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #3b2a1a;
        color: #fff;
        border: none;
        font-size: 16px;
        line-height: 1;
        cursor: pointer;
    }

    /* Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.5);
        align-items: center;
        justify-content: center;
        z-index: 100;
    }
    .modal-overlay.active { display: flex; }
    .modal-box {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        width: 100%;
        max-width: 350px;
    }
    .modal-box h3 { margin-bottom: 10px; }
    .modal-close {
        float: right;
        cursor: pointer;
        font-size: 18px;
        color: #888;
    }
</style>

<div class="menu-section">
    <h3>Food</h3>
    <div class="menu-scroll">
        @forelse($foods as $menu)
        <div class="menu-card">
            <button type="button" class="btn-add" onclick="bukaModal({{ $menu->id }}, '{{ $menu->nama }}', {{ $menu->harga }})">+</button>
            @if($menu->gambar)
                <img src="{{ Storage::url($menu->gambar) }}" alt="{{ $menu->nama }}">
            @else
                <div class="no-image">Tidak ada gambar</div>
            @endif
            <div class="menu-card-body">
                <div class="nama">{{ $menu->nama }}</div>
                <div class="deskripsi">{{ $menu->deskripsi }}</div>
                <div class="harga">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
            </div>
        </div>
        @empty
        <p>Belum ada menu food.</p>
        @endforelse
    </div>
</div>

<div class="menu-section">
    <h3>Beverage</h3>
    <div class="menu-scroll">
        @forelse($beverages as $menu)
        <div class="menu-card">
            <button type="button" class="btn-add" onclick="bukaModal({{ $menu->id }}, '{{ $menu->nama }}', {{ $menu->harga }})">+</button>
            @if($menu->gambar)
                <img src="{{ Storage::url($menu->gambar) }}" alt="{{ $menu->nama }}">
            @else
                <div class="no-image">Tidak ada gambar</div>
            @endif
            <div class="menu-card-body">
                <div class="nama">{{ $menu->nama }}</div>
                <div class="deskripsi">{{ $menu->deskripsi }}</div>
                <div class="harga">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
            </div>
        </div>
        @empty
        <p>Belum ada menu beverage.</p>
        @endforelse
    </div>
</div>

<!-- Modal Input Transaksi -->
<div class="modal-overlay" id="modalTransaksi">
    <div class="modal-box">
        <span class="modal-close" onclick="tutupModal()">&times;</span>
        <h3 id="modalNamaMenu">Tambah Transaksi</h3>

        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            <input type="hidden" name="menu_id" id="modalMenuId">

            <label>Jumlah</label>
            <input type="number" name="jumlah" id="modalJumlah" min="1" value="1" required>

            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required>

            <button type="submit" class="btn btn-primary" style="margin-top:15px; width:100%;">Simpan</button>
        </form>
    </div>
</div>

<script>
    function bukaModal(menuId, namaMenu, harga) {
        document.getElementById('modalMenuId').value = menuId;
        document.getElementById('modalNamaMenu').textContent = 'Tambah: ' + namaMenu;
        document.getElementById('modalJumlah').value = 1;
        document.getElementById('modalTransaksi').classList.add('active');
    }

    function tutupModal() {
        document.getElementById('modalTransaksi').classList.remove('active');
    }

    // klik di luar modal-box untuk menutup
    document.getElementById('modalTransaksi').addEventListener('click', function (e) {
        if (e.target === this) tutupModal();
    });
</script>

@endsection
