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
use App\Http\Resources\cartResource;
use App\Http\Resources\productResource;
use Illuminate\Support\Facades\DB;


class purchaseController extends Controller
{
//     public function addPurchase(){
//         $carteds = AddedToCartProduct::where('buyer_id', Auth::id())->get();
//         if($carteds->isEmpty()) return 'no items in cart';

//         foreach ($carteds as $carted) {
//             if($carted->quantity > $carted->product->quantity) return 'no enough products';
//         }
        
//         $purchase = purchase::create([
//             'buyer_id'=> Auth::id(),
//             'state'=>'not delivered'
//         ]);

//         $purchaeds = collect();        

//         foreach ($carteds as $carted) {
//     $purchaed = PurchasedProduct::create([
//         // 'product_id' => $carted->product_id,
//         'buyer_id' => $carted->buyer_id,
//         'quantity' => $carted->quantity,
//         'purchase_id' => $purchase->id,
//         'references' => $carted->product_id
//     ]);
//         $carted->product->quantity-=$purchaed->quantity;
//         $carted->product->save();
//         $productID = $carted->product->id;
//         $productQ = $carted->product->quantity;
//         $carted->delete();

//        $decreasedProducts = AddedToCartProduct::where('product_id', '=', $productID)
//     ->where('quantity', '>', $productQ)
//     ->get();

//     $user = User::find($purchaed->buyer_id);
//     $user->cart -= $purchaed->quantity;
//     $user->save();
    

// foreach ($decreasedProducts as $product) {
//     $user = User::find($product->buyer_id);
//     if ($user) {
//         $user->update([
//             'cart' => ($user->cart - ($product->quantity - $productQ)) // Replace 'another_column' and $anotherValue with your actual column and value
//         ]);
//     }
//     $product->update([
//         'quantity' => $productQ,
//     ]);
//     }
//     $purchaeds->push($purchaed);
// }
//         return $purchaeds;
//     }

    // public function getPurchases(){

    //     $user = User::find(Auth::id()); // Replace $userId with the actual user ID
    //     $purchases = $user->purchases()->with('purchasedProducts')->get();
    //     return $purchases;
    // }

    // public function deliveredPurchase($id){

    //     $user = User::find(Auth::id()); // Replace $userId with the actual user ID
    //     $purchase = $user->purchases()->with('purchasedProducts')->get()->find($id);
    //     $purchase->state = 'delivered';
    //     $purchase->save();
    //     return $purchase;
    // }

    // public function getUser(){
    //     $user = User::find(Auth::id());
    //     return  $user;
    // }

    //========================================================================================

    public function addPurchase()
{
    try {
        return DB::transaction(function () {
            $carteds = AddedToCartProduct::where('buyer_id', Auth::id())->get();

            if ($carteds->isEmpty()) {
                return response()->json(['error' => 'No items in cart'], 400);
            }

            foreach ($carteds as $carted) {
                if ($carted->quantity > $carted->product->quantity) {
                    return response()->json(['error' => 'Not enough products in stock'], 400);
                }
            }

            $purchase = Purchase::create([
                'buyer_id' => Auth::id(),
                'state' => 'not delivered',
            ]);

            $purchasedProducts = collect();

            foreach ($carteds as $carted) {
                $purchased = PurchasedProduct::create([
                    'buyer_id' => $carted->buyer_id,
                    'quantity' => $carted->quantity,
                    'purchase_id' => $purchase->id,
                    'references' => $carted->product_id,
                ]);

                $carted->product->quantity -= $purchased->quantity;
                $carted->product->save();

                $user = User::find($purchased->buyer_id);
                $user->cart -= $purchased->quantity;
                $user->save();

                $purchasedProducts->push($purchased);
                $carted->delete();
            }

            return response()->json(['message' => 'Purchase successful', 'purchasedProducts' => cartResource::collection($purchasedProducts)]);
        });
    } catch (\Exception $e) {
        return response()->json(['error' => 'Purchase failed'], 500);
    }
}

public function getPurchases()
{
    try {
        $user = User::find(Auth::id());

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $purchases = $user->purchases()
        ->with('purchasedProducts')
        ->get();
// dd($purchases);
        return response()->json([
            'purchases' => purchaseResource::collection($purchases)

        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to retrieve purchases'], 500);
    }
}

public function deliveredPurchase($id)
{
    try {
        $user = User::find(Auth::id());

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if ($user->role != 'admin') {
            return response()->json(['error' => 'unauthorized'], 401);
        }

        $purchase = $user->purchases()->with('purchasedProducts')->find($id);

        if (!$purchase) {
            return response()->json(['error' => 'Purchase not found'], 404);
        }

        $purchase->state = 'delivered';
        $purchase->save();

        return response()->json(['message' => 'Purchase marked as delivered', 'purchase' => new PurchaseResource ($purchase)]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to update purchase state'], 500);
    }
}

public function getUser()
{
    try {
        $user = User::find(Auth::id());

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json(['user' => $user]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to retrieve user'], 500);
    }
}
}
