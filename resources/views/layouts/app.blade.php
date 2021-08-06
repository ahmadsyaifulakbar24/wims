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
        <a class="navbar-brand" href="{{url('dashboard')}}">
            <!-- <img src="{{asset('assets/images/eoffice.png')}}" width="30" class="d-inline-block align-top mr-2" alt="" loading="lazy"> -->
            WIMS
        </a>
       <!--  <div class="d-block d-md-none navbar-brand">
        	@if(Request::is('dashboard')) Dashboard
        	@else
        		<i class="mdi mdi-18px mdi-arrow-left" onclick="return history.back()"></i>
	        	@if(Request::is('employee')) Employee
	        	@elseif(Request::is('employee/create')) Create Employee
	        	@elseif(Request::is('company')) Company
	        	@elseif(Request::is('task-management/division')) Division
	        	@elseif(Request::is('time-management/attendance')) Attendance
	        	@elseif(Request::is('time-management/attendance/*')) View logs
	        	@endif
        	@endif
        </div> -->
        <!-- <div class="navbar-toggler border-0 pl-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        	<i class="mdi mdi-24px mdi-menu pr-0"></i>
        </div> -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                        <a class="dropdown-item" href="{{url('task-management/leave')}}">Leave</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <div class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Time Management
                    </div>
                    <div class="dropdown-menu rounded rounded border-0 mt-0 mt-sm-3" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('time-management/attendance')}}">Attendance</a>
                        <!-- <a class="dropdown-item" href="{{url('time-management/overtime')}}">Overtime</a> -->
                        <!-- <a class="dropdown-item" href="{{url('time-management/time-off')}}">Time Off</a> -->
                    </div>
                </li>
                <!-- <li class="nav-item dropdown">
                    <div class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Finance
                    </div>
                    <div class="dropdown-menu rounded" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('finance/')}}">Reimbursement</a>
                        <a class="dropdown-item" href="{{url('finance/')}}">Cash Advance</a>
                        <a class="dropdown-item" href="{{url('finance/')}}">Loan</a>
                    </div>
                </li>
                <li class="nav-item {{Request::is('payroll')?'active':''}}">
                    <a class="nav-link" href="{{url('payroll')}}">Payroll</a>
                </li> -->
                <li class="nav-item dropdown">
                    <div class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Company
                    </div>
                    <div class="dropdown-menu rounded rounded border-0 mt-0 mt-sm-3" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('company/head-office')}}">Head Office</a>
                        <a class="dropdown-item" href="{{url('company/branch')}}">Branch</a>
                        <a class="dropdown-item" href="{{url('company/organization-structure')}}">Organization Structure</a>
                        <a class="dropdown-item" href="{{url('company/job-level')}}">Job Level</a>
                        <a class="dropdown-item" href="{{url('company/job-position')}}">Job Position</a>
                        <a class="dropdown-item" href="{{url('company/employee-status')}}">Employee Status</a>
                    </div>
                </li>
            </ul>
        </div>
        <!-- <div class="dropdown ml-auto mr-2">
            <a class="text-white" id="dropdownMessage" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            	<i class="mdi mdi-24px mdi-email"></i>
                <span class="position-absolute badge badge-pill badge-danger py-1" style="font-size: 10px;right: 0px">1</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right rounded border-0 mt-3" aria-labelledby="dropdownMessage">
            	<div class="d-flex align-items-center justify-content-between px-3 pt-2 pb-3">
	            	<h6 class="mb-0">Notifications</h6>
	            	<a href="{{url('notifications')}}" class="small">View All</a>
	            </div>
	            <div class="text-center py-4" id="notification-empty">
	            	<i class="mdi mdi-48px mdi-email-open-outline pr-0"></i>
	            	<h6>You're All Done!</h6>
	            </div>
                <a class="dropdown-item d-flex align-items-center" href="{{url('notification/1')}}">
                    <img src="{{asset('assets/images/user.jpg')}}" class="rounded-circle" width="40">
                    <div class="pl-3 text-truncate">
	                    <span class="pl-0">Nur Hilmi</span>
	                    <small class="d-block text-secondary text-truncate">You just have a new employee</small>
	                </div>
                </a>
            </div>
        </div> -->
        <div class="dropdown">
            <a id="dropdownMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{asset('assets/images/user.jpg')}}" class="avatar rounded-circle" width="30">
            </a>
            <div class="dropdown-menu dropdown-menu-right rounded border-0 mt-3" aria-labelledby="dropdownMenu">
                <a href="{{url('account/detail')}}" class="dropdown-item d-flex align-items-center">
                    <img src="{{asset('assets/images/user.jpg')}}" class="avatar rounded-circle border" width="40">
                    <div class="ml-3 text-truncate">
                        <h6 class="name text-truncate mb-0">lorem</h6>
                        <small class="username">@</small>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{url('account/password')}}">
                    <i class="mdi mdi-18px mdi-lock-outline"></i>
                    <span>Change Password</span>
                </a>
                <a class="dropdown-item" onclick="return logout()" data-toggle="modal" data-target="#modal-logout" role="button">
                    <i class="mdi mdi-18px mdi-login-variant"></i>
                    <span>Log out</span>
                </a>
            </div>
        </div>
    </nav>
    <div class="overlay"></div>
    <div class="main">
    	@yield('content')
    	<!-- <div class="d-block d-md-none fixed-bottom bg-white border-top w-100" style="bottom: 0">
    		<div class="container text-center">
	    		<div class="row">
	    			<a href="{{url('dashboard')}}" class="col px-1 py-2 {{Request::is('dashboard')?'text-dark':'text-black-50'}}">
	    				<i class="mdi mdi-18px mdi-home pr-0"></i>
	    				<small class="d-block">Home</small>
	    			</a>
	    			<a href="{{url('employee')}}" class="col px-1 py-2 {{Request::is('employee')?'text-dark':'text-black-50'}}">
	    				<i class="mdi mdi-18px mdi-account-group pr-0"></i>
	    				<small class="d-block">Employee</small>
	    			</a>
	    			<a href="{{url('task-management/division')}}" class="col px-1 py-2 {{Request::is('task-management/division')?'text-dark':'text-black-50'}}">
	    				<i class="mdi mdi-18px mdi-clipboard-check-outline pr-0"></i>
	    				<small class="d-block">Division</small>
	    			</a>
	    			<a href="{{url('time-management/attendance')}}" class="col px-1 py-2 {{Request::is('time-management')?'text-dark':'text-black-50'}}">
	    				<i class="mdi mdi-18px mdi-timer pr-0"></i>
	    				<small class="d-block">Attendance</small>
	    			</a>
	    			<a href="{{url('finance')}}" class="col px-1 py-2 {{Request::is('finance')?'text-dark':'text-black-50'}}">
	    				<i class="mdi mdi-18px mdi-square-inc-cash pr-0"></i>
	    				<small class="d-block">Finance</small>
	    			</a>
	    			<a href="{{url('payroll')}}" class="col px-1 py-2 {{Request::is('payroll')?'text-dark':'text-black-50'}}">
	    				<i class="mdi mdi-18px mdi-cash-register pr-0"></i>
	    				<small class="d-block">Payroll</small>
	    			</a>
	    			<a href="{{url('company')}}" class="col px-1 py-2 {{Request::is('company')?'text-dark':'text-black-50'}}">
	    				<i class="mdi mdi-18px mdi-office-building pr-0"></i>
	    				<small class="d-block">Company</small>
	    			</a>
	    		</div>
	    	</div>
    	</div> -->
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