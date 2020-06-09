<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! !empty($title) ? $title : 'JobFair' !!}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" {{ ! request()->is('payment*')? 'defer' : ''}}></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('assets/css/bootsrapSocial.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @yield('page-css')
    <script type='text/javascript'>
        /*
    <![CDATA[ */
        var page_data = {!! pageJsonData() !!};
        /* ]]> */
    </script>

</head>

<body
    class="{{request()->routeIs('home') ? ' home ' : ''}} {{request()->routeIs('job_view') ? ' job-view-page ' : ''}}">

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-toggleable-sm sticky-top navbar-custom">
            <div class="container">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <img src=" {{asset('assets/images/logo.png')}}" width="30" height="30"
                        class="d-inline-block align-top" alt="" loading="lazy">
                    <span style="color:#ffe484 !important;font-weight:bold;">JobPortal</span>
                </a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon">
                        <i class="fa fa-navicon" style="color:#ffffff;font-size:26px;"></i>
                    </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link" href="{{route('home')}}">
                                @lang('app.home')</a> </li>

                        <li class="nav-item"><a class="nav-link" href="{{route('pricing')}}">@lang('app.pricing')</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{route('jobs_listing')}}">
                                @lang('app.jobs')</a> </li>
                        <li class="nav-item"><a class="nav-link" href="{{route('blog_index')}}"> @lang('app.blog')</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{route('contact_us')}}">
                                @lang('app.contact_us')</a> </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                            <a class="nav-link btn btn-bd-post d-sm-inline-block mb-3 mb-md-0 ml-md-1"
                                href="{{route('post_new_job')}}">{{__('app.post_new_job')}}
                            </a>
                        </li>

                        <!-- Authentication Links -->
                        @guest
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                        {{ __('app.login') }}</a>
                        </li> --}}
                        <div class="dropdown ml-2">
                            <button class=" btn btn-dropdown nav-item dropdown-toggle" type="button"
                                data-toggle="dropdown">Login
                                <span class="caret"></span></button>
                            {{-- <li class="dropdown-menu" style="width: 18rem;"> --}}
                            <div class="flex-column dropdown-menu dropdown-menu-right"
                                style="width: 21rem;background-color:#F5F5F5;">
                                <div class="d-inline-flex flex-column login-flex p-2 mx-2 mb-2">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{asset('assets/images/employee.png')}}" width="100%" alt="">
                                        </div>
                                        <div class="col-8">
                                            <h5 class="" style="font-weight:bold;">@lang('app.job_seeker')</h5>
                                            <p>@lang('app.job_seeker_new_desc')</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">

                                        <a class="btn btn-outline-success col-5"
                                            href="{{route('register_job_seeker')}}"><i class="fa fa-user"
                                                aria-hidden="true"></i>
                                            @lang('app.register_account') </a>

                                        <a class="btn btn-light col-4 ml-4" href="{{ route('login') }}">
                                            <i class="fa fa-sign-in" aria-hidden="true"></i> {{ __('app.login') }}</a>
                                    </div>
                                </div>
                                <div class="d-inline-flex flex-column login-flex p-2 mx-2 mb-2">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{asset('assets/images/enterprises.png')}}" width="100%" alt="">
                                        </div>
                                        <div class="col-8">
                                            <h5 class="" style="font-weight:bold;">@lang('app.employer')</h5>
                                            <p>@lang('app.employer_new_desc')</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">

                                        <a class="btn btn-outline-primary col-5"
                                            href="{{route('register_employer')}}"><i class="fa fa-user"
                                                aria-hidden="true"></i>
                                            @lang('app.register_account') </a>

                                        <a class="btn btn-light col-4 ml-4" href="{{ route('login') }}">
                                            <i class="fa fa-sign-in" aria-hidden="true"></i> {{ __('app.login') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <li class=" nav-item">
                            @if (Route::has('new_register'))
                            <a class="nav-link" href="{{ route('new_register') }}">
                                {{ __('app.register') }}</a>
                            @endif
                        </li>
                        @else
                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="la la-user"></i> {{ Auth::user()->name }}
                                <span class="badge badge-warning"><i
                                        class="la la-briefcase"></i>{{auth()->user()->premium_jobs_balance}}</span>
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('dashboard')}}">{{__('app.dashboard')}} </a>


                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="main-container">
            @yield('content')
        </div>

        <div id="main-footer" class="main-footer text-dark pt-5 pb-2">

            <div class="container text-md-left text-center">
                <div class="row">
                    <div class="col-md-3">
                        <div class="footer-logo-wrap mb-3">
                            <a class="navbar-brand " href="{{ url('/') }}">
                                <h3 class="text-dark"> JobPortal</h3>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="footer-menu-wrap mt-2">
                            <h4 class="mb-3">@lang('app.job_seeker')</h4>
                            <ul class="list-unstyled">
                                <li><a href="{{route('register_job_seeker')}}">@lang('app.create_account')</a> </li>
                                <li><a href="{{route('jobs_listing')}}">@lang('app.search_jobs')</a> </li>
                                <li><a href="{{route('applied_jobs')}}">@lang('app.applied_jobs')</a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="footer-menu-wrap  mt-2">
                            <h4 class="mb-3">@lang('app.employer')</h4>
                            <ul class="list-unstyled">
                                <li><a href="{{route('register_employer')}}">@lang('app.create_account')</a> </li>
                                <li><a href="{{route('post_new_job')}}">@lang('app.post_new_job')</a> </li>
                                <li><a href="{{route('pricing')}}">@lang('app.buy_premium_package')</a> </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="footer-menu-wrap  mt-2">
                            <h4 class="mb-3">Social links</h4>


                            <a href="https://www.facebook.com/" target="_blank"
                                class="btn btn-social-icon btn-circle-facebook text-light mr-2">
                                <span class="fa fa-facebook"></span>
                            </a>
                            <a class="btn btn-social-icon btn-circle-google text-light mr-2">
                                <span class="fa fa-google"></span>
                            </a>
                            <a class="btn btn-social-icon btn-circle-linkedin text-light mr-2">
                                <span class="fa fa-linkedin"></span>
                            </a>
                            <a style="border-radius: 5 !important;"
                                class="btn btn-social-icon btn-circle-github text-light mr-2">
                                <span class="fa fa-github"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer-copyright-text-wrap text-center mt-5">
                            <p>Copyright © 2020 JobPortal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Scripts -->
    @yield('page-js')
    <script src="{{ asset('assets/js/main.js') }}" defer></script>

</body>

</html>