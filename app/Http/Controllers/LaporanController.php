<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulanMulai = $request->input('dari', now()->subDays(14)->format('Y-m-d'));
        $bulanSampai = $request->input('sampai', now()->format('Y-m-d'));

        $data = $this->getDataLaporan($bulanMulai, $bulanSampai);

        return view('laporan.index', compact('data', 'bulanMulai', 'bulanSampai'));
    }

    /**
     * Terima gambar chart (base64 dari canvas), simpan ke storage.
     * Return path gambar yang tersimpan.
     */
    public function simpanGambarChart(Request $request)
    {
        $request->validate([
            'chart_image' => 'required|string',
        ]);

        $base64 = $request->input('chart_image');

        // hapus prefix "data:image/png;base64,"
        $base64 = preg_replace('#^data:image/\w+;base64,#i', '', $base64);
        $imageData = base64_decode($base64);

        $namaFile = 'chart-' . now()->format('YmdHis') . '.png';
        $path = 'laporan/' . $namaFile;

        Storage::disk('public')->put($path, $imageData);

        return response()->json([
            'success' => true,
            'path' => $path,
            'url' => Storage::url($path),
        ]);
    }

    /**
     * Generate PDF, ambil gambar chart dari storage (bukan base64 langsung).
     */
    public function exportPdf(Request $request)
    {
        $request->validate([
            'chart_path' => 'required|string',
            'dari' => 'required|date',
            'sampai' => 'required|date',
        ]);

        $bulanMulai = $request->input('dari');
        $bulanSampai = $request->input('sampai');
        $chartPath = $request->input('chart_path');

        $data = $this->getDataLaporan($bulanMulai, $bulanSampai);

        // ambil file fisik dari storage buat dimasukin ke mpdf
        $chartFullPath = Storage::disk('public')->path($chartPath);

        $html = view('laporan.pdf', [
            'data' => $data,
            'chartFullPath' => $chartFullPath,
            'bulanMulai' => $bulanMulai,
            'bulanSampai' => $bulanSampai,
        ])->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('laporan-penjualan.pdf', 'S'))
            ->header('Content-Type', 'application/pdf');
    }

    private function getDataLaporan($bulanMulai, $bulanSampai)
    {
        return Transaksi::selectRaw('menu_id, SUM(jumlah) as total_jumlah, SUM(total_harga) as total_pendapatan')
            ->whereBetween('tanggal', [$bulanMulai, $bulanSampai])
            ->groupBy('menu_id')
            ->with('menu')
            ->orderByDesc('total_jumlah')
            ->get();
    }
}
