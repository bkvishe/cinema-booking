<option value="0">Please select</option>
@foreach ($films as $film)
    <option value="{{ $film['id']}}">{{ $film['title']}}</option>
@endforeach
