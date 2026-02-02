<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Psr\Http\Message\ServerRequestInterface;
use Tqdev\PhpCrudApi\Api;
use Tqdev\PhpCrudApi\Config\Config;
use App\Http\Controllers\API\ComentariosController;
use App\Http\Controllers\API\AsignacionesController;
use App\Http\Controllers\API\CicloFormativoController;
use App\Http\Controllers\API\CriteriosTareasController;
use App\Http\Controllers\API\EvaluacionEvidenciaController;
use App\Http\Controllers\API\EvidenciaController;
use App\Http\Controllers\API\TareasController;
use App\Http\Controllers\API\CriterioEvaluacionController;
use App\Http\Controllers\API\FamiliaProfesionalController;
use App\Http\Controllers\API\MatriculasController;
use App\Http\Controllers\API\ModuloFormativoController;
use App\Http\Controllers\API\ResultadoAprendizajeController;
use App\Models\CicloFormativo;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas PHP-CRUD-API
Route::prefix('v1')->group(function () {
    // ------------------------------------------------
    // FAMILIAS PROFESIONALES
    Route::apiResource('familias-profesionales', FamiliaProfesionalController::class)->parameters([
        'familias-profesionales' => 'familiaProfesional'
    ]);

    // ------------------------------------------------
    // CICLOS FORMATIVOS
    Route::apiResource('familias-profesionales.ciclos-formativos', CicloFormativoController::class)->parameters([
        'familias-profesionales' => 'familiaProfesional',
        'ciclos-formativos' => 'cicloFormativo'
    ]);

    // ------------------------------------------------
    // MODULOS FORMATIVOS
    Route::apiResource('ciclos-formativos.modulos-formativos', ModuloFormativoController::class)->parameters([
        'ciclos-formativos' => 'cicloFormativo',
        'modulos-formativos' => 'moduloFormativo'
    ]);

    // ------------------------------------------------
    // COMENTARIOS
    Route::apiResource('evidencias.comentarios', ComentariosController::class);

    // ------------------------------------------------
    // ASIGNACIONES
    Route::apiResource('evidencias.asignaciones-revision', AsignacionesController::class);

    // ------------------------------------------------
    // USER-ASIGNACIONES
    Route::get('users/{user_id}/asignaciones-revision', [AsignacionesController::class, 'asignacionUsuarios']);

    // --------------------------------------------------
    // TAREAS
    Route::apiResource('tareas', TareasController::class)->only('store', 'update', 'destroy');
    Route::apiResource('criterios-evaluacion.tareas', TareasController::class)
        ->only('index', 'show')
        ->parameters(['criterios-evaluacion' => 'criterios']);
    Route::apiResource('resultados-aprendizaje.tareas', TareasController::class)
        ->only('index')
        ->parameters(['resultados-aprendizaje' => 'resultados']);

    // --------------------------------------------------
    // EVIDENCIAS
    Route::apiResource('tareas.evidencias', EvidenciaController::class);
    Route::get('users/{parent_id}/evidencias', [EvidenciaController::class, 'showUserEvidencias']);

    // --------------------------------------------------
    // EVALUACION EVIDENCIAS
    Route::apiResource('evidencias.evaluaciones-evidencias', EvaluacionEvidenciaController::class)->parameters([
        'evaluaciones-evidencias' => 'evaluacionEvidencia'
    ]);

    // --------------------------------------------------
    // MATRICULAS
    Route::apiResource('modulos-formativos.matriculas', MatriculasController::class)->parameters([
        'modulos-formativos' => 'moduloFormativo'
    ]);

    // --------------------------------------------------
    // RESULTADOS APRENDIZAJE
    Route::apiResource('modulos-formativos.resultados-aprendizaje', ResultadoAprendizajeController::class)->parameters([
        'modulos-formativos' => 'moduloFormativo'
    ]);

    // --------------------------------------------------
    // CRITERIOS EVALUACION
    Route::apiResource('resultados-aprendizaje.criterios-evaluacion', CriterioEvaluacionController::class)->parameters([
        'resultados-aprendizaje' => 'resultadoAprendizaje'
    ]);
});

Route::any('/{any}', function (ServerRequestInterface $request) {
    $config = new Config([
        'address' => env('DB_HOST', '127.0.0.1'),
        'database' => env('DB_DATABASE', 'forge'),
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
        'basePath' => '/api',
    ]);
    $api = new Api($config);
    $response = $api->handle($request);

    try {
        $records = json_decode($response->getBody()->getContents())->records;
        $response = response()->json($records, 200, $headers = ['X-Total-Count' => count($records)]);
    } catch (\Throwable $th) {

    }
    return $response;

})->where('any', '.*');
