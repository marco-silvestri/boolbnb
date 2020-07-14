@extends('layouts.app')
@section('content')

<div class="container text-center"> 
    @if($mex == true)
    {{-- Per far apparire l'user_id lo passo nel compact in Apartment controller --}}
    <h1 class="mb-5">Ciao {{ $user_name }}, qua di seguito trovi i tuoi Messaggi:</h1>
    <div class="container">
        <table class="table">
            <thead>
                <tr class="text-primary">
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
                            <td>{{ $item->apartment->name }}</td>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['body'] }}</td>
                            <td>{{ $item['created_at'] }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <h1 class="mb-5">Ciao {{ $user_name }}, non hai nessun messaggio</h1>
    @endif
</div>



@endsection
