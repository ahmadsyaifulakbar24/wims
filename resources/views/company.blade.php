@extends('layouts/app')

@section('title','Company')

@section('content')
	<div class="container">
		<h2 class="d-none d-md-block mb-3">Company</h2>
		<div class="row">
			<div class="col-12">
				<div class="card py-2">
					<div class="card-body">
						<form>
							<div class="form-group row">
								<label for="logo" class="col-md-3 col-form-label text-md-right">Company Logo</label>
								<div class="col-md-9">
									<div class="custom-file">
										<label class="custom-file-label" for="logo">Pilih Foto</label>
										<input type="file" class="custom-file-input" id="logo" accept="image/*" role="button">
										<div class="invalid-feedback"></div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="parent_id" class="col-md-3 col-form-label text-md-right">Parent</label>
								<div class="col-md-9">
									<select class="custom-select" id="parent_id" role="button">
										<option>Pilih</option>
										<option>Select 2</option>
										<option>Select 3</option>
										<option>Select 4</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="type" class="col-md-3 col-form-label text-md-right">Type</label>
								<div class="col-md-9">
									<select class="custom-select" id="type" role="button">
										<option>Pilih</option>
										<option>Select 2</option>
										<option>Select 3</option>
										<option>Select 4</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="name" class="col-md-3 col-form-label text-md-right">Company Name</label>
								<div class="col-md-9">
									<input class="form-control" id="name">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="address" class="col-md-3 col-form-label text-md-right">Company Address</label>
								<div class="col-md-9">
									<textarea class="form-control" id="address" rows="3"></textarea>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="postal_code" class="col-md-3 col-form-label text-md-right">Postal Code</label>
								<div class="col-md-9">
									<input type="tel" class="form-control" id="postal_code" maxlength="5">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="province_id" class="col-md-3 col-form-label text-md-right">Province</label>
								<div class="col-md-9">
									<select class="custom-select" id="province_id" role="button">
										<option>Pilih</option>
										<option>Select 2</option>
										<option>Select 3</option>
										<option>Select 4</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="city_id" class="col-md-3 col-form-label text-md-right">District/City</label>
								<div class="col-md-9">
									<select class="custom-select" id="city_id" role="button">
										<option>Pilih</option>
										<option>Select 2</option>
										<option>Select 3</option>
										<option>Select 4</option>
									</select>
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="postal_code" class="col-md-3 col-form-label text-md-right">Postal Code</label>
								<div class="col-md-9">
									<input type="tel" class="form-control" id="postal_code" maxlength="5">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="phone_number" class="col-md-3 col-form-label text-md-right">Phone Number</label>
								<div class="col-md-9">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">+62</div>
										</div>
										<input type="tel" class="form-control" id="phone_number">
									<div class="invalid-feedback"></div>
									</div>
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
								<label for="umr" class="col-md-3 col-form-label text-md-right">UMR</label>
								<div class="col-md-9">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">Rp</div>
										</div>
										<input type="tel" class="form-control" id="umr">
									<div class="invalid-feedback"></div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="bpjs" class="col-md-3 col-form-label text-md-right">BPJS</label>
								<div class="col-md-9">
									<input type="tel" class="form-control" id="bpjs">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="jkk" class="col-md-3 col-form-label text-md-right">JKK</label>
								<div class="col-md-9">
									<input type="tel" class="form-control" id="jkk">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="npwp" class="col-md-3 col-form-label text-md-right">NPWP</label>
								<div class="col-md-9">
									<input type="tel" class="form-control" id="npwp">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="taxable_date" class="col-md-3 col-form-label text-md-right">Taxable Date</label>
								<div class="col-md-9">
									<input type="date" class="form-control" id="taxable_date">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="tax_person_name" class="col-md-3 col-form-label text-md-right">Tax Person Name</label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="tax_person_name">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="tax_person_npwp" class="col-md-3 col-form-label text-md-right">Tax Person NPWP</label>
								<div class="col-md-9">
									<input type="tel" class="form-control" id="tax_person_npwp">
									<div class="invalid-feedback"></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="signature" class="col-md-3 col-form-label text-md-right">Signature</label>
								<div class="col-md-9">
									<div class="custom-file">
										<label class="custom-file-label" for="signature">Pilih Foto</label>
										<input type="file" class="custom-file-input" id="signature" accept="image/*" role="button">
										<div class="invalid-feedback"></div>
									</div>
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
@endsection