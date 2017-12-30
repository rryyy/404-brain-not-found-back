<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function Login(Request $request)
    {	
    	$logg = User::username($request->userN)->where('password', $request->password)->get();
    	return $logg;
    }
}
