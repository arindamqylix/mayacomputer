@extends('center.layouts.base')
@section('title', 'Generate Admit Card')
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
	
	.form-group label .text-danger {
		color: #dc2626;
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
	
	.btn-create {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		border: none;
		padding: 0.75rem 2rem;
		border-radius: 0.5rem;
		font-weight: 600;
		box-shadow: 0 4px 6px rgba(17, 153, 142, 0.3);
		transition: all 0.3s ease;
		width: 100%;
		font-size: 1rem;
		color: white;
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 0.5rem;
	}
	
	.btn-create:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(17, 153, 142, 0.4);
		background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%);
		color: white;
	}
	
	.btn-create:disabled {
		opacity: 0.6;
		cursor: not-allowed;
	}
	
	/* Filter Section */
	.filter-section {
		background: #f8f9fa;
		padding: 1.5rem;
		border-bottom: 1px solid #dee2e6;
	}
	
	.filter-row {
		display: flex;
		gap: 1rem;
		align-items: end;
		flex-wrap: wrap;
	}
	
	.filter-group {
		flex: 1;
		min-width: 200px;
	}
	
	.btn-filter {
		background: #6c757d;
		border: none;
		padding: 0.75rem 1.5rem;
		border-radius: 0.5rem;
		color: white;
		font-weight: 600;
		transition: all 0.3s ease;
	}
	
	.btn-filter:hover {
		background: #5a6268;
	}
	
	/* Student List Section */
	.student-list-section {
		padding: 1.5rem;
	}
	
	.list-header {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 1rem;
		padding-bottom: 1rem;
		border-bottom: 2px solid #e9ecef;
	}
	
	.selection-info {
		display: flex;
		align-items: center;
		gap: 1rem;
	}
	
	.selection-count {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 0.5rem 1rem;
		border-radius: 0.5rem;
		font-weight: 600;
		font-size: 0.875rem;
	}
	
	.bulk-actions {
		display: flex;
		gap: 0.5rem;
	}
	
	.btn-bulk {
		padding: 0.5rem 1rem;
		border: 1px solid #dee2e6;
		background: white;
		border-radius: 0.5rem;
		font-weight: 600;
		font-size: 0.875rem;
		cursor: pointer;
		transition: all 0.3s ease;
	}
	
	.btn-bulk:hover {
		background: #f8f9fa;
		border-color: #2563eb;
		color: #2563eb;
	}
	
	/* Student Table */
	.student-table-container {
		max-height: 500px;
		overflow-y: auto;
		border: 1px solid #dee2e6;
		border-radius: 0.5rem;
	}
	
	.student-table {
		width: 100%;
		margin: 0;
		border-collapse: collapse;
	}
	
	.student-table thead {
		position: sticky;
		top: 0;
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		z-index: 10;
	}
	
	.student-table thead th {
		padding: 1rem;
		color: white;
		font-weight: 600;
		text-align: left;
		font-size: 0.875rem;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		border: none;
	}
	
	.student-table tbody tr {
		border-bottom: 1px solid #e9ecef;
		transition: all 0.2s ease;
	}
	
	.student-table tbody tr:hover {
		background-color: #f8f9ff;
	}
	
	.student-table tbody tr.selected {
		background-color: #e3f2fd;
	}
	
	.student-table tbody td {
		padding: 1rem;
		vertical-align: middle;
	}
	
	.student-checkbox {
		width: 20px;
		height: 20px;
		cursor: pointer;
		accent-color: #2563eb;
	}
	
	.student-info {
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	
	.student-image {
		width: 40px;
		height: 40px;
		border-radius: 50%;
		object-fit: cover;
		border: 2px solid #dee2e6;
	}
	
	.student-details h6 {
		margin: 0;
		font-weight: 600;
		color: #1f2937;
		font-size: 0.95rem;
	}
	
	.student-details p {
		margin: 0;
		font-size: 0.8rem;
		color: #6c757d;
	}
	
	.badge-reg {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 0.25rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.75rem;
		font-family: 'Courier New', monospace;
	}
	
	.badge-course {
		background: #e9ecef;
		color: #495057;
		padding: 0.25rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.75rem;
	}
	
	/* Exam Details Section */
	.exam-details-section {
		background: #f8f9fa;
		padding: 1.5rem;
		border-top: 2px solid #dee2e6;
		margin-top: 1.5rem;
	}
	
	.exam-details-grid {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
		gap: 1rem;
		margin-bottom: 1.5rem;
	}
	
	/* Empty State */
	.empty-state {
		text-align: center;
		padding: 3rem;
		color: #6c757d;
	}
	
	.empty-state i {
		font-size: 3rem;
		margin-bottom: 1rem;
		opacity: 0.5;
	}
	
	/* Info Card */
	.info-card {
		background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
		border: 2px solid #e9ecef;
		border-radius: 12px;
		padding: 1.5rem;
		margin-top: 1.5rem;
	}
	
	.info-card h6 {
		color: #1e3a8a;
		font-weight: 600;
		margin-bottom: 0.75rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.info-card ul {
		margin: 0;
		padding-left: 1.5rem;
		color: #6c757d;
	}
	
	.info-card ul li {
		margin-bottom: 0.5rem;
	}
</style>
@endpush

@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<form method="POST" id="insert_frm">
			@csrf
			
			<!-- Exam Details Card -->
			<div class="card modern-card mb-3">
				<div class="card-header form-header">
					<h4>
						<i class="fas fa-calendar-check"></i>
						Exam Details
					</h4>
				</div>
				<div class="exam-details-section">
					<div class="exam-details-grid">
						<div class="form-group mb-3">
							<label>
								<i class="fas fa-calendar-alt"></i>
								Exam Date <span class="text-danger">*</span>
							</label>
							<input class="form-control" name="exam_date" type="date" required min="{{ date('Y-m-d') }}">
						</div>
						
						<div class="form-group mb-3">
							<label>
								<i class="fas fa-clock"></i>
								Exam Time <span class="text-danger">*</span>
							</label>
							<input class="form-control" name="exam_time" type="time" required>
						</div>
						
						<div class="form-group mb-3">
							<label>
								<i class="fas fa-map-marker-alt"></i>
								Exam Venue <span class="text-danger">*</span>
							</label>
							<input type="text" class="form-control" name="exam_venue" placeholder="Enter exam venue address" required>
						</div>
						
						<div class="form-group mb-3">
							<label>
								<i class="fas fa-info-circle"></i>
								Notice (Optional)
							</label>
							<input type="text" class="form-control" name="exam_notice" placeholder="Special instructions or notices">
						</div>
					</div>
				</div>
			</div>
			
			<!-- Student Selection Card -->
			<div class="card modern-card">
				<div class="card-header form-header">
					<h4>
						<i class="fas fa-users"></i>
						Select Students for Admit Card Generation
					</h4>
				</div>
				
				<!-- Filter Section -->
				<div class="filter-section">
					<div class="filter-row">
						<div class="filter-group">
							<label>
								<i class="fas fa-search"></i>
								Search Student
							</label>
							<input type="text" class="form-control" id="searchStudent" placeholder="Search by name, registration number, course...">
						</div>
						<div class="filter-group">
							<label>
								<i class="fas fa-graduation-cap"></i>
								Filter by Course
							</label>
							<select class="form-select" id="filterCourse">
								<option value="">All Courses</option>
								@foreach($courseList as $course)
									<option value="{{ $course->c_id }}">{{ $course->c_full_name }} ({{ $course->c_short_name }})</option>
								@endforeach
							</select>
						</div>
						<div class="filter-group">
							<button type="button" class="btn-filter" id="clearFilters">
								<i class="fas fa-times"></i> Clear Filters
							</button>
						</div>
					</div>
				</div>
				
				<!-- Student List Section -->
				<div class="student-list-section">
					<div class="list-header">
						<div class="selection-info">
							<span class="selection-count" id="selectedCount">0 Students Selected</span>
						</div>
						<div class="bulk-actions">
							<button type="button" class="btn-bulk" id="selectAll">
								<i class="fas fa-check-square"></i> Select All
							</button>
							<button type="button" class="btn-bulk" id="selectNone">
								<i class="fas fa-square"></i> Select None
							</button>
						</div>
					</div>
					
					@if(count($students) > 0)
						<div class="student-table-container">
							<table class="student-table">
								<thead>
									<tr>
										<th style="width: 50px;">
											<input type="checkbox" class="student-checkbox" id="selectAllCheckbox">
										</th>
										<th>Student Details</th>
										<th>Registration No.</th>
										<th>Course</th>
									</tr>
								</thead>
								<tbody id="studentTableBody">
									@foreach($students as $student)
										<tr data-student-id="{{ $student->sl_id }}" data-course-id="{{ $student->sl_FK_of_course_id }}">
											<td>
												<input type="checkbox" name="student_ids[]" value="{{ $student->sl_id }}" class="student-checkbox student-select">
											</td>
											<td>
												<div class="student-info">
													@if(!empty($student->sl_photo))
														<img src="{{ asset($student->sl_photo) }}" alt="Student Photo" class="student-image" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2740%27 height=%2740%27%3E%3Crect fill=%27%23ddd%27 width=%2740%27 height=%2740%27/%3E%3Ctext fill=%27%23999%27 font-family=%27sans-serif%27 font-size=%2712%27 x=%2750%25%27 y=%2750%25%27 text-anchor=%27middle%27 dy=%27.3em%27%3ENo Photo%3C/text%3E%3C/svg%3E'">
													@else
														<img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40'%3E%3Crect fill='%23ddd' width='40' height='40'/%3E%3Ctext fill='%23999' font-family='sans-serif' font-size='12' x='50%25' y='50%25' text-anchor='middle' dy='.3em'%3ENo Photo%3C/text%3E%3C/svg%3E" alt="No Photo" class="student-image">
													@endif
													<div class="student-details">
														<h6>{{ $student->sl_name ?? 'N/A' }}</h6>
														<p>{{ $student->sl_email ?? 'N/A' }}</p>
													</div>
												</div>
											</td>
											<td>
												<span class="badge-reg">{{ $student->sl_reg_no ?? 'N/A' }}</span>
											</td>
											<td>
												<span class="badge-course">{{ $student->c_short_name ?? $student->c_full_name ?? 'N/A' }}</span>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@else
						<div class="empty-state">
							<i class="fas fa-user-slash"></i>
							<h5>No Verified Students Found</h5>
							<p>Only verified/approved students can be selected for admit card generation.</p>
						</div>
					@endif
				</div>
				
				<!-- Info Card -->
				<div class="info-card">
					<h6>
						<i class="fas fa-lightbulb"></i>
						Important Information
					</h6>
					<ul>
						<li>Only verified/approved students are shown in this list</li>
						<li>You can select multiple students at once for bulk admit card generation</li>
						<li>Use filters to quickly find students by name, registration number, or course</li>
						<li>If an admit card already exists for a student, it will be updated with new exam details</li>
					</ul>
				</div>
				
				<!-- Submit Button -->
				<div class="card-body p-4">
					<button type="submit" class="btn-create" id="insert_btn">
						<i class="fas fa-ticket-alt"></i>
						Generate Admit Cards (<span id="submitCount">0</span>)
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@push('custom-js')
<script>
	$(document).ready(function() {
		// Set minimum date to today
		$('input[name="exam_date"]').attr('min', new Date().toISOString().split('T')[0]);
		
		// Update selected count
		function updateSelectionCount() {
			var count = $('.student-select:checked').length;
			$('#selectedCount').text(count + ' Student' + (count !== 1 ? 's' : '') + ' Selected');
			$('#submitCount').text(count);
			
			// Update row styling
			$('.student-table tbody tr').each(function() {
				if ($(this).find('.student-select').is(':checked')) {
					$(this).addClass('selected');
				} else {
					$(this).removeClass('selected');
				}
			});
			
			// Enable/disable submit button
			if (count > 0) {
				$('#insert_btn').prop('disabled', false);
			} else {
				$('#insert_btn').prop('disabled', true);
			}
		}
		
		// Select all checkbox
		$('#selectAllCheckbox').on('change', function() {
			var isChecked = $(this).is(':checked');
			$('#studentTableBody tr:visible .student-select').prop('checked', isChecked);
			updateSelectionCount();
		});
		
		// Individual checkbox change
		$(document).on('change', '.student-select', function() {
			updateSelectionCount();
			
			// Update select all checkbox state
			var totalVisible = $('#studentTableBody tr:visible .student-select').length;
			var checkedVisible = $('#studentTableBody tr:visible .student-select:checked').length;
			$('#selectAllCheckbox').prop('checked', totalVisible > 0 && totalVisible === checkedVisible);
		});
		
		// Select All button
		$('#selectAll').on('click', function() {
			$('#studentTableBody tr:visible .student-select').prop('checked', true);
			$('#selectAllCheckbox').prop('checked', true);
			updateSelectionCount();
		});
		
		// Select None button
		$('#selectNone').on('click', function() {
			$('#studentTableBody tr:visible .student-select').prop('checked', false);
			$('#selectAllCheckbox').prop('checked', false);
			updateSelectionCount();
		});
		
		// Search functionality
		$('#searchStudent').on('keyup', function() {
			var searchTerm = $(this).val().toLowerCase();
			filterStudents();
		});
		
		// Course filter
		$('#filterCourse').on('change', function() {
			filterStudents();
		});
		
		// Clear filters
		$('#clearFilters').on('click', function() {
			$('#searchStudent').val('');
			$('#filterCourse').val('');
			filterStudents();
		});
		
		// Filter students function
		function filterStudents() {
			var searchTerm = $('#searchStudent').val().toLowerCase();
			var courseId = $('#filterCourse').val();
			
			$('#studentTableBody tr').each(function() {
				var $row = $(this);
				var studentId = $row.data('student-id');
				var rowCourseId = $row.data('course-id');
				var rowText = $row.text().toLowerCase();
				
				var matchesSearch = searchTerm === '' || rowText.indexOf(searchTerm) !== -1;
				var matchesCourse = courseId === '' || rowCourseId == courseId;
				
				if (matchesSearch && matchesCourse) {
					$row.show();
				} else {
					$row.hide();
					$row.find('.student-select').prop('checked', false);
				}
			});
			
			updateSelectionCount();
		}
		
		// Form submission
		$('#insert_frm').on('submit', function(e) {
			var selectedCount = $('.student-select:checked').length;
			
			if (selectedCount === 0) {
				e.preventDefault();
				alert('Please select at least one student to generate admit card.');
				return false;
			}
			
			// Disable unchecked checkboxes to avoid sending them
			$('.student-select:not(:checked)').prop('disabled', true);
			
			$('#insert_btn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Generating Admit Cards...');
		});
		
		// Initial count update
		updateSelectionCount();
	});
</script>
@endpush
