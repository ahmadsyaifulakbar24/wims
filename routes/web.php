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
	Route::get('account/detail', function () {
		return view('account/detail');
	});
	Route::get('account/password', function () {
		return view('account/password');
	});

	Route::group(['middleware'=>['userMiddleware']], function () {
		Route::get('home', function () {
			return view('home');
		});
		Route::get('attendance', function () {
			return view('attendance');
		});
		Route::get('attendance/{type}/{date}', function ($type, $date) {
			return view('view-attendance', compact('type', 'date'));
		});
		Route::get('task', function () {
			return view('task');
		});
		Route::get('report', function () {
			return view('report');
		});
		Route::get('leave', function () {
			return view('leave');
		});
	});
		
	// Task
	Route::get('task-management/division', function () {
		return view('admin/task-management/division');
	});
    Route::get('task-management/project/{id}', function ($id) {
        return view('admin/task-management/project', compact('id'));
    });
    Route::get('task-management/task/{id}', function ($id) {
        return view('admin/task-management/task', compact('id'));
    });

	Route::group(['middleware'=>['adminMiddleware']], function () {
		Route::get('dashboard', function () {
			return view('admin/dashboard');
		});

		// Employee
		Route::get('employee', function () {
			return view('admin/employee');
		});
		Route::get('employee/add', function () {
			return view('admin/add-employee');
		});
		Route::get('employee/{id}', function ($id) {
			return view('admin/edit-employee', compact('id'));
		});


	    // Time Management
		Route::get('time-management/attendance', function () {
			return view('admin/attendance');
		});
		Route::get('time-management/attendance/{id}', function ($id) {
			return view('admin/view-attendance', compact('id'));
		});

		Route::get('time-management/leave', function () {
			return view('admin/time-management/leave');
		});
		Route::get('time-management/leave/{id}', function ($id) {
			return view('admin/time-management/view-leave', compact('id'));
		});
		

		// Company
		Route::get('company/head-office', function () {
			return view('admin/company/head-office');
		});
		Route::get('company/head-office/{id}', function ($id) {
			return view('admin/view-head-office', compact('id'));
		});

		Route::get('company/branch', function () {
			return view('admin/company/branch');
		});
		Route::get('company/branch/add', function () {
			return view('admin/company/add-branch');
		});
		Route::get('company/branch/{id}', function ($id) {
			return view('admin/company/edit-branch', compact('id'));
		});

		Route::get('company/organization-structure', function () {
			return view('admin/company/organization-structure');
		});
		Route::get('company/job-position', function () {
			return view('admin/company/job-position');
		});
		Route::get('company/job-level', function () {
			return view('admin/company/job-level');
		});
		Route::get('company/employee-status', function () {
			return view('admin/company/employee-status');
		});
		Route::get('company/ptkp', function () {
			return view('admin/company/ptkp');
		});
	});
});