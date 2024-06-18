@extends('front.layout.homeApp')

@section('contact')
<section class="section-0 lazy d-flex bg-image-style dark align-items-center "   class="" data-bg="assets/images/banner5.jpg">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8">
                <h1>Find your dream job</h1>
                <p>Thounsands of jobs available.</p>
                <div class="banner-btn mt-5"><a href="#" class="btn btn-primary mb-4 mb-sm-0">Explore Now</a></div>
            </div>
        </div>
    </div>
</section>
<section class="section-1 py-5 ">
    <div class="container">
        <form action="{{ route('jobPage')}}" method="get">
            <div class="card border-0 shadow p-5">
                <div class="row">
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" placeholder="Keywords" class="form-control" name="searchTitle" value="{{ request('searchTitle') }}">
                    </div>

                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" placeholder="Location" class="form-control" name="searchLocation" value="{{ request('searchLocation') }}">
                    </div>

                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <select name="category" id="category" class="form-control" value="{{ request('category') }}">
                            <option value="">Select a Category</option>
                            @foreach ($categories as $category)
                            <option {{ request('category') == $category->id ? "selected" : "" }} value="{{ $category->id }}" >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class=" col-md-3 mb-xs-3 mb-sm-3 mb-lg-0">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-block">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="section-2 bg-2 py-5">
    <div class="container">
        <h2>Popular Categories</h2>
        <div class="row pt-5">
            @foreach ($categories as $category)
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_catagory">
                    <a href="{{ route('jobPage').'?category='.$category->id}}"><h4 class="pb-2">{{ $category->name }}</h4></a>
                    <p class="mb-0"> <span>50</span> Available position</p>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</section>

<section class="section-3  py-5">
    <div class="container">
        <h2>Featured Jobs</h2>
        <div class="row pt-5">
            <div class="job_listing_area">
                <div class="job_lists">
                    <div class="row">
                        @foreach ($featureJobs as $featureJob)
                            <div class="col-md-4">
                                <div class="card border-0 p-3 shadow mb-4">
                                    <div class="card-body">
                                        <h3 class="border-0 fs-5 pb-2 mb-0">{{ $featureJob->title }}</h3>
                                        <p>{{ Str::words(strip_tags($featureJob->description), 5) }}</p>
                                        <div class="bg-light p-3 border">
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                <span class="ps-1">{{ $featureJob->location}}</span>
                                            </p>
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                <span class="ps-1">{{ $featureJob->job_name}}</span>
                                            </p>
                                            @if (!is_null($featureJob->salary))
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                    <span class="ps-1">{{$featureJob->salary}}</span>
                                                </p>
                                            @endif
                                        </div>

                                        <div class="d-grid mt-3">
                                            <a href="{{ route('detailPage',$featureJob->id)}}" class="btn btn-primary btn-lg">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-3 bg-2 py-5">
    <div class="container">
        <h2>Latest Jobs</h2>
        <div class="row pt-5">
            <div class="job_listing_area">
                <div class="job_lists">
                    <div class="row">
                        @foreach ($lastestJobs as $lastestJob)
                            <div class="col-md-4">
                                <div class="card border-0 p-3 shadow mb-4">
                                    <div class="card-body">
                                        <h3 class="border-0 fs-5 pb-2 mb-0">{{$lastestJob->title}}</h3>
                                        <p>{{ Str::words(strip_tags($lastestJob->description), 5) }}</p>
                                        <div class="bg-light p-3 border">
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                <span class="ps-1">{{$lastestJob->location}}</span>
                                            </p>
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                <span class="ps-1">{{ $lastestJob->job_name}}</span>
                                            </p>
                                            @if (!is_null($lastestJob->salary))
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                    <span class="ps-1">2-3 Lacs PA</span>
                                                </p>
                                            @endif
                                        </div>

                                        <div class="d-grid mt-3">
                                            <a href="{{ route('detailPage',$lastestJob->id)}}" class="btn btn-primary btn-lg">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
