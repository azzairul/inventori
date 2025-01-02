<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table ='peminjaman';
    protected $fillable = [
        'no_transaksi',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'jam_peminjaman',
        'nama_peminjam',
        'alasan_peminjaman',
        'status',
        'user_id',
    ];

    public function items()
    {
        return $this->belongsToMany(Items::class, 'peminjaman_items', 'peminjaman_id', 'item_id')
                    ->withPivot('jumlah_unit')
                    ->withTimestamps();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Pastikan 'user_id' adalah kolom yang ada di tabel peminjaman yang menghubungkan dengan id user
    }

    public function riwayat()
    {
        return $this->hasMany(Riwayat::class);
    }

}
