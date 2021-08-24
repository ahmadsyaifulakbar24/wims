@extends('layouts/app')

@section('title','Dashboard')

@section('content')
	<div class="container">
		<div class="card mb-3">
			<div class="card-body">
				<h5>Welcome, <span class="name"></span></h5>
				<p class="text-secondary" id="dateNow"></p>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 mb-3">
				<div class="card">
					<div class="card-body">
						<span class="font-weight-bold">Quick Links</span>
						<ul class="nav flex-column">
							<li class="nav-item">
								<a class="nav-link pb-0 pl-0 text-secondary" href="{{url('company/head-office')}}">
									<i class="mdi mdi-account-circle"></i>My Info
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link pb-0 pl-0 text-secondary" href="{{url('employee/add')}}">
									<i class="mdi mdi-account-plus"></i>Add Employee
								</a>
							</li>	
							<li class="nav-item">
								<a class="nav-link pb-0 pl-0 text-secondary" href="{{url('task-management/division')}}">
									<i class="mdi mdi-clipboard-check-outline"></i>Division
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link pb-0 pl-0 text-secondary" href="{{url('time-management/attendance')}}">
									<i class="mdi mdi-timer"></i>Attendance
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link pb-0 pl-0 text-secondary" href="{{url('task-management/report')}}">
									<i class="mdi mdi-pencil-outline"></i>Report
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link pb-0 pl-0 text-secondary" href="{{url('company/head-office')}}">
									<i class="mdi mdi-office-building"></i>Company Settings
								</a>
							</li>
						</ul>
					</div>
					<!-- <div class="card-body border-top">
						<span class="font-weight-bold">Applications</span>
						<ul class="nav flex-column">
							<li class="nav-item">
								<a class="nav-link pb-0 pl-0 text-secondary" href="{{url('')}}">
									<i class="mdi mdi-chart-bar"></i>Performance Review
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link pb-0 pl-0 text-secondary" href="{{url('')}}">
									<i class="mdi mdi-briefcase"></i>Recruitment
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link pb-0 pl-0 text-secondary" href="{{url('')}}">
									<i class="mdi mdi-cart"></i>Commerce
								</a>
							</li>
						</ul>
					</div> -->
				</div>
			</div>
			<div class="col-lg-9">
				<div class="row">
					<!-- <div class="col-lg-4 mb-3">
						<div class="card">
							<div class="card-body">
								<img src="{{asset('assets/images/dynamic-realtime-line-chart.svg')}}" class="img-fluid">
							</div>
						</div>
					</div>
					<div class="col-lg-4 mb-3">
						<div class="card">
							<div class="card-body">
								<img src="{{asset('assets/images/dynamic-realtime-line-chart.svg')}}" class="img-fluid">
							</div>
						</div>
					</div>
					<div class="col-lg-4 mb-3">
						<div class="card">
							<div class="card-body">
								<img src="{{asset('assets/images/dynamic-realtime-line-chart.svg')}}" class="img-fluid">
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script src="{{asset('api/admin/dashboard.js')}}"></script>
@endsection