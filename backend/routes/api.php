<?php

use App\Http\Controllers\Api\BrandsController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\productController;
use App\Http\Controllers\Api\erequestController;
use App\Http\Controllers\Api\cartController;
use App\Http\Controllers\Api\purchaseController;
use App\Http\Controllers\Api\ratingController;
use App\Http\Controllers\Api\userController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Models\User;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    $token = $user->createToken($request->device_name)->plainTextToken;
    return response()->json($token);

});


Route::prefix('products')->middleware('auth:sanctum')->group(function (){
Route::get('', [productController::class, 'getProducts']);   // get http://127.0.0.1:8000/api/products   (get all products as user)
Route::get('my', [productController::class, 'getMyProducts']); // get http://127.0.0.1:8000/api/products/my   (get my products as seller)
Route::post('', [productController::class, 'addProduct']);  // post http://127.0.0.1:8000/api/products   (add new product as seller)
Route::put('/{id}', [productController::class, 'updateProduct']);  // put http://127.0.0.1:8000/api/products/id   (update my product as seller and id is the product id)
Route::put('/{id}/delete', [productController::class, 'deleteProduct']);  // put http://127.0.0.1:8000/api/products/id/delete   (soft delete a product as seller or admin and id is the product id)
Route::put('/{id}/restore', [productController::class, 'restoreProduct']);  // put http://127.0.0.1:8000/api/products/id/restore   (get back the product from soft deletion as admin and id is the product id)
Route::delete('/{id}', [productController::class, 'terminateProduct']);  // delete http://127.0.0.1:8000/api/products/id   (delete a product completly from table as admin and id is the product id)
Route::get('{id}', [productController::class, 'getProduct']);  // get http://127.0.0.1:8000/api/products/id   (get a single product and id is the product id)
});

// Route::prefix('erequests')->middleware('auth:sanctum')->group(function (){
// Route::get('/sent', [erequestController::class, 'sentErequest']);
// Route::get('/received', [erequestController::class, 'receivedErequest']);
// Route::get('my', [postController::class, 'getMyPosts']);
// Route::post('/{id1}/{id2}', [erequestController::class, 'addErequest']);
// Route::put('/{id}/accept', [erequestController::class, 'acceptERequest']);
// Route::put('/{id}/reject', [erequestController::class, 'rejectERequest']);
// Route::delete('/{id}', [erequestController::class, 'deletePost']);
// Route::get('{id}', [postController::class, 'showImage']);
// });

Route::prefix('cart')->middleware('auth:sanctum')->group(function (){
Route::post('/{id}', [cartController::class, 'add']);  // post http://127.0.0.1:8000/api/cart/id   (add a product to cart and id is the product id)
Route::put('increase/{id}', [cartController::class, 'increase']);  // put http://127.0.0.1:8000/api/cart/increase/id   (increase the product number in cart by 1 and id is the product id)
Route::put('decrease/{id}', [cartController::class, 'decrease']);  // put http://127.0.0.1:8000/api/cart/decrease/id   (decrease the product number in cart by 1 and id is the product id)
Route::get('/my', [cartController::class, 'myCart']);  // get http://127.0.0.1:8000/api/cart/my   (get my cart)
Route::delete('/{id}', [cartController::class, 'delete']);  // delete http://127.0.0.1:8000/api/cart/id   (delete a product from cart and id is the product id)
// Route::get('{id}', [cartController::class, 'getProduct']);
});

