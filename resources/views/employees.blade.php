@extends('layouts/app')

@section('title','Employees')

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-header border-bottom-0">
				<div class="d-flex align-items-center justify-content-between">
					<h4 class="d-none d-md-block mb-0">Employees</h4>
					<div>
						<!-- <i class="mdi mdi-24px mdi-magnify" role="button"></i>
						<i class="mdi mdi-24px mdi-tune" data-toggle="modal" data-target="#modal-filter" role="button"></i> -->
						<a href="{{url('employee/create')}}" class="text-dark" data-toggle="tooltip" data-placement="bottom" title="Add employee">
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
							<th class="text-truncate">Name</th>
							<th class="text-truncate">Employee ID</th>
							<th class="text-truncate">Organization</th>
							<th class="text-truncate">Job Position</th>
							<th class="text-truncate">Job Level</th>
							<th class="text-truncate"></th>
						</tr>
					</thead>
					<tbody id="table"></tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
@endsection

@section('script')
	<script src="{{asset('api/employees.js')}}"></script>
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
@endsection