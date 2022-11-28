<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\Department;
use App\Models\Priority;
use App\User;use DB;
use App\Models\Customer;
use App\Models\SaleRecord;
use App\Models\SaleDss;
use App\Models\SaleMortgage;
use App\Models\HomeWarranty;
use App\Models\CannedMessage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        view()->share('site', (object) [
            'title' =>  __('labels.dashboard')
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return !auth()->user()->hasRole('Super Admin') ? $this->agentDashboard() : $this->adminDashboard();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function adminDashboard()
    {

        $latest_tickets = Ticket::latest()->limit(5)->get();
        $pieChart['solar']=SaleRecord::count();
        $pieChart['mortgage']=SaleMortgage::count();
        $pieChart['homewarranty']=HomeWarranty::count();
        $pieChart['dss']=SaleDss::count();
        $dates=''; $lastSevenDaysData=array();
        for($i=89;$i<=95;$i++){ 
           $data['date']=date('Y-m-d', strtotime("-$i days"));
           $data['solar_count']    = SaleRecord::whereDate("created_at","=",date('Y-m-d', strtotime("-$i days"))) ->count();
           $data['mortgage_count'] = SaleMortgage::whereDate("created_at","=",date('Y-m-d', strtotime("-$i days")))->count();
           $data['warranty_count'] = HomeWarranty::whereDate("created_at","=",date('Y-m-d', strtotime("-$i days")))->count();
           $data['dss_count'] = SaleDss::whereDate("created_at","=",date('Y-m-d', strtotime("-$i days")))->count();
           array_push($lastSevenDaysData,$data);
        }
        //  return $lastSevenDaysData;

        return view('admin.dashboard', compact('latest_tickets','pieChart','lastSevenDaysData'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function agentDashboard()
    {

        $latest_tickets = Ticket::where('user_id', auth()->user()->id)->latest()->limit(5)->get();
        
        $open_tickets = Ticket::where('user_id', auth()->user()->id)->where('status', 'open')->count();
        $total_tickets = Ticket::where('user_id', auth()->user()->id)->count();
        
        $unreplied_tickets = Ticket::where('user_id', auth()->user()->id)->where('status_reply', 'client_reply')->where('status', 'open')->count();

        return view('admin.agent_dashboard', compact('latest_tickets', 'open_tickets', 'total_tickets', 'unreplied_tickets'));
    }
}
