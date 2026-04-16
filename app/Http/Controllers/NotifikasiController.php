<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasis = Notifikasi::where('user_id', auth()->id())
            ->with('laporan')
            ->latest()
            ->get();

        Notifikasi::where('user_id', auth()->id())
            ->where('dibaca', false)
            ->update(['dibaca' => true]);

        return view('notifikasi.index', compact('notifikasis'));
    }
}