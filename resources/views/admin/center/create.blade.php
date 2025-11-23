@extends('admin.layouts.base')
@section('title', 'Add Center')
@push('custom-css')
<style type="text/css">
		
</style>
@endpush
@section('content')
<!-- end page title -->
<div class="row mt-3">
	<div class="col-lg-12">
		<form id='update_frm' method="post" enctype="multipart/form-data">
			@csrf
			<div class="card">
				<div class="card-header bg-secondary text-white font-weight-bold">
					Center Registration
					<span class='float-right' style='float:right'>
						<a href="{{ route('center_list') }}">  <button class="btn btn-dark btn-sm" > View All </button></a>
					<button class="btn btn-success btn-sm" id="update_btn" accesskey="s"> SAVE </button>                                    </span>
				</div>
				<div class="card-body"> 
					<div class='row'>
						{{-- <div class="col-md-4 mb-3">
							<div class="form-group mb-3">
								<label>Center Code <span class="text-danger">*</span></label>
								<input required class="form-control" placeholder="Center Code"  type='number' name='center_code'>
							</div>
						</div> --}}
						<div class="col-md-4 mb-3">
							<div class="form-group mb-3">
								<label>Center Name <span class="text-danger">*</span></label>
								<input required class="form-control" placeholder="Center Name" type='text' name='center_name'>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group mb-3">
								<label>Center Director Name <span class="text-danger">*</span></label>
								<input required class="form-control" placeholder="Director Name"  type='text' name='director_name'>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group mb-3">
								<label>Center Address <span class="text-danger">*</span></label>
								<input required class="form-control" placeholder="Address"  type='text' name='center_address'>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group mb-3">
								<label>Center Email <span class="text-danger">*</span></label>
								<input required class="form-control" placeholder="Email"  type='email' name='center_email'>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group mb-3">
								<label>Center Mobile <span class="text-danger">*</span></label>
								<input required class="form-control" placeholder="Mobile"  type='number' name='center_mobile'>
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group mb-3">
								<label>Photo <span class="text-danger">*</span></label>
								<input required class="form-control"  type='file' name='photo'>
							</div>
						</div>
					</div>
					<div class="row">
					    <div class="col-lg-12">
					        <h5 style="background: #74788d;padding: 9px;color: #fff;font-size: 14px;">Center Document</h5>
					    </div>
					</div>
					<div class="row">
					    <div class="col-lg-4 mb-3">
					        <div class="form-group mb-3">
    							<label>Center Stamp <span class="text-danger">*</span></label>
    							<input required class="form-control"  type='file' name='center_stamp'>
						    </div>
					    </div>
					    <div class="col-lg-4 mb-3">
					        <div class="form-group mb-3">
    							<label>Center Signature <span class="text-danger">*</span></label>
    							<input required class="form-control"  type='file' name='center_signature'>
						    </div>
					    </div>
					    <div class="col-lg-4 mb-3">
					        <div class="form-group mb-3">
    							<label>Director Adhar Card <span class="text-danger">*</span></label>
    							<input required class="form-control"  type='file' name='director_adhar'>
						    </div>
					    </div>
					    <div class="col-lg-4 mb-3">
					        <div class="form-group mb-3">
    							<label>Director PAN Card <span class="text-danger">*</span></label>
    							<input required class="form-control"  type='file' name='director_pan'>
						    </div>
					    </div>
					    <div class="col-lg-4 mb-3">
					        <div class="form-group mb-3">
    							<label>Director Education <span class="text-danger">*</span></label>
    							<input required class="form-control" placeholder="Director Education"  type='text' name='director_education'>
						    </div>
					    </div>
						<div class="col-lg-4 mb-3">
					        <div class="form-group mb-3">
    							<label>Center Payment Amount</label>
    							<input required class="form-control" placeholder="Center Payment Amount"  type='text' name='cl_wallet_balance'>
						    </div>
					    </div>
					</div>
				</div>
				<!-- end select2 -->
			</div>
		</form>
			<!-- <div class="card-footer bg-white">
					<hr>
					
					<hr>
			</div> -->
		</div>
		<!-- end row -->
		</div> <!-- container-fluid -->
	</div>
	<!-- End Page-content -->
</div>
@endsection
@push('custom-js')
@endpush