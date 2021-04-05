<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Product_cost;
use App\Suplier;
use Image;
use Illuminate\Http\Request;
use Auth;
use App\Color;
use App\ColorWiseProduct;
use App\ProductCostHistory;
use App\ProductStockHistory;
use App\ReducedReport;
use App\WearhouseProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::OrderBy('id','desc')->get();
        $supplier = Suplier::where('status',1)->get();
        return view('admin.product.manage_product',compact('products','supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $supplier = Suplier::where('status',1)->get();
        $colors = Color::where('status',1)->orderBy('id','desc')->get();
        return view('admin.product.add_product',compact('categories','brands','supplier','colors'));
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
            'title' => 'required',
            'product_code' => 'required',
            'purchase_price' => 'required',
            'product_unit' => 'required',
            'quantity' => 'required',
        ]);
        $total =0;
        $cost_type = $request->input('cost_type');

        $cost_amount = $request->input('cost_amount');
        if ($cost_amount) {
            foreach ($cost_amount as $key => $value) {
             $cost = new Product_cost();
             $cost->cost_amount =$value;
             $cost->cost_type=$cost_type[$key];
             $total = $total + $value;
            }
        }
        $data = new Product();
        $data->title=$request->title;
        $data->admin_id = Auth::user()->id;
        $data->category_id=$request->category_id;
        $data->brand_id=$request->brand_id;
        // $data->color_id=$request->color_id;
        $data->supplier_id=$request->supplier_id;
        $data->supplier_code=$request->supplier_code;
        // $data->gp=$request->gp;
        $data->product_code=$request->product_code;
        $data->product_unit=$request->product_unit;
        $data->purchase_price=$request->purchase_price;
        $data->quantity=$request->quantity;
        $data->available_quantity=$request->quantity;
        $data->total_quantity=$request->quantity;
        $data->description=$request->description;
        $data->total_cost=$total;
        $cost_per_qty = $total;
        $total_buying_cost = $request->purchase_price+$cost_per_qty;
        $data->cost_per_qty = $cost_per_qty;
        $data->total_buying_cost_per_qty = $total_buying_cost;
        $data->total_buying_cost = $total_buying_cost*$request->quantity;
        if($request->hasFile('image')) {
            $image = $request->image;
            $filename = $image->getClientOriginalName();
            $filename = preg_replace('/\s+/', '-', $filename);
            $cat_img = 'uploads/product_image/' . time() . '-' . $filename;
            Image::make($image)->resize(300, 300)->save($cat_img);
            $data->image = $cat_img;
        }
        $data->save();
        // dd($data);
        if ($cost_amount) {
            foreach ($cost_amount as $key => $value) {
             $cost = new Product_cost();
             $cost->product_id=$data->id;
             $cost->cost_amount =$value;
             $cost->cost_type=$cost_type[$key];
             $cost->save();
            }
        }
        if($request->color_id){
        $color_id = $request->color_id;
        $quantity = $request->pro_quantity;
               foreach ($color_id as $key => $value) {
               $pro_color = new ColorWiseProduct();
               $pro_color->product_id = $data->id;
               $pro_color->color_id = $value;
               $pro_color->quantity = $quantity[$key];
               $pro_color->available_quantity=$quantity[$key];
               $pro_color->total_quantity=$quantity[$key];
               $pro_color->save();
           }
        }
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
        $categories = Category::where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $supplier = Suplier::where('status',1)->get();
        $cost_type = Product_cost::where('product_id',$id)->get();
        $product_by_id = Product::where('id',$id)->first();
        $colors = Color::where('status',1)->get();
        return view('admin.product.edit_product',compact('colors','categories','brands','supplier','product_by_id','cost_type'));
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

        $total =0;
        $cost_type = $request->input('cost_type');

        $cost_amount = $request->input('cost_amount');
        if ($cost_amount) {
            foreach ($cost_amount as $key => $value) {
             $cost = new Product_cost();
             $cost->cost_amount =$value;
             $cost->cost_type=$cost_type[$key];
             $total = $total + $value;
            }
        }
        $data = Product::find($id);
        $data->title=$request->title;
        $data->category_id=$request->category_id;
        $data->brand_id=$request->brand_id;
        $data->supplier_id=$request->supplier_id;
        $data->supplier_code=$request->supplier_code;
        $data->product_code=$request->product_code;
        $data->product_unit=$request->product_unit;
        $data->purchase_price=$request->purchase_price;
        // $data->gp=$request->gp;
        $data->description=$request->description;
        $cost_per_qty = $total;
        $total_buying_cost = $request->purchase_price+$cost_per_qty;
        $data->cost_per_qty = $cost_per_qty;
        $data->total_buying_cost_per_qty = $total_buying_cost;
        $data->total_buying_cost = $total_buying_cost*$data->quantity;
        if($request->hasFile('image')) {
            $image = $request->image;
            $filename = $image->getClientOriginalName();
            $filename = preg_replace('/\s+/', '-', $filename);
            $cat_img = 'uploads/product_image/' . time() . '-' . $filename;
            Image::make($image)->resize(300, 300)->save($cat_img);
            $data->image = $cat_img;
        }
        $data->save();
        // dd($data);
        $cost = Product_cost::where('product_id',$id)->delete();
        if ($cost_amount) {
            foreach ($cost_amount as $key => $value) {
             $cost = new Product_cost();
             $cost->product_id=$data->id;
             $cost->cost_amount =$value;
             $cost->cost_type=$cost_type[$key];
             $cost->save();
            }
        }
        // $color = ColorWiseProduct::where('product_id',$id)->delete();
        // if($request->color_id){
        //    $color_id = $request->color_id;
        //        foreach ($color_id as $key => $value) {
        //        $pro_color = new ColorWiseProduct();
        //        $pro_color->product_id = $data->id;
        //        $pro_color->color_id = $value;
        //        $pro_color->save();
        //    }
        // }
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
        $data = WearhouseProduct::where('product_id',$id)->count();
        
        if($data > 0)
        {
            $notification=array(
                'message' => 'Already Use Other Table.So you are not Delete this Data ',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }

        $data_id = ColorWiseProduct::where('product_id',$id)->get();
        foreach($data_id as $value){
            $cat_id=$value->id;
            // dd($cat_id);
            $subcat = ColorWiseProduct::where('id',$cat_id)->first();
            $subcat->delete();
        }
        $data_id = Product_cost::where('product_id',$id)->get();
        foreach($data_id as $value){
            $cat_id=$value->id;
            $subcat = Product_cost::where('id',$cat_id)->first();
            $subcat->delete();
        }
        $data = Product::find($id);
        $data->delete();
        $notification=array(
            'message' => 'Successfully Deleted',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
    public function active_product($id){
        $data = Product::find($id);
        $data->status = 1;
        $data->save();
        $notification=array(
            'message' => 'Successfully Activated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function inactive_product($id){
        $data = Product::find($id);
        $data->status = 0;
        $data->save();
        $notification=array(
            'message' => 'Successfully DeActivated',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }
    public function get_product_discount_information(Request $request){
        if($request->ajax()){
            $main_data = Product::where('products.id',$request->id)->first();
            return response()->json($main_data);
        }
    }
    public function update_quantity(Request $request){
        $total =0;
        $cost_type = $request->input('cost_type');

        $cost_amount = $request->input('cost_amount');
        if ($cost_amount) {
            foreach ($cost_amount as $key => $value) {
             $cost = new Product_cost();
             $cost->cost_amount =$value;
             $cost->cost_type=$cost_type[$key];
             $total = $total + $value;
            }
        }
        $pro_qty =0;
        $pro_color_quantity=0;
        if($request->color_id){
            $color_id = $request->color_id;
            $quantity = $request->pro_quantity;
                   foreach ($color_id as $key => $value) {
                   $pro_color = ColorWiseProduct::where(['product_id'=>$request->product_id,'color_id'=>$value])->first();
                   $color = ColorWiseProduct::where(['product_id'=>$request->product_id,'color_id'=>$value])->first();
                   if(!empty($pro_color)){
                    $pro_qty += $pro_color->available_quantity;
                   }
                   $pro_color_quantity += $quantity[$key];
            }
        }
        $data = Product::find($request->product_id);
        $pro_color_quantity_total = $pro_color_quantity*($request->purchase_price+$total);
        // dd($pro_color_quantity_total);
        $pro_qty_total = $pro_qty*$data->total_buying_cost_per_qty;
        // dd($pro_qty_total);
        $qty_total_am = $pro_color_quantity_total+$pro_qty_total;
        // dd($qty_total_am);
        $qty_total = $pro_color_quantity+$pro_qty;
        // dd($qty_total);
        $purchase_price_average = $qty_total_am/$qty_total;
        // dd($purchase_price_average);
        $data_id = Product::find($request->product_id);
        $data->opening_quantity = $data_id->available_quantity;
        $quantity =  $request->quantity;
        $data->quantity = $quantity;
        $data->available_quantity = $data->opening_quantity+$quantity;
        $data->total_quantity = $data_id->total_quantity+$quantity;
        $data->category_id=$request->category_id;
        $data->brand_id=$request->brand_id;
        $data->supplier_id=$request->supplier_id;
        $data->supplier_code=$request->supplier_code;
        $data->product_code=$request->product_code;
        $data->product_unit=$request->product_unit;
        $data->purchase_price=$request->purchase_price;
        $data->description=$request->description;
        $cost_per_qty = $total;
        $total_buying_cost = $request->purchase_price+$cost_per_qty;
        $data->cost_per_qty = $cost_per_qty;
        $data->total_buying_cost_per_qty = $purchase_price_average;
        $data->total_buying_cost = $total_buying_cost*$data->quantity;
        $data->save();
        // dd($data);
        $cost = Product_cost::where('product_id',$request->product_id)->delete();
        if ($cost_amount) {
            foreach ($cost_amount as $key => $value) {
             $cost = new Product_cost();
             $cost->product_id=$data->id;
             $cost->cost_amount =$value;
             $cost->cost_type=$cost_type[$key];
             $cost->save();
             $cost_history = new ProductCostHistory();
             $cost_history->product_id=$data->id;
             $cost_history->cost_amount =$value;
             $cost_history->cost_type=$cost_type[$key];
             $cost_history->save();
            }
        }
        if($request->color_id){
            $color_id = $request->color_id;
            $quantity = $request->pro_quantity;
                   foreach ($color_id as $key => $value) {
                   $pro_color = ColorWiseProduct::where(['product_id'=>$request->product_id,'color_id'=>$value])->first();
                   if(!empty($pro_color)){
                    $color = ColorWiseProduct::where(['product_id'=>$request->product_id,'color_id'=>$value])->first();
                    $pro_color->product_id = $data->id;
                    $pro_color->color_id = $value;
                    $pro_color->quantity = $quantity[$key];
                    $pro_color->opening_quantity = $color->available_quantity;
                    $pro_color->available_quantity=$pro_color->opening_quantity+$quantity[$key];
                    $pro_color->total_quantity=$color->total_quantity+$quantity[$key];
                    $pro_color->save();
                   }else{
                        $pro_color =new ColorWiseProduct();
                        $pro_color->product_id = $request->product_id;
                        $pro_color->color_id = $value;
                        $pro_color->quantity = $quantity[$key];
                        $pro_color->opening_quantity = $quantity[$key];
                        $pro_color->available_quantity=$quantity[$key];
                        $pro_color->total_quantity=$quantity[$key];
                        $pro_color->save();
                   }
                   
            }
        }
        $data->save();
        if($request->color_id){
            $color_id = $request->color_id;
            $quantity = $request->pro_quantity;
            foreach ($color_id as $key => $value) {
                $color = ProductStockHistory::where(['product_id'=>$request->product_id,'color_id'=>$value])->first();
                if($color){
                    if($quantity[$key]!=0){
                        $pro_color = new ProductStockHistory();
                    $pro_color->product_id = $data->id;
                    $pro_color->color_id = $value;
                    $pro_color->supplier_id = $request->supplier_id;
                    $pro_color->admin_id = Auth::user()->id;
                    $pro_color->quantity = $quantity[$key];
                    $pro_color->opening_quantity = $color->available_quantity;
                    $pro_color->available_quantity=$pro_color->opening_quantity+$quantity[$key];
                    $pro_color->total_quantity=$color->total_quantity+$quantity[$key];
                    $pro_color->purchase_price=$request->purchase_price;
                    $cost_per_qty = $total;
                    $total_buying_cost = $request->purchase_price+$cost_per_qty;
                    $pro_color->cost_per_qty = $cost_per_qty;
                    $pro_color->total_buying_cost_per_qty = $total_buying_cost;
                    $pro_color->total_buying_cost = $total_buying_cost*$data->quantity;
                    $pro_color->total_cost = $cost_per_qty*$quantity[$key];
                    $pro_color->save();
                    }  
                }else{
                    if($quantity[$key]!=0){
                    $pro_color = new ProductStockHistory();
                    $pro_color->product_id = $request->product_id;
                    $pro_color->color_id = $value;
                    $pro_color->admin_id = Auth::user()->id;
                    $pro_color->quantity = $quantity[$key];
                    $pro_color->opening_quantity = 0;
                    $pro_color->available_quantity=$quantity[$key];
                    $pro_color->total_quantity=$quantity[$key];
                    $pro_color->purchase_price=$request->purchase_price;
                    $cost_per_qty = $total;
                    $total_buying_cost = $request->purchase_price+$cost_per_qty;
                    $pro_color->cost_per_qty = $cost_per_qty;
                    $pro_color->total_buying_cost_per_qty = $total_buying_cost;
                    $pro_color->total_buying_cost = $total_buying_cost*$data->quantity;
                    $pro_color->total_cost = $cost_per_qty*$quantity[$key];
                    $pro_color->save();
                    }
                }
                
        }
    }
        // $history = new ProductStockHistory();
        // $history->product_id = $request->product_id;
        // $data_id = Product::find($request->product_id);
        // $history->opening_quantity = $data_id->available_quantity;
        // $quantity =  $request->quantity;
        // $history->quantity = $quantity;
        // $history->admin_id = Auth::user()->id;
        // $history->available_quantity = $data->opening_quantity+$quantity;
        // $history->total_quantity = $data_id->total_quantity+$quantity;
        // $history->purchase_price=$request->purchase_price;
        // $cost_per_qty = $total;
        // $total_buying_cost = $request->purchase_price+$cost_per_qty;
        // $history->cost_per_qty = $cost_per_qty;
        // $history->total_buying_cost_per_qty = $total_buying_cost;
        // $history->total_buying_cost = $total_buying_cost*$data->quantity;
        // $history->total_cost = $cost_per_qty*$quantity;
        // $history->save();
        $notification=array(
            'message' => 'Successfully Updated Quantity',
            'alert-type' => 'success'
        );
        return redirect()->route('product.index')->with($notification);
    }
    public function add_product_stock($id){
        $categories = Category::where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $supplier = Suplier::where('status',1)->get();
        $cost_type = Product_cost::where('product_id',$id)->get();
        $product_by_id = Product::where('id',$id)->first();
        $colors = Color::where('status',1)->get();
        $product_color = ColorWiseProduct::where('product_id',$id)->get();
        return view('admin.product.add_stock',compact('colors','categories','brands','supplier','product_by_id','cost_type','product_color'));
    }
    public function get_reduce_product_information(Request $request){
        $data = Product::where('id',$request->id)->first();
        $quantity = ColorWiseProduct::where('product_id',$request->id)->get();
        return view('admin.product.reduce_stock',compact('data','quantity'));
    }
    public function reduce_quantity(Request $request){
        $color_id = $request->color_id;
        $quantity_v = $request->quantity;
        $reduce  = 0;
        foreach($color_id as $key=>$value){
            $product_by_id = ColorWiseProduct::where(['product_id'=>$request->product_id,'color_id'=>$value])->first();
            $product = ColorWiseProduct::where(['product_id'=>$request->product_id,'color_id'=>$value])->first();
            $product->total_transfer = $quantity_v[$key];
            $available_quantity = $product_by_id->available_quantity-$quantity_v[$key];
            $reduce += $quantity_v[$key];
            $product->reduce_qty=$reduce+$quantity_v[$key];
            $product->available_quantity = $available_quantity;
            $product->save();
            $reduce_report = new ReducedReport();
            $reduce_report->product_id = $request->product_id;
            $reduce_report->color_id = $value;
            $reduce_report->user_id = Auth::user()->id;
            $reduce_report->quantity = $quantity_v[$key];
            $reduce_report->reason = $request->reason;
            $reduce_report->save();
        }

        $product = Product::find($request->product_id);
        $data = Product::find($request->product_id);
        $data->available_quantity=$product->available_quantity-$reduce;
        $reduce_qty =  $product->reduce_qty;
        $data->reduce_qty=$reduce_qty+$reduce;
        $data->save();
        
        $notification=array(
            'message' => 'Successfully Reduced Quantity',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function product_index(){
        $products = ColorWiseProduct::OrderBy('id','desc')->get();
        return view('admin.product.manage',compact('products'));
    }
}
