<?php 
namespace App\Traits;
use DB; use Auth;  
use App\Models\SaleRecord;
use App\Models\Client;
use App\Models\Project;
use App\Models\ClientPosting;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Middleware\CheckType;
trait SolarPosting{

    public function lgPost($data,$id,$url){

        $postData = array(); 
        $postData['camp_id'] = "4087";
        $postData['camp_key'] = "PcxTeTenr0";
        $postData['xxTrustedFormToken'] = $data['xxTrustedFormToken'];
        $postData['xxTrustedFormCertUrl'] = $data['xxTrustedFormCertUrl'];
        $postData['xxTrustedFormPingUrl'] = $data['xxTrustedFormPingUrl'];
        $postData['leadid_token']=$data['leadid_token'];
        $postData['optin_cert']=$data['optin_cert'];
        $postData['first_name'] = $data['first_name'];
        $postData['last_name'] = $data['last_name'];
        $postData['phone_home'] = $data['phone']; 
        $postData['street_address'] = $data['address'];  
        $postData['zip_code'] = $data['zip_code'];
        $postData['email_address'] = $data['email']; 
        $postData['electric_provider'] = $data['electric_provider']; 
        $postData['electric_bill_monthly'] = $data['electric_bill_monthly']; 
        $postData['roof_shade'] = $data['roof_shade']; 
        $postData['homeowner'] = $data['homeowner']; 
        $postData['credit_score'] = $data['credit_score']; 
        $postData['credit_rating'] = $data['credit_rating']; 
        $postData['extra_notes'] = $data['notes'];
        //$postData['test']=1;
        $postData['ip_address']= $_SERVER['REMOTE_ADDR'];       
        $result = $this->curl($postData,$url);
        
        $this->posting($postData,$data['clients'],$id,$result);      
         
    }

    public function ChSolarPost($data,$id,$url){
        $postData = array();
        $postData['SRC'] = "PAK_Solar_Energy";
        $postData['Key'] = "845ece2d20d275eb51cd4baeb0c8ba6f7ea2d067c78d6af7a772aa5e07a5a0c3";
        $postData['API_Action'] = "pingPostLead";
        $postData['Average_Utility_Bill_2'] = "$151-200";
        $postData['Credit'] = "Good";
        $postData['Credit_2'] = "680-700";
        $postData['TYPE'] = "107";
        $postData['Mode'] = "full";
        $postData['Force_IPR_Buyer'] = "1";
        $postData['Landing_Page'] = "landing";
        $postData['IP_Address'] = "160.84.125.140";         
        $postData['First_Name'] = $data['first_name'];
        $postData['Last_Name'] = $data['last_name'];
        $postData['Phone'] = $data['phone']; 
        $postData['Address'] = $data['address'];  
        $postData['City'] = $data['city'];  
        $postData['State'] = $data['state'];  
        $postData['Zip'] = $data['zip_code'];  
        $postData['Phone'] = $data['phone'];  
        $result = $this->curl($postData,$url);       
        $this->posting($postData,$data['clients'],$id,$result);       
         
    }