Route::prefix('purchase')->middleware('auth:sanctum')->group(function (){
Route::get('', [purchaseController::class, 'getPurchases']);  // get http://127.0.0.1:8000/api/purchase   (get all purchases i have done as a user)
// Route::get('my', [purchaseController::class, 'getMyProducts']);
Route::post('', [purchaseController::class, 'addPurchase']);  // post http://127.0.0.1:8000/api/purchase   (make a new purchase of all items in my cart as a user)
Route::put('/{id}', [purchaseController::class, 'deliveredPurchase']);  // put http://127.0.0.1:8000/api/purchase/id   (mark a purchase as delivered as admin and id is the purchase id)
// Route::delete('/{id}', [purchaseController::class, 'deleteProduct']);
// Route::get('{id}', [purchaseController::class, 'getPurchase']);
});
//=======
// Route::prefix('posts')->middleware('auth:sanctum')->group(function () {
//     Route::get('', [postController::class, 'getPosts']);
//     Route::get('my', [postController::class, 'getMyPosts']);
//     Route::post('', [postController::class, 'addPost']);
//     Route::put('/{id}', [postController::class, 'updatePost']);
//     Route::delete('/{id}', [postController::class, 'deletePost']);
//     Route::get('{id}', [postController::class, 'getPost']);
// });
Route::middleware('auth:sanctum')->get('user', [purchaseController::class, 'getUser']);  // get http://127.0.0.1:8000/api/user   (get my information as the authenticated user)
// Route::prefix('erequests')->middleware('auth:sanctum')->group(function () {
//     Route::get('/sent', [erequestController::class, 'sentErequest']);
//     Route::get('/received', [erequestController::class, 'receivedErequest']);
//     Route::get('my', [postController::class, 'getMyPosts']);
//     Route::post('/{id1}/{id2}', [erequestController::class, 'addErequest']);
//     Route::put('/{id}/accept', [erequestController::class, 'acceptERequest']);
//     Route::put('/{id}/reject', [erequestController::class, 'rejectERequest']);
//     Route::delete('/{id}', [erequestController::class, 'deletePost']);
//     Route::get('{id}', [postController::class, 'showImage']);
// });


//Brand CRUD

// Route::prefix('brands')->middleware('auth:sanctum')->group(function () {
//     Route::get('/index', [BrandsController::class, 'index']);
//     Route::get('/show/{id}', [BrandsController::class, 'show']);
//     Route::post('/store', [BrandsController::class, 'store']);
//     Route::put('update_brand/{id}', [BrandsController::class, 'update_brand']);
//     Route::delete('delete_brand/{id}', [BrandsController::class, 'delete_brand']);
// });
// category crud
Route::prefix('categories')->group(function () {
    Route::get('/index', [CategoryController::class, 'index']);  // get http://127.0.0.1:8000/api/categories/index   (get all categories and its details)
    Route::get('/show/{id}', [CategoryController::class, 'show']);  // get http://127.0.0.1:8000/api/categories/show/id   (get a specific category by its id)
    Route::post('/store', [CategoryController::class, 'store']);  // post http://127.0.0.1:8000/api/categories/store   (create a new category)
    Route::post('update_category/{id}', [CategoryController::class, 'update_category']);  // post http://127.0.0.1:8000/api/categories/update_category/id   (get a category information using its id)
    Route::delete('delete_category/{id}', [CategoryController::class, 'delete_category']);  // delete http://127.0.0.1:8000/api/categories/delete_category/id   (delete a category using its id)
    Route::get('/{id}/products', [CategoryController::class, 'getProducts']);  // get http://127.0.0.1:8000/api/categories/id/products   (get the products of a specific category using the category id)
});

Route::prefix('rate')->middleware('auth:sanctum')->group(function () {
    Route::post('/{id}', [ratingController::class, 'addRating']);  // post http://127.0.0.1:8000/api/rate/id   (add a rating to a product using the purchased_product id)
    // Route::get('/show/{id}', [CategoryController::class, 'show']);
    // Route::post('/store', [CategoryController::class, 'store']);
    // Route::put('update_category/{id}', [CategoryController::class, 'update_category']);
    // Route::delete('delete_category/{id}', [CategoryController::class, 'delete_category']);
});


<<<<<<< HEAD
Route::post('user', [UserController::class, 'register'])->name('register');
// Other routes that were within the 'guest' middleware group can be defined here

=======
Route::middleware('guest')->group(function () {
    Route::post('user', [UserController::class, 'register'])->name('register');  // post http://127.0.0.1:8000/api/user   (register as a new user)
    // Other guest-only routes can be defined within this middleware group
});
>>>>>>> zain

Route::middleware('auth:sanctum')->group(function () {
    Route::post('user/edit', [UserController::class, 'edit'])->name('edit');  // post http://127.0.0.1:8000/api/user/edit   (edit my information as an authenticated user)
});