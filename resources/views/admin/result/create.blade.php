@extends('admin.layouts.base')
@section('title', 'Set Result')
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
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		border: none;
		padding: 0.75rem 2rem;
		border-radius: 0.5rem;
		font-weight: 600;
		box-shadow: 0 4px 6px rgba(17, 153, 142, 0.3);
		transition: all 0.3s ease;
		color: white;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		width: 100%;
		justify-content: center;
	}
	
	.btn-save:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(17, 153, 142, 0.4);
		background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%);
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
	}
	
	.btn-view-all:hover {
		background: #5a6268;
		color: white;
		transform: translateY(-2px);
	}
	
	.subject-card {
		background: #f8f9fa;
		border-radius: 0.5rem;
		padding: 1.5rem;
		margin-bottom: 1.5rem;
		border: 1px solid #e9ecef;
	}
	
	.subject-card-header {
		display: flex;
		align-items: center;
		gap: 0.75rem;
		margin-bottom: 1rem;
		padding-bottom: 0.75rem;
		border-bottom: 2px solid #dee2e6;
	}
	
	.subject-card-header i {
		font-size: 1.25rem;
		color: #2563eb;
	}
	
	.subject-card-header h6 {
		margin: 0;
		font-weight: 700;
		font-size: 1.1rem;
	}
	
	.summary-card {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		border-radius: 0.5rem;
		padding: 1.5rem;
		margin-top: 2rem;
		color: white;
	}
	
	.summary-card h6 {
		margin-bottom: 1rem;
		font-weight: 700;
		font-size: 1.1rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.summary-row {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 0.5rem 0;
		border-bottom: 1px solid rgba(255, 255, 255, 0.2);
	}
	
	.summary-row:last-child {
		border-bottom: none;
	}
	
	.summary-label {
		font-weight: 600;
	}
	
	.summary-value {
		font-weight: 700;
		font-size: 1.1rem;
	}
</style>
@endpush

@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<form id='update_frm' method="POST" action="{{ route('admin.set_result') }}">
			@csrf
			<div class="card modern-card">
				<div class="card-header form-header">
					<div class="d-flex justify-content-between align-items-center">
						<h4>
							<i class="fas fa-graduation-cap"></i>
							Set Result
						</h4>
						<div>
							<a href="{{ route('admin.result_list') }}" class="btn-view-all">
								<i class="fas fa-list"></i>
								View All
							</a>
							<button type="submit" class="btn-save" id="update_btn" style="width: auto;">
								<i class="fas fa-save"></i>
								SAVE
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
					
					<!-- Student Selection -->
					<div class="row mb-4">
						<div class="col-md-6">
							<div class="form-group">
								<label>
									<i class="fas fa-id-card"></i>
									Student Reg.No <span class="text-danger">*</span>
								</label>
								<select name="student_id" class="form-select" required>
									<option value="">--Select Reg.No--</option>
									@foreach($student as $data)
										<option value="{{ $data->sl_id }}">
											{{ $data->sl_reg_no }} [{{ $data->sl_name }} - {{ $data->c_short_name }}] ({{ $data->cl_center_name }} - {{ $data->cl_code }})
										</option>
									@endforeach
								</select>
							</div>
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
									<input type="number" class="form-control" name="wr_full_marks" placeholder="Full Marks" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group mb-3">
									<label>Pass Marks</label>
									<input type="number" class="form-control" name="wr_pass_marks" placeholder="Pass Marks" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group mb-3">
									<label>Marks Obtained</label>
									<input type="number" class="form-control" name="wr_marks_obtained" placeholder="Marks Obtained" required>
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
									<input type="number" class="form-control" name="pr_full_marks" placeholder="Full Marks" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group mb-3">
									<label>Pass Marks</label>
									<input type="number" class="form-control" name="pr_pass_marks" placeholder="Pass Marks" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group mb-3">
									<label>Marks Obtained</label>
									<input type="number" class="form-control" name="pr_marks_obtained" placeholder="Marks Obtained" required>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Assignment/Project Subject -->
					<div class="subject-card">
						<div class="subject-card-header">
							<i class="fas fa-file-alt"></i>
							<h6>Assignment/Project</h6>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group mb-3">
									<label>Subject Name</label>
									<input readonly type="text" value="Assignment/Project" class="form-control" name="project">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group mb-3">
									<label>Full Marks</label>
									<input type="number" class="form-control" name="ap_full_marks" placeholder="Full Marks" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group mb-3">
									<label>Pass Marks</label>
									<input type="number" class="form-control" name="ap_pass_marks" placeholder="Pass Marks" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group mb-3">
									<label>Marks Obtained</label>
									<input type="number" class="form-control" name="ap_marks_obtained" placeholder="Marks Obtained" required>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Viva Voce Subject -->
					<div class="subject-card">
						<div class="subject-card-header">
							<i class="fas fa-microphone"></i>
							<h6>Viva Voce</h6>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group mb-3">
									<label>Subject Name</label>
									<input readonly type="text" value="Viva Voce" class="form-control" name="viva">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group mb-3">
									<label>Full Marks</label>
									<input type="number" class="form-control" name="vv_full_marks" placeholder="Full Marks" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group mb-3">
									<label>Pass Marks</label>
									<input type="number" class="form-control" name="vv_pass_marks" placeholder="Pass Marks" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group mb-3">
									<label>Marks Obtained</label>
									<input type="number" class="form-control" name="vv_marks_obtained" placeholder="Marks Obtained" required>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Summary Card -->
					<div class="summary-card">
						<h6>
							<i class="fas fa-calculator"></i>
							Result Summary (Auto-calculated)
						</h6>
						<div class="summary-row">
							<span class="summary-label">Total Full Marks:</span>
							<span class="summary-value" id="total_full_marks">0</span>
						</div>
						<div class="summary-row">
							<span class="summary-label">Total Pass Marks:</span>
							<span class="summary-value" id="total_pass_marks">0</span>
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
							<span class="summary-value" id="grade">-</span>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@push('custom-script')
<script>
	$(document).ready(function() {
		function calculateSummary() {
			const wr_full = parseFloat($('input[name="wr_full_marks"]').val()) || 0;
			const pr_full = parseFloat($('input[name="pr_full_marks"]').val()) || 0;
			const ap_full = parseFloat($('input[name="ap_full_marks"]').val()) || 0;
			const vv_full = parseFloat($('input[name="vv_full_marks"]').val()) || 0;
			
			const wr_pass = parseFloat($('input[name="wr_pass_marks"]').val()) || 0;
			const pr_pass = parseFloat($('input[name="pr_pass_marks"]').val()) || 0;
			const ap_pass = parseFloat($('input[name="ap_pass_marks"]').val()) || 0;
			const vv_pass = parseFloat($('input[name="vv_pass_marks"]').val()) || 0;
			
			const wr_obtained = parseFloat($('input[name="wr_marks_obtained"]').val()) || 0;
			const pr_obtained = parseFloat($('input[name="pr_marks_obtained"]').val()) || 0;
			const ap_obtained = parseFloat($('input[name="ap_marks_obtained"]').val()) || 0;
			const vv_obtained = parseFloat($('input[name="vv_marks_obtained"]').val()) || 0;
			
			const total_full = wr_full + pr_full + ap_full + vv_full;
			const total_pass = wr_pass + pr_pass + ap_pass + vv_pass;
			const total_obtained = wr_obtained + pr_obtained + ap_obtained + vv_obtained;
			
			// Total possible marks (4 subjects × 100 each)
			const totalPossibleMarks = 100 * 4;
			const percentage = totalPossibleMarks > 0 ? ((total_obtained / totalPossibleMarks) * 100).toFixed(2) : 0;
			
			// Calculate grade
			let grade = 'F';
			if (percentage >= 90) grade = 'A+';
			else if (percentage >= 80) grade = 'A';
			else if (percentage >= 70) grade = 'B';
			else if (percentage >= 60) grade = 'C';
			else if (percentage >= 50) grade = 'D';
			
			$('#total_full_marks').text(total_full);
			$('#total_pass_marks').text(total_pass);
			$('#total_marks_obtained').text(total_obtained);
			$('#percentage').text(percentage + '%');
			$('#grade').text(grade);
		}
		
		// Calculate on input change
		$('input[type="number"]').on('input', calculateSummary);
		
		// Initial calculation
		calculateSummary();
	});
</script>
@endpush

