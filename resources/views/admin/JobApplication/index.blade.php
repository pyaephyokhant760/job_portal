@extends('admin.layout.app')

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
                <div class="card border-0 shadow mb-4">
                    <div class="card-body card-form">
                        @if (session('Data'))
                            <div>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('Data') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="fs-4 mb-1">Jobs</h3>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Job Title</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Employer</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if ($jobApplications->isNotEmpty())
                                        @foreach ($jobApplications as $jobApplication)
                                            <tr class="active">
                                                <td>{{ $jobApplication->detail_name}}</td>
                                                <td >{{ $jobApplication->applicant_name }}</td>
                                                <td>
                                                    {{ $jobApplication->employer_name}}

                                                </td>
                                                <td>
                                                    {{ $jobApplication->created_at->format('j/m/Y') }}
                                                </td>
                                                <td>
                                                    <div class="action-dots ">
                                                        <a href="#" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">


                                                                <li><a class="dropdown-item delete" href="{{ route('deleteJobApplicationPage',$jobApplication->id)}}"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a></li>

                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $jobApplications->links()}}
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
                url : 'http://127.0.0.1:8000/admin/jobApplication/delete/{id}',
                dataType : 'json',
            });
            location.reload();
        });
    });
</script>
@endsection
