<?php

namespace App\Exports;

use App\Models\SaleRecord; use DB;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView; 
use Maatwebsite\Excel\Concerns\Exportable; 
use Maatwebsite\Excel\Concerns\ShouldAutoSize; 
use Maatwebsite\Excel\Concerns\WithHeadings;use Auth;
class ExportSolar implements FromView, ShouldAutoSize
{
    protected $start_date=''; 
    protected $end_date='';    
	protected $search='';
    protected $client_id='';    
	protected $roles='';


    public function __construct($start_date=null,$end_date=null,$search=null,$client_id=null,$roles=null,$id=null){
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->search = $search;
        $this->client_id = $client_id;       
		$this->$roles = $roles;

    }

    public function view(): View
    { 
        $search=$this->search;
        $saleSolars = SaleRecord::with('client:id,name');
        if($this->start_date && $this->end_date ){
            $saleMortgages = $saleMortgages->whereDate('created_at',$this->start_date)->whereDate('created_at',$this->end_date);
        }
        if($this->search){        
            $saleSolars =$saleSolars->where(function($query)use($search){
                $query->where('phone','LIKE',"%".@$search."%");
                $query->orWhere('last_name','LIKE',"%".@$search."%");            
                $query->orWhere('first_name','LIKE',"%".@$search."%");            
            });
        }
        if($this->client_id){
            $saleSolars = $saleSolars->where('client_id',$request->client_id);
        } 
		if(auth()->user()->hasRole("SolarClient")){
			
			$project_codes = User::with('projects')->where('id',auth()->user()->id)->get()
				->pluck('projects')->flatten()->pluck('project_code');
			 if($project_codes){
				 $saleSolars  =   $saleSolars->where('campaign_id',"2")->whereIn('project_code',$project_codes); 
			 }
		}
            
        $saleSolars = $saleSolars->get();
        return view('admin.solar.export', compact('saleSolars'));
    }
     
}