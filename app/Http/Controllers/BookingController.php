<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\BookingContract;
use Auth;
use Log;

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
        try{
            
            $cities = $this->booking->getCities();

        } catch (\Exception $e) {

            Log::error('BookingController@index - error - ' . $e->getMessage());

            return view('errors.500')->render();
        }

        return view('booking', ['cities' => $cities]);
    }

    public function getFilmsByCity(Request $request, $cityId)
    {
        try{

            $films = $this->booking->getFilmsByCity($cityId);

        } catch (\Exception $e) {

            Log::error('BookingController@getFilmsByCity - error - ' . $e->getMessage());

            return view('errors.500')->render();
        }
        
        return view('filmgrid', ['films' => $films])->render();
    }

    public function getTheatersByFilm(Request $request, $filmId)
    {
        try{

            $theaters = $this->booking->getTheatersByFilm($filmId);

        } catch (\Exception $e) {

            Log::error('BookingController@getTheatersByFilm - error - ' . $e->getMessage());

            return view('errors.500')->render();
        }
        
        return view('theatergrid', ['theaters' => $theaters])->render();
    }

    public function getAvailableSeats(Request $request, $showId)
    {
        try{

            $availableSeats = $this->booking->getAvailableSeats($showId);

        } catch (\Exception $e) {

            Log::error('BookingController@getAvailableSeats - error - ' . $e->getMessage());

            return view('errors.500')->render();
        }
        
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

        try{

            $bookingRefNumber = $this->booking->storeBooking($userId, $showId, $numberOfSeats, $status);

        } catch (\Exception $e) {

            Log::error('BookingController@storeBookingDetails - error - ' . $e->getMessage());

            return view('errors.500')->render();
        }

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

        try{
        
            $userBookings = $this->booking->getUserBookings($userId);

        } catch (\Exception $e) {

            Log::error('BookingController@myBooking - error - ' . $e->getMessage());

            return view('errors.500')->render();
        }

        return view('mybookings', ['userBookings' => $userBookings]);
    }

    public function cancelBooking(Request $request, $bookingId)
    {
        try{

            $result = $this->booking->cancelBooking($bookingId);

        } catch (\Exception $e) {

            Log::error('BookingController@cancelBooking - error - ' . $e->getMessage());

            return view('errors.500')->render();
        }

        if($result){

            return redirect('/myBooking')->with('success', 'Booking has been canceled successfully');
        }
        else{

            return redirect('/myBooking')->with('error', 'You can only cancel a booking until one hour before the show
            starts.');
        }
    }
}