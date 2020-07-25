@if ($apartment->img == 1)
     <img class="imgbox" src="{{asset('img/' . $apartment->img . '.jpg')}}" alt="{{ $apartment->name }}">
@else
     <img class="imgbox" src="{{asset('storage/' . $apartment->img)}}" alt="{{ $apartment->name }}">
@endif
