@extends('layouts.app')

@section('content') 
    @if (session('hasDeleted'))
        <div class="alert alert-success">
            <p>L'appartamento {{session('hasDeleted')}} è stato eliminato correttamente </p>
        </div>
    @endif




<div class="container text-center"> 
    
    {{-- Per far apparire l'user_id lo passo nel compact in Apartment controller --}}
    <h1 class="mb-5">Ciao utente {{ $user_name }}, qua di seguito trovi i tuoi appartamenti:</h1>
   
    {{-- @dump($hasApartments)
        @dump($apartmentsForUser) --}}
        
    <div class="container">
        <table class="table">
            <thead>
                <tr class="text-primary">
                    <th>id</th>
                    <th>Name</th>
                    <th>Beds</th>
                    <th>Rooms Number</th>
                    <th>Square meters</th>
                    <th>Address</th>
                    <th>Visibilità</th>
                    <th colspan="3"></th>
                </tr> 
            </thead>
            <tbody>
                @foreach ($apartmentsForUser as $apartment)
                    <tr>
                        
                        <td>{{ $apartment->id }}</td>
                        <td>{{ $apartment->name }}</td>
                        <td>{{ $apartment->beds }}</td>
                        <td>{{ $apartment->room_numbers }}</td>
                        <td>{{ $apartment->square_meters }}</td>
                        <td>{{ $apartment->address }}</td>
                        <td>@if ($apartment->visibility == 0) No @else Si @endif</td>
                        <td><a class="btn btn-primary" href="{{route('user.apartment.show', $apartment->id)}}">SHOW</a></td>
                        <td><a class="btn btn-success" href="{{route('user.apartment.edit', $apartment->id)}}">EDIT</a></td>
                        <td>
                            <form action="{{route('user.apartment.destroy', $apartment->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

     {{-- Impaginazione appartamenti --}}
     <div class="d-flex justify-content-center">
        {{ $apartmentsForUser->links() }}
    </div>
</div>

    


@endsection
