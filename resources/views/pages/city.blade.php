@extends('layouts.app')
@section('content')
@include('shared.components.Leaflet-include')

<div class="discover-page">
    <div class="discover-top">
        <div class="top-left">
            @foreach($firstApartments as $apartment)
                <div class="img">@include('shared.components.Img')</div>
            @endforeach
        </div>
        <div class="top-right">
            @if($cityName == 'Milano')<img class ="img-fluid"src="{{asset('img/milano.jpg')}}" alt="">
            @elseif($cityName == 'Roma')<img class ="img-fluid"src="{{asset('img/Roma.jpg')}}" alt="">
            @elseif($cityName == 'Firenze')<img class ="img-fluid"src="{{asset('img/Firenze.jpg')}}" alt="">
            @elseif($cityName == 'Venezia')<img class ="img-fluid"src="{{asset('img/Venezia.jpg')}}" alt="">
            @endif
        </div>
        <h1>{{$cityName}}</h1>
    </div>
    <div class="discover-bottom">
        <section class="annunci">
            <div class="container">
            <h3>Appartamenti recenti a {{$cityName}}</h3>       
                <div class="row apartment d-flex flex-wrap "> 
                    @foreach ($apartments as $apartment)
                        @include('shared.components.Card')
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>

@endsection



