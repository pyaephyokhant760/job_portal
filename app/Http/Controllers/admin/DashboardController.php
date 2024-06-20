<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
