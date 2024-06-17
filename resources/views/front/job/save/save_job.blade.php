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
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <h3 class="fs-4 mb-1">Jobs Applied</h3>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Job Created</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @foreach ($apps as $app)
                                        <tr class="active">
                                            <td>
                                                <div class="job-name fw-500">{{ $app->title}}</div>
                                                <div class="info1">{{ $app->job_name}} . {{ $app->location }}</div>
                                            </td>
                                            <td>{{ $app->created_at->format('j/m/Y') }}</td>
                                            <td>130 Applications</td>
                                            <td>
                                                @if ($app->status == 1)
                                                    <div class="job-status text-capitalize">active</div>
                                                @else
                                                    <div class="job-status text-capitalize">Block</div>
                                                @endif

                                            </td>
                                            <td>
                                                <div class="action-dots float-end">
                                                    <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="{{ route('saveJobView',$app->detail_id)}}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                        <li><a class="dropdown-item delete" href="{{ route('saveJobDelete',$app->save_id)}}"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{ $apps->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scriptSection')
<script>
    $(document).ready(function(){
        $(".delete").click(function(){
            $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/saveJob/delete/{id}',
                dataType : 'json',
            });
            location.reload();
        });
    });
</script>
@endsection


