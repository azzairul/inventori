<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'status',
        'alamat',
        'divisi',
        'jabatan',
        'no_telepon',
        'instagram',
        'twiter',
        'linkedin',
        'pendidikan_terakhir',
        'nama_institusi',
        'jurusan',
        'tahun_lulus',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
