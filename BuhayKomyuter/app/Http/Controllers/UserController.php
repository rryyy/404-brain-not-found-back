<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function Login(Request $request)
    {	
    	$logg = User::username($request->username)->where('password', $request->password)->get();
    	return $logg;
    }
    public function Register(Request $request)
    {
    	$register = new User;
    	$register->name = $request->name;
    	$register->email = $request->email;
    	$register->password = $request->password;
    	$register->save();
    	return response()->json(['status' => '200']);
    }
}
