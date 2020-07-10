@extends('layouts.app')
@section('content')

<div class="container">
    <h1>show user</h1>
    <div class="col-sm-3 ">
        <div class="card">
            <div class="card-body">

            <!-- NEED A REVIEW BEFORE GOING TO PRODUCTION -->
            @if ($apartment->id <= 15)
                 <img width = "200" class="apt-image" src="{{$apartment->img}}" alt="">
            @else
                <img width = "200" class="apt-image" src="{{asset('storage/' . $apartment->img)}}" alt="">
             @endif
                <h5 class="card-title">{{ $apartment->name }}</h5>
                <p class="card-text">{{ $apartment->description }}</p>
            </div>
        </div>
    </div>
</div>
               
@endsection