<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Board\BoardMemberController;
use App\Http\Controllers\API\Board\CreateBoardController;
use App\Http\Controllers\API\Board\DeleteBoardController;
use App\Http\Controllers\API\Board\GetBoardController;
use App\Http\Controllers\API\Board\LabelController;
use App\Http\Controllers\API\Board\UpdateBoardController;
use App\Http\Controllers\API\Company\CreateCompanyController;
use App\Http\Controllers\API\Company\DeleteCompanyController;
use App\Http\Controllers\API\Company\GetCompanyController;
use App\Http\Controllers\API\Company\UpdateCompanyController;
use App\Http\Controllers\API\Division\CreateDivisionController;
use App\Http\Controllers\API\DIvision\DeleteDivisionController;
use App\Http\Controllers\API\DIvision\GetDivisionController;
use App\Http\Controllers\API\DIvision\UpdateDivisionController;
use App\Http\Controllers\API\Employee\CreateEmployeeController;
use App\Http\Controllers\API\Employee\DeleteEmployeController;
use App\Http\Controllers\API\Employee\GetEmployeeController;
use App\Http\Controllers\API\Employee\UpdateEmployeeController;
use App\Http\Controllers\API\Param\EmployeeStatusController;
use App\Http\Controllers\API\Param\JobLevelController;
use App\Http\Controllers\API\Param\JobPositionController;
use App\Http\Controllers\API\Param\OrganizationController;
use App\Http\Controllers\API\Task\CreateTaskController;
use App\Http\Controllers\API\Task\GetTaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', LoginController::class);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', LogoutController::class);

    Route::prefix('company')->group(function () {
        Route::get('/', GetCompanyController::class);
        Route::post('/create', CreateCompanyController::class);
        Route::post('{company:id}/update', UpdateCompanyController::class);
        Route::delete('{company:id}/delete', DeleteCompanyController::class);
    });

    Route::prefix('organization')->group(function () {
        Route::get('/', [OrganizationController::class, 'fetch']);
        Route::post('/create', [OrganizationController::class, 'create']);
        Route::patch('{param:id}/update', [OrganizationController::class, 'update']);
        Route::delete('{param:id}/delete', [OrganizationController::class, 'delete']);
    });

    Route::prefix('job_level')->group(function () {
        Route::get('/', [JobLevelController::class, 'fetch']);
        Route::post('/create', [JobLevelController::class, 'create']);
        Route::patch('{param:id}/update', [JobLevelController::class, 'update']);
        Route::delete('{param:id}/delete', [JobLevelController::class, 'delete']);
    });

    Route::prefix('job_position')->group(function () {
        Route::get('/', [JobPositionController::class, 'fetch']);
        Route::post('/create', [JobPositionController::class, 'create']);
        Route::patch('{param:id}/update', [JobPositionController::class, 'update']);
        Route::delete('{param:id}/delete', [JobPositionController::class, 'delete']);
    });

    Route::prefix('employee_status')->group(function () {
        Route::get('/', [EmployeeStatusController::class, 'fetch']);
        Route::post('/create', [EmployeeStatusController::class, 'create']);
        Route::patch('{param:id}/update', [EmployeeStatusController::class, 'update']);
        Route::delete('{param:id}/delete', [EmployeeStatusController::class, 'delete']);
    });

    Route::prefix('employee')->group(function () {
        Route::get('fetch/{user_id?}', [GetEmployeeController::class, 'fetch']);
        Route::post('create', CreateEmployeeController::class);
        Route::post('{user:id}/update', UpdateEmployeeController::class);
        Route::delete('{user:id}/delete', DeleteEmployeController::class);
    });

    Route::prefix('division')->group(function () {
        Route::get('fetch/{division_id?}', [GetDivisionController::class, 'fetch']);
        Route::post('create', CreateDivisionController::class);
        Route::patch('{division:id}/update', UpdateDivisionController::class);
        Route::delete('{division:id}/delete', DeleteDivisionController::class);
    });

    Route::prefix('board')->group(function () {
        Route::get('fetch/{board_id?}', [GetBoardController::class, 'fetch']);
        Route::post('create', CreateBoardController::class);
        Route::patch('{board:id}/update', UpdateBoardController::class);
        Route::delete('{board:id}/soft_delete', [DeleteBoardController::class, 'soft_delete']);
        Route::post('{board:id}/add_member', [BoardMemberController::class, 'add_member']);
        Route::delete('{board_member:id}/delete_member', [BoardMemberController::class, 'delete_member']);
        Route::prefix('label')->group(function() {
            Route::get('fetch/{board:id}', [LabelController::class, 'fetch']);
            Route::post('create', [LabelController::class, 'create']);
            Route::patch('{board_label:id}/update', [LabelController::class, 'update']);
            Route::delete('{board_label:id}/delete', [LabelController::class, 'delete']);
        });
    });

    Route::prefix('task')->group(function () {
        // Task Route
            Route::post('/create', [CreateTaskController::class, 'task']);
            Route::get('/fetch/{task_id?}', [GetTaskController::class, 'task']);
        // End Task
        Route::post('{task:id}/create_task_member', [CreateTaskController::class, 'task_member']);
        Route::post('{task:id}/create_checklist', [CreateTaskController::class, 'checklist']);
        Route::post('{checklist:id}/create_checklist_item', [CreateTaskController::class, 'checklist_item']);
        Route::post('{task:id}/attachment', [CreateTaskController::class, 'attachment']);
    });
});
