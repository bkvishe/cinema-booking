<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'city';

    public function theaters()
    {
        return $this->hasMany(Theater::class, 'city_id', 'id');
    }

    public static function films(int $locationId)
    {
        return Film::select('film.*')
        ->with('shows')
        ->join('show', 'show.film_id', '=', 'film.id')
        ->join('theater_screen', 'theater_screen.id', '=', 'show.theater_screen_id')
        ->join('theater', 'theater.id', '=', 'theater_screen.theater_id')
        ->where('theater.city_id', $locationId)
        ->get()
        ->toArray();
    }
}