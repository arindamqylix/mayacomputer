@extends('student.layouts.base')
@section('title', 'Typing Certificates')
@push('custom-css')
<style type="text/css">
	.typing-page .page-card {
		background: #fff;
		border-radius: 16px;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
		border: none;
		overflow: hidden;
		transition: box-shadow 0.3s ease;
	}
	.typing-page .page-card:hover {
		box-shadow: 0 8px 30px rgba(37, 99, 235, 0.12);
	}
	.typing-page .list-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		padding: 1.5rem 1.75rem;
		position: relative;
		overflow: hidden;
	}
	.typing-page .list-header::after {
		content: '';
		position: absolute;
		top: -50%;
		right: -10%;
		width: 280px;
		height: 280px;
		background: rgba(255, 255, 255, 0.08);
		border-radius: 50%;
	}
	.typing-page .list-header h4 {
		color: white;
		margin: 0;
		font-weight: 700;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
		position: relative;
		z-index: 1;
		text-shadow: 0 1px 2px rgba(0,0,0,0.1);
	}
	.typing-page .list-header .header-icon {
		width: 44px;
		height: 44px;
		border-radius: 12px;
		background: rgba(255, 255, 255, 0.2);
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 1.25rem;
	}
	.typing-page .list-header .subtitle {
		color: rgba(255, 255, 255, 0.9);
		font-size: 0.9rem;
		margin: 0.5rem 0 0 0;
		position: relative;
		z-index: 1;
	}
	.typing-page .card-body {
		padding: 1.5rem 1.75rem;
	}
	.typing-page .info-banner {
		background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
		border-left: 4px solid #2563eb;
		border-radius: 0 8px 8px 0;
		padding: 0.875rem 1rem;
		margin-bottom: 1.5rem;
		font-size: 0.9rem;
		color: #1e40af;
	}
	.typing-page .cert-table-wrap {
		border-radius: 12px;
		overflow: hidden;
		border: 1px solid #e5e7eb;
	}
	.typing-page .modern-table {
		margin: 0;
	}
	.typing-page .modern-table thead th {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		font-weight: 600;
		text-transform: uppercase;
		font-size: 0.7rem;
		letter-spacing: 0.6px;
		padding: 1rem 1.25rem;
		border: none;
	}
	.typing-page .modern-table thead th:first-child {
		border-radius: 0;
	}
	.typing-page .modern-table tbody tr {
		transition: background 0.2s ease;
	}
	.typing-page .modern-table tbody tr:hover {
		background: #f8fafc;
	}
	.typing-page .modern-table tbody td {
		padding: 1rem 1.25rem;
		vertical-align: middle;
		border-bottom: 1px solid #f1f5f9;
		font-size: 0.95rem;
	}
	.typing-page .modern-table tbody tr:last-child td {
		border-bottom: none;
	}
	.typing-page .cert-no {
		font-weight: 700;
		color: #1e40af;
		font-family: 'Consolas', 'Monaco', monospace;
		font-size: 0.9rem;
	}
	.typing-page .course-badge {
		display: inline-block;
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 0.35rem 0.75rem;
		border-radius: 8px;
		font-size: 0.8rem;
		font-weight: 600;
	}
	.typing-page .stat-pill {
		background: #f1f5f9;
		color: #475569;
		padding: 0.35rem 0.65rem;
		border-radius: 6px;
		font-size: 0.85rem;
		font-weight: 600;
	}
	.typing-page .btn-view {
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
		transition: all 0.25s ease;
		border: none;
		box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
	}
	.typing-page .btn-view:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4);
		color: white;
	}
	.typing-page .empty-state {
		text-align: center;
		padding: 3rem 2rem;
	}
	.typing-page .empty-state .empty-icon {
		width: 80px;
		height: 80px;
		border-radius: 20px;
		background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
		color: #2563eb;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		font-size: 2.25rem;
		margin-bottom: 1.5rem;
	}
	.typing-page .empty-state h5 {
		font-weight: 700;
		color: #1e293b;
		margin-bottom: 0.5rem;
	}
	.typing-page .empty-state p {
		color: #64748b;
		max-width: 400px;
		margin: 0 auto 1.5rem;
		font-size: 0.95rem;
	}
	.typing-page .btn-back {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 0.6rem 1.25rem;
		border-radius: 10px;
		font-weight: 600;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		transition: all 0.25s ease;
		border: none;
		box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
	}
	.typing-page .btn-back:hover {
		color: white;
		transform: translateY(-2px);
		box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4);
	}
	.typing-page .count-badge {
		background: rgba(255,255,255,0.25);
		color: white;
		padding: 0.25rem 0.6rem;
		border-radius: 20px;
		font-size: 0.8rem;
		font-weight: 600;
		margin-left: 0.5rem;
	}
