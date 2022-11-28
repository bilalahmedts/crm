<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Solar;
use Mail;
use App\Traits\SolarPosting;
use App\Models\SaleRecord;
use App\Models\Project;
use DB;
use App\User;
use App\Http\Requests\SolarRequest;
use App\Exports\ExportSolar;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Client;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class SolarController extends Controller
{

    use Solar, SolarPosting;
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
        $raw_result = DB::select(DB::raw("SELECT * FROM model_has_roles WHERE model_id = '$user->id'"));
        $roleid = $raw_result[0]->role_id;

        if (!in_array($roleid, array(14, 15, 1, 18, 3))) {
            return redirect()->route('solar.create')->with('error', "Access Denied");
        }

        if ($request->export) {
            return Excel::download(new ExportSolar(@$request->start_date, @$request->end_date, @$request->search, @$request->client_id, Auth::user()->hasRole('SolarClient'), Auth::user()->id), 'ExportSolar.xlsx');
        }
        $states = DB::table("electric_provider")->get();
        $clients = Client::where('campaign_id', 2)->get();
        $projects = Project::whereIn('client_id', $clients->pluck('id'))->get();
        $this->authorize('solars.index');
        $search = @$request->search;
        $start_date = @$request->start_date;
        $end_date = @$request->end_date;

        if (Auth::user()->hasRole('SolarClient')) {
            $project_codes = User::with('projects')->where('id', Auth::user()->id)->get()->pluck('projects')->flatten()->pluck('project_code');
            $solars  =   SaleRecord::with('user', 'client')->where('campaign_id', "2")->whereIn('project_code', $project_codes);
        } else {
            $solars  =   SaleRecord::with('user', 'client')->where('campaign_id', "2");
        }
        $solars = $solars->search($request->search, @$request->start_date, @$request->end_date, @$request->client_id, @$request->project_id)
            ->orderby('id', 'DESC')->paginate(8);
        return view('admin.solar.index', compact('solars', 'clients', 'projects', 'states'));
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
        $clients = Client::where('campaign_id', 2)->pluck('id');
        $projects = Project::whereIn('client_id', $clients)->get();
        return view('admin.solar.create', compact('clients', 'projects', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SolarRequest $request)
    {
        DB::connection('mysql')->beginTransaction();
        try {
            $check = DB::table('sale_records')->where('phone', $request->phone)
                ->whereDate('created_at', ">=", date('Y-m-d', strtotime('-90 days')))->first();
            $checkOld = DB::table('phone_numbers')->where('phone', $request->phone)->first();
            if ($check || $checkOld) {
                return redirect()->back()->with('error', 'Phone no already used');
            }
            $data = $request->all();
            $res = $this->InsertSaleRecord($data);
            //$this->send_mial($res,"solar@excelcg.com");
            $res = $this->postingUrl($request->clients, $data, $res);
            DB::commit();

            return redirect()->route('solars.create')->with('success', "Post Successfully");
        } catch (\Exception $e) {
            DB::connection('mysql')->rollback();
            return redirect()->route('solars.create')->with('error', $e->getMessage());
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
        $data = SaleRecord::where('id', $id)->first();
        return view('admin.solar.view', compact('data'));
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
        SaleRecord::where('id', $id)->delete();
        return redirect()->back()->with("success", "Disabled successfully");
    }
}
