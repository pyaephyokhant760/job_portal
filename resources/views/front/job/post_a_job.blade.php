@extends('front.layout.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('homePage')}}">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="s-body text-center mt-3">
                        <img src="{{ asset('storage/'. Auth::user()->image )}}" alt="avatar"  class="img-thumbnail" style="width: 140px;height: 125px">
                        <h5 class="mt-3 pb-0">{{ Auth::user()->name }}</h5>
                        <p class="text-muted mb-1 fs-6">{{ Auth::user()->designation }}</p>
                        <div class="d-flex justify-content-center mb-2">
                            <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary" name="image">Change Profile Picture</button>
                        </div>
                    </div>
                </div>
                <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush ">
                            <li class="list-group-item d-flex justify-content-between p-3">
                                <a href="{{ route('profilePage')}}">Account Settings</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="{{ route('jobPostPage')}}">Post a Job</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="{{ route('myJobPage')}}">My Jobs</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="{{ route('appJobsPage')}}">Jobs Applied</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="{{ route('saveJob')}}">Saved Jobs</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <form action="{{ route('logout')}}" method="post">
                                    @csrf
                                    <button type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="card border-0 shadow mb-4 ">
                    <div class="card-body card-form p-4">
                        <h3 class="fs-4 mb-1">Job Details</h3>
                        <form action="{{ route('getDataJobPage')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2 ">Title<span class="req">*</span></label>
                                    <input type="text" placeholder="Job Title" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title')}}">
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Category<span class="req">*</span></label>
                                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                        <option value="">Select a Category</option>
                                        @if ($category->isNotEmpty())
                                            @foreach ($category as $cate)
                                                <option value="{{$cate->id}}">{{ $cate->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('category')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Experience<span class="req">*</span></label>
                                    <select name="experience" id="experience" class="form-control @error('experience') is-invalid @enderror">
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
                                    @error('experience')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Job Nature<span class="req">*</span></label>
                                    <select class="form-select @error('jobType') is-invalid @enderror" name="jobType">
                                        <option value="">Select a Job Nature</option>
                                        @if ($jobType->isNotEmpty())
                                            @foreach ($jobType as $jobType)
                                                <option value="{{$jobType->id}}">{{ $jobType->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('jobType')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                    <input type="number" min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control @error('vacancy') is-invalid @enderror" >
                                    @error('vacancy')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Salary</label>
                                    <input type="text" placeholder="Salary" id="salary" name="salary" class="form-control">
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location<span class="req">*</span></label>
                                    <input type="text" placeholder="location" id="location" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location')}}">
                                    @error('location')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Description<span class="req">*</span></label>
                                <textarea class="textarea @error('description') is-invalid @enderror" name="description" id="description" cols="5" rows="5" placeholder="Description">{{ old('description')}}</textarea>
                                @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Benefits</label>
                                <textarea class="textarea" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{{ old('benefits')}}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Responsibility</label>
                                <textarea class="textarea" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility">{{ old('responsibility')}}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Qualifications</label>
                                <textarea class="textarea" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications">{{ old('qualifications')}}</textarea>
                            </div>



                            <div class="mb-4">
                                <label for="" class="mb-2">Keywords<span class="req">*</span></label>
                                <input type="text" placeholder="keywords" id="keywords" name="keywords" class="form-control" value="{{ old('keywords')}}">
                            </div>

                            <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Name<span class="req">*</span></label>
                                    <input type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name')}}">
                                    @error('company_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location</label>
                                    <input type="text" placeholder="Location" id="location" name="company_location" class="form-control" value="{{ old('company_location')}}">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Website</label>
                                <input type="text" placeholder="Website" id="website" name="company_website" class="form-control" value="{{ old('company_website')}}">
                            </div>
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Save Job</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection


