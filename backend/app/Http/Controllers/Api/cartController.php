<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddedToCartProduct;
use Illuminate\Support\Facades\Auth;


class cartController extends Controller
{
    public function add($id, Request $request){
        $carted = AddedToCartProduct::where('product_id', $id)->where('buyer_id', Auth::id())->first();
        // dd($carted);
        if($carted) {
            // $id2 = $carted->id;
            // dd($id2);
            return $this->increase($id);
        }
        else {
        $carted = AddedToCartProduct::create([
            'product_id' => $id,
            'buyer_id' => $request->user()->id,
            'quantity' => 1
        ]);
        $carted->product->user->cart++;
        $carted->product->user->save();
        $carted->save();
        return $carted;
    }
    }

    public function increase($id){
        // $carted = AddedToCartProduct::find($id);
        $carted = AddedToCartProduct::where('product_id', $id)->where('buyer_id', Auth::id())->first();
        // dd($carted->product->quantity);
                // dd($carted->product->user->cart);

        if($carted->quantity == $carted->product->quantity) return 'no enough products';
        $carted->quantity++;
        $carted->product->user->cart++;
        $carted->product->user->save();
        $carted->save();
        return $carted;
    }

    public function decrease($id){
        // $carted = AddedToCartProduct::find($id);
        $carted = AddedToCartProduct::where('product_id', $id)->where('buyer_id', Auth::id())->first();
        if($carted->quantity==1)
        {
            $carted->delete();
            return 'removed from cart';
        }
        $carted->quantity--;
        $carted->product->user->cart--;
        $carted->product->user->save();
        $carted->save();
        return $carted;     
    }

    public function myCart(Request $request){
        $userId = Auth::id();
        $carteds = AddedToCartProduct::where('buyer_id', $userId)->get();
        if($carteds->isEmpty()) return 'no items in cart';
        return $carteds;
    }

    public function delete($id, Request $request){
        $carted = AddedToCartProduct::where('product_id', $id)->where('buyer_id', Auth::id())->first();
        $q = $carted->quantity;
        // AddedToCartProduct::destroy($id);
        $carted->delete();
        $carted->product->user->cart-=$q;
        $carted->product->user->save();
        return 'removed from cart';
    }
}
