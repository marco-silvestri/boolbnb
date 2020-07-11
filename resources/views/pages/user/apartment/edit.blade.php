@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit posts</h1>
  
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
            <label for="name">Modifica nome appartamento</label>
            <input class="form-control" type="text" name="name" id="name" value="{{ old('title', $apartment->name) }}">
        </div>
    
        <div class="form-group">
            <label for="body">Modifica descrizione appartamento</label>
            <textarea class="form-control" name="description" id="description">{{ old('description', $apartment->description)}}</textarea>
        </div>

        <div class="form-group">
            <label for="beds">Modifica numero letti</label>
            <input class="form-control" type="number" min="1" name="beds" id="beds" value="{{ old('beds', $apartment->beds) }}">
        </div>

        <div class="form-group">
            <label for="room_numbers">Modifica numero stanze</label>
            <input class="form-control" type="number" min="1" name="room_numbers" id="room_numbers" value="{{ old('room_numbers', $apartment->room_numbers) }}">
        </div>

        <div class="form-group">
            <label for="bathrooms">Modifica numero bagni</label>
            <input class="form-control" type="number" min="1" name="bathrooms" id="bathrooms" value="{{ old('bathrooms', $apartment->bathrooms) }}">
        </div>

        <div class="form-group">
            <label for="square_meters">Modifica numero metri quadrati</label>
            <input class="form-control" type="number" min="1" name="square_meters" id="square_meters" value="{{ old('square_meters', $apartment->square_meters) }}">
        </div>

        <div class="form-group">
            <label for="address">Modifica indirizzo</label>
            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', $apartment->address) }}">
        </div>

        <div class="form-group">
            <label for="path_img">
                <span class="d-block">Post img</span>
                @isset($apartment->img)
                    @if ($apartment->id <= 5)
                        <img width="100%" src="{{$apartment->img}}" alt="{{ $apartment->title }}">
                    @else
                        <img width="100%" src="{{asset('storage/' . $apartment->img)}}" alt="{{ $apartment->title }}">
                    @endif

                    {{-- <img width="200" src="{{asset('storage/' . $apartment->img)}}" alt="{{ $apartment->name}}"> --}}
    
                    <h6 class="mt-4" >Change</h6>
                @endisset
            </label>
            <input class="form-control p-1" type="file" name="img" id="img" accept="image/*" value ="{{ old('img', $apartment->img) }}">
        </div>
        {{--  --}}
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
    
    
        <input class="btn btn-primary" type="submit" value="Edit"> 
        </form>
    
      
  </div>

@endsection