@extends('layouts/app')

@section('content')
	<div class="container">
		<h2 class="d-none d-md-block mb-3" id="board"></h2>
		<div class="none" id="card">
			<div class="row" id="data">
				<div class="col-xl-3 col-lg-4 col-md-6 mb-3" id="modal">
					<div class="card card-height" data-toggle="modal" data-target="#modal-create" role="button">
						<div class="card-body text-center">
							<i class="mdi mdi-48px mdi-plus"></i>
							<h6>Create Task</h6>
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
	                <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
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
		                <button class="btn btn-dark">Create</button>
		            </div>
		        </form>
	        </div>
	    </div>
	</div>
	<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
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
						<div class="form-row">
	        				<div class="col form-group">
								<label for="edit_start_due_date">Start Date</label>
								<input type="date" class="form-control" id="edit_start_due_date">
								<div class="invalid-feedback"></div>
							</div>
	        				<div class="col form-group">
								<label for="edit_finish_due_date">Due Date</label>
								<input type="date" class="form-control" id="edit_finish_due_date">
								<div class="invalid-feedback"></div>
							</div>
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
										<div id="user_id" class="mb-2"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="checklist">Checklist</label>
							<!-- <input class="form-control mb-2" id="checklist"> -->
							<div class="btn btn-sms btn-block btn-outline-dark" role="button">
								<i class="mdi mdi-plus"></i>Add Checklist
							</div>
						</div>
	        			<div class="form-group">
							<label for="attachment">Attachment</label>
							<!-- <div class="custom-file mb-2">
								<input type="file" class="custom-file-input" id="customFile">
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div> -->
							<div class="btn btn-sms btn-block btn-outline-dark" role="button">
								<i class="mdi mdi-plus"></i>Add Attachment
							</div>
						</div>
					</div>
		            <div class="modal-footer border-top-0">
		                <button class="btn btn-outline-dark" data-dismiss="modal" data-toggle="modal" data-target="#modal-view">Close</button>
		                <button class="btn btn-dark">Save Changes</button>
		            </div>
		        </form>
				    <!-- <div class="col-lg-4 pl-0">
				    	<div class="modal-body">
		        			<div class="form-group">
								<label for="add">Add</label>
						    	<button class="btn btn-sm btn-block btn-outline-dark">Members</button>
						    	<button class="btn btn-sm btn-block btn-outline-dark">Labels</button>
						    	<button class="btn btn-sm btn-block btn-outline-dark">Checklist</button>
						    	<button class="btn btn-sm btn-block btn-outline-dark">Attachment</button>
						    </div>
					    </div>
				    </div> -->
				<!-- </div> -->
	        </div>
	    </div>
	</div>
	<div class="modal fade" id="modal-task" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title" id="exampleModalLabel">Revisi</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
	            <div class="modal-body pt-0">
					<div class="form-group">
						<label class="text-secondary">Description</label>
						<p>Perubahan form profil usaha</p>
					</div>
					<div class="form-group">
						<label class="text-secondary">Due Date</label>
						<p>3 Jun, 23:59 PM</p>
					</div>
					<div class="form-group">
						<label class="text-secondary" for="checklist">Checklist</label>
						<div class="progress">
							<div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked>
							<label class="form-check-label" for="defaultCheck1">
								<s>Nomor IUMKM diganti menjadi Nomor IUMK</s>
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
							<label class="form-check-label" for="defaultCheck2">
								Tambah nomor telepon
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="text-secondary">Attachment</label>
						<div class="card mb-3" style="max-width: 540px;">
							<div class="row no-gutters">
								<div class="col-md-4">
									<img src="{{asset('assets/images/dynamic-realtime-line-chart.svg')}}" class="card-img" alt="...">
								</div>
								<div class="col-md-8">
									<div class="card-body">
										<b class="card-title">dynamic-realtime-line-chart.svg</b>
										<p class="card-text text-muted mb-0">
											<a href="" class="small text-muted">View</a> - 
											<a href="" class="small text-muted">Edit</a> - 
											<a href="" class="small text-muted">Delete</a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="text-secondary" for="activity">Labels</label>
						<div class="d-flex">
							<div class="btn btn-sm btn-primary mr-1">Normal</div>
							<div class="btn btn-sm btn-success mr-1">Frontend</div>
							<div class="btn btn-sm btn-warning">Backend</div>
						</div>
					</div>
					<!-- <div class="form-group">
						<label class="text-secondary" for="activity">Activity</label>
					</div> -->
	            </div>
	            <!-- <div class="modal-footer border-top-0">
	                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                <button type="button" class="btn btn-primary">Create</button>
	            </div> -->
	        </div>
	    </div>
	</div>
	<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-sm modal-dialog modal-dialog-centered">
	        <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title" id="exampleModalLabel">Delete Task</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <i class="mdi mdi-close pr-0"></i>
	                </button>
	            </div>
	            <div class="modal-body">Are you sure want to delete task <b></b>?</div>
	            <div class="modal-footer border-top-0">
	                <button class="btn btn-outline-dark" data-dismiss="modal">Close</button>
	                <button class="btn btn-dark" id="delete">Delete</button>
	            </div>
	        </div>
	    </div>
	</div>
@endsection

@section('script')
	<script>const board_id = {{$id}}</script>
	<script src="{{asset('api/view-board.js')}}"></script>
@endsection