<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\SaveJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveJobController extends Controller
{
    //saveJobPage
    public function saveJobPage(Request $request) {
        $data = $this->getData($request);

        $id = $request->detail_id;
        $job = Detail::find($id);



        // Check if user already saved the job
        $count = SaveJob::where([
            'user_id' => Auth::id(),
            'job_id' => $id,
        ])->count();

        if ($count > 0) {
            $response = [
                'message' => 'Already',
                'status' => 'False',
            ];

            return response()->json($response, 200);
        } else {
            SaveJob::create($data);
            $response = [
                'message' => 'Data သိမ်းဆည်းခြင်း အောင်မြင်ပါသည်',
                'status' => 'Success',
            ];

            return response()->json($response, 200);
        }
    }

    // saveJob
    public function saveJob() {
        $apps = Detail::select('*','job_types.name as job_name','details.id as detail_id','save_jobs.id as save_id')
            ->rightJoin('save_jobs','details.id','save_jobs.job_id')
            ->where('save_jobs.user_id',Auth::user()->id)
            ->rightJoin('job_types','details.job_type_id','job_types.id')
            ->paginate(5);
        return view('front.job.save.save_job',compact('apps'));
    }

    // saveJobView
    public function saveJobView($id) {
        $data = Detail::select('details.*','categories.name as category_name','job_types.name as job_name')
                ->join('categories','details.category_id','categories.id')
                ->join('job_types','details.job_type_id','job_types.id')
                ->where('details.id',$id)
                ->first();
        return view('front.job.save.view',compact('data'));
    }

    // saveJobDelete
    public function saveJobDelete($id) {
        $data = SaveJob::where('id',$id)->delete();
        return back();
    }






    // getData
    private function getData($request) {
       return [
            'user_id' => Auth::user()->id,
            'job_id' => $request->detail_id
       ];
    }
}
