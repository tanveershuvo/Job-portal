@extends('layouts.theme')

@section('content')

<div class="home-hero-section mt-1">
    <div class="job-search-bar pull-right">
        <div class="container mb-3">
            <div class="row ">
                <div class="col-md-8">
                    <h1>The fastest way to search jobs</h1>
                    <p class="mt-4 mb-4 job-search-sub-text">More than 3000+ trusted live jobs available from 500+
                        different employer,<br> and agents on this website to take your career next level</p>
                </div>
            </div>
            <form action="{{route('jobs_listing')}}" class="form" method="get">
                <div class="row pr-2 " style="background-color:rgb(121, 82, 179);">
                    <div class="col-md-5 col-xs-12 mt-2">
                        <input type="text" name="q" class="form-control"
                            placeholder="@lang('app.job_title_placeholder')">
                    </div>
                    <div class="col-md-4 col-xs-12 mt-2">
                        <input type="text" name="location" class="form-control mb-3"
                            placeholder="@lang('app.job_location_placeholder')">
                    </div>
                    <div class="col-md-3 col-xs-6 mt-2 mb-3">
                        <button type="submit" class="btn btn-block btn-search"><i class="la la-search"></i>
                            @lang('app.search') @lang('app.job')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@if($categories->count())
<div class="home-categories-wrap pb-3 pt-4">
    <div class="container col-md-11 col-sm-8">
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
                                    class="fa fa-angle-right" aria-hidden="true"></i> {{$category->category_name}} <span
                                    class="text-muted">({{$category->job_count}})</span> </a>
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
                                <a href="{{route('job_view', $job->job_slug)}}">{!! $job->job_title !!}</a>
                            </p>

                            <p class="text-muted m-0">
                                <a href="{{route('jobs_by_employer', $job->employer->company_slug)}}"
                                    class="text-muted">
                                    {{$job->employer->company}}
                                </a>
                            </p>

                            <p class="text-muted m-0">
                                <i class="la la-map-marker"></i>
                                @if($job->city_name)
                                {!! $job->city_name !!},
                                @endif
                                @if($job->state_name)
                                {!! $job->state_name !!},
                                @endif
                                @if($job->state_name)
                                {!! $job->country_name !!}
                                @endif
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
                            <a href="{{route('job_view', $regular_job->job_slug)}}">{!! $regular_job->job_title
                                !!}</a>
                        </div>
                        <p class="text-muted  m-0">
                            <i class="la la-map-marker"></i>
                            @if($regular_job->city_name)
                            {!! $regular_job->city_name !!},
                            @endif
                            @if($regular_job->state_name)
                            {!! $regular_job->state_name !!},
                            @endif
                            @if($regular_job->state_name)
                            {!! $regular_job->country_name !!}
                            @endif
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

<div class="pricing-section bg-white pb-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="pricing-section-heading mb-5 text-center">

                    <h1>Pricing</h1>
                    <h5 class="text-muted">Choose a package to unlock Premium/Regular jobs posting ability.</h5>
                    <h5 class="text-muted">To get a large amount of quality application, choose the premium package</h5>
                </div>

            </div>
        </div>


        <div class="row">

            <div class="col-xs-12 col-md-4">
                <div class="pricing-table-wrap bg-light pt-5 pb-5 text-center">
                    <h1 class="display-4">$0</h1>
                    <h3>Free</h3>

                    <div class="pricing-package-ribbon pricing-package-ribbon-light">Regular</div>

                    <p class="mb-2 text-muted"> No Premium Job Post</p>
                    <p class="mb-2 text-muted"> Unlimited Regular Job Post</p>
                    <p class="mb-2 text-muted"> Unlimited Applicants</p>
                    <p class="mb-2 text-muted"> Dashboard access to manage application</p>
                    <p class="mb-2 text-muted"> No support available</p>

                    <a href="{{route('new_register')}}" class="btn btn-success mt-4"><i class="la la-user-plus"></i>
                        Sign Up</a>
                </div>
            </div>

            @foreach($packages as $package)
            <div class="col-xs-12 col-md-4">
                <div class="pricing-table-wrap bg-light pt-5 pb-5 text-center">
                    <h1 class="display-4">{!! get_amount($package->price) !!}</h1>
                    <h3>{{$package->package_name}}</h3>
                    <div class="pricing-package-ribbon pricing-package-ribbon-green">Premium</div>

                    <p class="mb-2 text-muted"> {{$package->premium_job}} Premium Jobs Post</p>
                    <p class="mb-2 text-muted"> Unlimited Regular Job Post</p>
                    <p class="mb-2 text-muted"> Unlimited Applicants</p>
                    <p class="mb-2 text-muted"> Dashboard access to manage application</p>
                    <p class="mb-2 text-muted"> E-Mail support available</p>
                    <a href="{{route('checkout', $package->id)}}" class="btn btn-success mt-4"> <i
                            class="la la-shopping-cart"></i> Purchase Package</a>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>





