<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

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

        // Chart data for Admin — report frequency
        $chartBulanan = [];
        $chartMingguan = [];
        $chartHarian = [];

        if (auth()->user()->isAdmin()) {
            // Bulanan: 12 bulan terakhir
            for ($i = 11; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $chartBulanan['labels'][] = $date->translatedFormat('M Y');
                $chartBulanan['data'][] = Laporan::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();
            }

            // Mingguan: 12 minggu terakhir
            for ($i = 11; $i >= 0; $i--) {
                $weekStart = Carbon::now()->subWeeks($i)->startOfWeek();
                $weekEnd   = Carbon::now()->subWeeks($i)->endOfWeek();
                $chartMingguan['labels'][] = $weekStart->format('d M');
                $chartMingguan['data'][] = Laporan::whereBetween('created_at', [$weekStart, $weekEnd])->count();
            }

            // Harian: 30 hari terakhir
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $chartHarian['labels'][] = $date->format('d M');
                $chartHarian['data'][] = Laporan::whereDate('created_at', $date->toDateString())->count();
            }
        }

        return view('dashboard', compact(
            'total', 'pending', 'diproses', 'selesai', 'terbaru',
            'myTotal', 'myPending', 'myDiproses', 'mySelesai', 'myLaporan',
            'chartBulanan', 'chartMingguan', 'chartHarian'
        ));
    }
}
