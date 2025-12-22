@extends('admin.layouts.base')
@section('title', 'Dispatch Certificate')
@push('custom-css')
<style type="text/css">
	.dispatch-header {
		background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.dispatch-header h4 {
		color: white;
		margin: 0;
		font-weight: 600;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	
	.modern-card {
		border: none;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		border-radius: 0.5rem;
		overflow: hidden;
	}
	
	.info-card {
		background: #f8f9fa;
		border-radius: 0.5rem;
		padding: 1.5rem;
		margin-bottom: 2rem;
		border-left: 4px solid #2563eb;
	}
	
	.info-row {
		display: flex;
		justify-content: space-between;
		padding: 0.75rem 0;
		border-bottom: 1px solid #e9ecef;
	}
	
	.info-row:last-child {
		border-bottom: none;
	}
	
	.info-label {
		font-weight: 600;
		color: #495057;
	}
	
	.info-value {
		color: #212529;
		font-weight: 500;
	}
	
	.form-group label {
		font-weight: 600;
		color: #495057;
		margin-bottom: 0.5rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.form-control {
		border-radius: 0.5rem;
		border: 1px solid #dee2e6;
		padding: 0.75rem 1rem;
		transition: all 0.3s ease;
	}
	
	.form-control:focus {
		border-color: #f59e0b;
		box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.25);
		outline: none;
	}
	
	.btn-submit {
		background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
		color: white;
		padding: 0.75rem 2rem;
		border-radius: 0.5rem;
		font-weight: 600;
		border: none;
		transition: all 0.3s ease;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.btn-submit:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(245, 158, 11, 0.4);
		color: white;
	}
	
	.btn-back {
		background: #6c757d;
		color: white;
		padding: 0.75rem 1.5rem;
		border-radius: 0.5rem;
		font-weight: 600;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		margin-right: 1rem;
	}
	
	.btn-back:hover {
		background: #5a6268;
		color: white;
	}
</style>
@endpush

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="modern-card">
				<div class="dispatch-header">
					<h4>
						<i class="fas fa-truck"></i>
						Dispatch Certificate
					</h4>
				</div>
				<div class="card-body p-4">
					@if(session('success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
						</div>
					@endif
					
					@if(session('error'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							{{ session('error') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
						</div>
					@endif
					
					<!-- Certificate Information -->
					<div class="info-card">
						<h5 class="mb-3"><i class="fas fa-info-circle"></i> Certificate Information</h5>
						<div class="info-row">
							<span class="info-label">Certificate No:</span>
							<span class="info-value"><strong>{{ $certificate->sc_certificate_number ?? 'N/A' }}</strong></span>
						</div>
						<div class="info-row">
							<span class="info-label">Student Name:</span>
							<span class="info-value">{{ $certificate->sl_name ?? 'N/A' }}</span>
						</div>
						<div class="info-row">
							<span class="info-label">Registration No:</span>
							<span class="info-value">{{ $certificate->sl_reg_no ?? 'N/A' }}</span>
						</div>
						<div class="info-row">
							<span class="info-label">Course:</span>
							<span class="info-value">{{ $certificate->c_short_name ?? $certificate->c_full_name ?? 'N/A' }}</span>
						</div>
						<div class="info-row">
							<span class="info-label">Center:</span>
							<span class="info-value">{{ $certificate->cl_center_name ?? 'N/A' }} ({{ $certificate->cl_code ?? 'N/A' }})</span>
						</div>
						@if($certificate->sc_issue_date)
						<div class="info-row">
							<span class="info-label">Issue Date:</span>
							<span class="info-value">{{ \Carbon\Carbon::parse($certificate->sc_issue_date)->format('d-M-Y') }}</span>
						</div>
						@endif
					</div>
					
					<!-- Dispatch Form -->
					<form action="{{ route('admin.certificate_dispatch_update', $certificate->sc_id) }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label for="dispatch_thru">
										<i class="fas fa-truck"></i>
										Dispatch Thru (Courier/Company Name) <span class="text-danger">*</span>
									</label>
									<input type="text" 
										   class="form-control" 
										   id="dispatch_thru" 
										   name="dispatch_thru" 
										   value="{{ $certificate->sc_dispatch_thru ?? old('dispatch_thru') }}"
										   placeholder="e.g., Blue Dart, DTDC, India Post" 
										   required>
								</div>
							</div>
							
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label for="dispatch_date">
										<i class="fas fa-calendar-alt"></i>
										Dispatch Date <span class="text-danger">*</span>
									</label>
									<input type="date" 
										   class="form-control" 
										   id="dispatch_date" 
										   name="dispatch_date" 
										   value="{{ $certificate->sc_dispatch_date ?? old('dispatch_date', date('Y-m-d')) }}"
										   required>
								</div>
							</div>
							
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label for="tracking_number">
										<i class="fas fa-barcode"></i>
										Tracking Number <span class="text-danger">*</span>
									</label>
									<input type="text" 
										   class="form-control" 
										   id="tracking_number" 
										   name="tracking_number" 
										   value="{{ $certificate->sc_tracking_number ?? old('tracking_number') }}"
										   placeholder="Enter tracking number" 
										   required>
								</div>
							</div>
							
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label for="doc_quantity">
										<i class="fas fa-file-alt"></i>
										Document Quantity <span class="text-danger">*</span>
									</label>
									<input type="number" 
										   class="form-control" 
										   id="doc_quantity" 
										   name="doc_quantity" 
										   value="{{ $certificate->sc_doc_quantity ?? old('doc_quantity', 1) }}"
										   min="1" 
										   required>
									<small class="form-text text-muted">Number of documents being dispatched</small>
								</div>
							</div>
						</div>
						
						<div class="mt-4">
							<a href="{{ route('admin.certificate_list') }}" class="btn-back">
								<i class="fas fa-arrow-left"></i>
								Back to List
							</a>
							<button type="submit" class="btn-submit">
								<i class="fas fa-save"></i>
								Update Dispatch Information
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

