<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Distributed;
use App\Head_customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\OrderDetails;
use App\Product;
use App\Suplier;
use App\ReducedReport;
use App\Payment;
use App\ProductStockHistory;
use App\StockHistory;
use Auth;
use DB;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function customer_wise_sales(){
        $orders = Order::OrderBy('id','desc')->where('order_status',2)->get();
        $h_customer = Head_customer::where('status',1)->get();
        $distributed = Distributed::where('role_id',4)->get();
        if(Auth::user()->role_id==4){
            $orders = Order::OrderBy('id','desc')->where('seller_id',Auth::user()->id)->get();
            $distributed = Distributed::where('id',Auth::user()->id)->get();
        }
        return view('admin.report.customer_wisesales',compact('orders','distributed','h_customer'));
    }
    public function get_customerwise_sales(Request $request){
        // dd($request->customer_id);
        $orders = DB::table('orders')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            // ->join('users', 'order_details.customer_id', '=', 'users.id')
            // ->join('orders', 'order_details.order_id', '=', 'orders.id')
            // ->join('admin_registers', 'products.admin_id', '=', 'admin_registers.id')
            ->select('orders.*','customers.customer_name')
            ->where('head_customer_id',$request->customer_id)
            ->get();
        return view('admin.report.customer_wisesales_ajax',compact('orders'));
    }
    public function stock_report(){
        $products= DB::table('distributed_products')
                ->join('products', 'distributed_products.product_id', '=', 'products.id')
                ->join('supliers', 'products.supplier_id', '=', 'supliers.id')
                // ->join('admin_registers', 'products.admin_id', '=', 'admin_registers.id')
                // ->join('admin_registers', 'products.admin_id', '=', 'admin_registers.id')
                ->select('distributed_products.*','products.*','supliers.supplier_name')
                ->OrderBy('distributed_products.id','desc')->get();
        $supplier = Suplier::where('status',1)->get();
        $distributed = Distributed::where('status',1)->get();
        return view('admin.report.stock_report',compact('products','supplier','distributed'));
    }
    public function get_stock_report(Request $request){
        // dd($request->distributed_id);
        $products= DB::table('distributed_products')
                ->join('products', 'distributed_products.product_id', '=', 'products.id')
                ->join('supliers', 'products.supplier_id', '=', 'supliers.id')
                // ->join('admin_registers', 'products.admin_id', '=', 'admin_registers.id')
                ->select('distributed_products.*','products.*','supliers.supplier_name')
                ->OrderBy('distributed_products.id','desc')->where(['products.status'=>1,'distributed_products.distributed_id'=>$request->distributed_id])->get();
        // $products = Product::OrderBy('id','desc')->where(['status'=>1,'distributed_id'=>$request->distributed_id])->get();
        return view('admin.report.get_stock_report',compact('products'));
    }
    public function customer_daily_report(){
        $orders = Order::OrderBy('id','desc')->where('order_status',2)->whereDate('created_at', Carbon::today())->get();
        return view('admin.report.customer_wise_report.daily_report',compact('orders'));
    }
    public function customer_weekly_report(){
        $date = \Carbon\Carbon::today()->subDays(7);

        $orders = Order::where('created_at', '>=', $date)->where('order_status',2)->get();
        return view('admin.report.customer_wise_report.weekly_report',compact('orders'));
    }
    public function customer_monthly_report(){
        $date = \Carbon\Carbon::today()->subDays(30);

        $orders = Order::where('created_at', '>=', $date)->where('order_status',2)->get();
        return view('admin.report.customer_wise_report.monthly_report',compact('orders'));
    }
    public function customer_annual_report(){
        $date = \Carbon\Carbon::today()->subDays(365);

        $orders = Order::where('created_at', '>=', $date)->where('order_status',2)->get();
        return view('admin.report.customer_wise_report.annual_report',compact('orders'));
    }
    public function products_daily_report(){
        $customer = Customer::where('status',1)->get();
        $products = OrderDetails::select('product_id')->distinct()->get('product_id');
        return view('admin.report.product_wise_report.daily_report',compact('products','customer'));
    }
    public function products_weekly_report(){
        $customer = Customer::where('status',1)->get();
        $date = \Carbon\Carbon::today()->subDays(7);
        $products = OrderDetails::select('product_id')->distinct()->get('product_id');
        return view('admin.report.product_wise_report.weekly_report',compact('products','date','customer'));
    }
    public function products_monthly_report(){
        $customer = Customer::where('status',1)->get();
        $date = \Carbon\Carbon::today()->subDays(30);
        $products = OrderDetails::select('product_id')->distinct()->get('product_id');
        return view('admin.report.product_wise_report.monthly',compact('products','date','customer'));
    }
    public function products_annual_report(){
        $customer = Customer::where('status',1)->get();
        $date = \Carbon\Carbon::today()->subDays(365);
        $products = OrderDetails::select('product_id')->distinct()->get('product_id');
        return view('admin.report.product_wise_report.annual_report',compact('products','date','customer'));
    }
    public function get_annual_report(Request $request){
        $date = \Carbon\Carbon::today()->subDays(30);
        $products= DB::table('order_details')
                ->join('products', 'order_details.product_id', '=', 'products.id')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->select('order_details.*','products.title','customers.customer_name')
                ->OrderBy('order_details.id','desc')->where(['orders.order_status'=>2])->where('order_details.created_at', '>=', $date)->where('product_id',$request->product_id)->get();
                return view('admin.report.product_wise_report.get_annual_report',compact('products'));
            }
            public function reduce_report(){
         $products = DB::table('reduced_reports')
                ->join('products', 'reduced_reports.product_id', '=', 'products.id')
                ->join('colors', 'products.color_id', '=', 'colors.id')
                ->select('reduced_reports.*','products.title','products.product_code','colors.color_name')
                ->get();
         return view('admin.report.reduced_report',compact('products'));
     }
     public function customer_payment(){
         $payment = Payment::get();
         return view('admin.report.cus_payment_report',compact('payment'));
     }
     public function filter_products_sales(Request $request){
        $customer_id = $request->customer_id;
        $customer = Customer::where('status',1)->get();
        $date = \Carbon\Carbon::today()->subDays(30);
        $products = OrderDetails::select('product_id')->distinct()->get('product_id');
         return view('admin.report.product_wise_report.filter_monthly',compact('customer','products','date','customer_id'));
     }
     public function filter_annual_sales(Request $request){
        $customer_id = $request->customer_id;
        $customer = Customer::where('status',1)->get();
        $date = \Carbon\Carbon::today()->subDays(365);
        $products = OrderDetails::select('product_id')->distinct()->get('product_id');
         return view('admin.report.product_wise_report.get_annual_report',compact('customer','products','date','customer_id'));
     }
     public function filter_weekly_sales(Request $request){
        $customer_id = $request->customer_id;
        $customer = Customer::where('status',1)->get();
        $date = \Carbon\Carbon::today()->subDays(7);
        $products = OrderDetails::select('product_id')->distinct()->get('product_id');
         return view('admin.report.product_wise_report.filter_weekly',compact('customer','products','date','customer_id'));
     }
     public function filter_daily_sales(Request $request){
        $customer_id = $request->customer_id;
        $customer = Customer::where('status',1)->get();
        $products = OrderDetails::select('product_id')->distinct()->get('product_id');
         return view('admin.report.product_wise_report.filter_daily',compact('customer','products','customer_id'));
    }
    public function date_range_report(){
        $customer = Customer::where('status',1)->get();
        $products = OrderDetails::select('product_id')->distinct()->get('product_id');
         return view('admin.report.product_wise_report.date_rang',compact('customer','products'));
    }
    public function filter_date_range(Request $request){
        $customer_id = $request->customer_id;
        $start = Carbon::parse($request->start_date);
        
        $end = Carbon::parse($request->end_date);
        
        $customer = Customer::where('status',1)->get();
        $products = OrderDetails::select('product_id')->distinct()->get('product_id');
         return view('admin.report.product_wise_report.filter_date_range',compact('customer','products','customer_id','start','end'));
    }
    public function stock_history(){
        $stock_history = ProductStockHistory::get();
        return view('admin.report.stock_history_report',compact('stock_history'));
    }

}
