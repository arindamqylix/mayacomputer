@extends('student.layouts.base')
@section('title', 'Results')
@push('custom-css')
<style type="text/css">
	.result-page .page-card {
		background: #fff;
		border-radius: 16px;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
		overflow: hidden;
	}
	.result-page .list-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		padding: 1.5rem 1.75rem;
		color: white;
	}
	.result-page .list-header h4 {
		margin: 0;
		font-weight: 700;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	.result-page .info-banner {
		background: #eff6ff;
		border-left: 4px solid #2563eb;
		padding: 0.875rem 1rem;
		margin-bottom: 1.5rem;
		color: #1e40af;
		font-size: 0.9rem;
	}
	.result-page .modern-table thead th {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		font-size: 0.7rem;
		text-transform: uppercase;
		padding: 1rem;
		border: none;
	}
	.result-page .modern-table tbody td {
		padding: 1rem;
		vertical-align: middle;
	}
	.result-page .course-badge {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 0.35rem 0.75rem;
		border-radius: 8px;
		font-size: 0.8rem;
		font-weight: 600;
	}
	.result-page .grade-badge {
		background: #dbeafe;
		color: #1e40af;
		padding: 0.35rem 0.65rem;
		border-radius: 6px;
		font-weight: 700;
	}
	.result-page .btn-view {
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
	.result-page .btn-view:hover { color: white; opacity: 0.95; }
</style>
@endpush

@section('content')
<div class="container-fluid py-4 result-page">
	<div class="row">
		<div class="col-12">
			<div class="page-card">
				<div class="list-header">
					<h4>
						<i class="fas fa-file-lines"></i>
						My Results
						@if($results->count() > 0)
							<span class="badge bg-light text-primary ms-2">{{ $results->count() }}</span>
						@endif
					</h4>
					<p class="mb-0 mt-2 opacity-90">Published marks for your regular courses</p>
				</div>
				<div class="card-body p-4">
					@if(session('error'))
						<div class="alert alert-danger">{{ session('error') }}</div>
					@endif

					<div class="info-banner">
						<i class="fas fa-info-circle me-2"></i>
						Typing courses do not have published results here — use <strong>Typing Certificate</strong> for those.
					</div>

					@if($results->count() > 0)
						<div class="table-responsive">
							<table class="table modern-table mb-0">
								<thead>
									<tr>
										<th>#</th>
										<th>Course</th>
										<th>Total Marks</th>
										<th>Percentage</th>
										<th>Grade</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $i = 1; @endphp
									@foreach($results as $row)
										<tr>
											<td>{{ $i++ }}</td>
											<td><span class="course-badge">{{ $row->c_short_name ?? $row->c_full_name ?? 'N/A' }}</span></td>
											<td>{{ $row->sr_total_marks_obtained ?? '—' }} / {{ $row->sr_total_full_marks ?? '400' }}</td>
											<td>{{ number_format((float) ($row->sr_percentage ?? 0), 2) }}%</td>
											<td><span class="grade-badge">{{ $row->sr_grade ?? '—' }}</span></td>
											<td>
												<a href="{{ route('student.view_marksheet_detail', $row->sr_id) }}" class="btn-view" target="_blank">
													<i class="fas fa-eye"></i> View Marksheet
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@else
						<div class="text-center py-5">
							<i class="fas fa-file-lines fa-3x text-muted mb-3"></i>
							<h5>No Result Published Yet</h5>
							<p class="text-muted mb-0">Your center will publish results here after marks are entered for your course.</p>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
