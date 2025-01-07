<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'url', 'alt'];

    // Relasi dengan Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}