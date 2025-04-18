<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ScheduleResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ScheduleResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', ScheduleResult::class);
        return response()->json(ScheduleResult::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', ScheduleResult::class);

        $validated = $request->validate([
            'id_team_1' => 'required|exists:teams,id',
            'id_team_2' => 'required|exists:teams,id',
            'score_team1' => 'nullable|integer|min:0',
            'score_team2' => 'nullable|integer|min:0',
            'id_stadium' => 'required|exists:stadiums,id',
            'date_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $scheduleResult = ScheduleResult::create($validated);

        return response()->json($scheduleResult, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ScheduleResult $scheduleResult)
    {
        Gate::authorize('view', $scheduleResult);
        return response()->json($scheduleResult);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ScheduleResult $scheduleResult)
    {
        Gate::authorize('update', $scheduleResult);

        $validated = $request->validate([
            'id_team_1' => 'sometimes|required|exists:teams,id',
            'id_team_2' => 'sometimes|required|exists:teams,id',
            'score_team1' => 'nullable|integer|min:0',
            'score_team2' => 'nullable|integer|min:0',
            'id_stadium' => 'sometimes|required|exists:stadiums,id',
            'date_time' => 'sometimes|required|date_format:Y-m-d H:i:s',
        ]);

        $scheduleResult->update($validated);

        return response()->json($scheduleResult);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScheduleResult $scheduleResult)
    {
        Gate::authorize('delete', $scheduleResult);
        $scheduleResult->delete();

        return response()->json(['message' => 'Schedule result deleted correctly!'], 200);
    }
}