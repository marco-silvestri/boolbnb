@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>

        @if ($hasApartments == false)
        <h2>Aggiungi il tuo primo appartamento</h2>
        @endif
    </div>

@endsection