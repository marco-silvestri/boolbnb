@extends('layouts.app')
@section('content')
@include('shared.components.Leaflet-include')

    <section class="">
        <div class="search position-relative d-flex justify-content-center">  
            <div class="video-container">
                <video autoplay="" loop="" muted="" playsinline="" id="video">
                    <source src="{{ asset('img/videoplayback.mp4') }}" type="video/mp4">
                </video>
            </div>

            <div class="opacity position-absolute">

            </div>

            <div class="container position-absolute">
                <div class="u-jumbotron d-flex flex-column justify-content-center">
                    <div class="mt-4 mb-3" >
                        <h2>Cerca un alloggio</h2>
                    </div>
            
                    <form class="d-flex" action="{{ route('guest.search') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="container-search-bar d-flex">
                            <input class="search-bar" type="text" name="address" id="address-input" placeholder="Trova un appartamento... o lascia il campo vuoto per trovare appartamenti intorno a te">
                            
                            <input class="submit" type="submit" value="Cerca">
                            
                            
                        </div>
                    </form> 
                </div>
            </div>
            
            
 
        </div>   
    </section>
    
    
    {{-- <div class="container">
        <div class="container">
            <div class="row">
                <h2>In vetrina</h2>
                @foreach ($sponsoredApartments as $apartment)
                    @include('shared.components.Card')
                @endforeach
            </div>
            <div class="row"> 
                <h2>Ultimi annunci</h2>
                @foreach ($apartments as $apartment)
                    @include('shared.components.Card')
                @endforeach
            </div>
        </div>
    </div> --}}

     {{-- Impaginazione appartamenti --}}
    <div class="d-flex justify-content-center">
        {{ $apartments->links() }}
    </div>
@endsection