    public function ChSunPost($data,$id,$url){
        $postData = array();
        $postData['SRC'] = "Pak_Solar_LTDP";
        $postData['Key'] = "c3dc21f6dafae95e8ed3a13c1f9dd4eb48d769f6a4def0858c1517166719cc32";
        $postData['API_Action'] = "pingPostLead";
        $postData['Average_Utility_Bill_2'] = "=$151-200";
        $postData['Credit'] = "Good";
        $postData['Credit_2'] = "680-700";
        $postData['TYPE'] = "107";
        $postData['Mode'] = "full";
        $postData['Force_IPR_Buyer'] = "1";
        $postData['Landing_Page'] = "landing";
        $postData['IP_Address'] = "=160.84.125.140";         
        $postData['First_Name'] = $data['first_name'];
        $postData['Last_Name'] = $data['last_name'];
        $postData['Phone'] = $data['phone']; 
        $postData['Address'] = $data['address'];  
        $postData['City'] = $data['city'];  
        $postData['State'] = $data['state'];  
        $postData['Zip'] = $data['zip_code'];  
        $postData['Phone'] = $data['phone'];  
                
        $result = $this->curl($postData,$url);
        $this->posting($postData,$data['clients'],$id,$result);        
         
    }
    public function ESPost($data,$id,$url){
        $postData = array();
        $postData['SRC'] = "PAK_Solar_Dance";
        $postData['Key'] = "c8a801026a6c88978df0f6c156696fe729aba4825b6f0bc4f1c318ef6accf8af";
        $postData['API_Action'] = "pingPostLead";
        $postData['Average_Utility_Bill_2'] = "$151-200";
        $postData['Credit'] = "Good";
        $postData['Credit_2'] = "680-700";
        $postData['TYPE'] = "107";
        $postData['Mode'] = "full";
        $postData['Force_IPR_Buyer'] = "1";
        $postData['Landing_Page'] = "landing";
        $postData['IP_Address'] = "160.84.125.141";        
        $postData['First_Name'] = $data['first_name'];
        $postData['Last_Name'] = $data['last_name'];
        $postData['Phone'] = $data['phone']; 
        $postData['Address'] = $data['address'];  
        $postData['City'] = $data['city'];  
        $postData['State'] = $data['state'];  
        $postData['Zip'] = $data['zip_code'];  
        $postData['Phone'] = $data['phone'];  
                
        $result = $this->curl($postData,$url);
        $this->posting($postData,$data['clients'],$id,$result);    
         
    } 
    
    public function PSPPost($data,$id,$url){
        $postData = array();
        $postData['SRC'] = "PAK_Solar_Power";
        $postData['Key'] = "1859f9656976ddb87618e715f755cf65228e22f0687db325f0d060c3335acb71";
        $postData['API_Action'] = "pingPostLead";
        $postData['Average_Utility_Bill_2'] = "$151-200";
        $postData['Credit'] = "Good";
        $postData['Credit_2'] = "680-700";
        $postData['TYPE'] = "107";
        $postData['Mode'] = "full";
        $postData['Force_IPR_Buyer'] = "1";
        $postData['Landing_Page'] = "landing";
        $postData['IP_Address'] = "160.84.125.140";        
        $postData['First_Name'] = $data['first_name'];
        $postData['Last_Name'] = $data['last_name'];
        $postData['Phone'] = $data['phone']; 
        $postData['Address'] = $data['address'];  
        $postData['City'] = $data['city'];  
        $postData['State'] = $data['state'];  
        $postData['Zip'] = $data['zip_code'];  
        $postData['Phone'] = $data['phone'];  
               
        $result = $this->curl($postData,$url);
        $this->posting($postData,$data['clients'],$id,$result);       
         
    }

    public function PSEarthPost($data,$id,$url){
        $postData = array();
        $postData['SRC'] = "PAK_Solar_Earth";
        $postData['Key'] = "442dea2567cd8783342ae3b3ea33985e437e5a7185f5d71b6b9bcc2a384ca5c5";
        $postData['API_Action'] = "pingPostLead";
        $postData['Average_Utility_Bill_2'] = "$151-200";
        $postData['Credit'] = "Good";
        $postData['Credit_2'] = "680-700";
        $postData['TYPE'] = "107";
        $postData['Mode'] = "full";
        $postData['Force_IPR_Buyer'] = "1";
        $postData['Landing_Page'] = "landing";
        $postData['IP_Address'] = "160.84.125.140";       
        $postData['First_Name'] = $data['first_name'];
        $postData['Last_Name'] = $data['last_name'];
        $postData['Phone'] = $data['phone']; 
        $postData['Address'] = $data['address'];  
        $postData['City'] = $data['city'];  
        $postData['State'] = $data['state'];  
        $postData['Zip'] = $data['zip_code'];  
        $postData['Phone'] = $data['phone'];  
               
        $result = $this->curl($postData,$url);
        $this->posting($postData,$data['clients'],$id,$result);       
         
    }
     
