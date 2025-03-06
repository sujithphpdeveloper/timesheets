<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Attribute;
use App\Models\Project;
use App\Filters\ProjectFilter;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProjectFilter $filter)
    {
        $projects = Project::with('attributes');
        $projects = $filter->apply($projects)->get();
        return ProjectResource::collection($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->validated());

        // Update the attributes if available in the request
        if ($request->has('attributes_values')) {
            foreach ($request->attributes_values as $attributeValue) {
                $attribute = Attribute::find($attributeValue['attribute_id']);

                if($attribute) {
                    $project->attributeValues()->create([
                        'attribute_id' => $attribute->id,
                        'value'        => $attributeValue['value'],
                    ]);

                }
            }
        }

        return new ProjectResource($project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        // crate/update dynamic attributes to project
        if ($request->has('attributes_values')) {
            foreach ($request->input('attributes_values') as $attributeValue) {
                $attribute = Attribute::find($attributeValue['attribute_id']);
                if ($attribute) {
                    $project->attributeValues()->updateOrCreate(
                        ['attribute_id' => $attribute->id],
                        ['value' => $attributeValue['value']]
                    );
                }
            }
        }

        return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['message' => 'Project deleted']);
    }
}
