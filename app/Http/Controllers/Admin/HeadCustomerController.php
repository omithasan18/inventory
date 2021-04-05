<?php

namespace App\Http\Controllers\Admin;

use App\Head_customer;
use App\Http\Controllers\Controller;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use Image;
use Auth;

class HeadCustomerController extends Controller
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
        $datas = Head_customer::where(['status'=>1])->get();
        // if(Auth::user()->role_id==4){
        //     $datas=Head_customer::where(['location_id'=>Auth::user()->location_id,'user_type'=>Auth::user()->user_type,'status'=>1])->get();
        // }
        return view('admin.customer.head_customer.manage',compact('datas'));
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
            'name' => 'required',
        ]);
        $data = new Head_customer();
        if(Auth::user()->role_id==4){
            $data->location_id=Auth::user()->location_id;
            $data->user_type=Auth::user()->user_type;
        }
        $data->name=$request->name;
        $data->business_name=$request->business_name;
        $data->business_address=$request->business_address;
        $data->address=$request->business_address;
        $data->email=$request->email;
        $data->phone=$request->phone;
        if($request->hasFile('image')) {
            $image = $request->image;
            $filename = $image->getClientOriginalName();
            $filename = preg_replace('/\s+/', '-', $filename);
            $cat_img = 'uploads/head_customer/' . time() . '-' . $filename;
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
        $datas = Head_customer::all();
        $customer_by_id = Head_customer::where('id',$id)->first();
        // if(Auth::user()->role_id==4){
        //     $datas=Head_customer::where(['location_id'=>Auth::user()->location_id,'user_type'=>Auth::user()->user_type,'status'=>1])->get();
        // }
        return view('admin.customer.head_customer.edit', compact('datas','customer_by_id'));
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
        $data = Head_customer::find($id);
        $data->name=$request->name;
        $data->business_name=$request->business_name;
        $data->business_address=$request->business_address;
        $data->address=$request->business_address;
        $data->email=$request->email;
        $data->phone=$request->phone;
        if($request->hasFile('image')) {
            $image = $request->image;
            $filename = $image->getClientOriginalName();
            $filename = preg_replace('/\s+/', '-', $filename);
            $cat_img = 'uploads/head_customer/' . time() . '-' . $filename;
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
    public function active_head_customer($id){
        $data = Head_customer::find($id);
        $data->status = 1;
        $data->save();
        $notification=array(
            'message' => 'Successfully Activated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function inactive_head_customer($id){
        $data = Head_customer::find($id);
        $data->status = 0;
        $data->save();
        $notification=array(
            'message' => 'Successfully DeActivated',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }
    public function get_head_customer_information(Request $request){
        $head_customer = Head_customer::where('id',$request->id)->first();
        $id = $head_customer->id;
        $order = Order::where(['head_customer_id'=>$id,'order_status'=>2])->get();
        $orders = Order::where(['head_customer_id'=>$id,'order_status'=>2])->take('5')->get();
        $paid = Payment::where(['head_customer_id'=>$id])->get();
        $last_pay = Payment::where(['head_customer_id'=>$id])->latest()->first();
        return view('admin.customer.head_customer.view_model',compact('order','head_customer','orders','paid','last_pay'));
    }
    public function save_payment(Request $request){
       $data = new Payment();
       $data->head_customer_id = $request->head_customer_id;
       $data->pay_amount = $request->pay_amount;
       $data->payment_status = $request->payment_status;
       $data->check_number = $request->check_number;
       $data->check_date = $request->check_date;
       $data->save();
       $notification=array(
        'message' => 'Successfully Paid',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);
    }
}
