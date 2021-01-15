@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Booking') }}</div>

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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{url('/storeBookingDetails')}}" id="booking-from" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Select City</label>
                            <select class="form-control" name="city" id="city">
                            <option value="0">Please select</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city['id']}}">{{ $city['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" id="film-grid" style="display:none;">
                            <label class="form-label">Select Film</label>
                            <select class="form-control" name="film" id="film">
                            </select>
                        </div>

                        <div class="mb-3" id="theater-grid" style="display:none;">
                        
                        </div>

                        <div class="mb-3" id="seat-selection" style="display:none;">
                            
                        </div>    

                        <div class="mb-3" id="book-button" style="display:none;">
                            <button class="btn btn-success" type="submit">Book the Show</button>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection