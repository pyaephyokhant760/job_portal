<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    //registerPage
    public function registerPage() {
        return view('auth.register');
    }


    // loginPage
    public function loginPage() {
        return view('auth.login');
    }


    // profilePage
    public function profilePage() {
        return view('front.account.account');
    }

    // getProfilePage
    public function getProfilePage(Request $request) {
        $id = $request->id;
        $this->profileValidator($request,$id);
        $data = $this->profileData($request);
        User::where('id',$id)->update($data);
        return back()->with(['patten'=>'Data ပြောင်းလဲခြင်း အောင်မြင်ပါသည်']);
    }

    // getPhotoPage
    public function getPhotoPage(Request $request) {
        $id = Auth::user()->id;
        $this->photoValida($request);
        $oldName = User::where('id',$id)->first();
        $oldName = $oldName['image'];
        if($oldName != null) {
            Storage::delete('public/'.$oldName);
        }
        if ($request->hasFile('image')) {
            $filename = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $filename);
            $data = [
                'image' => $filename,
            ];
        }
        $user = User::where('id',$id)->update($data);
        return back();
    }

    // getPasswordPage
    public function getPasswordPage(Request $request) {
        $this->validatorCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword = $user->password;



        if (Hash::check($request->oldPassword, $dbPassword)) {
            $data = [
                'password' => Hash::make($request->newPassword),
            ];
            User::where('id',Auth::user()->id)->update($data);
            return redirect()->route('accountLoginPage');
        }
        return back()->with(['notMatch' => 'The Old Password Not Match']);

    }





    // validatorCheack
    private function validatorCheack($request) {
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|same:confirm_password',
            'confirm_password' => 'required'
        ])->validate();
    }

    // getdata
    private function getdata($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
    }

    // check
    private function check($request) {
        Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required'
        ])->validate();
    }

    // data
    private function data($request) {
        return [
            'email' => $request->email,
            // 'password' => Hash::make($request->password)
        ];
    }

    // profileData
    private function profileData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation,
            'phone' => $request->phone,
        ];
    }

    // profileValidator
    private function profileValidator($request,$id) {
        $validate = Validator::make($request->all(),[
            'name' =>'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
        ])->validate();
    }

    // photoValida
    private function photoValida($request) {
        $validate = Validator::make($request->all(),[
            'image' => 'mimes:jpg,bmp,png',
        ])->validate();
    }

    private function validatorCheck($request) {
        Validator::make($request->all(),[
        'oldPassword' => 'required|min:6',
        'newPassword' => 'required|min:6',
        'comfirmPassword' => 'required|min:6|same:newPassword',
        ])->validate();
    }
}
