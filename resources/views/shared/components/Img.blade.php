
@if ($apartment->img == 1)
     <img src="{{asset('img/' . $apartment->img . '.jpg')}}" alt="{{ $apartment->name }}">
@else
     <img src="{{asset('storage/' . $apartment->img)}}" alt="{{ $apartment->name }}">
@endif
