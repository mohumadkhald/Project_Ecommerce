<?php

namespace App\Http\Controllers\Api;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class postController extends Controller
{
    
    public function getPosts(){
        $userId = Auth::id();
// dd($userId);
    // Retrieve posts where user_id is not the authenticated user's ID
    $posts = Post::where('user_id', '!=', $userId)->get();
    $posts->each(function ($post) {
    $post->image_path = asset('storage/' . $post->image);
});
    return response()->json($posts);
    }

    public function getMyPosts(){
        $userId = Auth::id();
// dd($userId);
    // Retrieve posts where user_id is not the authenticated user's ID
    $posts = Post::where('user_id', $userId)->get();
    $posts->each(function ($post) {
    $post->image_path = asset('storage/' . $post->image);
});
    return response()->json($posts);
    }

    public function addPost(Request $request){
        $post = new Post();
        $imagePath = $request->file('image')->store('images/posts', 'public');
        $post->description = $request->description;
        $post->image = $imagePath;
        $post->title = $request->title;
        $post->user_id = $request->user()->id;
        $post->save();
        $post->image_path = asset('storage/' . $imagePath);
        return $post;
    }


    public function updatePost($id, Request $request){
        $post = Post::find($id);
        $post->description = $request->description;
        $post->image = $request->image;
        $post->title = $request->title;
        $post->save();
        return $post;
    }


    public function getPost($id, Request $request){
        $post = Post::find($id);
        $post->image_path = asset('storage/' . $post->image);
        // $post->save();
        return $post;
    }


    public function deletePost($id){
        $post = Post::find($id);
        $post->delete();
        return $post;
    }

    // In your controller or route
// public function showImage($id)
// {
//     $post = Post::find($id);
// dd($post->image);
//     if (!$post) {
//         abort(404); // Image not found
//     }

//     // Set appropriate headers
//     header('Content-Type: image/jpeg');
//     header('Content-Length: ' . strlen($post->image));
// dd($post->image);
//     // Output the image data
//     echo $post->image;
// }

}
