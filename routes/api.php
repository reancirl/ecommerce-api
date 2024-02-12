<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::group(['middleware' => ['verified']], function(){

        Route::get('/user', function(Request $request) {
            return $request->user();
        });

        Route::apiResource('roles', RoleController::class);
        Route::post('/roles/{role}/permissions', [RoleController::class, 'assignPermissions']);
        Route::get('/permissions', [RoleController::class, 'getAllPermissions']);
    });

    Route::post('/token/destroy',function(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Token deleted!'
        ]);
    });
});
