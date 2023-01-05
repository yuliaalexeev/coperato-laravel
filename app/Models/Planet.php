<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    protected $fillable = [
        'name', 'population', 'diameter', 'url'
    ];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'planet_film', 'planet_id', 'film_id');
    }
}
