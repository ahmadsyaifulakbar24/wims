@extends('layouts/app')

@section('title','Job Position')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-header border-bottom-0">
				<div class="d-flex align-items-center justify-content-between">
					<h4 class="mb-0">Job Position</h4>
					<div class="d-flex align-items-center">
						<!-- <i class="mdi mdi-24px mdi-magnify" role="button"></i> -->
						<i class="mdi mdi-24px mdi-sitemap pr-0 mr-2" id="sitemap" data-toggle="tooltip" data-placement="bottom" title="Sitemap Job Position" role="button"></i>
						<i class="mdi mdi-24px mdi-plus-circle-outline pr-0" id="add" data-toggle="tooltip" data-placement="bottom" title="Add Job Position" role="button"></i>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-middle">
					<thead>
						<tr>
							<th class="text-truncate text-center">No.</th>
							<th class="text-truncate">Job Name</th>
							<th class="text-truncate">Parent</th>
							<th class="text-truncate"></th>
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
	<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
	    <div class="modal-sm modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title"></h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
	            <form>
		            <div class="modal-body">
						<div class="form-group">
							<label for="job_position_name">Job Name</label>
							<input class="form-control" id="job_position_name">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="parent_id">Parent</label>
							<select class="custom-select" id="parent_id" role="button"></select>
							<div class="invalid-feedback"></div>
						</div>
		            </div>
		            <div class="modal-footer border-top-0">
		                <button class="btn btn-outline-dark" data-dismiss="modal">Close</button>
		                <button class="btn btn-dark" id="submit">Create</button>
		            </div>
		        </form>
	        </div>
	    </div>
	</div>
	<div class="modal fade" id="modal-delete" tabindex="-1" aria-hidden="true">
	    <div class="modal-sm modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title">Delete Job Position</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
	            <div class="modal-body">
	            	Are you sure want to delete <b></b>?
	            	<span class="text-danger">Job position inside the parent <b></b> will be deleted.</span>
	            </div>
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
	<script src="{{asset('api/company/job-position.js')}}"></script>
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
@endsection