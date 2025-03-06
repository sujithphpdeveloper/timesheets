<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectTimesheetRequest;
use App\Http\Requests\StoreTimesheetRequest;
use App\Http\Requests\UpdateProjectTimesheetRequest;
use App\Http\Requests\UpdateTimesheetRequest;
use App\Http\Resources\TimesheetResource;
use App\Models\Project;
use App\Models\Timesheet;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TimesheetResource::collection(Timesheet::with('user', 'project')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * This store function is accessible by any users,
     * If need to implement the restrictions for Project based Timesheets use the storeProjectTimesheets() function
     */
    public function store(StoreTimesheetRequest $request)
    {
        $timesheet = Timesheet::create($request->validated());
        return new TimesheetResource($timesheet);
    }

    /**
     * Display the specified resource.
     */
    public function show(Timesheet $timesheet)
    {
        return new TimesheetResource($timesheet);
    }

    /**
     * Update the specified resource in storage.
     * To update the timesheet based on the project and authorized user, use the alternative function updateProjectTimesheet())
     */
    public function update(UpdateTimesheetRequest $request, Timesheet $timesheet)
    {
        $timesheet->update($request->validated());
        return new TimesheetResource($timesheet);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timesheet $timesheet)
    {
        $timesheet->delete();
        return response()->json(['message' => 'Timesheet deleted']);
    }

    /**
     * Create Timesheets based on Project assigned by authenticated users
     */
    public function storeProjectTimesheet(StoreProjectTimesheetRequest $request, Project $project)
    {
        // Adding the project and user
        $timesheet = Timesheet::create([
            'user_id' => auth()->id(),
            'project_id' => $project->id,
            'task_name' => $request->task_name,
            'date' => $request->date,
            'hours' => $request->hours,
        ]);

        return new TimesheetResource($timesheet);
    }

    /**
     * Update an existing timesheet based on the dedicated users in the project
     */
    public function updateProjectTimesheet(UpdateProjectTimesheetRequest $request, Project $project, Timesheet $timesheet)
    {
        $timesheet->update($request->validated());
        return new TimesheetResource($timesheet);
    }
}
