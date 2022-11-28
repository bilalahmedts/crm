<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CMUSaleImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class CMUSaleController extends Controller
{
    public function importForm()
    {
        return view('admin.cmu-sales.import-form');
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
}
