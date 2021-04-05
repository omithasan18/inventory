<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\Wear_house;
use Illuminate\Http\Request;
use DB;

class WearHouseController extends Controller
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
        $role = Role::where('id',3)->first();
        $datas = Wear_house::orderBy('id','desc')->get();
        return view('admin.wear_house.manage',compact('role','datas'));
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
        $data =new Wear_house();
        $data->wear_house_name=$request->wear_house_name;
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
        $role = Role::where('id',3)->first();
        $datas = Wear_house::orderBy('id','desc')->get();
        $data_id = Wear_house::where('id',$id)->first();
        return view('admin.wear_house.edit',compact('role','datas','data_id'));
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
        $data =Wear_house::find($id);
        $data->wear_house_name=$request->wear_house_name;
        $data->location=$request->location;
        // $data->role_id=$request->role_id;
        $data->phone=$request->phone;
        $data->status=$request->status;
        $data->save();
        $notification=array(
            'message' => 'Successfully updated',
            'alert-type' => 'warning'
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
    public function active_wear_house($id){
        $data = Wear_house::find($id);
        $data->status = 1;
        $data->save();
        $notification=array(
            'message' => 'Successfully Activated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function inactive_wear_house($id){
        $data = Wear_house::find($id);
        $data->status = 0;
        $data->save();
        $notification=array(
            'message' => 'Successfully DeActivated',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }
    public function get_wearhouseProduct_history(Request $request){
        $products= DB::table('wearhouse_products')
                ->join('products', 'wearhouse_products.product_id', '=', 'products.id')
                ->join('supliers', 'products.supplier_id', '=', 'supliers.id')
                // ->join('admin_registers', 'products.admin_id', '=', 'admin_registers.id')
                ->select('wearhouse_products.*','products.*','supliers.supplier_name')
                ->OrderBy('wearhouse_products.id','desc')->where(['products.status'=>1,'wearhouse_products.wear_house_id'=>$request->ware_house_id])->get();
        // $products = Product::OrderBy('id','desc')->where(['status'=>1,'distributed_id'=>$request->distributed_id])->get();
        
        return view('admin.product_history.get_warehouse_product',compact('products'));
    }
}