</style>

@section('content')
<div class="container-fluid py-4 typing-page">
	<div class="row">
		<div class="col-12">
			<div class="page-card">
				<div class="list-header">
					<div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
						<div>
							<h4>
								<span class="header-icon"><i class="fas fa-keyboard"></i></span>
								Typing Certificates
								@if($certificates->count() > 0)
									<span class="count-badge">{{ $certificates->count() }} {{ $certificates->count() === 1 ? 'certificate' : 'certificates' }}</span>
								@endif
							</h4>
							<p class="subtitle">Issued by your center — no result publication required</p>
						</div>
					</div>
				</div>
				<div class="card-body">
					@if(session('success'))
						<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
							<i class="fas fa-check-circle me-2"></i>{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
						</div>
					@endif
					@if(session('error'))
						<div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
							<i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
						</div>
					@endif

					<div class="info-banner">
						<i class="fas fa-info-circle me-2"></i>
						Typing certificates are issued by your center and do not require result publication. Below are your issued typing certificates.
					</div>

					@if($certificates->count() > 0)
						<div class="cert-table-wrap">
							<div class="table-responsive">
								<table class="table modern-table mb-0">
									<thead>
										<tr>
											<th style="width: 50px;">#</th>
											<th>Certificate No.</th>
											<th>Course</th>
											<th>Issue Date</th>
											<th>Speed</th>
											<th>Accuracy</th>
											<th style="width: 120px;">Action</th>
										</tr>
									</thead>
									<tbody>
										@php $i = 1; @endphp
										@foreach($certificates as $cert)
											<tr>
												<td class="text-muted">{{ $i++ }}</td>
												<td><span class="cert-no">{{ $cert->sc_certificate_number ?? 'N/A' }}</span></td>
												<td><span class="course-badge">{{ $cert->c_short_name ?? $cert->c_full_name ?? 'N/A' }}</span></td>
												<td>
													@if($cert->sc_issue_date)
														{{ \Carbon\Carbon::parse($cert->sc_issue_date)->format('d M Y') }}
													@else
														<span class="text-muted">–</span>
													@endif
												</td>
												<td><span class="stat-pill">{{ $cert->sc_typing_speed ?? '–' }} WPM</span></td>
												<td><span class="stat-pill">{{ $cert->sc_typing_accuracy ?? '–' }}%</span></td>
												<td>
													<a href="{{ route('student.view_typing_certificate', $cert->sc_id) }}" class="btn-view" title="View / Download certificate">
														<i class="fas fa-eye"></i> View
													</a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					@else
						<div class="empty-state">
							<div class="empty-icon">
								<i class="fas fa-keyboard"></i>
							</div>
							<h5>No Typing Certificates Yet</h5>
							<p>Your center will add typing certificates here once they are generated. No result publication is required for typing certificates.</p>
							<a href="{{ route('student_dashboard') }}" class="btn-back">
								<i class="fas fa-arrow-left"></i> Back to Dashboard
							</a>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
