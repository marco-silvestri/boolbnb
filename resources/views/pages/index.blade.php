@extends('layouts.app')
@section('content')
@include('shared.components.Leaflet-include')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Questa sarà la index</h1>
        </div>

        <form action="#" method="GET">
            @csrf
            @method('GET')
            <input type="text" name="address" id="address-input" placeholder="Cerca un appartamento">
            <input type="hidden" name="latlong" id="latlong">
            <input type="submit" value="Cerca">
        </form>

        <div class="container">
            {{-- @dump($apartments) --}}
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <h1>Questa sarà la index</h1>
        </div>
        <div class="container">

            <div class="row">
                @foreach ($apartments as $apartment)

                    @include('shared.components.Card')
                @endforeach
            </div>
        </div>
    </div>
@endsection
