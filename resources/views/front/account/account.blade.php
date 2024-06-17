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
                <div class="card border-0 shadow mb-4">
                    <div class="card-body  p-4">
                        @if (session('patten'))
                        <div>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ session('patten') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                        <h3 class="fs-4 mb-1">My Profile</h3>
                        <form action="{{ route('getProfilePage')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <div class="mb-4">
                                <label for="" class="mb-2">Name*</label>
                                <input type="text" placeholder="Enter Name" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name}}" name="name">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Email*</label>
                                <input type="text" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email}}" name="email">
                                @error('email')
                                    <p class="text-danger">{{ $message}}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Designation*</label>
                                <input type="text" placeholder="Designation" class="form-control" name="designation" value="{{ Auth::user()->designation}}">
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Mobile*</label>
                                <input type="text" placeholder="Mobile" class="form-control" name="phone" value="{{ Auth::user()->phone}}">
                            </div>
                            <div class="card-footer  p-4">
                                <button  class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card border-0 shadow mb-4">
                    <div class="card-body p-4">
                        <form action="{{ route('getPasswordPage')}}" method="post">
                            @csrf
                            <h3 class="fs-4 mb-1">Change Password</h3>
                            <div class="mb-4">
                                <label for="" class="mb-2">Old Password*</label>
                                <input id="cc-pament" name="oldPassword" type="password" class="form-control @if (session('notMatch')) is-invalid @endif @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Old Password">
                                @error('oldPassword')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                                @if (session('notMatch'))
                                    <small class="invalid-feedback">{{ session('notMatch') }}</small>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">New Password*</label>
                                <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="New Password">
                                @error('newPassword')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Confirm Password*</label>
                                <input type="password" placeholder="Confirm Password" class="form-control" name="comfirmPassword">
                                @error('comfirmPassword')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
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
