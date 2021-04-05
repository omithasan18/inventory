<?php

namespace App\Http\Controllers\Admin;

use App\DistributedProduct;
use App\Http\Controllers\Controller;
use App\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add_to_cart(Request $request){
        $product = DistributedProduct::find($request->id);
        $product_id = Product::find($product->product_id);
       $data = Cart::add([
        'id' => $request->id,
        'name' => $request->name,
        'price' => $request->price,
        'quantity' => $request->qty,
        'attributes' => [
            'product_id'=> $product->product_id,
            'color_id'=> $product->color_id,
            'color_name'=> $request->color_name,
            'product_code'=> $product_id->product_code,
        ]
       ]);
       if($data){
        $notification=array(
            'message' => 'Successfully Added',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
       }else{
        $notification=array(
            'message' => 'not Added',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
       }
    }
    public function cart_update(Request $request){
        // dd($id);
        // dd($request->id);
        $cart_id = $request->id;
        $quantity = $request->quantity;
        // dd($quantity);
        foreach($cart_id as $key=>$value){
            // dd($quantity[$key]);
            $update=Cart::update($value, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $quantity[$key]
                ),
              ));
        }
        
        // $update=Cart::update($id, array(
        //     'quantity' => $request->quantity, // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
        //   ));
        if($update){
            $notification=array(
                'message' => 'Successfully Added',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }
    public function cart_remove($id){
        $remove = Cart::remove($id);
        if($remove){
                    $notification=array(
                        'message' => 'Successfully Removed',
                        'alert-type' => 'success'
                    );
                    return redirect()->back()->with($notification);
                }
    }

}
