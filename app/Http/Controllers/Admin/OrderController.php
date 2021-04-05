<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\CustomerCode;
use App\DistributedProduct;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetails;
use DB;
use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller
{
    public function manage_order(){
        $orders = Order::OrderBy('id','desc')->where('order_status','!=',6)->get();
        if(Auth::user()->role_id==4){
            $orders = Order::OrderBy('id','desc')->where('seller_id',Auth::user()->id)->get();
        }
        return view('admin.pos.order.order',compact('orders'));
    }
    public function edit_order($id){
        $order = Order::where('id',$id)->first();
        // $word = NumConverter
        $customer = Customer::where('id',$order->customer_id)->first();
        $data = CustomerCode::where(['head_customer_id'=>$order->head_customer_id])->count();

        if($data > 0)
        {
            $content = OrderDetails::where('order_id',$id)->select('product_id','customer_code','gp')->distinct()->get('product_id');
            // dd($product);
            foreach($content as $value){
                $balance = OrderDetails::where(['order_id'=>$id,'product_id'=> $value->product_id])->sum('quantity');
                // $pcus_code = CustomerCode::where(['head_customer_id'=>$order->head_customer_id,'product_id'=> $value->product_id])->get();
                // dd($pcus_code);

            }
            // dd($content);
        }else{
            // $content = DB::table('order_details')
            // ->join('orders', 'order_details.order_id', '=', 'orders.id')
            // ->join('products', 'order_details.product_id', '=', 'products.id')
            // // ->join('customer_codes', 'order_details.product_id', '=', 'customer_codes.product_id')
            // ->select('order_details.*','products.title','products.product_code')
            // ->where(['order_details.order_id'=>$id])
            // ->get();
            $content = OrderDetails::where('order_id',$id)->select('product_id','customer_code','gp')->distinct()->get('product_id');
            foreach($content as $value){
                $balance = OrderDetails::where(['order_id'=>$id,'product_id'=> $value->product_id])->sum('quantity');

            }
        }
        return view('admin.pos.order.edit',compact('content','customer','order','balance'));
    }
    public function final_order(Request $request){
        $data = Order::find($request->order_id);
        $data->order_status = $request->order_status;
        $data->save();
        $order_details= OrderDetails::where('order_id',$request->order_id)->get();
        foreach($order_details as $key=> $value){
            $product_id=$value->product_id;
            $product_sales_qty=$value->quantity;
            if($request->order_status==2){
                $product=DistributedProduct::where('product_id',$product_id)->first();
                $productById= DistributedProduct::where('product_id',$product_id)->first();
                $gty = $productById->available_quantity;
                $avail_qty = ($gty-$product_sales_qty);
                $product ->available_quantity =$avail_qty;
                $sale = $productById->total_sale;
                $total = $sale+$product_sales_qty;
                $product->total_sale = $total;
                $product->save();
            }
         }
        $notification=array(
           'message' => 'Successfully Done',
           'alert-type' => 'success'
       );
       return redirect()->back()->with($notification);
    }
    public function delete_order($id){
        $details = OrderDetails::where('order_id',$id)->delete();
        $data = Order::where('id',$id)->first();
        $data->delete();
        $notification=array(
            'message' => 'Successfully Delete',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
