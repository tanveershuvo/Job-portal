<!DOCTYPE html>
<html lang="{{App::getlocale()}}">

<head>
    <meta charset="utf-8">
    @if (config('app.env')=='production')
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('assets/images/logo.png')}}" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'JobPortal' }}</title>
    <!-- Scripts -->
    {{--  <script src="{{ asset('js/app.js') }}" {{ ! request()->is('payment*')? 'defer' : ''}}></script> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <script type='text/javascript'>
        var page_data = {!! pageJsonData() !!};
    </script>


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-170075362-1"></script>
    @yield('page-css')

</head>


<body
    class="{{request()->routeIs('home') ? ' home ' : ''}} {{request()->routeIs('job_view') ? ' job-view-page ' : ''}}">

    <div id="app">
        @yield('construction')
        <nav class="navbar navbar-expand-md navbar-toggleable-sm sticky-top navbar-custom">
            <div class="container">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <h3><img src=" {{asset('assets/images/logo.png')}}" width="30" height="30"
                            class="d-inline-block align-top" alt="" loading="lazy"> JobPortal</h3>
                </a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon">
                        <i class="fa fa-navicon"></i>
                    </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('home')}}">@lang('app.home')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('pricing')}}">@lang('app.pricing')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('jobs_listing')}}">@lang('app.jobs')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('contact_us')}}">@lang('app.contact_us')</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link btn btn-bd-post d-sm-inline-block mb-3 mb-md-0 ml-md-1"
                                href="{{route('post_new_job')}}">@lang('app.post_new_job')
                            </a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                        <div class="dropdown sm-ml-2">
                            <button class=" btn btn-dropdown nav-item dropdown-toggle" type="button"
                                data-toggle="dropdown">Login
                                <span class="caret"></span>
                            </button>
                            <div class="flex-column dropdown-menu dropdown-menu-right">
                                <div class="d-inline-flex flex-column login-flex p-2 mx-2 mb-2">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{asset('assets/images/job-seeker.svg')}}" style="height:100px;"
                                                alt="Job Seeker">
                                        </div>
                                        <div class="col-8">
                                            <h5><b>@lang('app.job_seeker')</b></h5>
                                            <p>@lang('app.job_seeker_new_desc')</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <a class="btn btn-outline-success col-6"
                                            href="{{route('register_job_seeker')}}"><i class="fa fa-user"
                                                aria-hidden="true"></i>
                                            @lang('app.register_account')
                                        </a>
                                        <a class="btn btn-light col-4 ml-4" href="{{ route('login') }}">
                                            <i class="fa fa-sign-in" aria-hidden="true"></i> {{ __('app.login') }}</a>
                                    </div>
                                </div>
                                <div class="d-inline-flex flex-column login-flex p-2 mx-2 mb-2">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{asset('assets/images/employees.svg')}}" style="height:110px;"
                                                alt="reqruiter">
                                        </div>
                                        <div class="col-8">
                                            <h5><b>@lang('app.employer')</b></h5>
                                            <p>@lang('app.employer_new_desc')</p>
                                        </div>

                                    </div>
                                    <div class="row justify-content-center">
                                        <a class="btn btn-outline-primary col-6"
                                            href="{{route('register_employer')}}"><i class="fa fa-user"
                                                aria-hidden="true"></i>
                                            @lang('app.register_account')
                                        </a>
                                        <a class="btn btn-light col-4 ml-4" href="{{ route('login') }}">
                                            <i class="fa fa-sign-in" aria-hidden="true"></i> {{ __('app.login') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <li class=" nav-item">
                            @if (Route::has('new_register'))
                            <a class="nav-link" href="{{ route('new_register') }}">
                                @lang('app.register')</a>
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
                                <a class="dropdown-item" href="{{route('dashboard')}}">{{__('app.dashboard')}}</a>
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
                    <div class="btn-group ml-sm-2 mt-2 mt-lg-0" role="group">
                        <form action="{{route('language')}}" method="post">
                            @csrf
                            <input type="hidden" name="locale" value="en">
                            <button type="submit"
                                class="btn btn-outline-light btn-sm @if(Session::get('locale') == 'en' || App::getlocale() == 'en'){ {{'active'}} }@endif"><b>EN
                                </b></button>
                        </form>
                        <form action="{{route('language')}}" method="post">
                            @csrf
                            <input type="hidden" name="locale" value="bn">
                            <button type="submit"
                                class="btn btn-outline-light btn-sm @if(Session::get('locale') == 'bn'){ {{'active'}} }@endif"><b>বাংলা</b>
                            </button>
                        </form>
                    </div>
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
                            <a class="navbar-brand" href="{{ route('dashboard') }}">
                                <h3>
                                    <img src=" {{asset('assets/images/logo-alt.png')}}" width="40" height="40"
                                        class="d-inline-block align-top" alt="logo-alt" loading="lazy"> JobPortal</h3>
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
                        <div class="footer-menu-wrap mt-2 text-center">
                            <h4 class="mb-3">Social links</h4>
                            <a href="" class="btn btn-social-icon btn-circle-facebook mr-2">
                                <span class="fa fa-facebook"></span>
                            </a>
                            <a href="" class="btn btn-social-icon btn-circle-google mr-2">
                                <span class="fa fa-google"></span>
                            </a>
                            <a href="" class="btn btn-social-icon btn-circle-linkedin mr-2">
                                <span class="fa fa-linkedin"></span>
                            </a>
                            <a href="" class="btn btn-social-icon btn-circle-github mr-2">
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

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @yield('page-js')

</body>

</html>
