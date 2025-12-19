@extends('admin.layouts.base')
@section('title', 'Add Center')
@push('custom-css')
<style type="text/css">
	/* Modern Form Styling */
	.modern-card {
		border: none;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		border-radius: 0.5rem;
		overflow: hidden;
	}
	
	.form-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.form-header h4 {
		color: white;
		margin: 0;
		font-weight: 600;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	
	.form-header h4 i {
		font-size: 1.75rem;
	}
	
	.form-section-title {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 0.75rem 1rem;
		border-radius: 0.5rem;
		font-weight: 600;
		font-size: 1rem;
		margin: 1.5rem 0 1rem 0;
		display: flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.form-group label {
		font-weight: 600;
		color: #495057;
		margin-bottom: 0.5rem;
		font-size: 0.875rem;
	}
	
	.form-group label .text-danger {
		color: #dc2626;
	}
	
	.form-control {
		border-radius: 0.5rem;
		border: 1px solid #dee2e6;
		padding: 0.75rem 1rem;
		transition: all 0.3s ease;
	}
	
	.form-control:focus {
		border-color: #2563eb;
		box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
		outline: none;
	}
	
	.btn-save {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		border: none;
		padding: 0.75rem 2rem;
		border-radius: 0.5rem;
		font-weight: 600;
		box-shadow: 0 4px 6px rgba(17, 153, 142, 0.3);
		transition: all 0.3s ease;
	}
	
	.btn-save:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(17, 153, 142, 0.4);
		background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%);
	}
	
	.btn-view-all {
		background: #6c757d;
		border: none;
		padding: 0.75rem 1.5rem;
		border-radius: 0.5rem;
		font-weight: 600;
		transition: all 0.3s ease;
	}
	
	.btn-view-all:hover {
		background: #5a6268;
		transform: translateY(-2px);
	}
	
	.file-upload-wrapper {
		position: relative;
		display: inline-block;
		width: 100%;
	}
	
	.file-upload-wrapper input[type="file"] {
		padding: 0.75rem;
		border: 2px dashed #dee2e6;
		border-radius: 0.5rem;
		transition: all 0.3s ease;
	}
	
	.file-upload-wrapper input[type="file"]:hover {
		border-color: #2563eb;
		background-color: #f8f9ff;
	}
</style>
@endpush

@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<form id='update_frm' method="post" action="{{ route('add_center') }}" enctype="multipart/form-data">
			@csrf
			<div class="card modern-card">
				<div class="card-header form-header">
					<div class="d-flex justify-content-between align-items-center">
						<h4>
							<i class="fas fa-building"></i>
							Center Registration
						</h4>
						<div>
							<a href="{{ route('center_list') }}">
								<button type="button" class="btn btn-view-all text-white me-2">
									<i class="fas fa-list me-2"></i>View All
								</button>
							</a>
							<button type="submit" class="btn btn-save text-white" id="update_btn">
								<i class="fas fa-save me-2"></i>SAVE
							</button>
						</div>
					</div>
				</div>
				<div class="card-body p-4">
					<!-- Basic Information Section -->
					<div class="form-section-title">
						<i class="fas fa-info-circle"></i>
						Basic Information
					</div>
					
					<div class="row">
						<div class="col-md-4 mb-3">
							<div class="form-group">
								<label>Center Name <span class="text-danger">*</span></label>
								<input required class="form-control" placeholder="Enter Center Name" type='text' name='center_name' value="{{ old('center_name') }}">
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group">
								<label>Center Director Name <span class="text-danger">*</span></label>
								<input required class="form-control" placeholder="Enter Director Name" type='text' name='director_name' value="{{ old('director_name') }}">
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group">
								<label>Center Address <span class="text-danger">*</span></label>
								<input required class="form-control" placeholder="Enter Center Address" type='text' name='center_address' value="{{ old('center_address') }}">
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group">
								<label>Center Email <span class="text-danger">*</span></label>
								<input required class="form-control" placeholder="Enter Email Address" type='email' name='center_email' value="{{ old('center_email') }}">
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group">
								<label>Center Mobile <span class="text-danger">*</span></label>
								<input required class="form-control" placeholder="Enter Mobile Number" type='number' name='center_mobile' value="{{ old('center_mobile') }}">
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group">
								<label>Center Payment Amount</label>
								<input class="form-control" placeholder="Enter Initial Balance" type='number' step="0.01" name='cl_wallet_balance' value="{{ old('cl_wallet_balance', 0) }}">
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<div class="form-group">
								<label>Center Photo <span class="text-danger">*</span></label>
								<div class="file-upload-wrapper">
									<input required class="form-control" type='file' name='photo' accept="image/*">
								</div>
							</div>
						</div>
					</div>
					
					<!-- Center Documents Section -->
					<div class="form-section-title">
						<i class="fas fa-file-alt"></i>
						Center Documents
					</div>
					
					<div class="row">
						<div class="col-lg-4 mb-3">
							<div class="form-group">
								<label>Center Stamp <span class="text-danger">*</span></label>
								<div class="file-upload-wrapper">
									<input required class="form-control" type='file' name='center_stamp' accept="image/*">
								</div>
							</div>
						</div>
						<div class="col-lg-4 mb-3">
							<div class="form-group">
								<label>Center Signature <span class="text-danger">*</span></label>
								<div class="file-upload-wrapper">
									<input required class="form-control" type='file' name='center_signature' accept="image/*">
								</div>
							</div>
						</div>
						<div class="col-lg-4 mb-3">
							<div class="form-group">
								<label>Director Aadhaar Card <span class="text-danger">*</span></label>
								<div class="file-upload-wrapper">
									<input required class="form-control" type='file' name='director_adhar' accept="image/*,application/pdf">
								</div>
							</div>
						</div>
						<div class="col-lg-4 mb-3">
							<div class="form-group">
								<label>Director PAN Card <span class="text-danger">*</span></label>
								<div class="file-upload-wrapper">
									<input required class="form-control" type='file' name='director_pan' accept="image/*,application/pdf">
								</div>
							</div>
						</div>
						<div class="col-lg-4 mb-3">
							<div class="form-group">
								<label>Director Education <span class="text-danger">*</span></label>
								<input required class="form-control" placeholder="Enter Director Education" type='text' name='director_education' value="{{ old('director_education') }}">
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@push('custom-js')
<script>
	$(document).ready(function() {
		$('#update_frm').on('submit', function(e) {
			// Add loading state
			$('#update_btn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>SAVING...');
		});
	});
</script>
@endpush
