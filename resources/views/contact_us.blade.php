@extends('layouts.theme')

@section('content')
    <div class="contact p-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="pricing-section-heading mb-3 text-center">
                        <h1>Contact UU</h1>
                    </div>
                </div>
            </div>

            <div class="box row col-offset-2">
                <div class="col-md-5" style="background-color:#957db8da;">
                    <img src="{{asset('assets/images/aa.png')}}" width="100%" height="100%" alt="">
                </div>
                <div class="col-md-7 bg-white pt-4">
                    @include('admin.flash_msg')
                    <form method="POST" action="">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-3 control-label">@lang('app.name') <span
                                    class="text-danger">*</span>:</label>

                            <div class="col-md-8">
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-3 control-label">@lang('app.email_address') <span
                                    class="text-danger">*</span>:</label>

                            <div class="col-md-8">
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subject" class="col-md-3 control-label">@lang('app.subject') <span
                                    class="text-danger">*</span> :</label>

                            <div class="col-md-8">
                                <input id="subject" type="text"
                                       class="form-control @error('subject') is-invalid @enderror"
                                       name="subject" value="{{ old('subject') }}">
                                @error('subject')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="message" class="col-md-3 control-label">@lang('app.message')</label>
                            <div class="col-md-8">
                        <textarea name="message" class="form-control @error('message') is-invalid @enderror"
                                  rows="5">{{ old('message') }}</textarea>
                                @error('message')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-envelope-o"></i> @lang('app.send_feedback')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
