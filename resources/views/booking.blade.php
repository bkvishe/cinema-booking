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

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Select City</label>
                        <select class="form-control" name="city" id="city">
                        <option value="0">Please select</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city['id']}}">{{ $city['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
