@extends('layouts/app')

@section('title', 'Attendance')

@section('style')
	<link rel="stylesheet" href="{{asset('assets/vendors/croppie/croppie.css')}}">
	<style>
		th:first-child, td:first-child {
			padding-left: 0 !important;
		}
		th:last-child, td:last-child {
			padding-right: 0 !important;
		}
	</style>
@endsection

@section('style')
	<link rel="stylesheet" href="{{asset('assets/vendors/croppie/croppie.css')}}">
@endsection

@section('content')
	<div class="container none" id="card">
		<div class="row">
			<div class="col-lg-6 col-md-8 offset-lg-3 offset-md-2">
				<div class="card text-center">
					<div class="py-3">
						<h1 id="time-part"></h1>
						<div class="text-secondary" id="date-part"></div>
					</div>
					<div class="card-body border-top">
						<div class="form-group">
							<div class="none">
								<img class="img-fluid border" id="image">
								<label class="d-block" for="photo">Change photo</label>
							</div>
							<div class="custom-file">
								<label class="custom-file-label text-left" for="photo">Take a photo</label>
								<input type="file" class="custom-file-input" id="photo" accept="image/*" role="button">
								<div class="invalid-feedback text-left"></div>
							</div>
						</div>
						<div class="form-group">
							<textarea class="form-control form-control-sm" rows="3" id="description" placeholder="Notes"></textarea>
						</div>
						<div class="form-row">
							<div class="col-6">
								<button class="btn btn-block btn-dark" id="in" onclick="return form_attendance('in')">Clock In</button>
							</div>
							<div class="col-6">
								<button class="btn btn-block btn-dark" id="out" onclick="return form_attendance('out')" disabled>Clock Out</button>
							</div>
						</div>
					</div>
				</div>
				<div class="mt-3">
					<div class="d-flex justify-content-between align-items-center">
						<h6 class="mb-0">Attendance log</h6>
						<i class="mdi mdi-24px mdi-tune pr-0" role="button" data-toggle="modal" data-target="#modal-filter"></i>
					</div>
					<table class="table" id="table"></table>
				</div>
			</div>
		</div>
	</div>
		<div class="state d-flex flex-column justify-content-center align-items-center py-5" id="loading">
			<div class="loader">
				<svg class="circular" viewBox="25 25 50 50">
					<circle class="path-dark" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
				</svg>
			</div>
		</div>
	</div>
	<div class="modal" id="modal-photo" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="photo-body" class="none">
                    	<div id="photo-preview"></div>
                    	<div class="text-center">
	                        <i class="mdi mdi-24px mdi-refresh mdi-flip-h" id="RotateClockwise" role="button"></i>
	                        <i class="mdi mdi-24px mdi-refresh" id="RotateAntiClockwise" role="button"></i>
                    	</div>
                    </div>
                </div>
	            <div class="modal-footer border-top-0">
	                <button class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
	                <button class="btn btn-dark" id="apply">Apply</button>
	            </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
	            <div class="modal-header border-bottom-0">
	                <h5 class="modal-title">Filter Attendance</h5>
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
@endsection

@section('script')
	<script src="{{asset('assets/js/photo.js')}}"></script>
	<script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/vendors/croppie/croppie.min.js')}}"></script>
	<script src="{{asset('api/attendance.js')}}"></script>
@endsection