<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaleMortgage;
use App\Models\Client;use Auth;
use App\Models\Project;
use App\User;use DB;
use App\Traits\Mortgage;
use App\Traits\MortgagePosting;   
use App\Exports\ExportMortgage; 
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class MortgageController extends Controller
{
    use Mortgage;
    public function __construct()
    {
        view()->share('site', (object) [
            'title' =>  "Mortgage"
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
		$raw_result = DB::select( DB::raw("SELECT * FROM model_has_roles WHERE model_id = '$user->id'") );
		$roleid = $raw_result[0]->role_id;
		
		if (!in_array($roleid, array(13,14,1,18,17))) {
    		return redirect()->route('mortgages.create')->with('error',"Access Denied");
		}
		
        if($request->export){
          return Excel::download(new ExportMortgage(@$request->start_date,@$request->end_date,@$request->search,@$request->client_id), 'ExportMortgage.xlsx');
        }
        $clientid = Client::where('campaign_id',3)->pluck('id'); $clients  = Client::where('campaign_id',3)->get();         
        $this->authorize('mortgages.index');$projects = Project::whereIn('client_id',$clientid)->get();   

        if(Auth::user()->hasRole('MortgageClient')){
            $project_codes = User::with('projects')->where('id',Auth::user()->id)->get()->pluck('projects')->flatten()->pluck('project_code');
            $mortgages  =   SaleMortgage::with('user','client')->where('campaign_id',"3")->whereIn('project_code',$project_codes);
        }else{
            $mortgages  =   SaleMortgage::with('user','client')->where('campaign_id',3);
        }
        $mortgages = $mortgages->search($request->search,@$request->start_date,@$request->end_date,@$request->client_id,@$request->project_id)->orderby('id','DESC' )->paginate(100);
        return view('admin.mortgage.index',compact('mortgages','clients','projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('mortgages.create'); 
        $clientid = Client::where('campaign_id',3)->pluck('id'); 
        $clients = Project::whereIn('client_id',$clientid)->get(); 
        return view('admin.mortgage.create',compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        DB::connection('mysql')->beginTransaction();
        try{
            $last_three_month = \Carbon\Carbon::now()->startOfMonth()->subMonth(4);$this_month = \Carbon\Carbon::now()->startOfMonth();         
            $check = SaleMortgage::where('phone',$request->phone)->whereBetween('created_at',[$last_three_month,$this_month])->first();         		 
             $checkOld = DB::table('phone_numbers')->where('phone',$request->phone)->first();
            if($check || $checkOld){ 
                return redirect()->back()->with('error','Phone no already used');
            }
            if($request->clients == "PRO0096"){
                $request->validate([
                    'first_name'=>"required",
                    'last_name'=>"required",
                    'phone'=>"required",
                    'clients'=>"required",
                ]);
            }else{
                $request->validate([
                    'first_name'=>"required",
                    'last_name'=>"required",
                    'phone'=>"required",
                    'clients'=>"required",
                    'record_id'=>"required",
                ]);
            }
            
        
            $data = $request->all();
            $res = $this->InsertSaleRecord($data);
            $res = $this->postingUrl($request->clients,$data,$res);         
            DB::commit();
            return redirect()->route('mortgages.create')->with('success',"Post Successfully");
        }catch(\Exception $e){
            DB::connection('mysql')->rollback(); 
            return redirect()->route('mortgages.create')->with('error',$e->getMessage());
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
        $data = SaleMortgage::where('id',$id)->first();
        return view('admin.mortgage.view',compact('data'));
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SaleMortgage::where('id',$id)->delete();
        return redirect()->back()->with("success","Disabled successfully");
    }

    public function export(){
        return Excel::download(new ExportMortgage, 'ExportMortgage.xlsx');
    }
}
