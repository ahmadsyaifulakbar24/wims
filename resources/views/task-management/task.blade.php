@extends('layouts/app')

@section('content')
	<div class="container">
		<h4 class="d-none d-md-block mb-3" id="board"></h4>
		<div class="row">
			<div class="col-lg-4">
				<div class="mb-4" id="card">
					<div class="card card-height create-task" data-toggle="modal" data-target="#modal-task" role="button">
						<div class="card-body text-center">
							<i class="mdi mdi-48px mdi-plus"></i>
							<h6>Create Task</h6>
						</div>
					</div>
				</div>
				<div id="list-task"></div>
			</div>
			<div class="col-lg-8">
				<div class="card none mb-5" id="detail-task">
					<div class="card-header">
						<div class="d-flex justify-content-between align-items-center flex-wrap">
							<div class="text-truncate">
								<h5 class="mb-0 text-truncate" id="task-title"></h5>
							</div>
							<div class="dropdown">
								<i class="mdi mdi-24px mdi-dots-horizontal pr-0" id="dropdown-setting" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button"></i>
								<div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="dropdown-setting">
									<div class="dropdown-item edit edit-task" role="button">Edit</div>
									<div class="dropdown-item delete delete-task" role="button">Delete</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6 mb-4">
								<h6>Members</h6>
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
									<div class="dropdown">
										<i class="mdi mdi-24px mdi-plus-circle-outline pr-0" id="dropdown-member" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button"></i>
										<div class="dropdown-menu py-0" aria-labelledby="dropdown-member">
											<h6 class="dropdown-header text-center">Add members</h6>
											<hr class="mt-0 mb-2">
											<div id="list-members" class="mb-2"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 mb-4">
								<h6>Due Date</h6>
								<div id="duedate-task"></div>
							</div>
						</div>
						<div class="mb-4" id="description-task"></div>
						<div class="mb-4">
							<h6>Attachment</h6>
							<div id="attachment-task"></div>
							<div class="card p-1" role="button">
								<input type="file" class="none" id="file">
								<div class="d-flex align-items-center justify-content-center" id="attachment">
									<i class="mdi mdi-18px mdi-plus"></i>
									<span>Add attachment</span>
								</div>
							</div>
						</div>
						<div class="mb-4">
							<h6>Checklist</h6>
							<div id="checklist-task"></div>
							<!-- <div class="mb-1">
								<div class="form-check pt-0">
									<input class="form-check-input" type="checkbox" value="" id="defaultCheck">
									<label class="form-check-label" for="defaultCheck">Default checkbox</label>
								</div>
								<div class="d-flex">
									<i class="mdi mdi-subdirectory-arrow-right px-1"></i>
									<div class="form-check pt-0">
										<input class="form-check-input" type="checkbox" value="" id="defaultCheck">
										<label class="form-check-label" for="defaultCheck">Default checkbox</label>
									</div>
								</div>
							</div> -->
							<div class="card p-1 mt-2 modal-checklist create-checklist" role="button">
								<div class="d-flex align-items-center justify-content-center">
									<i class="mdi mdi-18px mdi-plus"></i>
									<span>Add checklist</span>
								</div>
							</div>
						</div>
						<h6>Comments</h6>
						<form id="form-comment">
							<div class="d-flex align-items-start mb-3">
								<img class="avatar rounded-circle mt-1" width="30" alt="">
								<div class="input-group ml-3">
									<input class="form-control" id="comment" placeholder="Write a comment...">
									<div class="input-group-append rounded-right" id="submit-comment">
										<button class="btn btn-sm btn-dark">Reply</button>
									</div>
									<div class="invalid-feedback"></div>
								</div>
							</div>
						</form>
						<div id="comment-task"></div>
						<!-- <div class="d-flex align-items-start mb-3">
							<img class="avatar rounded-circle mb-1" width="30" alt="">
							<div class="ml-3">
								<div><b>Nur Hilmi</b> <small class="text-secondary">11:55 am</small></div>
								<div>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</div>
							</div>
						</div> -->
					</div>
				</div>
				<div class="nonee" id="empty-task">
					<div class="d-flex flex-column justify-content-center align-items-center state">
						<h4 class="text-secondary">No task selected</h4>
					</div>
				</div>
				<div class="none" id="loading-task">
					<div class="d-flex flex-column justify-content-center align-items-center state">
						<div class="loader">
							<svg class="circular" viewBox="25 25 50 50">
								<circle class="path-dark" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
							</svg>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <div id="loading">
			<div class="d-flex flex-column justify-content-center align-items-center state">
				<div class="loader">
					<svg class="circular" viewBox="25 25 50 50">
						<circle class="path-dark" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
					</svg>
				</div>
			</div>
		</div> -->
	</div>
    <div class="modal fade" id="modal-task" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title" id="title-task">Create Task</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
	            <form id="form-task">
		            <div class="modal-body">
	        			<div class="form-group">
							<label for="title">Title</label>
							<input class="form-control" id="title">
							<div class="invalid-feedback"></div>
						</div>
	        			<div class="form-row">
	        				<div class="col form-group">
								<label for="start_due_date">Start Date</label>
								<input type="date" class="form-control" id="start_due_date">
								<div class="invalid-feedback"></div>
							</div>
	        				<div class="col form-group">
								<label for="finish_due_date">Due Date</label>
								<input type="date" class="form-control" id="finish_due_date">
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="form-group">
							<label for="description">Description</label>
							<textarea class="form-control form-control-sm" id="description" rows="3"></textarea>
							<div class="invalid-feedback"></div>
						</div>
					</div>
		            <div class="modal-footer border-top-0">
		                <button class="btn btn-outline-dark" data-dismiss="modal">Close</button>
		                <button class="btn btn-dark" id="task-submit">Create</button>
		            </div>
		        </form>
	        </div>
	    </div>
	</div>
	<div class="modal fade" id="modal-delete" tabindex="-1" aria-hidden="true">
	    <div class="modal-sm modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title" id="delete-title"></h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
	            <div class="modal-body">
	            	Are you sure want to delete <b id="delete-body"></b>?
	            </div>
	            <div class="modal-footer border-top-0">
	                <button class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
	                <button class="btn btn-dark" id="delete">Delete</button>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="modal fade" id="modal-member" tabindex="-1" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title">Add Member</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
	            <div class="modal-body" id="member-body"></div>
	            <!-- <div class="modal-footer border-top-0">
	                <button class="btn btn-outline-dark" data-dismiss="modal">Close</button>
	                <button class="btn btn-dark">Delete</button>
	            </div> -->
	        </div>
	    </div>
	</div>
	<div class="modal fade" id="modal-checklist" tabindex="-1" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title" id="modal-checklist-title"></h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
	            <form id="checklist-form">
		            <div class="modal-body">
	        			<div class="form-group">
							<label for="title">Title</label>
							<input class="form-control" id="checklist-title">
							<div class="invalid-feedback"></div>
						</div>
					</div>
		            <div class="modal-footer border-top-0">
		                <button class="btn btn-outline-dark" data-dismiss="modal">Close</button>
		                <button class="btn btn-dark" id="checklist-submit">Create</button>
		            </div>
		        </form>
	        </div>
	    </div>
	</div>
	<div class="modal fade" id="modal-checklist-item" tabindex="-1" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title" id="modal-checklist-item-title"></h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
	            <form id="checklist-item-form">
		            <div class="modal-body">
	        			<div class="form-group">
							<label for="title">Title</label>
							<input class="form-control" id="checklist-item-title">
							<div class="invalid-feedback"></div>
						</div>
					</div>
		            <div class="modal-footer border-top-0">
		                <button class="btn btn-outline-dark" data-dismiss="modal">Close</button>
		                <button class="btn btn-dark" id="checklist-item-submit">Create</button>
		            </div>
		        </form>
	        </div>
	    </div>
	</div>
	<div class="modal fade" id="modal-comment" tabindex="-1" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title" id="modal-comment-title"></h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
	            <form id="comment-form">
		            <div class="modal-body">
	        			<div class="form-group">
							<label for="title">Title</label>
							<input class="form-control" id="comment-title">
							<div class="invalid-feedback"></div>
						</div>
					</div>
		            <div class="modal-footer border-top-0">
		                <button class="btn btn-outline-dark" data-dismiss="modal">Close</button>
		                <button class="btn btn-dark" id="comment-submit">Save Changes</button>
		            </div>
		        </form>
	        </div>
	    </div>
	</div>
@endsection

@section('script')
	<script>const board_id = {{$id}}</script>
	<script src="{{asset('assets/js/file.js')}}"></script>
	<script src="{{asset('api/task-management/task.js')}}"></script>
@endsection