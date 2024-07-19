<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ChecklistItemController;

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

Route::group(['middleware' => 'api'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'api', 'prefix' => 'checklist'
], function ($router) {
    Route::get('/', [ChecklistController::class, 'getAllCheckList']);
    Route::post('/', [ChecklistController::class, 'createNewCheckList']);
    Route::delete('{id}', [ChecklistController::class, 'deleteCheckListByID']);

    Route::get('{checklistId}/item', [ChecklistItemController::class, 'getAllChecklistItemByChecklistId']);
    Route::post('{checklistId}/item', [ChecklistItemController::class, 'createNewChecklistItemInChecklist']);
    Route::get('{checklistId}/item/{checklistItemId}', [ChecklistItemController::class, 'getChecklistItemInChecklistByChecklistId']);
    Route::put('{checklistId}/item/{checklistItemId}', [ChecklistItemController::class, 'updateStatusChecklistItemByChecklistItemId']);
    Route::delete('{checklistId}/item/{checklistItemId}', [ChecklistItemController::class, 'deleteItemByChecklistItemId']);
    Route::put('{checklistId}/item/rename/{checklistItemId}', [ChecklistItemController::class, 'renameItemByChecklistItemId']);

});
