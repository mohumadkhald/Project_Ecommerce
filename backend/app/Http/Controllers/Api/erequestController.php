<?php

namespace App\Http\Controllers\Api;
use App\Models\Post;
use App\Models\Erequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class erequestController extends Controller
{
    public function addErequest($id1,$id2){
        $erequest = new Erequest;
        $erequest->receiver_post_id = $id1;
        // dd($id1);
        $erequest->sender_post_id = $id2;
        // dd($id2);
        $erequest->receiver_user_id = Post::find($id1)->user->id;
        // dd(Post::find($id1)->user->id);
        $erequest->sender_user_id = Post::find($id2)->user->id;
        // dd(Post::find($id2)->user->id);
        $erequest->save();
        $sender=Post::find($id2)->user;
        $receiver=Post::find($id1)->user;
        $sender_post=Post::find($id2);
        $receiver_post=Post::find($id1);
        return [
            'sender'=>$sender,
            'receiver'=>$receiver,
            'sender_post'=>$sender_post,
            'receiver_post'=>$receiver_post
        ];
    }

    public function acceptErequest($id){
        $erequest = Erequest::find($id);
        $erequest->status = 'accepted';
        $erequest->save();
        return $erequest;
    }

    public function rejectErequest($id){
        $erequest = Erequest::find($id);
        $erequest->status = 'rejected';
        $erequest->save();
        return $erequest;
    }


    public function sentErequest(){
       $user = auth()->user();
       $sentErequests = Erequest::where('sender_user_id', $user->id)->get();
       return $sentErequests;
    }


    public function receivedErequest(){
       $user = auth()->user();
       $receivedErequests = Erequest::where('receiver_user_id', $user->id)->get();
       return $receivedErequests;
    }
}
