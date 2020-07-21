@extends('layouts.theme')
@section('page-css')
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="checkout-page py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>@lang('app.checkout')</h1>
            </div>
        </div>
    </div>
</div>


<div class="checkout-page bg-white py-5">

    @php
    $user= auth()->user();
    @endphp

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="checkout-form pt-3 pb-5">

                    <form method="post">
                        @csrf

                        <p>{{$user->name}}</p>
                        <h4>Package: {{$package->package_name}}</h4>
                        <p>@lang('app.premium_job') : {{$package->premium_job}}</p>
                        <p class="text-success">@lang('app.price') : {!! get_amount($package->price) !!}</p>

                        <button class="btn btn-primary btn-lg" id="sslczPayBtn" token="if you have any token validation"
                            postdata="your javascript arrays or objects which requires in backend"
                            order="If you already have the transaction generated for current order"
                            endpoint="{{ url('/pay-via-ajax') }}"> Pay
                            Now
                        </button>


                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('page-js')



@endsection