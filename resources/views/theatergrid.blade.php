<label class="form-label">Select Theater and Show</label>
<table class="table">
<tbody>
@foreach ($theaters as $theater)
<tr>
    <th scope="row">{{ $theater['name'] }}</th>
    <td>
        <table class="table">
            <thead>
                <th>Select the show</th>
                <th>Date</th>
                <th>Show Time</th>
                <th>Price Tag</th>
            </thead>
            <tbody>
                @foreach ($theater['shows'] as $show)
                    <tr>
                        <td>
                            <input type="radio" name="show" value="{{ $show['id'] }}" class="form-control show-selection" />
                        </td>
                        <td scope="row">{{ date('d-m-Y', strtotime($show['date'])) }}</td>
                        
                        
                        <td scope="row">{{ date('h:i A', strtotime($show['start_time'])) }} to {{ date('h:i A', strtotime($show['end_time'])) }}</td>

                        
                        <td scope="row">{{ $show['price_tag'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </td>
</tr>
@endforeach
</tbody>
</table>