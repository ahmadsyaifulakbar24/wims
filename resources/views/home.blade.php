@extends('layouts/app')

@section('title','Home')

@section('style')
	<style>
		th:first-child, td:first-child {
			padding-left: 0 !important;
		}
		th:last-child, td:last-child {
			padding-right: 0 !important;
		}
	</style>
@endsection

@section('content')
	<div class="container">
		<div class="card rounded">
			<div class="container">
				<div class="d-flex flex-column py-3">
					<h5 class="name"></h5>
					<div class="username text-secondary">@</div>
				</div>
				<div class="row border-top">
					<div class="col-3 pr-0">
						<a href="{{url('attendance')}}">
							<div class="d-flex flex-column text-center pt-2 pb-3">
								<i class="mdi mdi-24px mdi-clock-outline text-success pr-0"></i>
								<small class="text-dark">Attendance</small>
							</div>
						</a>
					</div>
					<div class="col-3 pr-0">
						<a href="{{url('task-management/division')}}">
							<div class="d-flex flex-column text-center pt-2 pb-3">
								<i class="mdi mdi-24px mdi-file-document-box-check-outline pr-0"></i>
								<small class="text-dark">Task</small>
							</div>
						</a>
					</div>
					<div class="col-3">
						<a href="{{url('report')}}">
							<div class="d-flex flex-column text-center pt-2 pb-3">
								<i class="mdi mdi-24px mdi-pencil-outline text-warning pr-0"></i>
								<small class="text-dark">Report</small>
							</div>
						</a>
					</div>
					<div class="col-3">
						<!-- <a href="{{url('leave')}}"> -->
						<a href="javascript:void(0)" onclick="return customAlert('warning', 'Menu is under construction')">
							<div class="d-flex flex-column text-center pt-2 pb-3">
								<i class="mdi mdi-24px mdi-calendar-multiselect text-secondary pr-0"></i>
								<small class="text-secondary">Leave</small>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="mt-3">
			<div class="d-flex justify-content-between">
				<h6>Attendance</h6>
				<a href="{{url('attendance')}}">View all</a>
			</div>
			<table class="table table-sm table-middle" id="attendance"></table>
		</div>
		<div class="mt-3">
			<div class="d-flex justify-content-between">
				<h6>Report</h6>
				<a href="{{url('report')}}">View all</a>
			</div>
			<table class="table table-sm table-middle" id="report"></table>
		</div>
	</div>
@endsection

@section('script')
	<script src="{{asset('api/home.js')}}"></script>
@endsection