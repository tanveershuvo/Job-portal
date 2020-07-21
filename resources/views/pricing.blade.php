@extends('layouts.theme')

@section('content')

<div class="pricing-section bg-white py-5 ">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="pricing-section-heading mb-5 text-center">
          <h1>Pricing</h1>
          <h5 class="text-muted">Choose a package to unlock Premium/Regular jobs posting ability.</h5>
          <h5 class="text-muted">To get a large amount of quality application, choose the premium package</h5>
        </div>
      </div>
    </div>

    @if (Session::has('success'))
    <div class="alert alert-success col-md-6">
      {{Session::get('success')}}
    </div>
    @endif
    <div class="row">

      <div class="col-xs-12 col-md-4">
        <div class="pricing-table-wrap bg-light pt-5 pb-5 text-center">
          <h1 class="display-4">{{ get_option('currency_sign')}} 0</h1>
          <h3>Free</h3>

          <div class="pricing-package-ribbon pricing-package-ribbon-light">Regular</div>

          <p class="mb-2 text-muted"> No Premium Job Post</p>
          <p class="mb-2 text-muted"> Unlimited Regular Job Post</p>
          <p class="mb-2 text-muted"> Unlimited Applicants</p>
          <p class="mb-2 text-muted"> Dashboard access to manage application</p>
          <p class="mb-2 text-muted"> No support available</p>

          <a href="{{route('new_register')}}" class="btn btn-success mt-4"><i class="la la-user-plus"></i>
            Sign Up</a>
        </div>
      </div>

      @foreach($packages as $package)
      <div class="col-xs-12 col-md-4">
        <div class="pricing-table-wrap bg-light pt-5 pb-5 text-center">
          <h1 class="display-4">{{ get_option('currency_sign')}} {{$package->price}}</h1>
          <h3>{{$package->package_name}}</h3>
          <div class="pricing-package-ribbon pricing-package-ribbon-green">Premium</div>

          <p class="mb-2 text-muted"> {{$package->premium_job}} Premium Jobs Post</p>
          <p class="mb-2 text-muted"> Unlimited Regular Job Post</p>
          <p class="mb-2 text-muted"> Unlimited Applicants</p>
          <p class="mb-2 text-muted"> Dashboard access to manage application</p>
          <p class="mb-2 text-muted"> E-Mail support available</p>
          @auth
          <form action="{{route('stripeCheckout')}}" method="post">
            @csrf
            <input type="hidden" name="amount" value="{{$package->price}}">
            <input type="submit" class="btn btn-success mt-4" value="Purchase Here!"
              data-key="pk_test_51H7O04B1SFSETAH5hrCTSj3ymIU2bqjVBEXHzeXu2GyKhaNuRjkc47CoFjxHVtT4VsSxjVV5dnfoIYau4uKfECFa00PgR9wsVv"
              data-name="Payment of  {{$package->price}}" data-description="Job Portal Package purchase">
          </form>
          @else
          <a href="{{url('/login')}}" class="btn btn-success mt-4">Sign up to Purchase!</a>
          @endauth

        </div>
      </div>
      @endforeach
    </div>


  </div>
</div>


@endsection

@section('page-js')

<script src="https://checkout.stripe.com/checkout.js"></script>

<script>
  $(document).ready(function() {
            $(':submit').on('click', function(event) {
                event.preventDefault();

                var $button = $(this),
                    $form = $button.parents('form');

                var opts = $.extend({}, $button.data(), {
                    token: function(result) {
                        $form.append($('<input>').attr({ type: 'hidden', name: 'stripeToken', value: result.id })).submit();
                    }
                });

                StripeCheckout.open(opts);
            });
        });
</script>
@endsection