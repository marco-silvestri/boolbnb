@extends('layouts.app')
@section('content') 
    @if (session('hasDeleted'))
        <div class="alert alert-success container">
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
                        <a class="btn btn-primary" href="{{route('user.apartment.show', $apartment->id)}}">Show</a>
                        <a class="btn btn-success" href="{{route('user.apartment.edit', $apartment->id)}}">Edit</a>
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
