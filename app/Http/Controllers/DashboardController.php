<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $total    = Laporan::count();
        $pending  = Laporan::where('status', 'pending')->count();
        $diproses = Laporan::where('status', 'diproses')->count();
        $selesai  = Laporan::where('status', 'selesai')->count();
        $terbaru  = Laporan::with('user')->latest()->take(5)->get();

        return view('dashboard', compact(
            'total', 'pending', 'diproses', 'selesai', 'terbaru'
        ));
    }
}
