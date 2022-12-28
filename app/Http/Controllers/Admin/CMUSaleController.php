<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CMUSaleImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Models\CMUSale;

class CMUSaleController extends Controller
{
    public function importForm()
    {
        $sales = CMUSale::with('user','project')->paginate(100);
        return view('admin.cmu-sales.import-form',compact('sales'));
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
        Excel::import(new CMUSaleImport(), request()->file('file'));
        Session::flash('success', 'File Uploaded successfully!');
        return back();
    }
    public function delete($id)
    {        
        $this->authorize('campaign.delete');
        CMUSale::where('id',$id)->delete(); 
        return redirect()->back()->with('success', "Delete Successfully");
    }
}
