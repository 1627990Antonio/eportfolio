<?php

use App\Http\Controllers\CiclosFormativosController;
use App\Http\Controllers\CriteriosEvaluacionController;
use App\Http\Controllers\FamiliasProfesionalesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResultadosAprendizajesController;
use App\Http\Controllers\EvidenciasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioImportController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {
    // Formulario de importación
    Route::get('/portfolio/import', [PortfolioImportController::class, 'showImportForm'])
        ->name('portfolio.import.index');

    // Importar desde JSON Resume
    Route::post('/portfolio/import/json-resume', [PortfolioImportController::class, 'importJsonResume'])
        ->name('portfolio.import.json-resume');

    // Importar desde GitHub
    Route::post('/portfolio/import/github', [PortfolioImportController::class, 'importGitHub'])
        ->name('portfolio.import.github');
});

Route::get('perfil/{id?}', function($id = null) {
    if($id){
        return "Visualizar el perfil de $id";
    } else {
        return "Visualizar el perfil propio";
    }
})->where('id', '[0-9]+');

// ----------------------------------------
Route::prefix('familias-profesionales')->group(function () {
    Route::get('/', [FamiliasProfesionalesController::class, 'getIndex']);
    Route::get('show/{id}', [FamiliasProfesionalesController::class, 'getShow']) -> where('id', '[0-9]+');

    Route::middleware('auth')->group(function () {
        Route::get('create', [FamiliasProfesionalesController::class, 'getCreate']);
        Route::get('edit/{id}', [FamiliasProfesionalesController::class, 'getEdit']) -> where('id', '[0-9]+');
        Route::post('store', [FamiliasProfesionalesController::class, 'postCreate']);
        Route::put('update/{id}', [FamiliasProfesionalesController::class, 'putEdit']) -> where('id', '[0-9]+');
    });
});


// ----------------------------------------
Route::prefix('criterios-evaluacion')->group(function () {
    Route::get('/', [CriteriosEvaluacionController::class, 'getIndex']);
    Route::get('show/{id}', [CriteriosEvaluacionController::class, 'getShow']) -> where('id', '[0-9]+');

    Route::middleware('auth')->group(function () {
        Route::get('create', [CriteriosEvaluacionController::class, 'getCreate']);
        Route::get('edit/{id}', [CriteriosEvaluacionController::class, 'getEdit']) -> where('id', '[0-9]+');
        Route::post('store', [CriteriosEvaluacionController::class, 'postCreate']);
        Route::put('update/{id}', [CriteriosEvaluacionController::class, 'putCreate']) -> where('id', '[0-9]+');
    });
});


// ----------------------------------------
Route::prefix('ciclos-formativos')->group(function () {
    Route::get('/', [CiclosFormativosController::class, 'getIndex']);
    Route::get('show/{id}', [CiclosFormativosController::class, 'getShow']) -> where('id', '[0-9]+');

    Route::middleware('auth')->group(function () {
        Route::get('create', [CiclosFormativosController::class, 'getCreate']);
        Route::get('edit/{id}', [CiclosFormativosController::class, 'getEdit']) -> where('id', '[0-9]+');
        Route::post('store', [CiclosFormativosController::class, 'postCreate']);
        Route::put('update/{id}', [CiclosFormativosController::class, 'putCreate']) -> where('id', '[0-9]+');
    });
});


// ----------------------------------------
Route::prefix('resultados-aprendizaje')->group(function () {
    Route::get('/', [ResultadosAprendizajesController::class, 'getIndex']);
    Route::get('show/{id}', [ResultadosAprendizajesController::class, 'getShow']) -> where('id', '[0-9]+');

    Route::middleware('auth')->group(function () {
        Route::get('create', [ResultadosAprendizajesController::class, 'getCreate']);
        Route::get('edit/{id}', [ResultadosAprendizajesController::class, 'getEdit']) -> where('id', '[0-9]+');
        Route::post('store', [ResultadosAprendizajesController::class, 'postCreate']);
        Route::put('update/{id}', [ResultadosAprendizajesController::class, 'putCreate']) -> where('id', '[0-9]+');
    });
});


// ----------------------------------------
// Rutas para la subida de ficheros de evidencias
// Añadir el controlador de evidencias
Route::prefix('evidencias')->group(function () {
    Route::get('/', [EvidenciasController::class, 'getIndex']);
    Route::get('show/{id}', [EvidenciasController::class, 'getShow']) -> where('id', '[0-9]+');

    Route::middleware('auth')->group(function () {
        Route::get('create', [EvidenciasController::class, 'getCreate']);
        Route::get('edit/{id}', [EvidenciasController::class, 'getEdit']) -> where('id', '[0-9]+');
        Route::post('store', [EvidenciasController::class, 'store']);
        Route::put('update/{id}', [EvidenciasController::class, 'update']) -> where('id', '[0-9]+');
    });
});


require __DIR__.'/auth.php';
