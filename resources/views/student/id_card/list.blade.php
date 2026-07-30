@extends('student.layouts.base')
@section('title', 'ID Cards')
@push('custom-css')
<style type="text/css">
	.doc-list-page {
		--dl-primary: #2563eb;
		--dl-primary-dark: #1e40af;
		--dl-surface: #ffffff;
		--dl-muted: #64748b;
		--dl-border: #e2e8f0;
		--dl-row-hover: #f8fafc;
	}

	.doc-list-page .page-card {
		background: var(--dl-surface);
		border-radius: 18px;
		box-shadow: 0 4px 24px rgba(15, 23, 42, 0.08);
		border: 1px solid rgba(226, 232, 240, 0.9);
		overflow: hidden;
		transition: box-shadow 0.3s ease, transform 0.3s ease;
	}

	.doc-list-page .page-card:hover {
		box-shadow: 0 10px 40px rgba(37, 99, 235, 0.12);
	}

	.doc-list-page .list-header {
		background: linear-gradient(135deg, var(--dl-primary) 0%, var(--dl-primary-dark) 100%);
		padding: 1.75rem 2rem;
		position: relative;
		overflow: hidden;
	}

	.doc-list-page .list-header::before {
		content: '';
		position: absolute;
		top: -60%;
		right: -8%;
		width: 320px;
		height: 320px;
		background: rgba(255, 255, 255, 0.1);
		border-radius: 50%;
	}

	.doc-list-page .list-header::after {
		content: '';
		position: absolute;
		bottom: -70%;
		left: 10%;
		width: 200px;
		height: 200px;
		background: rgba(255, 255, 255, 0.06);
		border-radius: 50%;
	}

	.doc-list-page .list-header-inner {
		position: relative;
		z-index: 1;
	}

	.doc-list-page .list-header h4 {
		color: #fff;
		margin: 0;
		font-weight: 700;
		font-size: 1.45rem;
		display: flex;
		align-items: center;
		flex-wrap: wrap;
		gap: 0.75rem;
		text-shadow: 0 1px 2px rgba(0, 0, 0, 0.12);
	}

	.doc-list-page .header-icon {
		width: 48px;
		height: 48px;
		border-radius: 14px;
		background: rgba(255, 255, 255, 0.18);
		backdrop-filter: blur(4px);
		display: inline-flex;
		align-items: center;
		justify-content: center;
		font-size: 1.2rem;
		flex-shrink: 0;
		box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25);
	}

	.doc-list-page .count-badge {
		background: rgba(255, 255, 255, 0.22);
		color: #fff;
		padding: 0.3rem 0.75rem;
		border-radius: 999px;
		font-size: 0.78rem;
		font-weight: 600;
		border: 1px solid rgba(255, 255, 255, 0.2);
	}

	.doc-list-page .subtitle {
		color: rgba(255, 255, 255, 0.92);
		font-size: 0.92rem;
		margin: 0.65rem 0 0 0;
		max-width: 640px;
		line-height: 1.5;
	}

	.doc-list-page .card-body {
		padding: 1.75rem 2rem 2rem;
	}

	.doc-list-page .info-banner {
		background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
		border: 1px solid #bfdbfe;
		border-left: 4px solid var(--dl-primary);
		border-radius: 0 12px 12px 0;
		padding: 1rem 1.15rem;
		margin-bottom: 1.5rem;
		font-size: 0.92rem;
		color: #1e40af;
		display: flex;
		align-items: flex-start;
		gap: 0.65rem;
		line-height: 1.55;
	}

	.doc-list-page .info-banner i {
		margin-top: 0.15rem;
		flex-shrink: 0;
	}

	.doc-list-page .list-table-wrap {
		border-radius: 14px;
		overflow: hidden;
		border: 1px solid var(--dl-border);
		background: #fff;
		box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
	}

	.doc-list-page .modern-table {
		margin: 0;
	}

	.doc-list-page .modern-table thead th {
		background: linear-gradient(135deg, var(--dl-primary) 0%, var(--dl-primary-dark) 100%);
		color: #fff;
		font-weight: 600;
		text-transform: uppercase;
		font-size: 0.68rem;
		letter-spacing: 0.55px;
		padding: 1rem 1.25rem;
		border: none;
		white-space: nowrap;
	}

	.doc-list-page .modern-table tbody tr {
		transition: background 0.2s ease, transform 0.2s ease;
	}

	.doc-list-page .modern-table tbody tr:hover {
		background: var(--dl-row-hover);
	}

	.doc-list-page .modern-table tbody td {
		padding: 1.05rem 1.25rem;
		vertical-align: middle;
		border-bottom: 1px solid #f1f5f9;
		font-size: 0.94rem;
		color: #334155;
	}

	.doc-list-page .modern-table tbody tr:last-child td {
		border-bottom: none;
	}

	.doc-list-page .row-num {
		color: var(--dl-muted);
		font-weight: 600;
		font-size: 0.85rem;
	}

	.doc-list-page .course-badge {
		display: inline-block;
		background: linear-gradient(135deg, var(--dl-primary) 0%, var(--dl-primary-dark) 100%);
		color: #fff;
		padding: 0.4rem 0.8rem;
		border-radius: 999px;
		font-size: 0.78rem;
		font-weight: 600;
		box-shadow: 0 2px 8px rgba(37, 99, 235, 0.22);
	}

	.doc-list-page .course-subtitle {
		font-size: 0.78rem;
		color: var(--dl-muted);
		margin-top: 0.35rem;
		line-height: 1.35;
		max-width: 280px;
	}

	.doc-list-page .reg-no,
	.doc-list-page .cert-no {
		font-weight: 700;
		color: var(--dl-primary-dark);
		font-family: Consolas, Monaco, 'Courier New', monospace;
		font-size: 0.88rem;
		background: #eff6ff;
		padding: 0.35rem 0.65rem;
		border-radius: 8px;
		border: 1px solid #dbeafe;
		display: inline-block;
	}

	.doc-list-page .status-badge {
		padding: 0.38rem 0.72rem;
		border-radius: 999px;
		font-weight: 700;
		font-size: 0.72rem;
		text-transform: uppercase;
		letter-spacing: 0.3px;
		display: inline-flex;
		align-items: center;
		gap: 0.35rem;
	}

	.doc-list-page .status-badge::before {
		content: '';
		width: 6px;
		height: 6px;
		border-radius: 50%;
		background: currentColor;
		opacity: 0.85;
	}

	.doc-list-page .status-verified,
	.doc-list-page .status-result-out,
	.doc-list-page .status-dispatched {
		background: #dcfce7;
		color: #166534;
		border: 1px solid #bbf7d0;
	}

	.doc-list-page .status-pending {
		background: #fef3c7;
		color: #92400e;
		border: 1px solid #fde68a;
	}

	.doc-list-page .status-block {
		background: #fee2e2;
		color: #991b1b;
		border: 1px solid #fecaca;
	}

	.doc-list-page .grade-badge,
	.doc-list-page .stat-pill {
		background: #f1f5f9;
		color: #475569;
		padding: 0.38rem 0.72rem;
		border-radius: 8px;
		font-size: 0.84rem;
		font-weight: 600;
		border: 1px solid #e2e8f0;
		display: inline-block;
	}

	.doc-list-page .grade-badge {
		background: #dbeafe;
		color: #1e40af;
		border-color: #bfdbfe;
	}

	.doc-list-page .marks-text {
		font-weight: 600;
		color: #0f172a;
	}

	.doc-list-page .marks-text span {
		color: var(--dl-muted);
		font-weight: 500;
	}

	.doc-list-page .btn-view {
		background: linear-gradient(135deg, var(--dl-primary) 0%, var(--dl-primary-dark) 100%);
		color: #fff;
		padding: 0.55rem 1.05rem;
		border-radius: 10px;
		font-weight: 600;
		font-size: 0.84rem;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.45rem;
		transition: all 0.25s ease;
		border: none;
		box-shadow: 0 2px 10px rgba(37, 99, 235, 0.28);
		white-space: nowrap;
	}

	.doc-list-page .btn-view:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 18px rgba(37, 99, 235, 0.38);
		color: #fff;
	}

	.doc-list-page .btn-disabled {
		background: #f1f5f9;
		color: #94a3b8;
		padding: 0.55rem 1.05rem;
		border-radius: 10px;
		font-weight: 600;
		font-size: 0.84rem;
		display: inline-flex;
		align-items: center;
		gap: 0.45rem;
		cursor: not-allowed;
		border: 1px solid #e2e8f0;
		white-space: nowrap;
	}

	.doc-list-page .empty-state {
		text-align: center;
		padding: 3.5rem 2rem;
	}

	.doc-list-page .empty-icon {
		width: 88px;
		height: 88px;
		border-radius: 22px;
		background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
		color: var(--dl-primary);
		display: inline-flex;
		align-items: center;
		justify-content: center;
		font-size: 2.2rem;
		margin-bottom: 1.25rem;
		box-shadow: 0 8px 24px rgba(37, 99, 235, 0.12);
	}

	.doc-list-page .empty-state h5 {
		font-weight: 700;
		color: #1e293b;
		margin-bottom: 0.5rem;
	}

	.doc-list-page .empty-state p {
		color: var(--dl-muted);
		max-width: 420px;
		margin: 0 auto 1.5rem;
		font-size: 0.95rem;
		line-height: 1.6;
	}

	.doc-list-page .btn-back {
		background: linear-gradient(135deg, var(--dl-primary) 0%, var(--dl-primary-dark) 100%);
		color: #fff;
		padding: 0.65rem 1.35rem;
		border-radius: 10px;
		font-weight: 600;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		transition: all 0.25s ease;
		box-shadow: 0 2px 10px rgba(37, 99, 235, 0.28);
	}

	.doc-list-page .btn-back:hover {
		color: #fff;
		transform: translateY(-2px);
		box-shadow: 0 6px 18px rgba(37, 99, 235, 0.38);
	}

	.doc-list-page .alert {
		border-radius: 12px;
		border: none;
		box-shadow: 0 2px 8px rgba(15, 23, 42, 0.06);
	}

	@media (max-width: 768px) {
		.doc-list-page .list-header,
		.doc-list-page .card-body {
			padding-left: 1.25rem;
			padding-right: 1.25rem;
		}

		.doc-list-page .list-header h4 {
			font-size: 1.2rem;
		}

		.doc-list-page .modern-table thead th,
		.doc-list-page .modern-table tbody td {
			padding: 0.85rem 0.75rem;
			font-size: 0.85rem;
		}
	}
