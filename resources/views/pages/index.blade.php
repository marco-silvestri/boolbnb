@extends('layouts.app')
@section('content')
@include('shared.components.Leaflet-include')

    <div class="container">
        <div class="row justify-content-center">
            <h1>Questa sarà la index</h1>
        </div>

        <form action="{{ route('guest.search') }}" method="POST">
            @csrf
            @method('POST')
            <input type="text" name="address" id="address-input" placeholder="Trova un appartamento... o lascia il campo vuoto per trovare appartamenti intorno a te">
            <input type="submit" value="Cerca">
        </form>

        <div class="container">
            
        </div>
    </div>

    <div class="container">
        <div class="container">
            <div class="row">
                @foreach ($apartments as $apartment)
                    @include('shared.components.Card')
                @endforeach
            </div>
        </div>
    </div>
@endsection
