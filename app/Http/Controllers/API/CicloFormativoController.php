<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CicloFormativoResource;
use App\Models\CicloFormativo;
use App\Models\FamiliaProfesional;
use Illuminate\Http\Request;

class CicloFormativoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, FamiliaProfesional $familiaProfesional)
    {
        return CicloFormativoResource::collection(
            CicloFormativo::where('familia_profesional_id', $familiaProfesional->id)
            ->orderBy($request->sort ?? 'id', $request->order ?? 'asc')
            ->paginate($request->per_page));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FamiliaProfesional $familiaProfesional)
    {
        $cicloFormativoDato = json_decode($request->getContent(), true);
        $cicloFormativoDato['familia_profesional_id'] = $familiaProfesional->id;

        $cicloFormativo = CicloFormativo::create($cicloFormativoDato);

        return new CicloFormativoResource($cicloFormativo);
    }

    /**
     * Display the specified resource.
     */
    public function show(FamiliaProfesional $familiaProfesional, CicloFormativo $cicloFormativo)
    {
        abort_if($cicloFormativo->familia_profesional_id !== $familiaProfesional->id, 404);
        return new CicloFormativoResource($cicloFormativo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FamiliaProfesional $familiaProfesional, CicloFormativo $cicloFormativo)
    {
        abort_if($cicloFormativo->familia_profesional_id !== $familiaProfesional->id, 404);
        $cicloFormativoDato = json_decode($request->getContent(), true);
        $cicloFormativo->update($cicloFormativoDato);

        return new CicloFormativoResource($cicloFormativo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FamiliaProfesional $familiaProfesional, CicloFormativo $cicloFormativo)
    {
        abort_if($cicloFormativo->familia_profesional_id !== $familiaProfesional->id, 404);
        try {
            $cicloFormativo->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