</style>
@endpush

@section('content')
<div class="container-fluid py-4 doc-list-page">
	<div class="row">
		<div class="col-12">
			<div class="page-card">
				<div class="list-header">
					<div class="list-header-inner">
						<h4>
							<span class="header-icon"><i class="fas fa-id-card"></i></span>
							My ID Cards
							@if($enrollments->count() > 0)
								<span class="count-badge">{{ $enrollments->count() }} {{ $enrollments->count() === 1 ? 'course' : 'courses' }}</span>
							@endif
						</h4>
						<p class="subtitle">Download or print your student ID card for each enrolled course</p>
					</div>
				</div>
				<div class="card-body">
					@if(session('error'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
						</div>
					@endif

					<div class="info-banner">
						<i class="fas fa-info-circle"></i>
						<span>Your registration number is the same for all courses. Select a course below to view or print its ID card.</span>
					</div>

					@if($enrollments->count() > 0)
						<div class="list-table-wrap">
							<div class="table-responsive">
								<table class="table modern-table mb-0">
									<thead>
										<tr>
											<th style="width: 50px;">#</th>
											<th>Course</th>
											<th>Registration No.</th>
											<th>Status</th>
											<th style="width: 150px;">Action</th>
										</tr>
									</thead>
									<tbody>
										@php $i = 1; @endphp
										@foreach($enrollments as $row)
											@php
												$status = strtoupper((string) ($row->status ?? 'PENDING'));
												$statusClass = strtolower(str_replace(' ', '-', $status));
												$canView = !in_array($status, ['PENDING', 'BLOCK'], true);
											@endphp
											<tr>
												<td><span class="row-num">{{ $i++ }}</span></td>
												<td>
													<span class="course-badge">{{ $row->c_short_name ?? $row->c_full_name ?? 'N/A' }}</span>
													@if(!empty($row->c_full_name) && ($row->c_short_name ?? '') !== ($row->c_full_name ?? ''))
														<div class="course-subtitle">{{ $row->c_full_name }}</div>
													@endif
												</td>
												<td><span class="reg-no">{{ $row->sl_reg_no ?? 'N/A' }}</span></td>
												<td><span class="status-badge status-{{ $statusClass }}">{{ $status }}</span></td>
												<td>
													@if($canView)
														<a href="{{ route('student.view_id_card_detail', $row->course_id) }}" class="btn-view" target="_blank">
															<i class="fas fa-eye"></i> View ID Card
														</a>
													@else
														<span class="btn-disabled" title="Available after admin approval">
															<i class="fas fa-lock"></i> Pending
														</span>
													@endif
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					@else
						<div class="empty-state">
							<div class="empty-icon"><i class="fas fa-id-card"></i></div>
							<h5>No ID Card Found</h5>
							<p>Contact your center if you believe this is an error.</p>
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
