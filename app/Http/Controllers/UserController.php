<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResourse;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            "name"=>'required|string|max:255',
            "email"=>'required|email|unique:users,email',
            "password"=>'required|string|min:8|confirmed'
        ]);
        $user =  User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        return response()->json(
            [
                ' message'=>'User registered succesfully',
                'User'=>$user,
            ],
        201);

    }
    
    public function login(Request $request)
    {
           $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string',
           ]); 

           if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                "message"=>'invalid email or password',
            ],401);
           };

           $user=User::where('email',$request->email)->FirstOrFail();
          $token= $user->createToken('auth_token')->plainTextToken;
           return response()->json([
            "message"=>"Login Succesful",
            "User"=>$user,
            "Token"=>$token,
           ],200);


    }

    public function logout(Request $request)
    {   
        $request->user()->currentAccessToken()->delete();
          return response()->json([
            "message"=>"Logout Succesful",
           ],200);
    }

    public  function getUser(){
      $user_id=  Auth::user()->id;
       $userData = User::with('profile')->findOrFail($user_id);
       return  new UserResourse($userData);
    }

    public function getProfile($id)
    {
        
       $profile= User::find($id)->profile;
        return response()->json($profile,200);
    }   

    public function getUserTask($id){
        $tasks =User::find($id)->tasks;
        return response()->json($tasks,200);
        
    }
}


