@extends('layouts.app')
@section('content')
@include('shared.components.Leaflet-include')

    <div class="show">
        @include('shared.components.ShowFeedback')

        <div class="box-img" style="background-image: url('{{ asset('img/1.jpg')}}');">
            {{-- @include('shared.components.Img') --}}
        </div>

        <div class="container">
            <div class="info container">

                <div class="info-box">
    
                    <h2>{{ $apartment->name }}</h2>
                    {{-- Da cambiare --}}
                    <h5>Via Diaz 5, roma</h5>
                    <hr>
    
                    <div class="description">
                        <h2>Descrizione</h2>
                        <p>{{ $apartment->description }}</p> 
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?</p>
                    </div>
    
                    <hr>
                    
                </div>
    
    
                <div class="services">
    
                    <div class="service-options">
    
                        <div class="features">
                            <h2>Caratteristiche</h2>
                            <ul class="mb-5 ">
                                <li>
                                    <i class="fas fa-door-open" aria-hidden="true"></i>
                                    {{$apartment->room_numbers}} Stanze
                                </li>
                                <li>
                                    <i class="fas fa-bed"></i>
                                    {{$apartment->beds}} Posti letto 
                                </li>
                                <li>
                                    <i class="fas fa-bath"></i>
                                    {{$apartment->bathrooms}} Bagni
                                </li>
                                <li>
                                    <i class="fas fa-home"></i>
                                    {{$apartment->square_meters}} Mq</li>
                                {{-- <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    Indirizzo: {{$apartment->address}}
                                </li> --}}
                            </ul>
                        </div>     
        
                        <div class="options">
                            {{-- Da rivedere --}}
                            <h2>Opzioni</h2>
                            <ul class="mb-5 ">
                                @foreach ($apartment->options as $option)
                                    @if ($option->name == 'Sauna')
                                    <li>
                                        <i class="fas fa-hot-tub"></i> {{$option->name}}
                                    </li>
                                    @elseif ($option->name == 'Pool')
                                    <li>
                                        <i class="fas fa-swimming-pool"></i> {{$option->name}}
                                    </li>
                                    @elseif ($option->name == 'Parking')
                                    <li>
                                        <i class="fas fa-car"></i> {{$option->name}}
                                    </li>
                                    @elseif ($option->name == 'Reception')
                                    <li>
                                        <i class="fas fa-concierge-bell"></i> 
                                        {{$option->name}}
                                    </li>
                                    @elseif ($option->name == 'Seascape')
                                    <li>
                                        <i class="fas fa-water"></i>
                                        {{$option->name}}
                                    </li>
                                    @elseif ($option->name == 'Wi-Fi')
                                    <li>
                                        <i class="fas fa-wifi"></i> {{$option->name}}
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
    
            </div>
    
            <div class="map-payments container">
                
                <div class="direction">
                    <div class="payment  messages">
                        @guest       
                            @include('shared.components.message')
                        @else
                                
                            @if ($apartment->user_id != Auth::id())
                                @include('shared.components.Message')  
                            @else
                                @include('shared.components.Payments')  
                            @endif
                        
                        @endguest
                    </div>

                    <div class="maps">
                        <h2>Posizione</h2>
                        @include('shared.components.Maps')
                    </div>
                    
                </div>
                
            </div>
        </div>
        
    </div>
    
@endsection




{{-- @extends('layouts.app')
@section('content')
@include('shared.components.Leaflet-include')

    <div class="container">
        @include('shared.components.ShowFeedback')

        <div class="jumbotron pt-5 pb-5">
        @include('shared.components.Img')
            <h1>{{ $apartment->name }}</h1>
        </div>
        
        <div class="description d-flex pb-20">
            <div class="col">
                <h2 class="mb-10">Descrizione</h2>
                <p>{{ $apartment->description }}</p>
            </div>
            <div class="col">
                <h2>Servizi</h2>
                <ul>
                    <li>Numero di stanze: {{$apartment->room_numbers}}</li>
                    <li>Numero di posti letto: {{$apartment->beds}}</li>
                    <li>Numero di bagni: {{$apartment->bathrooms}}</li>
                    <li>Metri quadrati: {{$apartment->square_meters}} mq</li>
                    <li>Indirizzo: {{$apartment->address}}</li>
                    <li>Latlong: {{ $apartment->lat }} and {{ $apartment->long }}</li>
                    @if($apartment->sponsorship_expiration != NULL) 
                        <li>Scadenza Sponsorship: {{ $apartment->sponsorship_expiration }}</li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="description d-flex pb-20">
            <div class="col">
                <h2>Servizi</h2>
                @foreach ($apartment->options as $option)
                    <p>{{ $option->name }}</p>
                @endforeach    
            </div>
        </div>

        @include('shared.components.Maps')
        @guest       
            @include('shared.components.message')
            @else
                
                    @if ($apartment->user_id != Auth::id())
                        @include('shared.components.Message')  
                    @else
                        @include('shared.components.Payments')  
                    @endif
                </a>
        @endguest

		
       @include('shared.components.Chart') 
@endsection

    </div>
    

