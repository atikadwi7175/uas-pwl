<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Halaman utama kasir: tampilan menu berbentuk card,
     * dikelompokkan Food & Beverage. Tombol "+" di tiap card
     * membuka modal untuk input transaksi.
     */
    public function index()
    {
        $foods = Menu::where('kategori', 'food')->get();
        $beverages = Menu::where('kategori', 'beverage')->get();

        return view('transaksi.index', compact('foods', 'beverages'));
    }

    /**
     * Riwayat semua transaksi yang sudah diinput.
     */
    public function history()
    {
        $transaksis = Transaksi::with(['menu', 'user'])->latest()->get();
        return view('transaksi.history', compact('transaksis'));
    }

    /**
     * Simpan transaksi baru dari modal di halaman index.
     */
    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $menu = Menu::findOrFail($request->menu_id);
        $totalHarga = $menu->harga * $request->jumlah;

        Transaksi::create([
            'menu_id' => $menu->id,
            'user_id' => Auth::id(),
            'jumlah' => $request->jumlah,
            'total_harga' => $totalHarga,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }
}
