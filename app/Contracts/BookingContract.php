<?php 

namespace App\Contracts;

interface BookingContract
{
    public function getLocations() :array;

    public function getTheaters(int $locationId) :array;

    public function getScreens(int $theaterId) :array;
}