<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EddyExport;
use App\Imports\EddyImport;
use App\Models\EddySale;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class EddyController extends Controller
{
    public function importForm(Request $request)
    {
        // return $request; 
        $eddy = new EddySale(); 
        if ($request->agent_id)
            $eddy = $eddy->where('agent_id', $request->agent_id);
        if ($request->f_date)
            $eddy = $eddy->whereDate('sale_date',">=", $request->f_date);
        if ($request->t_date)
            $eddy = $eddy->whereDate('sale_date',"<=", $request->t_date);
        if ($request->type)
            $eddy = $eddy->where('type', $request->type); 
            
        $eddy = $eddy->with('user')->orderBy('id', "DESC")->Paginate(50);
        
        
        return view('admin.eddy-sales.import-form', compact('eddy'));
    }
    public function import(Request $request)
    {
        // return $request->type;
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        Excel::import(new EddyImport(), request()->file('file'), $request->type);
        Session::flash('success', 'File Uploaded successfully!');
        return back();
    }
    public function exportEddyReport(Request $request)
    {
        $now = now();
        return Excel::download(new EddyExport($request), "Eddy-Sales-Report-{$now->toString()}.xlsx");
    }
    public function eddyusers(){
        $users = DB::table('eddy_users')->where('status',1)->get();
        return view('admin.eddy-sales.index', compact('users'));
    }
    public function eddyuserCreate(Request $request){ 
        
        $project_code='';
        if($request->submit){
            if($request->type == "InBound"){
                $project_code ="PRO0146";
            }elseif($request->type == "OutBound"){
                $project_code ="PRO0147";
            }
            elseif($request->type == "EddyEdu"){
                $project_code ="PRO0145";
            }
            
            DB::table('eddy_users')->insert([
                'name' =>$request->name,
                'psedo_name' =>$request->psedo_name,
                'agent_name' =>$request->agent_name,
                'HRMSID' =>$request->HRMSID,
                'type' =>$request->type,
                'project_code' =>$project_code,
            ]);

            return redirect('admin/eddyusers')->with('success',"User Create Successfully");
        }
        return view('admin.eddy-sales.create');
    }

    public function eddyuserDelete(Request $request , $id) {
        DB::table('eddy_users')->where('id',$id)->update(['status' => 0]);
        return redirect('admin/eddyusers')->with('success',"User Delete Successfully");
    }
}
