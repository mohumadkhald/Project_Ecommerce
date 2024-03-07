<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddedToCartProduct;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\cartResource;
use App\Models\User;
use App\Models\Product;

class cartController extends Controller
{
    public function add($id, Request $request){
        $carted = AddedToCartProduct::where('product_id', $id)->where('buyer_id', Auth::id())->first();
        if($carted) return $this->increase($id);
        else {
           $product = product::find($id);
           if($product->quantity==0) return 'product not available';
        $carted = AddedToCartProduct::create([
            'product_id' => $id,
            'buyer_id' => $request->user()->id,
            'quantity' => 1
        ]);
        $user = User::find($carted->buyer_id);
        $user->cart++;
        $user->save();
        $carted->save();
        return $carted;
    }
    }

    public function increase($id){
        $carted = AddedToCartProduct::where('product_id', $id)->where('buyer_id', Auth::id())->first();
        if($carted->quantity == $carted->product->quantity) return 'no enough products';
        $carted->quantity++;
        $user = User::find($carted->buyer_id);
        $user->cart++;
        $user->save();
        $carted->save();
        return $carted;
    }

    public function decrease($id){
        $carted = AddedToCartProduct::where('product_id', $id)->where('buyer_id', Auth::id())->first();
        if($carted->quantity > $carted->product->quantity+1) 
        {
            $carted->quantity = $carted->product->quantity;
            return $carted;
        }
        if($carted->quantity==1)
        {
            $carted->delete();
            $user = User::find($carted->buyer_id);
            $user->cart--;
            $user->save();
            return 'removed from cart';
        }
        $carted->quantity--;
        $user = User::find($carted->buyer_id);
        $user->cart--;
        $user->save();
        $carted->save();
        return $carted;     
    }

    public function myCart(Request $request){
        $userId = Auth::id();
        $carteds = AddedToCartProduct::where('buyer_id', $userId)->get();
        if($carteds->isEmpty()) return 'no items in cart';
        return cartResource::collection($carteds);
    }

    public function delete($id, Request $request){
        $carted = AddedToCartProduct::where('product_id', $id)->where('buyer_id', Auth::id())->first();
        $user = User::find($carted->buyer_id);
        $user->cart -= $carted->quantity;
        $user->save();
        $carted->delete();
        return 'removed from cart';
    }
}
