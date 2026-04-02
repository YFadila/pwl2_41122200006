<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = Laporan::with('user')->latest()->get();
        return view('laporan.index', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('laporan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|string',
            'lokasi'    => 'required|string',
            'deskripsi' => 'required|string',
            'foto'      => 'nullable|image|max:2048',
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('foto_laporan', 'public');
        }

        Laporan::create([
            'user_id'   => Auth::id(),
            'judul'     => $request->judul,
            'kategori'  => $request->kategori,
            'lokasi'    => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'foto'      => $foto,
            'status'    => 'pending',
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        $laporan->load('user', 'komentars.user');
        return view('laporan.show', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        return view('laporan.edit', compact('laporan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai',
        ]);

        $laporan->update(['status' => $request->status]);

        return redirect()->route('laporan.show', $laporan)->with('success', 'Status berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        if ($laporan->foto) {
            Storage::disk('public')->delete($laporan->foto);
        }
        $laporan->delete();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus!');
    }
}
