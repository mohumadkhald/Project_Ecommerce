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

        foreach ($carteds as $carted) {
            if($carted->quantity > $carted->product->quantity) return 'no enough products';
        }
        
        $purchase = purchase::create([
            'buyer_id'=> Auth::id(),
            'state'=>'not delivered'
        ]);

        $purchaeds = collect();        

        foreach ($carteds as $carted) {
    // Create a new record in the target table with the same values plus an additional column
    $purchaed = PurchasedProduct::create([
        // 'product_id' => $carted->product_id,
        'buyer_id' => $carted->buyer_id,
        'quantity' => $carted->quantity,
        'purchase_id' => $purchase->id,
        'references' => $carted->product_id
    ]);
        $carted->product->quantity-=$purchaed->quantity;
        $carted->product->save();
        $productID = $carted->product->id;
        $productQ = $carted->product->quantity;
        $carted->delete();

       $decreasedProducts = AddedToCartProduct::where('product_id', '=', $productID)
    ->where('quantity', '>', $productQ)
    ->get();

    // $q = $carted->quantity;
    $user = User::find($purchaed->buyer_id);
    $user->cart -= $purchaed->quantity;
    $user->save();
    

foreach ($decreasedProducts as $product) {
    // Assuming there is a relationship method on AddedToCartProduct to access the RelatedModel
    $user = User::find($product->buyer_id);
    if ($user) {
        // Update the second column
        // dd($productQ);
        $user->update([
            'cart' => ($user->cart - ($product->quantity - $productQ)) // Replace 'another_column' and $anotherValue with your actual column and value
        ]);
        // dd($user->cart);
    }
    $product->update([
        'quantity' => $productQ,
    ]);
    }
    $purchaeds->push($purchaed);
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

    public function getUser(){
        $user = User::find(Auth::id());
        return  $user;
    }
}
