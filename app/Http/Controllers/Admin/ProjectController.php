<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use App\Models\Campaign;

class ProjectController extends Controller
{
    public function __construct()
    {
        view()->share('site', (object) [
            'title' =>  "Projects"
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        
        $this->authorize('projects.index');
        $clients  = Client::all();    
        $projects = Project::with('client')->get();    
        $campaigns = Campaign::get(); 

        return view('admin.project.index', compact('clients','projects','campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $projects = $request->all();
        $projects = Project::create( $projects );
        return redirect()->route('projects.index')->with('success', "Project Create Successfuly");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::with('client')->where('id',$id)->first();
        $clients = \DB::table('clients')->get();
        return view('admin.project.edit', compact('project','clients'));
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
        \DB::table('projects')->where("id",$id)->update([
            'name'=>$request->name, 
            'hours'=>$request->hours,
            'seats'=>$request->seats, 
        ]); 
        return redirect()->route('projects.index')->with('success',"Project update Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
