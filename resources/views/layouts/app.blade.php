<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - WIMS</title>
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/loader.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    @yield('style')
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark {{Request::is('logout')?'none':''}}">
    	<div class="d-flex align-items-center">
    		@if(session("role") != 101)
	        <div class="navbar-toggler border-0 pl-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	        	<i class="mdi mdi-24px mdi-menu pr-0"></i>
	        </div>	        
	        <a class="navbar-brand" href="{{url('dashboard')}}">WIMS</a>
	        @endif
    		@if(session("role") == 101)
	    		@if(Request::is('home')) <div class="navbar-brand">Home</div>
	    		@elseif(Request::is('attendance')) <div class="navbar-brand"><i class="mdi mdi-arrow-left" onclick="return history.back()"></i> Attendance</div>
	    		@elseif(Request::is('attendance/*/*')) <div class="navbar-brand"><i class="mdi mdi-arrow-left" onclick="return history.back()"></i> View Attendance</div>
	    		@elseif(Request::is('task-management/division')) <div class="navbar-brand"><i class="mdi mdi-arrow-left" onclick="return history.back()"></i> Select Division</div>
	    		@elseif(Request::is('task-management/project/*')) <div class="navbar-brand"><i class="mdi mdi-arrow-left" onclick="return history.back()"></i> Select Project</div>
	    		@elseif(Request::is('task-management/task/*')) <div class="navbar-brand"><i class="mdi mdi-arrow-left" onclick="return history.back()"></i> Tasks</div>
	    		@elseif(Request::is('report')) <div class="navbar-brand"><i class="mdi mdi-arrow-left" onclick="return history.back()"></i> Report</div>
	    		@elseif(Request::is('account')) <div class="navbar-brand"><i class="mdi mdi-arrow-left" onclick="return history.back()"></i> Personal Info</div>
		        @endif
	        @endif
	    </div>
	    <div class="collapse navbar-collapse order-2 order-sm-1" id="navbarSupportedContent">
	    	@if(session("role") == 1)
            <ul class="navbar-nav mx-auto">
                <li class="nav-item {{Request::is('superadmin')?'active':''}}">
                    <a class="nav-link" href="{{url('superadmin')}}">Dashboard</a>
                </li>
                <li class="nav-item {{Request::is('company')?'active':''}}">
                    <a class="nav-link" href="{{url('company')}}">Company</a>
                </li>
                <li class="nav-item {{Request::is('company/ptkp')?'active':''}}">
                    <a class="nav-link" href="{{url('company/ptkp')}}">PTKP</a>
                </li>
            </ul>
	    	@elseif(session("role") == 100)
            <ul class="navbar-nav mx-auto">
                <li class="nav-item {{Request::is('dashboard')?'active':''}}">
                    <a class="nav-link" href="{{url('dashboard')}}">Dashboard</a>
                </li>
                <li class="nav-item {{Request::is('employee')?'active':''}}">
                    <a class="nav-link" href="{{url('employee')}}">Employee</a>
                </li>
                <li class="nav-item dropdown">
                    <div class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Task Management
                    </div>
                    <div class="dropdown-menu rounded rounded border-0 mt-0 mt-sm-3" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('task-management/division')}}">Division</a>
                        <a class="dropdown-item" href="{{url('task-management/report')}}">Report</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <div class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Time Management
                    </div>
                    <div class="dropdown-menu rounded rounded border-0 mt-0 mt-sm-3" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('time-management/attendance')}}">Attendance</a>
                        <a class="dropdown-item" href="javascript:void(0)">Leave</a>
                        <!-- <a class="dropdown-item" href="{{url('task-management/leave')}}">Leave</a> -->
                        <!-- <a class="dropdown-item" href="{{url('time-management/overtime')}}">Overtime</a> -->
                        <!-- <a class="dropdown-item" href="{{url('time-management/time-off')}}">Time Off</a> -->
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <div class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Company
                    </div>
                    <div class="dropdown-menu rounded rounded border-0 mt-0 mt-sm-3" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('company/head-office')}}">Head Office</a>
                        <a class="dropdown-item" href="{{url('company/branch')}}">Branch</a>
                        <a class="dropdown-item" href="{{url('company/organization-structure')}}">Organization Structure</a>
                        <a class="dropdown-item" href="{{url('company/job-position')}}">Job Position</a>
                        <a class="dropdown-item" href="{{url('company/job-level')}}">Job Level</a>
                        <a class="dropdown-item" href="{{url('company/employee-status')}}">Employee Status</a>
                        <a class="dropdown-item" href="{{url('company/ptkp')}}">PTKP</a>
                    </div>
                </li>
            </ul>
            @endif
        </div>
        <div class="dropdown order-1 order-sm-2">
            <a id="dropdownMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{asset('assets/images/user.jpg')}}" class="avatar rounded-circle" width="30">
            </a>
            <div class="dropdown-menu dropdown-menu-right rounded border-0 mt-3" aria-labelledby="dropdownMenu">
                <div class="px-3 py-2 d-flex align-items-center">
                    <img src="{{asset('assets/images/user.jpg')}}" class="avatar rounded-circle border" width="40">
                    <div class="ml-3 text-truncate">
                        <h6 class="name text-truncate mb-0"></h6>
                        <small class="username">@</small>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{url('account')}}">
                    <i class="mdi mdi-18px mdi-account-box-outline"></i>
                    <span>Personal info</span>
                </a>
                <a class="dropdown-item" href="{{url('account/password')}}">
                    <i class="mdi mdi-18px mdi-lock-outline"></i>
                    <span>Change password</span>
                </a>
                <a class="dropdown-item" href="javascript:void(0)" onclick="return logout()" data-toggle="modal" data-target="#modal-logout" role="button">
                    <i class="mdi mdi-18px mdi-login-variant"></i>
                    <span>Log out</span>
                </a>
            </div>
        </div>
    </nav>
    <div class="overlay"></div>
	<div class="main">
		@yield('content')
		@if(session("role") == 101)
    	<div class="fixed-bottom bg-white border-top w-100" style="bottom: 0">
    		<div class="container text-center">
				<div class="row">
					<div class="col-lg-6 col-md-8 offset-lg-3 offset-md-2">
			    		<div class="row">
			    			<a href="{{url('home')}}" class="col px-1 py-2 {{Request::is('home')?'text-dark':'text-black-50'}}">
			    				<i class="mdi mdi-18px mdi-home pr-0"></i>
			    				<small class="d-block">Home</small>
			    			</a>
			    			<a href="{{url('attendance')}}" class="col px-1 py-2 {{Request::is('attendance')?'text-dark':'text-black-50'}}">
			    				<i class="mdi mdi-18px mdi-clock-outline pr-0"></i>
			    				<small class="d-block">Attendance</small>
			    			</a>
			    			<a href="{{url('task-management/division')}}" class="col px-1 py-2 {{Request::is('task')?'text-dark':'text-black-50'}}">
			    				<i class="mdi mdi-18px mdi-file-document-box-check-outline pr-0"></i>
			    				<small class="d-block">Tasks</small>
			    			</a>
			    			<a href="{{url('report')}}" class="col px-1 py-2 {{Request::is('report')?'text-dark':'text-black-50'}}">
			    				<i class="mdi mdi-18px mdi-pencil-outline pr-0"></i>
			    				<small class="d-block">Report</small>
			    			</a>
			    			<!-- <a href="javascript:void(0)" class="col px-1 py-2 text-black-50" id="account">
			    				<img class="avatar rounded-circle" width="26" alt="">
			    				<small class="d-block">Account</small>
			    			</a> -->
			    		</div>
		    		</div>
	    		</div>
	    	</div>
    	</div>
    	@endif
    </div>
    <div class="modal" id="modal-logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <div class="loader">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10" />
                        </svg>
                    </div>
                    <h6 class="text-light mt-3">Logout...</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="customAlert d-flex align-items-center small"></div>
    @include('layouts.partials.script')
    @yield('script')
</body>
</html>