@extends('layouts/app')

@section('title','Leave')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-header border-bottom-0">
				<div class="d-flex align-items-center justify-content-between">
					<h4 class="mb-0">Leave</h4>
					<!-- <i class="mdi mdi-24px mdi-tune pr-0" data-toggle="modal" data-target="#modal-filter" role="button"></i> -->
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-middle">
					<thead>
						<tr>
							<th class="text-truncate text-center">No.</th>
							<th class="text-truncate">Employee Name</th>
							<th class="text-truncate">Leave</th>
							<th class="text-truncate">From</th>
							<th class="text-truncate">Description</th>
							<th class="text-truncate">Status</th>
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

	<div class="modal fade" id="modal-detail" tabindex="-1" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title">Detail Leave</h5>
	                <div class="close" data-dismiss="modal" aria-label="Close" role="button">
	                    <i class="mdi mdi-close pr-0"></i>
	                </div>
	            </div>
	            <div class="modal-body">
					<div class="form-row">
						<div class="form-group col">
							<div class="font-weight-bold mb-2">Total</div>
							<div id="total-detail"></div>
						</div>
						<div class="form-group col-9">
							<div class="font-weight-bold mb-2">Date</div>
							<div id="date-detail"></div>
						</div>
					</div>
					<div class="form-group">
						<div class="font-weight-bold mb-2">Description</div>
						<div id="description-detail"></div>
					</div>
					<div class="form-group">
						<div class="font-weight-bold mb-2">Status</div>
						<div class="text-capitalize" id="status-detail"></div>
					</div>
					<div class="form-group">
						<div class="font-weight-bold mb-2">Comment</div>
						<form id="form-comment">
							<div class="d-flex align-items-start mb-3">
								<img class="avatar rounded-circle mt-1" width="30" alt="">
								<div class="input-group ml-3">
									<input class="form-control" id="comment" placeholder="Write a comment...">
									<div class="input-group-append" id="submit-comment">
										<button class="btn btn-sm btn-dark rounded-right">Reply</button>
									</div>
									<div class="invalid-feedback"></div>
								</div>
							</div>
						</form>
						<div id="comment-detail"></div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
	<div class="modal fade" id="modal-approval" tabindex="-1" aria-hidden="true">
	    <div class="modal-sm modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title"></h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
	            <div class="modal-body"></div>
	            <div class="modal-footer border-top-0">
	                <button class="btn btn-outline-dark" data-dismiss="modal">Close</button>
	                <button class="btn btn-dark" id="approve"></button>
	            </div>
	        </div>
	    </div>
	</div>
@endsection

@section('script')
	<script src="{{asset('api/admin/time-management/leave.js')}}"></script>
@endsection