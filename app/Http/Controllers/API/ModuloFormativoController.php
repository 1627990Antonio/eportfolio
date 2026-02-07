<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ModuloFormativoResource;
use App\Models\CicloFormativo;
use App\Models\ModuloFormativo;
use Illuminate\Http\Request;

class ModuloFormativoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, CicloFormativo $cicloFormativo)
    {
        return ModuloFormativoResource::collection(
            ModuloFormativo::where('ciclo_formativo_id', $cicloFormativo->id)
            ->orderBy($request->sort ?? 'id', $request->order ?? 'asc')
            ->paginate($request->per_page));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CicloFormativo $cicloFormativo)
    {
        $moduloFormativoDato = json_decode($request->getContent(), true);
        $moduloFormativoDato['ciclo_formativo_id'] = $cicloFormativo->id;

        $moduloFormativo = ModuloFormativo::create($moduloFormativoDato);

        return new ModuloFormativoResource($moduloFormativo);
    }

    /**
     * Display the specified resource.
     */
    public function show(CicloFormativo $cicloFormativo, ModuloFormativo $moduloFormativo)
    {
        abort_if($moduloFormativo->ciclo_formativo_id !== $cicloFormativo->id, 404);
        return new ModuloFormativoResource($moduloFormativo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CicloFormativo $cicloFormativo, ModuloFormativo $moduloFormativo)
    {
        abort_if($moduloFormativo->ciclo_formativo_id !== $cicloFormativo->id, 404);
        $moduloFormativoDato = json_decode($request->getContent(), true);
        $moduloFormativo->update($moduloFormativoDato);

        return new ModuloFormativoResource($moduloFormativo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CicloFormativo $cicloFormativo, ModuloFormativo $moduloFormativo)
    {
        abort_if($moduloFormativo->ciclo_formativo_id !== $cicloFormativo->id, 404);
        try {
            $moduloFormativo->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
