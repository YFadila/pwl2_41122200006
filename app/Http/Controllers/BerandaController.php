<?php

namespace App\Http\Controllers;

use App\Models\Laporan;

class BerandaController extends Controller
{
    public function index()
    {
        $total    = Laporan::where('status', '!=', 'ditolak')->count();
        $selesai  = Laporan::where('status', 'selesai')->count();
        $diproses = Laporan::where('status', 'diproses')->count();
        $pending  = Laporan::where('status', 'pending')->count();
        $tingkatRespons = $total > 0 ? round(($selesai / $total) * 100) : 0;

        $laporanTerbaru = Laporan::with(['user', 'komentars'])
            ->whereNotIn('status', ['ditolak'])
            ->latest()
            ->take(4)
            ->get();

        return view('beranda', compact(
            'total', 'selesai', 'diproses', 'pending',
            'tingkatRespons', 'laporanTerbaru'
        ));
    }
}