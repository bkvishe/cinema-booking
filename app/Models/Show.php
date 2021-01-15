<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Show extends Model
{
    use HasFactory;

    protected $table = 'show';

    public function films()
    {
        return $this->belongsToMany(Film::class);
    }

    public function scopeActive($query)
    {
        return $query->where('date', '>=', now());
    }

    public static function availableSeats($showId)
    {

        $queryResult = Show::select(DB::raw("(theater_screen.total_seats - (select sum(booking.number_of_seats) from booking where booking.show_id = show.id)) as available_seats"))
        ->join('theater_screen', 'theater_screen.id', '=', 'show.theater_screen_id')
        ->join('booking', 'booking.show_id', '=', 'show.id')
        ->where('booking.status', "confirmed")
        ->where('show.id', $showId)
        ->get()
        ->toArray();

        if(!empty($queryResult) && isset($queryResult[0]['available_seats'])){

            return (int) $queryResult[0]['available_seats'];
        }
        else{

            $result = Show::select('theater_screen.total_seats')
            ->join('theater_screen', 'theater_screen.id', '=', 'show.theater_screen_id')
            ->where('show.id', $showId)
            ->get()
            ->toArray();

            return !empty($result) && isset($result[0]['total_seats']) ? $result[0]['total_seats'] : 0;
        }        
    }
}
