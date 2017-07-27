<option>--- Select Teacher ---</option>
@if(!empty($teachers))
    @foreach($teachers as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
@endif