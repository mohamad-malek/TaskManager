<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    
// guarded detect the fields that are not allowed to enter data to it oposite to fillable
            protected $guarded=[];
            protected $table = 'profiles';

    public function user(){
        return $this->belongsTo(User::class);
    }



}
