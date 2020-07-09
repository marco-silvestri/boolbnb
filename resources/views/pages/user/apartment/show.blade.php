@extends('layouts.app')
@section('content')

    

<div class="col-sm-3">
    <div class="card">
        <div class="card-body">
            <img class="card-img-top" src="{{ $apartment->img }}" alt="{{ $apartment->title }}">
            <h5 class="card-title">{{ $apartment->name }}</h5>
            <p class="card-text">{{ $apartment->description }}</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
            
        </div>
    </div>
</div>
               
@endsection