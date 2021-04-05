<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ShopAddress;
use Illuminate\Http\Request;
use Image;

class ShopAddressController extends Controller
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
        $data = ShopAddress::first();
        return view('admin.shop_address.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->shop_id){
            $validatedData = $request->validate([
                'name' => 'required',
            ]);
            $data = ShopAddress::where('id',$request->shop_id)->first();
            $data->name=$request->name;
            $data->email=$request->email;
            $data->phone=$request->phone;
            $data->address1=$request->address1;
            $data->address2=$request->address2;
            $data->website_url=$request->website_url;
            if($request->hasFile('image')) {
                $image = $request->image;
                $filename = $image->getClientOriginalName();
                $filename = preg_replace('/\s+/', '-', $filename);
                $folder = 'uploads/'.date('Y').'/'.date('m');
                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                }
                $brand_banner = $folder.'/'. time() . '-' . $filename;
                Image::make($image)->resize(300, 300)->save($brand_banner);
                $data->image = asset($brand_banner);
            }
            $data->save();
            $notification=array(
                'message' => 'Successfully Updated',
                'alert-type' => 'success'
            );
        }else{
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        $data = new ShopAddress();
        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->address1=$request->address1;
        $data->address2=$request->address2;
        $data->website_url=$request->website_url;
        if($request->hasFile('image')) {
            $image = $request->image;
            $filename = $image->getClientOriginalName();
            $filename = preg_replace('/\s+/', '-', $filename);
            $folder = 'uploads/'.date('Y').'/'.date('m');
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
            }
            $brand_banner = $folder.'/'. time() . '-' . $filename;
            Image::make($image)->resize(300, 300)->save($brand_banner);
            $data->image = asset($brand_banner);
        }
        $data->save();
        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
    }
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
