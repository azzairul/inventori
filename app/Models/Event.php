<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['event_name', 'event_description', 'event_date', 'category_id'];

    // Relasi dengan Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi dengan Image
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}