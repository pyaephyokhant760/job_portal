@extends('admin.layout.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('homePage')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('adminJobPage')}}">Job Page</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush ">
                            <li class="list-group-item d-flex justify-content-between p-3">
                                <a href="{{ route('userPage')}}">Users</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="{{ route('adminJobPage')}}">Jobs</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="">Job Applications</a>
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
                        <h3 class="fs-4 mb-1">Job Edits</h3>
                        <form action="{{ route('adminGetJobPage',$detail->id)}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2 ">Title<span class="req">*</span></label>
                                    <input type="text" placeholder="Job Title" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $detail->title }}">
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                            @if ($category->isNotEmpty())
                                                @foreach ($category as $cate)
                                                    <option {{ ($detail->category_id == $cate->id) ? 'selected' : ""}} value="{{$cate->id}}">{{ $cate->name}}</option>
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
                                        <option {{($detail->experience == 1) ? 'selected' : ''}} value="1">One Year</option>
                                        <option {{($detail->experience == 2) ? 'selected' : ''}} value="2">Two Years</option>
                                        <option {{($detail->experience == 3) ? 'selected' : ''}} value="3">Three Years</option>
                                        <option {{($detail->experience == 4) ? 'selected' : ''}} value="4">Four Years</option>
                                        <option {{($detail->experience == 5) ? 'selected' : ''}} value="5">Five Years</option>
                                        <option {{($detail->experience == 6) ? 'selected' : ''}} value="6">Six Years</option>
                                        <option {{($detail->experience == 7) ? 'selected' : ''}} value="7">Seven Years</option>
                                        <option {{($detail->experience == 8) ? 'selected' : ''}} value="8">Eight Years</option>
                                        <option {{($detail->experience == 9) ? 'selected' : ''}} value="9">Nime Years</option>
                                        <option {{($detail->experience == 10) ? 'selected' : ''}} value="10">Ten Years</option>
                                        <option {{($detail->experience == '10+') ? 'selected' : ''}} value="10+">Ten Plus Years</option>
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
                                            @foreach ($jobType as $job)
                                                <option {{ ($detail->job_type_id == $job->id) ? 'selected' : ""}} value="{{$job->id}}">{{ $job->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('jobType')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                    <input type="number" min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control @error('vacancy') is-invalid @enderror" value="{{ $detail->vacancy }}">
                                    @error('vacancy')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Salary</label>
                                    <input type="text" placeholder="Salary" id="salary" name="salary" class="form-control" value="{{ $detail->salary }}">
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location<span class="req">*</span></label>
                                    <input type="text" placeholder="location" id="location" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ $detail->location }}">
                                    @error('location')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <div class="form-check">
                                        <input {{ ($detail->isFeatured == 1) ? 'checked' : ''}} class="form-check-input" type="checkbox" value="1" id="isFeatured" name="isFeatured">
                                        <label class="form-check-label" for="isFeatured">
                                          Featured
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-4 col-md-6 d-flex">
                                    <div class="form-check me-4">
                                        <input {{ ($detail->status == 1) ? 'checked' : ''}} class="form-check-input" type="radio" value="1" id="status_active" name="status">
                                        <label class="form-check-label" for="status">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input {{ ($detail->status == 0) ? 'checked' : ''}} class="form-check-input" type="radio" value="0" id="status_block" name="status">
                                        <label class="form-check-label" for="status">
                                            Block
                                        </label>
                                    </div>
                                </div>


                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Description<span class="req">*</span></label>
                                <textarea class="textarea form-control @error('description') is-invalid @enderror" name="description" id="description" cols="5" rows="5" placeholder="Description">{{ $detail->description }}</textarea>
                                @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Benefits</label>
                                <textarea class="textarea" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits" >{{ $detail->benefits }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Responsibility</label>
                                <textarea class="textarea" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility">{{ $detail->responsibility }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Qualifications</label>
                                <textarea class="textarea" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications" >{{ $detail->qualifications }}</textarea>
                            </div>



                            <div class="mb-4">
                                <label for="" class="mb-2">Keywords<span class="req">*</span></label>
                                <input type="text" placeholder="keywords" id="keywords" name="keywords" class="form-control" value="{{ $detail->keywords }}">
                            </div>

                            <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Name<span class="req">*</span></label>
                                    <input type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ $detail->company_name }}">
                                    @error('company_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location</label>
                                    <input type="text" placeholder="Location" id="location" name="company_location" class="form-control" value="{{ $detail->company_location }}">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Website</label>
                                <input type="text" placeholder="Website" id="website" name="company_website" class="form-control" value="{{ $detail->company_website }}">
                            </div>
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection



