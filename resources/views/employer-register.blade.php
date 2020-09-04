@extends('layouts.theme')

@section('content')
    <div class="container py-4">
        <div class="d-flex border employee-register flex-md-row flex-column bg-white p-3">
            <div class="col-md-12">
                <h3 class="mb-5 text-center text-primary">Employer Registration</h3>
                @include('flash_message')
                <form method="POST" action="">
                    @csrf
                    <h4 class="mb-4">Account Information</h4>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="email">@lang('E-Mail Address')
                                <span class="mendatory-mark">*</span></label>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" placeholder="Type Email Address" value="{{ old('email') }}" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="password">@lang('app.password') <span class="mendatory-mark">*</span></label>
                            <div class="input-group">
                                <input type="password" id="password" placeholder="Type your password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       value="{{ old('password') }}">
                                <div class="input-group-append" id="icon-click">
                                    <div class="input-group-text"><i class="fa fa-eye"></i></div>
                                </div>
                            </div>
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                Password must contain minimum 8 characters with letters and numbers.
                            </small>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="password-confirm">@lang('Confirm
                                Password') <span class="mendatory-mark">*</span></label>
                            <input id="password-confirm" type="password" placeholder="Type password again"
                                   class="form-control "
                                   name="password_confirmation" value="{{ old('password_confirmation') }}">
                        </div>
                    </div>

                    <h4 class="mb-4">Company Details Information</h4>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="company_name">@lang('app.company') Name
                                <span class="mendatory-mark">*</span></label>
                            <input id="company_name" type="text"
                                   class="form-control @error('company_name') is-invalid @enderror "
                                   name="company_name" placeholder="Type company name"
                                   value="{{ old('company_name') }}">
                            @error('company_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="category">Industry Type
                                <span class="mendatory-mark">*</span></label>
                            <select class="form-control @error('category') is-invalid @enderror" name="category"
                                    id="category">
                                <option value="">@lang('app.select_category')</option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category->id}}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                        {{$category->category_name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <label for="company_name">Company Address
                        <span class="mendatory-mark">*</span></label><br>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <select class="form-control @error('division') is-invalid @enderror" name="division"
                                    id="division">
                                <option value="">Select Divison</option>
                                @foreach($divisions as $division)
                                    <option
                                        value="{{$division->id}}" {{ old('division') == $division->id ? 'selected' : '' }}>
                                        @langis('bn')
                                        {{$division->bn_name}}
                                        @elselangis
                                        {{$division->name}}
                                        @endlangis
                                    </option>
                                @endforeach
                            </select>
                            @error('division')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <select class="form-control @error('district') is-invalid @enderror" name="district"
                                    id="district">
                                <option value="">Select District</option>
                                @foreach($districts as $district)
                                    <option
                                        value="{{$district->id}}" {{ old('district') == $district->id ? 'selected' : '' }}>
                                        @langis('bn')
                                        {{$district->bn_name}}
                                        @elselangis
                                        {{$district->name}}
                                        @endlangis
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
                    <div class="form-group">
                        <textarea name="address" class="form-control  @error('address') is-invalid @enderror"
                                  id="address" rows="2"
                                  placeholder=" Write Company Address">{{ old('address') }}</textarea>
                        @error('address')
                        <span class=" invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="trade_license">Business/ Trade License No
                                <span class="mendatory-mark">*</span></label>
                            <input id="trade_license" type="text" placeholder="Input trade license"
                                   class="form-control @error('trade_license') is-invalid @enderror "
                                   name="trade_license"
                                   value="{{ old('trade_license') }}" autofocus>
                            @error('trade_license')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="rl_no">RL No (Only for Recruiting Agency)</label>
                            <input id="rl_no" type="text" placeholder="Type RL number"
                                   class="form-control @error('rl_no') is-invalid @enderror"
                                   name="rl_no" value="{{ old('rl_no') }}">
                            @error('rl_no')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Business Description
                            <span class="mendatory-mark">*</span></label>
                        <textarea type="text" name="description" rows="2" id="description"
                                  placeholder="Write your company's description"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="website_url">Website URL</label>
                        <input type="text" name="website_url" id="website_url"
                               placeholder="Type your company's website URL"
                               class="form-control @error('website_url') is-invalid @enderror"
                               value="{{ old('website_url') }}">
                        @error('website_url')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <hr class="mt-4">
                    <h4 class="mb-3">Contact Details</h4>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="contact_name">Contact Person's Name
                                <span class="mendatory-mark">*</span></label>
                            <input id="contact_name" type="text" placeholder="type your name"
                                   class="form-control @error('contact_name') is-invalid @enderror"
                                   name="contact_name" value="{{ old('contact_name') }}">
                            @error('contact_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contact_phone">Contact Person's Phone <span
                                    class="mendatory-mark">*</span></label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">+880</div>
                                </div>
                                <input id="contact_phone" type="text"
                                       class="form-control @error('contact_phone') is-invalid @enderror"
                                       name="contact_phone" value="{{ old('contact_phone') }}"
                                       placeholder="@lang('app.contact_ex')">

                            </div>
                            @error('contact_phone')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row mb-0">
                        <div class="col-md-4 offset-md-4">
                            <button type="submit" class="form-control btn btn-primary">
                                <i class="fa fa-save"></i> @lang('Register')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

