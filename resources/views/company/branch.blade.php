@extends('layouts/app')

@section('title','Branch')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-header border-bottom-0">
				<div class="d-flex align-items-center justify-content-between">
					<h4 class="d-none d-md-block mb-0">Branch</h4>
					<div>
						<!-- <i class="mdi mdi-24px mdi-magnify" role="button"></i>
						<i class="mdi mdi-24px mdi-tune" data-toggle="modal" data-target="#modal-filter" role="button"></i> -->
						<a href="{{url('branch/create')}}" class="text-dark" data-toggle="tooltip" data-placement="bottom" title="Add branch">
							<i class="mdi mdi-24px mdi-plus-circle-outline pr-0"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-middle">
					<thead>
						<tr>
							<th class="text-truncate text-center">No.</th>
							<th class="text-truncate">Branch Name</th>
							<th class="text-truncate">Branch Code</th>
							<th class="text-truncate">Number of Employee</th>
							<th class="text-truncate">Email</th>
							<th class="text-truncate">Phone Number</th>
							<th class="text-truncate"></th>
						</tr>
					</thead>
					<tbody id="table"></tbody>
				</table>
			</div>
			<!-- <div class="d-flex flex-column justify-content-center align-items-center py-5">
				<div class="loader loader-sm">
					<svg class="circular" viewBox="25 25 50 50">
						<circle class="path-dark" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
					</svg>
				</div>
			</div> -->
		</div>
	</div>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
@endsection

@section('script')
	<script src="{{asset('api/company/branch.js')}}"></script>
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
@endsection