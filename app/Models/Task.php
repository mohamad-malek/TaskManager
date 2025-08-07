<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title','description','priority','user_id'];
    protected $table = 'tasks';


    public  function user()
    {
        return $this->belongsTo(User::class);
    }


    public function Categories()
    {
        return $this->belongsToMany(Category::class,'category_task');
    }


    

}

