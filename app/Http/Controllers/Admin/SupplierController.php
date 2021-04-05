<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Suplier;
use App\SupplierPayment;
use App\SupplierPaymentHistory;
use Illuminate\Http\Request;
use Image;

class SupplierController extends Controller
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
        $datas=Suplier::get();
        return view('admin.supplier.manage_supplier',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.add_supplier');
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
            'supplier_name' => 'required',
            'business_name' => 'required',
            'pi_number' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        $data = new Suplier();
        $data->supplier_name=$request->supplier_name;
        $data->business_name=$request->business_name;
        $data->pi_number=$request->pi_number;
        $data->contact_code=$request->contact_code;
        $data->phone=$request->phone;
        $data->email=$request->email;
        $data->city=$request->city;
        $data->state=$request->state;
        $data->country=$request->country;
        $data->status=$request->status;
        if($request->hasFile('image')) {
            $image = $request->image;
            $filename = $image->getClientOriginalName();
            $filename = preg_replace('/\s+/', '-', $filename);
            $cat_img = 'uploads/supplier_img/' . time() . '-' . $filename;
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
        
        $supplier_by_id = Suplier::where('id',$id)->first();
        return view('admin.supplier.edit_supplier',compact('supplier_by_id'));
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
        $data = Suplier::find($id);
        $data->supplier_name=$request->supplier_name;
        $data->business_name=$request->business_name;
        $data->pi_number=$request->pi_number;
        $data->contact_code=$request->contact_code;
        $data->phone=$request->phone;
        $data->email=$request->email;
        $data->city=$request->city;
        $data->state=$request->state;
        $data->country=$request->country;
        $data->status=$request->status;
        if($request->hasFile('image')) {
            $image = $request->image;
            $filename = $image->getClientOriginalName();
            $filename = preg_replace('/\s+/', '-', $filename);
            $cat_img = 'uploads/supplier_img/' . time() . '-' . $filename;
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
    public function active_supplier($id){
        $data = Suplier::find($id);
        $data->status = 1;
        $data->save();
        $notification=array(
            'message' => 'Successfully Activated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function inactive_supplier($id){
        $data = Suplier::find($id);
        $data->status = 0;
        $data->save();
        $notification=array(
            'message' => 'Successfully DeActivated',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }
    public function get_supplier_information(Request $request){
        $supplier = Suplier::where('id',$request->id)->first();
        $id = $supplier->id;
        $paid = SupplierPayment::where(['supplier_id'=>$id])->get();
        $last_pay = SupplierPaymentHistory::where(['supplier_id'=>$id])->latest()->first();
        $pay_amount = SupplierPaymentHistory::where(['supplier_id'=>$id])->get();
        // $order = Order::where(['head_customer_id'=>$id,'order_status'=>2])->get();
        return view('admin.supplier.view_model',compact('supplier','paid','last_pay','pay_amount'));
    }

    public function save_supplier_payment(Request $request){
        $data = new SupplierPaymentHistory();
        $data->supplier_id=$request->supplier_id;
        $data->pay_amount=$request->pay_amount;
        $data->due=$request->due;
        $data->date=$request->date;
        $data->payment_method=$request->payment_method;
        $data->save();
        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
