<?php

namespace App\Http\Controllers\Admin;

use App\ColorWiseProduct;
use App\Distributed;
use App\DistributedProduct;
use App\Http\Controllers\Controller;
use App\Product;
use App\Wear_house;
use App\WearhouseProduct;
use Illuminate\Http\Request;
use DB;
use Auth;

class TransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function wearhouse_transfer(){
        $products = Product::with('product_color')->where('status',1)->OrderBy('id','desc')->get();
        // dd($products);
        return view('admin.product_transfer.admin_to_wearhouse',compact('products'));
    }
    public function distributed_transfer(){

        $location_id = Auth::user()->location_id;
        // $products = Product::where('status',1)->get();
        if($location_id==''){
            // $products = DB::table('wearhouse_products')
            // ->join('products', 'wearhouse_products.product_id', '=', 'products.id')
            // ->join('colors', 'products.color_id', '=', 'colors.id')
            // ->select('wearhouse_products.*', 'products.title','products.product_code','products.supplier_code','products.status')
            // ->where(['wear_house_id'=>$location_id,'users.role_id'=>3])
            // ->where(['products.status'=>1])
            // ->get();
            $products = WearhouseProduct::get();

        return view('admin.product_transfer.wearhouse_to_distributed',compact('products'));
        }else{
            // $products = DB::table('wearhouse_products')
            // ->join('products', 'wearhouse_products.product_id', '=', 'products.id')
            // ->join('colors', 'products.color_id', '=', 'colors.id')
            // ->join('users', 'wearhouse_products.wear_house_id', '=', 'users.location_id')
            // ->select('wearhouse_products.*', 'products.title','products.product_code','products.supplier_code','products.status')
            // ->where(['wear_house_id'=>$location_id,'users.role_id'=>3,'products.status'=>1])
            // ->get();
            $products = WearhouseProduct::get();
 
        return view('admin.product_transfer.wearhouse_to_distributed',compact('products'));
        }

    }
    public function wearhouse_product(){
        $warehouse = Wear_house::where('status',1)->get();
        $location_id = Auth::user()->location_id;
        if($location_id==''){
            $products = DB::table('wearhouse_products')
            ->join('products', 'wearhouse_products.product_id', '=', 'products.id')
            ->join('colors', 'wearhouse_products.color_id', '=', 'colors.id')
            ->join('wear_houses', 'wearhouse_products.wear_house_id', '=', 'wear_houses.id')
            ->select('wearhouse_products.*', 'products.title','products.product_code','products.supplier_code','products.status','wear_houses.wear_house_name','colors.color_name' )
            ->where(['products.status'=>1])
            ->get();
        return view('admin.product_history.wear_house',compact('products','warehouse'));
        }else{
            $products = DB::table('wearhouse_products')
            ->join('products', 'wearhouse_products.product_id', '=', 'products.id')
            ->join('users', 'wearhouse_products.wear_house_id', '=', 'users.location_id')
            // ->join('colors', 'products.color_id', '=', 'colors.id')
            ->select('wearhouse_products.*', 'products.title','products.product_code','products.supplier_code','products.status','users.role_id','colors.color_name')
            ->where(['wear_house_id'=>$location_id,'users.role_id'=>3,'products.status'=>1])
            ->get();
        return view('admin.product_history.wear_house',compact('products'));
        }

    }
    public function distributed_product(){
        $distributed = Distributed::where('status',1)->get();
        $products = DB::table('distributed_products')
            ->join('products', 'distributed_products.product_id', '=', 'products.id')
            ->join('colors', 'distributed_products.color_id', '=', 'colors.id')
            ->join('distributeds', 'distributed_products.distributed_id', '=', 'distributeds.id')
            ->select('distributed_products.*', 'products.title','products.product_code','products.supplier_code','products.status','distributeds.distributed_name','colors.color_name')
            ->where('products.status',1)
            ->get();
        return view('admin.product_history.distributed',compact('products','distributed'));
    }
    public function get_product__information(Request $request){
        $data = Wear_house::get();
        if($request->ajax()){
            $main_data = Product::where('products.id',$request->id)->first();
            $quantity = ColorWiseProduct::where('product_id',$request->id)->get();
            return view('admin.product_transfer.view_model',compact('main_data','data','quantity'));
        }
    }
    public function save_transfer(Request $request){
        // dd($request->wear_house_id);

        // $data = WearhouseProduct::where(['product_id'=>$request->product_id,'wear_house_id'=>$request->wear_house_id])->count();
        // if($data > 0)
        // {
            $color_id = $request->color_id;
            $quantity_v = $request->quantity;
            foreach($color_id as $key=>$value){
                $data_id = WearhouseProduct::where(['product_id'=>$request->product_id,'wear_house_id'=>$request->wear_house_id,'color_id'=>$value])->first();
        // dd($data_id->quantity);
        if($data_id){
            $data =WearhouseProduct::where(['product_id'=>$request->product_id,'wear_house_id'=>$request->wear_house_id,'color_id'=>$value])->first();
            $data->opening_quantity = $data_id->available_quantity;
            $quantity = $quantity_v[$key];
            $data->quantity = $quantity;
            $data->available_quantity = $data->opening_quantity+$quantity;
            $data->total_quantity = $data_id->total_quantity+$quantity;
            $data->save();
        }else{
            $data =new WearhouseProduct();
            $data->color_id = $value;
            $data->product_id = $request->product_id;
            $data->wear_house_id = $request->wear_house_id;
            $data->opening_quantity = 0;
            $quantity =  $quantity_v[$key];
            $data->quantity = $quantity;
            $data->available_quantity = $quantity;
            $data->total_quantity = $quantity;
            $data->save();
        }
      }
        $color_id = $request->color_id;
        $quantity_v = $request->quantity;
        foreach($color_id as $key=>$value){
        $product_by_id = ColorWiseProduct::where(['product_id'=>$request->product_id,'color_id'=>$value])->first();
        $product = ColorWiseProduct::where(['product_id'=>$request->product_id,'color_id'=>$value])->first();
        $product->total_transfer = $quantity_v[$key];
        $available_quantity = $product_by_id->available_quantity-$quantity_v[$key];
        $product->available_quantity = $available_quantity;
        $product->save();
        }
        $product_s = Product::where('id',$request->product_id)->first();
        $product_s->selling_price = $request->selling_price;
        $product_s->save();
            
        // $data_id = WearhouseProduct::where(['product_id'=>$request->product_id,'wear_house_id'=>$request->wear_house_id])->first();
        // // dd($data_id->quantity);
        // $data =WearhouseProduct::where(['product_id'=>$request->product_id,'wear_house_id'=>$request->wear_house_id])->first();
        // $data->opening_quantity = $data_id->available_quantity;
        // $quantity = $request->quantity;
        // $data->quantity = $quantity;
        // $data->available_quantity = $data->opening_quantity+$quantity;
        // $data->total_quantity = $data_id->total_quantity+$quantity;
        // $data->save();
        // }else{
        //     $color_id = $request->color_id;
        //     $quantity_v = $request->quantity;
        //     foreach($color_id as $key=>$value){
        //         $data =new WearhouseProduct();
        //         $data->color_id = $value;
        //         $data->product_id = $request->product_id;
        //         $data->wear_house_id = $request->wear_house_id;
        //         $data->opening_quantity = 0;
        //         $quantity =  $quantity_v[$key];
        //         $data->quantity = $quantity;
        //         $data->available_quantity = $quantity;
        //         $data->total_quantity = $quantity;
        //         $data->save();
        //     }
        //     $color_id = $request->color_id;
        // $quantity_v = $request->quantity;
        // foreach($color_id as $key=>$value){
        // $product_by_id = ColorWiseProduct::where(['product_id'=>$request->product_id,'color_id'=>$value])->first();
        // $product = ColorWiseProduct::where(['product_id'=>$request->product_id,'color_id'=>$value])->first();
        // $product->total_transfer = $quantity_v[$key];
        // $available_quantity = $product_by_id->available_quantity-$quantity_v[$key];
        // $product->available_quantity = $available_quantity;
        // $product->save();
        // }
        // $product_s = Product::where('id',$request->product_id)->first();
        // $product_s->selling_price = $request->selling_price;
        // $product_s->save();
        // $data =new WearhouseProduct();
        // $data->product_id = $request->product_id;
        // $data->wear_house_id = $request->wear_house_id;
        // $data->opening_quantity = 0;
        // $quantity =  $request->quantity;
        // $data->quantity = $quantity;
        // $data->available_quantity = $quantity;
        // $data->total_quantity = $quantity;
        // $data->save();
    // }
        
        $notification=array(
            'message' => 'Successfully Tranfered',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function get_wearhouse_product__information(Request $request){
        $data = Distributed::where('status',1)->get();
        if($request->ajax()){
            $main_data = DB::table('wearhouse_products')
            ->join('products', 'wearhouse_products.product_id', '=', 'products.id')
            ->select('wearhouse_products.*','products.title','products.product_code')
            ->where('wearhouse_products.id',$request->id)
            ->first();
            // $main_data = WearhouseProduct::where('product_id',$request->id)->first();

        }
        return view('admin.product_transfer.view_dis_model',compact('main_data','data'));
    }
    public function get_product_qty_information(Request $request){
        $data = Distributed::where('status',1)->get();
        if($request->ajax()){
            $main_data = DB::table('wearhouse_products')
            ->join('products', 'wearhouse_products.product_id', '=', 'products.id')
            ->select('wearhouse_products.*','products.title')
            ->where('wearhouse_products.id',$request->id)
            ->first();
            // $main_data = WearhouseProduct::where('product_id',$request->id)->first();

        }
        return view('admin.product_transfer.ready_qty_model',compact('main_data','data'));
    }
    public function distributed_transfer_product(Request $request){
        $data = DistributedProduct::where(['product_id'=>$request->product_id,'color_id'=>$request->color_id,'distributed_id'=>$request->distributed_id])->count();
        if($data > 0)
        {
        $data_id = DistributedProduct::where(['product_id'=>$request->product_id,'color_id'=>$request->color_id,'distributed_id'=>$request->distributed_id])->first();
        // dd($data_id->quantity);
        $data =DistributedProduct::where(['product_id'=>$request->product_id,'color_id'=>$request->color_id,'distributed_id'=>$request->distributed_id])->first();
        $data->opening_quantity = $data_id->available_quantity;
        $quantity =  $request->quantity;
        $data->quantity = $quantity;
        $data->available_quantity = $data->opening_quantity+$quantity;
        $data->total_quantity = $data_id->total_quantity+$quantity;
        $data->color_id = $request->color_id;
        $data->save();
        }else{
        $data =new DistributedProduct();
        $data->product_id = $request->product_id;
        $data->distributed_id = $request->distributed_id;
        $data->opening_quantity = 0;
        $quantity =  $request->quantity;
        $data->quantity = $quantity;
        $data->available_quantity = $quantity;
        $data->total_quantity = $quantity;
        $data->color_id = $request->color_id;
        $data->save();
        }
        $product_by_id = WearhouseProduct::where(['product_id'=>$request->product_id,'color_id'=>$request->color_id])->first();
        $product = WearhouseProduct::where(['product_id'=>$request->product_id,'color_id'=>$request->color_id])->first();
        // dd($product_by_id->available_quantity);
        $product->total_transfer = $quantity;
        $product->life_time_total_transfer = $product_by_id->life_time_total_transfer+$quantity;
        $available_quantity = 0;
        $available_quantity = $product_by_id->ready_quantity-$quantity;
        $product->ready_quantity = $available_quantity;
        $product->save();
        $notification=array(
            'message' => 'Successfully Tranfered',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function save_ready_quantity(Request $request){
        $product_by_id = WearhouseProduct::where(['product_id'=>$request->product_id,'color_id'=>$request->color_id])->first();
        $product = WearhouseProduct::where(['product_id'=>$request->product_id,'color_id'=>$request->color_id])->first();
        $ready = $product_by_id->ready_quantity;
        $available_quantity = $product_by_id->available_quantity;
        $ready_quantity = $request->quantity;
        $product->ready_quantity = $ready+$ready_quantity;
        $product->available_quantity = $available_quantity-$ready_quantity;
        $product->save();
        $notification=array(
            'message' => 'Successfully Saved',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
