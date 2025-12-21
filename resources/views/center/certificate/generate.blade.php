@extends('center.layouts.base')
@section('title', 'Generate Certificate')
@push('custom-css')
<style type="text/css">
	.generate-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.generate-header h4 {
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
	
	.modern-table thead th {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		font-weight: 600;
		text-transform: uppercase;
		font-size: 0.75rem;
		letter-spacing: 0.5px;
		padding: 1rem;
		border: none;
	}
	
	.modern-table tbody td {
		padding: 1rem;
		vertical-align: middle;
		border-bottom: 1px solid #f0f0f0;
	}
	
	.btn-generate {
		background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
		color: white;
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.875rem;
		border: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.btn-generate:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(245, 158, 11, 0.4);
		color: white;
	}
	
	.badge-cert-exists {
		background-color: #d1fae5;
		color: #065f46;
		padding: 0.25rem 0.75rem;
		border-radius: 0.25rem;
		font-size: 0.75rem;
		font-weight: 600;
	}
</style>
@endpush

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="modern-card">
				<div class="generate-header">
					<h4>
						<i class="fas fa-certificate"></i>
						Generate Certificate
					</h4>
				</div>
				<div class="card-body">
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
					
					@if($students->count() > 0)
						<div class="table-responsive">
							<table class="table modern-table">
								<thead>
									<tr>
										<th>#</th>
										<th>Student Name</th>
										<th>Registration No.</th>
										<th>Course</th>
										<th>Percentage</th>
										<th>Grade</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $i=1; @endphp
									@foreach($students as $student)
										<tr>
											<td>{{ $i++ }}</td>
											<td>{{ $student->sl_name ?? 'N/A' }}</td>
											<td>{{ $student->sl_reg_no ?? 'N/A' }}</td>
											<td>{{ $student->c_short_name ?? $student->c_full_name ?? 'N/A' }}</td>
											<td>{{ number_format($student->sr_percentage ?? 0, 2) }}%</td>
											<td>
												<strong>{{ $student->sr_grade ?? 'N/A' }}</strong>
											</td>
											<td>
												@if($student->certificate_id)
													<span class="badge-cert-exists">
														<i class="fas fa-check-circle"></i> Certificate Generated
													</span>
												@else
													<span class="text-muted">Not Generated</span>
												@endif
											</td>
											<td>
												@if(!$student->certificate_id)
													<form action="{{ route('center.certificate_generate_now') }}" method="POST" style="display: inline;">
														@csrf
														<input type="hidden" name="student_id" value="{{ $student->sl_id }}">
														<input type="hidden" name="result_id" value="{{ $student->result_id }}">
														<button type="submit" class="btn-generate" onclick="return confirm('Are you sure you want to generate certificate for {{ $student->sl_name }}?')">
															<i class="fas fa-certificate"></i>
															Generate
														</button>
													</form>
												@else
													<a href="{{ route('center.certificate_list') }}" class="btn-generate" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
														<i class="fas fa-eye"></i>
														View List
													</a>
												@endif
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@else
						<div class="text-center py-5">
							<i class="fas fa-graduation-cap fa-3x text-muted mb-3"></i>
							<h5>No Students Found</h5>
							<p>No students with published results available for certificate generation.</p>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

