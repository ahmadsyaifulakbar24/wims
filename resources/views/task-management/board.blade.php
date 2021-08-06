@extends('layouts/app')

@section('content')
	<div class="container">
		<h2 class="d-none d-md-block mb-3" id="division"></h2>
		<div class="none" id="card">
			<div class="row" id="data">
				<div class="col-xl-3 col-lg-4 col-md-6 mb-3" id="modal">
					<div class="card card-height" data-toggle="modal" data-target="#modal-create" role="button">
						<div class="card-body text-center">
							<i class="mdi mdi-48px mdi-plus"></i>
							<h6>Create Board</h6>
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
	                <h5 class="modal-title" id="exampleModalLabel">Create Board</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
	            <form id="form-create">
		            <div class="modal-body">
						<div class="form-group">
							<label for="title">Title</label>
							<input class="form-control" id="title">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="description">Description</label>
							<textarea class="form-control form-control-sm" id="description" rows="3"></textarea>
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
	                <h5 class="modal-title" id="exampleModalLabel">Edit Board</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
	            <form id="form-edit">
		            <div class="modal-body">
						<div class="form-group">
							<label for="edit_title">Title</label>
							<input class="form-control" id="edit_title">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="edit_description">Description</label>
							<textarea class="form-control form-control-sm" id="edit_description" rows="3"></textarea>
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label class="mb-0">Members</label>
							<div class="d-flex align-items-center flex-wrap">
								<div class="d-flex flex-wrap" id="members"></div>
								<div id="loading-member">
									<div class="d-flex flex-wrap">
										<div class="loader loader-sm mr-2">
											<svg class="circular" viewBox="25 25 50 50">
												<circle class="path-dark" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
											</svg>
										</div>
									</div>
								</div>
								<div class="dropdown" id="dropdown-member">
									<i class="mdi mdi-24px mdi-plus-circle-outline pr-0" id="add-member" data-toggle="dropdown" role="button"></i>
									<div class="dropdown-menu py-0" aria-labelledby="dropdown-member">
										<h6 class="dropdown-header text-center">Add members</h6>
										<hr class="mt-0">
										<div class="container">
											<div class="form-group">
												<!-- <input class="form-control" id="search_user_id" placeholder="Search member" autocomplete="off"> -->
												<!-- <select class="custom-select" id="user_id" role="button">
													<option value="" disabled selected>Select</option>
												</select> -->
											</div>
										</div>
										<div id="list-members" class="mb-2"></div>
									</div>
								</div>
							</div>
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
	            <div class="modal-body">Are you sure want to delete <b></b> division?</div>
	            <div class="modal-footer border-top-0">
	                <button class="btn btn-outline-dark" data-dismiss="modal">Close</button>
	                <button class="btn btn-dark" id="delete">Delete</button>
	            </div>
	        </div>
	    </div>
	</div>
@endsection

@section('script')
	<script>const division_id = {{$id}}</script>
	<script src="{{asset('api/task-management/board.js')}}"></script>
@endsection