<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Bet::class);
        return response()->json(Bet::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Bet::class);

        $validated = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_schedule' => 'required|exists:schedule_results,id',
            'score_team1' => 'nullable|integer|min:0',
            'score_team2' => 'nullable|integer|min:0',
            'points' => 'integer|min:0',
        ]);

        $bet = Bet::create($validated);

        return response()->json($bet, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bet $bet)
    {
        Gate::authorize('view', $bet);
        return response()->json($bet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bet $bet)
    {
        Gate::authorize('update', $bet);

        $validated = $request->validate([
            'id_user' => 'sometimes|required|exists:users,id',
            'id_schedule' => 'sometimes|required|exists:schedule_results,id',
            'score_team1' => 'nullable|integer|min:0',
            'score_team2' => 'nullable|integer|min:0',
            'points' => 'integer|min:0',
        ]);

        $bet->update($validated);

        return response()->json($bet);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bet $bet)
    {
        Gate::authorize('delete', $bet);
        return response()->json(['message' => 'Deleting bets is not allowed.'], 403);
    }
}