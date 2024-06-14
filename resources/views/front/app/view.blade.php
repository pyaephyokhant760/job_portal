@extends('front.layout.app')

@section('main')
<section class="section-4 bg-2">
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('jobPage')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Back to Jobs</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container job_details_area">
        <div class="row pb-5">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="jobs_conetent">
                                    <a href="#">
                                        <h4>{{ $data->title}}</h4>
                                    </a>
                                    <div class="links_locat d-flex align-items-center">
                                        @if ($data->company_location)
                                            <div class="location">
                                                <p> <i class="fa fa-map-marker"></i> {{ $data->company_location }}</p>
                                            </div>
                                        @endif

                                        @if ($data->job_name)
                                            <div class="location">
                                                <p> <i class="fa fa-clock-o"></i> {{ $data->job_name }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <a class="heart_mark" href="#"> <i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        @if ($data->description)
                            <div class="single_wrap">
                                <h4>Job description</h4>
                                {!! nl2br($data->description) !!}
                            </div>
                        @endif

                        @if ($data->responsibility)
                            <div class="single_wrap">
                                <h4>Responsibility</h4>
                                {!! nl2br($data->responsibility) !!}
                            </div>
                        @endif

                        @if ($data->qualifications)
                            <div class="single_wrap">
                                <h4>Qualifications</h4>
                                {!! nl2br($data->qualifications) !!}
                            </div>
                            @endif
                        @if ($data->benefits)
                            <div class="single_wrap">
                                <h4>Benefits</h4>
                                {!! nl2br($data->benefits) !!}
                            </div>
                        @endif
                        <div class="border-bottom"></div>
                        <div class="pt-3 text-end">
                            <a href="#" class="btn btn-secondary">Save</a>
                            @if (Auth::user())
                                <button class="btn btn-secondary" type="button" id="apply">Apply</button>
                            @else
                                <button class="btn btn-secondary" type="button" disabled>Apply</button>
                            @endif
                            <input type="hidden" name="job_id" value="{{ $data->id}}" id="job_id">
                            <input type="hidden" name="user_id" value="{{ $data->user_id}}" id="user_id">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Job Summery</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Published on: <span>12 Nov, 2019</span></li>
                                @if ($data->vacancy)
                                    <li>Vacancy: <span>{{ $data->vacancy}} Position</span></li>
                                @endif

                                @if ($data->salary)
                                    <li>Salary: <span>$ {{ $data->salary }}</span></li>
                                @endif

                                @if ($data->location)
                                <li>Location: <span>{{ $data->location }}</span></li>
                                @endif


                                <li>Job Nature: <span> Full-time</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card shadow border-0 my-4">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Company Details</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                @if ($data->company_name)
                                    <li>Name: <span>{{ $data->company_name }}</span></li>
                                @endif

                                @if ($data->company_location)
                                    <li>Locaion: <span>{{ $data->company_location }}</span></li>
                                @endif

                                @if ($data->company_website)
                                    <li>Webite: <span>{{ $data->company_website }}</span></li>
                                @endif


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
