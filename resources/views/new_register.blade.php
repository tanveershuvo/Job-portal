@extends('layouts.theme')

@section('content')
{{-- <div class="new-registration-page py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="register-account-box jf-shadow p-3">
                        <h2>@lang('app.job_seeker')</h2>
                        <p class="icon"><i class="la la-user"></i> </p>
                        <p>@lang('app.job_seeker_new_desc')</p>
                        <a href="{{route('register_job_seeker')}}" class="btn btn-success"><i
    class="la la-user-plus"></i> @lang('app.register_account') </a>
</div>
</div>

<div class="col-md-4">
    <div class="register-account-box jf-shadow  p-3">
        <h2>@lang('app.employer')</h2>
        <p class="icon"><i class="la la-black-tie"></i> </p>
        <p>@lang('app.employer_new_desc')</p>
        <a href="{{route('register_employer')}}" class="btn btn-success"><i class="la la-user-plus"></i>
            @lang('app.register_account') </a>
    </div>
</div>

<div class="col-md-4">
    <div class="register-account-box jf-shadow  p-3">
        <h2>@lang('app.agency')</h2>
        <p class="icon"><i class="la la-user-secret"></i> </p>
        <p>@lang('app.agency_new_desc')</p>
        <a href="{{route('register_agent')}}" class="btn btn-success"><i class="la la-user-plus"></i>
            @lang('app.register_account') </a>
    </div>
</div>
</div>
</div>
</div> --}}



<div class="new-registration-page pb-3 pt-3">
    <div class="container col-md-11 col-sm-8">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-5 text-center">
                    <h1>Create Account</h1>
                    <h5 class="text-muted">Select an account to register</h5>
                </div>
            </div>
        </div>

        <div class="row mb-4 justify-content-center">
            <div class="card card-custom col-md-3 mx-4 mb-2 text-center">
                <div class="card-body">
                    <h4 class="card-title" style="color:#4b9c1c;">
                        @lang('app.job_seeker')
                    </h4>
                    <hr>
                    <img style="" src="{{asset('assets/images/employee.png')}}" width="60%" class="mb-3" />
                    <p class="card-text">@lang('app.job_seeker_new_desc')</p>
                    <a href="{{route('register_job_seeker')}}" class="btn btn-success"><i class="fa fa-user"
                            aria-hidden="true"></i>
                        @lang('app.register_account') </a>
                </div>
            </div>

            <div class="card card-custom col-md-3 mx-4 text-center">
                <div class="card-body">
                    <h4 class="card-title" style="color:#3490dc;">
                        @lang('app.employer')
                    </h4>
                    <hr>
                    <img style="" src="{{asset('assets/images/enterprises.png')}}" width="60%" class="mb-3" />
                    <p class="card-text">@lang('app.employer_new_desc')</p>
                    <a href="{{route('register_employer')}}" class="btn btn-primary"><i class="fa fa-user"
                            aria-hidden="true"></i>
                        @lang('app.register_account') </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection