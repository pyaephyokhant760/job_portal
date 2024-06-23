<?php

namespace App\Http\Controllers\admin;

use App\Models\Detail;
use App\Models\JobType;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminJobController extends Controller
{
    //adminJobPage
    public function adminJobPage() {
        $jobs = Detail::select('details.*','users.name as user_name','details.id as detail_id')
            ->rightJoin('users','details.user_id','users.id')
           ->paginate(10);
        return view('admin.job',compact('jobs'));
    }

    // adminJobEditPage
    public function adminJobEditPage($id) {
        $category = Category::orderBy('name','asc')->get();
        $jobType = JobType::orderBy('name','asc')->get();
        $detail = Detail::where('id',$id)->first();

        return view('admin.jobs.edit',compact('category','jobType','detail'));
    }

    // adminGetJobPage
    public function adminGetJobPage(Request $request,$id){
        $this->editVail($request);
        $data = $this->jobData($request);
        Detail::where('id',$id)->update($data);
        return redirect()->route('adminJobPage');
    }

    // adminJobDeletePage
    public function adminJobDeletePage($id) {
        Detail::where('id',$id)->delete();
        return back();
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
