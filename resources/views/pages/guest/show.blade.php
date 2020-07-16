@extends('layouts.app')
@section('content')
@include('shared.components.Leaflet-include')

    <div class="container">
     @include('shared.components.ShowFeedback')

        <div class="jumbotron pt-5 pb-5">
        <img width="50%" src="{{asset('storage/images/' . $apartment->img . '.jpg')}}" alt="{{ $apartment->name }}">
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
                </ul>
            </div>
        </div>

        @include('shared.components.Maps')
        @include('shared.components.Message')
        
    </div>
    
@endsection