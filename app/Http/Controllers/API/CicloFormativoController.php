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
        $query = CicloFormativo::query()->where('id', $request->id);
        if ($query) {
            $query->orWhere('nombre', 'like', '%' . $request->search . '%');
        }

        return CicloFormativoResource::collection(
            $query->where('familia_profesional_id', $familiaProfesional->id)
                ->orderBy($request->sort ?? 'id', $request->order ?? 'asc')
                ->paginate($request->per_page)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FamiliaProfesional $familiaProfesional)
    {
        if ($request->user()->email !== config('app.admin.email')) {
            return response()->json(['message' => 'No tienes permiso para crear un ciclo formativo'], 403);
        }
            $validate_Data = $request->validate([
                'nombre' => 'required',
                'codigo' => 'required|unique:ciclos_formativos,codigo',
                'grado' => 'required|in:basico,medio,superior',
                'descripcion' => 'required',
            ]);

            $validate_Data['familia_profesional_id'] = $familiaProfesional->id;

            $cicloFormativo = CicloFormativo::create($validate_Data);

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
        if ($request->user()->email !== config('app.admin.email')) {
            return response()->json(['message' => 'No tienes permiso para crear un ciclo formativo'], 403);
        }
        abort_if($cicloFormativo->familia_profesional_id !== $familiaProfesional->id, 404);
        $validate_Data = $request->validate([
            'nombre' => 'required',
            'codigo' => 'required|unique:ciclos_formativos,codigo',
            'grado' => 'required|in:basico,medio,superior',
            'descripcion' => 'required',
        ]);
        $cicloFormativo->update($validate_Data);

        return new CicloFormativoResource($cicloFormativo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, FamiliaProfesional $familiaProfesional, CicloFormativo $cicloFormativo)
    {
        if ($request->user()->email !== config('app.admin.email')) {
            return response()->json(['message' => 'No tienes permiso para crear un ciclo formativo'], 403);
        }
        abort_if($cicloFormativo->familia_profesional_id !== $familiaProfesional->id, 404);
        try {
            $cicloFormativo->delete();
            return response()->json(
                ['message' => 'CicloFormativo eliminado correctamente'],
                200
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
