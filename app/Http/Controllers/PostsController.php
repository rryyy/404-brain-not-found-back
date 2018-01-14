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
        $addpost->rating = $request->rating;
        $addpost->location = $request->location;
        $addpost->puv = $request->car;
        $addpost->save();

        //str_contains
        return response()->json(['status' => '200']);
    }
    public function Analytics()
    {
        //gt all responses
        $responses = Post::all()->count();
        //get all responses per puvs
        $bus_responses = Post::all()->where('puv','bus')->count();
        $jeepney_responses = Post::all()->where('puv','jeep')->count();
        $taxi_responses = Post::all()->where('puv','taxi')->count();
        $train_responses = Post::all()->where('puv','train')->count();
        $uber_responses = Post::all()->where('puv','uber')->count();
        $grab_responses = Post::all()->where('puv','grab')->count();
        $tricycle_responses = Post::all()->where('puv','tricycle')->count();
        //get all good response -> puv
        $bus_good = Post::all()->where('puv','bus')->where('rating','good')->count();
        $jeep_good = Post::all()->where('puv','jeep')->where('rating','good')->count();
        $taxi_good = Post::all()->where('puv','taxi')->where('rating','good')->count();
        $train_good = Post::all()->where('puv','train')->where('rating','good')->count();
        $uber_good = Post::all()->where('puv','uber')->where('rating','good')->count();
        $grab_good = Post::all()->where('puv','grab')->where('rating','good')->count();
        $tricycle_good = Post::all()->where('puv','tricycle')->where('rating','good')->count();
        //get all bad response -> puv
        $bus_bad = Post::all()->where('puv','bus')->where('rating','bad')->count();
        $jeep_bad = Post::all()->where('puv','jeep')->where('rating','bad')->count();
        $taxi_bad = Post::all()->where('puv','taxi')->where('rating','bad')->count();
        $train_bad = Post::all()->where('puv','train')->where('rating','bad')->count();
        $uber_bad = Post::all()->where('puv','uber')->where('rating','bad')->count();
        $grab_bad = Post::all()->where('puv','grab')->where('rating','bad')->count();
        $tricycle_bad = Post::all()->where('puv','tricycle')->where('rating','bad')->count();

        $responses = array(
            'responses' => $responses,
            'bus_responses' => $bus_responses, 
            'jeepney_responses' => $jeepney_responses,
            'taxi_responses' => $taxi_responses, 
            'train_responses' => $train_responses, 
            'uber_responses' => $uber_responses,   
            'grab_responses' => $grab_responses,  
            'tricycle_responses' => $tricycle_responses );
        $good = array(
            'bus' => $bus_good,
            'jeep' => $jeep_good,
            'taxi' => $taxi_good,
            'train' => $train_good,
            'uber' => $uber_good,
            'grab' => $grab_good,
            'tricycle' => $tricycle_good
             );
        $bad = array(
            'bus' => $bus_bad,
            'jeep' => $jeep_bad,
            'taxi' => $taxi_bad,
            'train' => $train_bad,
            'uber' => $uber_bad,
            'grab' => $grab_bad,
            'tricycle' => $tricycle_bad
             );
        return response()->json([
                'bad' => $bad,
                'positive' => $good,
                'response' => $responses
        ]);
    }
}
