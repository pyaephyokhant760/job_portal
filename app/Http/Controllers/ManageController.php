<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageController extends Controller
{
    //managePage
    public function managePage() {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('dashboardPage');
        }
        return redirect()->route('profilePage');
    }
}
