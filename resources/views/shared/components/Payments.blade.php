<div class="options">
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
        <input type="hidden" name="id" value="{{$apartment->id}}">
    </div>
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