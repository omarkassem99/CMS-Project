<?php

namespace App\Repository\Dashboard\Project;
use App\Http\Resources\Dashboard\Project\ProjectResource;
use App\Models\Project;

class ProjectRepo
{
    public function index()
    {
        $projects = Project::get();

        return successResponseData(ProjectResource::collection($projects));
    }

    public function store($request)
    {
        $data = $request->except('_token');
        $project = Project::create($data);

        return successResponseData(ProjectResource::make($project), 'Project Added Successfully');
    }
    public function update($request, $id)
    {
        $project = project::findOrFail($id);
        
        $data = $request->except('_token');


        $project->update($data);

        return successResponseData(ProjectResource::make($project), 'Project Updated Successfully');

    }

    public function show($id)
    {
        $project = Project::findOrFail($id);

        return successResponseData(new ProjectResource($project));

    }

    public function delete($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return successResponseMessage("Project Deleted");
    }
}