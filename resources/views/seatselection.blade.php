<label class="form-label">Select number of seats <span style="color:red;">({{ $availableSeats }} seats are available)</span></label>

<select name="total_seats" id="total_seats" class="form-control">
    @if($availableSeats > 0)
        @for ($i= 1; $i <= $availableSeats; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    @else
        <option value="">No seats available</option>
    @endif
</select>