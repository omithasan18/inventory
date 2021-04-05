<?php

namespace App\Http\Controllers\Admin;

use App\Distributed;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Wear_house;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Image;

class ManageUserController extends Controller
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
        $datas = User::get();
        return view('admin.user_management.manage',compact('datas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::where('status',1)->get();
        $wear_house = Wear_house::where('status',1)->get();
        $distributed = Distributed::where('status',1)->get();
        return view('admin.user_management.add',compact('role','wear_house','distributed'));
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
            'name' => 'required',
            'phone' => 'required',
            // 'location_id' => 'required',
            'role_id' => 'required',
            'designation' => 'required',
            'password' => 'required',
        ]);
        $data = new User();
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->user_type = $request->user_type;
        if($request->user_type==1){
           $wear_house = Wear_house::where('id',$request->location_id)->first();
           $data ->location_name = $wear_house->wear_house_name;
        }
        if($request->user_type==2){
            $wear_house = Distributed::where('id',$request->location_id)->first();
            $data ->location_name = $wear_house->distributed_name;
         }
        $data->location_id = $request->location_id;
        $data->role_id = $request->role_id;
        $data->designation = $request->designation;
        $data->address = $request->address;
        $data->password = Hash::make($request->password);
        $data->status = $request->status;
        if($request->hasFile('image')) {
            $image = $request->image;
            $filename = $image->getClientOriginalName();
            $filename = preg_replace('/\s+/', '-', $filename);
            $folder = 'uploads/'.date('Y').'/'.date('m');
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
            $feture_img = $folder.'/'. time() . '-' . $filename;
            Image::make($image)->resize(300, 300)->save($feture_img);
            $data->image = secure_asset($feture_img);
        }
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
        $role = Role::where('status',1)->get();
        $wear_house = Wear_house::where('status',1)->get();
        $distributed = Distributed::where('status',1)->get();
        $user_by_id = User::where('id',$id)->first(); 
        return view('admin.user_management.edit',compact('role','wear_house','distributed','user_by_id'));
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
            'name' => 'required',
            'phone' => 'required',
            // 'location_id' => 'required',
            'role_id' => 'required',
            'designation' => 'required',
            'password' => 'required',
        ]);
        $data = User::find($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->user_type = $request->user_type;
        if($request->user_type==1){
           $wear_house = Wear_house::where('id',$request->location_id)->first();
           $data ->location_name = $wear_house->wear_house_name;
        }
        if($request->user_type==2){
            $wear_house = Distributed::where('id',$request->location_id)->first();
            $data ->location_name = $wear_house->distributed_name;
         }
        $data->location_id = $request->location_id;
        $data->role_id = $request->role_id;
        $data->designation = $request->designation;
        $data->address = $request->address;
        $data->password = Hash::make($request->password);
        $data->status = $request->status;
        if($request->hasFile('image')) {
            $image = $request->image;
            $filename = $image->getClientOriginalName();
            $filename = preg_replace('/\s+/', '-', $filename);
            $folder = 'uploads/'.date('Y').'/'.date('m');
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
            $feture_img = $folder.'/'. time() . '-' . $filename;
            Image::make($image)->resize(300, 300)->save($feture_img);
            $data->image = secure_asset($feture_img);
        }
        $data->save();
        $notification=array(
            'message' => 'Successfully Updated',
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
    public function active_user($id){
        $data = User::find($id);
        $data->status = 1;
        $data->save();
        $notification=array(
            'message' => 'Successfully Activated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function inactive_user($id){
        $data = User::find($id);
        $data->status = 0;
        $data->save();
        $notification=array(
            'message' => 'Successfully DeActivated',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }
    public function profile(){
        $data = User::where('id',Auth::user()->id)->first();
        return view('admin.user_management.profile',compact('data'));
    }
    public function update_profile(Request $request){
        $id = Auth::user()->id;
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            // 'location_id' => 'required',

        ]);
        $data = User::find($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;
        if($request->hasFile('image')) {
            $image = $request->image;
            $filename = $image->getClientOriginalName();
            $filename = preg_replace('/\s+/', '-', $filename);
            $folder = 'uploads/'.date('Y').'/'.date('m');
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
            $feture_img = $folder.'/'. time() . '-' . $filename;
            Image::make($image)->resize(300, 300)->save($feture_img);
            $data->image = secure_asset($feture_img);
        }
        $data->save();
        $notification=array(
            'message' => 'Successfully Updated',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }
}
