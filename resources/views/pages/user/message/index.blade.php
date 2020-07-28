@extends('layouts.app')
@section('content')

<div class="container text-center msx"> 
    @if($totalMex > 0)
    
    
    <div class="container">
        <h1 class="title-message mb-5">Ciao {{ $user_name }}, hai {{ $totalMex }} messaggi:</h1>
        

        <div class="message">
            @foreach ($messageForApartment as $message)
            @foreach ($message as $item)
                <div class="messagecard">
                    <div class="sender">
                        <h6>Mittente:</h6>
                        <span>{{ $item->email }}</span>
                    </div>
                    <div class="messageapartment">
                        <h6>Appartamento:</h6>
                        <span>{{ $item->apartment->name }}</span>
                    </div>
                    <div class="messagetitle">
                        <h6>Oggetto:</h6>
                        <span>{{ $item['title'] }}</span>
                    </div>
                    <div class="messagebody">
                        <h6>Contenuto:</h6>
                        <p>{{ $item['body'] }}</p>
                    </div>
                    <div class="creationdate">
                        <em>Ricevuto {{ $item['created_at']->diffForHumans()}}</em>
                    </div>
                    <div class="reply">
                        <a href="mailto:{{ $item->email }}">Rispondi al messaggio</a>
                    </div>
                </div>
            @endforeach
        @endforeach
        </div>
        
    </div>
    @elseif($feedBack==2 && $totalMex == 0)
        <h1 class="mb-5">Ciao {{ $user_name }}, non hai nessun messaggio</h1>

    @elseif($feedBack==1)
    <h1 class="mb-5">Ciao {{ $user_name }}, inserisci il tuo primo appartamento per poter ricevere messaggi!</h1>
    <button type="button" class="submit btn btn-primary">
         <a class ="text-white" href="{{ route('user.apartment.create')}}">Aggiungi Appartamento</a>
    </button>
       
    @endif
</div>

@endsection
