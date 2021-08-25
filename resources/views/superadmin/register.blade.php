@extends('layouts/app')

@section('title','Register Company')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-8 offset-lg-3 offset-md-2">
				<div class="card nonee px-5" id="card">
					<div class="card-header border-bottom-0">
						<div class="d-flex align-items-center justify-content-between">
							<h4 class="mt-4">Register Company</h4>
						</div>
					</div>
					<div class="card-body">
						<form id="form">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" id="name" class="form-control" autofocus="autofocus">
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" id="email" class="form-control">
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group">
								<label for="company_name">Company Name</label>
								<input type="text" id="company_name" class="form-control">
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group">
								<label for="employee_reach_id">Number of Employee</label>
								<select id="employee_reach_id" class="custom-select" role="button"></select>
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group">
								<label for="phone_number">Phone Number</label>
								<input type="tel" id="phone_number" class="form-control">
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" id="username" class="form-control">
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group position-relative">
								<label for="password">Password</label>
								<input type="password" id="password" class="form-control pr-5" minlength="8" maxlength="32" autocomplete="on">
								<i class="password mdi mdi-eye-off mdi-18px" data-id="password"></i>
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group position-relative">
								<label for="cpassword">Password Confirmation</label>
								<input type="password" id="cpassword" class="form-control pr-5" minlength="8" maxlength="32" autocomplete="on">
								<i class="password mdi mdi-eye-off mdi-18px" data-id="cpassword"></i>
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group mt-4">
								<button class="btn btn-block btn-dark" id="submit">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script src="{{asset('api/superadmin/register.js')}}"></script>
@endsection