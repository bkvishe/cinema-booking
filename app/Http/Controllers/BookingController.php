<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\BookingContract;

class BookingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $booking;

    public function __construct(BookingContract $booking)
    {
        $this->booking = $booking;
    }

    public function index()
    {

        $cities = $this->booking->getCities();

        return view('booking', ['cities' => $cities]);

        //dd($this->booking->getTheaters(1));

        //dd($this->booking->getScreens(1));

        //dd($this->booking->getFilmsByCity(1));

        //dd($this->booking->getTheatersByFilm(1));

        
    }
}