@extends('layouts.app')
@section('content')
@include('shared.components.Leaflet-include')

  
    <div class="container">
        @include('shared.components.ShowFeedback')

        <div class="jumbotron pt-5 pb-5">
        <img width="50%" src="{{asset('storage/images/' . $apartment->img . '.jpg')}}" alt="{{ $apartment->name }}">
            <h1>{{ $apartment->name }}</h1>
            <span>Messaggi totali per questo appartamento: {{$message}}</span> 
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

        @guest       
            @include('shared.components.message')
            @else
                {{-- Conditional redirect to User Owner --}} 
                    @if ($apartment->user_id != Auth::id())
                        @include('shared.components.Message')                    
                    @endif
                </a>
         @endguest

        <div class="options">
            <input type="hidden" name="id" value="{{$apartment->id}}">
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

        <div class="box-paypal d-none container">
            <div class="paypal">

                <div id="dropin-container"></div>
                <button type="submit" id="submit-button">Conferma pagamento</button>
                <button class="back-button">Indietro</button>
                <div class="payment-successfull-box d-none">
                    <div class="payment-successfull-alert">
                        Pagamento andato a buon fine 
                    </div>
                    <button class="refresh-button d-none">OK</button>
                </div>
            </div>
        </div>

        


        
       <script>

            //======= visualizzazione box pagamento
            $('button.go-to-payment').on('click', function () {
                $('.box-paypal').removeClass("d-none");
            });

            $('button.back-button').on('click', function () {
            $('.box-paypal').addClass("d-none");
            });

            /* $('.refresh-button').click(function () {
            window.location.reload();
            }); */


            var button = document.querySelector('#submit-button');
        
            braintree.dropin.create({

            authorization: "sandbox_ndpvxw96_p2rgw5gr73v27n6f",
            container: '#dropin-container'

            }, function (createErr, instance) {

            button.addEventListener('click', function () {

                instance.requestPaymentMethod(function (err, payload) {

                    $.get('{{ route('payment.process') }}', {payload}, function (response) {
                        if (response.success) {

                            var inputSponsorship = $("input[name='sponsorship']:checked").val();
                            var apartmentId = $("input[name='id']").val();
                            console.log(inputSponsorship);
                            console.log("app" + apartmentId);

                            console.log('Payment success');

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                                }
                            });
                
                            $.ajax({
                                url: "/user/store_sponsorship",
                                type: "POST",
                                data: {

                                    radioVal: inputSponsorship,
                                    apartId: apartmentId

                                },
                                success: function (data) {
                                    console.log('data: ',  data);
                                },
                                error: function (data) {
                                    console.log('Error:', data);
                                }
                            });

                        

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