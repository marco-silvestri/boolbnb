@extends('layouts.app')
@section('content') 

    @if (session('hasDeleted'))
        <div class="alert alert-success">
            <p>L'appartamento {{session('hasDeleted')}} è stato eliminato correttamente </p>
        </div>
    @endif
    
    <div class="container">
        @foreach ($apartmentsForUser as $apartment)
            <div class="box">

                <div class="img">
                    @include('shared.components.Img')
                </div>


                <div class="box-info">

                    <div class="info">

                        <div class="details">
                            <span>Nome: {{ $apartment->name }}</span>
                            <span>Indirizzo: {{ $apartment->address }}</span>
                            <span>Aggiunto il: {{ $apartment->created_at->format('d/m/Y') }}</span>
                            <span>Ultima modifica: {{ $apartment->created_at->diffForHumans()}}</span>
                        </div>

                        <div class="visibility-sponsor">
                            <div>
                                @if ($apartment->visibility == 0)
                                <img src="{{asset('img/no-visibility.png')}}" alt=""> 
                                Non Visibile
                                @else 
                                <img src="{{asset('img/visibility.png')}}" alt=""> 
                                Visibile
                                @endif
                            </div>
                            <div>
                                @if ($apartment->sponsorship_expiration != NULL) 
                                <img src="{{asset('img/credit-card.png')}}" alt="">
                                Sponsor
                                @else 
                                <img src="{{asset('img/no-credit-card.png')}}" alt="">
                                No Sponsor
                                @endif
                            </div>
                        </div>
 
                    </div>

                    <div class="link">
                        
                        <a class="btn btn-primary" href="{{route('user.apartment.show', $apartment->id)}}">SHOW</a>
                        
                        <a class="btn btn-success" href="{{route('user.apartment.edit', $apartment->id)}}">EDIT</a>
                        
                        <form action="{{route('user.apartment.destroy', $apartment->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="Delete">
                        </form>
                        
                    </div>
                    
                </div>
                    
            </div>
        @endforeach
    </div>



   
@endsection

{{-- @extends('layouts.app')
@section('content') 
    @if (session('hasDeleted'))
        <div class="alert alert-success">
            <p>L'appartamento {{session('hasDeleted')}} è stato eliminato correttamente </p>
        </div>
    @endif




    <div class="container text-center"> 
        <!-- Per far apparire l'user_id lo passo nel compact in Apartment controller  -->
        <h1 class="mb-5">Ciao utente {{ $user_name }}, qua di seguito trovi i tuoi appartamenti:</h1>
    
        
            
        <div class="container">
            <table class="table">
                <thead>
                    <tr class="text-primary">
                        <th> </th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Creato:</th>
                        <th>Ultima modifica:</th>
                        <th>Visibilità</th>
                        <th>Sponsorship</th>
                        <th colspan="3"></th>
                    </tr> 
                </thead>
                <tbody>
                    @foreach ($apartmentsForUser as $apartment)
                        <tr>
                            <td>@include('shared.components.Img')</td>
                            <td>{{ $apartment->name }}</td>
                            <td>{{ $apartment->address }}</td>
                            <td> <span>{{ $apartment->created_at->format('d/m/Y') }}</span> <span>({{ $apartment->created_at->diffForHumans() }})</span></td>
                            <td>{{ $apartment->updated_at->diffForHumans()  }}</td>
                            <td>@if ($apartment->visibility == 0) <i class="fas fa-eye-slash"></i> @else <i class="fas fa-eye"></i> @endif</td>
                            <td>@if ($apartment->sponsorship_expiration != NULL) <i class="fas fa-crown"></i> @else No sponsor @endif</td>
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
        <!-- Impaginazione appartamenti -->
        <div class="d-flex justify-content-center">
            {{ $apartmentsForUser->links() }}
        </div>
    </div>
@endsection --}}
