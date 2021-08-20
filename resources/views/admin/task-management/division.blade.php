@extends('layouts/app')

@section('title','Division')

@section('content')
	<div class="container">
		<h4 class="mb-3">Division</h4>
		<div class="none" id="card">
			<div class="row" id="data">
				<div class="col-xl-3 col-lg-4 col-md-6 mb-3 none" id="modal">
					<div class="card card-height" data-toggle="modal" data-target="#modal-create" role="button">
						<div class="card-body text-center">
							<i class="mdi mdi-48px mdi-plus"></i>
							<h6>Create Division</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="loading">
			<div class="d-flex flex-column justify-content-center align-items-center state">
				<div class="loader">
					<svg class="circular" viewBox="25 25 50 50">
						<circle class="path-dark" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
					</svg>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title" id="exampleModalLabel">Create Division</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
            	<form id="form-create">
		            <div class="modal-body">
						<div class="form-group">
							<label for="name">Division Name</label>
							<input class="form-control" id="name">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="pic_id">PIC</label>
							<select id="pic_id" class="pic_id custom-select" role="button">
								<option value="" disabled selected>Select</option>
							</select>
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
	<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title" id="exampleModalLabel">Edit Division</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
            	<form id="form-edit">
		            <div class="modal-body">
						<div class="form-group">
							<label for="edit_name">Division Name</label>
							<input class="form-control" id="edit_name">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="edit_pic_id">PIC</label>
							<select id="edit_pic_id" class="pic_id custom-select" role="button">
								<option value="" disabled selected>Select</option>
							</select>
							<div class="invalid-feedback"></div>
						</div>
		            </div>
		            <div class="modal-footer border-top-0">
		                <button class="btn btn-outline-dark" data-dismiss="modal">Close</button>
		                <button class="btn btn-dark" id="edit" disabled="true">Save Changes</button>
		            </div>
				</form>
	        </div>
	    </div>
	</div>
	<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-sm modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title" id="exampleModalLabel">Delete Division</h5>
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
@endsection

@section('script')
	<script src="{{asset('api/admin/task-management/division.js')}}"></script>
@endsection