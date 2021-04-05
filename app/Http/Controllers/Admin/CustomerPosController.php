<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CustomerPosController extends Controller
{
    public function customer_pos_product(){
        $customer = Customer::where(['status'=>1,'user_type'=>'online'])->get();
        $products = DB::table('distributed_products')
            ->join('products', 'distributed_products.product_id', '=', 'products.id')
            ->join('colors', 'distributed_products.color_id', '=', 'colors.id')
            ->select('distributed_products.*', 'products.title','products.product_code','products.selling_price','products.status','colors.color_name')
            ->where('products.status',1)
            ->get();
        return view('admin.pos.customer_pos_product',compact('products','customer'));
    }
    public function save_customer_pos_product(Request $request){
        $data = new Customer();
        $data->customer_name=$request->customer_name;
        $data->contact_code=$request->contact_code;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->address=$request->address;
        $data->user_type='online';
        $data->save();
        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        // return ['success'=>true,'message'=>'data inserted'];
    }
}
