<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMUSale extends Model
{
    //use HasFactory;
    protected $table = 'cmu_sales';
    protected $guarded = [];
    public function project(){
        return $this->belongsTo('App\Models\Project', 'project_code','project_code');
    }
    public function user(){
        return $this->belongsTo('App\User', 'hrms_id','HRMSID');
    }
}
