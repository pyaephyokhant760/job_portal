<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Detail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //homePage
    public function homePage() {
        $categories = Category::where('status',1)->get();
        $featureJobs = Detail::select('details.*','job_types.name as job_name')
                    ->join('job_types','details.job_type_id','job_types.id')
                    ->orderBy('details.id','desc')->take(6)->get();
        $lastestJobs = Detail::select('details.*','job_types.name as job_name')
                        ->join('job_types','details.job_type_id','job_types.id')
                        ->orderBy('details.id','desc')->take(6)->get();
        $categories = Category::get();
        return view('front.home',compact('categories','featureJobs','lastestJobs','categories'));
    }
}
//
