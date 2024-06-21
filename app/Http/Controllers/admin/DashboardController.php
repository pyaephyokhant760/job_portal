<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    //dashboardPage
    public function dashboardPage(){
        return view('admin.dashboard');
    }

    // userPage
    public function userPage() {
        $users = User::orderBy('created_at','desc')->paginate(10);
        return view('admin.user',compact('users'));
    }

    // userEditPage
    public function userEditPage($id) {
        $user = User::where('id',$id)->first();
        return view('admin.edit',compact('user'));
    }

    // userGetData
    public function userGetData(Request $request,$id) {
        $this->check($request);
        $data = $this->getData($request);
        User::where('id',$id)->update($data);
        return back()->with(['Data' => 'Data ပြင်ဆင်ခြင်း အောင်မြင်ပါသည်']);
    }

    // userDeletePage
    public function userDeletePage($id) {
        User::where('id',$id)->delete();
        return back();
    }



    // check
    private function check($request) {
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
        ])->validate();
    }

    // getData
    private function getData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation,
            'phone' => $request->phone
        ];
    }
}
