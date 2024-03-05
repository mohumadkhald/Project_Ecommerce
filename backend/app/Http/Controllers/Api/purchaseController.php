<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchasedProduct;
use App\Models\AddedToCartProduct;
use App\Models\Purchase;
use App\Models\User;

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
        'purchase_id' => $purchase->id // Replace 'your_value' with the actual value for the new column
    ]);

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

        return $purchases;
    }

    public function deliveredPurchase($id){

        $user = User::find(Auth::id()); // Replace $userId with the actual user ID
        // dd($user);
        $purchase = $user->purchases()->with('purchasedProducts')->get()->find($id);
        $purchase->state = 'delivered';
        $purchase->save();
        return $purchase;
    }
}
