<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotebookController;
use App\Models\Notebook;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::prefix('/notebook')->group(function () {
    Route::get('/', [NotebookController::class, 'getNotebook']);
    Route::post('/create', [NotebookController::class, 'create']);
    Route::post('/{id}/update', [NotebookController::class, 'edit']);
    Route::get('/{id}', [NotebookController::class, 'getById']);
    Route::delete('/{id}', [NotebookController::class, 'deleteNotebook']);
});
