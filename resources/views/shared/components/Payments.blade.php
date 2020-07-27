<div class="options">
    <div>
        @if ($apartment->sponsorship_expiration)
            <p>Scadenza sponsorizzazione: {{date('d/m/Y H:i', strtotime($apartment->sponsorship_expiration))}}</p>    
        @endif

        @if ($apartment->sponsorship_expiration == NULL )
            <h4>Compra il tuo primo abbonamento</h4>
            <p>Scegli un piano di sponsorizzazione.</p>
        @elseif ($apartment->sponsorship_expiration < now()->format('Y-m-d H:m:s'))
            <h4>Prolunga la tua sponsorizzazione</h4>
            <p>Aggiungi visibilità al tuo appartmento prolungando la tua sponsorizzazione oltre la data di scadenza. </p>
        @else
            <h4>Hai già un abonamento attivo</h4>
            <p>Comprane un'altro per aumentare la durata di sponsorizzazione</p> 
        @endif
    </div>  

    <div class="form-check">    
        @foreach ($sponsorships as $sponsorship)
        <div class="form-group">
            <input type="hidden" name="duration" value="{{$sponsorship->duration}}">
            <input class="form-check-input" type="radio" name="sponsorship" value="{{$sponsorship->id}}" 
                @if($loop->first) 
                    checked 
                @endif>
            <label>{{$sponsorship->price}}€ per {{$sponsorship->duration}} ore</label>
        </div>
        @endforeach
        <div class="submit">
            <input type="hidden" name="id" value="{{$apartment->id}}">
        </div>
    </div>
    <button class="go-to-payment btn btn-primary">Sponsorizza</button>
</div>

<div class="box-pay d-none">
    <div class="pay">

        <div id="dropin-container"></div>
        <button type="submit" id="submit-button">Conferma pagamento</button>
        <button class="back-button">Indietro</button>
        <div class="payment-successfull-box d-none">
            <div class="payment-successfull-alert">
                Pagamento andato a buon fine 
            </div>
            <button class="refresh-button d-none">OK</button>
        </div>

        <div class="payment-failed-box d-none">
            <div class="payment-failed-alert">
                Pagamento non andato a buon fine 
            </div>
            <button class="refresh-button d-none">OK</button>
        </div>
    </div>
</div>

<script>
    //======= visualizzazione box pagamento
    $('button.go-to-payment').on('click', function () {
        $('.box-pay').removeClass("d-none");
    });

    $('button.back-button').on('click', function () {
        $('.box-pay').addClass("d-none");
    });

    $('.refresh-button').click(function () {
        window.location.reload();
    });


    var button = document.querySelector('#submit-button');

    braintree.dropin.create({

    authorization: "sandbox_ndpvxw96_p2rgw5gr73v27n6f",
    container: '#dropin-container'

    }, function (createErr, instance) {

        button.addEventListener('click', function () {

            instance.requestPaymentMethod(function (err, payload) {

                $.get('{{ route('user.payment.process') }}', {payload}, function (response) {
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

                        $('.payment-successfull-alert').removeClass("d-none");
                        $('.refresh-button').removeClass("d-none");
                        $('.payment-successfull-box').removeClass("d-none");
                        $('#dropin-container').addClass("d-none");
                        $('#submit-button').addClass("d-none");
                        $('.back-button').addClass("d-none");

                    } else {
                        $('.payment-failed-alert').removeClass("d-none");
                        $('.refresh-button').removeClass("d-none");
                        $('.payment-failed-box').removeClass("d-none");
                        $('#dropin-container').addClass("d-none");
                        $('#submit-button').addClass("d-none");
                        $('.back-button').addClass("d-none");
                    /* alert('Payment failed');
                    window.location.reload(); */
                    }
                }, 'json');
            });
        });
    });
</script>