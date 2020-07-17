@extends('layouts.app')
@section('content')

<div class="container text-center"> 
    @if($totalMex > 0)
    {{-- Per far apparire l'user_id lo passo nel compact in Apartment controller --}}
    <h1 class="mb-5">Ciao {{ $user_name }}, hai {{ $totalMex }} Messaggi non letti:</h1>
    <div class="container">
        <table class="table">
            <thead>
                <tr class="text-primary">
                    <th>Appartamento:</th>
                    <th>Mittente:</th>
                    <th>Title:</th>
                    <th>Contenuto:</th>
                    <th>Ricevuto:</th>
                </tr> 
            </thead>
            <tbody>
                @foreach ($messageForApartment as $message)
                        @foreach ($message as $item)
                        <tr>
                            <td>{{ $item->apartment->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['body'] }}</td>
                            <td>{{ $item['created_at'] }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
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
