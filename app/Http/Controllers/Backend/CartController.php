<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add_to_cart(Request $request){
        
        $id = $request->id;    
        
        $product = Product::find($id);
        
        $cart = [
            'id' => $product->id,
            'name' => $product->name,
            'image' => $product->images[0]->image,
            'qty' => 1,
            'price' => $product->offer_price ?  $product->offer_price : $product->regular_price,
            'total' => $product->offer_price ?  $product->offer_price : $product->regular_price

        ];

        $newCart = [];
        $exist = false;
        if($request->session()->get('cart')){
            $sessionCart = $request->session()->get('cart');
            

            foreach($sessionCart as $singleCart){
                if($singleCart['id'] == $cart['id']){
                    $singleCart['qty']++;
                    $singleCart['total'] =  $cart['price']*$singleCart['qty'];
                    $exist = true;
                }
                array_push($newCart, $singleCart);
            }

            if(!$exist){
                array_push($newCart, $cart);
            }

        }else{
            array_push($newCart, $cart);
        }

        

        $request->session()->put('cart', $newCart);
        return $request->session()->get('cart');
    }


    public function get_cart(Request $request){
        return $request->session()->get('cart');
    }


    public function delete_cart(Request $request, $id){
        $carts = $this->get_cart($request);
        $newCart = [];
        if($carts){
            foreach($carts as $cart){
                if($cart['id'] != $id){
                    array_push($newCart, $cart);
                }
            }


        }

       
        $request->session()->put('cart', $newCart);
        

        return $this->get_cart($request);
    }


    public function update_cart(Request $request, $id){
        $carts = $this->get_cart($request);
        $newCart = [];
        if($carts):
            foreach($carts as $cart):
                if($cart['id']== $id):
                    $cart['qty'] = $request->qty;
                    $cart['total'] =  $cart['price']*$cart['qty'];
                endif;

                array_push($newCart, $cart);
            endforeach;
        endif;

        $request->session()->put('cart', $newCart);    

        return $this->get_cart($request);
    }
}
