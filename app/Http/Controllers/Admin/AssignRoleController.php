<?php

namespace App\Http\Controllers\Admin;

use App\AssignRole;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use Auth;

class AssignRoleController extends Controller
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
        $roles = AssignRole::get();
        return view('admin.assign_role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('status',1)->get();
        return view('admin.assign_role.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = AssignRole::where('role_id', $request->role_id)->count();
        if($data > 0)
        {
            $notification=array(
                'message' => 'Role Already Exist',
                'alert-type' => 'error'
            );
        }else {
            $data = new AssignRole();
            $data->user_id = Auth::user()->id;
            $data->role_id = $request->role_id;
            $data->category = $request->category;
            $data->view_category = $request->view_category;
            $data->add_category = $request->add_category;
            $data->edit_category = $request->edit_category;
            $data->delete_category = $request->delete_category;
            $data->brand = $request->brand;
            $data->view_brand = $request->view_brand;
            $data->add_brand = $request->add_brand;
            $data->edit_brand = $request->edit_brand;
            $data->delete_brand = $request->delete_brand;
            $data->product = $request->product;
            $data->view_product = $request->view_product;
            $data->add_product = $request->add_product;
            $data->edit_product = $request->edit_product;
            $data->delete_product = $request->delete_product;
            $data->user = $request->user;
            $data->view_user = $request->view_user;
            $data->add_user = $request->add_user;
            $data->edit_user = $request->edit_user;
            $data->delete_user = $request->delete_user;
            $data->customer = $request->customer;
            $data->view_customer = $request->view_customer;
            $data->edit_customer = $request->edit_customer;
            $data->delete_customer = $request->delete_customer;
            $data->supplier = $request->supplier;
            $data->view_supplier = $request->view_supplier;
            $data->add_supplier = $request->add_supplier;
            $data->edit_supplier = $request->edit_supplier;
            $data->delete_supplier = $request->delete_supplier;
            $data->pos = $request->pos;
            $data->view_pos = $request->view_pos;
            $data->add_pos = $request->add_pos;
            $data->setting = $request->setting;
            $data->view_setting = $request->view_setting;
            $data->add_setting = $request->add_setting;
            $data->edit_setting = $request->edit_setting;
            $data->delete_setting = $request->delete_setting;
            $data->wearhouse = $request->wearhouse;
            $data->view_wearhouse = $request->view_wearhouse;
            $data->add_transfer = $request->add_transfer;
            $data->distributed_transfer = $request->distributed_transfer;
            $data->save();
            $notification = array(
                'message' => 'Successfully Done',
                'alert-type' => 'success'
            );
        }
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
        $assign_role = AssignRole::where('id',$id)->first();
        $roles = Role::where('status',1)->get();
        return view('admin.assign_role.edit',compact('roles','assign_role'));
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
        $data = AssignRole::find($id);
        $data->user_id = Auth::user()->id;
            $data->role_id = $request->role_id;
            $data->category = $request->category;
            $data->view_category = $request->view_category;
            $data->add_category = $request->add_category;
            $data->edit_category = $request->edit_category;
            $data->delete_category = $request->delete_category;
            $data->brand = $request->brand;
            $data->view_brand = $request->view_brand;
            $data->add_brand = $request->add_brand;
            $data->edit_brand = $request->edit_brand;
            $data->delete_brand = $request->delete_brand;
            $data->product = $request->product;
            $data->view_product = $request->view_product;
            $data->add_product = $request->add_product;
            $data->edit_product = $request->edit_product;
            $data->delete_product = $request->delete_product;
            $data->user = $request->user;
            $data->view_user = $request->view_user;
            $data->add_user = $request->add_user;
            $data->edit_user = $request->edit_user;
            $data->delete_user = $request->delete_user;
            $data->customer = $request->customer;
            $data->view_customer = $request->view_customer;
            $data->edit_customer = $request->edit_customer;
            $data->delete_customer = $request->delete_customer;
            $data->supplier = $request->supplier;
            $data->view_supplier = $request->view_supplier;
            $data->add_supplier = $request->add_supplier;
            $data->edit_supplier = $request->edit_supplier;
            $data->delete_supplier = $request->delete_supplier;
            $data->pos = $request->pos;
            $data->view_pos = $request->view_pos;
            $data->add_pos = $request->add_pos;
            $data->setting = $request->setting;
            $data->view_setting = $request->view_setting;
            $data->add_setting = $request->add_setting;
            $data->edit_setting = $request->edit_setting;
            $data->delete_setting = $request->delete_setting;
            $data->wearhouse = $request->wearhouse;
            $data->view_wearhouse = $request->view_wearhouse;
            $data->add_transfer = $request->add_transfer;
            $data->distributed_transfer = $request->distributed_transfer;
            $data->save();
            $notification = array(
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
}
