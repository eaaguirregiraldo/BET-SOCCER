<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Team::class);
        return response()->json(Team::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Team::class);

        $validated = $request->validate([
            'id_tournament' => 'required|exists:tournaments,id',
            'name' => 'required|string|max:255',
            'team_shield' => 'required|string', // Base64 encoded
        ]);

        // Validar que no se exceda el número máximo de equipos por torneo
        $tournament = Tournament::find($validated['id_tournament']);
        if ($tournament->teams()->count() >= $tournament->amount_teams) {
            return response()->json(['message' => 'El número máximo de equipos para este torneo ha sido alcanzado.'], 400);
        }

        $team = Team::create($validated);

        return response()->json($team, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        Gate::authorize('view', $team);
        return response()->json($team);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        Gate::authorize('update', $team);

        $validated = $request->validate([
            'id_tournament' => 'sometimes|required|exists:tournaments,id',
            'name' => 'sometimes|required|string|max:255',
            'team_shield' => 'sometimes|required|string', // Base64 encoded
        ]);

        // Validar que no se exceda el número máximo de equipos por torneo si se cambia el torneo
        if (isset($validated['id_tournament']) && $validated['id_tournament'] != $team->id_tournament) {
            $tournament = Tournament::find($validated['id_tournament']);
            if ($tournament->teams()->count() >= $tournament->amount_teams) {
                return response()->json(['message' => 'El número máximo de equipos para este torneo ha sido alcanzado.'], 400);
            }
        }

        $team->update($validated);

        return response()->json($team);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        Gate::authorize('delete', $team);
        $team->delete();

        return response()->json(['message' => 'Team deleted correctly!'], 200);
    }
}