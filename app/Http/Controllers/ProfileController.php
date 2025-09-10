<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class ProfileController extends Controller
{
    public  function store(StoreProfileRequest $request)
    {           $user_id =Auth::user()->id;
                $validatedData=$request->validated();
                $validatedData['user_id']=$user_id;
                
                if($request->hasFile('image'))
                {                                  // store function la t5azen sora bt5d 2 parameters
                    $path=$request->file('image')->store('my photo','public'); //$folder    //$disck
                    $validatedData['image']=$path;

                }                                  
               $profile= Profile::create($validatedData);
               return response()->json(
                [
                    'massege'=>'profile created succesfully',
                    'profile'=>$profile,

                ],201
               );

             
                 
     }
     public function update(UpdateProfileRequest $request, $id)
     {
      $profile =  Profile::where('user_id',$id)->firstOrFail();
      $profile->update($request->validated());
        return response()->json([
            'massege'=>'profile updated succsewfully',
            'profile'=>$profile,
        ],200);
    }


     public function show($id)
     {
        $profile= Profile::where('user_id',$id)->firstorfail();
        return response()->json($profile,200);
     }
}

