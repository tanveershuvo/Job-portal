@extends('layouts.theme')

@section('content')
    <div class="container py-4">

        <div class="d-flex border flex-md-row flex-column bg-white p-3">
            <div class="mr-auto col-md-12">
                <h3 class="mb-5 text-center">@lang('app.company_register')</h3>
                <form method="POST" action="">
                    @csrf
                    <h4 class="mb-3">Account Information</h4>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="email">@lang('E-Mail Address')
                                <span class="mendatory-mark">*</span></label>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="password">@lang('Password')
                                <span class="mendatory-mark">*</span></label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="password-confirm">@lang('Confirm
                                Password')</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation">
                        </div>
                    </div>
                    <hr>
                    <h4 class="mb-3">Company Details Information</h4>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="company_name">@lang('app.company') Name
                                <span class="mendatory-mark">*</span></label>

                            <input id="company_name" type="text"
                                   class="form-control @error('company_name') is-invalid @enderror "
                                   name="company_name"
                                   value="{{ old('company_name') }}" autofocus>

                            @error('company_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="company_name">Industry Type
                                <span class="mendatory-mark">*</span></label>

                            <select class="form-control" name="category" id="category">
                                <option value="">@lang('app.select_category')</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">
                                        {{$category->category_name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone"
                               class="col-md-4 col-form-label text-md-right">@lang('app.phone') <span
                                class="mendatory-mark">*</span></label>
                        <div class="col-md-6">
                            <input id="phone" type="text"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   name="phone" value="{{ old('phone') }}" autofocus>

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address"
                               class="col-md-4 col-form-label text-md-right">@lang('app.address')
                            <span class="mendatory-mark">*</span></label>
                        <div class="col-md-6">
                            <input id="address" type="text"
                                   class="form-control @error('address') is-invalid @enderror"
                                   name="address"
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
                                   class="form-control @error('address_2') is-invalid @enderror"
                                   name="address_2"
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
                            <select name="district"
                                    class="form-control @error('district') is-invalid @enderror"
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
@endsection
