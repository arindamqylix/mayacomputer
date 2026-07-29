@extends('student.layouts.base')
@section('title', 'Certificates')
@push('custom-css')
<style type="text/css">
	.cert-page .page-card {
		background: #fff;
		border-radius: 16px;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
		border: none;
		overflow: hidden;
	}
	.cert-page .list-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		padding: 1.5rem 1.75rem;
	}
	.cert-page .list-header h4 {
		color: white;
		margin: 0;
		font-weight: 700;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	.cert-page .list-header .subtitle {
		color: rgba(255, 255, 255, 0.9);
		font-size: 0.9rem;
		margin: 0.5rem 0 0 0;
	}
	.cert-page .info-banner {
		background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
		border-left: 4px solid #2563eb;
		border-radius: 0 8px 8px 0;
		padding: 0.875rem 1rem;
		margin-bottom: 1.5rem;
		font-size: 0.9rem;
		color: #1e40af;
	}
	.cert-page .modern-table thead th {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		font-weight: 600;
		text-transform: uppercase;
		font-size: 0.7rem;
		padding: 1rem 1.25rem;
		border: none;
	}
	.cert-page .modern-table tbody td {
		padding: 1rem 1.25rem;
		vertical-align: middle;
		border-bottom: 1px solid #f1f5f9;
	}
	.cert-page .cert-no {
		font-weight: 700;
		color: #1e40af;
		font-family: Consolas, Monaco, monospace;
	}
	.cert-page .course-badge {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 0.35rem 0.75rem;
		border-radius: 8px;
		font-size: 0.8rem;
		font-weight: 600;
	}
	.cert-page .btn-view {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 0.5rem 1rem;
		border-radius: 10px;
		font-weight: 600;
		font-size: 0.85rem;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
	}
	.cert-page .btn-view:hover { color: white; opacity: 0.95; }
	.cert-page .empty-state {
		text-align: center;
		padding: 3rem 2rem;
	}
</style>
@endpush

@section('content')
<div class="container-fluid py-4 cert-page">
	<div class="row">
		<div class="col-12">
			<div class="page-card">
				<div class="list-header">
					<h4>
						<i class="fas fa-certificate"></i>
						Course Certificates
						@if($certificates->count() > 0)
							<span class="badge bg-light text-primary ms-2">{{ $certificates->count() }}</span>
						@endif
					</h4>
					<p class="subtitle">Regular course certificates issued after your result is published</p>
				</div>
				<div class="card-body p-4">
					@if(session('error'))
						<div class="alert alert-danger">{{ session('error') }}</div>
					@endif

					<div class="info-banner">
						<i class="fas fa-info-circle me-2"></i>
						These are your diploma/course certificates linked to published results. For typing courses, use the <strong>Typing Certificate</strong> menu.
					</div>

					@if($certificates->count() > 0)
						<div class="table-responsive">
							<table class="table modern-table mb-0">
								<thead>
									<tr>
										<th>#</th>
										<th>Certificate No.</th>
										<th>Course</th>
										<th>Issue Date</th>
										<th>Result</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $i = 1; @endphp
									@foreach($certificates as $cert)
										<tr>
											<td>{{ $i++ }}</td>
											<td><span class="cert-no">{{ $cert->sc_certificate_number ?? 'N/A' }}</span></td>
											<td><span class="course-badge">{{ $cert->c_short_name ?? $cert->c_full_name ?? 'N/A' }}</span></td>
											<td>
												@if($cert->sc_issue_date)
													{{ \Carbon\Carbon::parse($cert->sc_issue_date)->format('d M Y') }}
												@else
													—
												@endif
											</td>
											<td>{{ $cert->sr_percentage ?? '—' }}% / {{ $cert->sr_grade ?? '—' }}</td>
											<td>
												<a href="{{ route('student.view_regular_certificate', $cert->sc_id) }}" class="btn-view" target="_blank">
													<i class="fas fa-eye"></i> View
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@else
						<div class="empty-state">
							<i class="fas fa-certificate fa-3x text-muted mb-3"></i>
							<h5>No Course Certificate Yet</h5>
							<p class="text-muted">Your certificate will appear here once your center generates it after your result is published.</p>
							<a href="{{ route('student_dashboard') }}" class="btn btn-primary mt-2">
								<i class="fas fa-arrow-left me-1"></i> Back to Dashboard
							</a>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
