<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; // Importar la clase correcta

class TournamentController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Tournament::class);
        return response()->json(Tournament::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Tournament::class);

        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount_teams' => 'required|integer',
            'first_phase_groups' => 'required|in:S,N',
        ]);

        $tournament = Tournament::create($validated);

        return response()->json($tournament, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tournament $tournament)
    {
        $this->authorize('view', $tournament);
        return response()->json($tournament);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tournament $tournament)
    {
        $this->authorize('update', $tournament);

        $validated = $request->validate([
            'description' => 'sometimes|required|string|max:255',
            'amount_teams' => 'sometimes|required|integer',
            'first_phase_groups' => 'sometimes|required|in:S,N',
        ]);

        $tournament->update($validated);

        return response()->json($tournament);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tournament = Tournament::find($id);

        if (!$tournament) {            
            return response()->json(['message' => 'Tournament not found'], 200);
        }

        $this->authorize('delete', $tournament);
        $tournament->delete();

        return response()->json(['message' => 'Tournament deleted correctly!'], 200);
    }
}