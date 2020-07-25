@extends('layouts.app')
@section('content')
@include('shared.components.Leaflet-include')

    <div class="index-main">
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
        
        <section class="vetrina">
            <div class="container">
                <h2>Appartamenti in Evidenza</h2>
                <div class="row apartment d-flex flex-wrap">
                    @foreach ($sponsoredApartments as $apartment)
                        @include('shared.components.Card')
                    @endforeach
                </div>
            </div>
            
        </section>
    
        @include('shared.components.Download')  
        
        <section class="annunci">
            <div class="container">
                <h2>Ultimi annunci</h2>        
                <div class="row apartment d-flex flex-wrap "> 
                    @foreach ($apartments as $apartment)
                        @include('shared.components.Card')
                    @endforeach
                </div>
            </div>
        </section>
        
        @include('shared.components.Discover')
    </div>    
@endsection
