<?php

namespace App\Http\Controllers\Api;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\productResource;
use App\Models\User;

use Exception;
// use Illuminate\Http\Request;
use Psy\Readline\Hoa\FileException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class productController extends Controller
{
    
//     public function getProducts(){ //buyer
//         $userId = Auth::id();
// // dd($userId);
//     // Retrieve posts where user_id is not the authenticated user's ID
//     $products = Product::where('user_id', '!=', $userId)->WhereNull('deleted')->get();
//     $products->each(function ($product) {
//     $product->image_path = asset('storage/' . $product->image);
// });
// // dd($products);
//     return productResource::collection($products);
// }

//     public function getMyProducts(){ //seller
//         $userId = Auth::id();
//     $products = Product::where('user_id', $userId)->WhereNull('deleted')->get();
//     $products->each(function ($product) {
//     $product->image_path = asset('storage/' . $product->image);
// });
//     return productResource::collection($products);
//     }

    // public function addProduct(Request $request){ //seller
    //     $request->validate([
    //     'description' => ['required', 'string', 'max:255'],
    //     'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // adjust the file type and size as needed
    //     'title' => ['required', 'string', 'max:255'],
    //     'price' => ['required', 'numeric', 'min:0'],
    //     'category_id' => ['required', 'exists:categories,id'],
    //     'quantity' => ['nullable', 'integer', 'min:0'],
    // ]);
    //     $product = new Product();
    //     $imagePath = $request->file('image')->store('images/posts', 'public');
    //     $product->description = $request->description;
    //     $product->image = $imagePath;
    //     $product->title = $request->title;
    //     $product->price = $request->price;
    //     $product->category_id = $request->category_id;  
    //     if($request->quantity) $product->quantity = $request->quantity;
    //     $product->user_id = $request->user()->id;
    //     $product->save();
    //     $product->image_path = asset('storage/' . $imagePath);
    //     return $product;
    // }


    // public function updateProduct($id, Request $request){ //seller
    //     $product = Product::find($id);
    //     // dd($request->description);
    //     if($request->description) $product->description = $request->description;
    //     if($request->image) $product->image = $request->image;
    //     if($request->title) $product->title = $request->title;
    //     if($request->quantity) $product->quantity = $request->quantity;
    //     $product->save();
    //     return $product;
    // }


    // public function getProduct($id, Request $request){ //both
    //     $Product = Product::find($id);
    //     $Product->image_path = asset('storage/' . $Product->image);
    //     // $post->save();
    //     // return $Product;
    //     return new productResource($Product);
    // }


    // public function deleteProduct($id){ //seller,admin
    //     $Product = Product::find($id);
    //     $user = user::find(Auth::id());
    //     if($user->role != 'admin') $Product->deleted='user';
    //     else $Product->deleted='admin';
    //     $Product->save();
    //     return $Product;
    // }

    // public function terminateProduct($id){ //admin
    //     $Product = Product::find($id);
    //     $Product->delete();
    //     return $Product;
    // }

    // public function restoreProduct($id){ //admin
    //     $Product = Product::find($id);
    //     $Product->deleted=null;
    //     $Product->save();
    //     return $Product;
    // }

    //=====================================================================================

    public function getProducts()
{
    try {
        $userId = Auth::id();

        $products = Product::where('user_id', '!=', $userId)->whereNull('deleted')->get();

        $products->each(function ($product) {
            $product->image_path = asset('storage/' . $product->image);
        });

        return ProductResource::collection($products);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Something went wrong'], 500);
    }
}

public function getMyProducts()
{
    try {
        $userId = Auth::id();

        $products = Product::where('user_id', $userId)->whereNull('deleted')->get();

        $products->each(function ($product) {
            $product->image_path = asset('storage/' . $product->image);
        });

        return ProductResource::collection($products);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Something went wrong'], 500);
    }
}

public function addProduct(Request $request)
{
    try {
        $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'quantity' => ['nullable', 'integer', 'min:0'],
        ]);

        $product = new Product();
        // $imagePath = $request->file('image')->store('images/posts', 'public');
        $product->description = $request->description;
        // $product->image = $imagePath;
        if ($request->hasFile('image')) {
                $path = 'assets/uploads/products/' . $product->image;


            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;

            try {
                $file->move('assets/uploads/products', $fileName);
            } catch (FileException $e) {
                return response()->json('An error occurred while processing your request', 500);
            }

            $product->image = $path . $fileName;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->quantity = $request->input('quantity', 0);
        $product->user_id = $request->user()->id;
        $product->category_id = $request->category_id;
        $product->save();

        // $product->image_path = asset('storage/' . $imagePath);

        return response()->json(['message' => 'Product added successfully', 'product' => $product]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Something went wrong'], 500);
    }
}

public function updateProduct($id, Request $request)
{
    try {
        $product = Product::findOrFail($id);

        $request->validate([
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer|min:0',
        ]);

        if ($request->description) {
            $product->description = $request->description;
        }

        if ($request->hasFile('image')) {
            // Handle file upload
            $imagePath = $request->file('image')->store('images/posts', 'public');
            $product->image = $imagePath;
        }

        if ($request->title) {
            $product->title = $request->title;
        }

        if ($request->quantity) {
            $product->quantity = $request->quantity;
        }

        $product->save();

        $product->image_path = asset('storage/' . $product->image);

        return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Something went wrong'], 500);
    }
}

public function getProduct($id, Request $request)
{
    try {
        $product = Product::findOrFail($id);
        $product->image_path = asset('storage/' . $product->image);

        return new ProductResource($product);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Product not found'], 404);
    }
}

public function deleteProduct($id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    $user = Auth::user();

    if ($user->role != 'admin') {
        $product->deleted = 'user';
    } else {
        $product->deleted = 'admin';
    }

    $product->save();

    return response()->json(['message' => 'Product deleted successfully', 'product' => $product]);
}

public function terminateProduct($id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    $product->delete();

    return response()->json(['message' => 'Product terminated successfully', 'product' => $product]);
}

public function restoreProduct($id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    $product->deleted = null;
    $product->save();

    return response()->json(['message' => 'Product restored successfully', 'product' => $product]);
}

}