<div class="home-blog-section pb-5 pt-5">
    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="pricing-section-heading mb-5 text-center">
                    <h1>From Our Blog</h1>
                    <h5 class="text-muted">Check the latest updates/news from us.</h5>
                </div>

            </div>
        </div>


        <div class="row">

            @foreach($blog_posts as $post)

            <div class="col-md-4">

                <div class="blog-card-wrap bg-white p-3 mb-4">

                    <div class="blog-card-img mb-4">
                        <img src="{{$post->feature_image_thumb_uri}}" loading="lazy" class="card-img" />
                    </div>

                    <h4 class="mb-3">{{$post->title}}</h4>

                    <p class="blog-card-text-preview">{!! limit_words($post->post_content) !!}</p>

                    <a href="{{route('blog_post_single', $post->slug)}}" class="btn btn-success"> <i
                            class="la la-book"></i> Read More</a>

                    <div class="blog-card-footer border-top pt-3 mt-3">
                        <span><i class="la la-user"></i> {{$post->author->name}} </span>
                        <span><i class="la la-clock-o"></i> {{$post->created_at->diffForHumans()}} </span>
                        <span><i class="la la-eye"></i> {{$post->views}} </span>
                    </div>
                </div>


            </div>

            @endforeach

        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="home-all-blog-posts-btn-wrap text-center my-3">

                    <a href="" class="btn btn-success btn-lg"><i class="la la-link"></i> @lang('app.all_blog_posts')</a>

                </div>
            </div>
        </div>


    </div>
</div>



<div class="new-registration-page bg-white pb-5 pt-5">
    <div class="container">
        <div class="row">

            <div class="col-md-12">

                <div class="call-to-action-post-job justify-content-center">
                    <div class="job-post-icon my-auto">
                        <img src="{{asset('assets/images/job.png')}}" />
                    </div>
                    <div class="job-post-details mr-3 ml-3 p-3 my-auto">
                        <h1>Post your job</h1>
                        <p>
                            Job seekers looking for quality job always. <br /> Post your job to get the talents
                        </p>
                    </div>

                    <div class="job-post-button my-auto">
                        <a href="{{route('post_new_job')}}" class="btn btn-success btn-lg">Post a Job</a>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="job-stats-footer pb-5 pt-5 text-center">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h2 class="text-muted mb-3">Our website stats</h2>
                <p class="text-muted mb-4">Here the stats of how many people we've helped them to find jobs, hired
                    talents</p>

            </div>
        </div>


        <div class="row">
            <div class="col-md-3">
                <h3>15M</h3>
                <h5>Job Applicants</h5>
            </div>

            <div class="col-md-3">
                <h3>12M</h3>
                <h5>Job Posted</h5>
            </div>
            <div class="col-md-3">
                <h3>8M</h3>
                <h5>Employers</h5>
            </div>
            <div class="col-md-3">
                <h3>15M</h3>
                <h5>Recruiters</h5>
            </div>
        </div>
    </div>
</div>


@endsection