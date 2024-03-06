<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchasedProduct;
use App\Models\AddedToCartProduct;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\User;
use App\Http\Resources\purchaseResource;

class purchaseController extends Controller
{
    public function addPurchase(){
        $carteds = AddedToCartProduct::where('buyer_id', Auth::id())->get();
        // dd($carteds->isEmpty());
        if($carteds->isEmpty()) return 'no items in cart';

        $purchase = purchase::create([
            'buyer_id'=> Auth::id(),
            'state'=>'not delivered'
        ]);

        $purchaeds = collect();        

        foreach ($carteds as $carted) {
    // Create a new record in the target table with the same values plus an additional column
    $purchaed = PurchasedProduct::create([
        'product_id' => $carted->product_id,
        'buyer_id' => $carted->buyer_id,
        'quantity' => $carted->quantity,
        'purchase_id' => $purchase->id,
        'references' => $carted->product_id
    ]);

    // if($purchaed->quantity == $carted->product->quantity) 
    // {
    //     $carted->product->quantity=0 ;
    //     $carted->product->save();
    // }
    
    // else {
        // dd($carted->product);
        $newrecord = Product::create([
        'user_id' => $carted->product->user_id,
        'description' => $carted->product->description,
        'title' => $carted->product->title,
        'image' => $carted->product->image, // Replace 'your_value' with the actual value for the new column
        'price' => $carted->product->price,
        'quantity' => 0,
        'hidden' => 'yes'
    ]);
    // dd($newrecord);
        $carted->product->quantity-=$purchaed->quantity;
        $carted->product->save();
        $purchaed->product_id = $newrecord->id;
        $purchaed->save();
        // $purchaed->quantity = $newrecord->id;
    // }

    $purchaeds->push($purchaed);

        $q = $carted->quantity;
        // AddedToCartProduct::destroy($id);
        $carted->delete();
        $carted->product->user->cart-=$q;
        $carted->product->user->save();
}


        return $purchaeds;
    }

    public function getPurchases(){

        $user = User::find(Auth::id()); // Replace $userId with the actual user ID
        // dd($user);
        $purchases = $user->purchases()->with('purchasedProducts')->get();
        return purchaseResource::collection($purchases);
    }

    public function deliveredPurchase($id){

        $user = User::find(Auth::id()); // Replace $userId with the actual user ID
        // dd($user);
        $purchase = $user->purchases()->with('purchasedProducts')->get()->find($id);
        $purchase->state = 'delivered';
        $purchase->save();
        return $purchase;
    }

    public function getUser(){
        $user = User::find(Auth::id());
        return  $user;
    }
}
