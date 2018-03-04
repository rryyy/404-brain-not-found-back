<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function Login(Request $request)
    {	
        $logg = User::username($request->username)->first();
        Hash::check($request->password, $logg->password);
    	return $logg;
    }
    public function Register(Request $request)
    {
    	$register = new User;
    	$register->name = $request->name;
        $register->contact = $request->contact;
        $register->address = $request->location;
    	$register->email = $request->email;
    	$register->password = bcrypt($request->password);
    	$register->save();
    	return response()->json(['status' => '200','last_insert_id' => $register->id]);
        // return Response::json(array('success' => true, 'last_insert_id' => $data->id), 200);
    }
    public function GetAccount(Request $request)
    {   
        $logg = User::find($request->id);
        return $logg;
        // return response()->json(['status' => $logg]);
    }
}
