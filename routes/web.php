<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;

Route::get('session/login', [SessionController::class, 'createSession']);
Route::get('session/logout', [SessionController::class, 'deleteSession']);

Route::group(['middleware'=>['afterMiddleware']], function () {
	Route::get('/', function () {
		return redirect('login');
	});
	Route::get('login', function () {
		return view('auth/login');
	});
	Route::get('register', function () {
		return view('auth/register');
	});
});

Route::group(['middleware'=>['beforeMiddleware']], function () {
	Route::get('dashboard', function () {
		return view('dashboard');
	});
	Route::get('account/detail', function () {
		return view('account/detail');
	});
	Route::get('account/password', function () {
		return view('account/password');
	});


	// Employee
	Route::get('employee', function () {
		return view('employee');
	});
	Route::get('employee/create', function () {
		return view('create-employee');
	});
	Route::get('employee/{id}', function ($id) {
		return view('view-employee', compact('id'));
	});
	

	// Task Management
	Route::get('task-management/division', function () {
		return view('task-management/division');
	});
    Route::get('task-management/project/{id}', function ($id) {
        return view('task-management/project', compact('id'));
    });
    Route::get('task-management/task/{id}', function ($id) {
        return view('task-management/task', compact('id'));
    });


    // Time Management
	Route::get('time-management/attendance', function () {
		return view('attendance');
	});
	Route::get('time-management/attendance/{id}', function ($id) {
		return view('view-attendance', compact('id'));
	});

	Route::get('time-management/leave', function () {
		return view('time-management/leave');
	});
	Route::get('time-management/leave/{id}', function ($id) {
		return view('time-management/view-leave', compact('id'));
	});
	

	// Company
	Route::get('company/head-office', function () {
		return view('company/head-office');
	});
	Route::get('company/head-office/{id}', function ($id) {
		return view('view-head-office', compact('id'));
	});

	Route::get('company/branch', function () {
		return view('company/branch');
	});
	Route::get('company/branch/create', function () {
		return view('company/create-branch');
	});
	Route::get('company/branch/{id}', function ($id) {
		return view('company/edit-branch', compact('id'));
	});

	Route::get('company/organization-structure', function () {
		return view('company/organization-structure');
	});

	Route::get('company/job-level', function () {
		return view('company/job-level');
	});

	Route::get('company/job-position', function () {
		return view('company/job-position');
	});

	Route::get('company/employee-status', function () {
		return view('company/employee-status');
	});
	Route::get('company/employee-status/{id}', function ($id) {
		return view('view-employee-status', compact('id'));
	});
});