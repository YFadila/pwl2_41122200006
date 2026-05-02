<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function store(Request $request, $laporan_id)
    {
        $request->validate([
            'isi'       => 'required|string',
            'parent_id' => 'nullable|exists:komentars,id',
        ]);

        Komentar::create([
            'user_id'    => Auth::id(),
            'laporan_id' => $laporan_id,
            'parent_id'  => $request->parent_id,
            'isi'        => $request->isi,
        ]);

        $laporan = \App\Models\Laporan::find($laporan_id);

        if (!$request->parent_id && $laporan->user_id !== Auth::id()) {
            \App\Models\Notifikasi::create([
                'user_id'    => $laporan->user_id,
                'laporan_id' => $laporan_id,
                'pesan'      => Auth::user()->name . ' menambahkan komentar pada laporan Anda "' . $laporan->judul . '".',
                'dibaca'     => false,
            ]);
        }

        if ($request->parent_id) {
            $komentarInduk = \App\Models\Komentar::find($request->parent_id);
            if ($komentarInduk && $komentarInduk->user_id !== Auth::id()) {
                \App\Models\Notifikasi::create([
                    'user_id'    => $komentarInduk->user_id,
                    'laporan_id' => $laporan_id,
                    'pesan'      => Auth::user()->name . ' membalas komentar Anda pada laporan "' . $laporan->judul . '".',
                    'dibaca'     => false,
                ]);
            }
        }

        return redirect()->route('laporan.show', $laporan_id)
                        ->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function update(Request $request, Komentar $komentar)
    {
        if ($komentar->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit komentar ini.');
        }

        $request->validate([
            'isi' => 'required|string',
        ]);

        $komentar->update([
            'isi' => $request->isi,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil diperbarui!');
    }

    public function destroy(Komentar $komentar)
    {
        // Pastikan hanya pemilik komentar yang bisa menghapus
        if ($komentar->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus komentar ini.');
        }

        $komentar->delete(); // Soft delete
        return redirect()->back()->with('success', 'Komentar berhasil dihapus!');
    }
}
