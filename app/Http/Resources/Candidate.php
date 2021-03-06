<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Candidate extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'position' => $this->position,
            'linkedin_url' => $this->linkedin_url,
            'min_salary' => $this->min_salary,
            'max_salary' => $this->max_salary,
            'skills' => Skill::collection($this->skills),
            'status' => new Status($this->status),
            'timeline' => Status::collection($this->statusHistories),
            'cv' => $this->getFirstMediaUrl('cv'),
        ];
    }
}
