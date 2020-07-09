@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       
        <h1>Questa sarà la index</h1>
        <a href="{{route('index')}}">Index</a>
    </div>


    <div class="container">
        @dump($hasApartments)
        @dump($apartmentsForUser)
    </div>
</div>



@endsection
