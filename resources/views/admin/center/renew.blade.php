@extends('admin.layouts.base')
@section('title', 'Renew Center Registration')
@push('custom-css')
<style type="text/css">
	.renew-header {
		background: linear-gradient(135deg, #10b981 0%, #059669 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.renew-header h4 {
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
	
	.info-box {
		background: #f8f9fa;
		border-left: 4px solid #10b981;
		padding: 1rem;
		margin-bottom: 1.5rem;
		border-radius: 0.25rem;
	}
	
	.info-box h6 {
		margin: 0 0 0.5rem 0;
		color: #059669;
		font-weight: 600;
	}
	
	.date-display {
		font-size: 1.1rem;
		font-weight: 600;
		color: #1e3a8a;
	}
	
	.badge-success {
		background: #10b981;
		color: white;
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		font-weight: 600;
	}
</style>
@endpush

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="modern-card">
				<div class="renew-header">
					<h4>
						<i class="fas fa-sync-alt"></i>
						Renew Center Registration
					</h4>
				</div>
				<div class="card-body">
					<div class="info-box">
						<h6><i class="fas fa-info-circle"></i> Center Information</h6>
						<p class="mb-1"><strong>Center Code:</strong> {{ $center->cl_code }}</p>
						<p class="mb-1"><strong>Center Name:</strong> {{ $center->cl_center_name }}</p>
						<p class="mb-0"><strong>Director Name:</strong> {{ $center->cl_director_name }}</p>
					</div>
					
					<div class="info-box">
						<h6><i class="fas fa-calendar"></i> Current Registration Details</h6>
						<p class="mb-2">
							<strong>Registration Date:</strong> 
							<span class="date-display">
								@if($center->cl_registration_date)
									{{ \Carbon\Carbon::parse($center->cl_registration_date)->format('d/m/Y') }}
								@else
									<span class="text-muted">Not Set</span>
								@endif
							</span>
						</p>
						<p class="mb-0">
							<strong>Valid Till:</strong> 
							<span class="date-display">
								@if($center->cl_valid_till)
									{{ \Carbon\Carbon::parse($center->cl_valid_till)->format('d/m/Y') }}
									@php
										$validTill = \Carbon\Carbon::parse($center->cl_valid_till);
										$isExpired = $validTill->isPast();
									@endphp
									@if($isExpired)
										<span class="badge bg-danger ms-2">Expired</span>
									@else
										<span class="badge bg-success ms-2">Active</span>
									@endif
								@else
									<span class="text-muted">Not Set</span>
								@endif
							</span>
						</p>
					</div>
					
					<div class="alert alert-info">
						<h6><i class="fas fa-info-circle"></i> Renewal Information</h6>
						<p class="mb-0">
							Renewing this center registration will extend the validity by <strong>5 years</strong> from the current valid till date 
							@if($center->cl_valid_till && \Carbon\Carbon::parse($center->cl_valid_till)->isFuture())
								({{ \Carbon\Carbon::parse($center->cl_valid_till)->addYears(5)->format('d/m/Y') }})
							@else
								or from today if expired ({{ \Carbon\Carbon::now()->addYears(5)->format('d/m/Y') }})
							@endif
						</p>
					</div>
					
					<form method="POST" action="{{ route('admin.center.renew.now', $center->cl_id) }}">
						@csrf
						<div class="d-flex gap-2">
							<button type="submit" class="btn btn-success btn-lg">
								<i class="fas fa-sync-alt"></i> Confirm Renewal (Extend by 5 Years)
							</button>
							<a href="{{ route('center_list') }}" class="btn btn-secondary btn-lg">
								<i class="fas fa-times"></i> Cancel
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

