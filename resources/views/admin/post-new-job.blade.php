@extends('layouts.dashboard')


@section('page-css')
<link href="{{asset('assets/plugins/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-md-10">

        <form method="post" action="">
            @csrf

            <div class="form-group row">
                <label for="company_name" class="col-sm-4 control-label"> @lang('app.company_name')</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                        id="company_name" value="{{ auth()->user()->company }}" name="company_name"
                        placeholder="@lang('app.company_name')">

                    @error('company_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row ">
                <label for="job_title" class="col-sm-4 control-label"> @lang('app.job_title')</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('job_title') is-invalid @enderror" id="job_title"
                        value="{{ old('job_title') }}" name="job_title" placeholder="@lang('app.job_title')">

                    @error('job_title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="position" class="col-sm-4 control-label"> @lang('app.position')</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('position') is-invalid @enderror" id="position"
                        value="{{ old('position') }}" name="position" placeholder="@lang('app.position')">

                    @error('position')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="category" class="col-sm-4 control-label">@lang('app.category')</label>
                <div class="col-sm-8">
                    <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                        <option value="">@lang('app.select_category')</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>

                    @error('category')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="salary_cycle" class="col-sm-4 control-label">@lang('app.salary_cycle')</label>
                <div class="col-sm-8">

                    <div class="price_input_group">

                        <select class="form-control @error('salary_cycle') is-invalid @enderror" name="salary_cycle">
                            <option value="monthly" {{ old('salary_cycle') == 'monthly' ? 'selected':'' }}>
                                @lang('app.monthly')</option>
                            <option value="yearly" {{ old('salary_cycle') == 'yearly' ? 'selected':'' }}>
                                @lang('app.yearly')</option>
                            <option value="weekly" {{ old('salary_cycle') == 'weekly' ? 'selected':'' }}>
                                @lang('app.weekly')</option>
                            <option value="daily" {{ old('salary_cycle') == 'daily' ? 'selected':'' }}>
                                @lang('app.daily')</option>
                            <option value="hourly" {{ old('salary_cycle') == 'hourly' ? 'selected':'' }}>
                                @lang('app.hourly')</option>

                        </select>

                        @error('salary_cycle')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="form-group row ">
                <label for="salary" class="col-sm-4 control-label"> @lang('app.salary')</label>
                <div class="col-sm-8">

                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('salary') is-invalid @enderror" id="salary"
                                value="{{ old('salary') }}" name="salary" placeholder="@lang('app.salary')">
                        </div>
                        <div class="col-md-6">
                            <label> <input type="checkbox" name="is_negotiable" value="1"
                                    {{checked('1', old('is_negotiable'))}}> @lang('app.is_negotiable')</label>
                        </div>
                    </div>

                    @error('salary')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row ">
                <label for="salary_upto" class="col-sm-4 control-label"> @lang('app.salary_upto')</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('salary_upto') is-invalid @enderror" id="salary_upto"
                        value="{{ old('salary_upto') }}" name="salary_upto" placeholder="@lang('app.salary_upto')">

                    <p class="text-info">@lang('app.salary_upto_desc')</p>
                    @error('salary_upto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="salary_currency" class="col-sm-4 control-label">@lang('app.salary_currency')</label>
                <div class="col-sm-8">

                    <div class="price_input_group">

                        <select class="form-control @error('salary_currency') is-invalid @enderror"
                            name="salary_currency">
                            @foreach(get_currencies() as $currency => $currency_name)
                            <option value="{{$currency}}">{{$currency}} | {{$currency_name}}</option>
                            @endforeach
                        </select>

                        @error('salary_currency')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="vacancy" class="col-sm-4 control-label"> @lang('app.vacancy')</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control @error('vacancy') is-invalid @enderror" id="vacancy"
                        value="{{ old('vacancy') }}" name="vacancy" placeholder="@lang('app.vacancy')">

                    @error('vacancy')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row ">
                <label for="gender" class="col-sm-4 control-label">@lang('app.gender')</label>
                <div class="col-sm-8">
                    <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
                        <option value="any" {{ old('gender') == 'any' ? 'selected':'' }}>@lang('app.any')</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected':'' }}>@lang('app.male')</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected':'' }}>@lang('app.female')
                        </option>
                        <option value="transgender" {{ old('gender') == 'transgender' ? 'selected':'' }}>
                            @lang('app.transgender')</option>
                    </select>

                    @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="exp_level" class="col-sm-4 control-label">@lang('app.exp_level')</label>
                <div class="col-sm-8">
                    <select class="form-control @error('exp_level') is-invalid @enderror" name="exp_level"
                        id="exp_level">
                        <option value="mid" {{ old('exp_level') == 'mid' ? 'selected':'' }}>@lang('app.mid')</option>
                        <option value="entry" {{ old('exp_level') == 'entry' ? 'selected':'' }}>@lang('app.entry')
                        </option>
                        <option value="senior" {{ old('exp_level') == 'senior' ? 'selected':'' }}>@lang('app.senior')
                        </option>
                    </select>

                    @error('exp_level')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>



            <div class="form-group row ">
                <label for="job_type" class="col-sm-4 control-label">@lang('app.job_type')</label>
                <div class="col-sm-8">
                    <select class="form-control @error('job_type') is-invalid @enderror" name="job_type" id="job_type">
                        <option value="full_time" {{ old('job_type') == 'full_time' ? 'selected':'' }}>
                            @lang('app.full_time')</option>
                        <option value="internship" {{ old('job_type') == 'internship' ? 'selected':'' }}>
                            @lang('app.internship')</option>
                        <option value="part_time" {{ old('job_type') == 'part_time' ? 'selected':'' }}>
                            @lang('app.part_time')</option>
                        <option value="contract" {{ old('job_type') == 'contract' ? 'selected':'' }}>
                            @lang('app.contract')</option>
                        <option value="temporary" {{ old('job_type') == 'temporary' ? 'selected':'' }}>
                            @lang('app.temporary')</option>
                        <option value="commission" {{ old('job_type') == 'commission' ? 'selected':'' }}>
                            @lang('app.commission')</option>
                        <option value="internship" {{ old('job_type') == 'internship' ? 'selected':'' }}>
                            @lang('app.internship')</option>
                    </select>

                    @error('job_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row ">
                <label for="experience_required_years" class="col-sm-4 control-label">
                    @lang('app.experience_required_years')</label>
                <div class="col-sm-8">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="number"
                                class="form-control @error('experience_required_years') is-invalid @enderror"
                                id="experience_required_years" value="{{ old('experience_required_years') }}"
                                name="experience_required_years" placeholder="@lang('app.experience_required_years')">
                        </div>
                        <div class="col-md-6">
                            <label> <input type="checkbox" name="experience_plus" value="1"
                                    {{checked('1', old('experience_plus'))}}> @lang('app.plus')</label>
                        </div>
                    </div>

                    @error('experience_required_years')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="deadline" class="col-sm-4 control-label"> @lang('app.deadline')</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('deadline') is-invalid @enderror date_picker"
                        id="deadline" value="{{ old('deadline') }}" name="deadline" placeholder="@lang('app.deadline')">

                    @error('deadline')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 control-label"> @lang('app.description')</label>
                <div class="col-sm-8">
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                        rows="5">{{ old('description') }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <p class="text-info"> @lang('app.description_info_text')</p>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-4 control-label"> @lang('app.skills')</label>
                <div class="col-sm-8">
                    <textarea name="skills" class="form-control @error('skills') is-invalid @enderror"
                        rows="2">{{ old('skills') }}</textarea>
                    @error('skills')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <p class="text-info"> @lang('app.skills_info_text')</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 control-label"> @lang('app.responsibilities')</label>
                <div class="col-sm-8">
                    <textarea name="responsibilities"
                        class="form-control @error('responsibilities') is-invalid @enderror"
                        rows="3">{{ old('responsibilities') }}</textarea>
                    @error('responsibilities')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <p class="text-info"> @lang('app.responsibilities_info_text')</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 control-label"> @lang('app.educational_requirements')</label>
                <div class="col-sm-8">
                    <textarea name="educational_requirements"
                        class="form-control @error('educational_requirements') is-invalid @enderror"
                        rows="3">{{ old('educational_requirements') }}</textarea>
                    @error('educational_requirements')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <p class="text-info"> @lang('app.educational_requirements_info_text')</p>
                </div>
            </div>


            <div class="form-group row ">
                <label class="col-sm-4 control-label"> @lang('app.experience_requirements')</label>
                <div class="col-sm-8">
                    <textarea name="experience_requirements"
                        class="form-control @error('experience_requirements') is-invalid @enderror"
                        rows="3">{{ old('experience_requirements') }}</textarea>
                    @error('experience_requirements')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <p class="text-info"> @lang('app.experience_requirements_info_text')</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 control-label"> @lang('app.additional_requirements')</label>
                <div class="col-sm-8">
                    <textarea name="additional_requirements"
                        class="form-control @error('additional_requirements') is-invalid @enderror"
                        rows="3">{{ old('additional_requirements') }}</textarea>
                    @error('additional_requirements')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <p class="text-info"> @lang('app.additional_requirements_info_text')</p>
                </div>
            </div>


            <div class="form-group row {{ $errors->has('benefits')? 'has-error':'' }}">
                <label class="col-sm-4 control-label"> @lang('app.benefits')</label>
                <div class="col-sm-8">
                    <textarea name="benefits" class="form-control @error('benefits') is-invalid @enderror"
                        rows="3">{{ old('benefits') }}</textarea>
                    @error('benefits')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <p class="text-info"> @lang('app.benefits_info_text')</p>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-4 control-label"> @lang('app.apply_instruction')</label>
                <div class="col-sm-8">
                    <textarea name="apply_instruction"
                        class="form-control @error('apply_instruction') is-invalid @enderror"
                        rows="3">{{ old('apply_instruction') }}</textarea>
                    @error('apply_instruction')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <p class="text-info"> @lang('app.apply_instruction_info_text')</p>
                </div>
            </div>

            <legend>@lang('app.job_location')</legend>

            <div class="form-group row py-3">
                <label for="district" class="col-sm-4 control-label">
                    District
                    <span class="mendatory-mark">*</span></label>
                <div class="col-sm-8">
                    <select name="district" class="form-control @error('district') is-invalid @enderror" autofocus>
                        <option disabled selected value="">
                            location
                        </option>
                        @foreach (allDistricts() as $district)
                        <option value="{{$district['name']}}" @if(old('district') && $district['name']==old('district'))
                            selected="selected" @endif>
                            {{$district['name']}}
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


            <div class="alert alert-warning">

                <legend>@lang('app.premium_job')</legend>

                <div class="form-group row">
                    <label for="is_premium" class="col-md-4 control-label">{{ __('app.is_premium') }} </label>
                    <div class="col-md-8">
                        @php
                        $employer = auth()->user();
                        @endphp

                        @if($employer->premium_jobs_balance)
                        <label> <input type="checkbox" name="is_premium" value="1" {{checked('1', old('is_premium'))}}>
                            @lang('app.location_anywhere') </label>
                        @else
                        <a href="{{route('pricing')}}" target="_blank">You don't have any premium jobs balance to add
                            premium jobs, please purchase a package to earn ability of posting premium jobs</a>
                        @endif
                    </div>
                </div>

            </div>

            <div class="form-group row">
                <label class="col-sm-4"></label>
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary">@lang('app.post_new_job')</button>
                </div>
            </div>
        </form>



    </div>
</div>



@endsection




@section('page-js')
<script src="{{asset('assets/plugins/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.js')}}" defer></script>
@endsection