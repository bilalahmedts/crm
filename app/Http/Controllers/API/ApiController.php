<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecordDetail; use DB;
use App\Models\Campaign;
use App\Models\Client;
use App\Models\Project;
use App\Models\Role; 
use App\Models\SaleRecord;
use App\Models\SaleMortgage;
use App\Models\HomeWarranty;

json_decode(file_get_contents("php://input"));
class ApiController extends Controller
{
    public function search_record(Request $request){
        try{
			if($request->table == 'sale_records'){
				$days_count = 120;				
			}else{
				$days_count = 90;
			}

            $phone=$request->record_id;
            $last_three_month = \Carbon\Carbon::now()->startOfMonth()->subMonth(4);$this_month = \Carbon\Carbon::now()->startOfMonth(); 

			$date = \Carbon\Carbon::today()->subDays($days_count);
			$count = DB::table($request->table)->where('phone',$phone)->orWhere('record_id',$phone)->where('created_at','>=',$date)->count();	
			
            //$check = DB::table($request->table)->where('phone',$phone)->whereBetween('created_at',[$last_three_month,$this_month])->first();         	
			$old_sales = DB::table('phone_numbers')->where('phone',$request->record_id)->count();
			 

            if($count > 0 || $old_sales > 0){ 
                $response['message'] ="Phone Number Already Used";
                $response['status'] = 204;
                return response()->json($response);
            }
			//$res = RecordDetail::where("ID",$request->record_id)->orWhere('Phone',$request->record_id)->first();
			
/*$qry_result =DB::select("SET @rec_id= ?; 
SELECT DISTINCT
CASE 
WHEN record_id = @rec_id THEN '1'
ELSE '0'
END As Text
FROM sale_mortgages where record_id=@rec_id, [$request->record_id]"
var_dump($qry_result);
*/			
			$res = $this->get_record($phone);
            if($res->ID > 0 || $res->Phone > 0){
                $response['data'] =$res;
                $response['status'] = 200;
				//$response['count'] = $count;
                return response()->json($response,200);
            }else{
                $response['message'] ="Record Does not exist";
                $response['status'] = 204;
                return response()->json($response);
            }
            
        }catch (\Exception $e) {
            return response()->json([
                'status'  => '500',
                'message' => 'Request Failed',
                'server_error' => $e->getMessage(),
				'response' => $res,
            ],500);
        }
        
    }
    public function qa_records(Request $request){
        try{ 
			 
			if($request->id ==1){
                // return $request->id;
				$res = HomeWarranty::select('id','project_code','client_code','record_id','hrms_id','campaign_id','client','created_at') 
					->with('campaign:id,name','client','project');
                if(@$request->from_date && @$request->to_date){ 
                    $res = $res->whereDate('created_at','>=',$request->from_date)->whereDate('created_at','<=',$request->to_date);
                }
                $res = $res->where('qa_status','Pending')->orderBy('created_at','DESC')->get();
                return response()->json($res); 
			}elseif($request->id ==2){ 
				$res = SaleRecord::select('id','project_code','client_code','record_id','user_id as hrms_id','campaign_id','created_at')
				->with('campaign:id,name','client','project');
                if(@$request->from_date && @$request->to_date){
                    $res = $res->whereDate('created_at','>=',$request->from_date)->whereDate('created_at','<=',$request->to_date);
                }
                $res = $res->where('qa_status','Pending')->orderBy('created_at','DESC')->get(); 
                return response()->json($res); 
			}
			elseif($request->id ==3){
				$res = SaleMortgage::select('id','project_code','client_code','record_id','user_id as hrms_id','campaign_id','created_at')
				->with('campaign:id,name','client','project');
                if(@$request->from_date && @$request->to_date){
                    $res = $res->whereDate('created_at','>=',$request->from_date)->whereDate('created_at','<=',$request->to_date);
                }
                $res = $res->where('qa_status','Pending')->orderBy('created_at','DESC')->get();
                return response()->json($res); 
			} else{
                // return response()->json([
                //     'status'  => '200',
                //     'message' => 'No Data Found', 
                // ],200);
                return response()->json([]); 
            }
             
            
        }catch (\Exception $e) {
            return response()->json([
                'status'  => '500',
                'message' => 'Request Failed',
                'server_error' => $e->getMessage(),
            ],500);
        }
        
    }
		

    public function changeIsFixed(Request $request){
        $res = DB::table('projects')->where('id',$request->id)->limit(1)->update(['isFixed' => $request->isFixed]);
        return response()->json([
            'status'  => '200',
            'message' => 'success', 
        ],200);
    }
    public function updateQmsStatus(Request $request){ 
        // return $request;
        try{
            if($request->record_id <=0){
               $response['message'] ="Invalid Record ID";
               $response['status'] = 400;
               return response()->json($response);
            }
            $campaign = Campaign::with('clients')->where('id',$request->campaign_id)->first();
            if($campaign){
                $status='erro';
                if($request->outcome == "rejected")
                    $status="not-billable";
                elseif($request->outcome == "accepted")
                    $status="billable"; 
                
                $table = $campaign->table_name;
                $res = DB::table($table)->where('record_id',$request->record_id)->update(['qa_status' => $status]);
                if($res){
                    $response['message'] ="Audit Done Successfully";
                    $response['status'] = 200;
                    return response()->json($response,200);
                }else{
                    $response['message'] ="The Audit for this Record ID has already been done.";
                    $response['status'] = 400;
                    return response()->json($response);
                }
            }else{
                return response()->json([
                    'status'  => 500,
                    'message' => 'Request Failed! Campaign_id does not exist'
                ]);
            }
        }catch (\Exception $e) {
            return response()->json([
                'status'  => '500',
                'message' => 'Request Failed',
                'server_error' => $e->getMessage(),
            ],500);
        }
        
        
    }

    
    function changeStatusClient(Request $request){
		\DB::table($request->table)->where('id',$request->id)->limit(1)->update(['client_status'=>$request->client_status,'notes'=>$request->remarks]);
		return ['status'=>200,"message"=>"success"];
	}
    public function campaigns(Request $request){
        $campaigns = Campaign::wherein('id',[1,2,3])->get();
        if(!$campaigns->isEmpty()){
            $data['data'] = $campaigns;
            $data['status'] = "200";
        }else{
            $data['message'] ="Campaigns not found";
            $data['status'] = "204";
        }
        return response()->json($campaigns);
    }

