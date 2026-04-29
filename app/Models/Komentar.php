<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Komentar extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'laporan_id', 'parent_id', 'isi'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    /**
     * Parent comment — includes soft-deleted parents so replies can
     * show "komentar tidak tersedia" when the parent has been removed.
     */
    public function parent()
    {
        return $this->belongsTo(Komentar::class, 'parent_id')->withTrashed();
    }

    public function replies()
    {
        return $this->hasMany(Komentar::class, 'parent_id')->oldest();
    }

    /**
     * Recursive: replies with their nested replies, users, and parent user (for mention display).
     */
    public function allReplies()
    {
        return $this->hasMany(Komentar::class, 'parent_id')->with('user', 'parent.user', 'allReplies')->oldest();
    }
}