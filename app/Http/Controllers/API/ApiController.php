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
				$res = HomeWarranty::select('record_id','hrms_id','campaign_id','client','created_at')
					->with('campaign:id,name')
					->where('qa_status','Pending')->orderBy('created_at','DESC')->get();
			}elseif($request->id ==2){
				$res = SaleRecord::select('record_id','user_id as hrms_id','campaign_id','created_at')
					  ->with('campaign:id,name')
					  ->where('qa_status','Pending')->orderBy('created_at','DESC')
				->get();
			}
			elseif($request->id ==3){
				$res = SaleMortgage::select('record_id','user_id as hrms_id','campaign_id','created_at')
					->with('campaign:id,name','client:id,name')
					->where('qa_status','Pending','client:id,name')->orderBy('created_at','DESC')->get();
			}else{
				$res = SaleMortgage::select('record_id','user_id as hrms_id','campaign_id','created_at')
					->with('campaign:id,name','client:id,name')
					->where('qa_status','Pending')->orderBy('created_at','DESC')->get();
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


    public function updateQmsStatus(Request $request){
        // return $request;
        try{
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
		\DB::table($request->table)->where('id',$request->id)->update(['client_status'=>$request->client_status,'notes'=>$request->remarks]);
		return ['status'=>200,"message"=>"success"];
	}
    public function campaigns(Request $request){
        $campaigns = Campaign::get();
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
            return $data['res'] = \DB::table('projects')->get();
        }

    }
    public function updateReocrId(){
        $file = fopen(storage_path() ."/Book1.csv", "r");
        $array = array(); $reason_array = array();
        while (($getData = fgetcsv($file, 100, ",")) !== FALSE) {
            \DB::table('users')->where("HRMSID",$getData[0])->update( ['pseudo_name'=>$getData[1],'campaign'=>"Solar ISB" ]);
        }
        fclose($file);

    }
    public function sapData(Request $request){
        set_time_limit(0);$test =array();
        $clients = Client::where('campaign_id',2)->get(); $arrayData=array();$arrayData=array();
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
                ->where('campaign_id',2)
                ->where('project_code',"<>","PRO0075")
                ->where('project_code',"<>","PRO0074")
                ->where(function($query){
                    $query->whereNull('sap_id');
                })
                ->whereNotIn('user_id',array(63545,121439,221077,362887,429951,455511,761335,996695,99695,238229,272401,390469,399575,424893,425300,443789,531340,567227,579785,594621,622934,59547,92749,56461,91180,119571,169948,407783,412595,502623,508705,569189,585108,684175,792120,951163,0,46326,69297,154883,171780,184384,241119,297000,330839,380029,575801,654321,852703))
                ->groupBy('user_id','created_at')->get();
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
                // if($result->status == "Success"){
                    foreach($value as $rw){
                        $ids =  DB::table("sale_records")->where('user_id',$rw['SalesEmployee'])
                                ->whereNull('sap_id')->where('client_status',"billable")->where('client_code',$row->client_code)
                                ->whereDate("created_at",date("Y-m-d",strtotime($key)))->pluck('id');

                        DB::table("sale_records")->whereIn('id',$ids)->update([
                            'sap_id'=>$result->sapReference,
                            'sap_response'=>json_encode($result),
                            'post_data'=>json_encode($postSapData),
                        ]);
                    }

                // }
            }
        }
        return response()->json(['status'=>200,'message'=>"success"]);
    }
    public function sapDataToMortgage(Request $request){
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
                ->where(function($query){
                    $query->whereNull('sap_id');
                })
                ->whereNotIn('user_id',array(63545,121439,221077,362887,429951,455511,761335,996695,99695,238229,272401,390469,399575,424893,425300,443789,531340,567227,579785,594621,622934,59547,92749,56461,91180,119571,169948,407783,412595,502623,508705,569189,585108,684175,792120,951163,0,46326,69297,154883,171780,184384,241119,297000,330839,380029,575801,654321,852703))
                ->groupBy('user_id','created_at')
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
                // if($result->status == "Success"){
                    foreach($value as $rw){
                        $ids =  DB::table("sale_mortgages")->where('user_id',$rw['SalesEmployee'])
                                ->where('client_status',"billable")->where('client_code',$row->client_code)
                                ->whereDate("created_at",date("Y-m-d",strtotime($key)))->pluck('id');

                        DB::table("sale_mortgages")->whereIn('id',$ids)->update([
                            'sap_id'=>$result->sapReference,
                            'sap_response'=>json_encode($result),
                            'post_data'=>json_encode($postSapData),
                        ]);
                    }

                // }
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
                ->where('client_code',"CUS-100019")
                ->whereNull('sap_id')
                ->where('project_code',"<>","PRO0075")
                ->where('project_code',"<>","PRO0074")
                ->whereNotIn('hrms_id',array(63545,121439,221077,362887,429951,455511,761335,996695,99695,238229,272401,390469,399575,424893,425300,443789,531340,567227,579785,594621,622934,59547,92749,56461,91180,119571,169948,407783,412595,502623,508705,569189,585108,684175,792120,951163,0,46326,69297,154883,171780,184384,241119,297000,330839,380029,575801,654321,852703))
                ->groupBy('hrms_id','created_at')->get();
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
                // if($result->status == "Success"){
                    foreach($value as $rw){
                        $ids =  DB::table("home_warranties")->where('hrms_id',$rw['SalesEmployee'])
                                ->whereNull('sap_id')->where('client_status',"billable")->where('client_code',"CUS-100019")
                                ->whereDate("created_at",date("Y-m-d",strtotime($key)))->pluck('id');

                        DB::table("home_warranties")->whereIn('id',$ids)->update([
                            'sap_id'=>$result->sapReference,
                            'sap_response'=>json_encode($result),
                            'post_data'=>json_encode($postSapData),
                        ]);
                    }

                // }
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

	public function all_debt_records(){
        try{


			$res = SaleMortgage::select('*')->where('project_code','PRO0108')->orderBy('created_at','DESC')->paginate(10);

            return response()->json($res);
        }catch (\Exception $e) {
            return response()->json([
                'status'  => '500',
                'message' => 'Request Failed',
                'server_error' => $e->getMessage(),
            ],500);
        }

   }


	public function get_debt_record($id){
        try{
			$res = SaleMortgage::select('*')->where('project_code','PRO0108')->where('id',$id)->orderBy('created_at','DESC')->first();

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
