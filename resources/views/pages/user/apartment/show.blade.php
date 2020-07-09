@extends('layouts.app')
@section('content')

<div class="container">
    <h1>show user</h1>
    <div class="col-sm-3 ">
        <div class="card">
            <div class="card-body">
                <img class="card-img-top" src="{{ $apartment->img }}" alt="{{ $apartment->title }}">
                <h5 class="card-title">{{ $apartment->name }}</h5>
                <p class="card-text">{{ $apartment->description }}</p>
            </div>
        </div>
    </div>
</div>
               
@endsection