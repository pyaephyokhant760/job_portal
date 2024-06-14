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





    // getData
    private function getData($request) {
       return [
            'user_id' => Auth::user()->id,
            'job_id' => $request->detail_id
       ];
    }
}
