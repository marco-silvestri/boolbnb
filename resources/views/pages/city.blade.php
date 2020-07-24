@extends('layouts.app')
@section('content')
@include('shared.components.Leaflet-include')

    <div class="index-main">
        <section class="annunci">
            <div class="container">
                <h1>{{ $cityName }}</h1>
                <h2>Ultimi annunci</h2>        
                <div class="row apartment d-flex flex-wrap "> 
                    @foreach ($apartments as $apartment)
                        @include('shared.components.Card')
                    @endforeach
                </div>
            </div>
        </section>
    </div>    
@endsection



