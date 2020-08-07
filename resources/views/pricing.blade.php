@extends('layouts.theme')

@section('page-css')

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
@endsection

@section('content')
<div class="pricing py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="pricing-section-heading mb-4 mt-0 text-center">
                    <h1>Pricing</h1>
                    <h5 class="text-muted">Choose your pricing package</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Free Tier -->
            <div class="col-lg-4">
                <div class="card mb-5 mb-lg-0">
                    <div class="card-body">
                        <h5 class="card-title text-muted text-uppercase text-center">Free</h5>
                        <h6 class="card-price text-center">৳0</h6>
                        <hr>
                        <ul class="fa-ul">
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>
                                <strong>Unlimited Regular Job Post</strong>
                            </li>
                            <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>0 Premimum Job
                                Post
                            </li>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Applicants</li>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Dashboard access to manage
                                application</li>
                            <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>E-Mail support
                            </li>

                        </ul>
                        @guest
                        <a href="{{route('new_register')}}" class="btn btn-block btn-success text-uppercase">Sign
                            In!</a>
                        @endguest
                    </div>
                </div>
            </div>
            <!-- Plus Tier -->

            @foreach($packages as $package)
            <div class="col-lg-4">
                <div class="card mb-5 mb-lg-0 " style="background-color:#faf9b3;">
                    <div class="card-body">
                        <h5 class="card-title text-muted text-uppercase text-center">{{$package->package_name}}</h5>
                        <h6 class="card-price text-center">৳{{$package->price}}</h6>
                        <hr>
                        <ul class="fa-ul">
                            <li><span class="fa-li"><i class="fas fa-check"></i></span><strong>Unlimited Regular Job
                                    Post</strong></li>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>
                                <strong>{{$package->premium_job}}</strong>
                                Premimum Job Post</li>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Applicants</li>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Dashboard access to manage
                                application</li>
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>E-Mail support</li>

                        </ul>
                        @auth
                        <a href="{{route('payment_options',['package' =>$package->id])}}"
                            class="btn btn-block btn-success text-uppercase">Purchase Now!</a>
                        @else
                        <a href="{{url('/login')}}" class="btn btn-block btn-primary text-uppercase">Sign in to
                            Purchase!</a>
                        @endauth

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>



{{--  <div class="pricing-section bg-white py-5 ">
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
@guest
<a href="{{route('new_register')}}" class="btn btn-success mt-4"><i class="la la-user-plus"></i>
    Sign Up</a>
@endguest
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
        {{--  <form action="{{route('paymentOptions')}}" method="post">
        @csrf
        <input type="hidden" name="package_id" value="{{$package->id}}">
        <button class="btn btn-success mt-4">Purchase Now!</button>
        </form> --}}
        {{--  <a href="{{route('payment_options',['package' =>$package->id])}}" class="btn btn-success mt-4">Purchase
        Now!</a>
        @else
        <a href="{{url('/login')}}" class="btn btn-success mt-4">Sign up to Purchase!</a>
        @endauth

    </div>
</div>
@endforeach
</div>


</div>
</div> --}}


@endsection
