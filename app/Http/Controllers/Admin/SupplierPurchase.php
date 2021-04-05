<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Suplier;
use App\SupplierPayment;
use App\SupplierPaymentHistory;
use Illuminate\Http\Request;

class SupplierPurchase extends Controller
{
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
        $supplier = Suplier::where('status',1)->get();
        $supplier_pay = SupplierPayment::orderBy('id','desc')->get();
        return view('admin.supplier.supplier_purchase',compact('supplier','supplier_pay'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new SupplierPayment();
        $data->supplier_id=$request->supplier_id;
        $data->pi_number=$request->pi_number;
        $data->total=$request->total;
        $data->pay_amount=$request->pay_amount;
        $data->due=$request->due;
        $data->date=$request->date;
        $data->payment_method=$request->payment_method;
        $data->save();
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
        //
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
        //
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
