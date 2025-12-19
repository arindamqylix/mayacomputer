@extends('student.layouts.base')
@section('title', 'Profile')
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
	
	.form-group label {
		font-weight: 600;
		color: #495057;
		margin-bottom: 0.5rem;
		font-size: 0.875rem;
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
		width: 100%;
	}
	
	.btn-save:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(17, 153, 142, 0.4);
		background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%);
	}
	
	#imageContainer {
		text-align: center;
		margin-bottom: 1rem;
	}
	
	#selectedImage {
		max-width: 200px;
		max-height: 200px;
		border-radius: 50%;
		border: 4px solid #2563eb;
		box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
		object-fit: cover;
		transition: all 0.3s ease;
	}
	
	#selectedImage:hover {
		transform: scale(1.05);
		box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
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
	<div class="col-lg-8 offset-lg-2">
		<form method="POST" action="{{ route('student_profile_update') }}" enctype="multipart/form-data">
			@csrf
			<div class="card modern-card">
				<div class="card-header form-header">
					<h4>
						<i class="fas fa-user-edit"></i>
						Profile Update
					</h4>
				</div>
				<div class="card-body p-4">
					<div class="row">
						<div class="col-lg-12 mb-3">
							<div id="imageContainer">
								@if(isset($data->al_photo) && $data->al_photo)
									<img id="selectedImage" src="{{ asset('admin/profile/').'/'.$data->al_photo }}" alt="Profile Photo">
								@else
									<img id="selectedImage" src="{{ asset('no_img.png') }}" alt="Profile Photo" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%27200%27 height=%27200%27%3E%3Crect fill=%27%23ddd%27 width=%27200%27 height=%27200%27/%3E%3Ctext fill=%27%23999%27 font-family=%27sans-serif%27 font-size=%2716%27 x=%2750%25%27 y=%2750%25%27 text-anchor=%27middle%27 dy=%27.3em%27%3ENo Photo%3C/text%3E%3C/svg%3E'">
								@endif
							</div>
						</div>
						<div class="col-lg-12 mb-3">
							<div class="form-group">
								<label><i class="fas fa-user me-2"></i>Full Name</label>
								<input type="text" class="form-control" value="{{ $data->al_name ?? '' }}" name="fullname" placeholder="Enter Your Full Name" required>
							</div>
						</div>
						<div class="col-lg-12 mb-3">
							<div class="form-group">
								<label><i class="fas fa-envelope me-2"></i>Email</label>
								<input type="email" class="form-control" value="{{ $data->al_email ?? '' }}" name="email" placeholder="Enter Your Email" required>
							</div>
						</div>
						<div class="col-lg-12 mb-3">
							<div class="form-group">
								<label><i class="fas fa-phone me-2"></i>Mobile</label>
								<input type="number" class="form-control" value="{{ $data->al_mobile ?? '' }}" name="mobile" placeholder="Enter Your Mobile" required>
							</div>
						</div>
						<div class="col-lg-12 mb-3">
							<div class="form-group">
								<label><i class="fas fa-image me-2"></i>Photo</label>
								<div class="file-upload-wrapper">
									<input type="file" id="imageInput" class="form-control" name="photo" accept="image/*">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<button type="submit" class="btn btn-save text-white">
								<i class="fas fa-save me-2"></i>Save Changes
							</button>
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
		$('#imageInput').on('change', function(e) {
			const file = e.target.files[0];
			if (file) {
				const reader = new FileReader();
				reader.onload = function(e) {
					$('#selectedImage').attr('src', e.target.result);
				}
				reader.readAsDataURL(file);
			}
		});
		
		$('form').on('submit', function(e) {
			$('button[type="submit"]').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Saving...');
		});
	});
</script>
@endpush
