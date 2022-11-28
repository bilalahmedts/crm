<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\SaleDss;
use App\Models\RecordDss;
use App\Export\UserExport;
use App\Exports\DSSExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


class DssController extends Controller
{

    public function __construct()
    {
        view()->share('site', (object) [
            'title' =>  "DSS"
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $query = new SaleDss;
        if ($request->has('start_date')) {
            if (!empty($request->start_date) && !empty($request->end_date)) {
                $query = $query->whereDate('created_at', '>=', $request->start_date);
                $query = $query->whereDate('created_at', '<=', $request->end_date);
            } elseif (!empty($request->start_date)) {
                $query = $query->whereDate('created_at', $request->start_date);
            }
            $dsses = $query->paginate(10);

        }

        if ($request->has('phone')) {
            if (!empty($request->phone)) {
                $query = $query->where('phone', 'LIKE', "%{$request->phone}%");
            }
            $dsses = $query->paginate(10);
        }


        $dsses = $query->with('user')->latest()->get();
        return view('admin.dss.index',compact('dsses'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.dss.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'first_name'=>"required",
            //'last_name'=>"required",
            'phone'=>"required",

        ]);


        $input = $request->all();
        //  $Question_1 = isset($_POST['Question_1']) && is_array($_POST['Question_1']) ? $_POST['Question_1'] : [];
        //  $vpn1 =implode(',', $Question_1);

         $input['question_1'] = (@$request->input('question_1')) ? implode(",",@$request->input('question_1')) :"";
         $input['question_2'] = (@$request->input('question_2')) ? implode(",",@$request->input('question_2')) :"";
         SaleDss::create($input);
         Session::flash('success', 'Record Added Successfylly!');
        return redirect()->route('dss.index')->with('Sucees');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SaleDss $dss)
    {
        //

        return view('admin.dss.show',compact('dss'));
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
    public function destroy(SaleDss $dsses)
    {
        //
        $dsses->delete();
        Session::flash('success', 'Record deleted successfully!');
        return redirect()->back();
    }
    public function get_record_id($id)
    {

       $records=RecordDss::findOrFail($id);
       $data = [
        'first_name'=>$records->first_name,
        'last_name'=>$records->last_name,
        'id'=>$records->id,
        'address'=>$records->address,
        'city'=>$records->city,
        'state'=>$records->state,
        'zipcode'=>$records->zipcode,
         'phone'=>$records->phone,
         'email'=>$records->email,
        'customer_no'=>$records->customer_no,
        'area'=>$records->area,
        'customer_name'=>$records->customer_name,

        // 'client_id'=>$records->client_id,
        // 'campaign_id'=>$records->campaign_id,
       ];

       return response()->json(['data'=> $data]);
    }


    public function linechart(Request $request)
    {

        $data = array();
        if(@$request->Today){
            $date1 = Carbon::today();
            $date2 = Carbon::today();
        }elseif(@$request->LastWeek){
            $date1 = Carbon::today()->subDays(7);
            $date2 = Carbon::today();

        }elseif(@$request->lastMonth){
            $date1 = Carbon::today()->subDays(30);
            $date2 = Carbon::today();

        }else{
            $date1 = Carbon::today()->subDays(1000);
            $date2 = Carbon::today();
        }


         $amazon = SaleDss::where('question_1' ,'LIKE' , '%Amazon%')->WhereDate('created_at',">=",$date1)->WhereDate('created_at',"<=",$date2)->get();
         $beckers = SaleDss::where('question_1','LIKE' ,'%Beckers%')->WhereDate('created_at',">=",$date1)->WhereDate('created_at',"<=",$date2)->get();
         $lackshore = SaleDss::where('question_1','LIKE' ,'%Lackshore%')->WhereDate('created_at',">=",$date1)->WhereDate('created_at',"<=",$date2)->get();
         $kaplan = SaleDss::where('question_1','LIKE' ,'%Kaplan%')->WhereDate('created_at',">=",$date1)->WhereDate('created_at',"<=",$date2)->get();
         $discount_school_supply = SaleDss::where('question_1','LIKE' ,'%Discountschoolsupply%')->WhereDate('created_at',">=",$date1)->WhereDate('created_at',"<=",$date2)->get();
         $school_speciality = SaleDss::where('question_1','LIKE' ,'%Schoolspeciality%')->WhereDate('created_at',">=",$date1)->WhereDate('created_at',"<=",$date2)->get();
         $oriental_trading = SaleDss::where('question_1','LIKE' ,'%OrientalTrading%')->WhereDate('created_at',">=",$date1)->WhereDate('created_at',"<=",$date2)->get();
         $use_multiple_vendor = SaleDss::where('question_1','LIKE' ,'%UsemultipleVendor%')->WhereDate('created_at',">=",$date1)->WhereDate('created_at',"<=",$date2)->get();
         $others_question_1 = SaleDss::select('others_question_1')->where('others_question_1','!=','NULL') ->WhereDate('created_at',">=",$date1)->WhereDate('created_at',"<=",$date2)->get();



         $amazon_count = count($amazon);
    	 $becker_count = count($beckers);
    	 $lackshore_count = count($lackshore);
         $kaplan_count = count($kaplan);
    	 $discount_school_supply_count = count($discount_school_supply);
         $oriental_trading_count = count($oriental_trading);
    	 $use_multiple_vendor_count = count($use_multiple_vendor);
         $others_question_1_count = count($others_question_1);

         $pricing = SaleDss::where('question_2','LIKE' ,'%Pricing%')->WhereDate('created_at',">=",$date1)->WhereDate('created_at',"<=",$date2)->get();
         $lack_of_products = SaleDss::where('question_2','LIKE' ,'%Lackofproducts%')->WhereDate('created_at',">=",$date1)->WhereDate('created_at',"<=",$date2)->get();
         $fast_shipping = SaleDss::where('question_2','LIKE' ,'%FastShipping%')->WhereDate('created_at',">=",$date1)->WhereDate('created_at',"<=",$date2)->get();
         $free_shipping = SaleDss::where('question_2','LIKE' ,'%FreeShipping%')->WhereDate('created_at',">=",$date1)->WhereDate('created_at',"<=",$date2)->get();
         $quality = SaleDss::where('question_2','LIKE'  ,'%Quality%')->WhereDate('created_at',">=",$date1)->WhereDate('created_at',"<=",$date2)->get();
         $customer_service = SaleDss::where('question_2','LIKE'  ,'%CustomerService%')->WhereDate('created_at',">=",$date1)->WhereDate('created_at',"<=",$date2)->get();
         $happy_with_dss = SaleDss::where('question_2','LIKE'  ,'%HappywithDss%')->WhereDate('created_at',">=",$date1)->WhereDate('created_at',"<=",$date2)->get();
         $others_question_2 = SaleDss::select('others_question_2')->where('others_question_2','!=','NULL') ->WhereDate('created_at',">=",$date1)->WhereDate('created_at',"<=",$date2)->get();

         $pricing_count = count($pricing);
    	 $lack_of_products_count = count($lack_of_products);
    	 $fast_shipping_count = count($fast_shipping);
         $free_shipping_count = count($free_shipping);
    	 $quality_count = count($quality);
    	 $school_speciality_count = count($school_speciality);
         $customer_service_count = count($customer_service);
    	 $happy_with_dss_count = count($happy_with_dss);
      	 $others_question_2_count = count($others_question_2);

         return view('admin.dss.product-chart',compact('amazon_count'
         ,'becker_count'
         ,'lackshore_count'
         ,'kaplan_count'
         ,'discount_school_supply_count'
         ,'school_speciality_count'
         ,'oriental_trading_count'
         ,'use_multiple_vendor_count'
         ,'pricing_count'
         ,'lack_of_products_count'
         ,'free_shipping_count'
         ,'fast_shipping_count'
         ,'quality_count'
         ,'school_speciality_count'
         ,'customer_service_count'
         ,'happy_with_dss_count'
         ,'others_question_2_count'
         ,'others_question_1_count'));
    }
    public function exportDSSSalesReport(Request $request)
    {
        $now = now();
        return Excel::download(new DSSExport($request), "DSS-Sales-Report-{$now->toString()}.xlsx");
    }
}
