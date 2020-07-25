@extends('layouts.app')
@section('content')

<div class="container text-center"> 
    @if($totalMex > 0)
    
    
    <div class="container">
        {{-- <table class="table">
            <thead>
                <tr class="text-primary">
                    <th>Mittente:</th>
                    <th>Appartamento:</th>
                    <th>Title:</th>
                    <th>Contenuto:</th>
                    <th>Ricevuto:</th>
                </tr> 
            </thead>
            <tbody>
                @foreach ($messageForApartment as $message)
                        @foreach ($message as $item)
                        <tr>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->apartment->name }}</td>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['body'] }}</td>
                            <td>{{ $item['created_at']->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table> --}}
        <div class="message">
            <h1 class="mb-5">Ciao {{ $user_name }}, hai {{ $totalMex }} messaggi:</h1>
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
                        <span>{{ $item['body'] }}</span>
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
    <button type="button" class="btn btn-primary">
         <a class ="text-white"href="{{ route('user.apartment.create')}}">Aggiungi Appartamento</a>
    </button>
       
    @endif
</div>

@endsection
