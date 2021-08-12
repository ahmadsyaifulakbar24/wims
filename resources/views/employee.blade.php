@extends('layouts/app')

@section('title','Employee')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-header border-bottom-0">
				<div class="d-flex align-items-center justify-content-between">
					<h4 class="mb-0">Employee</h4>
					<div>
						<!-- <i class="mdi mdi-24px mdi-magnify" role="button"></i>
						<i class="mdi mdi-24px mdi-tune" data-toggle="modal" data-target="#modal-filter" role="button"></i> -->
						<a href="{{url('employee/add')}}" class="text-dark" data-toggle="tooltip" data-placement="bottom" title="Add Employee">
							<i class="mdi mdi-24px mdi-plus-circle-outline pr-0"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-middle">
					<thead>
						<tr>
							<th class="text-truncate text-center">No.</th>
							<th class="text-truncate">Employee Name</th>
							<th class="text-truncate">Branch</th>
							<th class="text-truncate">Organization</th>
							<th class="text-truncate">Job Position</th>
							<th class="text-truncate">Job Level</th>
							<th class="text-truncate">Employee Status</th>
							<th class="text-truncate">Join Date</th>
							<th class="text-truncate">End Date</th>
							<th class="text-truncate"></th>
						</tr>
					</thead>
					<tbody id="table"></tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-delete" tabindex="-1" aria-hidden="true">
	    <div class="modal-sm modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title">Delete Employee</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
	            <div class="modal-body">Are you sure want to delete <b></b>?</div>
	            <div class="modal-footer border-top-0">
	                <button class="btn btn-outline-dark" data-dismiss="modal">Close</button>
	                <button class="btn btn-dark" id="delete">Delete</button>
	            </div>
	        </div>
	    </div>
	</div>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
@endsection

@section('script')
	<script src="{{asset('api/employee.js')}}"></script>
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
@endsection