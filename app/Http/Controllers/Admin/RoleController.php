<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Role::get();
        return view('admin.role.manage_role',compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role_name' => 'required',
        ]);
        $data = new Role();
        $data->role_name=$request->role_name;
        $data->status=$request->status;
        $data->save();
        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
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
        $datas = Role::get();
        $role_by_id = Role::where('id',$id)->first();
        return view('admin.role.edit_role',compact('role_by_id','datas'));
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
        $data = Role::find($id);
        $data->role_name=$request->role_name;
        $data->status=$request->status;
        $data->save();
        $notification=array(
            'message' => 'Successfully Updated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
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
    public function active_role($id){
        $data = Role::find($id);
        $data->status = 1;
        $data->save();
        $notification=array(
            'message' => 'Successfully Activated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function inactive_role($id){
        $data = Role::find($id);
        $data->status = 0;
        $data->save();
        $notification=array(
            'message' => 'Successfully DeActivated',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }
}
