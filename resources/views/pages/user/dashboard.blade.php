@extends('layouts.app')

@section('content')
<div class="container text-center">

      
        {{-- <h1>Questa sarà la index</h1> --}}
        <div><a href="{{route('index')}}">Index</a></div>
        
        
    
    {{-- Per far apparire l'user_id lo passo nel compact in Apartment controller --}}
    <h1 class="mb-5">Ciao utente {{ $user_name }}, qua di seguito trovi i tuoi appartamenti:</h1>
   
   
    {{-- @dump($hasApartments)
        @dump($apartmentsForUser) --}}
        
    <div class="container">
        <table class="table">
            <thead>
                <tr class="text-primary">
                    <th>Name</th>
                    <th>Beds</th>
                    <th>Rooms Number</th>
                    <th>Square meters</th>
                    <th>Address</th>
                    <th colspan="3"></th>
                </tr> 
            </thead>
            <tbody>
                @foreach ($apartmentsForUser as $item)
                <tr>
                    <td> {{ $item->name }}</td>
                    <td>{{ $item->beds }}</td>
                    <td>{{ $item->room_numbers }}</td>
                    <td>{{ $item->square_meters }}</td>
                    <td>{{ $item->address }}</td>
                    <td><a class="btn btn-primary" href="#">SHOW</a></td>
                    <td><a class="btn btn-success" href="#">EDIT</a></td>
                    <td><a class="btn btn-danger" href="#">DELETE</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        


    </div>
</div>



@endsection
