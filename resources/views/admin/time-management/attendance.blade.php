@extends('layouts/app')

@section('title','Attendance')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-header border-bottom-0">
				<div class="d-flex align-items-center justify-content-between">
					<h4 class="mb-0">Attendance</h4>
					<i class="mdi mdi-24px mdi-tune pr-0" data-toggle="modal" data-target="#modal-filter" role="button"></i>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-middle">
					<thead>
						<tr>
							<th class="text-truncate text-center">No.</th>
							<th class="text-truncate">Employee Name</th>
							<th class="text-truncate">Date</th>
							<th class="text-truncate">Clock In</th>
							<th class="text-truncate">Clock In Notes</th>
							<th class="text-truncate">Clock Out</th>
							<th class="text-truncate">Clock Out Notes</th>
						</tr>
					</thead>
					<tbody id="table"></tbody>
				</table>
			</div>
			<!-- <div class="d-flex flex-column justify-content-center align-items-center py-5">
				<div class="loader loader-sm">
					<svg class="circular" viewBox="25 25 50 50">
						<circle class="path-dark" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
					</svg>
				</div>
			</div> -->
		</div>
	</div>
	<div class="modal fade" id="modal-delete" tabindex="-1" aria-hidden="true">
	    <div class="modal-sm modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title">Delete Branch</h5>
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
	<div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title">Filter</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
				<div class="modal-body">
					<div class="form-group">
						<label for="date">Date</label>
						<input type="date" class="form-control" id="date" role="button">
					</div>
				</div>
	            <div class="modal-footer border-top-0">
	                <button class="btn btn-outline-dark" data-dismiss="modal" onclick="return get_attendance()">Reset</button>
	                <button class="btn btn-dark" id="filter">Apply</button>
	            </div>
            </div>
        </div>
    </div>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
@endsection

@section('script')
	<script src="{{asset('api/admin/time-management/attendance.js')}}"></script>
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
@endsection