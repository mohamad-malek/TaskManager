<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileReasource extends JsonResource
{
  
    public function toArray(Request $request): array
    {
        return [
            'phone'=>$this->phone,
            'address'=>$this->address,
            'bio'=>$this->bio,
            'image'=>$this->image,

        ];
    }
}
