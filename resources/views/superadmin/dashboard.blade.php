@extends('layouts/app')

@section('title','Dashboard')

@section('content')
	<div class="container">
		<div class="card mb-3">
			<div class="card-body">
				<h5>Welcome, <span class="name"></span></h5>
				<p class="text-secondary" id="dateNow"></p>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script src="{{asset('api/admin/dashboard.js')}}"></script>
@endsection