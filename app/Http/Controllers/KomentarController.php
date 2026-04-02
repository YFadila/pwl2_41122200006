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
            'isi' => 'required|string',
        ]);

        Komentar::create([
            'user_id'    => Auth::id(),
            'laporan_id' => $laporan_id,
            'isi'        => $request->isi,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function destroy(Komentar $komentar)
    {
        $komentar->delete();
        return redirect()->back()->with('success', 'Komentar berhasil dihapus!');
    }
}
