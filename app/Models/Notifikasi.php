<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $fillable = ['user_id', 'laporan_id', 'pesan', 'dibaca'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }
}
