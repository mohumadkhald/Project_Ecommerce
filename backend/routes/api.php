<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\postController;
use App\Http\Controllers\Api\erequestController;

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
 
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
 
    return $user->createToken($request->device_name)->plainTextToken;
});

Route::prefix('posts')->middleware('auth:sanctum')->group(function (){
Route::get('', [postController::class, 'getPosts']);
Route::get('my', [postController::class, 'getMyPosts']);
Route::post('', [postController::class, 'addPost']);
Route::put('/{id}', [postController::class, 'updatePost']);
Route::delete('/{id}', [postController::class, 'deletePost']);
Route::get('{id}', [postController::class, 'getPost']);
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