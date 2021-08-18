@extends('layouts/app')

@section('title','Edit Branch')

@section('style')
	<link rel="stylesheet" href="{{asset('assets/vendors/croppie/croppie.css')}}">
@endsection

@section('content')
	<div class="container">
		<div class="card none" id="card">
			<div class="card-header border-bottom-0">
				<div class="d-flex align-items-center justify-content-between">
					<h4 class="d-nonee d-md-block mb-4 mt-1">Edit Branch</h4>
				</div>
			</div>
			<div class="row">
				<div class="offset-lg-2 col-lg-8">
					<div class="card-body">
						<form>
							<div class="row">
								<div class="form-group offset-3 col-6 text-center px-0">
									<img class="avatar border rounded-circle" width="140" id="image" alt="Logo">
									<div class="form-group mt-2">
										<label class="text-primary mb-0" for="photo" role="button">Upload Logo</label>
										<input type="file" class="none" id="photo" accept="image/*">
										<div class="invalid-feedback"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6 order-1">
									<label for="name" class="col-form-label">Branch Name*</label>
									<input class="form-control" id="name">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6 order-sm-2 order-3">
									<label for="postal_code" class="col-form-label">Postal Code*</label>
									<input type="tel" class="form-control" id="postal_code" minlength="5" maxlength="5">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-12 order-sm-3 order-2">
									<label for="address" class="col-form-label">Branch Address*</label>
									<textarea class="form-control form-control-sm" id="address" rows="3"></textarea>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6 order-4">
									<label for="province_id" class="col-form-label">Province*</label>
									<select class="custom-select" id="province_id" role="button">
										<option disabled selected value="">Choose</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6 order-5">
									<label for="city_id" class="col-form-label">District/City*</label>
									<select class="custom-select" id="city_id" role="button">
										<option disabled selected value="">Choose</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6 order-6">
									<label for="umr" class="col-form-label">UMR*</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">Rp</div>
										</div>
										<input type="tel" class="form-control number" id="umr">
										<div class="invalid-feedback"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="phone_number" class="col-form-label">Branch Phone Number*</label>
									<input type="tel" class="form-control" id="phone_number">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="email" class="col-form-label">Branch Email*</label>
									<input type="email" class="form-control" id="email">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="bpjs" class="col-form-label">BPJS Ketenagakerjaan*</label>
									<input type="tel" class="form-control" id="bpjs">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="jkk_id" class="col-form-label">JKK*</label>
									<select class="custom-select" id="jkk_id" role="button">
										<option disabled selected value="">Choose</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="npwp" class="col-form-label">Branch NPWP*</label>
									<input type="tel" class="form-control npwp" id="npwp" maxlength="20">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="taxable_date" class="col-form-label">Branch Taxable Date*</label>
									<input type="date" class="form-control" id="taxable_date">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="tax_person_name" class="col-form-label">Tax Person Name*</label>
									<input type="text" class="form-control" id="tax_person_name">
									<div class="invalid-feedback"></div>
								</div>
								<div class="form-group col-sm-6">
									<label for="tax_person_npwp" class="col-form-label">Tax Person NPWP*</label>
									<input type="tel" class="form-control npwp" id="tax_person_npwp" maxlength="20">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="signature" class="col-form-label">Signature</label>
									<div class="text-center" id="signature-preview">
										<img src="{{asset('assets/images/signature-example.png')}}" class="img-fluid" id="signature-image" alt="Signature">
										<label class="text-primary mb-0" role="button" for="signature">Upload Signature</label>
										<div class="invalid-feedback"></div>
									</div>
									<div class="custom-file none">
										<label class="custom-file-label" for="signature">Choose File</label>
										<input type="file" class="custom-file-input" id="signature" accept="image/*" role="button">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="text-right mt-4">
									<button class="btn btn-dark" id="submit">Save Changes</button>
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
	<script>const company_id = {{$id}}</script>
	<script src="{{asset('assets/js/photo.js')}}"></script>
	<script src="{{asset('assets/js/signature.js')}}"></script>
	<script src="{{asset('assets/js/format.js')}}"></script>
    <script src="{{asset('assets/vendors/croppie/croppie.min.js')}}"></script>
	<script src="{{asset('api/admin/company/edit-branch.js')}}"></script>
@endsection