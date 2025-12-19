@extends('admin.layouts.base')
@section('title', 'Set Student Registration Fee')
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
		display: flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.form-control {
		border-radius: 0.5rem;
		border: 1px solid #dee2e6;
		padding: 0.75rem 1rem;
		transition: all 0.3s ease;
		font-size: 1rem;
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
		font-size: 1rem;
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
	
	/* Amount Input Wrapper */
	.amount-input-wrapper {
		position: relative;
	}
	
	.amount-input-wrapper::before {
		content: '₹';
		position: absolute;
		left: 1rem;
		top: 50%;
		transform: translateY(-50%);
		font-size: 1.25rem;
		font-weight: 700;
		color: #2563eb;
		z-index: 1;
	}
	
	.amount-input-wrapper input {
		padding-left: 2.5rem;
		font-size: 1.25rem;
		font-weight: 600;
	}
	
	/* Info Card */
	.info-card {
		background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
		border: 2px solid #e9ecef;
		border-radius: 12px;
		padding: 1.5rem;
		margin-top: 1.5rem;
	}
	
	.info-card h6 {
		color: #1e3a8a;
		font-weight: 600;
		margin-bottom: 0.75rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.info-card ul {
		margin: 0;
		padding-left: 1.5rem;
		color: #6c757d;
	}
	
	.info-card ul li {
		margin-bottom: 0.5rem;
	}
	
	/* Current Fee Display */
	.current-fee-display {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 1.5rem;
		border-radius: 12px;
		text-align: center;
		margin-bottom: 2rem;
		box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
	}
	
	.current-fee-display h5 {
		margin: 0 0 0.5rem 0;
		font-size: 0.875rem;
		opacity: 0.9;
		font-weight: 500;
	}
	
	.current-fee-display h2 {
		margin: 0;
		font-size: 2.5rem;
		font-weight: 700;
	}
	
	/* Icon Box */
	.icon-box {
		width: 80px;
		height: 80px;
		border-radius: 16px;
		background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(30, 64, 175, 0.1) 100%);
		display: flex;
		align-items: center;
		justify-content: center;
		margin: 0 auto 1.5rem;
	}
	
	.icon-box i {
		font-size: 2.5rem;
		color: #2563eb;
	}
</style>
@endpush

@section('content')
<div class="row mt-3">
	<div class="col-lg-8 offset-lg-2">
		<form method="POST" action="{{ route('set_reg_fee') }}">
			@csrf
			<div class="card modern-card">
				<div class="card-header form-header">
					<div class="d-flex justify-content-between align-items-center">
						<h4>
							<i class="fas fa-money-bill-wave"></i>
							Set Student Registration Fee
						</h4>
						<a href="{{ route('student_list') }}">
							<button type="button" class="btn btn-view-all text-white">
								<i class="fas fa-list me-2"></i>View Students
							</button>
						</a>
					</div>
				</div>
				<div class="card-body p-4">
					<!-- Current Fee Display -->
					<div class="current-fee-display">
						<h5>Current Registration Fee</h5>
						<h2>₹{{ number_format($student_reg_fee->srf_amount ?? 0, 2) }}</h2>
					</div>
					
					<!-- Icon -->
					<div class="icon-box">
						<i class="fas fa-edit"></i>
					</div>
					
					<!-- Form -->
					<div class="row justify-content-center">
						<div class="col-lg-8">
							<div class="form-group mb-4">
								<label>
									<i class="fas fa-rupee-sign"></i>
									New Registration Fee Amount
								</label>
								<div class="amount-input-wrapper">
									<input required 
									       type="number" 
									       step="0.01" 
									       min="0"
									       value="{{ $student_reg_fee->srf_amount ?? 0 }}" 
									       class="form-control" 
									       name="amount" 
									       placeholder="Enter amount">
								</div>
								<small class="form-text text-muted mt-2">
									<i class="fas fa-info-circle me-1"></i>
									This amount will be charged from centers when they register new students.
								</small>
							</div>
							
							<div class="info-card">
								<h6>
									<i class="fas fa-lightbulb"></i>
									Important Information
								</h6>
								<ul>
									<li>This fee applies to all new student registrations</li>
									<li>The amount will be deducted from center wallet balance</li>
									<li>Centers must have sufficient balance to register students</li>
									<li>Changes will take effect immediately after saving</li>
								</ul>
							</div>
							
							<div class="mt-4">
								<button type="submit" class="btn btn-save text-white">
									<i class="fas fa-save me-2"></i>Update Registration Fee
								</button>
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
<script type="text/javascript">
	$(document).ready(function() {
		// Format amount input
		$('input[name="amount"]').on('input', function() {
			let value = $(this).val();
			// Remove any non-numeric characters except decimal point
			value = value.replace(/[^0-9.]/g, '');
			// Ensure only one decimal point
			let parts = value.split('.');
			if (parts.length > 2) {
				value = parts[0] + '.' + parts.slice(1).join('');
			}
			$(this).val(value);
		});
		
		// Form submission
		$('form').on('submit', function(e) {
			const amount = parseFloat($('input[name="amount"]').val());
			
			if (isNaN(amount) || amount < 0) {
				e.preventDefault();
				if (typeof toastr !== 'undefined') {
					toastr.error('Please enter a valid amount');
				} else {
					alert('Please enter a valid amount');
				}
				return false;
			}
			
			if (amount === 0) {
				if (!confirm('Are you sure you want to set the registration fee to ₹0?')) {
					e.preventDefault();
					return false;
				}
			}
			
			$('button[type="submit"]').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Updating...');
		});
	});
</script>
@endpush
