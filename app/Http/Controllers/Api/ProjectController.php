<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Project as ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ProjectResource::collection(Project::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ProjectResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'description' => 'required|min:5',
            'status' => [
                'required',
                Rule::in(array_keys(Project::STATUSES))
            ]
        ]);

        if ($validator->fails()) {
            throw new BadRequestHttpException($validator->getMessageBag());
        }

        $project = new Project($request->all());
        $project->save();

        return new ProjectResource($project);
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return ProjectResource
     */
    public function show(Project $project)
    {
        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Project $project
     * @return ProjectResource
     */
    public function update(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'description' => 'required|min:5',
            'status' => [
                'required',
                Rule::in(array_keys(Project::STATUSES))
            ]
        ]);

        if ($validator->fails()) {
            throw new BadRequestHttpException($validator->getMessageBag());
        }

        $project->update($validator->validate());

        return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $projectId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($projectId)
    {
        Project::whereId($projectId)->delete();
    }
}
