@extends('layouts.app')
@section('content')

<div class="container text-center"> 
    @if($totalMex > 0)
        <h1 class="mb-5">Ciao {{ $user_name }}, hai {{ $totalMex }} Messaggi non letti:</h1>
        @include('shared.components.UserMessages')

    @elseif($feedBack==2 && $totalMex == 0)
        <h1 class="mb-5">Ciao {{ $user_name }}, non hai nessun messaggio</h1>

    @elseif($feedBack==1)
    <h1 class="mb-5">Ciao {{ $user_name }}, inserisci il tuo primo appartamento per poter ricevere messaggi!</h1>
    <button type="button" class="btn btn-primary">
         <a class ="text-white"href="{{ route('user.apartment.create')}}">Aggiungi Appartamento</a>
    </button>
       
    @endif
</div>



@endsection
