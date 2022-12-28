<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Client; use DB;
class sendHomeWarrantyDataToSap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendHomeWarrantyDataToSap:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        set_time_limit(0);$test =array();
		exit;
        $arrayData=array();
        $projectCodes = Project::where('isFixed',1)->pluck('project_code');
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
                ->where('client_code',"CUS-100028")                       
                ->whereNull('sap_id')    
                // ->where('project_code',"<>","PRO0075") 
                // ->where('project_code',"<>","PRO0074") 
                ->whereNotIn('project_code',$projectCodes)  
                ->whereNotIn('hrms_id',array(
					63545,121439,221077,362887,429951,455511,761335,996695,99695,238229,272401,390469,399575,
					424893,425300,443789,531340,567227,579785,594621,622934,59547,92749,56461,91180,119571,169948,
					407783,412595,502623,508705,569189,585108,684175,792120,951163,0,46326,69297,154883,171780,
					184384,241119,297000,330839,380029,575801,654321,852703
				))
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
                $postSapData=array();                    
                $postSapData['APIKey']="$%fsdfkbAusfiewrg93485#&^";
                $postSapData['DocDate']=date("Y-m-d",strtotime($key));
                $postSapData['CardCode']=$sale->CardCode;              
                $postSapData['DocumentLines']=$value;//return $postSapData;
                $data['CardCode']="CUS-100028"; 
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
                        $ids =  DB::table("home_warranties")->where('hrms_id',$rw['SalesEmployee'])
                                ->whereNull('sap_id')->where('client_status',"billable")->where('client_code',"CUS-100019")
                                ->whereDate("created_at",date("Y-m-d",strtotime($key)))->pluck('id');

                        DB::table("home_warranties")->whereIn('id',$ids)->update([
                            'sap_id'=>$result->sapReference,
                            'sap_response'=>json_encode($result),
                            'post_data'=>json_encode($postSapData),
                        ]);
                    }
                    
               }  
            } 
        
        // return $arrayData;        
        return response()->json(['status'=>200,'message'=>"success"]);
    }
}
