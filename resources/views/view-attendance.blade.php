@extends('layouts/app')

@section('title','View Attendance')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-8 offset-lg-3 offset-md-2">
				<div class="card none" id="card">
					<div class="d-flex align-content-stretch">
						<img id="image" class="img-fluid col-6 px-0" alt="Attendance Photo">
						<iframe class="w-100 col-6 px-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1057.9601599099606!2d106.84425933117684!3d-6.476613092823479!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c1c3b5ee1685%3A0xacd0635f05867005!2sJl.%20Raya%20Cikaret%20No.75%2C%20Kp.%20Parung%20Jambu%2C%20Pabuaran%2C%20Cibinong%2C%20Bogor%2C%20Jawa%20Barat%2016915!5e0!3m2!1sen!2sid!4v1629443069060!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-6">
								<h6>Date</h6>
								<p class="text-secondary" id="date"></p>
							</div>
							<div class="col-6">
								<h6 id="type"></h6>
								<p class="text-secondary" id="time"></p>
							</div>
						</div>
						<div class="form-group">
							<h6>Coordinate</h6>
							<p class="text-secondary" id="coordinate"></p>
						</div>
						<div class="form-group">
							<h6>Notes</h6>
							<p class="text-secondary" id="description"></p>
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
		</div>
	</div>
@endsection

@section('script')
	<script>const date = '{{$date}}'</script>
	<script>const type = '{{$type}}'</script>
	<script src="{{asset('api/view-attendance.js')}}"></script>
@endsection