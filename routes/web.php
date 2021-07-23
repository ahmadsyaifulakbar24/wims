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

	Route::get('employees', function () {
		return view('employees');
	});
	Route::get('employee/create', function () {
		return view('create-employee');
	});
	Route::get('employee/{id}', function ($id) {
		return view('view-employee', compact('id'));
	});
	
	Route::get('task-management/division', function () {
		return view('division');
	});
    Route::get('task-management/division/{id}', function ($id) {
        return view('view-division', compact('id'));
    });
    Route::get('task-management/board/{id}', function ($id) {
        return view('view-board', compact('id'));
    });

	Route::get('time-management/attendance', function () {
		return view('attendance');
	});
	Route::get('time-management/attendance/{id}', function ($id) {
		return view('view-attendance', compact('id'));
	});
	
	Route::get('branch', function () {
		return view('branch');
	});
	Route::get('company', function () {
		return view('company');
	});
});