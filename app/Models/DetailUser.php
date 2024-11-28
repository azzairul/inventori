<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nik',
        'alamat',
        'no_telepon',
        'tanggal_lahir',
        'jenis_kelamin',
        'riwayat_pendidikan',
        'posisi_dilamar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
