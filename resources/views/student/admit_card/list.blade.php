@extends('student.layouts.base')
@section('title', 'Admit Cards')
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
	}

	.doc-list-page .list-header {
		background: linear-gradient(135deg, var(--dl-primary) 0%, var(--dl-primary-dark) 100%);
		padding: 1.75rem 2rem;
		position: relative;
		overflow: hidden;
	}

	.doc-list-page .list-header-inner { position: relative; z-index: 1; }

	.doc-list-page .list-header h4 {
		color: #fff;
		margin: 0;
		font-weight: 700;
		font-size: 1.45rem;
		display: flex;
		align-items: center;
		flex-wrap: wrap;
		gap: 0.75rem;
	}

	.doc-list-page .header-icon {
		width: 48px;
		height: 48px;
		border-radius: 14px;
		background: rgba(255, 255, 255, 0.18);
		display: inline-flex;
		align-items: center;
		justify-content: center;
		font-size: 1.2rem;
	}

	.doc-list-page .count-badge {
		background: rgba(255, 255, 255, 0.22);
		color: #fff;
		padding: 0.3rem 0.75rem;
		border-radius: 999px;
		font-size: 0.78rem;
		font-weight: 600;
	}

	.doc-list-page .subtitle {
		color: rgba(255, 255, 255, 0.92);
		font-size: 0.92rem;
		margin: 0.65rem 0 0 0;
	}

	.doc-list-page .card-body { padding: 1.75rem 2rem 2rem; }

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
	}

	.doc-list-page .list-table-wrap {
		border-radius: 14px;
		overflow: hidden;
		border: 1px solid var(--dl-border);
	}

	.doc-list-page .modern-table thead th {
		background: linear-gradient(135deg, var(--dl-primary) 0%, var(--dl-primary-dark) 100%);
		color: #fff;
		font-weight: 600;
		text-transform: uppercase;
		font-size: 0.68rem;
		padding: 1rem 1.25rem;
		border: none;
	}

	.doc-list-page .modern-table tbody td {
		padding: 1.05rem 1.25rem;
		vertical-align: middle;
		border-bottom: 1px solid #f1f5f9;
	}

	.doc-list-page .course-badge {
		display: inline-block;
		background: linear-gradient(135deg, var(--dl-primary) 0%, var(--dl-primary-dark) 100%);
		color: #fff;
		padding: 0.4rem 0.8rem;
		border-radius: 999px;
		font-size: 0.78rem;
		font-weight: 600;
	}

	.doc-list-page .reg-no {
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

	.doc-list-page .exam-date {
		font-weight: 600;
		color: #334155;
		font-size: 0.88rem;
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
		box-shadow: 0 2px 10px rgba(37, 99, 235, 0.28);
	}

	.doc-list-page .btn-view:hover { color: #fff; transform: translateY(-2px); }

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
		border: 1px solid #e2e8f0;
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
							<span class="header-icon"><i class="fas fa-ticket"></i></span>
							My Admit Cards
							@if($enrollments->count() > 0)
								<span class="count-badge">{{ $enrollments->count() }} {{ $enrollments->count() === 1 ? 'course' : 'courses' }}</span>
							@endif
						</h4>
						<p class="subtitle">View and print your exam admit card for each regular (non-typing) course</p>
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
						<span>Admit cards are issued by your center for regular courses only. Select a course below once your admit card has been generated.</span>
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
											<th>Exam Date</th>
											<th style="width: 170px;">Action</th>
										</tr>
									</thead>
									<tbody>
										@php $i = 1; @endphp
										@foreach($enrollments as $row)
											@php
												$admit = $admitByCourse->get((int) $row->course_id);
											@endphp
											<tr>
												<td>{{ $i++ }}</td>
												<td>
													<span class="course-badge">{{ $row->c_short_name ?? $row->c_full_name ?? 'N/A' }}</span>
												</td>
												<td><span class="reg-no">{{ $row->sl_reg_no ?? 'N/A' }}</span></td>
												<td>
													@if($admit && !empty($admit->exam_date))
														<span class="exam-date">{{ format_dob_display($admit->exam_date) }}</span>
													@else
														<span class="text-muted">—</span>
													@endif
												</td>
												<td>
													@if($admit)
														<a href="{{ route('student.view_admit_card_detail', $row->course_id) }}" class="btn-view" target="_blank">
															<i class="fas fa-eye"></i> View Admit Card
														</a>
													@else
														<span class="btn-disabled" title="Your center has not generated this admit card yet">
															<i class="fas fa-clock"></i> Not generated
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
						<div class="text-center py-5">
							<h5>No Admit Card Courses</h5>
							<p class="text-muted">Typing courses use the Typing Certificate instead of an admit card.</p>
							<a href="{{ route('student_dashboard') }}" class="btn-view mt-2">
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
