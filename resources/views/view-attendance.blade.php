@extends('layouts/app')

@section('title','View log')

@section('content')
	<div class="container">
		<h2 class="d-none d-md-block mb-3">View log</h2>
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-8 mb-3">
						<div class="d-flex align-content-stretch">
							<img src="{{asset('assets/images/attendance.png')}}" class="img-fluid col-6 px-0" alt="Attendance Photo">
							<iframe id="mapholder" width="100%" style="border:0;" class="col-6 px-0" loading="lazy"></iframe>
						</div>
					</div>
					<div class="col-lg-4">
						<h6>Name</h6>
						<p class="text-secondary">Nur Hilmi</p>
						<h6>Date</h6>
						<p class="text-secondary">8 Jun 2021</p>
						<div class="row">
							<div class="col-6">
								<h6>Clock In</h6>
								<p class="text-secondary">09:30</p>
							</div>
							<div class="col-6">
								<h6>Clock Out</h6>
								<p class="text-secondary">17:00</p>
							</div>
						</div>
						<h6>Coordinate</h6>
						<p class="text-secondary">-6.476333,106.84475</p>
						<h6>Description</h6>
						<p class="text-secondary">Forgot absence</p>
						<!-- <p class="text-secondary font-italic">None</p> -->
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<!-- <script src="{{asset('api/dashboard.js')}}"></script> -->
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
	<script>
		$(document).ready(function() {
			currentPosition()
		})

		function currentPosition() {
			var options = {
			  enableHighAccuracy: true,
			  timeout: 5000,
			  maximumAge: 0
			};

			function success(pos) {
			  var crd = pos.coords;

			  console.log('Your current position is:');
			  console.log(`Latitude : ${crd.latitude}`);
			  console.log(`Longitude: ${crd.longitude}`);
			  console.log(`More or less ${crd.accuracy} meters.`);
			  // $('#mapholder').attr('src', `https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.357490864971!2d${crd.longitude}!3d${crd.latitude}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMjgnMzQuOCJTIDEwNsKwNTAnNDEuMSJF!5e0!3m2!1sen!2sid!4v1623210852208!5m2!1sen!2sid`)
			  // $('#mapholder').attr('src', `https://www.google.com/maps/search/?api=1&query=${crd.latitude},${crd.longitude}`)
			  // $('#mapholder').attr('src', `https://maps.google.com/maps?q=loc:${crd.latitude},${crd.longitude}`)
			  $('#mapholder').attr('src', `https://www.google.com/maps?daddr=${crd.longitude},${crd.latitude}`)
			}

			function error(err) {
			  console.warn(`ERROR(${err.code}): ${err.message}`);
			}

			navigator.geolocation.getCurrentPosition(success, error, options);
		}
</script>
@endsection