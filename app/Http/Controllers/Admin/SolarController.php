<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Solar; use Mail;
use App\Traits\SolarPosting;
use App\Models\SaleRecord;
use App\Models\Project;use DB;
use App\User;use App\Http\Requests\SolarRequest;
use App\Exports\ExportSolar; 
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Client;use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class SolarController extends Controller
{

    use Solar,SolarPosting;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        view()->share('site', (object) [
            'title' =>  "Solars"
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$user = auth()->user(); 
        if($request->export){
            return Excel::download(new ExportSolar(@$request->start_date,@$request->end_date,
			@$request->search,@$request->client_id,@$request->project_id,Auth::user()->id), 'ExportSolar.xlsx');
        }
        $states = DB::table("electric_provider")->get();
        $clients = Client::where('campaign_id',2)->get();
        $projects = Project::whereIn('client_id',$clients->pluck('id'))->get();
        $this->authorize('solars.index');  
        $search = @$request->search;
        $start_date = @$request->start_date;
        $end_date = @$request->end_date;
        $solars  =   SaleRecord::with('user','client')->where('campaign_id',"2");
        if(Auth::user()->hasRole('SolarClient')){			
            $project_codes = User::with('projects')->where('id',Auth::user()->id)->get()->pluck('projects')->flatten()->pluck('project_code');
            $solars  =   $solars->whereIn('project_code',$project_codes);
        } 
        if(($request->search) || ($request->start_date) || ($request->end_date) || ($request->client_id) || ($request->project_id))
        {
            $solars = $solars->search($request->search,@$request->start_date,@$request->end_date,@$request->client_id,@$request->project_id);
        } 
        $solars = $solars->orderby('id','DESC' )->paginate(100);
        return view('admin.solar.index',compact('solars','clients','projects','states'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = DB::table("electric_provider")->groupBy('state')->get();
        $this->authorize('solars.create'); 
        $clients = Client::where('campaign_id',2)->pluck('id');
        $projects = Project::whereIn('client_id',$clients)->get();
        return view('admin.solar.create',compact('clients','projects','states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SolarRequest $request)
    { 
		//$this->authorize('solars.store');  
        if($request->record_id<=0){
            return redirect()->route('solars.create')->with('error',"RecordID Required");
        }
        $request->validate([
            'first_name'=>"required",
            'last_name'=>"required",
            'phone'=>"required",
            'clients'=>"required",
            'record_id'=>"required",
        ]);
        DB::connection('mysql')->beginTransaction();
        try{ 
            
            $check =    DB::table('sale_records')->where('phone',$request->phone)->whereDate('created_at',"<=",date('Y-m-d',strtotime('-90 days')) )->first();                    
            $check1 =   DB::table('sale_records')->where('record_id',$request->record_id)->first(); 
            $checkOld = DB::table('phone_numbers')->where('phone',$request->phone)->first();
            if($check || $checkOld || $check1){ 
                return redirect()->back()->with('error','Phone no already used');
            } 
            $data = $request->all();
            $res = $this->InsertSaleRecord($data); 
            $res = $this->postingUrl($request->clients,$data,$res);  
            DB::commit();
			
            return redirect()->route('solars.create')->with('success',"Post Successfully");
        }catch(\Exception $e){
            DB::connection('mysql')->rollback(); 
			if(Auth::user()->hasRole('Super Admin')){
              //return redirect()->route('solars.create')->with('error',$e->getMessage());
			}
            return redirect()->route('solars.create')->with('error',"Internal Server Error");
        }
    }
	
	

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$this->authorize('solars.show');  
        $data = SaleRecord::where('id',$id)->first();
        return view('admin.solar.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$this->authorize('solars.edit');  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
		$this->authorize('solars.update'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$this->authorize('solars.destroy'); 
        SaleRecord::where('id',$id)->delete();
        return redirect()->back()->with("success","Disabled successfully");
    }
    public function devsolar($id)
    {    
        $states = DB::table("electric_provider")->groupBy('state')->get();
        $this->authorize('solars.create'); 
        $clients = Client::where('campaign_id',2)->pluck('id');
        $projects = Project::whereIn('client_id',$clients)->get();
        return view('admin.solar.devcreate',compact('clients','projects','states'));
    }
    
    
}
