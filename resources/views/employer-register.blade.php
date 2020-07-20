@extends('layouts.theme')

@section('content')
<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('app.company_register')</div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Name') <span
                                    class="mendatory-mark">*</span></label>

                            <div class="col-md-6">
                                <input id="employeer_name" type="text"
                                    class="form-control  @error('employeer_name') is-invalid @enderror"
                                    name="employeer_name" value="{{ old('employeer_name') }}" autofocus>

                                @error('employeer_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="company" class="col-md-4 col-form-label text-md-right">@lang('app.company')
                                <span class="mendatory-mark">*</span></label>
                            <div class="col-md-6">
                                <input id="company" type="text"
                                    class="form-control @error('company') is-invalid @enderror " name="company"
                                    value="{{ old('company') }}" autofocus>

                                @error('company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">@lang('E-Mail Address')
                                <span class="mendatory-mark">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">@lang('Password')
                                <span class="mendatory-mark">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">@lang('Confirm
                                Password')</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation">
                            </div>
                        </div>

                        <legend>Contact Information</legend>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">@lang('app.phone') <span
                                    class="mendatory-mark">*</span></label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') }}" autofocus>

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">@lang('app.address')
                                <span class="mendatory-mark">*</span></label>
                            <div class="col-md-6">
                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address') }}" autofocus>

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="address_2"
                                class="col-md-4 col-form-label text-md-right">@lang('app.address_2')</label>
                            <div class="col-md-6">
                                <input id="address_2" type="text"
                                    class="form-control @error('address_2') is-invalid @enderror" name="address_2"
                                    value="{{ old('address_2') }}">

                                @error('address_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="district" class="col-md-4 col-form-label text-md-right">
                                District
                                <span class="mendatory-mark">*</span></label>
                            <div class="col-md-6">
                                <select name="district" class="form-control @error('district') is-invalid @enderror"
                                    autofocus>
                                    <option disabled selected value="">
                                        location
                                    </option>
                                    @foreach (allDistricts() as $district)
                                    <option value="{{$district['name']}}" @if(old('district') &&
                                        $district['name']==old('district')) selected="selected" @endif>
                                        @if(App::getlocale()=='en')
                                        {{$district['name']}}
                                        @elseif(App::getlocale()=='bn')
                                        {{$district['bn_name']}}
                                        @endif
                                    </option>
                                    @endforeach
                                </select>
                                @error('district')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class=" form-control btn btn-success">
                                    <i class="la la-save"></i> @lang('Register')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection