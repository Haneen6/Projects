<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Note extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       //  return parent::toArray($request);

        return [
            
            'user_id'=> $this->user_id,
            'id'=>$this->id,
            'title'=> $this->title,
            'content'=>$this->content,
            'created_at'=> $this->created_at->format('d/m/Y'),
            'updated_at'=> $this->updated_at->format('d/m/Y')
        ];
    }
}
