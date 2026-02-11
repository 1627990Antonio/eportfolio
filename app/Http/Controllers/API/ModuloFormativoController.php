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
        // $query = ModuloFormativo::query()->where('ciclo_formativo_id', $cicloFormativo->id);
        // if($query){
        //     $query->orWhere('nombre', 'like', '%' . $request->search . '%');
        // }
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
        $validate_Data = $request->validate([
            'nombre' => 'required',
            'codigo' => 'required|unique:modulos_formativos,codigo',
            'horas_totales' => 'required|integer',
            'curso_escolar' => 'required|string',
            'centro' => 'required|string',
            'descripcion' => 'required',
        ]);
        $validate_Data['ciclo_formativo_id'] = $cicloFormativo->id;

        $moduloFormativo = ModuloFormativo::create($validate_Data);

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
        $validate_Data = $request->validate([
            'nombre' => 'required',
            'codigo' => 'required|unique:modulos_formativos,codigo',
            'horas_totales' => 'required|integer',
            'curso_escolar' => 'required|string',
            'centro' => 'required|string',
            'descripcion' => 'required',
        ]);

        $moduloFormativo->update($validate_Data);

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
            return response()->json([
                'message' => 'ModuloFormativo eliminado correctamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
