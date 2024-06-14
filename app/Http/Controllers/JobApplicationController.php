<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Detail;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Mail\JobNotificationEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobApplicationController extends Controller
{
    //ajaxDetailPage
    public function ajaxDetailPage(Request $request) {

        $data = $this->getData($request);
        JobApplication::create($data);
        $id = $request->detail_id;


        // Send Notification Email to Employer
        $employer_id = $request->employer_id;
        $job = Detail::where('id',$id)->first();
        $employer = User::where('id',$employer_id)->first();
        $user = Auth::user();
        $mailData = [
            'employer' => $employer,
            'user' => $user,
            'job' => $job
        ];
        Mail::to($user->email)->send(new JobNotificationEmail($mailData));

        $respon = [
            'message' => 'Data သိမ်းထားခြင်း အောင်မြင်ပါသည်',
            'status' =>'Success'
        ];
        return response()->json($respon, 200);


    }

    // getData
    private function getData($request) {
        return [
            'job_id' => $request->detail_id,  //job id က detail ထဲက id
            'employer_id' => $request->employer_id,    //employer idက postရေးခဲ့သူရဲ့ id
            'user_id' => Auth::user()->id,  //user idဆိုတာကတော့ ခု ဝင်ထားတဲ့ userရဲ့ id
            'applied_date' => Carbon::now()
        ];
    }
}
