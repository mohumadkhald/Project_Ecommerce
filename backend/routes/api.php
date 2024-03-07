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
Route::get('', [productController::class, 'getProducts']);
Route::get('my', [productController::class, 'getMyProducts']);
Route::post('', [productController::class, 'addProduct']);
Route::put('/{id}', [productController::class, 'updateProduct']);
Route::put('/{id}/delete', [productController::class, 'deleteProduct']);
Route::put('/{id}/restore', [productController::class, 'restoreProduct']);
Route::delete('/{id}', [productController::class, 'terminateProduct']);
Route::get('{id}', [productController::class, 'getProduct']);
});

Route::prefix('erequests')->middleware('auth:sanctum')->group(function (){
Route::get('/sent', [erequestController::class, 'sentErequest']);
Route::get('/received', [erequestController::class, 'receivedErequest']);
Route::get('my', [postController::class, 'getMyPosts']);
Route::post('/{id1}/{id2}', [erequestController::class, 'addErequest']);
Route::put('/{id}/accept', [erequestController::class, 'acceptERequest']);
Route::put('/{id}/reject', [erequestController::class, 'rejectERequest']);
Route::delete('/{id}', [erequestController::class, 'deletePost']);
Route::get('{id}', [postController::class, 'showImage']);
});

Route::prefix('cart')->middleware('auth:sanctum')->group(function (){
Route::post('/{id}', [cartController::class, 'add']);
Route::put('increase/{id}', [cartController::class, 'increase']);
Route::put('decrease/{id}', [cartController::class, 'decrease']);
Route::get('/my', [cartController::class, 'myCart']);
Route::delete('/{id}', [cartController::class, 'delete']);
// Route::get('{id}', [cartController::class, 'getProduct']);
});

Route::prefix('purchase')->middleware('auth:sanctum')->group(function (){
Route::get('', [purchaseController::class, 'getPurchases']);
// Route::get('my', [purchaseController::class, 'getMyProducts']);
Route::post('', [purchaseController::class, 'addPurchase']);
Route::put('/{id}', [purchaseController::class, 'deliveredPurchase']);
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
Route::middleware('auth:sanctum')->get('user', [purchaseController::class, 'getUser']);
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

Route::prefix('brands')->middleware('auth:sanctum')->group(function () {
    Route::get('/index', [BrandsController::class, 'index']);
    Route::get('/show/{id}', [BrandsController::class, 'show']);
    Route::post('/store', [BrandsController::class, 'store']);
    Route::put('update_brand/{id}', [BrandsController::class, 'update_brand']);
    Route::delete('delete_brand/{id}', [BrandsController::class, 'delete_brand']);
});
// category crud
Route::prefix('categories')->middleware('auth:sanctum')->group(function () {
    Route::get('/index', [CategoryController::class, 'index']);
    Route::get('/show/{id}', [CategoryController::class, 'show']);
    Route::post('/store', [CategoryController::class, 'store']);
    Route::post('update_category/{id}', [CategoryController::class, 'update_category']);
    Route::delete('delete_category/{id}', [CategoryController::class, 'delete_category']);
});

Route::prefix('rate')->middleware('auth:sanctum')->group(function () {
    Route::post('/{id}', [ratingController::class, 'addRating']);
    // Route::get('/show/{id}', [CategoryController::class, 'show']);
    // Route::post('/store', [CategoryController::class, 'store']);
    // Route::put('update_category/{id}', [CategoryController::class, 'update_category']);
    // Route::delete('delete_category/{id}', [CategoryController::class, 'delete_category']);
});


