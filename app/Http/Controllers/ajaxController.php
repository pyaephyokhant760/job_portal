<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;

class ajaxController extends Controller
{
    //sortingPage
    public function sortingPage(Request $request) {
        if ($request->status == 'lastest') {
           $data = Detail::select('details.*','job_types.name as job_name')
                    ->join('job_types','details.job_type_id','job_types.id')
                    ->orderBy('created_at','desc')->take(6)->get();
        }else {
            $data = Detail::select('details.*','job_types.name as job_name')
            ->join('job_types','details.job_type_id','job_types.id')
            ->orderBy('created_at','asc')->take(6)->get();
        }
        return $data;
    }
}
