@extends('layouts.theme')

@section('content')
    <div class="pricing py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="pricing-section-heading mb-4 mt-0 text-center">
                        <h1>Pricing</h1>
                        <h5 class="text-muted">Choose Recruiters pricing package</h5>
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
                                <li><span class="fa-li"><i class="fa fa-check"></i></span>
                                    <strong>Unlimited Regular Job Post</strong>
                                </li>
                                <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>0 Premimum
                                    Job
                                    Post
                                </li>
                                <li><span class="fa-li"><i class="fa fa-check"></i></span>Unlimited Applicants</li>
                                <li><span class="fa-li"><i class="fa fa-check"></i></span>Dashboard access to manage
                                    application
                                </li>
                                <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>E-Mail
                                    support
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
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span><strong>Unlimited Regular
                                            Job
                                            Post</strong></li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>
                                        <strong>{{$package->premium_job}}</strong>
                                        Premimum Job Post
                                    </li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Unlimited Applicants</li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Dashboard access to manage
                                        application
                                    </li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>E-Mail support</li>

                                </ul>
                                @auth
                                    <a href="{{route('payment_options',['package' =>$package->id])}}"
                                       class="btn btn-block btn-success text-uppercase">Purchase Now!</a>
                                @else
                                    <a href="{{url('/login')}}" class="btn btn-block btn-primary text-uppercase">Sign in
                                        to
                                        Purchase!</a>
                                @endauth

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


@endsection
