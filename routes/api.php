<?php

use App\Http\Controllers\Api\EstadoController;
use App\Http\Controllers\Api\MunicipalityController;
use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\SuburbController;
use App\Http\Controllers\Api\ZipController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('estados', StateController::class)->only(['index', 'show'])->names('estados');
Route::get('estados/{id}/municipios', [StateController::class, 'municipalities'])
    ->name('estados.asentamientos');

Route::apiResource('municipios', MunicipalityController::class, [
    'parameters' => [
        'municipios' => 'municipality'
    ]
])->only(['index', 'show'])
    ->names('municipios');

Route::get('municipios/{id}/asentamientos', [MunicipalityController::class, 'suburbs'])
    ->name('municipios.asentamientos');

Route::apiResource('asentamientos', SuburbController::class, [
    'parameters' => [
        'asentamientos' => 'suburb'
    ]
])->only(['index', 'show'])
    ->names('asentamientos');

Route::get('cp/{cp}', ZipController::class)->name('zip');
