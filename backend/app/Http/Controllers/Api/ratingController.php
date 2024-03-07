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
    public function addRating($id, Request $request)
    {
       $PurchasedProduct = PurchasedProduct::find($id);
    //    if($PurchasedProduct->rating != null) return 'already submitted';
       $PurchasedProduct->rating = $request->rating;
       $PurchasedProduct->save();
       $product = Product::find($PurchasedProduct->references);
       if($PurchasedProduct->references === null) return 'product not available';
    //    $ratings = PurchasedProduct::
        $results = PurchasedProduct::where('references', $PurchasedProduct->references)->get();
        $averageRating = $results->avg('rating');
        $product->rating = $averageRating;
        // dd($product->rating);
        $product->save();
        // return;
        $product->image_path = asset('storage/' . $product->image);
        return new productResource($product);
    }
    
}
