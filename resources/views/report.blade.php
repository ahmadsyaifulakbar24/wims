@extends('layouts/app')

@section('title', 'Report')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-8 offset-lg-3 offset-md-2">
				<div class="card">
					<!-- <div class="card-header border-bottom-0">
						<div class="d-flex align-items-center justify-content-between">
							<h4 class="mb-0">Report</h4>
							<div class="d-flex align-items-center">
								<i class="mdi mdi-24px mdi-plus-circle-outline pr-0" id="add" data-toggle="tooltip" data-placement="bottom" title="Add Report" role="button"></i>
							</div>
						</div>
					</div> -->
					<div class="table-responsive">
						<table class="table table-middle">
							<thead>
								<tr>
									<th class="text-truncate text-center">No.</th>
									<th class="text-truncate">Title</th>
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
		</div>
	</div>
	<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title"></h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
	            <form id="form">
		            <div class="modal-body">
						<div class="form-group">
							<label for="title">Title</label>
							<input class="form-control" id="title">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="title">Attachment</label>
							<div id="attachments"></div>
							<label class="card p-1" for="attachment" role="button">
								<div class="d-flex align-items-center justify-content-center mb-0" role="button">
									<i class="mdi mdi-18px mdi-plus"></i>
									<span>Add attachment</span>
								</div>
							</label>
							<input type="file" class="none" id="attachment" accept="image/*, application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, .pptx, application/pdf" role="button">
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
	                <h5 class="modal-title">Delete Report</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
	            <div class="modal-body">
	            	Are you sure want to delete <b></b>?
	            </div>
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
	                <h5 class="modal-title">Detail Report</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
	            <div class="modal-body">
					<div class="form-group">
						<label>Title</label>
						<div class="font-weight-bold" id="title-detail"></div>
					</div>
					<div class="form-group">
						<label>Attachment</label>
						<div id="attachments-detail"></div>
					</div>
					<div class="form-group">
						<label for="comment">Comment</label>
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
@endsection

@section('script')
	<script src="{{asset('api/report.js')}}"></script>
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
@endsection