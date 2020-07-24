@extends('layouts.app')
@section('content')

<div class="container">
    <div class="create">

        @if (session('hasDeleted'))
            <div class="alert alert-success">
                <p>L'appartamento {{session('hasDeleted')}} è stato eliminato correttamente </p>
                <p>Non hai nessun appartamento creane uno</p>
            </div>
        @endif

        @if ($hasApartments == false)
            <h2>Aggiungi il tuo <strong>primo</strong> appartamento</h2>
        @elseif($hasApartments == true)
            <h1>Aggiungi un nuovo Appartamento </h1>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- //form create -->
        <form action="{{route('user.apartment.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="form-group">
                <input id="name" type="text" class="form-control" name="name" placeholder="Nome appartamento" value ="{{ old('name') }}">
            </div>
            <div class="form-group">
                <input type="text" name="address" id="address-input" placeholder="Inserisci l'indirizzo" value ="{{ old('address') }}">
            </div>
            <div class="form-group">
                <textarea id="description" rows="2" cols="25" placeholder="Inserisci una descrizione"
                class="form-control" name="description" value="{{ old('description') }}"></textarea>
            </div>

            <div class="services">
                <div class="form-group">
                    <input id="beds" type="number" min="1" class="form-control" name="beds" placeholder="Numero letti" value ="{{ old('beds') }}">
                </div>            
    
                <div class="form-group">
                    <input id="room_number" type="number" min="1" class="form-control" name="room_numbers" placeholder="Numero stanze" value ="{{ old('room_numbers') }}">
                </div>
    
                <div class="form-group">
                    <input id="bathrooms" type="number" min="1" class="form-control" name="bathrooms" placeholder="Numero bagni" value ="{{ old('bathrooms') }}">
                </div>
    
                <div class="form-group">
                    <input id="square_meters" type="number" min="1" class="form-control" name="square_meters" placeholder="Numero metri quadrati" value ="{{ old('square_meters') }}">
                </div>
            </div>

            <label class="name-options">Aggiungi opzioni</label>
            <div class="options">
                @foreach ($options as $option)
                    <div class="form-check">
                        <input type="checkbox" name="options[]" id="option-{{ $loop->iteration }}" value="{{ $option->id }}">
                        <label for="option-{{ $loop->iteration }}"> {{ $option->name }}</label>
                    </div>
                @endforeach
            </div>

            <div class="img-visibility">

                <div class="img">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input " id="img" name="img" accept="image/*">
                        <label class="custom-file-label apt-name" for="img">
                            
                                Carica una foto
                            
                        </label>
                    </div>
                </div>

                <!-- Gestione visibilità annuncio -->
                <div class="visibility">
                    <span>Visibilità annuncio:</span>
                    <div class="form-group">
                        <div class="visible">
                            <input type="radio" id="yes" name="visibility" value="1" checked>
                            <label for="yes">Visibile</label>
                        </div>

                        <div class="no-visible">
                            <input type="radio" id="no" name="visibility" value="0">
                            <label for="no">Non visibile</label> 
                        </div>
                    </div>
                </div>
    
            </div>

            <div class="submit">
                <input class ="btn btn-primary" type="submit" value="Crea Appartamento">
            </div>
            
        </form>
    </div>
</div>
    
@endsection
