<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanItem extends Model
{
    protected $table = 'peminjaman_items';

    protected $fillable = [
        'peminjaman_id',
        'item_id',
        'jumlah_unit',
    ];

    // Relasi ke model Items
    public function item()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }

    // Relasi ke model Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }
}
