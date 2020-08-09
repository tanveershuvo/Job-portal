@extends('layouts.theme')

@section('content')
<div class="pricing p-4">
    <div class="container ">
        <div class="row">
            <div class="col-md-12 text-center mb-2">
                <h3 class="mb-3">Checkout Payment</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="card col-md-8">

                <div class="card-body text-center">
                    @if (Session::has('msg'))
                    <div class="alert alert-{{Session::get('msg.status')}}">
                        {{Session::get('msg.data')}}
                    </div>
                    @endif
                    <input type="hidden" id="package_id" name="package_id" value="{{$package->id}}">
                    <h3 class="card-title">You chose {{$package->package_name}} package!</h3>
                    <h5 class="card-subtitle my-2 alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i> You will be charged BDT
                        <strong>{{$package->price}}</strong>
                        .
                    </h5>

                    <p class="card-text"> Now, click on one of the payment method in
                        order to buy the selected
                        package.</p>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"></li>
                        <li class="list-group-item">
                            <h5>Payment Method 1 : Stripe Payment</h5>
                            <button class="btn btn-success col-md-4 text-uppercase my-3" id="checkout-button"><span
                                    id="spinner"></span> Stripe
                                Checkout</button>
                        </li>
                        <li class="list-group-item">
                            <h5 class="mt-2">Payment Method 2 : SSL Commerz Payment</h5>
                            <button class="btn btn-primary col-md-6 text-uppercase my-3" id="sslczPayBtn" token=""
                                postdata="" order="blank" endpoint="{{ url('/pay-via-ajax') }}">
                                SSL Payment </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('page-js')
<script src=" https://js.stripe.com/v3/"> </script>
<script>
    $(document).ready(function() {
        var stripe = Stripe("{{config('stripe.key')}}");
        var elements = stripe.elements();
        var checkoutButton = document.getElementById('checkout-button');
        var package_id = $('#package_id').val();
        var option = 'stripe';

        checkoutButton.addEventListener('click', function() {
            event.preventDefault();
            $('#spinner').addClass('spinner-border spinner-border-sm');
            $.ajax({
                url: "{{route('createSession')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: { package_id:package_id, option:option},
                success: function(response) {
                    console.log(response);
                    stripe.redirectToCheckout({
                        sessionId: response.id
                    });
                },
                error: function(xhr) {
                    var res = xhr.responseJSON;
                    console.log(res.message);
                }
            })
        });
    });
</script>
{{--  SSLCOMMERZ  --}}
{{--  var obj = {};
    obj.package_id = $('#package_id').val();
    obj.option = 'sslcommerz';
    $('#sslczPayBtn').prop('postdata', obj);  --}}
<script>
    $(document).ready(function() {
    var loader = function () {
        var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
        // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
        script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
        tag.parentNode.insertBefore(script, tag);
    };

    window.addEventListener ? window.addEventListener("load", loader, true) : window.attachEvent("onload", loader);
});

</script>



@endsection
