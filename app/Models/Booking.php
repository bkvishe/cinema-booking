<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';

    public static function userBookings($userId)
    {
        return Booking::select('booking.id as booking_id', 'booking.booking_number', 'film.title as film_title', 'show.date as show_date', 'show.start_time', 'show.end_time', 'booking.number_of_seats', 'booking.total_amount', 'theater.name as theater_name', 'city.name as city_name')
        ->join('show', 'show.id', '=', 'booking.show_id')
        ->join('film', 'film.id', '=', 'show.film_id')
        ->join('theater_screen', 'theater_screen.id', '=', 'show.theater_screen_id')
        ->join('theater', 'theater.id', '=', 'theater_screen.theater_id')
        ->join('city', 'city.id', '=', 'theater.city_id')
        ->where('booking.user_id', $userId)
        ->get()
        ->toArray();
    }
}
