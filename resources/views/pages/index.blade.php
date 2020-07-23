@extends('layouts.app')
@section('content')
@include('shared.components.Leaflet-include')

    <section class="search position-relative d-flex justify-content-center">  

        <div class="video-container">
            <video autoplay="" loop="" muted="" playsinline="" id="video">
                <source src="{{ asset('img/video.mp4') }}" type="video/mp4">
            </video>
            <img src="{{ asset('img/apartment.jpg') }}" alt="">
        </div>

        <div class="opacity position-absolute"></div>

        <div class="container container-jumbotron">
            <h2>Scegli la località</h2>
            <div class="u-jumbotron">
                
                <form class="d-flex" action="{{ route('guest.search') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="container-search-bar d-flex">
                        <input class="" type="text" name="address" id="address-input"  placeholder="Trova un appartamento..." />
                        <input class="submit" type="submit" value="Cerca">
                    </div>
                </form> 
                <span>Scopri tutte le città</span>
            </div>
        </div>
    </section>

    <div class="container">

        <section>
            <div class="container-cards deals">
                <h2>In vetrina</h2>
                <div class="row apartment flex-wrap">
                    @foreach ($sponsoredApartments as $apartment)
                        @include('shared.components.Card')
                    @endforeach
                </div>
            </div>
        </section>  
        
        <section>
            <div class="container-cards latest">
                <h2>Ultimi annunci</h2>        
                <div class="row"> 
                    @foreach ($apartments as $apartment)
                        @include('shared.components.Card')
                    @endforeach
                </div>
            </div>
        </section>
    </div>
    {{-- Apartments pagination --}}
    <div class="d-flex justify-content-center">
        {{ $apartments->links() }}
    </div>
@endsection
