<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\BookingContract;
use Auth;

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
    }

    public function getFilmsByCity(Request $request, $cityId)
    {
        $films = $this->booking->getFilmsByCity($cityId);
        
        return view('filmgrid', ['films' => $films])->render();
    }

    public function getTheatersByFilm(Request $request, $filmId)
    {
        $theaters = $this->booking->getTheatersByFilm($filmId);
        
        return view('theatergrid', ['theaters' => $theaters])->render();
    }

    public function getAvailableSeats(Request $request, $showId)
    {
        $availableSeats = $this->booking->getAvailableSeats($showId);
        
        return view('seatselection', ['availableSeats' => $availableSeats])->render();
    }

    public function storeBookingDetails(Request $request)
    {
        $request->validate([
            'show' => 'required|integer',
            'total_seats' => 'required|integer',
        ]);

        $userId = Auth::user()->id;
        $showId = $request->show;
        $numberOfSeats = $request->total_seats;
        $status = 'confirmed';

        $bookingRefNumber = $this->booking->storeBooking($userId, $showId, $numberOfSeats, $status);

        if($bookingRefNumber){

            return redirect('/')->with('success', 'Show has been booked successfully with reference id ' . $bookingRefNumber);
        }
        else{

            return redirect('/')->with('error', 'Unable to book show! Please try again later.');
        }
    }

    public function myBooking()
    {
        $userId = Auth::user()->id;
        
        $userBookings = $this->booking->getUserBookings($userId);

        return view('mybookings', ['userBookings' => $userBookings]);
    }

    public function cancelBooking(Request $request, $bookingId)
    {
        $result = $this->booking->cancelBooking($bookingId);

        if($result){

            return redirect('/myBooking')->with('success', 'Booking has been canceled successfully');
        }
        else{

            return redirect('/myBooking')->with('error', 'You can only cancel a booking until one hour before the show
            starts.');
        }
    }
}