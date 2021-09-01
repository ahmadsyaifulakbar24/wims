@extends('layouts/app')

@section('title', 'Leave')

@section('style')
	<style>
		th:first-child, td:first-child {
			padding-left: 0 !important;
		}
		th:last-child, td:last-child {
			padding-right: 0 !important;
		}
		.main {
			padding-top: 55px;
		}
	</style>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-8 offset-lg-3 offset-md-2">
				<div class="none mb-5" id="data">
					<table class="table table-middle border-bottom">
						<thead>
							<th>Leave</th>
							<th>Date</th>
							<th>Status</th>
							<th></th>
						</thead>
						<tbody id="table"></tbody>
					</table>
				</div>
				<div class="text-center none" id="empty">
					<div class="state d-flex flex-column justify-content-center align-items-center py-5">
						<i class="mdi mdi-48px mdi-close-circle-outline pr-0"></i>
						<h5>No result found</h5>
						<div class="text-secondary">Your leave will show here</div>
					</div>
				</div>
				<div id="loading">
					<div class="state d-flex flex-column justify-content-center align-items-center py-5">
						<div class="loader" id="loading">
							<svg class="circular" viewBox="25 25 50 50">
								<circle class="path-dark" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
							</svg>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title"></h5>
	                <div class="close" data-dismiss="modal" aria-label="Close" role="button">
	                    <i class="mdi mdi-close pr-0"></i>
	                </div>
	            </div>
	            <form id="form">
		            <div class="modal-body">
		            	<div class="form-row">
						<div class="form-group col">
							<label for="from_date">From</label>
							<input type="date" class="form-control" id="from_date" min="{{date('Y-m-d')}}">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group col">
							<label for="till_date">Till</label>
							<input type="date" class="form-control" id="till_date">
							<div class="invalid-feedback"></div>
						</div>
						</div>
						<div class="form-group">
							<label for="description">Description</label>
							<textarea class="form-control form-control-sm" rows="3" id="description"></textarea>
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
	                <h5 class="modal-title">Delete Leave</h5>
	                <div class="close" data-dismiss="modal" aria-label="Close" role="button">
	                    <i class="mdi mdi-close pr-0"></i>
	                </div>
	            </div>
	            <div class="modal-body">Are you sure want to delete leave?</div>
	            <div class="modal-footer border-top-0">
	                <button class="btn btn-outline-dark" data-dismiss="modal">Close</button>
	                <button class="btn btn-dark" id="delete">Delete</button>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="modal fade" id="modal-detail" tabindex="-1" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title">Detail Leave</h5>
	                <div>
		                <div class="btn-group" id="option">
			                <div class="close" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
			                    <i class="mdi mdi-dots-horizontal pr-0"></i>
							</div>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="dropdown-item edit" role="button">Edit</div>
								<div class="dropdown-item delete" role="button">Delete</div>
							</div>
						</div>
		                <div class="close" data-dismiss="modal" aria-label="Close" role="button">
		                    <i class="mdi mdi-close pr-0"></i>
		                </div>
		            </div>
	            </div>
	            <div class="modal-body">
					<div class="form-row">
						<div class="form-group col">
							<label class="font-weight-bold">Total</label>
							<div id="total-detail"></div>
						</div>
						<div class="form-group col-9">
							<label class="font-weight-bold">Date</label>
							<div id="date-detail"></div>
						</div>
					</div>
					<div class="form-group">
						<label class="font-weight-bold">Description</label>
						<div id="description-detail"></div>
					</div>
					<div class="form-group">
						<label class="font-weight-bold">Status</label>
						<div class="text-capitalize" id="status-detail"></div>
					</div>
					<div class="form-group">
						<label class="font-weight-bold">Comment</label>
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
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<div class="btn btn-dark position-fixed rounded-circle" id="add" style="bottom: 70px;right: 15px;">
		<i class="mdi mdi-24px mdi-plus pr-0"></i>
	</div>
@endsection

@section('script')
	<script src="{{asset('api/leave.js')}}"></script>
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
@endsection