    public function PSBPost($data,$id,$url){
        $postData = array();
        $postData['SRC'] = "PAK_Solar_Berry";
        $postData['Key'] = "4b2fe6c190c1b1eafa3eb816b15b56b89dc38b6cd2058ef348e322cfdc7f1c9d";
        $postData['API_Action'] = "pingPostLead";
        $postData['Average_Utility_Bill_2'] = "$151-200";
        $postData['Credit'] = "Good";
        $postData['Credit_2'] = "680-700";
        $postData['TYPE'] = "107";
        $postData['Mode'] = "full";
        //$postData['Force_IPR_Buyer'] = "1";
        $postData['Landing_Page'] = "landing";
        $postData['IP_Address'] = "160.84.125.140";       
        $postData['First_Name'] = $data['first_name'];
        $postData['Last_Name'] = $data['last_name'];
        $postData['Phone'] = $data['phone']; 
        $postData['Address'] = $data['address'];  
        $postData['City'] = $data['city'];  
        $postData['State'] = $data['state'];  
        $postData['Zip'] = $data['zip_code'];  
        $postData['Phone'] = $data['phone'];  
               
        $result = $this->curl($postData,$url);
        $this->posting($postData,$data['clients'],$id,$result);       
         
    }

    public function LGLTPost($data,$id,$url){

        $postData = array(); 
        $postData['camp_id'] = "4438";
        $postData['camp_key'] = "PMvtKymPlPI";
        $postData['xxTrustedFormToken'] = $data['xxTrustedFormToken'];
        $postData['xxTrustedFormCertUrl'] = $data['xxTrustedFormCertUrl'];
        $postData['xxTrustedFormPingUrl'] = $data['xxTrustedFormPingUrl'];
        $postData['first_name'] = $data['first_name'];
        $postData['last_name'] = $data['last_name'];
        $postData['phone_home'] = $data['phone']; 
        $postData['street_address'] = $data['address'];  
        $postData['zip_code'] = $data['zip_code'];
        $postData['email_address'] = $data['email']; 
        $postData['electric_provider'] = $data['electric_provider']; 
        $postData['electric_bill_monthly'] = $data['electric_bill_monthly']; 
        $postData['roof_shade'] = $data['roof_shade']; 
        $postData['homeowner'] = $data['homeowner']; 
        $postData['credit_score'] = $data['credit_score']; 
        $postData['credit_rating'] = $data['credit_rating']; 
        $postData['extra_notes'] = $data['notes']; 
                
        $result = $this->curl($postData,$url);
        $this->posting($postData,$data['clients'],$id,$result);      
         
    }

    public function PSTAPost($data,$id,$url){
        $postData = array();
        $postData['SRC'] = "PAK_Solar_TA";
        $postData['Key'] = "f2e506b987345f7e610e7756563d5c275277473f752ba45c43b70542f1fd079a";
        $postData['API_Action'] = "pingPostLead";
        $postData['Average_Utility_Bill_2'] = "$151-200";
        $postData['Credit'] = "Good";
        $postData['Credit_2'] = "680-700";
        $postData['TYPE'] = "107";
        $postData['Mode'] = "full";
        //$postData['Force_IPR_Buyer'] = "1";
        $postData['Landing_Page'] = "landing";
        $postData['IP_Address'] = "160.84.125.140";       
        $postData['First_Name'] = $data['first_name'];
        $postData['Last_Name'] = $data['last_name'];
        $postData['Phone'] = $data['phone']; 
        $postData['Address'] = $data['address'];  
        $postData['City'] = $data['city'];  
        $postData['State'] = $data['state'];  
        $postData['Zip'] = $data['zip_code'];  
        $postData['Phone'] = $data['phone'];  
               
        $result = $this->curl($postData,$url);
        $this->posting($postData,$data['clients'],$id,$result);       
         
    }

