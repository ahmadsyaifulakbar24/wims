<?php

use App\Http\Controllers\API\Attendance\CreateAttendanceController;
use App\Http\Controllers\API\Attendance\DeleteAttendanceController;
use App\Http\Controllers\API\Attendance\GetAttendanceController;
use App\Http\Controllers\API\Attendance\UpdateAttendanceController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\ResetPasswordController;
use App\Http\Controllers\API\Board\BoardMemberController;
use App\Http\Controllers\API\Board\CreateBoardController;
use App\Http\Controllers\API\Board\DeleteBoardController;
use App\Http\Controllers\API\Board\GetBoardController;
use App\Http\Controllers\API\Board\LabelController;
use App\Http\Controllers\API\Board\UpdateBoardController;
use App\Http\Controllers\API\Comment\CreateCommentController;
use App\Http\Controllers\API\Comment\DeleteCommentController;
use App\Http\Controllers\API\Comment\GetCommentController;
use App\Http\Controllers\API\Comment\UpdateCommentController;
use App\Http\Controllers\API\Company\CreateCompanyController;
use App\Http\Controllers\API\Company\DeleteCompanyController;
use App\Http\Controllers\API\Company\GetCompanyController;
use App\Http\Controllers\API\Company\UpdateCompanyController;
use App\Http\Controllers\API\Division\CreateDivisionController;
use App\Http\Controllers\API\Division\DeleteDivisionController;
use App\Http\Controllers\API\Division\GetDivisionController;
use App\Http\Controllers\API\Division\UpdateDivisionController;
use App\Http\Controllers\API\Employee\CreateEmployeeController;
use App\Http\Controllers\API\Employee\DeleteEmployeeController;
use App\Http\Controllers\API\Employee\GetEmployeeController;
use App\Http\Controllers\API\Employee\UpdateEmployeeController;
use App\Http\Controllers\API\leave\CreateLeaveController;
use App\Http\Controllers\API\leave\DeleteLeaveController;
use App\Http\Controllers\API\leave\GetLeaveController;
use App\Http\Controllers\API\leave\UpdateLeaveController;
use App\Http\Controllers\API\MasterParam\GetMasterParamController;
use App\Http\Controllers\API\Param\EmployeeStatusController;
use App\Http\Controllers\API\Param\JobLevelController;
use App\Http\Controllers\API\Param\JobPositionController;
use App\Http\Controllers\API\Param\OrganizationController;
use App\Http\Controllers\API\Ptkp\PtkpController;
use App\Http\Controllers\API\Registration\CreateRegistrationController;
use App\Http\Controllers\API\Task\CreateTaskController;
use App\Http\Controllers\API\Task\DeleteTaskController;
use App\Http\Controllers\API\Task\GetTaskController;
use App\Http\Controllers\API\Task\UpdateTaskController;
use App\Http\Controllers\API\User\CreateUserController;
use App\Http\Controllers\API\UserReport\CreateUserReportController;
use App\Http\Controllers\API\UserReport\DeleteUserReportController;
use App\Http\Controllers\API\UserReport\GetUserReportController;
use App\Http\Controllers\API\UserReport\UpdateUserReportController;
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

