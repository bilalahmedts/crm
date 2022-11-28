<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        view()->share('site', (object) [
            'title' =>  __('labels.users')
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('users.index');
        $users  =   User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('users.create');
        $roles = Role::where('id',">",1)->get();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->authorize('users.create');
        
        $data   =   $request->except('role');
        $data['password']   =   Hash::make($request->get('password'));
		$user['image'] = 'default.jpg';
        $user = User::create($data);

        $user->syncRoles([$request->role]);

        $file_name = uniqid().'.jpg';
        if($request->hasFile('image')){

            $request->file('image')->storeAs('user', $file_name, 'uploads');

            $user->image = $file_name;
            $user->update();

        }else{

            //Storage::disk('uploads')->copy('user/default.jpg', 'user/'.$file_name);

            //$user->image = 'default.jpg';
            //$user->update();
        }


        return redirect()->route('users.index')->with('success', __('messages.user_created'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $id)
    {
        $this->authorize('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('users.edit');

        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('users.edit');

        $data = $request->only(['name', 'email']);

        if(!empty($request->get('password'))){
            $data['password']   =   Hash::make($request->get('password'));
        }
		if(!empty($request->get('reporting_to_id'))){
			$data['reporting_to_id'] = $request->get('reporting_to_id');
		}
        if($request->hasFile('image')){
            $file_name = uniqid().'.png';
            
            if($user->image!='default.png')
                Storage::disk('uploads')->delete( 'user/'.$user->image );
            
            $request->file('image')->storeAs('user', $file_name, 'uploads');
            $data['image'] = $file_name;
        }
        
        $user->update($data);
        $user->removeRole( $user->getRoleNames()[0] );
        $user->assignRole($request->role);


        return redirect()->route('users.index')->with('success', __('messages.user_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('users.delete');
        $user->delete();
        return redirect()->route('users.index')->with('success', __('messages.user_deleted'));
    }
}
