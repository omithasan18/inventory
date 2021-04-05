<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Color;
use App\ColorWiseProduct;

class ColorController extends Controller
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $color_datas = Color::orderBy('id','desc')->get();
        return view('admin.color.manage_color',compact('color_datas'));
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
            'color_name' => 'required',
        ]);
        $data = new Color();
        $data->color_name=$request->color_name;
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
        $color_datas = Color::get();
        $color_by_id = Color::where('id',$id)->first();
        return view('admin.color.edit_color',compact('color_datas','color_by_id'));
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
        $data = Color::find($id);
        $data->color_name=$request->color_name;
        $data->status=$request->status;
        $data->save();
        $notification=array(
            'message' => 'Successfully Updated',
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
        $data = ColorWiseProduct::where('color_id',$id)->count();
        
        if($data > 0)
        {
            $notification=array(
                'message' => 'Already Use Other Table.So you are not Delete this Data ',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
        $data = Color::find($id);
        $data->delete();
        $notification=array(
            'message' => 'Successfully Deleted',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
    public function active_color($id){
        $data = Color::find($id);
        $data->status = 1;
        $data->save();
        $notification=array(
            'message' => 'Successfully Activated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function inactive_color($id){
        $data = Color::find($id);
        $data->status = 0;
        $data->save();
        $notification=array(
            'message' => 'Successfully DeActivated',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }
}
