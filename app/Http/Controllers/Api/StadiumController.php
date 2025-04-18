<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StadiumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Stadium::class);
        return response()->json(Stadium::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Stadium::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'characteristics' => 'required|string|max:255',
        ]);

        $stadium = Stadium::create($validated);

        return response()->json($stadium, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stadium $stadium)
    {
        Gate::authorize('view', $stadium);
        return response()->json($stadium);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stadium $stadium)
    {
        Gate::authorize('update', $stadium);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'characteristics' => 'sometimes|required|string|max:255',
        ]);

        $stadium->update($validated);

        return response()->json($stadium);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stadium $stadium)
    {
        Gate::authorize('delete', $stadium);
        $stadium->delete();

        return response()->json(['message' => 'Stadium deleted correctly!'], 200);
    }
}