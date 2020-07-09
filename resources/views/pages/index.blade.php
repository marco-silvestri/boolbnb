@extends('layouts.app')
@include('shared.components.Leaflet-include')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>Questa sarà la index</h1>
    </div>
    <div class="container">
        @foreach ($apartments as $apartment)
            @include('shared.components.Card')
        @endforeach
    </div>
</div>
@endsection
