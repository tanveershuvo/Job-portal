@extends('layouts.theme')
@section('page-css')
@endsection
@section('content')
    <div class="container py-4">
        <div class="d-flex  border flex-md-row flex-column bg-white p-3">
            <div class="mr-auto col-md-8 p-2">
                <h3 class="mb-4 text-success">@lang('app.job-seeker-register')</h3>
                @include('flash_message')
                <form action="{{route('register_job_seek')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (!empty(session('arr')))
                        @php
                            $name = session('arr.name');
                            $email = session('arr.email');
                        @endphp
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">@lang('app.name') <span class="mendatory-mark">*</span></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="@if(isset($name)){{$name}}@else{{ old('name') }}@endif"
                                   placeholder="@lang('app.your_name')" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Gender<span class="mendatory-mark"> *</span></label><br>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-success active">
                                    <input type="radio" name="gender" checked autocomplete="off" value="Male"><i
                                        class="fa fa-male"></i> Male
                                </label>

                                <label class="btn btn-outline-success mx-2">
                                    <input type="radio" name="gender" autocomplete="off" value="Female">
                                    <i class="fa fa-female"></i> Female
                                </label>

                                <label class="btn btn-outline-success">
                                    <input type="radio" name="gender" autocomplete="off" value="Other"> <i
                                        class="fa fa-transgender"></i>
                                    Other
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">@lang('app.email_address') <span class="mendatory-mark">*</span></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="@if(isset($email)){{$email}}@else{{ old('email') }}@endif"
                                   placeholder="@lang('app.email_ie')">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="phone">Mobile Number</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">+880</div>
                                </div>
                                <input id="phone" type="text"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       name="phone" value="{{ old('phone') }}"
                                       placeholder="@lang('app.contact_ex')">

                            </div>

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">@lang('app.password') <span class="mendatory-mark">*</span></label>
                            <div class="input-group">
                                <input type="password" id="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password">
                                <div class="input-group-append" id="icon-click">
                                    <div class="input-group-text"><i class="fa fa-eye"></i></div>
                                </div>
                            </div>
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                Password must be contain minimum 8 characters with letters and numbers.
                            </small>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password-confirm">@lang('app.confirm_password') <span
                                    class="mendatory-mark">*</span></label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation"
                                   required>
                        </div>
                    </div>

                    <div class="form-group row mb-0 mt-3">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="btn btn-success btn-block">
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

