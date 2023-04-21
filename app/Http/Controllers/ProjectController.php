<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{
    protected $projectRepository;
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function index()
    {
        // $this->authorize('viewAny', Project::class);
    
        $projects = Project::where('active', true)->with('technologies')->get();
        return response()->json($projects, 200);   
    }

    public function create()
    {
        //
    }

    public function store(ProjectRequest $request)
    {
        $project = Project::create($request->except('technologies'));
        $project->technologies()->sync(json_decode($request->technologies));
        return response()->json($project->where('id', $project->id)->with('technologies')->get(), 201);
    }

    public function show($id)
    {
        // 
    }

    public function edit($id)
    {
        //
    }




    public function update(ProjectRequest $request, $id)
    {
        $projectUpdated = $this->projectRepository->update($request, $id);
        return response()->json($projectUpdated, 200);
    }

    public function destroy($id)
    {
        //
    }
}
