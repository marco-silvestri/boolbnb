@extends('layouts.app')
@section('content')
@include('shared.components.Leaflet-include')
    <div class="show">
        @include('shared.components.ShowFeedback')
 
        <div class="box-img">
            @include('shared.components.Img')
        </div>

        <div class="container">
            <div class="link">
                <a href="{{route('index')}}"><i class="fas fa-long-arrow-alt-left"></i>Torna alla home</a>
            </div>
            <div class="info container">
                <div class="info-box">
                    <h2>{{ $apartment->name }}</h2>
                    <h5>{{ $apartment->address }}</h5>
                    <div class="description">
                        <h2>Descrizione</h2>
                        <p>{{ $apartment->description }}</p>
                    </div>
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
                                    {{$apartment->square_meters}} Mq
                                </li>
                            </ul>
                        </div>     
                        <div class="options">
                            <h2>Servizi aggiuntivi</h2>
                            <ul class="mb-5 ">
                                @foreach ($apartment->options as $option)
                                <li>
                                    <i class="{{ $option->icon }}"></i> {{$option->name}}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="map-payments container">
                <div class="direction">
                    <div class="payment messages">
                        @guest       
                            @include('shared.components.Message')
                        @else
                            @if ($apartment->user_id != Auth::id())
                                @include('shared.components.Message')  
                            @else
                                {{-- Stats, make them for UPRA of the apt --}}
                                @include('shared.components.Payments')
                            @endif
                        @endguest
                    </div>
                    <div class="maps">
                        <h2>Posizione</h2>
                        @include('shared.components.Maps')
                    </div>  
                    
                </div>

                @if ($apartment->user_id == Auth::id())
                    {{-- Stats, make them for UPRA of the apt --}}
                    @include('shared.components.Chart')
                @endif
            </div>
        </div>
    </div>
@endsection

