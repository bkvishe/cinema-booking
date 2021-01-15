<label class="form-label">Select Theater and Show</label>
<table class="table">
<tbody>
@foreach ($theaters as $theater)
<tr>
    <th scope="row">{{ $theater['name'] }}</th>
    <td>
        <table class="table">
            <tbody>
                @foreach ($theater['shows'] as $show)
                    <tr>
                        <td>
                            <input type="radio" name="show" value="{{ $show['id'] }}" class="form-control" />
                        </td>
                        <th>Date</th>
                        <td scope="row">{{ $show['date'] }}</td>
                        
                        <th>Show Time</th>
                        <td scope="row">{{ $show['start_time'] }} to {{ $show['end_time'] }}</td>                    
                    </tr>                    
                @endforeach
            </tbody>
        </table>
    </td>
</tr>
@endforeach
</tbody>
</table>