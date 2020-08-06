@extends('layouts.theme')

@section('content')

<button id="checkout-button">stripe</button>

@endsection

@section('page-js')
<script src="https://js.stripe.com/v3/"></script>
<script>
    $(document).ready(function() {
    var stripe = Stripe("{{config('stripe.key')}}");
    var elements = stripe.elements();
    var checkoutButton = document.getElementById('checkout-button');

    checkoutButton.addEventListener('click', function() {
            event.preventDefault();
            $.ajax({
                url : "{{route('createSession')}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                success: function (response) {
                    stripe.redirectToCheckout({
                        sessionId: response.id
                    });
                },
                error : function (xhr) {
                    var res = xhr.responseJSON;
                    console.log(res.message);
                }
            })
        });
    });

</script>

@endsection