    public function test(Request $request){
        $ids = \DB::table('users')->where('campaign',"LIKE","%"."home"."%")->pluck('id');
         
        foreach($ids as $id){
            $check = \DB::table('model_has_roles')->where('model_id',$id)->where('role_id',6)->first();
            if($check)
            continue;
            \DB::table("model_has_roles")->insert([
                'role_id'=>6,
                'model_type'=>"App\User",
                'model_id'=>$id
            ]);
        }
        exit;
        

        // return $data;
        foreach($data as $rw){
            $check = \DB::table('users')->where('HRMSID',@$rw['EMPLOYEE_ID'])->first();
            if($check)
            continue;
            $text = rand(100000,200000);
            $hash = \Hash::make($text);
            \DB::table('users')->insert([
                'name'=>@$rw['FIRST_NAME']." ".@$rw['LAST_NAME'],
                'email'=>(@$rw['EMAIL_ADDRESS']) ?(@$rw['EMAIL_ADDRESS']):"example@touchstone.com.pk", 
                'HRMSID'=>@$rw['EMPLOYEE_ID'],
                'birth_date'=>@$rw['BIRTH_DATE'],
                'cnic'=>@$rw['CNIC'],
                'password'=>$hash,
                'pass_text'=>$text,
                'employee_status'=>@$rw['EMPLOYEE_STATUS'],
                'joining_date'=>@$rw['JOINING_DATE'],
                'employee_status'=>@$rw['EMPLOYEE_STATUS'],
                'reporting_to_id'=>@$rw['REPORTING_TO_ID'],
                'employee_status'=>@$rw['EMPLOYEE_STATUS'],
                'designation'=>@$rw['DESIGNATION'],
                'campaign'=>@$rw['COMPAIGN'],
            ]);
        };

         
    }


    public function searchRecords(Request $request){
        $campaign = Campaign::where('id',$request->campaign_id)->first();
        $records = DB::table($campaign->table_name)->where('record_id',$request->record_id)->first();
        if($records){
			if($request->campaign_id==1){
				$user_id=@$records->hrms_id;
			}else{
				$user_id=@$records->user_id;
			}
            $records->agent_user=DB::table('users')->where('HRMSID',$user_id)->first();
            $records->client=DB::table('clients')->where('client_code',@$records->client_code)->first();
            $records->project=DB::table('projects')->where('project_code',@$records->project_code)->first();
            $records->campaign=DB::table('campaigns')->where('id',@$records->campaign_id)->first();
            $data['data'] = $records;
            $data['status'] = "200";
        }else{
            $data['message'] ="records not found";
            $data['status'] = "204";
        }
        return response()->json($records);
    }
    public function projects(Request $request){
        $record = Campaign::where('id',$request->campaign_id)->first(); 
        $clients = Client::where('campaign_id',$record->id)->pluck('id'); 
        $projects = Project::with('client')->whereIn('client_id',$clients)->get(); 
        return response()->json($projects);
    }
    public function select_electric(Request $request){ 
        return $projects = DB::table('electric_provider')->where('state',$request->val)->get();  
    }

    public function selectClient(Request $request){
        if(@$request->client_id){
            $client = \DB::table('clients')->where("client_code",$request->client_id)->first();
            return $data['res'] = \DB::table('projects')->where("client_id",$client->id)->get();
        }else{
            return $data['res'] = [];
        }
        
    }
    
