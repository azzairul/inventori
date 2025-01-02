<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Items extends Model
{
    use HasFactory;

    protected $table ='items';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'category_id',
        'stok',
        'lokasi',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function peminjaman()
    {
        return $this->belongsToMany(Peminjaman::class, 'peminjaman_items', 'items_id', 'peminjaman_id')
                    ->withPivot('jumlah_unit')
                    ->withTimestamps();
    }    
}
