<label class="form-label">Select number of seats <span style="color:red;">({{ $availableSeats }} seats are available)</span></label>

<select name="total_seats" id="total_seats" class="form-control">
    @for ($i= 1; $i <= $availableSeats; $i++)
        <option value="{{ $i }}">{{ $i }}</option>
    @endfor
</select>