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
    // public function add($id, Request $request){
    //     $carted = AddedToCartProduct::where('product_id', $id)->where('buyer_id', Auth::id())->first();
    //     if($carted) return $this->increase($id);
    //     else {
    //        $product = product::find($id);
    //        if($product->quantity==0) return 'product not available';
    //     $carted = AddedToCartProduct::create([
    //         'product_id' => $id,
    //         'buyer_id' => $request->user()->id,
    //         'quantity' => 1
    //     ]);
    //     $user = User::find($carted->buyer_id);
    //     $user->cart++;
    //     $user->save();
    //     $carted->save();
    //     return $carted;
    // }
    // }

    // public function increase($id){
    //     $carted = AddedToCartProduct::where('product_id', $id)->where('buyer_id', Auth::id())->first();
    //     if($carted->quantity == $carted->product->quantity) return 'no enough products';
    //     $carted->quantity++;
    //     $user = User::find($carted->buyer_id);
    //     $user->cart++;
    //     $user->save();
    //     $carted->save();
    //     return $carted;
    // }

    // public function decrease($id){
    //     $carted = AddedToCartProduct::where('product_id', $id)->where('buyer_id', Auth::id())->first();
    //     if($carted->quantity > $carted->product->quantity+1) 
    //     {
    //         $carted->quantity = $carted->product->quantity;
    //         return $carted;
    //     }
    //     if($carted->quantity==1)
    //     {
    //         $carted->delete();
    //         $user = User::find($carted->buyer_id);
    //         $user->cart--;
    //         $user->save();
    //         return 'removed from cart';
    //     }
    //     $carted->quantity--;
    //     $user = User::find($carted->buyer_id);
    //     $user->cart--;
    //     $user->save();
    //     $carted->save();
    //     return $carted;     
    // }

    // public function myCart(Request $request){
    //     $userId = Auth::id();
    //     $carteds = AddedToCartProduct::where('buyer_id', $userId)->get();
    //     if($carteds->isEmpty()) return 'no items in cart';
    //     return cartResource::collection($carteds);
    // }

    // public function delete($id, Request $request){
    //     $carted = AddedToCartProduct::where('product_id', $id)->where('buyer_id', Auth::id())->first();
    //     $user = User::find($carted->buyer_id);
    //     $user->cart -= $carted->quantity;
    //     $user->save();
    //     $carted->delete();
    //     return 'removed from cart';
    // }

    //=================================================================================================

    public function add($id, Request $request)
{
    $user = $request->user();

    if (!$user) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $carted = $user->cartedProducts()->where('product_id', $id)->first();

    if ($carted) {
        return $this->increase($id);
    } else {
        $product = Product::find($id);

        if ($product->quantity == 0) {
            return response()->json(['error' => 'Product not available'], 400);
        }

        $carted = $user->cartedProducts()->create([
            'product_id' => $id,
            'quantity' => 1,
        ]);

        $user->increment('cart');

        return response()->json(['message' => 'Product added to cart', 'carted' => $carted]);
    }
}

public function increase($id)
{
    $carted = AddedToCartProduct::where('product_id', $id)->where('buyer_id', Auth::id())->first();

    if ($carted->quantity == $carted->product->quantity) {
        return response()->json(['error' => 'Not enough products'], 400);
    }

    $carted->quantity++;

    $user = User::find($carted->buyer_id);
    $user->cart++;
    $user->save();

    $carted->save();

    return response()->json(['message' => 'Product quantity increased', 'carted' => $carted]);
}

public function decrease($id)
{
    $carted = AddedToCartProduct::where('product_id', $id)->where('buyer_id', Auth::id())->first();

    if ($carted->quantity > $carted->product->quantity + 1) {
        $carted->quantity = $carted->product->quantity;
        $carted->save();

        return response()->json(['message' => 'Product quantity set to maximum', 'carted' => $carted]);
    }

    if ($carted->quantity == 1) {
        $carted->delete();

        $user = User::find($carted->buyer_id);
        $user->cart--;
        $user->save();

        return response()->json(['message' => 'Product removed from cart']);
    }

    $carted->quantity--;

    $user = User::find($carted->buyer_id);
    $user->cart--;
    $user->save();

    $carted->save();

    return response()->json(['message' => 'Product quantity decreased', 'carted' => $carted]);
}

public function myCart(Request $request)
{
    $userId = Auth::id();
    $carteds = AddedToCartProduct::where('buyer_id', $userId)->get();

    if ($carteds->isEmpty()) {
        return response()->json(['message' => 'No items in cart']);
    }

    return response()->json(['carted' => CartResource::collection($carteds)]);
}

public function delete($id, Request $request)
{
    $carted = AddedToCartProduct::where('product_id', $id)->where('buyer_id', Auth::id())->first();

    if (!$carted) {
        return response()->json(['error' => 'Product not found in cart'], 404);
    }

    $user = User::find($carted->buyer_id);
    $user->cart -= $carted->quantity;
    $user->save();

    $carted->delete();

    return response()->json(['message' => 'Product removed from cart']);
}


}
