<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Category extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = ['nama'];

    public function items()
    {
        return $this->hasMany(Items::class,'category_id');
    }
}
