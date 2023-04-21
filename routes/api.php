<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\InformationFieldController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\TraductionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRoles;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('admin')->group(function () {

        // Route::resource('projects', ProjectController::class);
        // Route::resource('technologies', TechnologyController::class);

        // Projects: crear y actualizar
        Route::post('projects', [ProjectController::class, 'store']);
        Route::put('projects/{id}', [ProjectController::class, 'update']);

        // Technologies: crear y actualizar
        Route::post('technologies', [TechnologyController::class, 'store']);
        Route::put('technologies/{id}', [TechnologyController::class, 'update']);

        // Fields: crear y actualizar
        Route::post('fields', [InformationFieldController::class, 'store']);
        Route::put('fields/{id}', [InformationFieldController::class, 'update']);

        // Route::resource('traduction', TraductionController::class);

        Route::post('traduction/traduct', [TraductionController::class, 'traductAndStore']);
        Route::post('traduction/onlytraduct', [TraductionController::class, 'traduct']);
    });
});



Route::post('login', [LoginController::class, 'login'])->name('login');

// mostrar proyectos con tecnologías
Route::get('projects', [ProjectController::class, 'index']);
// mostrar fields
Route::get('fields', [InformationFieldController::class, 'index']);
// mostrar tecnologías
Route::get('technologies', [TechnologyController::class, 'index']);

