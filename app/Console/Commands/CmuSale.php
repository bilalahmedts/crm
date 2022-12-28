<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Client; use DB;
class CmuSale extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CmuSale:cron';

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
        $arrayData=array();
        $sales = DB::table('cmu_sales')
                ->select('project_code as ItemCode','count AS Quantity')
                ->selectRaw("
                            hrms_id as SalesEmployee, 
                            created_at as DocDate
                        ")                        
                ->where('sap_id',0)        
                ->where('hrms_id',">",0)        
                ->groupBy('hrms_id','created_at','project_code')
                ->get();      
            $userIds=array();      
            foreach($sales as $sale){
                if($sale->Quantity<=0){
                    continue;
                }   
                $rw['ItemCode']=(string)$sale->ItemCode;
                $rw['Quantity']= $sale->Quantity; 
                $rw['QABillable']="0";
                $rw['QANonBillable']="0"; 
                $rw['QAPending']="0";
                $rw['ClientPending']="0"; 
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
                $postSapData['CardCode']="CUS-100028";              
                $postSapData['DocumentLines']=$value;
                $data['CardCode']="CUS-100028"; 
                $data['DocumentLines']=$postSapData; // return $postSapData;
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
                        $ids =  DB::table("cmu_sales")->where('hrms_id',$rw['SalesEmployee'])
                                ->where('sap_id',0)->where('client_status',"billable")->where('client_code',"CUS-100028")
                                ->whereDate("created_at",date("Y-m-d",strtotime($key)))->pluck('id');

                        DB::table("cmu_sales")->whereIn('id',$ids)->update([
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
