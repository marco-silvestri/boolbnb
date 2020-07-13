@extends('layouts.app')
@section('content')
<div class="container text-center"> 
    
    {{-- Per far apparire l'user_id lo passo nel compact in Apartment controller --}}
    <h1 class="mb-5">Ciao {{ $user_name }}, qua di seguito trovi i tuoi Messaggi:</h1>
        
    <div class="container">
        <table class="table">
            <thead>
                <tr class="text-primary">
                    <th>id</th>
                    <th>Title</th>
                    <th>Ricevuto:</th>
                    <th colspan="3"></th>
                </tr> 
            </thead>
            <tbody>
                @foreach ($messageForApartment as $message)
                    @foreach ($message as $item)
                    <tr>
                        
                        <td>{{ $item['id'] }}</td>
                        <td>{{ $item['title'] }}</td>
                        <td>{{ $item['created_at'] }}</td>
                        
                        <td><a class="btn btn-primary" href=#>SHOW</a></>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection
