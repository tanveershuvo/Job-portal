@extends('layouts.theme')
@section('page-css')
@endsection
@section('content')
<div class="container py-4">
    <div class="d-flex border flex-md-row flex-column bg-white p-3">
        <div class="mr-auto col-md-8 p-2">
            <h3 class="mb-4 text-primary">@lang('app.register')</h3>
            @if (Session::has('message'))
            @php
            $message = Session::get('message');
            @endphp
            @foreach($message as $messages)
            <div class="alert alert-danger">
                <b>ERROR : {{ $messages['code'] }} </b> , {{ $messages['reason'] }}
            </div>
            @endforeach
            @endif
            <form action="{{route('register_job_seek')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">@lang('app.name') <span class="mendatory-mark">*</span></label>
                        <input id="name" type="text"
                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                            value="@if(!empty($arr['name'])){{$arr['name']}}@else{{ old('name') }}@endif"
                            placeholder="@lang('app.your_name')" required autofocus>

                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Gender</label><br>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary active">
                                <input type="radio" name="gender" autocomplete="off"><i class="fa fa-male"></i> Male
                            </label>

                            <label class="btn btn-outline-primary mx-2">
                                <input type="radio" name="gender" autocomplete="off">
                                <i class="fa fa-female"></i> Female
                            </label>

                            <label class="btn btn-outline-primary">
                                <input type="radio" name="gender" autocomplete="off"> <i class="fa fa-transgender"></i>
                                Others
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">@lang('app.email_address') <span class="mendatory-mark">*</span></label>
                        <input id="email" type="email"
                            class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                            value="@if(!empty($arr['email'])){{$arr['email']}}@else{{ old('email') }}@endif"
                            placeholder="@lang('app.email_ie')" required>

                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="contact">Mobile Number</label>
                        <input id="contact" type="text"
                            class="form-control {{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact"
                            value="{{ old('contact') }}" placeholder="@lang('app.contact_ex')">

                        @if ($errors->has('contact'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('contact') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">@lang('app.password') <span class="mendatory-mark">*</span></label>
                        <div class="input-group">
                            <input type="password" id="password"
                                class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                required>
                            <div class="input-group-append" id="icon-click">
                                <div class="input-group-text"><i class="fa fa-eye"></i></div>
                            </div>
                        </div>
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            Password must be contain minimum 8 characters with letters and numbers.
                        </small>

                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password-confirm">@lang('app.confirm_password') <span
                                class="mendatory-mark">*</span></label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required>
                    </div>
                </div>

                <div class="form-group row mb-0 mt-3">
                    <div class="col-md-4 offset-md-4">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fa fa-save"></i> @lang('Register')
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 border border-left bg-light text-center p-2 ml-2 mr-2">
            <h4 class="mb-5 mt-2">Import data from Social Sites</h4>
            <a href="{{ url('job-seeker-register/facebook') }}" class="btn btn-social btn-facebook col-8 my-2"
                style="color:white;">
                <span class="fa fa-facebook"></span>
                Import from facebook
            </a>
            <a class="btn btn-social btn-google col-8 my-2" style="color:white;"> <span class="fa fa-google"></span>
                Import from Google
            </a>
            <a href="{{ url('job-seeker-register/github') }}" class="btn btn-social btn-github col-8 my-2"
                style="color:white;"> <span class="fa fa-github"></span>
                Import from Github
            </a>
            <a href="{{ url('job-seeker-register/linkedin') }}" class="btn btn-social btn-linkedin col-8 my-2"
                style="color:white;"> <span class="fa fa-linkedin"></span>
                Import from LinkedIn
            </a>

        </div>

    </div>
</div>

@endsection
@section('page-js')
<script>
    $(document).ready(function() {
    $("#icon-click").on('click', function() {
        $('#icon-click i').toggleClass( "fa-eye-slash" );
    const pass = $('#password');
     if(pass.attr("type") == "password"){
    pass.attr('type', 'text');
    }else if(pass.attr("type") == "text"){
        pass.attr('type', 'password');

    }
    });
    });
</script>

@endsection