@extends('admin.layouts.base')
@section('title', 'Edit Result')
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
	
	.form-control, .form-select {
		border-radius: 0.5rem;
		border: 1px solid #dee2e6;
		padding: 0.75rem 1rem;
		transition: all 0.3s ease;
		font-size: 1rem;
	}
	
	.form-control:focus, .form-select:focus {
		border-color: #2563eb;
		box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
		outline: none;
	}
	
	.form-control[readonly] {
		background-color: #f8f9fa;
		color: #6c757d;
		cursor: not-allowed;
	}
	
	.btn-save {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 0.75rem 2rem;
		border-radius: 0.5rem;
		font-weight: 600;
		box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
		transition: all 0.3s ease;
		color: white;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.btn-save:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(37, 99, 235, 0.4);
		background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
		color: white;
	}
	
	.btn-view-all {
		background: #6c757d;
		border: none;
		padding: 0.75rem 1.5rem;
		border-radius: 0.5rem;
		font-weight: 600;
		transition: all 0.3s ease;
		color: white;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		margin-right: 1rem;
	}
	
	.btn-view-all:hover {
		background: #5a6268;
		transform: translateY(-2px);
		color: white;
		text-decoration: none;
	}
	
	/* Subject Card */
	.subject-card {
		background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
		border: 2px solid #e9ecef;
		border-radius: 12px;
		padding: 1.5rem;
		margin-bottom: 1.5rem;
		transition: all 0.3s ease;
	}
	
	.subject-card:hover {
		border-color: #2563eb;
		box-shadow: 0 4px 12px rgba(37, 99, 235, 0.1);
	}
	
	.subject-card-header {
		display: flex;
		align-items: center;
		gap: 0.75rem;
		margin-bottom: 1rem;
		padding-bottom: 0.75rem;
		border-bottom: 2px solid #e9ecef;
	}
	
	.subject-card-header i {
		font-size: 1.5rem;
		color: #2563eb;
	}
	
	.subject-card-header h6 {
		margin: 0;
		color: #1e3a8a;
		font-weight: 700;
		font-size: 1.1rem;
	}
	
	/* Summary Card */
	.summary-card {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border-radius: 12px;
		padding: 1.5rem;
		margin-top: 1.5rem;
		color: white;
	}
	
	.summary-card h6 {
		color: white;
		font-weight: 600;
		margin-bottom: 1rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.summary-row {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 0.75rem 0;
		border-bottom: 1px solid rgba(255, 255, 255, 0.2);
	}
	
	.summary-row:last-child {
		border-bottom: none;
	}
	
	.summary-label {
		font-weight: 500;
		opacity: 0.9;
	}
	
	.summary-value {
		font-weight: 700;
		font-size: 1.1rem;
	}
	
	/* Student Info Card */
	.student-info-card {
		background: #f8f9fa;
		border-left: 4px solid #2563eb;
		border-radius: 0.5rem;
		padding: 1.5rem;
		margin-bottom: 2rem;
	}
	
	.student-info-card h5 {
		color: #1e3a8a;
		font-weight: 700;
		margin-bottom: 1rem;
	}
	
	.info-row {
		display: flex;
		justify-content: space-between;
		padding: 0.5rem 0;
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
</style>
@endpush

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<form id='update_frm' method="POST" action="{{ route('admin.update_result', $result_data->sr_id) }}">
				@csrf
				<div class="card modern-card">
					<div class="card-header form-header">
						<div class="d-flex justify-content-between align-items-center">
							<h4>
								<i class="fas fa-edit"></i>
								Edit Result
							</h4>
							<div>
								<a href="{{ route('admin.result_list') }}" class="btn-view-all">
									<i class="fas fa-list"></i>
									View All Results
								</a>
								<button type="submit" class="btn-save" id="update_btn">
									<i class="fas fa-save"></i>
									Update Result
								</button>
							</div>
						</div>
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
						
						<!-- Student Information -->
						<div class="student-info-card">
							<h5><i class="fas fa-user"></i> Student Information</h5>
							<div class="info-row">
								<span class="info-label">Student Name:</span>
								<span class="info-value">{{ $result_data->sl_name ?? 'N/A' }}</span>
							</div>
							<div class="info-row">
								<span class="info-label">Registration No:</span>
								<span class="info-value">{{ $result_data->sl_reg_no ?? 'N/A' }}</span>
							</div>
							<div class="info-row">
								<span class="info-label">Course:</span>
								<span class="info-value">{{ $result_data->c_short_name ?? $result_data->c_full_name ?? 'N/A' }}</span>
							</div>
							<div class="info-row">
								<span class="info-label">Center:</span>
								<span class="info-value">{{ $result_data->cl_center_name ?? 'N/A' }} ({{ $result_data->cl_code ?? 'N/A' }})</span>
							</div>
						</div>
						
						<!-- Written Subject -->
						<div class="subject-card">
							<div class="subject-card-header">
								<i class="fas fa-pen"></i>
								<h6>Written</h6>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group mb-3">
										<label>Subject Name</label>
										<input readonly type="text" value="Written" class="form-control" name="written">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group mb-3">
										<label>Full Marks</label>
										<input readonly type="text" value="100" class="form-control">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group mb-3">
										<label>Pass Marks</label>
										<input readonly type="text" value="40" class="form-control">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group mb-3">
										<label>Marks Obtained <span class="text-danger">*</span></label>
										<input type="number" step="0.01" min="0" max="100" class="form-control marks-input" name="wr_marks_obtained" value="{{ $result_data->sr_wr_marks_obtained ?? 0 }}" required>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Practical Subject -->
						<div class="subject-card">
							<div class="subject-card-header">
								<i class="fas fa-flask"></i>
								<h6>Practical</h6>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group mb-3">
										<label>Subject Name</label>
										<input readonly type="text" value="Practical" class="form-control" name="practical">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group mb-3">
										<label>Full Marks</label>
										<input readonly type="text" value="100" class="form-control">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group mb-3">
										<label>Pass Marks</label>
										<input readonly type="text" value="40" class="form-control">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group mb-3">
										<label>Marks Obtained <span class="text-danger">*</span></label>
										<input type="number" step="0.01" min="0" max="100" class="form-control marks-input" name="pr_marks_obtained" value="{{ $result_data->sr_pr_marks_obtained ?? 0 }}" required>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Project/Assignment Subject -->
						<div class="subject-card">
							<div class="subject-card-header">
								<i class="fas fa-project-diagram"></i>
								<h6>Project/Assignment</h6>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group mb-3">
										<label>Subject Name</label>
										<input readonly type="text" value="Project" class="form-control" name="project">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group mb-3">
										<label>Full Marks</label>
										<input readonly type="text" value="100" class="form-control">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group mb-3">
										<label>Pass Marks</label>
										<input readonly type="text" value="40" class="form-control">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group mb-3">
										<label>Marks Obtained <span class="text-danger">*</span></label>
										<input type="number" step="0.01" min="0" max="100" class="form-control marks-input" name="ap_marks_obtained" value="{{ $result_data->sr_ap_marks_obtained ?? 0 }}" required>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Viva Subject -->
						<div class="subject-card">
							<div class="subject-card-header">
								<i class="fas fa-microphone"></i>
								<h6>Viva</h6>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group mb-3">
										<label>Subject Name</label>
										<input readonly type="text" value="Viva" class="form-control" name="viva">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group mb-3">
										<label>Full Marks</label>
										<input readonly type="text" value="100" class="form-control">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group mb-3">
										<label>Pass Marks</label>
										<input readonly type="text" value="40" class="form-control">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group mb-3">
										<label>Marks Obtained <span class="text-danger">*</span></label>
										<input type="number" step="0.01" min="0" max="100" class="form-control marks-input" name="vv_marks_obtained" value="{{ $result_data->sr_vv_marks_obtained ?? 0 }}" required>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Summary Card -->
						<div class="summary-card">
							<h6><i class="fas fa-calculator"></i> Result Summary</h6>
							<div class="summary-row">
								<span class="summary-label">Total Full Marks:</span>
								<span class="summary-value" id="total_full_marks">400</span>
							</div>
							<div class="summary-row">
								<span class="summary-label">Total Pass Marks:</span>
								<span class="summary-value" id="total_pass_marks">160</span>
							</div>
							<div class="summary-row">
								<span class="summary-label">Total Marks Obtained:</span>
								<span class="summary-value" id="total_marks_obtained">0</span>
							</div>
							<div class="summary-row">
								<span class="summary-label">Percentage:</span>
								<span class="summary-value" id="percentage">0%</span>
							</div>
							<div class="summary-row">
								<span class="summary-label">Grade:</span>
								<span class="summary-value" id="grade">F</span>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@push('custom-js')
<script>
	$(document).ready(function() {
		// Calculate totals on input change
		function calculateTotals() {
			// Get all marks obtained
			var wr_marks = parseFloat($('input[name="wr_marks_obtained"]').val()) || 0;
			var pr_marks = parseFloat($('input[name="pr_marks_obtained"]').val()) || 0;
			var ap_marks = parseFloat($('input[name="ap_marks_obtained"]').val()) || 0;
			var vv_marks = parseFloat($('input[name="vv_marks_obtained"]').val()) || 0;
			
			// Get all full marks (fixed at 100)
			var wr_full = 100;
			var pr_full = 100;
			var ap_full = 100;
			var vv_full = 100;
			
			// Get all pass marks (fixed at 40)
			var wr_pass = 40;
			var pr_pass = 40;
			var ap_pass = 40;
			var vv_pass = 40;
			
			// Calculate totals
			var total_full = wr_full + pr_full + ap_full + vv_full;
			var total_pass = wr_pass + pr_pass + ap_pass + vv_pass;
			var total_obtained = wr_marks + pr_marks + ap_marks + vv_marks;
			
			// Calculate percentage (assuming 400 total possible marks)
			var totalPossibleMarks = 100 * 4;
			var percentage = totalPossibleMarks > 0 ? (total_obtained / totalPossibleMarks) * 100 : 0;
			
			// Calculate grade
			var grade = 'F';
			if (percentage >= 90) grade = 'A+';
			else if (percentage >= 80) grade = 'A';
			else if (percentage >= 70) grade = 'B';
			else if (percentage >= 60) grade = 'C';
			else if (percentage >= 50) grade = 'D';
			
			// Update display
			$('#total_full_marks').text(total_full);
			$('#total_pass_marks').text(total_pass);
			$('#total_marks_obtained').text(total_obtained.toFixed(2));
			$('#percentage').text(percentage.toFixed(2) + '%');
			$('#grade').text(grade);
		}
		
		// Calculate on page load
		calculateTotals();
		
		// Calculate on input change
		$('.marks-input').on('input change', function() {
			calculateTotals();
		});
	});
</script>
@endpush