    public function eddysales(){
         
        set_time_limit(0);$test =array(); 
        $arrayData=array();
        $sales = DB::table('eddy_sales')->leftjoin('eddy_users','eddy_users.agent_name','eddy_sales.agent_id')			
                ->select('eddy_sales.id','eddy_sales.billable_hours','sale_date','eddy_users.HRMSID as 
				SalesEmployee','eddy_sales.client_code','eddy_sales.project_code')
                ->get()->groupBy('sale_date');           
        foreach($sales as $key => $value){ 
            $postSapData=array();  $ids =[];
            $postSapData['APIKey']="$%fsdfkbAusfiewrg93485#&^";
            $postSapData['DocDate']="$key";
            $postSapData['CardCode']="CUS-100062"; 
            $singlePacket=array();
            foreach($value as $rw){
                $row['ItemCode']=$rw->project_code;
                $row['Quantity']= (int)$rw->billable_hours; 
                $row['QABillable']="0";
                $row['QANonBillable']="0"; 
                $row['QAPending']="0";
                $row['ClientPending']="0"; 
                $row['SalesEmployee']=(string)$rw->SalesEmployee;
                $row['QAScore']="0"; 
                $row['AgentCallsCount']="0"; 
                $singlePacket[]=$row;
                $ids[]=$rw->id;
            }         
            $postSapData['DocumentLines']=$singlePacket; 
            // return $postSapData;
            $url="http://tsc.isap.pk:9001/api/Revenue";   
            $ch = curl_init();
            curl_setopt ($ch, CURLOPT_URL, $url);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt ($ch, CURLOPT_POST, 1);
            curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt ($ch, CURLOPT_POSTFIELDS,json_encode($postSapData));
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $result = curl_exec ($ch); 
            curl_close($ch);
            $result = json_decode ($result);
            if($result->status == "Success"){
                DB::table("eddy_sales")->whereIn('id',$ids)->update([
                    'sap_id'=>$result->sapReference,
                    'sap_response'=>json_encode($result),
                    'post_data'=>json_encode($postSapData), 
                ]); 
            }else{
                DB::table("eddy_sales")->whereIn('id',$ids)->update([
                    'sap_id'=>0,
                    'sap_response'=>json_encode($result),
                    'post_data'=>json_encode($postSapData), 
                ]);
            }
        } 
        return response()->json(['status'=>200,'message'=>"success"]);
    }
    public function seatbased(){
        set_time_limit(0);$test =array(); 
        $arrayData=array();
        $sales = DB::table('seat_based_project_users')->select('HRMSID as SalesEmployee','client_code','project_code')->get();    
        $sales = $sales->groupBy('client_code');          
        foreach($sales as $key => $value){ 
            $postSapData=array();  
            $postSapData['APIKey']="$%fsdfkbAusfiewrg93485#&^";
            $postSapData['DocDate']=date("Y-m-d");
            $postSapData['CardCode']="$key"; $singlePacket=array();
            foreach($value as $rw){
                $row['ItemCode']=$rw->project_code;
                $row['Quantity']= 1; 
                $row['QABillable']="0";
                $row['QANonBillable']="0"; 
                $row['QAPending']="0";
                $row['ClientPending']="0"; 
                $row['SalesEmployee']=(string)$rw->SalesEmployee;
                $row['QAScore']="0"; 
                $row['AgentCallsCount']="0"; 
                $singlePacket[]=$row;
            }         
            $postSapData['DocumentLines']=$singlePacket; //return $postSapData;
            $url="http://tsc.isap.pk:9001/api/Revenue";   
            $ch = curl_init();
            curl_setopt ($ch, CURLOPT_URL, $url);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt ($ch, CURLOPT_POST, 1);
            curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt ($ch, CURLOPT_POSTFIELDS,json_encode($postSapData));
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $result = curl_exec ($ch); 
            curl_close($ch);
            $result = json_decode ($result);
            DB::table("seatbased_sap_response")->insert([
                'sap_id'=>$result->sapReference,
                'sap_response'=>json_encode($result),
                'post_data'=>json_encode($postSapData),
                'users'=>json_encode($value->pluck('SalesEmployee')),
            ]); 
        } 
        return response()->json(['status'=>200,'message'=>"success"]);
    }

    public function cmusales(){
        set_time_limit(0);$test =array(); 
        $arrayData=array();
        $sales = DB::table('cmu_sales')
                ->select('id','client_code as CardCode','project_code as ItemCode','count AS Quantity','sap_id','hrms_id as SalesEmployee','sale_date')                        
                ->where('sap_id',0)        
                ->where('count',">",0)        
                ->where('sale_date',"<>","0000-00-00")        
                ->where('hrms_id',">",0)          
                ->get()->groupBy('sale_date');       
        foreach($sales as $key => $value){    
            $postSapData=array();  $ids =[];
            $postSapData['APIKey']="$%fsdfkbAusfiewrg93485#&^";
            $postSapData['DocDate']=date("Y-m-d",strtotime($key));
            $postSapData['CardCode']="CUS-100042"; $singlePacket=array();
            foreach($value as $rw){ 
                if($rw->Quantity<=0){
                    continue;
                }
                $row['ItemCode']=$rw->ItemCode;
                $row['Quantity']= $rw->Quantity; 
                $row['QABillable']="0";
                $row['QANonBillable']="0"; 
                $row['QAPending']="0";
                $row['ClientPending']="0"; 
                $row['SalesEmployee']=(string)$rw->SalesEmployee;
                $row['QAScore']="0"; 
                $row['AgentCallsCount']="0"; 
                $singlePacket[]=$row;
                $ids[]=$rw->id;
            }         
            $postSapData['DocumentLines']=$singlePacket; 
            // echo "<pre>";print_r($postSapData); 
            $url="http://tsc.isap.pk:9001/api/Revenue";   
            $ch = curl_init();
            curl_setopt ($ch, CURLOPT_URL, $url);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt ($ch, CURLOPT_POST, 1);
            curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt ($ch, CURLOPT_POSTFIELDS,json_encode($postSapData));
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $result = curl_exec ($ch); 
            curl_close($ch);
            $result = json_decode ($result); 
           
            DB::table("cmu_sales")->whereIn('id',$ids)->update([
                'sap_id'=>(@$result->sapReference) ? @$result->sapReference:0,
                'sap_response'=>json_encode($result),
                'post_data'=>json_encode($postSapData),
            ]);
            
        }  
        return response()->json(['status'=>200,'message'=>"success"]);
    }

    public function crusales(){
        set_time_limit(0);$test =array(); 
        $arrayData=array();
        $sales = DB::table('cru_sales')->join('cru_users','cru_users.cru_id','cru_sales.agent_name')->selectRaw("
            agent_name,
            cru_users.hrms_id,
            Count(cru_sales.id) AS Quantity ,cru_sales.created_at              
        ")
        ->where('sap_id',0)->groupBy('created_at','agent_name')->get()->groupby('created_at'); 
        foreach($sales as $key => $value){  
             
            $postSapData=array();  $ids =[];
            $postSapData['APIKey']="$%fsdfkbAusfiewrg93485#&^";
            $postSapData['DocDate']=date("Y-m-d",strtotime($key));
            $postSapData['CardCode']="CUS-100058"; 
            $singlePacket=array();
            foreach($value as $rw){ 
                if($rw->Quantity<=0){
                    continue;
                }  
                $row['ItemCode']="PRO0142";
                $row['Quantity']= (int)$rw->Quantity; 
                $row['QABillable']="0";
                $row['QANonBillable']="0"; 
                $row['QAPending']="0";
                $row['ClientPending']="0"; 
                $row['SalesEmployee']=(string)$rw->hrms_id;
                $row['QAScore']="0"; 
                $row['AgentCallsCount']="0"; 
                $singlePacket[]=$row;
                $ids[]=$rw->agent_name;
            }         
            $postSapData['DocumentLines']=$singlePacket; 
            // return ($postSapData); 
            $url="http://tsc.isap.pk:9001/api/Revenue";   
            $ch = curl_init();
            curl_setopt ($ch, CURLOPT_URL, $url);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt ($ch, CURLOPT_POST, 1);
            curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt ($ch, CURLOPT_POSTFIELDS,json_encode($postSapData));
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $result = curl_exec ($ch); 
            curl_close($ch);
            $result = json_decode ($result); 
           
            DB::table("cru_sales")->whereIn('agent_name',$ids)->where('created_at',$key)->update([
                'sap_id'=>(@$result->sapReference) ? @$result->sapReference:0,
                'sap_response'=>json_encode($result),
                'post_data'=>json_encode($postSapData),
            ]);
            
        }  
        return response()->json(['status'=>200,'message'=>"success"]); 
    }
    public function caxsales(){
        set_time_limit(0);$test =array(); 
        $arrayData=array();
        $sales = DB::table('call_analytic_sales') 
                ->groupby('created_at','hrms_id')
                ->where('sap_id',0)->where('count',">",0)->get()->groupby('created_at');

                foreach($sales as $key => $value){  
             
                    $postSapData=array();  $ids =[];
                    $postSapData['APIKey']="$%fsdfkbAusfiewrg93485#&^";
                    $postSapData['DocDate']=date("Y-m-d",strtotime($key));
                    $postSapData['CardCode']="CUS-100040"; 
                    $singlePacket=array();
                    foreach($value as $rw){ 
                        if($rw->count<=0){
                            continue;
                        }  
                        $row['ItemCode']="PRO0123";
                        $row['Quantity']= (int)$rw->count; 
                        $row['QABillable']="0";
                        $row['QANonBillable']="0"; 
                        $row['QAPending']="0";
                        $row['ClientPending']="0"; 
                        $row['SalesEmployee']=(string)$rw->hrms_id;
                        $row['QAScore']="0"; 
                        $row['AgentCallsCount']="0"; 
                        $singlePacket[]=$row;
                        $ids[]=$rw->id;
                    }         
                    $postSapData['DocumentLines']=$singlePacket; 
                    // return ($postSapData); 
                    $url="http://tsc.isap.pk:9001/api/Revenue";   
                    $ch = curl_init();
                    curl_setopt ($ch, CURLOPT_URL, $url);
                    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt ($ch, CURLOPT_POST, 1);
                    curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
                    curl_setopt ($ch, CURLOPT_POSTFIELDS,json_encode($postSapData));
                    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                    $result = curl_exec ($ch); 
                    curl_close($ch);
                    $result = json_decode ($result); 
                   
                    DB::table("call_analytic_sales")->whereIn('id',$ids)->where('created_at',$key)->update([
                        'sap_id'=>(@$result->sapReference) ? @$result->sapReference:0,
                        'sap_response'=>json_encode($result),
                        'post_data'=>json_encode($postSapData),
                    ]);
                    
                }  
                return response()->json(['status'=>200,'message'=>"success"]); 
    }
    public function sapDataSolar(Request $request){  
        set_time_limit(0);$test =array();
        $clients = Client::where('campaign_id',2)->get(); $arrayData=array();$arrayData=array();
        $projectCodes = Project::where('isFixed',1)->pluck('project_code');
        foreach($clients as $row){
                $sales = DB::table('sale_records')
                ->select('client_code as CardCode','project_code as ItemCode')
                ->selectRaw("
                            Count(CASE WHEN sale_records.client_status = 'billable' THEN 1 ELSE NULL END) AS Quantity,
                            Count(CASE WHEN sale_records.qa_status = 'billable' THEN 1 ELSE NULL END) AS QABillable,
                            Count(CASE WHEN sale_records.qa_status = 'non-billable' THEN 1 ELSE NULL END) AS QANonBillable,
                            Count(CASE WHEN sale_records.qa_status = 'pending' THEN 1 ELSE NULL END) AS QAPending,
                            Count(CASE WHEN sale_records.client_status = 'pending' THEN 1 ELSE NULL END) AS ClientPending,
                            user_id as SalesEmployee, 
                            created_at as DocDate
                        ")
                ->where('client_code',$row->client_code)          
                ->where('sap_id',0)     
                ->groupBy('user_id','created_at','project_code')->get();      
            $userIds=array();      
            foreach($sales as $sale){
                if($sale->Quantity<=0){
                    continue;
                }   
                $rw['ItemCode']=(string)$sale->ItemCode;
                $rw['Quantity']= $sale->Quantity; 
                $rw['QABillable']=(string)$sale->QABillable;
                $rw['QANonBillable']=(string)$sale->QANonBillable; 
                $rw['QAPending']=(string)$sale->QAPending;
                $rw['ClientPending']=(string)$sale->ClientPending; 
                $rw['SalesEmployee']=(string)$sale->SalesEmployee;
                $rw['QAScore']="0"; 
                $rw['AgentCallsCount']="0"; 
                $arrayData[date("Y-m-d",strtotime($sale->DocDate))][] = $rw; 
                $date['SalesEmployee'] = $sale->SalesEmployee;
                $date['date'] = $sale->DocDate;
                $userIds[date("Y-m-d",strtotime($sale->DocDate))][] =$date;  
            } 
            
            foreach($arrayData as $key => $value){
                $postSapData=array();                    
                $postSapData['APIKey']="$%fsdfkbAusfiewrg93485#&^";
                $postSapData['DocDate']=date("Y-m-d",strtotime($key));
                $postSapData['CardCode']=$sale->CardCode;              
                $postSapData['DocumentLines']=$value;//return $postSapData;
                $data['CardCode']=$row->client_code; 
                $data['DocumentLines']=$postSapData; 
                $url="http://tsc.isap.pk:9001/api/Revenue";   
                $ch = curl_init();
                curl_setopt ($ch, CURLOPT_URL, $url);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt ($ch, CURLOPT_POST, 1);
                curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
                curl_setopt ($ch, CURLOPT_POSTFIELDS,json_encode($postSapData));
                curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                $result = curl_exec ($ch);
                curl_close($ch);
                $result = json_decode ($result);
                if($result->status == "Success"){
                    foreach($value as $rw){  
                        return $ids =  DB::table("sale_records")->where('user_id',$rw['SalesEmployee'])
                                ->where('sap_id',0)->where('client_status',"billable")->where('client_code',$row->client_code)
                                ->whereDate("created_at",date("Y-m-d",strtotime($key)))->pluck('id');

                        DB::table("sale_records")->whereIn('id',$ids)->update([
                            'sap_id'=>@$result->sapReference ? @$result->sapReference : 0,
                            'sap_response'=>json_encode($result),
                            'sap_post_data'=>json_encode($postSapData),
                        ]);
                    }
                    
                }  
            } 
        }         
        return response()->json(['status'=>200,'message'=>"success"]);








    }
    public function sapDataToMortgage(Request $request){  
        // echo date('Y-m-d',strtotime('-90 days'));exit;
        set_time_limit(0);$test =array();
        $clients = Client::where('campaign_id',3)->get(); $arrayData=array(); 
        foreach($clients as $row){
                $sales = DB::table('sale_mortgages')
                ->select('client_code as CardCode','project_code as ItemCode')
                ->selectRaw("
                            Count(CASE WHEN sale_mortgages.client_status = 'billable' THEN 1 ELSE NULL END) AS Quantity,
                            Count(CASE WHEN sale_mortgages.qa_status = 'billable' THEN 1 ELSE NULL END) AS QABillable,
                            Count(CASE WHEN sale_mortgages.qa_status = 'non-billable' THEN 1 ELSE NULL END) AS QANonBillable,
                            Count(CASE WHEN sale_mortgages.qa_status = 'pending' THEN 1 ELSE NULL END) AS QAPending,
                            Count(CASE WHEN sale_mortgages.client_status = 'pending' THEN 1 ELSE NULL END) AS ClientPending,
                            user_id as SalesEmployee, 
                            created_at as DocDate                  
                            ")
                ->where('client_code',$row->client_code)  
                ->where('project_code',"<>","PRO0075") 
                ->where('project_code',"<>","PRO0074") 
                ->where('sap_id',0)  
                ->whereNotIn('user_id',array(63545,121439,221077,362887,429951,455511,761335,996695,99695,238229,272401,390469,399575,424893,425300,443789,531340,567227,579785,594621,622934,59547,92749,56461,91180,119571,169948,407783,412595,502623,508705,569189,585108,684175,792120,951163,0,46326,69297,154883,171780,184384,241119,297000,330839,380029,575801,654321,852703))
                ->groupBy('user_id','created_at','project_code')
                ->get();      
            $userIds=array();      
            foreach($sales as $sale){
                if($sale->Quantity<=0){
                    continue;
                }   
                $rw['ItemCode']=(string)$sale->ItemCode;
                $rw['Quantity']= $sale->Quantity; 
                $rw['QABillable']=(string)$sale->QABillable;
                $rw['QANonBillable']=(string)$sale->QANonBillable; 
                $rw['QAPending']=(string)$sale->QAPending;
                $rw['ClientPending']=(string)$sale->ClientPending; 
                $rw['SalesEmployee']=(string)$sale->SalesEmployee;
                $rw['QAScore']="0"; 
                $rw['AgentCallsCount']="0"; 
                $arrayData[date("Y-m-d",strtotime($sale->DocDate))][] = $rw; 
                $date['SalesEmployee'] = $sale->SalesEmployee;
                $date['date'] = $sale->DocDate;
                $userIds[date("Y-m-d",strtotime($sale->DocDate))][] =$date;  
            } 
            // return $arrayData;
            foreach($arrayData as $key => $value){
                $postSapData=array();                    
                $postSapData['APIKey']="$%fsdfkbAusfiewrg93485#&^";
                $postSapData['DocDate']=date("Y-m-d",strtotime($key));
                $postSapData['CardCode']=$sale->CardCode;              
                $postSapData['DocumentLines']=$value;//return $postSapData;
                $data['CardCode']=$row->client_code; 
                $data['DocumentLines']=$postSapData; 
                $url="http://tsc.isap.pk:9001/api/Revenue";   
                $ch = curl_init();
                curl_setopt ($ch, CURLOPT_URL, $url);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt ($ch, CURLOPT_POST, 1);
                curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
                curl_setopt ($ch, CURLOPT_POSTFIELDS,json_encode($postSapData));
                curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                $result = curl_exec ($ch);
                curl_close($ch);
                $result = json_decode ($result); 
                foreach($value as $rw){  
                    $ids =  DB::table("sale_mortgages")->where('user_id',$rw['SalesEmployee'])
                            ->where('client_status',"billable")->where('client_code',$row->client_code)
                            ->whereDate("created_at",date("Y-m-d",strtotime($key)))->pluck('id');

                    DB::table("sale_mortgages")->whereIn('id',$ids)->update([
                        'sap_id'=>@$result->sapReference? @$result->sapReference :0,
                        'sap_response'=>json_encode($result),
                        'sap_post_data'=>json_encode($postSapData),
                    ]);
                }                      
            } 
        } 
        // return $arrayData;        
        return response()->json(['status'=>200,'message'=>"success"]);
       
        
    }
    public function sapDataWarranty(Request $request){  
        set_time_limit(0);$test =array();
        $arrayData=array();
        $sales = DB::table('home_warranties')
            ->select('client_code as CardCode','project_code as ItemCode')
            ->selectRaw("
                        Count(CASE WHEN home_warranties.client_status = 'billable' THEN 1 ELSE NULL END) AS Quantity,
                        Count(CASE WHEN home_warranties.qa_status = 'billable' THEN 1 ELSE NULL END) AS QABillable,
                        Count(CASE WHEN home_warranties.qa_status = 'non-billable' THEN 1 ELSE NULL END) AS QANonBillable,
                        Count(CASE WHEN home_warranties.qa_status = 'pending' THEN 1 ELSE NULL END) AS QAPending,
                        Count(CASE WHEN home_warranties.client_status = 'pending' THEN 1 ELSE NULL END) AS ClientPending,
                        hrms_id as SalesEmployee, 
                        created_at as DocDate
                    ")
            ->where('client_code',"CUS-100056")                       
            ->where('sap_id',0)     
            ->groupBy('hrms_id','created_at','project_code')->get();      
        $userIds=array();      
        foreach($sales as $sale){
            if($sale->Quantity<=0){
                continue;
            }   
            $rw['ItemCode']=(string)$sale->ItemCode;
            $rw['Quantity']= $sale->Quantity; 
            $rw['QABillable']=(string)$sale->QABillable;
            $rw['QANonBillable']=(string)$sale->QANonBillable; 
            $rw['QAPending']=(string)$sale->QAPending;
            $rw['ClientPending']=(string)$sale->ClientPending; 
            $rw['SalesEmployee']=(string)$sale->SalesEmployee;
            $rw['QAScore']="0"; 
            $rw['AgentCallsCount']="0"; 
            $arrayData[date("Y-m-d",strtotime($sale->DocDate))][] = $rw; 
            // return $arrayData;
            $date['SalesEmployee'] = $sale->SalesEmployee;
            $date['date'] = $sale->DocDate;
            $userIds[date("Y-m-d",strtotime($sale->DocDate))][] =$date;  
        } 
            
        foreach($arrayData as $key => $value){
			//return $value;
            $postSapData=array();                    
            $postSapData['APIKey']="$%fsdfkbAusfiewrg93485#&^";
            $postSapData['DocDate']=date("Y-m-d",strtotime($key));
            $postSapData['CardCode']=$sale->CardCode;              
            $postSapData['DocumentLines']=$value;//return $postSapData;
            $data['CardCode']="CUS-100019"; 
            $data['DocumentLines']=$postSapData; 
            $url="http://tsc.isap.pk:9001/api/Revenue";   
            $ch = curl_init();
            curl_setopt ($ch, CURLOPT_URL, $url);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt ($ch, CURLOPT_POST, 1);
            curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt ($ch, CURLOPT_POSTFIELDS,json_encode($postSapData));
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $result = curl_exec ($ch); 
            curl_close($ch);
            $result = json_decode ($result); 
            foreach($value as $rw){  
                return $ids =  DB::table("home_warranties")->where('hrms_id',$rw['SalesEmployee'])
                        ->where('sap_id',0)->where('client_status',"billable")->where('client_code',"CUS-100056")
                        ->whereDate("created_at",date("Y-m-d",strtotime($key)))->pluck('id');

                DB::table("home_warranties")->whereIn('id',$ids)->update([
                    'sap_id'=>@$result->sapReference ? @$result->sapReference :0,
                    'sap_response'=>json_encode($result),
                    'sap_post_data'=>json_encode($postSapData),
                ]);
            } 
        } 
        
        // return $arrayData;        
        return response()->json(['status'=>200,'message'=>"success"]);
       
        
    }
	


	public function get_record($record_id){
			//$record_id = $request->record_id;
			$url = "http://115.186.128.55/api/?record_id=".$record_id;	
			$client = curl_init($url);
			curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
			$response = curl_exec($client);
			$result = json_decode($response);
			return $result;
		   //return response()->json(['status'=>200,'message'=>"success", 'data' => $result]);
	}
	
	public function all_debt_records(Request $request){
        try{ 
		 
			$search=$request->search;
			if($request->search){				
				$res =  SaleMortgage::select('*')->where('project_code','PRO0105')
						 ->where('phone','LIKE',"%".@$search."%")
						 ->orderBy('created_at','DESC')->paginate(50);
			}else{
				$res = SaleMortgage::select('*')->where('project_code','PRO0105')->orderBy('created_at','DESC')->paginate(50);
			}
			  			
            return response()->json($res); 
        }catch (\Exception $e) {
            return response()->json([
                'status'  => '500',
                'message' => 'Request Failed',
                'server_error' => $e->getMessage(),
            ],500);
        }
        
    }

	public function updateReocrId(){  

        return $userIds = DB::table('users')->where('hrms_id',">",0)->pluck('hrms_id');
        return DB::table('home_warranties')->where('record_id',0)->pluck('phone');
        $array1=["502671","431235","213619","608323","901087","325422","997612","174605","842209","848937","749051","140363","855107","752589","993562","25615","530477","184647","942105","106281","545265","54305","305765","434433","594937","636347","442901","865465","214465","15897","964421","127051","348647","270089","997614","558563","24389","672278","942983","145719","482397","139198","971883","96375","164475","577201","997615","984409","285019","458399","642701","493793","937807","475269","245165","827515","106007","185401","24299","492625","446299","891574","381077","538761","817229","217259","537500","779967","943207","990899","595265","47481","335697","150595","729948","146312","326440","703317","175025","528055","368089","583047","823422","350237","216161","238059","684175","838399","897553","915091","312253","82623","590017","280077","480401","606475","657627","85923","834430","68817","764531","47927","265941","391461","160537","112959","56199","972905","357607","344155","643766","342099","425863","333247","627417","919107","851179","308873","366467","576469","798771","451211","643561","878511","7389","391809","341493","186465","432081","982421","665607","855915","805121","432467","549589","187629","74249","424633","563188","998079","84863","182137","338651","423123","682655","735291","998011","819363","819909","706797","45513","354629","990093","23613","980629","731059","900097","692078","302049","673361","158347","630161","286203","238485","446193","952013","37447","324599","998082","224910","259659","167875","531517","519681","137213","713065","731345","26824","393385","794071","632657","210040","529587","843101","857455","157651","828269","616971","965908","784757","910829","566407","516541","429951","154487","487869","132463","689878","958769","887873","998080","504418","998081","65","165760","428131","657168","894170","83277","541301","412703","382515","200055","475041","989047","381127","974745","74765","615163","23672","607127","195863","176415","848072","277195","718565","231965","409646","892017","332103","766469","329247","544568","729057","340986","439345","609652","300026","917184","725375","822227","188717","685913","467423","525031","975447","822695","825643","543485","385929","110471","819749","569051","328895","728239","718691","902760","832297","201","394249","425259","97271","202691","879315","12379","515231","92495","778121","454123","728477","125135","612100","262294","500669","26665","771086","864845","827039","665427","330704","443873","334475","264617","255095","914751","206562","512430","397761","154883","845091","454671","662922","153702","217539","993574","970603","189090","799063","817365","46709","951460","38055","372847","631983","669478","421001","272401","548699","731623","624841","918257","782253","916167","840950","460575","813699","860189","885039","303195","895104","496327","287217","96400","6987","2494","296936","267109","124305","89545","694825","625311","790293","347189","178693","643107","415027","178534","212979","390521","232825","233021","724827","342937","488569","628223","283669","475827","233200","890535","732741","868536","658788","576831","486829","52567","861","922865","508253","14647","329335","767981","97161","495789","200117","262443","804489","10037","921479","558741","768793","593561","962383","42795","467609","88952","555683","352555","200227","477772","727063","787181","714113","519047","721797","67203","893339","122401","370379","594951","238743","238049","767823","390469","867735","426905","259918","423270","318586","791523","691253","209153","88903","419439","810889","633737","623249","285775","695685","358003","997983","259642","36457","78849","248087","900457","984439","62705","777425","194981","566141","272137","222137","593350","883939","596765","374091","170675","992529","976739","515407","972641","293477","969192","315519","157353","35313","132695","372418","549440","851727","174347","942965","537079","818356","346397","706787","461837","279865","545155","727408","585538","891389","312576","785776","852703","945347","146137","981982","218203","487702","559617","63001","913563","352973","901705","940255","926599","540017","154885","455781","356100","502527","86327","668233","245874","811913","806051","413349","793257","22566","846385","807065","691297","408353","262592","564215","880555","180457","976569","883059","996042","438079","87633","273321","937251","776485","151955","897001","628401","987959","386823","403427","467205","210814","295088","934767","981395","755795","231220","254505","288380","162457","775284","865609","349809","231905","403299","653795","577555","864265","858403","193569","488339","146489","63973","711432","741753","630131","850441","258110","829629","653999","90329","47783","329361","152181","288261","862825","812235","567001","713591","708248","522075","819872","407896","861563","694287","233676","595281","870629","130541","903433","998489","723181","993953","908955","937501","649023","844945","887913","504401","452157","564365","152291","622934","331949","911801","880583","373373","507370","681682","885561","270801","981205","11125","130617","964737","559383","650899","735800","751543","668121","216345","700261","484241","104337","674139","519525","428387","747141","550395","109482","809579","567708","717807","907","729293","946340","898991","939905","996695","455511","260798","672784","851001","184384","406547","522699","822787","58405","253233","730767","734931","531419","821811","60655","789645","593215","586755","264317","68105","277461","906311","561717","749202","689757","446491","721817","356709","330839","343959","920825","393041","154940","254405","844877","641877","342561","968745","943306","706781","864319","658803","438149","108531","297725","205391","930220","172105","944667","284459","625279","704389","494083","517942","44222","686233","491087","397051","312136","364295","246326","95496","338381","692897","465031","833955","623230","72497","481083","616093","378669","521978","757315","648656","466460","57945","387759","93921","572844","56571","140592","399575","443789","425300","238229","92749","822162","418210","315687","594621","78473","221077","56461","121439","894399","294893","335573","893461","567227","761335","932211","536134","627339","723517","682496","248683","325383","992315","688217","819835","162225","794569","549393","354405","725851","465651","809469","226443","819982","60295","457269","494582","366645","222855","71419","264311","191735","362887","424893","508705","296723","787201","947912","973490","857585","200595","863349","128701","533685","778733","461466","872001","7612","979422","647229","20543","476553","691741","370224","817985","280499","928453","826365","69711","697026","863165","208699","741967","924769","339","869020","481539","595801","791076","975625","137963","540462","975772","4691","330255","85355","765163","352347","326644","601373","623085","560157","139826","811595","50777","178119","698081","497175","148343","751493","191664","508323","675029","59547","698537","421313","279986","560657","899763","766189","922370","187029","55879","79045","548261","263993","704317","780369","324143","465913","928533","971053","967379","51867","956697","948172","54397","461797","429681","142445","597592","192211","216612","166115","551581","897399","913609","587395","285255","827579","878075","993965","702221","359889","234496","762561","284047","569023","639815","654803","846813","720001","810093","12345","10139","5265236","12546320","24805","397735","255095","736245","702409","607651","579785","102492","940627","915783","720869","698377","110431","314149","207649","617830","834109","273003","770288","430447","940319","506103","130677","152933","654803","447373","447373","642563","469431","479611","499713","508281","836994","192727","445566","5465465","887913","1111","407783","996749","616823","293249","667049","39477","230631","421297","141641","567557","623025","356709","61720","467959","112233","333333","397735","702409","607651","108531","636347","673361","475827","937251","865609","97161","438149","522699","59547","443789","314149","794071","630161","14647","8791158","285019","286203","68105","207649","998079","110431","165125","720869","940627","782253","918257","102492","698377","769373","990093","915783","945347","791076","579785","287217","595801","695957","1971","252122","833014","190131","984741","776485","916727","960495","658267","958657","949915","282478","594621","119863","119571", "312733","221843","591070","403215","851838","378083","250449","123456","722055","833955","943739","854157","521297","350479","026529","709111","871471","26665","152181","216345","221077","231220","258110","273321","279986","353109","373373","407783","467423","484241","590017","700261","723181","755795","842263","871471","878075","993953","428131","775795","166739","909761","378939", "001971","001971","162457","111111","11111","165125","331375","331375","967281","427393","012539","376061","999999","702301","774044","39477","405509","997701","477404","885525","107557","329981","276197","063185","99999","999999","999999","212285", "961181","087223","962385","971447","402700","561113","795321","508686","375167","464003","013573","715973","569189","585108","673687","412595","502623","330255","238430","991523","553757","063185"];
        $array2=[65,201,339,861,1971,2461,4691,6987,9211,9787,10037,10139,10209,11125,11606,12539,13203,13573,14647,14779,14921,15897,20077,20543,21480,22383,22566,23613,24389,24805,25615,26387,26665,27544,28023,33677,33763,36457,37726,38055,39477,42795,44222,45513,47783,50515,50519,52567,54377,54397,55879,56571,57669,58405,59547,60295,60503,61339,61720,62705,63001,63185,63232,63657,63797,63973,66751,67203,67929,68105,68145,69447,69911,72497,74249,74663,75095,75673,77429,77847,78473,78849,79045,81177,82212,84528,85355,86327,86659,87223,87633,88903,89545,89857,90329,91097,91671,92749,93921,94655,94917,97161,97357,98545,102492,104337,105350,107557,108531,110431,113419,117034,118604,119385,119571,119863,120077,121439,122093,122401,122587,122883,125173,126435,126491,127355,128701,128963,130541,130617,130677,132463,135705,136027,137963,139826,140592,141641,143077,144955,145183,145185,146137,146312,146317,146489,146494,148343,148393,149229,150347,150576,152181,152291,152933,153702,153774,154389,154885,154940,155360,156771,157375,157429,158347,158349,160537,160658,161035,162225,162457,163377,164475,165125,165760,166222,166739,169475,169948,170513,171227,171233,172105,174347,177895,178119,178534,180457,180929,181619,182137,184647,186465,187029,188741,189381,190131,191201,191664,191735,192211,192727,195821,195863,196053,197948,198387,200085,200117,200227,200595,201945,204015,206562,207649,207787,208699,209153,210040,210814,212979,213619,214465,216345,217539,219233,220559,221077,221843,222137,223202,224910,225290,226443,229611,230183,230631,231220,232669,232825,233021,233676,234496,238430,238743,242474,245165,247117,248087,248607,248683,250449,250657,252122,253233,254405,254505,255095,255707,256361,258110,259918,260798,262294,262443,262592,263993,264311,267109,270457,270801,272137,273003,273321,273865,275467,276197,277195,277461,279865,279986,280499,282029,282478,283669,284047,285019,285255,285775,286203,286793,287217,293249,294893,295061,296263,296723,297939,299837,300026,305049,308436,308873,309661,312136,312576,312733,312999,314149,315449,315519,315687,317361,317432,318586,318827,320879,324143,325383,326440,326644,328895,329335,329563,329981,330255,330704,331375,333247,335573,335585,335697,337323,342561,343959,344025,346307,346844,348175,349125,350479,351081,352347,352555,352973,353109,356100,356709,357607,358003,359889,361007,362887,362985,364295,370224,372418,373373,374129,375167,376061,378083,378669,378939,381438,381589,381850,383018,383703,384222,385203,385929,386141,386823,387759,387901,389263,389371,390469,390521,391075,393005,393041,396161,397051,399575,400457,401372,402700,403215,403427,404252,405509,406547,408049,408353,409646,412703,419085,419439,421001,421297,421313,423709,424155,424633,424893,425259,426795,427393,428131,428387,429681,430447,431235,431412,431479,434433,438149,442901,443789,443873,446059,446193,446491,447373,448933,449512,451211,451783,452157,455781,457269,461797,461837,463697,464003,464461,465031,465651,465913,467205,467423,467959,469431,469575,471365,472115,474421,475041,475811,475827,477772,478033,478242,479291,479611,480650,480795,481083,481539,484073,484241,487702,488339,490513,494083,496327,496873,497175,499696,499713,502527,502671,504418,506103,507370,508281,508323,508686,508705,509902,513485,517942,518106,519047,519525,521297,522075,522699,528055,529501,529587,530477,533685,534649,536134,537079,538761,540017,540462,541301,541729,543485,544101,546005,547229,548261,548699,549393,549969,550395,550699,551581,553655,554757,556921,558062,558741,559383,559617,560657,561113,561717,564215,565289,566141,567001,567227,567467,567557,569023,569051,570535,570815,572844,576469,576967,577201,579785,583047,584823,584833,585538,586755,588097,588645,588981,590017,591070,591205,593215,593561,594621,595801,596098,596765,597592,598429,600403,601373,603763,607127,607651,608747,609385,609652,610149,611383,614319,616093,616823,616971,617830,619347,622934,623025,623085,623230,623249,625279,626387,627339,627417,628223,629985,630161,631983,633737,633833,636001,636347,639815,641877,642563,642701,643047,643389,643561,643766,644387,644796,644961,645515,647113,647229,649023,649128,651073,653999,654803,655017,655325,657019,658267,658788,658803,659925,662922,665427,665607,667049,668121,668233,668965,672784,673361,674139,675029,678305,680447,681682,682496,683451,685837,685913,686233,687851,688217,688985,689878,691253,691297,691741,692078,692897,694009,694287,695685,695957,696153,697026,698081,698377,699307,699569,700261,702221,702301,702409,703317,703360,704317,704389,704393,706187,706925,708125,708248,709111,710885,713607,714113,718565,718691,720001,720869,721797,721817,722055,723181,723517,724827,724889,725851,728239,729057,730767,731059,731345,732741,732838,733823,734931,735015,736035,736245,740086,741753,741967,747141,748597,749051,749202,751059,751493,751543,752446,755795,757315,758737,759615,761335,762561,763481,763679,764844,766189,767823,769373,770288,771086,772791,774044,775795,776127,776443,776485,776807,780369,782253,782435,783719,784203,787181,789645,790293,791076,791523,791693,791799,794249,794569,794797,795321,795503,798771,804489,804874,805121,806855,807065,809579,810093,811595,811913,812235,816409,818356,818905,819835,819872,819982,821811,822227,822787,823422,823935,825643,826365,826581,826993,827515,829629,832297,832607,833014,834109,836994,842209,843101,844877,844945,845273,846813,848072,848937,850441,851179,851838,853957,854157,854416,854995,857097,857455,858403,858439,860189,860198,863165,863349,864265,864319,865609,866383,867257,868523,869020,869992,870629,871471,872001,873790,874609,876477,878511,879315,880583,880873,883059,883939,885525,885561,885999,886443,887873,887913,890535,891389,891911,892017,892639,893339,893461,893821,894170,894399,895449,896075,896181,897553,899763,900097,900457,900689,901087,902760,903433,906311,906873,907183,908955,909761,911801,913609,914461,914945,915091,915783,916727,917184,918257,920825,921092,922370,922725,922865,924769,924869,925349,926599,928453,928533,929499,930220,932211,935333,937101,937501,939571,939951,940255,940319,940627,941653,942861,942965,942983,943306,943739,944667,945347,946115,948172,949915,951129,951460,951883,953215,955955,957827,958627,958657,958769,960495,960721,961181,961275,962383,962385,962591,964737,965908,967281,967379,968745,969192,970195,971053,971088,971447,971607,971888,972641,973490,974745,975521,975625,975772,977867,979422,980629,981205,981395,981982,983451,983523,984439,984741,985179,985391,986201,989007,989047,990093,990899,991523,992315,993562,993953,993965,996042,996749,997615,997616,997701,998079,998080,998489,998490];
        $diff=array();
        foreach($array1 as $key){
            foreach($array2 as $val){
                if($val == $key){
                    $check=true; break;
                }else{
                    $check = false;
                }
            }
            if($check==false){
                $diff[]=$key;
            }
        }
        // print_r($diff);exit;
        return DB::table('users')->whereIn('HRMSID',$diff)->pluck('HRMSID');
    
        // $file = fopen(storage_path() ."/hrmsid.csv", "r");
        // $array = array(); $reason_array = array();
        // while (($getData = fgetcsv($file, 100, ",")) !== FALSE) {             
        //     \DB::table('home_warranties')->where("phone",$getData[1])->where('record_id',0)->update([
        //         'record_id'=>$getData[0]
        //     ]);
        // }
        // fclose($file);        
    }
	public function get_debt_record($id){
        try{ 
			$res = SaleMortgage::select('*')->where('project_code','PRO0105')->where('id',$id)->orderBy('created_at','DESC')->first(); 
			
            return response()->json($res); 
        }catch (\Exception $e) {
            return response()->json([
                'status'  => '500',
                'message' => 'Request Failed',
                'server_error' => $e->getMessage(),
            ],500);
        }
        
   }	
	public function update_debt_record(Request $request){
		$id = $request->input('id');
		$id = (int)$id;
		$client_status = $request->input('client_status');
		$client_remarks = $request->input('remarks');
		$status = "";
		if($client_status=='accepted'){
			$status = "billable";
		}
		if($client_status=='rejected'){
			$status = "not-billable";
		}
		if($client_status=='pending'){
			$status = "pending";
		}
		//echo $request->input('client_status');
		if(SaleMortgage::where('id',$id)->update(['client_status'=> $status, 'client_remarks' => $client_remarks])){		
			return response()->json(['status'=>200,'message'=>"Updated successfully", 'id' => $id, 'client_status' => $status]);
		}else{
			return response()->json(['status'=>201,'message'=>"Not Updated", 'id' => $id, 'client_status' => $status]);
		}
	}
	
	     public function getCampaigns()
    {
        $campaigns = Campaign::select('id', 'name', 'table_name', 'status')->get()->toJson();
        return response()->json([
            'success' => 200,
            'message' => 'All Campaigns',
            'data' => $campaigns
        ]);
    }
    public function getClients()
    {
        $clients = Client::select('id', 'client_code', 'name', 'campaign_id')->get()->toJson();
        return response()->json([
            'success' => 200,
            'message' => 'All Clients',
            'data' => $clients
        ]);
    }
    public function getProjects()
    {
        $projects = Project::select('id', 'name', 'project_code', 'client_id')->get()->toJson();
        return response()->json([
            'success' => 200,
            'message' => 'All Projects',
            'data' => $projects
        ]);
    }
}
