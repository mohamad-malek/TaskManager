<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    
    
    public function store(StoreTaskRequest $request)
    {
        $task=Task::create($request->validated());

        return response()->json($task,201);
    }



    public function update(UpdateTaskRequest $request,$id)
    {   
        $task = Task::findOrFail($id);
        $task->update($request->validated());
        return  response()->json($task,200);
    }

    public function destroy($id)
    {
        $task =Task::findOrFail($id);
        $task->delete();
        return response()->json(null,204);
    }


    public function index()
    {
        $task = Task::all();
        return response()->json($task,200);
    }

    public function show($id)
    {
        $task =Task::findOrFail($id);
        return response()->json($task,200);
    }

        
    public  function getTaskUser($id)
    {
     $task = Task::findOrFail($id)->user;
     return response()->json($task);

    }

    
    public function addCategoriesToTask(Request $request,$taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->categories()->attach($request->category_id);
        return response()->json('category attached succesfuly',200);
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
