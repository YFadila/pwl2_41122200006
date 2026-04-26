<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $fillable = ['user_id', 'laporan_id', 'parent_id', 'isi'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    public function parent()
    {
        return $this->belongsTo(Komentar::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Komentar::class, 'parent_id');
    }

    /**
     * Recursive: replies with their nested replies, users, and parent user (for mention display).
     */
    public function allReplies()
    {
        return $this->hasMany(Komentar::class, 'parent_id')->with('user', 'parent.user', 'allReplies');
    }
}