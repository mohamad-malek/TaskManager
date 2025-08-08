<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class ProfileController extends Controller
{
    public  function store(StoreProfileRequest $request)
    {
               $profile= Profile::create($request->validated());
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
