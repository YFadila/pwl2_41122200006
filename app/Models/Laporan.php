<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'user_id', 'judul', 'kategori', 
        'lokasi', 'latitude', 'longitude',
        'deskripsi', 'foto', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }
}