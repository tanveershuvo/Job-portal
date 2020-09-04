<!DOCTYPE html>
<html lang="{{App::getlocale()}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ !empty($title) ? $title : __('app.dashboard') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">

    @yield('page-css')

    <!-- Scripts -->


    <script type='text/javascript'>
        /* <![CDATA[ */
        var page_data = {!! pageJsonData() !!};
        /* ]]> */
    </script>

</head>

<body>
    @php
    $pendingJobCount = \App\Job::pending()->count();
    $approvedJobCount = \App\Job::approved()->count();
    $blockedJobCount = \App\Job::blocked()->count();
    $user = Auth::user();
    @endphp

    <div id="app">
        <nav class="navbar navbar-expand-md sticky-top navbar-light navbar-laravel">
            <div class="container-fluid">

                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <img src="{{asset('assets/images/logo.png')}}" width="30" height="30"
                        class="d-inline-block align-top" alt="" loading="lazy">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link" target="_blank" href="{{route('home')}}"><i
                                    class="la la-home"></i>
                                @lang('app.view_site')</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item badge badge-warning">
                            <a class="nav-link" style="font-size:15px;color:black;"> Balance :
                                {{--                                ৳{{auth()->user()->premium_jobs_balance}}--}}
                            </a>

                        </li>

                        <li class="nav-item"><a class="nav-link"
                                href="{{route('dashboard')}}">{{ Auth::user()->name }}</a></i>
                        </li>

                        <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <div id="main-container" class="main-container">

            <div class="row">
                <div class="col-md-3">

                    <div class="sidebar">
                        <ul class="sidebar-menu list-group">

                            <li class="{{request()->is('dashboard')? 'active' : ''}}">
                                <a href="{{route('dashboard')}}" class="list-group-item-action active">
                                    <span class="sidebar-icon"><i class="la la-home"></i> </span>
                                    <span class="title">@lang('app.dashboard')</span>
                                </a>
                            </li>

                            <li class="{{request()->is('dashboard/u/applied-jobs*')? 'active' : ''}}">
                                <a href="{{route('applied_jobs')}}" class="list-group-item-action active">
                                    <span class="sidebar-icon"><i class="la la-list-alt"></i> </span>
                                    <span class="title">@lang('app.applied_jobs')</span>
                                </a>
                            </li>

                            @if($user->is_admin())

                            <li class="{{request()->is('dashboard/categories*')? 'active' : ''}}">
                                <a href="{{route('dashboard_categories')}}" class="list-group-item-action active">
                                    <span class="sidebar-icon"><i class="la la-th-large"></i> </span>
                                    <span class="title">@lang('app.categories')</span>
                                </a>
                            </li>
                            @endif

                            @if( ! $user->is_user())


                            <li class="{{request()->is('dashboard/employer*')? 'active' : ''}}">
                                <a href="#" class="list-group-item-action">
                                    <span class="sidebar-icon"><i class="la la-black-tie"></i> </span>
                                    <span class="title">@lang('app.employer')</span>
                                    <span class="arrow"><i class="la la-arrow-right"></i> </span>
                                </a>

                                <ul class="dropdown-menu" style="display: none;">
                                    <li><a class="sidebar-link"
                                            href="{{route('post_new_job')}}">@lang('app.post_new_job')</a></li>
                                    <li><a class="sidebar-link"
                                            href="{{route('posted_jobs')}}">@lang('app.posted_jobs')</a></li>
                                    <li><a class="sidebar-link"
                                            href="{{route('employer_applicant')}}">@lang('app.applicants')</a></li>
                                    <li><a class="sidebar-link"
                                            href="{{route('shortlisted_applicant')}}">@lang('app.shortlist')</a></li>
                                    <li><a class="sidebar-link"
                                            href="{{route('employer_profile')}}">@lang('app.profile')</a></li>
                                </ul>
                            </li>

                            @endif

                            @if($user->is_admin())


                            <li class="{{request()->is('dashboard/jobs*')? 'active' : ''}}">
                                <a href="#" class="list-group-item-action">
                                    <span class="sidebar-icon"><i class="la la-briefcase"></i> </span>
                                    <span class="title">@lang('app.jobs')</span>
                                    <span class="arrow"><i class="la la-arrow-right"></i> </span>
                                </a>

                                <ul class="dropdown-menu" style="display: none;">
                                    <li><a class="sidebar-link" href="{{route('pending_jobs')}}">@lang('app.pending')
                                            <span
                                                class="badge badge-success float-right">{{$pendingJobCount}}</span></a>
                                    </li>
                                    <li><a class="sidebar-link" href="{{route('approved_jobs')}}">@lang('app.approved')
                                            <span class="badge badge-success float-right">{{$approvedJobCount}}</span>
                                        </a></li>
                                    <li><a class="sidebar-link" href="{{route('blocked_jobs')}}">@lang('app.blocked')
                                            <span class="badge badge-success float-right">{{$blockedJobCount}}</span>
                                        </a></li>
                                </ul>
                            </li>

                            <li class="{{request()->is('dashboard/flagged*')? 'active' : ''}}">
                                <a href="{{route('flagged_jobs')}}" class="list-group-item-action active">
                                    <span class="sidebar-icon"><i class="la la-flag-o"></i> </span>
                                    <span class="title">@lang('app.flagged_jobs')</span>
                                </a>
                            </li>
                            <li><a class="sidebar-link" href="{{route('pricing_settings')}}">
                                    <span class="sidebar-icon"><i class="la la-money"></i> </span>
                                    @lang('app.pricing')</a>
                            </li>


                            @endif

                            @if($user->is_admin())

                            {{--
                            <li>
                                <a href="{{route('dashboard')}}" class="list-group-item-action active">
                            <span class="sidebar-icon"><i class="la la-user-secret"></i> </span>
                            <span class="title">@lang('app.administrator')</span>
                            </a>
                            </li>
                            --}}
                            <li class="{{request()->is('dashboard/u/users*')? 'active' : ''}}">
                                <a href="{{route('users')}}" class="list-group-item-action active">
                                    <span class="sidebar-icon"><i class="la la-users"></i> </span>
                                    <span class="title">@lang('app.users')</span>
                                </a>
                            </li>

                            @endif

                            <li class="{{request()->is('dashboard/u/profile*')? 'active' : ''}}">
                                <a href="{{route('profile')}}" class="list-group-item-action active">
                                    <span class="sidebar-icon"><i class="la la-user"></i> </span>
                                    <span class="title">@lang('app.profile')</span>
                                </a>
                            </li>


                            <li class="{{request()->is('dashboard/account*')? 'active' : ''}}">
                                <a href="{{route('change_password')}}" class="list-group-item-action active">
                                    <span class="sidebar-icon"><i class="la la-lock"></i> </span>
                                    <span class="title">@lang('app.change_password')</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('logout') }}" class="list-group-item-action active"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="sidebar-icon"><i class="la la-sign-out"></i> </span>
                                    <span class="title">@lang('app.logout')</span>
                                </a>
                            </li>


                        </ul>
                    </div>

                </div>

                <div class="col-md-9">
                    <div class="main-page pr-4">

                        <div class="main-page-title mt-3 mb-3 d-flex">
                            <h3 class="flex-grow-1">{!! ! empty($title) ? $title : __('app.dashboard') !!}</h3>

                            <div class="action-btn-group">@yield('title_action_btn_gorup')</div>
                        </div>

                        @include('admin.flash_msg')

                        <div class="main-page-content p-4 mb-4">
                            @yield('content')
                        </div>


                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/admin.js') }}"></script>
    @yield('page-js')


</body>

</html>
