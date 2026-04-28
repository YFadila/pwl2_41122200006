<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Laporan::with('user')->latest();

            if ($request->search) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function($q2) use ($search) {
                        $q2->where('name', 'like', '%' . $search . '%');
                    });
                });
            }

            if ($request->status) {
                $query->where('status', $request->status);
            }
            if ($request->kategori) {
                $query->where('kategori', $request->kategori);
            }
            if (request('milik_saya')) {
                $query->where('user_id', auth()->id());
            }

            $laporans = $query->get();

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
            'latitude'  => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'deskripsi' => 'required|string',
            'foto'      => 'nullable|image|max:2048',
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('foto_laporan', 'public');
        }

        $laporan = Laporan::create([
            'user_id'   => Auth::id(),
            'judul'     => $request->judul,
            'kategori'  => $request->kategori,
            'lokasi'    => $request->lokasi,
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
            'deskripsi' => $request->deskripsi,
            'foto'      => $foto,
            'status'    => 'pending',
        ]);

        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notifikasi::create([
                'user_id'    => $admin->id,
                'laporan_id' => $laporan->id,
                'pesan'      => 'Laporan baru masuk: "' . $laporan->judul . '" dari ' . Auth::user()->name,
                'dibaca'     => false,
            ]);
        }

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        $laporan->loadCount('komentars as total_komentars');
        $laporan->load('user');
        $laporan->load(['komentars' => function ($query) {
            $query->with('user', 'parent.user')->oldest();
        }]);
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

        $statusLama = $laporan->status;
        $laporan->update(['status' => $request->status]);

        if ($statusLama !== $request->status) {
            $pesan = [
                'diproses' => 'Laporan kamu "' . $laporan->judul . '" sedang diproses.',
                'selesai'  => 'Laporan kamu "' . $laporan->judul . '" telah selesai ditangani.',
                'pending'  => 'Laporan kamu "' . $laporan->judul . '" dikembalikan ke status pending.',
            ];

            Notifikasi::create([
                'user_id'    => $laporan->user_id,
                'laporan_id' => $laporan->id,
                'pesan'      => $pesan[$request->status],
                'dibaca'     => false,
            ]);
        }

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
