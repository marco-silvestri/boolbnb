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
                        <a class="button" href="{{route('user.apartment.show', $apartment->id)}}"><i class="far fa-eye"></i></a>
                        <a class="button" href="{{route('user.apartment.edit', $apartment->id)}}"><i class="far fa-edit"></i></a>
                        {{-- <form action="{{route('user.apartment.destroy', $apartment->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="Delete">
                        </form> --}}

                        
                         <form action="{{route('user.apartment.destroy', $apartment->id)}}" method="POST">
                             <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <a class="tooltips button" data-toggle="tooltip" data-placement="top" title="Delete">
                                <button type="submit" onclick="return confirm('Sei sicuro di voler cancellare il tuo appartamento?');">
                                    <i class="fa fa-trash-alt" aria-hidden="true"></i>
                                </button>
                            </a>
                        </form>


                    </div>
                </div>                    
            </div>
        @endforeach
         {{-- Apartments pagination --}}
    <div class="d-flex justify-content-center">
        {{ $apartmentsForUser->links() }}
    </div>

    </div>
@endsection
