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

    // // getRegisterPage
    // public function getRegisterPage(Request $request){
    //     // dd($request->toArray());
    //     $this->validatorCheack($request);
    //     $data = $this->getdata($request);
    //     $user = User::create($data);

    //     if($user) {
    //         return redirect()->route('accountLoginPage');
    //     }else {
    //         return back();
    //     }
    // }

    // loginPage
    public function loginPage() {
        return view('auth.login');
    }

    // // getLoginPage
    // public function getLoginPage(Request $request) {
    //     $this->check($request);
    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         return redirect()->route('profilePage');
    //     }else {
    //         return back();
    //     }
    // }

    // profilePage
    public function profilePage() {
        $user = User::get();
        // dd($user->toArray());
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

    // // logoutPage
    // public function logoutPage() {
    //     Auth::logout();
    //     return redirect()->route('accountLoginPage');
    // }

    // getProfilePage



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
}
