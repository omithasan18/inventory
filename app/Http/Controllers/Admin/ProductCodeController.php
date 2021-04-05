<?php

namespace App\Http\Controllers\Admin;

use App\CustomerCode;
use App\Head_customer;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductCodeController extends Controller
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
        $code = CustomerCode::orderBy('id','desc')->get();
        $products = Product::orderBy('id','desc')->where('status',1)->get();
        $head_customers = Head_customer::orderBy('id','desc')->where('status',1)->get();
        return view('admin.product.code.create',compact('code','products','head_customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = CustomerCode::where(['product_id'=>$request->product_id,'head_customer_id'=>$request->head_customer_id])->count();
        
        if($data > 0)
        {
            $notification=array(
                'message' => 'All Ready Save For This Customer.',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }else{

        }
        $validatedData = $request->validate([
            'customer_product_code' => 'required',
        ]);
        $data = new CustomerCode();
        $data->product_id=$request->product_id;
        $data->head_customer_id=$request->head_customer_id;
        $data->customer_product_code=$request->customer_product_code;
        $data->gp=$request->gp;
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
        $code = CustomerCode::orderBy('id','desc')->get();
        $code_by_id = CustomerCode::where('id',$id)->first();
        $products = Product::orderBy('id','desc')->where('status',1)->get();
        $head_customers = Head_customer::orderBy('id','desc')->where('status',1)->get();
        return view('admin.product.code.edit',compact('code','products','head_customers','code_by_id'));
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
        $validatedData = $request->validate([
            'customer_product_code' => 'required',
        ]);
        $data = CustomerCode::find($id);
        $data->product_id=$request->product_id;
        $data->head_customer_id=$request->head_customer_id;
        $data->customer_product_code=$request->customer_product_code;
        $data->gp=$request->gp;
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
}
