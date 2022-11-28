<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SaleMortgage extends Model
{
    use SoftDeletes;
    protected $table="sale_mortgages";
    protected $guarded =[];

    public function user(){
        return $this->belongsTo('App\User', 'user_id','HRMSID');
    }

    public function client(){
        return $this->belongsTo('App\Models\Client', 'client_code','client_code');
    }

    public function campaign(){
        return $this->belongsTo('App\Models\Campaign', 'campaign_id','id');
    }
    public function project(){
        return $this->belongsTo('App\Models\Project', 'project_code','project_code');
    }
    protected $dates = [ 'deleted_at' ];

    public function scopeSearch($mortgages,$search,$start_date,$end_date,$client_id,$project_id){       
         
        if($search){        
            $mortgages =$mortgages->where(function($query)use($search){
                $query->where('phone','LIKE',"%".@$search."%");
                $query->orWhere('last_name','LIKE',"%".@$search."%");            
                $query->orWhere('first_name','LIKE',"%".@$search."%");            
            });
        }
        if($client_id){
            $mortgages = $mortgages->where('client_code',$client_id);
        }
        if($project_id){
            $mortgages = $mortgages->where('project_code',$project_id);
        }
        if($start_date && $end_date){
            $mortgages = $mortgages->whereDate('created_at',">=",$start_date)->whereDate('created_at',"<=",$end_date);
        } 
        return $mortgages;
    }
}
