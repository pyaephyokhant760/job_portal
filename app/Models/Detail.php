<?php

namespace App\Models;

use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = ['title','user_id','category_id','job_type_id','vacancy','salary','location','description','benefits','responsibility','qualifications','keywords','experience','company_name','company_location','company_website','isFeatured','status'];

    public function applications() {
        return $this->belongsTo(JobApplication::class);
    }
}
