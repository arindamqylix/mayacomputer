@extends('center.layouts.base')
@section('title', 'Manage Student Courses')
@push('custom-css')
<style type="text/css">
	.page-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	.page-header h4 {
		color: #fff;
		margin: 0;
		font-weight: 600;
	}
	.modern-card {
		border: none;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		border-radius: 0.5rem;
		overflow: hidden;
	}
	.student-summary {
		background: #f8f9ff;
		border-bottom: 1px solid #e9ecef;
		padding: 1.25rem 1.5rem;
	}
	.student-photo {
		width: 72px;
		height: 72px;
		border-radius: 50%;
		object-fit: cover;
		border: 3px solid #fff;
		box-shadow: 0 2px 8px rgba(0,0,0,0.1);
	}
	.summary-label {
		font-size: 0.75rem;
		text-transform: uppercase;
		color: #6c757d;
		font-weight: 600;
		letter-spacing: 0.5px;
	}
	.summary-value {
		font-weight: 600;
		color: #2d3748;
	}
	.modern-table thead th {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: #fff;
		font-weight: 600;
		text-transform: uppercase;
		font-size: 0.75rem;
		padding: 1rem;
		border: none;
	}
	.modern-table tbody td {
		padding: 1rem;
		vertical-align: middle;
		border-bottom: 1px solid #f0f0f0;
	}
	.course-badge {
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
		color: #fff;
		padding: 0.35rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.8rem;
	}
	.status-badge {
		padding: 0.35rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.75rem;
		text-transform: uppercase;
	}
	.add-course-box {
		background: #f8f9fa;
		border: 1px solid #e9ecef;
		border-radius: 0.5rem;
		padding: 1.25rem;
		margin-top: 1.5rem;
	}
	.btn-back {
		background: #6c757d;
		color: #fff;
		border: none;
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		font-weight: 600;
		text-decoration: none;
	}
	.btn-back:hover { color: #fff; opacity: 0.9; }
	.btn-add-course {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: #fff;
		border: none;
		font-weight: 600;
	}
	.btn-remove {
		background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
		color: #fff;
		border: none;
		font-size: 0.8rem;
		padding: 0.35rem 0.75rem;
		border-radius: 0.375rem;
		text-decoration: none;
	}
	.btn-remove:hover { color: #fff; opacity: 0.9; }
	.enrollment-count {
		background: #2563eb;
		color: #fff;
		padding: 0.25rem 0.6rem;
		border-radius: 999px;
		font-size: 0.75rem;
		font-weight: 600;
	}
</style>
@endpush

@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		@if(session('success'))
			<div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			</div>
		@endif
		@if(session('error'))
			<div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			</div>
		@endif

		<div class="card modern-card">
			<div class="card-header page-header">
				<div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
					<h4><i class="fas fa-book-open me-2"></i>Manage Courses</h4>
					<div class="d-flex gap-2">
						<a href="{{ route('edit.student', $student->sl_id) }}" class="btn btn-light btn-sm">
							<i class="fas fa-user-edit me-1"></i> Edit Profile
						</a>
						<a href="{{ route('all_student') }}" class="btn-back btn-sm">
							<i class="fas fa-arrow-left me-1"></i> Back to List
						</a>
					</div>
				</div>
			</div>

			<div class="student-summary">
				<div class="row align-items-center g-3">
					<div class="col-auto">
						@if(!empty($student->sl_photo))
							<img src="{{ asset($student->sl_photo) }}" alt="{{ $student->sl_name }}" class="student-photo"
								onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2772%27 height=%2772%27%3E%3Crect fill=%27%23ddd%27 width=%2772%27 height=%2772%27/%3E%3C/svg%3E'">
						@else
							<div class="student-photo d-flex align-items-center justify-content-center bg-secondary text-white">
								<i class="fas fa-user fa-2x"></i>
							</div>
						@endif
					</div>
					<div class="col-md-3">
						<div class="summary-label">Student Name</div>
						<div class="summary-value">{{ $student->sl_name }}</div>
					</div>
					<div class="col-md-2">
						<div class="summary-label">Registration No.</div>
						<div class="summary-value text-primary">{{ $student->sl_reg_no }}</div>
					</div>
					<div class="col-md-3">
						<div class="summary-label">Center</div>
						<div class="summary-value">
							{{ $center->cl_center_name ?? $center->cl_name ?? '—' }}
							<small class="text-muted">({{ $center->cl_code ?? '' }})</small>
						</div>
					</div>
					<div class="col-md-2">
						<div class="summary-label">Enrolled Courses</div>
						<div class="summary-value">
							<span class="enrollment-count">{{ $enrollments->count() }}</span>
						</div>
					</div>
				</div>
			</div>

			<div class="card-body">
				<h5 class="mb-3"><i class="fas fa-list me-2 text-primary"></i>Current Enrollments</h5>
				<div class="table-responsive">
					<table class="table modern-table table-hover mb-0">
						<thead>
							<tr>
								<th>#</th>
								<th>Course</th>
								<th>Duration</th>
								<th>Fee</th>
								<th>Enrolled On</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@forelse($enrollments as $index => $enrollment)
								<tr>
									<td>{{ $index + 1 }}</td>
									<td>
										<span class="course-badge">{{ $enrollment->c_short_name }}</span>
										<div class="small text-muted mt-1">{{ $enrollment->c_full_name }}</div>
									</td>
									<td>{{ $enrollment->c_duration ?? '—' }}</td>
									<td>₹{{ number_format((float) ($enrollment->c_price ?? 0), 0) }}</td>
									<td>
										@if(!empty($enrollment->enrolled_at))
											{{ \Carbon\Carbon::parse($enrollment->enrolled_at)->format('d-M-Y') }}
										@else
											—
										@endif
									</td>
									<td>
										<select class="form-select form-select-sm enrollment-status-select"
											data-course-id="{{ $enrollment->course_id }}"
											data-current-status="{{ $enrollment->status }}"
											style="min-width: 140px;">
											@foreach(['PENDING','VERIFIED','RESULT UPDATED','RESULT OUT','DISPATCHED','BLOCK'] as $st)
												<option value="{{ $st }}" {{ $enrollment->status == $st ? 'selected' : '' }}>{{ $st }}</option>
											@endforeach
										</select>
									</td>
									<td>
										@if($enrollments->count() > 1)
											<a href="{{ route('center.student.courses.remove', ['id' => $student->sl_id, 'courseId' => $enrollment->course_id]) }}"
												class="btn-remove"
												onclick="return confirm('Remove this course enrollment? Related results, certificates and admit cards for this course will be deleted.');">
												<i class="fas fa-trash-alt me-1"></i> Remove
											</a>
										@else
											<span class="text-muted small">Last course</span>
										@endif
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="7" class="text-center text-muted py-4">No courses enrolled yet.</td>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>

				<div class="add-course-box">
					<h5 class="mb-3"><i class="fas fa-plus-circle me-2 text-success"></i>Add Another Course</h5>
					@if($availableCourses->isEmpty())
						<p class="text-muted mb-0">This student is already enrolled in all available courses.</p>
					@else
						<form action="{{ route('center.student.courses.add', $student->sl_id) }}" method="POST" class="row g-3 align-items-end">
							@csrf
							<div class="col-md-8">
								<label class="form-label fw-semibold">Select Course</label>
								<select name="course_id" class="form-select" required>
									<option value="">-- Choose a course --</option>
									@foreach($availableCourses as $course)
										<option value="{{ $course->c_id }}">
											{{ $course->c_short_name }} — {{ $course->c_full_name }} (₹{{ number_format((float) $course->c_price, 0) }})
										</option>
									@endforeach
								</select>
								<small class="text-muted">Course fee will be deducted from the center wallet.</small>
							</div>
							<div class="col-md-4">
								<button type="submit" class="btn btn-add-course w-100">
									<i class="fas fa-plus me-1"></i> Enroll in Course
								</button>
							</div>
						</form>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('custom-script')
<script>
$(document).ready(function() {
	$('.enrollment-status-select').on('change', function() {
		var $select = $(this);
		var courseId = $select.data('course-id');
		var newStatus = $select.val();
		var currentStatus = $select.data('current-status');

		if (!confirm('Change course status to ' + newStatus + '?')) {
			$select.val(currentStatus);
			return;
		}

		$.ajax({
			url: '{{ route('center.student.courses.status', $student->sl_id) }}',
			type: 'POST',
			data: {
				_token: '{{ csrf_token() }}',
				course_id: courseId,
				status: newStatus
			},
			success: function(res) {
				if (res.status === 1) {
					$select.data('current-status', newStatus);
					alert(res.msg);
				} else {
					$select.val(currentStatus);
					alert(res.msg || 'Update failed.');
				}
			},
			error: function() {
				$select.val(currentStatus);
				alert('Something went wrong. Please try again.');
			}
		});
	});
});
</script>
@endpush
