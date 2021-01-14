<?php 

namespace App\Contracts;

interface BookingContract
{
    public function getCities() :array;

    public function getTheatersByCity(int $cityId) :array;

    public function getScreensByTheater(int $theaterId) :array;

    public function getFilmsByCity(int $cityId) :array;

    public function getTheatersByFilm(int $filmId) :array;
}