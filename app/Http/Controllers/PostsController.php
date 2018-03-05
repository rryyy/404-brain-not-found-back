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
    public function PostWithin(Request $request)
    {
        $search = "Olongapo City";
        $postwithin = Post::with('user')->latest()->where('location','LIKE','%'.{$search}.'%')->get();
        return $postwithin;
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
        $addpost->image = $request->image;
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
                'negative' => $bad,
                'positive' => $good,
                'response' => $responses
        ]);
    }
    public function AnalyticsLocation($location)
    {
        //count of all responses
        $responses = Post::where('location', 'like', '%'.$location.'%')->count();    
        //count per puv responses
        $responses_bus = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'bus')->count();
        $responses_jeep = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'jeep')->count();
        $responses_taxi = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'taxi')->count();
        $responses_train = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'train')->count();
        $responses_uber = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'uber')->count();
        $responses_grab = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'grab')->count();
        $responses_tricycle= Post::where('location', 'like', '%'.$location.'%')->where('puv', 'tricycle')->count();
        //postitive feedbacks
        $positive_bus = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'bus')->where('rating', 'good')->count();
        $positive_jeep = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'jeep')->where('rating', 'good')->count();
        $positive_taxi = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'taxi')->where('rating', 'good')->count();
        $positive_train = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'train')->where('rating', 'good')->count();
        $positive_uber = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'uber')->where('rating', 'good')->count();
        $positive_grab = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'grab')->where('rating', 'good')->count();
        $positive_tricycle= Post::where('location', 'like', '%'.$location.'%')->where('puv', 'tricycle')->where('rating', 'good')->count();
        //negative feedbacks
        $negative_bus = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'bus')->where('rating', 'bad')->count();
        $negative_jeep = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'jeep')->where('rating', 'bad')->count();
        $negative_taxi = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'taxi')->where('rating', 'bad')->count();
        $negative_train = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'train')->where('rating', 'bad')->count();
        $negative_uber = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'uber')->where('rating', 'bad')->count();
        $negative_grab = Post::where('location', 'like', '%'.$location.'%')->where('puv', 'grab')->where('rating', 'bad')->count();
        $negative_tricycle= Post::where('location', 'like', '%'.$location.'%')->where('puv', 'tricycle')->where('rating', 'bad')->count();

        $response = array('response' => $responses);
        $puv = array(
            'bus' => $responses_bus,
            'jeep' => $responses_jeep,
            'taxi' => $responses_taxi,
            'train' => $responses_train,
            'uber' => $responses_uber,
            'grab' => $responses_grab,
            'tricycle' => $responses_tricycle
        );
        $positive = array(
            'bus' => $positive_bus,
            'jeep' => $positive_jeep,
            'taxi' => $positive_taxi,
            'train' => $positive_train,
            'uber' => $positive_uber,
            'grab' => $positive_grab,
            'tricycle' => $positive_tricycle
        );
        $negative = array(
            'bus' => $negative_bus,
            'jeep' => $negative_jeep,
            'taxi' => $negative_taxi,
            'train' => $negative_train,
            'uber' => $negative_uber,
            'grab' => $negative_grab,
            'tricycle' => $negative_tricycle
        );
        return response()->json([
                'all response' => $response,
                'response per puv' => $puv,
                'positive' => $positive,
                'negative' => $negative
        ]);
    }
}
