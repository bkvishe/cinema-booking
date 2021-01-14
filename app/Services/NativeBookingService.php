<?php 

namespace App\Services;

use App\Contracts\BookingContract;
use App\Models\City;
use App\Models\Theater;
use App\Models\Film;

class NativeBookingService implements BookingContract
{
    public function getCities() :array
    {
        return City::all()->toArray();
    }

    public function getTheatersByCity(int $cityId) :array
    {
        return City::find($cityId)
            ->theaters()
            ->get()
            ->toArray();
    }

    public function getScreensByTheater(int $theaterId) :array
    {
        return Theater::find($theaterId)
            ->screens()
            ->get()
            ->toArray();
    }

    public function getFilmsByCity(int $cityId) :array
    {
        return City::films($cityId);
    }

    public function getTheatersByFilm(int $filmId) :array
    {
        return Film::theaters($filmId);
    }
}