<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'title', 'url'
    ];

    public function planets()
    {
        return $this->belongsToMany(Planet::class, 'planet_film', 'film_id', 'planet_id');
    }
}
