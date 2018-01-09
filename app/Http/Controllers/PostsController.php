<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Post;
use App\User;

use DB;

class PostsController extends Controller
{
    public function AllPosts(Request $request)
    {
        $post = Post::with('user')->latest()->get();
        if($request->wantsJson()){
              return $post;
        }
        
        return view('home', compact('post'));
      
    }
    public function AddPost(Request $request)
    {
        $addpost = new Post;
        $addpost->user_id = $request->name;
        $addpost->post_content = $request->content;
        $addpost->feeling = $request->feeling;
        $addpost->location = $request->location;
        $addpost->puv = $request->car;
        $addpost->save();

        //str_contains
        return response()->json(['status' => '200']);
    }
}
