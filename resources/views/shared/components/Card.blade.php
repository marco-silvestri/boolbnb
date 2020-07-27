<div class="card-apt col-sm-12 col-md-12 col-lg-6   @if ($apartment->visibility == 0) d-none @endif">
    <div class="apt">
        <div class="img">
            @include('shared.components.Img')
            @guest       
                {{-- Conditional redirect to Guest Show --}}
                <a href="{{route('guest.apartment.show', $apartment->id)}}" class="btn btn-warning"><i class="far fa-eye"></i>{{-- Visualizza dettagli  --}}</a>
            @else
                @if ($apartment->user_id == Auth::id())
                    <a href="{{route('user.apartment.edit', $apartment->id)}}" class="btn btn-warning"><i class="far fa-edit"></i>{{-- Visualizza dettagli  --}}</a>
                @else
                    <a href="{{route('user.apartment.show', $apartment->id)}}" class="btn btn-warning"> <i class="far fa-eye"></i>{{-- Modifica inserzione  --}}</a>
                @endif
            @endguest
        </div>
        
        <div class="info">

            <div class="info-box">
                <h3>{{ $apartment->name }}</h3>
                <p>{{truncate($apartment->description,120)}}</p>
            </div>


            
            <div class="info-options">
                <h5>Servizi inclusi:</h5>
                @foreach ($apartment->options as $option)
                <div>
                    <i class="{{ $option->icon }}"></i>
                    <span>{{$option->name}}</span>
                </div>
                @endforeach
            </div>
            
            
        </div>
        
    </div>
</div>

