<?php

namespace App\Models;

use App\Models\User;
use App\Models\Detail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = ['job_id','user_id','employer_id','applied_date'];

    public function detail(){
        return $this->belongsTo(Detail::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function employer(){
        return $this->belongsTo(User::class,'employer_id');
    }
}
