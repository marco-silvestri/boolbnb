@if($apartment->img == 1)
                 <img width="50%" src="{{asset('storage/images/' . $apartment->img . '.jpg')}}" alt="{{ $apartment->name }}">
            @else
                 <img width="50%" src="{{asset('storage/' . $apartment->img)}}" alt="{{ $apartment->name }}">
            @endif