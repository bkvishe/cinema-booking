<?php 

namespace App\Services;

use App\Contracts\BookingContract;
use App\Models\City;
use App\Models\Theater;
use App\Models\Film;
use App\Models\Show;
use App\Models\Booking;
use DateTime;

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

    public function getAvailableSeats(int $showId) :int
    {

        return Show::availableSeats($showId);
    }

    public function storeBooking(int $userId, int $showId, int $numberOfSeats, string $status)
    {
        $bookingNumber = $this->generateBookingNumber();
        $totalAmount = $this->calculateBookingAmount($numberOfSeats, $showId);

        $booking = new Booking();

        $booking->user_id = $userId;
        $booking->show_id = $showId;
        $booking->number_of_seats = $numberOfSeats;
        $booking->status = $status;
        $booking->booking_number = $bookingNumber;
        $booking->total_amount = $totalAmount;

        $booking->save();

        return $bookingNumber;
    }

    protected function generateBookingNumber()
    {
        return time().rand(10,100);
    }

    protected function calculateBookingAmount(int $numberOfSeats, int $showId)
    {
        $showDetails = Show::find($showId);

        return $numberOfSeats * $showDetails->price_tag;
    }

    public function getUserBookings(int $userId) :array
    {
        return Booking::userBookings($userId);
    }

    public function cancelBooking(int $bookingId) :bool
    {

        if($this->checkCancelEligibility($bookingId)){

            $bookingDetails = Booking::where('id', $bookingId);

            return $bookingDetails->delete();
        }
        else{

            return false;
        }        
    }

    protected function checkCancelEligibility($bookingId)
    {
        $showDetails = Booking::select('show.*')
        ->join('show', 'show.id', '=', 'booking.show_id')
        ->where('booking.id', $bookingId)
        ->first();

        $startTime = strtotime($showDetails->start_time);
        $now = strtotime(date('Y-m-d H:i:s'));

        $diff = round(($startTime - $now) / 60,2); // Divided by 60 to get difference in minutes

        if($diff < env('CANCEL_WINDOW_MIN', 60) || $diff < 0) // Check for 60 min window and previous show as well
        {
            return false;
        }

        return true;
    }
}