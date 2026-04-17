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

    public function getJson()
    {
        $notifikasis = Notifikasi::where('user_id', auth()->id())
            ->with('laporan')
            ->latest()
            ->take(20)
            ->get()
            ->map(function ($notif) {
                return [
                    'id' => $notif->id,
                    'pesan' => $notif->pesan,
                    'dibaca' => $notif->dibaca,
                    'laporan_id' => $notif->laporan_id,
                    'laporan_judul' => $notif->laporan->judul ?? null,
                    'waktu' => $notif->created_at->diffForHumans(),
                    'url' => route('laporan.show', $notif->laporan_id),
                ];
            });

        $unread = Notifikasi::where('user_id', auth()->id())
            ->where('dibaca', false)
            ->count();

        return response()->json([
            'notifikasis' => $notifikasis,
            'unread' => $unread,
        ]);
    }

    public function markOne($id)
    {
        $notifikasi = auth()->user()->notifikasis()->findOrFail($id);
        $notifikasi->update(['dibaca' => true]);

        return response()->json(['success' => true]);
    }

    public function markRead()
    {
        Notifikasi::where('user_id', auth()->id())
            ->where('dibaca', false)
            ->update(['dibaca' => true]);

        return response()->json(['unread' => 0]);
    }
}