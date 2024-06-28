<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;

class AdminJobApplicationController extends Controller
{
    // jobApplicationPage method
    public function jobApplicationPage()
    {
        // Select all columns from job_applications table and join with details and users tables for both user roles
        $jobApplications = JobApplication::select(
                'job_applications.*',
                'applicant.name as applicant_name',
                'employer.name as employer_name',
                'details.title as detail_name'

            )
            ->join('details', 'job_applications.job_id', 'details.id')
            ->join('users as applicant', 'job_applications.user_id',  'applicant.id')
            ->join('users as employer', 'job_applications.employer_id',  'employer.id')
            ->orderBy('job_applications.id', 'desc')
            ->paginate(6);

        // Return the view with job applications data
        return view('admin.JobApplication.index', compact('jobApplications'));
    }

    // deleteJobApplicationPage
    public function deleteJobApplicationPage($id) {
        JobApplication::where('id',$id)->delete();
        return back()->with(['Data' => 'Delete Success']);
    }
}