    public function PSWPost($data,$id,$url){
        $postData = array();
        $postData['SRC'] = "PAK_Solar_Wurst";
        $postData['Key'] = "02ceff3124855a695b4810f3806a9b24586390c2ba976e4351c7b331149acf97";
        $postData['API_Action'] = "pingPostLead";
        $postData['Average_Utility_Bill_2'] = "$151-200";
        $postData['Credit'] = "Good";
        $postData['Credit_2'] = "680-700";
        $postData['TYPE'] = "107";
        $postData['Mode'] = "full";
        //$postData['Force_IPR_Buyer'] = "1";
        $postData['Landing_Page'] = "landing";
        $postData['IP_Address'] = "160.84.125.140";      
        $postData['First_Name'] = $data['first_name'];
        $postData['Last_Name'] = $data['last_name'];
        $postData['Phone'] = $data['phone']; 
        $postData['Address'] = $data['address'];  
        $postData['City'] = $data['city'];  
        $postData['State'] = $data['state'];  
        $postData['Zip'] = $data['zip_code'];  
        $postData['Phone'] = $data['phone'];    
        $result = $this->curl($postData,$url);
        $this->posting($postData,$data['clients'],$id,$result);
         
    }
     
    public function PSRPost($data,$id,$url){
        $postData = array();
        $postData['SRC'] = "PAK_Solar_Repair_EA";
        $postData['Key'] = "c6a4cb7949a5e8487fd1d71b592160385f2a41944298cbe006970f4f72847e40";
        $postData['API_Action'] = "pingPostLead";
        $postData['Average_Utility_Bill_2'] = "$151-200";
        $postData['Credit'] = "Good";
        $postData['Credit_2'] = "680-700";
        $postData['TYPE'] = "37";
        $postData['Mode'] = "full";
        $postData['Force_IPR_Buyer'] = "1";
        $postData['Landing_Page'] = "landing";
        $postData['IP_Address'] = "160.84.125.140";     
        $postData['First_Name'] = $data['first_name'];
        $postData['Last_Name'] = $data['last_name'];
        $postData['Phone'] = $data['phone']; 
        $postData['Address'] = $data['address'];  
        $postData['City'] = $data['city'];  
        $postData['State'] = $data['state'];  
        $postData['Zip'] = $data['zip_code'];  
        $postData['Phone'] = $data['phone'];  
               
        $result = $this->curl($postData,$url);
        $this->posting($postData,$data['clients'],$id,$result);       
         
    }
    public function solar_bmj($data,$id,$url){
        $postData = array();
        $postData['SRC'] = "PAK_Solar_BMJ";
        $postData['Key'] = "02ceff3124855a695b4810f3806a9b24586390c2ba976e4351c7b331149acf97";
        $postData['API_Action'] = "pingPostLead";
        $postData['Average_Utility_Bill_2'] = "$151-200";
        $postData['Credit'] = "Good";
        $postData['Credit_2'] = "680-700";
        $postData['TYPE'] = "107";
        $postData['Mode'] = "full";
        $postData['Force_IPR_Buyer'] = "1";
        $postData['Landing_Page'] = "landing";
        $postData['IP_Address'] = "160.84.125.140";     
        $postData['First_Name'] = $data['first_name'];
        $postData['Last_Name'] = $data['last_name'];
        $postData['Phone'] = $data['phone']; 
        $postData['Address'] = $data['address'];  
        $postData['City'] = $data['city'];  
        $postData['State'] = $data['state'];  
        $postData['Zip'] = $data['zip_code'];  
        $postData['Phone'] = $data['phone'];  
               
        $result = $this->curl($postData,$url);
        $this->posting($postData,$data['clients'],$id,$result);       
         
    }
    public function PSTPost($data,$id,$url){
        $postData = array();
        $postData['SRC'] = "PAK_Solar_Tech";
        $postData['Key'] = "02ceff3124855a695b4810f3806a9b24586390c2ba976e4351c7b331149acf97";
        $postData['API_Action'] = "pingPostLead";
        $postData['Average_Utility_Bill_2'] = "$151-200";
        $postData['Credit'] = "Good";
        $postData['Credit_2'] = "680-700";
        $postData['TYPE'] = "107";
        $postData['Mode'] = "full";
        //$postData['Force_IPR_Buyer'] = "1";
        $postData['Landing_Page'] = "landing";
        $postData['IP_Address'] = "160.84.125.140";     
        $postData['First_Name'] = $data['first_name'];
        $postData['Last_Name'] = $data['last_name'];
        $postData['Phone'] = $data['phone']; 
        $postData['Address'] = $data['address'];  
        $postData['City'] = $data['city'];  
        $postData['State'] = $data['state'];  
        $postData['Zip'] = $data['zip_code'];  
        $postData['Phone'] = $data['phone'];  
               
        $result = $this->curl($postData,$url);
        $this->posting($postData,$data['clients'],$id,$result);       
         
    }
    public function SRWPost($data,$id,$url){
        $postData = array();     
        $postData['firstname'] = $data['first_name'];
        $postData['lastname'] = $data['last_name'];
        $postData['email'] = $data['email']; 
        $postData['phone'] = $data['phone']; 
        $postData['Address'] = $data['address'];  
        $postData['city'] = $data['city'];  
        $postData['state'] = $data['state'];  
        $postData['zip'] = $data['zip_code'];   
        $postData['electricCompany'] = $data['electric_provider'];   
        $postData['avgsummerbill'] = $data['electric_bill_monthly'];   
        $postData['prjrooftype'] = $data['roof_shade'];   
        $postData['creditscore'] = $data['credit_score'];   
        $postData['creditscore'] = $data['credit_score'];   
               
        $result = $this->curl($postData,$url);
        $this->posting($postData,$data['clients'],$id,$result);       
         
    }
    public function SolarT($data,$id,$url){
        $postData = array();   
        $postData['lp_campaign_id'] = "6357e78394577";
        $postData['lp_campaign_key'] = "njmzFC9QMfcPv8y2pxqk";
        // $postData['lp_test']= "1";  
        $postData['first_name'] = $data['first_name'];
        $postData['lp_caller_id'] = $data['phone'];
        $postData['last_name'] = $data['last_name'];
        $postData['email_address'] = $data['email']; 
        $postData['phone_home'] = $data['phone']; 
        $postData['address'] = $data['address'];  
        $postData['city'] = $data['city'];  
        $postData['state'] = $data['state'];  
        $postData['zip_code'] = $data['zip_code'];      
        $postData['vendor_lead_id'] = $data['JornayaIDSolarT'];   
        $postData['creditscore'] = $data['credit_score'];   
               
        $result = $this->curl($postData,$url);
        $this->posting($postData,$data['clients'],$id,$result);       
         
    }
     


    public function curl($postData,$url){         
        // $url="https://api.leadmailbox.com/v2/leads/add/afb06/liveleados?".$queryString;
        $queryString = http_build_query($postData);    //url of 2nd website where data is to be send
        $url=$url."?".$queryString;  //url of 2nd website where data is to be send
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt ($ch, CURLOPT_POST, 1);
        curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Content-Type', 'application/json'));
        $result = curl_exec ($ch);
        curl_close($ch);
        return $result;
    }

    public function posting($postData,$product_id,$id,$result){
        $project = Project::with('client')->where('project_code',$product_id)->first();
        $cleintPost = new ClientPosting();
        $cleintPost->sale_id = $id;
        $cleintPost->client_id = $project->client->id;
        $cleintPost->post_data = json_encode($postData);
        $cleintPost->post_response = $result; 
        $cleintPost->save();
        return true;
    }   
}

?>