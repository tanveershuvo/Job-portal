@extends('layouts.theme')

@section('construction')
<article class="text-center">
    <h3 class="mt-2 text-danger"><i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>
        Under-Construction!</h3>
    <div>
        <p class="my-1">Sorry for the inconvenience but the site is under construction! So, some of the feature
            may not work
            properly!</p>
        <p class="my-1">&mdash; Tanvir(Developer)</p>
    </div>
</article>
@endsection

@section('content')

<div class="home-hero-section">
    <div class="">
        <div class="container">
            <div class="job-search-bar">
                <h1 class="mt-2"><b>Find the right jobs</b></h1>
                <hr>
                <p class="mb-sm-5 mt-sm-4 job-search-sub-text">
                    More than 3000+ trusted live jobs available from 500+ different employer. Work with the best talent
                    from
                    around the world on our secure,
                    flexible and cost-effective platforms.
                </p>

                <form action="{{route('jobs_listing')}}" method="get">
                    <div class="form-row" style="background-color:rgb(121, 82, 179);">
                        <div class="col-md-5 col-xs-12 p-2">
                            <input type="text" name="q" class="form-control"
                                placeholder="@lang('app.job_title_placeholder')">
                        </div>

                        <div class="col-md-4 col-xs-12 p-2">
                            <select class="form-control form-control-md">
                                <option disabled selected value="">
                                    location
                                </option>
                                @foreach (allDistricts() as $district)
                                <option value="{{$district['name']}}">
                                    @if(App::getlocale()=='en')
                                    {{$district['name']}}
                                    @elseif(App::getlocale()=='bn')
                                    {{$district['bn_name']}}
                                    @endif
                                </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-3 col-xs-6 p-2">
                            <button type="submit" class="btn btn-block btn-search"><i class="la la-search"></i>
                                @lang('app.search') @lang('app.job')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="job-stats py-4" style="background-color: #e7e2e2b0;">
    <div class="container">
        <div class="row ">
            <div class="col-md-3 mt-2 mt-md-0">
                <div class="d-flex flex-row justify-content-center">
                    <img src="{{asset('assets/images/job.svg')}}" alt="reqruiter" style="height:80px;">
                    <div class="p-2 mt-1">
                        <h3><b>2000</b></h3>
                        <h5>Job Posted</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-2 mt-md-0">
                <div class="d-flex flex-row justify-content-center">
                    <img src="{{asset('assets/images/job-seeker.svg')}}" alt="reqruiter" style="height:80px;;">
                    <div class="p-2 mt-1">
                        <h3><b>10,000</b></h3>
                        <h5>Job Seeker</h5>
                    </div>

                </div>
            </div>
            <div class="col-md-3 mt-2 mt-md-0">
                <div class="d-flex flex-row justify-content-center">
                    <img src="{{asset('assets/images/employees.svg')}}" alt="reqruiter" style="height:80px;">
                    <div class="p-2 mt-1">
                        <h3><b>2500</b></h3>
                        <h5>Employers</h5>
                    </div>

                </div>
            </div>
            <div class="col-md-3 mt-2 mt-md-0">
                <div class="d-flex flex-row justify-content-center">
                    <img src="{{asset('assets/images/reqruitments.svg')}}" alt="reqruiter" style="height:80px;">
                    <div class="p-2 mt-1">
                        <h3><b>3500</b></h3>
                        <h5>Recruiters</h5>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@if(isset($categories))

<div class="home-categories-wrap p-4">
    <div class="container">
        <div class="card card-custom">
            <div class="card-body">
                <h4 class="card-title mb-4" style="color:#7952b3;"><i class="fa fa-list" aria-hidden="true"></i>
                    @lang('app.browse_category')
                </h4>
                <div class="row">
                    @foreach($categories as $category)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <p>
                            <a href="{{route('jobs_listing', ['category' => $category->id])}}" class="category-link"><i
                                    class="fa fa-angle-right" aria-hidden="true"></i>
                                {{$category->category_name}} <span class="text-muted">({{$category->job_count}})</span>
                            </a>
                        </p>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if($premium_jobs->count())
<div class="premium-jobs-wrap pb-5 pt-5">

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-3">@lang('app.premium_jobs')</h4>
            </div>
        </div>

        <div class="row">
            @foreach($premium_jobs as $job)
            <div class="col-md-4 mb-3">
                <div class="premium-job-box p-3 bg-white box-shadow">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="premium-job-logo">
                                <a href="{{route('jobs_by_employer', $job->employer->company_slug)}}">
                                    <img src="{{$job->employer->logo_url}}" class="img-fluid" />
                                </a>
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-6">

                            <p class="job-title">
                                <a href="{{route('job_view', $job->job_slug)}}">{{ $job->job_title }}</a>
                            </p>

                            <p class="text-muted m-0">
                                <a href="{{route('jobs_by_employer', $job->employer->company_slug)}}"
                                    class="text-muted">
                                    {{$job->employer->company}}
                                </a>
                            </p>

                            <p class="text-muted m-0">
                                <i class="la la-map-marker"></i>
                                {{ $job->district }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>

</div>
@endif


@if($regular_jobs->count())
<div class="regular-jobs-wrap pb-3 pt-4">
    <div class="container col-md-11 col-sm-8">
        <div class="regular-job-container p-3">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-3" style="color:rgb(255, 0, 0);"><i class="fa fa-fire" aria-hidden="true"></i>
                        @lang('app.new_jobs')</h4>
                </div>
            </div>
            <div class="row">
                @foreach($regular_jobs as $regular_job)

                <div class="card col-md-4">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{route('job_view', $regular_job->job_slug)}}">{{ $regular_job->job_title
                                }}</a>
                        </div>
                        <p class="text-muted mb-1 mt-1">
                            <i class="la la-clock-o"></i> @lang('app.posted')
                            {{$regular_job->created_at->diffForHumans()}} ,
                            <i class="la la-calendar-times-o"></i> @lang('app.deadline') :
                            {{$regular_job->deadline->format(get_option('date_format'))}}
                        </p>
                        <p class="text-muted m-0">
                            <i class="la la-map-marker"></i>
                            {{ $regular_job->job_title }}
                        </p>
                        <p class="text-muted m-0">
                            <a href="{{route('jobs_by_employer', $regular_job->employer->company_slug)}}"
                                class="text-muted">
                                {{$regular_job->employer->company}}
                            </a>
                        </p>

                    </div>
                </div>

                @endforeach
            </div>

        </div>
    </div>
</div>
@endif

@endsection
