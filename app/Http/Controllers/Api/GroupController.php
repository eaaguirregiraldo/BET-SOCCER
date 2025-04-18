<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Group::class);
        return response()->json(Group::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Group::class);

        $validated = $request->validate([
            'description' => 'required|string|in:A,B,C,D,E,F,G,H',
            'id_team' => 'required|exists:teams,id|unique:groups,id_team',
            'GF' => 'integer|min:0',
            'GC' => 'integer|min:0',
            'DG' => 'integer|min:0',
            'Points' => 'integer|min:0',
            'PJ' => 'integer|min:0',
            'PG' => 'integer|min:0',
            'PP' => 'integer|min:0',
        ]);

        // Validar que no se exceda el número máximo de equipos por grupo

        $groupCount = Group::where('description', $validated['description'])->count();
        if ($groupCount >= 4) {
            return response()->json(['message' => 'El grupo ya tiene el número máximo de equipos.'], 400);
        }

        // Validar que no se exceda el número máximo de grupos permitidos
        $teamCount = Team::count();
        $maxGroups = ceil($teamCount / 4);
        $currentGroups = Group::distinct('description')->count();
        if ($currentGroups >= $maxGroups) {
            return response()->json(['message' => 'Se ha alcanzado el número máximo de grupos permitidos.'], 400);
        }

        $group = Group::create($validated);

        return response()->json($group, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        Gate::authorize('view', $group);
        return response()->json($group);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        Gate::authorize('update', $group);

        $validated = $request->validate([
            'description' => 'sometimes|required|string|in:A,B,C,D,E,F,G,H',
            'id_team' => 'sometimes|required|exists:teams,id|unique:groups,id_team,' . $group->id,
            'GF' => 'integer|min:0',
            'GC' => 'integer|min:0',
            'DG' => 'integer|min:0',
            'Points' => 'integer|min:0',
            'PJ' => 'integer|min:0',
            'PG' => 'integer|min:0',
            'PP' => 'integer|min:0',
        ]);

        // Validar que no se exceda el número máximo de equipos por grupo si se cambia el grupo
        if (isset($validated['description']) && $validated['description'] != $group->description) {
            $groupCount = Group::where('description', $validated['description'])->count();
            if ($groupCount >= 4) {
                return response()->json(['message' => 'El grupo ya tiene el número máximo de equipos.'], 400);
            }
        }

        $group->update($validated);

        return response()->json($group);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        Gate::authorize('delete', $group);
        $group->delete();

        return response()->json(['message' => 'Group deleted correctly!'], 200);
    }
}