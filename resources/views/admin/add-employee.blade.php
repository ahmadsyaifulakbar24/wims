@extends('layouts/app')

@section('title','Add Employee')

@section('style')
	<link rel="stylesheet" href="{{asset('assets/vendors/croppie/croppie.css')}}">
@endsection

@section('content')
	<div class="container">
		<div class="card none" id="card">
			<div class="card-header border-bottom-0">
				<div class="d-flex align-items-center justify-content-between">
					<h4 class="mb-4 mt-1">Add Employee</h4>
				</div>
			</div>
			<div class="row">
				<div class="offset-lg-2 col-lg-8">
					<div class="card-body">
						<form id="form">
							<h5>Personal Data</h5>
							<p class="text-secondary">Fill all employee personal basic information data.</p>
							<div class="row mt-2">
								<div class="offset-3 col-6 text-center">
									<img src="{{asset('assets/images/user.jpg')}}" class="border rounded-circle" width="140" id="image" alt="Logo">
									<div class="form-group mt-2 mb-0">
										<label class="text-primary" for="photo" role="button">Upload Photo</label>
										<input type="file" class="none" id="photo" accept="image/*">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="first_name" class="col-form-label">Name*</label>
								<div class="row">
									<div class="col-sm-6 mb-1">
										<input type="text" class="form-control" id="first_name" placeholder="First name" autofocus="autofocus">
										<div class="invalid-feedback"></div>
									</div>
									<div class="col-sm-6">
										<input type="text" class="form-control" id="last_name" placeholder="Last name">
										<div class="invalid-feedback"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="email" class="col-form-label">Email</label>
									<input type="email" class="form-control" id="email">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="mobile_phone" class="col-form-label">Mobile Phone</label>
									<input type="tel" class="form-control" id="mobile_phone">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="phone" class="col-form-label">Phone</label>
									<input type="tel" class="form-control" id="phone">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="place_of_birth" class="col-form-label">Place of birth</label>
									<input type="text" class="form-control" id="place_of_birth">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="date_of_birth" class="col-form-label">Date of birth</label>
									<input type="date" class="form-control" id="date_of_birth">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="gender" class="d-block col-form-label">Gender*</label>
									<div class="form-check form-check-inline" id="gender">
										<input class="form-check-input" type="radio" name="gender" id="male" value="male">
										<label class="form-check-label" for="male" role="button">Male</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="gender" id="female" value="female">
										<label class="form-check-label" for="female" role="button">Female</label>
									</div>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="religion_id" class="col-form-label">Religion*</label>
									<select class="custom-select" id="religion_id" role="button">
										<option disabled selected>Select</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="marital_status_id" class="col-form-label">Marital Status*</label>
									<select class="custom-select" id="marital_status_id" role="button">
										<option disabled selected>Select</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="education_id" class="col-form-label">Education</label>
									<select class="custom-select" id="education_id" role="button">
										<option disabled selected>Select</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="blood_type_id" class="col-form-label">Blood Type</label>
									<select class="custom-select" id="blood_type_id" role="button">
										<option disabled selected>Select</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>

							<hr class="mt-5">
							<h5>Identity & Address</h5>
							<p class="text-secondary">Employee identity address information.</p>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="identity_type" class="col-form-label">Identity Type</label>
									<select class="custom-select" id="identity_type" role="button">
										<option disabled selected>Select</option>
										<option value="ktp">KTP</option>
										<!-- <option value="sim">SIM</option> -->
										<option value="passport">Passport</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="no_identity" class="col-form-label">Identity Number</label>
									<input class="form-control" id="no_identity">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="expired_date_identity" class="col-form-label">Expired Date Identity</label>
									<input type="date" class="form-control" id="expired_date_identity">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="postal_code" class="col-form-label">Postal Code</label>
									<input type="tel" class="form-control" id="postal_code" minlength="5" maxlength="5">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group">
								<label for="identity_address" class="col-form-label">Identity Address</label>
								<textarea class="form-control form-control-sm" id="identity_address" rows="3"></textarea>
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group">
								<label for="residential_address" class="col-form-label">Residential Address</label>
								<textarea class="form-control form-control-sm" id="residential_address" rows="3"></textarea>
								<div class="invalid-feedback"></div>
							</div>

							<hr class="mt-5">
							<h5>Employment Data</h5>
							<p class="text-secondary">Fill all employee data information related to company.</p>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="employee_id" class="col-form-label">Employee Id*</label>
									<input class="form-control" id="employee_id">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="employee_status_id" class="col-form-label">Employee Status*</label>
									<select class="custom-select" id="employee_status_id" role="button">
										<option disabled selected>Select</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="join_date" class="col-form-label">Join Date*</label>
									<input type="date" class="form-control" id="join_date">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="end_date" class="col-form-label">End Status Date</label>
									<input type="date" class="form-control" id="end_date">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="company_id" class="col-form-label">Company*</label>
									<select class="custom-select" id="company_id" role="button">
										<option disabled selected>Select</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="organization_id" class="col-form-label">Organization*</label>
									<select class="custom-select" id="organization_id" role="button">
										<option disabled selected>Select</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="job_position_id" class="col-form-label">Job Position*</label>
									<select class="custom-select" id="job_position_id" role="button">
										<option disabled selected>Select</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="job_level_id" class="col-form-label">Job Level*</label>
									<select class="custom-select" id="job_level_id" role="button">
										<option disabled selected>Select</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>

							<hr class="mt-5">
							<h5>Salary</h5>
							<p class="text-secondary">Employee salary information.</p>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="basic_salary" class="col-form-label">Basic Salary*</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">Rp</div>
										</div>
										<input type="tel" class="form-control number" id="basic_salary">
										<div class="invalid-feedback"></div>
									</div>
								</div>
								<div class="form-group col-sm-6">
									<label for="type_salary" class="col-form-label">Type Salary*</label>
									<select class="custom-select" id="type_salary" role="button">
										<option disabled selected>Select</option>
										<option value="monthly">Monthly</option>
										<option value="daily">Daily</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>

							<hr class="mt-5">
							<h5>Bank Account</h5>
							<p class="text-secondary">The employee's bank account is user for payroll.</p>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="bank_id" class="col-form-label">Bank Name</label>
									<select class="custom-select" id="bank_id" role="button">
										<option disabled selected>Select</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="bank_account" class="col-form-label">Bank Account Number</label>
									<input type="tel" class="form-control" id="bank_account">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="bank_account_holder" class="col-form-label">Bank Account Name</label>
									<input class="form-control" id="bank_account_holder">
									<div class="invalid-feedback"></div>
								</div>
							</div>

							<hr class="mt-5">
							<h5>Tax Configuration</h5>
							<p class="text-secondary">Select the tax calculation type relevant to your company.</p>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="npwp" class="col-form-label">NPWP</label>
									<input type="tel" class="form-control npwp" id="npwp" maxlength="20">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="ptkp_id" class="col-form-label">PTKP Status</label>
									<select class="custom-select" id="ptkp_id" role="button">
										<option selected value="">Select</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>

							<hr class="mt-5">
							<h5>BPJS Configuration</h5>
							<p class="text-secondary">Employee BPJS payment arrangements.</p>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="bpjs_ketenagakerjaan" class="col-form-label">BPJS Ketenagakerjaan</label>
									<input type="tel" class="form-control" id="bpjs_ketenagakerjaan">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="bpjs_kesehatan" class="col-form-label">BPJS Kesehatan</label>
									<input type="tel" class="form-control" id="bpjs_kesehatan">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="bpjs_kesehatan_family" class="col-form-label">BPJS Kesehatan Keluarga</label>
									<input type="tel" class="form-control" id="bpjs_kesehatan_family">
									<div class="invalid-feedback"></div>
								</div>
							</div>

							<hr class="mt-5">
							<h5>Login Account</h5>
							<p class="text-secondary">Create the username and password for login.</p>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="username" class="col-form-label">Username*</label>
									<input type="text" class="form-control" id="username">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group position-relative">
										<label for="password">Password*</label>
										<input type="password" class="form-control" id="password" minlength="8" maxlength="8">
										<i class="password mdi mdi-eye-off mdi-18px" data-id="password"></i>
										<div class="invalid-feedback"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group position-relative">
										<label for="cpassword">Password Confirmation*</label>
										<input type="password" class="form-control" id="cpassword" minlength="8" maxlength="8">
										<i class="password mdi mdi-eye-off mdi-18px" data-id="cpassword"></i>
										<div class="invalid-feedback"></div>
									</div>
								</div>
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
@endsection

@section('script')
	<script src="{{asset('assets/js/photo.js')}}"></script>
	<script src="{{asset('assets/js/format.js')}}"></script>
    <script src="{{asset('assets/vendors/croppie/croppie.min.js')}}"></script>
	<script src="{{asset('api/admin/add-employee.js')}}"></script>
@endsection