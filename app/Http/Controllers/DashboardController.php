<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
public function index()
    {
        // Statistik Global (Admin)
        $total    = Laporan::count();
        $pending  = Laporan::where('status', 'pending')->count();
        $diproses = Laporan::where('status', 'diproses')->count();
        $selesai  = Laporan::where('status', 'selesai')->count();
        $terbaru  = Laporan::with('user')->latest()->take(5)->get();

        // Statistik Personal (Warga)
        $myTotal    = Laporan::where('user_id', auth()->id())->count();
        $myPending  = Laporan::where('user_id', auth()->id())->where('status', 'pending')->count();
        $myDiproses = Laporan::where('user_id', auth()->id())->where('status', 'diproses')->count();
        $mySelesai  = Laporan::where('user_id', auth()->id())->where('status', 'selesai')->count();
        $myLaporan  = Laporan::where('user_id', auth()->id())
                        ->with(['komentars'])
                        ->latest()
                        ->take(5)
                        ->get();

        return view('dashboard', compact(
            'total', 'pending', 'diproses', 'selesai', 'terbaru',
            'myTotal', 'myPending', 'myDiproses', 'mySelesai', 'myLaporan'
        ));
    }
}
