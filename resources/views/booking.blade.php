@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form id="booking-from" >
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

                        <div class="mb-3" id="seat-selection">
                            <label class="form-label">Enter number of seats</label>
                            <input type="number" class="form-control" />
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection