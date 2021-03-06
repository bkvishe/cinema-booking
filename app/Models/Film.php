<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $table = 'film';

    public function shows()
    {
        return $this->hasMany(Show::class, 'film_id', 'id');
    }
    
    public static function theaters(int $filmId, int $cityId)
    {
        return Theater::select('theater.*')
        ->with(['shows' => function ($query) use($filmId){
            $query->where('show.film_id', '=', $filmId)
            ->where('show.start_time', '>', now());
        }])
        ->join('theater_screen', 'theater_screen.theater_id', '=', 'theater.id')
        ->join('show', 'show.theater_screen_id', '=', 'theater_screen.id')
        ->where('theater.city_id', $cityId)
        ->where('show.film_id', $filmId)
        ->where('show.start_time', '>', now())
        ->get()
        ->toArray();
    }   
}