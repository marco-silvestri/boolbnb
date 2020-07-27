@extends('layouts.app')
@section('content') 
    @if (session('hasDeleted'))
        <div class="alert alert-success container">
            <p>L'appartamento {{session('hasDeleted')}} è stato eliminato correttamente </p>
        </div>
    @endif
    <div class="container">
        <div class="dashboard">
            <h1>Ciao {{ $user_name }}, ecco i tuoi appartamenti:</h1>
            @foreach ($apartmentsForUser as $apartment)
            <div class="box">
                <div class="img">
                    @include('shared.components.Img')
                </div>
                <div class="box-info">
                    <div class="info">
                        <div class="details">
                            <span>{{ $apartment->name }}</span>
                            <span>{{ $apartment->address }}</span>
                            {{-- <span>Aggiunto il: {{ $apartment->created_at->format('d/m/Y') }}</span>
                            <span>Ultima modifica: {{ $apartment->created_at->diffForHumans()}}</span> --}}
                        </div>
                        
                        <div class="visibility-sponsor">
                          <div>
                                {{-- <i @if ($apartment->visibility == 0) style="color:grey; opacity: 0.3;" @else style="color:$lightblue;" @endif class="fas fa-binoculars"></i> --}}
                                <i @if ($apartment->visibility == 0) class="novisible fas fa-binoculars"  @else class="fas fa-binoculars"  @endif></i>
                                
                            </div>
                            <div>
                                <i @if ($apartment->sponsorship_expiration == NULL) class="novisible fas fa-credit-card"  @else class="fas fa-credit-card"  @endif></i>
                            </div>
                        </div>
                        <div class="date">
                            <span>Aggiunto il: {{ $apartment->created_at->format('d/m/Y') }}</span>
                            <span>Ultima modifica: {{ $apartment->created_at->diffForHumans()}}</span>
                        </div>

                    </div>
                    <div class="link">
                        <a class="button" href="{{route('user.apartment.show', $apartment->id)}}"><i class="far fa-eye"></i></a>
                        <a class="buttontext" href="{{route('user.apartment.show', $apartment->id)}}"> <span>Mostra Dettagli</span> </a>

                        <a class="button" href="{{route('user.apartment.edit', $apartment->id)}}"><i class="far fa-edit"></i></a>
                        <a class="buttontext" href="{{route('user.apartment.edit', $apartment->id)}}"><span>Modifica</span></a>

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
                            <a class="tooltips buttontext" data-toggle="tooltip" data-placement="top" title="Delete">
                                <button type="submit" onclick="return confirm('Sei sicuro di voler cancellare il tuo appartamento?');">
                                    <span>Cancella appartamento</span>
                                </button>
                            </a>
                        </form>


                    </div>
                </div>                    
            </div>
        @endforeach
        {{-- Apartments pagination --}}
        <div class="d-flex justify-content-center paginate">
            {{ $apartmentsForUser->links() }}
        </div>
        </div>
    </div>
@endsection
