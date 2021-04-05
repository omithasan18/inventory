<?php

namespace App\Http\Controllers\Admin;

use App\Distributed;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class DistributedController extends Controller
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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Distributed::get();
        return view('admin.distributed.manage',compact('datas'));
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
            'location' => 'required',
        ]);
        $data =new Distributed();
        $data->distributed_name=$request->distributed_name;
        $data->location=$request->location;
        // $data->role_id=$request->role_id;
        $data->phone=$request->phone;
        $data->status=$request->status;
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
        $datas = Distributed::get();
        $distributed = Distributed::where('id',$id)->first();
        return view('admin.distributed.edit',compact('datas','distributed'));
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
            'location' => 'required',
        ]);
        $data =Distributed::find($id);
        $data->distributed_name=$request->distributed_name;
        $data->location=$request->location;
        // $data->role_id=$request->role_id;
        $data->phone=$request->phone;
        $data->status=$request->status;
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
    public function active_distributed($id){
        $data = Distributed::find($id);
        $data->status = 1;
        $data->save();
        $notification=array(
            'message' => 'Successfully Activated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function inactive_distributed($id){
        $data = Distributed::find($id);
        $data->status = 0;
        $data->save();
        $notification=array(
            'message' => 'Successfully DeActivated',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }
    public function distributed_products(){
        $products = DB::table('distributed_products')
            ->join('products', 'distributed_products.product_id', '=', 'products.id')
            ->join('colors', 'products.color_id', '=', 'colors.id')
            ->select('distributed_products.*', 'products.title','products.product_code','products.supplier_code','products.status','colors.color_name')
            // ->where(['distributed_id'=>Auth::user()->id])
            ->get();
        return view('admin.product_history.distributed',compact('products'));
    }
    public function get_distributedProduct_history(Request $request){
        $products = DB::table('distributed_products')
            ->join('products', 'distributed_products.product_id', '=', 'products.id')
            ->select('distributed_products.*', 'products.title','products.product_code','products.supplier_code','products.status')
            ->OrderBy('distributed_products.id','desc')
            ->where(['distributed_id'=>$request->distributed_id,'products.status'=>1])
            ->get();
            return view('admin.product_history.get_distributed_product',compact('products'));
    }
}
