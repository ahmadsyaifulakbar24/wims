<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register - WIMS</title>
	<link rel="stylesheet" href="{{asset('assets/vendors/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/auth.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/loader.css')}}">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="auth">
		<div class="card card-custom shadow">
			<div class="card-head text-center px-4 pt-4">
				<!-- <img src="{{asset('assets/images/eoffice.png')}}" width="120"> -->
				<h2 class="pt-4">Register</h2>
			</div>
			<form class="card-body">
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
				<div class="form-group mt-5">
					<button class="btn btn-dark btn-block mb-4" id="submit" disabled>
						<span id="text">Register</span>
						<div class="loader loader-sm none" id="load">
							<svg class="circular" viewBox="25 25 50 50">
								<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
							</svg>
						</div>
					</button>
				</div>
			</form>
		</div>
		<!-- <div class="d-none d-sm-block text-center mb-5">
			<span class="text-secondary">&copy; 2021 PT. Karl Wig Abadi. All right reserved.</span>
		</div> -->
	</div>
	@include('layouts.partials.script')
	<script src="{{asset('api/register.js')}}"></script>
</body>
</html>