<?php 

namespace App\Contracts;

interface BookingContract
{
    public function getCities() :array;

    public function getTheatersByCity(int $cityId) :array;

    public function getScreensByTheater(int $theaterId) :array;

    public function getFilmsByCity(int $cityId) :array;

    public function getTheatersByFilm(int $filmId) :array;

    public function getAvailableSeats(int $showId) :int;

    public function storeBooking(int $userId, int $showId, int $numberOfSeats, string $status);

    public function getUserBookings(int $userId) :array;

    public function cancelBooking(int $bookingId) :bool;
}