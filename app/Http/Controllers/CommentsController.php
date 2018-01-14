<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;

class CommentsController extends Controller
{
    public function GetComments()
    {
    	$comments = Comment::with('user')->get();
    	return $comments;
    }
    public function GetPostComments(Request $request)
    {
    	$comments = Comment::with('user')->where('post_id',$request->id)->get();
    	return $comments;
    }
    public function AddComment(Request $request)
    {
    	$addcomment = new Comment;
    	$addcomment->post_id = $request->postid;
    	$addcomment->user_id = $request->userid;
    	$addcomment->comment_content = $request->content;
    	$addcomment->save();
    	return response()->json(['status' => '200']);
    }

}
