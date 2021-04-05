<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\CustomerCode;
use App\DistributedProduct;
use App\Head_customer;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetails;
use Illuminate\Http\Request;
use DB;
use Cart;
use Auth;
use Session;

class PosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function pos_product(){
        $customer = Customer::where(['user_type'=>'offline','status'=>1])->get();
        $products = DB::table('distributed_products')
            ->join('products', 'distributed_products.product_id', '=', 'products.id')
            ->join('colors', 'distributed_products.color_id', '=', 'colors.id')
            ->select('distributed_products.*', 'products.title','products.product_code','products.selling_price','products.status','colors.color_name')
            ->where('products.status',1)
            ->get();
            // if(Auth::user()->role_id==4){
            //     $products = DB::table('distributed_products')
            //     ->join('products', 'distributed_products.product_id', '=', 'products.id')
            //     ->select('distributed_products.*', 'products.title','products.product_code','products.selling_price','products.supplier_code','products.status')
            //     ->where(['distributed_id'=>Auth::user()->id,'products.status'=>1])
            //     ->get();
            // }
        return view('admin.pos.pos_product',compact('products','customer'));
    }
    public function create_sale(Request $request){
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'discount' => 'required',
        ],
        [
            'customer_id.required' => 'Select A customer First !!'
        ]
    );
    $request->session()->put('discount_type', $request->discount_type);
    $request->session()->put('discount', $request->discount);
    $request->session()->put('pio_number', $request->pio_number);
    $request->session()->put('pio_date', $request->pio_date);
    $request->session()->put('delivery_date', $request->delivery_date);
    $request->session()->put('shipping', $request->shipping);
    $customer = Customer::where('id',$request->customer_id)->first();
    $content = Cart::getContent();
    // dd($content);
    $head_customer_id = $customer->parent_id;
    // dd($head_customer_id);
       $head_customer = Head_customer::where('id',$head_customer_id)->first();
       $data = new Order();
       $data->customer_id = $request->customer_id;
       $data->head_customer_id = $head_customer->id;
       $data->seller_id =Auth::user()->id;
       $data->save();

       $request->session()->put('order_id', $data->id);
    $content = Cart::getContent();
    foreach($content as $item){
        $order_details = new OrderDetails();
        $product = CustomerCode::where(['head_customer_id'=>$head_customer_id,'product_id'=>$item->attributes->product_id])->first();
        if($product){
            $product = CustomerCode::where(['head_customer_id'=>$head_customer_id,'product_id'=>$item->attributes->product_id])->first();
            $order_details->customer_code = $product->customer_product_code;
            $order_details->gp = $product->gp;
        }
        $order_details->order_id = $data->id;
        $order_details->product_id = $item->attributes->product_id;
        $order_details->color_id = $item->attributes->color_id;
        $order_details->quantity = $item->quantity;
        $order_details->unit_cost = $item->price;
        $order_details->total = $item->price*$item->quantity;
        $order_details->save();
       }

       $id = Session::get('order_id');
       $order = Order::where('id',$id)->first();
        $customer = Customer::where('id',$order->customer_id)->first();
        $product = CustomerCode::where(['head_customer_id'=>$order->head_customer_id])->count();
        $balance = 0;
        if($product > 0)
        {
        // $product = DB::table('order_details')
        //     ->join('orders', 'order_details.order_id', '=', 'orders.id')
        //     ->join('products', 'order_details.product_id', '=', 'products.id')
        //     ->join('customer_codes', 'order_details.product_id', '=', 'customer_codes.product_id')
        //     ->select('order_details.*','products.title','products.product_code','customer_codes.customer_product_code','customer_codes.product_id','customer_codes.gp')
        //     ->where(['order_details.order_id'=>$id,'customer_codes.head_customer_id'=>$customer->parent_id])
        //     ->get();
            $product = OrderDetails::where('order_id',$id)->select('product_id','customer_code','gp')->distinct()->get('product_id');
            // dd($product);
            foreach($product as $value){
                $balance = OrderDetails::where(['order_id'=>$id,'product_id'=> $value->product_id])->sum('quantity');
                // $pcus_code = CustomerCode::where(['head_customer_id'=>$order->head_customer_id,'product_id'=> $value->product_id])->get();
                // dd($pcus_code);

            }
            Cart::clear();
     return view('admin.pos.invoice',compact('customer','content','product','balance'));
        }else{
            $product = OrderDetails::where('order_id',$id)->select('product_id','customer_code','gp')->distinct()->get('product_id');
            foreach($product as $value){
                $balance = OrderDetails::where(['order_id'=>$id,'product_id'=> $value->product_id])->sum('quantity');

            }
            // dd($products);
            // foreach($products as $value){
            //     $product = DB::table('order_details')
            //     ->join('orders', 'order_details.order_id', '=', 'orders.id')
            //     ->join('products', 'order_details.product_id', '=', 'products.id')
            //     // ->join('customer_codes', 'order_details.product_id', '=', 'customer_codes.product_id')
            //     ->select('order_details.*','products.title','products.product_code')
            //     ->where(['order_details.product_id'=>$value->product_id,'order_details.order_id'=>$id])
            //     ->get();
            // }
            // dd($products);
            
            // dd($product);
        }
            Cart::clear();
     return view('admin.pos.invoice',compact('customer','content','product','balance'));
    }
    public function final_invoice(Request $request){

    //   $customer = Customer::where('id',$request->customer_id)->first();
    //    dd($customer);
    //   $head_customer_id = $customer->parent_id;
    //   $head_customer = Head_customer::where('id',$head_customer_id)->first();
    $id = Session::get('order_id');
       $data = Order::find($id);
    //   $data->customer_id = $request->customer_id;
    //   $data->head_customer_id = $head_customer->id;
       $data->seller_id =Auth::user()->id;
       $data->order_date = $request->order_date;
       $data->delivery_date = $request->delivery_date;
       $data->discount_amount = $request->discount_amount;
       $data->month = $request->month;
       $data->year = $request->year;
       $data->payment_status = $request->payment_status;
       $data->total_products = Cart::getTotalQuantity();
       $data->sub_total = $request->sub_total;
       $data->vat = $request->vat;
       $data->shipping = Session::get('shipping');
       $data->discount = Session::get('discount');
       $data->pio_date = Session::get('pio_date');
       $data->pio_number = Session::get('pio_number');
       $data->delivery_date = Session::get('delivery_date');
       $data->discount_type = Session::get('discount_type');
       $data->order_status = $request->order_status;
       $data->invoice_number = $request->invoice_number;
       $data->invoice_date = $request->order_date;

       $data->total = $request->total;
       $data->pay = $request->pay;
       $data->due = $request->due;
       $data->save();
       $order_details= OrderDetails::where('order_id',$id)->get();
        foreach($order_details as $key=> $value){
            $product_id=$value->product_id;
            $color_id=$value->color_id;
            $product_sales_qty=$value->quantity;
            if($request->order_status==2){
                $product=DistributedProduct::where(['product_id'=>$product_id,'color_id'=>$color_id])->first();
                $productById= DistributedProduct::where(['product_id'=>$product_id,'color_id'=>$color_id])->first();
                $gty = $productById->available_quantity;
                $avail_qty = ($gty-$product_sales_qty);
                $product ->available_quantity =$avail_qty;
                $sale = $productById->total_sale;
                $total = $sale+$product_sales_qty;
                $product->total_sale = $total;
                $product->save();
            }
         }

    //   $content = Cart::getContent();
    //   foreach($content as $item){
    //     $order_details = new OrderDetails();
    //     $order_details->order_id = $data->id;
    //     $order_details->product_id = $item->id;
    //     $order_details->quantity = $item->quantity;
    //     $order_details->unit_cost = $item->price;
    //     $order_details->gp = $item->attributes->gp;
    //     $order_details->total = $item->price*$item->quantity;
    //     $order_details->save();
    //   }
       $notification=array(

         $request->session()->forget('shipping'),
        $request->session()->forget('discount'),
        $request->session()->forget('discount_type'),
        $request->session()->forget('pio_number'),
        $request->session()->forget('pio_date'),
        $request->session()->forget('delivery_date'),
        $request->session()->forget('order_id'),
        'message' => 'Successfully Done',
        'alert-type' => 'success'
    );
    return redirect()->route('home')->with($notification);
    }
    public function create_sale_online(Request $request){
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'discount' => 'required',
        ],
        [
            'customer_id.required' => 'Select A customer First !!'
        ]
    );
    $request->session()->put('discount_type', $request->discount_type);
    $request->session()->put('discount', $request->discount);
    $request->session()->put('pio_number', $request->pio_number);
    $request->session()->put('pio_date', $request->pio_date);
    $request->session()->put('delivery_date', $request->delivery_date);
    $request->session()->put('shipping', $request->shipping);
    $customer = Customer::where('id',$request->customer_id)->first();
    $content = Cart::getContent();
    // dd($content);
    $head_customer_id = $customer->parent_id;
    // dd($head_customer_id);
       $head_customer = Head_customer::where('id',$head_customer_id)->first();
       $data = new Order();
       $data->customer_id = $request->customer_id;
       $data->seller_id =Auth::user()->id;
       $data->save();

       $request->session()->put('order_id', $data->id);
    $content = Cart::getContent();
    foreach($content as $item){
        $order_details = new OrderDetails();
        // $product = CustomerCode::where(['head_customer_id'=>$head_customer_id])->count();
        // if($product){
        //     $product = CustomerCode::where(['head_customer_id'=>$head_customer_id,'product_id'=>$item->attributes->product_id])->first();
        //     $order_details->customer_code = $product->customer_product_code;
        //     $order_details->gp = $product->gp;
        // }
        $order_details->order_id = $data->id;
        $order_details->product_id = $item->attributes->product_id;
        $order_details->color_id = $item->attributes->color_id;
        $order_details->quantity = $item->quantity;
        $order_details->unit_cost = $item->price;
        $order_details->total = $item->price*$item->quantity;
        $order_details->save();
       }

       $id = Session::get('order_id');
    //    $order = Order::where('id',$id)->first();
    //     $customer = Customer::where('id',$order->customer_id)->first();
    //     $product = CustomerCode::where(['head_customer_id'=>$order->head_customer_id])->count();
    //     $balance = 0;
    //     if($product > 0)
    //     {
    //     // $product = DB::table('order_details')
    //     //     ->join('orders', 'order_details.order_id', '=', 'orders.id')
    //     //     ->join('products', 'order_details.product_id', '=', 'products.id')
    //     //     ->join('customer_codes', 'order_details.product_id', '=', 'customer_codes.product_id')
    //     //     ->select('order_details.*','products.title','products.product_code','customer_codes.customer_product_code','customer_codes.product_id','customer_codes.gp')
    //     //     ->where(['order_details.order_id'=>$id,'customer_codes.head_customer_id'=>$customer->parent_id])
    //     //     ->get();
    //         $product = OrderDetails::where('order_id',$id)->select('product_id','customer_code','gp')->distinct()->get('product_id');
    //         // dd($product);
    //         foreach($product as $value){
    //             $balance = OrderDetails::where(['order_id'=>$id,'product_id'=> $value->product_id])->sum('quantity');
    //             // $pcus_code = CustomerCode::where(['head_customer_id'=>$order->head_customer_id,'product_id'=> $value->product_id])->get();
    //             // dd($pcus_code);

    //         }
    //         Cart::clear();
    //  return view('admin.pos.invoice',compact('customer','content','product','balance'));
    //     }else{
            $product = OrderDetails::where('order_id',$id)->select('product_id')->distinct()->get('product_id');
            foreach($product as $value){
                $balance = OrderDetails::where(['order_id'=>$id,'product_id'=> $value->product_id])->sum('quantity');

            // }
            // dd($products);
            // foreach($products as $value){
            //     $product = DB::table('order_details')
            //     ->join('orders', 'order_details.order_id', '=', 'orders.id')
            //     ->join('products', 'order_details.product_id', '=', 'products.id')
            //     // ->join('customer_codes', 'order_details.product_id', '=', 'customer_codes.product_id')
            //     ->select('order_details.*','products.title','products.product_code')
            //     ->where(['order_details.product_id'=>$value->product_id,'order_details.order_id'=>$id])
            //     ->get();
            // }
            // dd($products);
            
            // dd($product);
        }
            Cart::clear();
     return view('admin.pos.invoice',compact('customer','content','product','balance'));
    
    }
}
