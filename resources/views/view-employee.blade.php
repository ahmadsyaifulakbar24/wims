@extends('layouts/app')

@section('title','Nur Hilmi')

@section('content')
	<div class="container">
		<h2 class="text-truncate mb-0">Nur Hilmi</h2>
		<p class="text-secondary mb-3">Frontend</p>
		<div class="row">
			<div class="col-xl-4 col-lg-5">
				<div class="card mb-3">
					<div class="card-body py-0">
						<h6 class="py-3 mb-0" data-toggle="collapse" href="#status" role="button" aria-expanded="false" aria-controls="status">Menu</h6>
						<div class="collapse show " id="status">
							<ul class="nav nav-pills flex-column text-secondary mb-4" id="status_project">
								<li class="nav-item">
							        <div class="nav-link d-flex align-items-center active" role="button">
							            <i class="mdi mdi-pencil-outline mdi-18px"></i>
							            <span>General Info</span>
							        </div>
							    </li>
								<li class="nav-item">
							        <div class="nav-link d-flex align-items-center" role="button">
							            <i class="mdi mdi-calendar-check mdi-18px"></i>
							            <span>Time Management</span>
							        </div>
							    </li>
								<li class="nav-item">
							        <div class="nav-link d-flex align-items-center" role="button">
							            <i class="mdi mdi-calculator-variant mdi-18px"></i>
							            <span>Payroll</span>
							        </div>
							    </li>
								<li class="nav-item">
							        <div class="nav-link d-flex align-items-center" role="button">
							            <i class="mdi mdi-credit-card-outline mdi-18px"></i>
							            <span>Finance</span>
							        </div>
							    </li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-8 col-lg-7">
				<div class="card py-2">
					<div class="card-body">
						<form>
							<div class="form-group row">
								<label for="profile_photo" class="col-md-3 col-form-label text-md-right">Profile Photo</label>
								<div class="col-md-9">
									<div class="custom-file">
										<label class="custom-file-label" for="profile_photo">Pilih Foto</label>
										<input type="file" class="custom-file-input" id="profile_photo" accept="image/*" role="button">
										<div class="invalid-feedback"></div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="employee_id" class="col-md-3 col-form-label text-md-right">Employee Id</label>
								<div class="col-md-9">
									<input class="form-control" id="employee_id">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="first_name" class="col-md-3 col-form-label text-md-right">First Name</label>
								<div class="col-md-9">
									<input class="form-control" id="first_name">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="last_name" class="col-md-3 col-form-label text-md-right">Last Name</label>
								<div class="col-md-9">
									<input class="form-control" id="last_name">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="username" class="col-md-3 col-form-label text-md-right">Username</label>
								<div class="col-md-9">
									<input class="form-control" id="username">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="password" class="col-md-3 col-form-label text-md-right">Password</label>
								<div class="col-md-9">
									<input type="password" class="form-control" id="password">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="password_confirmation" class="col-md-3 col-form-label text-md-right">Confirm Password</label>
								<div class="col-md-9">
									<input type="password" class="form-control" id="password_confirmation">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="email" class="col-md-3 col-form-label text-md-right">Email</label>
								<div class="col-md-9">
									<input type="email" class="form-control" id="email">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="identity_type" class="col-md-3 col-form-label text-md-right">Identity Type</label>
								<div class="col-md-9">
									<select class="custom-select" id="identity_type" role="button">
										<option disabled selected>Pilih</option>
										<option>KTP</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="no_identity" class="col-md-3 col-form-label text-md-right">Number Identity</label>
								<div class="col-md-9">
									<input class="form-control" id="no_identity">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="expired_date_identity" class="col-md-3 col-form-label text-md-right">Expired Date Identity</label>
								<div class="col-md-9">
									<input type="date" class="form-control" id="expired_date_identity">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="postal_code" class="col-md-3 col-form-label text-md-right">Postal Code</label>
								<div class="col-md-9">
									<input type="tel" class="form-control" id="postal_code" minlength="5" maxlength="5">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="identity_address" class="col-md-3 col-form-label text-md-right">Identity Address</label>
								<div class="col-md-9">
									<textarea class="form-control" id="identity_address" rows="3"></textarea>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="residential_address" class="col-md-3 col-form-label text-md-right">Residential Address</label>
								<div class="col-md-9">
									<textarea class="form-control" id="residential_address" rows="3"></textarea>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="place_of_birth" class="col-md-3 col-form-label text-md-right">Place of birth</label>
								<div class="col-md-9">
									<input class="form-control" id="place_of_birth">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="date_of_birth" class="col-md-3 col-form-label text-md-right">Date of birth</label>
								<div class="col-md-9">
									<input type="date" class="form-control" id="date_of_birth">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="mobile_phone" class="col-md-3 col-form-label text-md-right">Mobile Phone</label>
								<div class="col-md-9">
									<input type="tel" class="form-control" id="mobile_phone">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="phone" class="col-md-3 col-form-label text-md-right">Phone (Optional)</label>
								<div class="col-md-9">
									<input type="tel" class="form-control" id="phone">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row" id="time-management">
								<label for="gender" class="col-md-3 col-form-label text-md-right">Gender</label>
								<div class="col-md-9">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="gender" id="male" value="male">
										<label class="form-check-label" for="male" role="button">Male</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="gender" id="female" value="female">
										<label class="form-check-label" for="female" role="button">Female</label>
									</div>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="martial_status_id" class="col-md-3 col-form-label text-md-right">Martial Status</label>
								<div class="col-md-9">
									<select class="custom-select" id="martial_status_id" role="button">
										<option disabled selected>Pilih</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="blood_type_id" class="col-md-3 col-form-label text-md-right">Blood Type</label>
								<div class="col-md-9">
									<select class="custom-select" id="blood_type_id" role="button">
										<option disabled selected>Pilih</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="religion_id" class="col-md-3 col-form-label text-md-right">Religion</label>
								<div class="col-md-9">
									<select class="custom-select" id="religion_id" role="button">
										<option disabled selected>Pilih</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="education_id" class="col-md-3 col-form-label text-md-right">Education</label>
								<div class="col-md-9">
									<select class="custom-select" id="education_id" role="button">
										<option disabled selected>Pilih</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="company_id" class="col-md-3 col-form-label text-md-right">Company</label>
								<div class="col-md-9">
									<select class="custom-select" id="company_id" role="button">
										<option disabled selected>Pilih</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="organization_id" class="col-md-3 col-form-label text-md-right">Organization</label>
								<div class="col-md-9">
									<select class="custom-select" id="organization_id" role="button">
										<option disabled selected>Pilih</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="job_position_id" class="col-md-3 col-form-label text-md-right">Job Position</label>
								<div class="col-md-9">
									<select class="custom-select" id="job_position_id" role="button">
										<option disabled selected>Pilih</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="job_level_id" class="col-md-3 col-form-label text-md-right">Job Level</label>
								<div class="col-md-9">
									<select class="custom-select" id="job_level_id" role="button">
										<option disabled selected>Pilih</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="employee_status_id" class="col-md-3 col-form-label text-md-right">Employee Status</label>
								<div class="col-md-9">
									<select class="custom-select" id="employee_status_id" role="button">
										<option disabled selected>Pilih</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="join_date" class="col-md-3 col-form-label text-md-right">Join Date</label>
								<div class="col-md-9">
									<input type="date" class="form-control" id="join_date">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="end_date" class="col-md-3 col-form-label text-md-right">End Date</label>
								<div class="col-md-9">
									<input type="date" class="form-control" id="end_date">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="basic_salary" class="col-md-3 col-form-label text-md-right">Basic Salary</label>
								<div class="col-md-9">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">Rp</div>
										</div>
										<input type="tel" class="form-control" id="basic_salary">
									<div class="invalid-feedback"></div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="npwp" class="col-md-3 col-form-label text-md-right">NPWP</label>
								<div class="col-md-9">
									<input type="tel" class="form-control npwp" id="npwp">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="ptkp_id" class="col-md-3 col-form-label text-md-right">PTKP</label>
								<div class="col-md-9">
									<select class="custom-select" id="ptkp_id" role="button">
										<option disabled selected>Pilih</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="bank_id" class="col-md-3 col-form-label text-md-right">Bank Name</label>
								<div class="col-md-9">
									<select class="custom-select" id="bank_id" role="button">
										<option disabled selected>Pilih</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="bank_account" class="col-md-3 col-form-label text-md-right">Bank Account Number</label>
								<div class="col-md-9">
									<input type="tel" class="form-control" id="bank_account">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="bank_account_holder" class="col-md-3 col-form-label text-md-right">Bank Account Name</label>
								<div class="col-md-9">
									<input class="form-control" id="bank_account_holder">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="bpjs_ketenagakerjaan" class="col-md-3 col-form-label text-md-right">BPJS Ketenagakerjaan</label>
								<div class="col-md-9">
									<input type="tel" class="form-control" id="bpjs_ketenagakerjaan">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="bpjs_kesehatan" class="col-md-3 col-form-label text-md-right">BPJS Kesehatan</label>
								<div class="col-md-9">
									<input type="tel" class="form-control" id="bpjs_kesehatan">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="bpjs_kesehatan_family" class="col-md-3 col-form-label text-md-right">BPJS Kesehatan Keluarga</label>
								<div class="col-md-9">
									<input type="tel" class="form-control" id="bpjs_kesehatan_family">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="type_salary" class="col-md-3 col-form-label text-md-right">Type Salary</label>
								<div class="col-md-9">
									<select class="custom-select" id="type_salary" role="button">
										<option disabled selected>Pilih</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<div class="offset-md-3 col-md-9 text-right text-md-left mt-2">
									<button class="btn btn-primary">Save Change</button>
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
	<!-- <script src="{{asset('api/dashboard.js')}}"></script> -->

	<script>
		$(document).on('click', '.nav-link', function() {
		    $('html, body').animate({
		        scrollTop: $("#time-management").offset().top
		    }, 500);
		});
	</script>
	<script>
		var target = $("#status").offset().top,
	    timeout = null;
		$(window).scroll(function () {
		    if (!timeout) {
		        timeout = setTimeout(function () {
		            // console.log('scroll');            
		            clearTimeout(timeout);
		            timeout = null;
		            if ($(window).scrollTop() >= 70) {
		                $('#menu').addClass('fixed-top')
		                $('#menu').attr('style', 'width:350px;left:85px;top:80px')
		            } else {
		            	$('#menu').removeClass('fixed-top')
		                $('#menu').attr('style', 'width:100%')
		            }
		        }, 250);
		    }
		});
	</script>
@endsection