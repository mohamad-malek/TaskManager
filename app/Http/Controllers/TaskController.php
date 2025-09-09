<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Auth as SupportFacadesAuth;
use Illuminate\Support\Facades\Auth as IlluminateSupportFacadesAuth;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(StoreTaskRequest $request)
    {   
        $user_id= Auth::user()->id; 
        $validatedData=$request->validated();
        $validatedData['user_id']=$user_id;
        $task=Task::create($validatedData);
        return response()->json($task,201); 
    }

    public function update(UpdateTaskRequest $request,$id)
    {   

        $user_id = Auth::user()->id;
        $task = Task::findOrFail($id);
         if($task->user_id!=$user_id){
                return response()->json('unauthurized',403);
         }else{
                $task->update($request->validated());
                return  response()->json($task,200);
         }
    }
 
    public function destroy($id)
    {
        $user_id= Auth::user()->id;
        $task =Task::findOrFail($id);
        if($task->user_id!=$user_id){
            return response()->json('unauthurized',403);
        }else{
            $task->delete();
            return response()->json(null,204);
        }
    }

    public function index()
    {
        $task=Auth::user()->tasks;
        return response()->json($task,200);
    }


    public function getAllTasks(){

        $task=Task::all();
        return response()->json($task,200);
        
    }
    

    public function show($id)
    {
        $user_id = Auth::user()->id;
        $task =Task::findOrFail($id);
        if($task->user_id!=$user_id){
            return response()->json('unauthurized',403);
        }else{
            return response()->json($task,200);
        }
       
    }

    public  function getTaskUser($id)
    {
     $task = Task::findOrFail($id)->user;
     return response()->json($task);

    }

    
    public function addCategoriesToTask(Request $request,$taskId)
    {
            $user_id = Auth::user()->id;
            $task = Task::findOrFail($taskId);
             if($task->user_id!=$user_id){
                return response()->json('unauthurized',403);
            }else{
                $task->categories()->attach($request->category_id);
                return response()->json('category attached succesfuly',200);
            }

        
    }   


    public function getTaskCategories($taskId)
    {   
       $task = Task::findOrFail($taskId)->categories;
       return response()->json($task,200);
    }

    public function getCategorieTasks($categoryId)
        {
        $category = Category::findOrFail($categoryId)->tasks;
        return response()->json($category,200);
        }



}