Route::prefix('master_param')->group(function () {
    Route::get('employee_reach', [GetMasterParamController::class, 'employee_reach']);
});
Route::post('login', LoginController::class);
Route::post('registration', CreateRegistrationController::class);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', LogoutController::class);
    Route::post('reset_password', ResetPasswordController::class);

    Route::prefix('company')->group(function () {
        Route::get('/fetch/{company_id?}', GetCompanyController::class);
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

    Route::prefix('ptkp')->group(function () {
        Route::get('/{ptkp_id?}', [PtkpController::class, 'fetch']);
        Route::post('/create', [PtkpController::class, 'create']);
        Route::patch('{ptkp:id}/update', [PtkpController::class, 'update']);
        Route::delete('{ptkp:id}/delete', [PtkpController::class, 'delete']);
    });

    Route::prefix('employee')->group(function () {
        Route::get('fetch/{user_id?}', [GetEmployeeController::class, 'fetch']);
        Route::post('create', CreateEmployeeController::class);
        Route::post('{user:id}/update', UpdateEmployeeController::class);
        Route::delete('{user:id}/delete', DeleteEmployeeController::class);
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
        Route::get('{board:id}/get_member', [BoardMemberController::class, 'get_member']);
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
            Route::patch('/{task:id}/update', [UpdateTaskController::class, 'task']);
            Route::delete('/{task:id}/archive', [DeleteTaskController::class, 'archive_task']);
        // End Task

        // Task Member
            Route::post('{task:id}/create_task_member', [CreateTaskController::class, 'task_member']);
            Route::get('{task:id}/get_task_member', [GetTaskController::class, 'task_member']);
            Route::delete('{task:id}/{user_id}/delete_task_member', [DeleteTaskController::class, 'task_member']);
        // End Task Member

        // Task Checklist
            Route::get('{task:id}/get_checklist', [GetTaskController::class, 'checklist']);
            Route::post('{task:id}/create_checklist', [CreateTaskController::class, 'checklist']);
            Route::patch('{checklist:id}/update_checklist', [UpdateTaskController::class, 'checklist']);
            Route::delete('{checklist:id}/delete_checklist', [DeleteTaskController::class, 'checklist']);
        // End Task Checklist

        // Task Checklist Item
            Route::post('{checklist:id}/create_checklist_item', [CreateTaskController::class, 'checklist_item']);
            Route::patch('{checklist_item:id}/update_checklist_item', [UpdateTaskController::class, 'checklist_item']);
            Route::delete('{checklist_item:id}/delete_checklist_item', [DeleteTaskController::class, 'checklist_item']);
        // End Task Checklist Item 

        // Task Attachment
            Route::get('{task:id}/get_attachment', [GetTaskController::class, 'attachment']);
            Route::post('{task:id}/attachment', [CreateTaskController::class, 'attachment']);
            Route::patch('{task_attachment:id}/update_attachment', [UpdateTaskController::class, 'attachment']);
            Route::delete('{task_attachment:id}/delete_attachment', [DeleteTaskController::class, 'attachment']);
        // End Attachment

        // Task Comment
            Route::post('{task:id}/create_comment', CreateCommentController::class);
            Route::get('{task:id}/get_comment', GetCommentController::class);
            Route::patch('{comment:id}/update_comment', UpdateCommentController::class);
            Route::delete('{comment:id}/delete_comment', DeleteCommentController::class);
        // End Task Comment

        // Task Lable
            Route::post('{task:id}/create_label', [CreateTaskController::class, 'label']);
            Route::get('{task:id}/get_label', [GetTaskController::class, 'label']);
            Route::delete('{task:id}/delete_label', [DeleteTaskController::class, 'label']);
        // End Task Lable
    });

    Route::prefix('user_report')->group(function () {
        Route::post('/create', [CreateUserReportController::class, 'user_report']);
        Route::get('/fetch/{user_report_id?}', [GetUserReportController::class, 'user_report']);
        Route::patch('{user_report:id}/update', [UpdateUserReportController::class, 'user_report']);
        Route::delete('{user_report:id}/archive', [DeleteUserReportController::class, 'user_report']);

        Route::prefix('attachment')->group(function () {
            Route::post('{user_report:id}/create', [CreateUserReportController::class, 'attachment']);
            Route::get('{user_report:id}/fetch', [GetUserReportController::class, 'attachment']);
        });

        Route::prefix('comment')->group(function () {
            Route::post('{user_report:id}/create', [CreateUserReportController::class, 'comment']);
            Route::get('{user_report:id}/fetch', [GetUserReportController::class, 'comment']);
        });
    });

    Route::prefix('attendance')->group(function () {
        Route::get('fetch/{attendance_id?}', [GetAttendanceController::class, 'fetch']);
        Route::post('attendance_login', [CreateAttendanceController::class, 'attendance_login']);
        Route::post('{attendance:id}/attendance_home', [CreateAttendanceController::class, 'attendance_home']);
        Route::post('{attendance:id}/update', UpdateAttendanceController::class);
        Route::delete('{attendance:id}/delete', DeleteAttendanceController::class);
    });

    Route::prefix('leave')->group(function () {
        Route::get('fetch/{leave_id?}', [GetLeaveController::class, 'fetch']);
        Route::post('create', [CreateLeaveController::class, 'create']);
        Route::post('{leave:id}/create_comment', [CreateLeaveController::class, 'comment']);
        Route::get('{leave:id}/get_comment', [GetLeaveController::class, 'comment']);
        Route::patch('{leave:id}/approval', [UpdateLeaveController::class, 'approval']);
        Route::patch('{leave:id}/update', [UpdateLeaveController::class, 'update']);
        Route::delete('{leave:id}/delete', DeleteLeaveController::class);
    });

    Route::prefix('user')->group(function () {
        Route::post('create_admin', [CreateUserController::class, 'admin']);
    });

    Route::prefix('master_param')->group(function () {
        Route::get('education', [GetMasterParamController::class, 'education']);
        Route::get('religion', [GetMasterParamController::class, 'religion']);
        Route::get('marital_status', [GetMasterParamController::class, 'marital_status']);
        Route::get('blood_type', [GetMasterParamController::class, 'blood_type']);
        Route::get('bank', [GetMasterParamController::class, 'bank']);
        Route::get('province', [GetMasterParamController::class, 'province']);
        Route::get('city/{province:id}', [GetMasterParamController::class, 'city']);
        Route::get('jkk', [GetMasterParamController::class, 'jkk']);
    });

});
