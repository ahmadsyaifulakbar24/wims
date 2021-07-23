@extends('layouts/app')

@section('title','Attendance')

@section('content')
	<div class="container">
		<div class="d-flex justify-content-between align-items-center mb-2">
			<h2 class="d-none d-md-block">Attendance</h2>
			<div class="ml-auto">
				<div class="custom-select pr-5" role="button">8 Jun 2021</div>
			</div>
		</div>
		<div class="card border-top-0">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th class="text-truncate text-center">No.</th>
							<th class="text-truncate">Name</th>
							<th class="text-truncate">Clock In</th>
							<th class="text-truncate">Clock Out</th>
							<th class="text-truncate">Description</th>
							<th class="text-truncate"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center">1.</td>
							<td class="text-truncate">Ahmad Syaiful</td>
							<td>09:15</td>
							<td>17:00</td>
							<td></td>
							<td class="text-truncate"><a href="{{url('time-management/attendance/1')}}">View log</a></td>
							<!-- <td>
								<div class="d-flex">
									<a href="" class="text-dark"><i class="mdi mdi-18px mdi-pencil"></i></a>
									<div><i class="mdi mdi-18px mdi-trash-can-outline"></i></div>
								</div>
							</td> -->
						</tr>
						<tr>
							<td class="text-center">2.</td>
							<td class="text-truncate">Nur Hilmi</td>
							<td>09:30</td>
							<td>17:00</td>
							<td>Forgot absence</td>
							<td class="text-truncate"><a href="{{url('time-management/attendance/1')}}">View log</a></td>
							<!-- <td>
								<div class="d-flex">
									<a href="" class="text-dark"><i class="mdi mdi-18px mdi-pencil"></i></a>
									<div><i class="mdi mdi-18px mdi-trash-can-outline"></i></div>
								</div>
							</td> -->
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<!-- <script src="{{asset('api/dashboard.js')}}"></script> -->
@endsection