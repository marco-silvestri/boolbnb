@extends('layouts.app')
@section('content')
<h1 class="text-center text-5xl font-bold">Apartment Statistics</h1>
<div class="flex justify-center ">
    <div class="w1/2 pt-8">
        {!! $statisticChart->container() !!}  
    </div>
    <div class="w1/2">
        <h2 class="font-bold text-2xl px-24 pt-12">Some Title</h2>
            <p class="px-24">lorem ipsum</p> 
        </div>
        
    </div>
</div>




{!! $statisticChart->script() !!}

@endsection