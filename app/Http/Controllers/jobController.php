<?php

namespace App\Http\Controllers;


use App\Models\Detail;
use App\Models\JobType;
use App\Models\SaveJob;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class jobController extends Controller
{
    //jobPostPage
    public function jobPostPage() {
        $category = Category::orderBy('name','asc')->get();
        $jobType = JobType::orderBy('name','asc')->get();
        return view('front.job.post_a_job',compact('category','jobType'));
    }

    // getDataJobPage
    public function getDataJobPage(Request $request) {
        $this->validator($request);
        $data = $this->jobData($request);
        Detail::create($data);
        return redirect()->route('myJobPage');
    }

    // myJobPage
    public function myJobPage() {
        $jobs = Detail::select('details.*','job_types.name as job_name')
        ->join('job_types','details.job_type_id','job_types.id')
        ->where('user_id',Auth::user()->id)->paginate(5);
        return view('front.job.myJob',compact('jobs'));
    }

    // editPage
    public function editPage($id) {
        $category = Category::orderBy('name','asc')->get();
        $jobType = JobType::orderBy('name','asc')->get();
        $detail = Detail::where('id',$id)->first();
        return view('front.job.edit',compact('detail','category','jobType'));
    }

    // editPost
    public function editPost(Request $request,$id) {
        $this->editVail($request);
        $data = $this->jobData($request);
        Detail::where('id',$id)->update($data);
        return redirect()->route('myJobPage');
    }

    // deletePage
    public function deletePage($id) {
        Detail::where('id',$id)->delete();
        return redirect()->route('myJobPage');
    }

    // viewPage
    public function viewPage($id) {
        $detail = Detail::select('details.*','categories.name as category_name','job_types.name as job_name')
                ->join('categories','details.category_id','categories.id')
                ->join('job_types','details.job_type_id','job_types.id')
                ->where('details.id',$id)
                ->first();
        return view('front.job.view',compact('detail'));
    }

    // jobPage
    public function jobPage(Request $request) {
        $categories = Category::get();
        $jobTypes = JobType::get();
        $Jobs = Detail::select('details.*','job_types.name as job_name','categories.name as category_name')
                    ->join('job_types','details.job_type_id','job_types.id')
                    ->join('categories','details.category_id','categories.id')
                    ->when(request('searchTitle','searchLocation','category','job_type','experience'),function($query) {
                        $query->where('title','like','%'.request('searchTitle').'%')
                                ->where('location','like','%'.request('searchLocation').'%')
                                ->where('category_id','like','%'.request('category').'%')
                                ->where('job_type_id','like','%'.request('job_type').'%')
                                ->where('experience','like','%'.request('experience').'%');
                    })
                    ->orderBy('details.id','desc')->take(6 )->get();
        return view('front.job.jobs',compact('Jobs','categories','jobTypes'));
    }

    // detailPage
    public function detailPage($id) {
        $data = Detail::select('details.*','categories.name as category_name','job_types.name as job_name')
                ->join('categories','details.category_id','categories.id')
                ->join('job_types','details.job_type_id','job_types.id')
                ->where('details.id',$id)
                ->first();
                $count = SaveJob::where([
                    'user_id' => Auth::id(),
                    'job_id' => $id,
                ])->count();
        return view('front.job.detail',compact('data','count'));
    }









    // validator
    private function validator($request) {
        $validate = Validator::make($request->all(),[
            'title' => 'required|min:5',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required',
            'experience' => 'required',
            'location' => 'required',
            'company_name' => 'required|min:5|max:75'
        ])->validate();
    }

    // jobData
    private function jobData($request) {
        return [
            'title' => $request->title,
            'category_id' => $request->category,
            'job_type_id' => $request->jobType,
            'user_id' => Auth::user()->id,
            'vacancy' => $request->vacancy,
            'salary' => $request->salary,
            'location' => $request->location,
            'description' => $request->description,
            'benefits' => $request->benefits,
            'responsibility' => $request->responsibility,
            'qualifications' => $request->qualifications,
            'keywords' => $request->keywords,
            'experience' => $request->experience,
            'company_name' => $request->company_name,
            'company_location' => $request->company_location,
            'company_website' => $request->company_website
        ];
    }

    // editVail
    private function editVail($request) {
        $validate = Validator::make($request->all(),[
            'title' => 'required',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required',
            'experience' => 'required',
            'location' => 'required',
            'company_name' => 'required|min:5|max:75'
        ])->validate();
    }
}
