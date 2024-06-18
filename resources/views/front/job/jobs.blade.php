@extends('front.layout.app')

@section('main')
    <section class="section-3 py-5 bg-2 ">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-10 ">
                    <h2>Find Jobs</h2>
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <select name="sorting" id="sort" class="form-control">
                            <option value="lastest">Latest</option>
                            <option value="oldest">Oldest</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">
                    <div class="card border-0 shadow p-4">
                        <form action="{{ route('jobPage')}}" method="get">
                            <div class="mb-4">
                                <h2>Keywords</h2>
                                <input type="text" placeholder="Keywords" class="form-control" name="searchTitle" value="{{ request('searchTitle') }}">
                            </div>

                            <div class="mb-4">
                                <h2>Location</h2>
                                <input type="text" placeholder="Location" class="form-control" name="searchLocation" value="{{ request('searchLocation') }}">
                            </div>

                            <div class="mb-4">
                                <h2>Category</h2>
                                <select name="category" id="category" class="form-control" value="{{ request('category')  }}">
                                    <option value="">Select a Category</option>
                                    @foreach ($categories as $category)
                                    <option {{ request('category') == $category->id ? "selected" : "" }} value="{{ $category->id }}" >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4" >
                                <h2>Job Type</h2>
                                @foreach ($jobTypes as $jobType)
                                <div class="form-check mb-2">
                                    <input class="form-check-input " name="job_type" type="checkbox" value="{{ $jobType->id, request('job_type') }}" id="{{ $jobType->id}}">
                                    <label class="form-check-label " for="{{ $jobType->id}}">{{ $jobType->name}}</label>
                                </div>
                                @endforeach

                            </div>

                            <div class="mb-4">
                                <h2>Experience</h2>
                                <select name="experience" id="experience" class="form-control" value="{{ request('experience') }}">
                                    <option value="">Select Experience</option>
                                        <option value="One Year">One Year</option>
                                        <option value="Two Years">Two Years</option>
                                        <option value="Three Years">Three Years</option>
                                        <option value="Four Years">Four Years</option>
                                        <option value="Five Years">Five Years</option>
                                        <option value="Six Years">Six Years</option>
                                        <option value="Seven Years">Seven Years</option>
                                        <option value="Eight Years">Eight Years</option>
                                        <option value="Nime Years">Nime Years</option>
                                        <option value="Ten Years">Ten Years</option>
                                        <option value="Ten Plus Years">Ten Plus Years</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-danger">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8 col-lg-9 " style="height: 100px" >
                    <div class="job_listing_area" >
                        <div class="job_lists"  >
                            <div class="row" id="jobs">
                                @foreach ($Jobs as $Job)
                                    <div class="col-md-4 " >
                                        <div class="card border-0 p-3 shadow mb-4" >
                                            <div class="card-body">
                                                <h3 class="border-0 fs-5 pb-2 mb-0">{{ $Job->title }}</h3>
                                                <p>{{ Str::words(strip_tags($Job->description), 5) }}</p>
                                                <div class="bg-light p-3 border">
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{ $Job->location}}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1">{{ $Job->job_name}}</span>
                                                    </p>
                                                    @if (!is_null($Job->salary))
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1">{{$Job->salary}}</span>
                                                        </p>
                                                    @endif
                                                </div>

                                                <div class="d-grid mt-3">
                                                    <a href="{{ route('detailPage',$Job->id)}}" class="btn btn-primary btn-lg">Details</a>
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
            {{-- {{ $Jobs->appends(request()->query())->links() }} --}}
        </div>
    </section>
@endsection
@section('scriptSection')
<script>
function truncateWords(str, numWords) {
    let words = str.split(" ");
    return words.slice(0, numWords).join(" ") + (words.length > numWords ? "5" : "..");
}
function strip_tags(html) {
    let doc = new DOMParser().parseFromString(html, 'text/html');
    return doc.body.textContent || "";
}
$(document).ready(function(){
    $('#sort').change(function() {
        $optionValue = $('#sort').val();
        if ($optionValue === 'lastest') {
            $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/ajax/sorting',
                dataType : 'json',
                data : { 'status' : 'lastest'},
                success : function(response) {
                    $list = ``;
                    for ($i = 0; $i < response.length; $i++) {
                        let detailUrl = `/detail/${response[$i].id}`;
                        $list += `
                        <div class="col-md-4 " >
                                <div class="card border-0 p-3 shadow mb-4" >
                                    <div class="card-body">
                                        <h3 class="border-0 fs-5 pb-2 mb-0">${response[$i].title}</h3>
                                        <p>${truncateWords(strip_tags(response[$i].description, 5))}</p>
                                        <div class="bg-light p-3 border">
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                <span class="ps-1">${response[$i].location}</span>
                                            </p>
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                <span class="ps-1">${ response[$i].job_name}</span>
                                            </p>
                                            ${response[$i].salary ? `
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                    <span class="ps-1">${response[$i].salary}</span>
                                                </p>
                                            ` : ""}
                                        </div>

                                        <div class="d-grid mt-3">
                                            <a href="${detailUrl}" class="btn btn-primary btn-lg">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                    $('#jobs').html($list);
                }
            });
        }else if ($optionValue === 'oldest') {
            $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/ajax/sorting',
                dataType : 'json',
                data : { 'status' : 'oldest'},
                success : function(response) {
                    $list = ``;
                    for ($i = 0; $i < response.length; $i++) {
                        let detailUrl = `/detail/${response[$i].id}`;
                        $list += `
                        <div class="col-md-4 " >
                                <div class="card border-0 p-3 shadow mb-4" >
                                    <div class="card-body">
                                        <h3 class="border-0 fs-5 pb-2 mb-0">${response[$i].title}</h3>
                                        <p>${truncateWords(strip_tags(response[$i].description, 5))}</p>
                                        <div class="bg-light p-3 border">
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                <span class="ps-1">${response[$i].location}</span>
                                            </p>
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                <span class="ps-1">${ response[$i].job_name}</span>
                                            </p>
                                            ${response[$i].salary ? `
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                    <span class="ps-1">${response[$i].salary}</span>
                                                </p>
                                            ` : ""}
                                        </div>

                                        <div class="d-grid mt-3">
                                            <a href="${detailUrl}" class="btn btn-primary btn-lg">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                    $('#jobs').html($list);
                }
            });
        }
    });
});
</script>
@endsection
