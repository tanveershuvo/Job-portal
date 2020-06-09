@extends('layouts.theme')
@section('page-css')
@endsection
@section('content')
<div class="container py-4">
    <div class="d-flex border flex-md-row flex-column bg-white p-3">
        <div class="mr-auto col-md-8 p-2">
            <h3 class="mb-4 text-primary">Create Account {{ __('Register') }}</h3>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                        name="name" value="@if(!empty($name)){{'name'}}@else{{ old('name') }}@endif" required autofocus>

                    @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Gender</label><br>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="options" id="hatchback" autocomplete="off"><i
                                class="fa fa-male"></i> Male
                        </label>

                        <label class="btn btn-outline-primary mx-2">
                            <input type="radio" name="options" id="sedan" autocomplete="off">
                            <i class="fa fa-female"></i> Female
                        </label>

                        <label class="btn btn-outline-primary">
                            <input type="radio" name="options" id="suv" autocomplete="off"> <i
                                class="fa fa-transgender"></i> Others
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email" value="@if(!empty($arr['email'])){{$arr['email']}}@else{{ old('email') }}@endif"
                        required>

                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Mobile Number</label>
                    <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password"><span class="error">* </span>{{ __('Password') }}</label>
                    <input id="password" type="password"
                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                        required>

                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required>
                </div>
            </div>

            <div class="form-group row mb-0 mt-3">
                <div class="col-md-4 offset-md-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-save"></i> {{ __('Register') }}
                    </button>
                </div>
            </div>
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
            <a class="btn btn-social btn-linkedin col-8 my-2" style="color:white;"> <span class="fa fa-linkedin"></span>
                Import from LinkedIn
            </a>

        </div>

    </div>
</div>

@endsection