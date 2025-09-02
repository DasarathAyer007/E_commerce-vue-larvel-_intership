<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    function signup(Request $request){

        $request->validate([
            'name'=>'required',
            'email'=>"required",
            'password'=>'required'
        ]);
    
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'role_id'=>1
        ]);
        


        return response()->json(compact('user'));
    }

    function login(Request $request){
        $request->validate([
             'name'=>'required',
             'password'=>'required'
    ]);

        $user=User::where('name',$request->name)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            return response()->json(
                ["message"=>"user not found"],404
        );
        }

        return response()->json([
            "user"=>$user,
            "token"=>$user->createToken($request->name)->plainTextToken
        ]);

    }
    function logout(Request $request){

        $request->user()->currentAccessToken()->delete();
        

        return response()->json([
            "message"=>"user logut sucessfull"
    ],200);

    }
    
}
