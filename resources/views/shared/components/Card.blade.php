<div class="col-sm-12 col-md-6 col-lg-4  @if ($apartment->visibility == 0) d-none @endif">
    <div class="card-apt">
        @include('shared.components.Img')
        <div class="info-box">
            <h3>{{ $apartment->name }}</h3>
            <p>{{ $apartment->description }}</p>
            @guest       
                {{-- Conditional redirect to Guest Show --}}
                <a href="{{route('guest.apartment.show', $apartment->id)}}">show</a>
            @else
                @if ($apartment->user_id == Auth::id())
                    <a href="{{route('user.apartment.edit', $apartment->id)}}" class="btn btn-warning"><i class="far fa-edit"></i>{{-- Visualizza dettagli  --}}</a>
                @else
                    <a href="{{route('user.apartment.show', $apartment->id)}}" class="btn btn-primary"> <i class="far fa-eye"></i>{{-- Modifica inserzione  --}}</a>
                @endif
            @endguest
        </div>
    </div>
</div>