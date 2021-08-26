@extends('layouts/app')

@section('title','Change Password')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-8 offset-lg-3 offset-md-2">
				<div class="card">
					@if(session("role") != 101)
					<div class="card-header border-bottom-0">
						<div class="d-flex align-items-center justify-content-between">
							<h4 class="d-nonee d-md-block mb-4 mt-1">Change Password</h4>
						</div>
					</div>
					@endif
					<div class="card-body">
						<form id="form">
							<div class="form-group position-relative">
								<label for="password">Current Password*</label>
								<input type="password" class="form-control" id="password">
								<i class="password mdi mdi-eye-off mdi-18px" data-id="password" minlength="8" maxlength="32"></i>
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group position-relative">
								<label for="npassword">New Password*</label>
								<input type="password" class="form-control" id="npassword">
								<i class="password mdi mdi-eye-off mdi-18px" data-id="npassword" minlength="8" maxlength="32"></i>
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group position-relative">
								<label for="cpassword">Password Confirmation*</label>
								<input type="password" class="form-control" id="cpassword">
								<i class="password mdi mdi-eye-off mdi-18px" data-id="cpassword" minlength="8" maxlength="32"></i>
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group">
								<div class="text-right mt-4">
									<button class="btn btn-dark" id="submit">Submit</button>
								</div>
							</div>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script src="{{asset('api/password.js')}}"></script>
@endsection