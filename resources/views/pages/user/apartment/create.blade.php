@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Aggiungi un nuovo Appartamento </h1>

        @if ($hasApartments == false)
        <h2>Aggiungi il tuo primo appartamento</h2>
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
                <label for="name">Nome Appartamento</label>
                <input id="name" type="text" class="form-control" name="name" placeholder="Nome appartamento" value ="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="description">Descrizione Appartamento</label>
                <textarea id="description" class="form-control" name="description" value ="{{ old('description') }}"> </textarea>
            </div>

            <div class="form-group">
                <label for="beds">Numero Letti</label>
                <input id="beds" type="number" min="1" class="form-control" name="beds" placeholder="Numero letti" value ="{{ old('beds') }}">
            </div>            

            <div class="form-group">
                <label for="room_number">Numero Stanze</label>
                <input id="room_number" type="number" min="1" class="form-control" name="room_numbers" placeholder="Numero stanze" value ="{{ old('room_numbers') }}">
            </div>

            <div class="form-group">
                <label for="bathrooms">Numero Bagni</label>
                <input id="bathrooms" type="number" min="1" class="form-control" name="bathrooms" placeholder="Numero bagni" value ="{{ old('bathrooms') }}">
            </div>

            <div class="form-group">
                <label for="square_meters">Metri quadrati</label>
                <input id="square_meters" type="number" min="1" class="form-control" name="square_meters" placeholder="Numero metri quadrati" value ="{{ old('square_meters') }}">
            </div>

            <div class="form-group">
                <label for="address">Indirizzo</label>
                <input id="address" type="text" class="form-control" name="address" placeholder="Indirizzo dell'appartamento" value ="{{ old('address') }}">
            </div>

            <div class="form-group">
                <label for="img">Immagine appartamento</label>
                <input class = "form-control" type="file" name="img" id="img" accept="image/*">
            </div>

            @foreach ($options as $option)
            <div class="form-check">
                <input type="checkbox" name="options[]" id="option-{{ $loop->iteration }}" value="{{ $option->id }}">
                <label for="option-{{ $loop->iteration }}"> {{ $option->name }}</label>
            </div>
             @endforeach
            
            <input class ="btn btn-primary" type="submit" value="Crea Appartamento">
        </form>
    </div>

@endsection