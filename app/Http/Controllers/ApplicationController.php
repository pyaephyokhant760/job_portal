<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // appJobsPage
    public function appJobsPage() {
        $apps = Detail::select('*','job_types.name as job_name','job_applications.id as job_app_id')
                ->rightJoin('job_applications','details.id','job_applications.job_id')
                ->rightJoin('job_types','details.job_type_id','job_types.id')
                ->where('job_applications.user_id',Auth::user()->id)->paginate(5);
        return view('front.app.app',compact('apps'));
    }

    // appView
    public function appView($id) {
        $data = Detail::select('details.*','categories.name as category_name','job_types.name as job_name')
                ->join('categories','details.category_id','categories.id')
                ->join('job_types','details.job_type_id','job_types.id')
                ->where('details.id',$id)
                ->first();
        return view('front.app.view',compact('data'));
    }

    // appDelete
    public function appDelete($id) {
        $data = JobApplication::where('id',$id)->delete();
        return back();
    }
}
