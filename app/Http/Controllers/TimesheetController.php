<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimesheetRequest;
use App\Http\Requests\UpdateTimesheetRequest;
use App\Http\Resources\TimesheetResource;
use App\Models\Timesheet;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TimesheetResource::collection(Timesheet::all());
    }

    /**
     * Store a newly created resource in storage.
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
}
