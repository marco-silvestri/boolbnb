@extends('layouts.app')

@section('content')
<div class="container">

    <div class="edit">
        <h1 class="mb-4">Modifica Appartamento</h1>
  
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
  
        <form action="{{route('user.apartment.update', $apartment->id)}}" method="POST" enctype="multipart/form-data">
            
            @csrf
            @method('PATCH')
        
            <div class="form-group">
                <label for="name">Modifica il nome dell'appartamento</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ old('title', $apartment->name) }}">
            </div>
        
            <div class="form-group">
                <label for="body">Modifica la descrizione dell'appartamento</label>
                <textarea class="form-control" name="description" id="description">{{ old('description', $apartment->description)}}</textarea>
            </div>

            <div class="form-group">
                <label for="address">Modifica l'indirizzo</label>
                <input class="form-control" type="text" name="address" id="address-input" value="{{ old('address', $apartment->address) }}">
            </div>

            <div class="services">
                <div class="form-group">
                    <label for="beds">Modifica il numero dei letti</label>
                    <input class="form-control" type="number" min="1" max="15" name="beds" id="beds" value="{{ old('beds', $apartment->beds) }}">
                </div>
        
                <div class="form-group">
                    <label for="room_numbers">Modifica il numero delle stanze</label>
                    <input class="form-control" type="number" min="1" max="20" name="room_numbers" id="room_numbers" value="{{ old('room_numbers', $apartment->room_numbers) }}">
                </div>
        
                <div class="form-group">
                    <label for="bathrooms">Modifica il numero dei bagni</label>
                    <input class="form-control" type="number" min="1" max="10" name="bathrooms" id="bathrooms" value="{{ old('bathrooms', $apartment->bathrooms) }}">
                </div>
        
                <div class="form-group">
                    <label for="square_meters">Modifica il numero dei metri quadrati</label>
                    <input class="form-control" type="number" min="1" max="500" name="square_meters" id="square_meters" value="{{ old('square_meters', $apartment->square_meters) }}">
                </div>
            </div>

            <div class="img-options-visibility">

                <div class="img">
                    <label for="path-img">
                        <span class="d-block">Immagine Appartamento</span>
                        @include('shared.components.Img')
                        <span class="mt-4">Scegli una nuova immagine</span>
                    </label>
    
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="img" name="img" accept="image/*" value ="{{ old('img', $apartment->img) }}">
                        <label class="custom-file-label apt-name" for="img">
                            Carica una foto
                        </label>
                    </div>
                </div>

                <div class="options-visibility">

                    <div class="options">
                        <span class="name-options">Modifica opzioni</span>
                        @foreach ($options as $option)
                            <div class="form-check">
                                <input type="checkbox" name="options[]" id="option-{{ $loop->iteration }}" value="{{$option->id }}"
                                @if ($apartment->options->contains($option->id))
                                    checked
                                @endif
                                >
                                <label for="option-{{ $loop->iteration }}"> {{ $option->name}}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="visibility">
                        <span>Visibilità annuncio:</span>
                        <div class="form-group">
                            <div class="visible">
                                <input type="radio" id="yes" name="visibility" value="1" @if ($apartment->visibility == 1)
                                checked
                                @endif>
                                <label for="yes">Visibile</label>
                            </div>

                            <div class="no-visible">
                                <input type="radio" id="no" name="visibility" value="0"  @if ($apartment->visibility == 0)
                                checked
                                @endif>
                                <label for="no">Non visibile</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="button">
                <input class="btn" type="submit" value="Edit"> 
            </div>

        </form>
    </div>
</div>

@endsection

