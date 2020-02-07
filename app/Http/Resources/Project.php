<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Project as ProjectModel;

class Project extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'status' => isset(ProjectModel::STATUSES[$this->status]) ? ProjectModel::STATUSES[$this->status] : 'no status',
            'created_at' => Carbon::parse($this->created_at)->timestamp,
        ];
    }
}
