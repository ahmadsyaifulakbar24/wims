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
				<!-- <div class="d-flex flex-column py-3">
					<h5>Nur Hilmi</h5>
					<div class="text-secondary">Staff IT</div>
				</div> -->
				<div class="row">
					<div class="col-3 pr-0">
						<a href="{{url('attendance')}}">
							<div class="d-flex flex-column text-center pt-2 pb-3">
								<i class="mdi mdi-24px mdi-clock-outline text-success pr-0"></i>
								<small class="text-dark">Attendance</small>
							</div>
						</a>
					</div>
					<div class="col-3 pr-0">
						<a href="{{url('task')}}">
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
						<a href="{{url('leave')}}">
							<div class="d-flex flex-column text-center pt-2 pb-3">
								<i class="mdi mdi-24px mdi-calendar-multiselect text-danger pr-0"></i>
								<small class="text-dark">Leave</small>
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
				<h6>Attendance Log</h6>
				<a href="javascript:void(0)">View All</a>
			</div>
			<table class="table table-sm">
			    <tr class="font-weight-bold">
		            <td>WFH</td>
		            <td class="text-right">
		            	<small class="text-secondary">09 Aug 2021</small>
	            	</td>
		        </tr>
		        <tr>
		            <td>New employee</td>
		            <td class="text-right">
		            	<small class="text-secondary">07 Aug 2021</small>
	            	</td>
		        </tr>
		        <tr>
		            <td>Office rules update</td>
		            <td class="text-right">
		            	<small class="text-secondary">02 Aug 2021</small>
	            	</td>
		        </tr>
			</table>
		</div>
	</div>
@endsection

@section('script')
	<!-- <script src="{{asset('api/home.js')}}"></script> -->
@endsection