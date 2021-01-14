<?php 

namespace App\Services;

use App\Contracts\BookingContract;
use App\Models\City;
use App\Models\Theater;

class NativeBookingService implements BookingContract
{
    public function getLocations() :array
    {
        return City::all()->toArray();
    }

    public function getTheaters(int $locationId) :array
    {
        return City::find($locationId)
            ->theaters()
            ->get()
            ->toArray();
    }

    public function getScreens(int $theaterId) :array
    {
        return Theater::find($theaterId)
            ->screens()
            ->get()
            ->toArray();
    }
}