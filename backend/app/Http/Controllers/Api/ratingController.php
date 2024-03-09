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
use App\Http\Resources\productResource;
use App\Http\Resources\cartResource;

class ratingController extends Controller
{
    // public function addRating($id, Request $request)
    // {
    //     $request->validate([
    //     'rating' => ['required', 'numeric', 'min:1', 'max:5'],
    // ]);
    //    $PurchasedProduct = PurchasedProduct::find($id);
    // //    if($PurchasedProduct->rating != null) return 'already submitted';
    //    $PurchasedProduct->rating = $request->rating;
    //    $PurchasedProduct->save();
    //    $product = Product::find($PurchasedProduct->references);
    //    if($PurchasedProduct->references === null) return 'product not available';
    // //    $ratings = PurchasedProduct::
    //     $results = PurchasedProduct::where('references', $PurchasedProduct->references)->get();
    //     $averageRating = $results->avg('rating');
    //     $product->rating = $averageRating;
    //     // dd($product->rating);
    //     $product->save();
    //     // return;
    //     $product->image_path = asset('storage/' . $product->image);
    //     return new productResource($product);
    // }

    //==================================================================

    public function addRating($id, Request $request)
    {
        try {
            $request->validate([
                'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            ]);

            return DB::transaction(function () use ($id, $request) {
                $purchasedProduct = PurchasedProduct::find($id);

                if (!$purchasedProduct) {
                    return response()->json(['error' => 'Purchased product not found'], 404);
                }

                $purchasedProduct->rating = $request->rating;
                $purchasedProduct->save();

                $product = Product::find($purchasedProduct->references);

                if (!$product) {
                    return response()->json(['error' => 'Associated product not found'], 404);
                }

                $results = PurchasedProduct::where('references', $purchasedProduct->references)->get();
                $averageRating = $results->avg('rating');
                $product->rating = $averageRating;
                $product->save();

                return response()->json(['message' => 'Rating added successfully', 'product' => new ProductResource($product)]);
            });
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to add rating'], 500);
        }
    }

}
