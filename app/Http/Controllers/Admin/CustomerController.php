<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Head_customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use Auth;

class CustomerController extends Controller
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
        $datas=Customer::where(['status'=>1,'user_type'=>'offline'])->get();
        // if(Auth::user()->role_id==4){
        //     $datas=Customer::where(['location_id'=>Auth::user()->location_id,'user_type'=>Auth::user()->user_type,'status'=>1])->get();
        // }
        return view('admin.customer.manage_customer',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_customer = Head_customer::where('status',1)->get();
        // if(Auth::user()->role_id==4){
        //     $parent_customer = Head_customer::where(['location_id'=>Auth::user()->location_id,'user_type'=>Auth::user()->user_type,'status'=>1])->get();
        // }
        return view('admin.customer.add_customer',compact('parent_customer'));
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
            'customer_name' => 'required',
        ]);
        $data = new Customer();
        if(Auth::user()->role_id==4){
            $data->location_id=Auth::user()->location_id;
            $data->user_type=Auth::user()->user_type;
        }
        $data->parent_id=$request->parent_id;
        $data->customer_name=$request->customer_name;
        $data->contact_code=$request->contact_code;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->address=$request->address;
        $data->status=$request->status;
        $data->user_type='offline';
        if($request->hasFile('image')) {
            $image = $request->image;
            $filename = $image->getClientOriginalName();
            $filename = preg_replace('/\s+/', '-', $filename);
            $cat_img = 'uploads/customer/' . time() . '-' . $filename;
            Image::make($image)->resize(300, 300)->save($cat_img);
            $data->image = $cat_img;
        }
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
        $parent_customer = Head_customer::where('status',1)->get();
        $customer_by_id = Customer::where('id',$id)->first();
        if(Auth::user()->role_id==4){
            $datas=Customer::where(['location_id'=>Auth::user()->location_id,'user_type'=>Auth::user()->user_type,'status'=>1])->get();
        }
        // if(Auth::user()->role_id==4){
        //     $parent_customer = Head_customer::where(['location_id'=>Auth::user()->location_id,'user_type'=>Auth::user()->user_type,'status'=>1])->get();
        // }
        return view('admin.customer.edit_customer',compact('customer_by_id','parent_customer'));
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
        $data = Customer::find($id);
        $data->parent_id=$request->parent_id;
        $data->customer_name=$request->customer_name;
        $data->contact_code=$request->contact_code;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->address=$request->address;
        $data->status=$request->status;
        if($request->hasFile('image')) {
            $image = $request->image;
            $filename = $image->getClientOriginalName();
            $filename = preg_replace('/\s+/', '-', $filename);
            $cat_img = 'uploads/customer/' . time() . '-' . $filename;
            Image::make($image)->resize(300, 300)->save($cat_img);
            $data->image = $cat_img;
        }
        $data->save();
        $notification=array(
            'message' => 'Successfully Done',
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
    public function active_customer($id){
        $data = Customer::find($id);
        $data->status = 1;
        $data->save();
        $notification=array(
            'message' => 'Successfully Activated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function inactive_customer($id){
        $data = Customer::find($id);
        $data->status = 0;
        $data->save();
        $notification=array(
            'message' => 'Successfully DeActivated',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }
    public function online_customer(){
        $datas=Customer::where(['status'=>1,'user_type'=>'online'])->get();
        // if(Auth::user()->role_id==4){
        //     $datas=Customer::where(['location_id'=>Auth::user()->location_id,'user_type'=>Auth::user()->user_type,'status'=>1])->get();
        // }
        return view('admin.customer.online_customer',compact('datas'));
    }
    
}
