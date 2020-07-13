@extends('layouts.app')
@section('content')
@include('shared.components.Leaflet-include')

    <div class="container">

        <div class="jumbotron pt-5 pb-5">
            {{-- Need a review before going to production --}}
            @if ($apartment->id <= 5 )
                <img width="50%" src="{{$apartment->img}}" alt="{{ $apartment->name }}">
            @else
                <img width="50%" src="{{asset('storage/' . $apartment->img)}}" alt="{{ $apartment->name }}">
            @endif
            <h1>{{ $apartment->name }}</h1>   
        </div>
        
        <div class="description d-flex pb-20">
            <div class="col">
                <h2 class="mb-10">Descrizione</h2>
                <p>{{ $apartment->description }}</p>
            </div>
            <div class="col">
                <h2>Servizi</h2>
                <ul>
                    <li>Numero di stanze: {{$apartment->room_numbers}}</li>
                    <li>Numero di posti letto: {{$apartment->beds}}</li>
                    <li>Numero di bagni: {{$apartment->bathrooms}}</li>
                    <li>Metri quadrati: {{$apartment->square_meters}} mq</li>
                    <li>Indirizzo: {{$apartment->address}}</li>
                </ul>
            </div>
        </div>

        @include('shared.components.Maps')

        <div class="options">
            @foreach ($sponsorships as $sponsorship)
                <div class="form-check">
                    @if ($sponsorship->duration == 24)
                        <input type="hidden" name="duration" value="{{$sponsorship->duration}}">
                        <input class="form-check-input" type="radio" name="sponsorship" value="{{$sponsorship->id}}" checked>
                        <label>{{$sponsorship->price}}€ per {{$sponsorship->duration / 24}} giorno</label>
                    @else
                        <input type="hidden" name="duration" value="{{$sponsorship->duration}}">
                        <input class="form-check-input" type="radio" name="sponsorship" value="{{$sponsorship->id}}">
                        <label>{{$sponsorship->price}}€ per {{$sponsorship->duration / 24}} giorni</label>
                    @endif
                </div>
            @endforeach
            <button class="go-to-payment btn btn-primary">Sponsorizza</button>
        </div>

        <div class="container">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div id="dropin-container"></div>
                <button id="submit-button">Request payment method</button>
              </div>
            </div>
        </div>

        
       <script>
         var button = document.querySelector('#submit-button');
     
         braintree.dropin.create({
           authorization: "{{ Braintree\ClientToken::generate() }}",
           container: '#dropin-container'
         }, function (createErr, instance) {
           button.addEventListener('click', function () {
             instance.requestPaymentMethod(function (err, payload) {
               $.get('{{ route('payment.process') }}', {payload}, function (response) {
                 if (response.success) {
                   alert('Payment successfull!');
                 } else {
                   alert('Payment failed');
                 }
               }, 'json');
             });
           });
         });
       </script>

      
    </div>
    
@endsection