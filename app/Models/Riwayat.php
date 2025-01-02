<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $table = 'riwayat';

    protected $fillable = [
        'peminjaman_id',
        'status',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
