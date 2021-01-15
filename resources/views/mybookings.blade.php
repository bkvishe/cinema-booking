@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('My Booking') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Film</th>
                                <th>Theater</th>
                                <th>Show Date</th>
                                <th>Show Time</th>
                                <th>Total Seats</th>
                                <th>Total Amount</th>
                                <th>Booking Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>                            
                        <tbody>
                            @foreach ($userBookings as $booking)
                                <tr>
                                    <td scope="row">{{ $booking['film_title'] }}</td>                                    
                                    <td scope="row">{{ $booking['theater_name'] }} ({{ $booking['city_name'] }})</td>
                                    <td scope="row">{{ date('d-m-Y', strtotime($booking['show_date'])) }}</td>
                                    <td scope="row">{{ date('h:i A', strtotime($booking['start_time'])) }} to {{ date('h:i A', strtotime($booking['end_time'])) }}</td>                                    
                                    <td scope="row">{{ $booking['number_of_seats'] }}</td>
                                    <td scope="row">{{ $booking['total_amount'] }}</td>
                                    <td scope="row">{{ $booking['booking_number'] }}</td>

                                    @if($booking['start_time'] >= now())
                                        <td scope="row"><a href="{{url('/cancelBooking/' . $booking['booking_id'])}}" class="btn btn-danger">Cancel</a></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection