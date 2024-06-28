@extends('admin.layout.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('homePage')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('userPage')}}">User Page</a></li>
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
                                <a href="{{ route('jobApplicationPage')}}">Job Applications</a>
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
                    <div class="card-body p-4 ">
                        @if (session('Data'))
                            <div class="col">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-check"></i>{{ session('Data')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            @endif
                       <h3>User Edit</h3>
                       <form action="{{ route('userGetData',$user->id)}}" method="post">
                            @csrf
                            <div class="col-8 mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                            </div>
                            <div class="col-8 mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                            </div>
                            <div class="col-8 mb-3">
                                <label for="designation">Designation</label>
                                <input type="text" name="designation" id="designation" class="form-control" value="{{ $user->designation }}">
                            </div>
                            <div class="col-8 mb-3">
                                <label for="phone">Mobile</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
                            </div>
                            <button type="submit" class="btn btn-danger">Update</button>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
