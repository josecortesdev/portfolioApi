<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Http\Client\Request;

class ProjectRepository{

    public function update($projectData, $id)
    {
        $project = Project::find($id);
        $project->update($projectData->except('technologies'));
        if(isset($projectData->technologies)){
            $project->technologies()->detach();
        }
        $project->technologies()->sync(json_decode($projectData->technologies));
        
        return $project->where('id', $id)->with('technologies')->get();
    }
}