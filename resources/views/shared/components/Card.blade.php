<div class=" col-sm-12 col-md-6 col-lg-4  @if ($apartment->visibility == 0) d-none @endif">
    <div class="box m-2 d-flex flex-column align-items-center">
        @include('shared.components.Img')

        <div class="info">
            <h3 class="card-title mt-2">{{ $apartment->name }}</h3>
            <div>

                {{-- <p class="card-text mb-3">{{ $apartment->description }}</p> --}}
            </div>

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
            {{--  --}}
            
        </div>
    </div>
</div>


{{-- <div class="col-sm-3 @if ($apartment->visibility == 0) d-none @endif">
    <div class="card">
        <div class="card-body ">
            @include('shared.components.Img')

            <h5 class="card-title">{{ $apartment->name }}</h5>
            <p class="card-text">{{ $apartment->description }}</p>

            @guest       

                
                <a href="{{route('guest.apartment.show', $apartment->id)}}">show guest</a>
            @else
       
                
                @if ($apartment->user_id == Auth::id())
                    <a href="{{route('user.apartment.edit', $apartment->id)}}" class="btn btn-warning"> Modifica inserzione</a>
                @else
                    <a href="{{route('user.apartment.show', $apartment->id)}}" class="btn btn-primary"> Visualizza dettagli</a>
                @endif

            @endguest
        </div>
    </div>
</div>
 --}}