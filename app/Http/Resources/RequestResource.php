<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
         return [
         'id'=> $this->id,
         'requestnumber'=> $this->requestnumber,
         'department' => $this->department,
         'location'=>$this->location,
         'created_at' => (string) $this->created_at,
         'updated_at' => (string) $this->updated_at,
         'user' => $this->user,
         'problem_description' => $this->problem_description,
         'priority' => $this->priority,
          'completed_by' => $this->completed_by,
          'Remarks' => $this->Remarks,
        'date_completed' => $this->date_completed,
         ];
    }
}