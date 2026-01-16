@extends('center.layouts.base')
@section('title', 'Set Attendance / Assign Batch')
@push('custom-css')
<style type="text/css">
	.dataTables_wrapper{
		overflow: scroll !important;
	}
	
	/* Modern Card Header */
	.student-list-header {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.student-list-header h4 {
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
	
	/* Action Bar */
	.action-bar {
		background: #f8f9fa;
		padding: 1rem 1.5rem;
		border-bottom: 1px solid #e9ecef;
		display: flex;
		justify-content: space-between;
		align-items: center;
		flex-wrap: wrap;
		gap: 1rem;
	}
	
	.attendance-controls {
		display: flex;
		align-items: center;
		gap: 0.75rem;
		flex-wrap: wrap;
	}
	
	.btn-attendance {
		background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
		border: none;
		padding: 0.5rem 1rem;
		border-radius: 0.5rem;
		font-weight: 600;
		color: white;
		transition: all 0.3s ease;
	}
	
	.btn-attendance:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(235, 51, 73, 0.4);
	}
	
	.modern-table thead th {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
	
	.modern-table tbody tr:hover {
		background-color: #f8f9ff;
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
	}
    
    .status-badge.verified {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		padding: 0.25rem 0.5rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.75rem;
	}
    
    .student-image {
		width: 40px;
		height: 40px;
		object-fit: cover;
		border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
	}
</style>
@endpush

@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<div class="card modern-card">
			<div class="card-header student-list-header">
				<h4>
					<i class="fas fa-tasks"></i>
					Set Attendance / Assign Batch
				</h4>
			</div>
			
			<!-- Action Bar -->
			<div class="action-bar">
				<div class="attendance-controls w-100 d-flex justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <select id='batch_id' class="form-select" style="min-width: 200px;">
                            <option value="">--Select Batch--</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->ab_id }}">{{ $batch->ab_name }}</option>
                            @endforeach
                        </select>
                        
                        <select id="single_student_id" class="form-select" style="min-width: 250px; display:none;" >
                            <option value="">--Select Student (One by One)--</option>
                            @foreach($students as $data)
                                <option value="{{ $data->sl_id }}">{{ $data->sl_name }} ({{ $data->sl_reg_no }})</option>
                            @endforeach
                        </select>

                        <button onclick="add_attendance();" class="btn-attendance">
                            <i class="fas fa-plus me-1"></i>Add to Batch
                        </button>
                        
                        <button onclick="toggleSelectionMode()" class="btn btn-sm btn-outline-primary ms-2" type="button" title="Toggle Single Select Mode">
                            <i class="fas fa-user-check"></i> One-by-One
                        </button>
                    </div>
				</div>
			</div>
			
			<div class="card-body p-0">
				@if(count($students) > 0)
					<div class="table-responsive">
						<table id="datatable-buttons" class="table modern-table table-hover mb-0">
							<thead>
								<tr>
                                    <th width="40" class="text-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAllTable" onclick="toggleAllTable(this)">
                                        </div>
                                    </th>
									<th>#ID</th>
									<th>Reg.No</th>
									<th>Student Name</th>
									<th>Course</th>
									<th>Status</th>
                                    <th>Image</th>
								</tr>
							</thead>
							<tbody>
								@foreach($students as $data)
									<tr>
                                        <td class="text-center">
                                            <div class="form-check">
                                                <input class="form-check-input student-checkbox" type="checkbox" value="{{ $data->sl_id }}">
                                            </div>
                                        </td>
										<td>#{{ $data->sl_id }}</td>
										<td>{{ $data->sl_reg_no ?? 'N/A' }}</td>
										<td>{{ $data->sl_name ?? 'N/A' }}</td>
										<td>{{ $data->c_short_name ?? 'N/A' }}</td>
										<td><span class="status-badge verified">{{ $data->sl_status }}</span></td>
                                        <td>
                                            @if(!empty($data->sl_photo))
                                                <img class="student-image" src="{{ asset($data->sl_photo) }}" alt="Student Photo">
                                            @else
                                                <span class="text-muted small">No Img</span>
                                            @endif
                                        </td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@else
					<div class="text-center p-5">
						<i class="fas fa-check-double" style="font-size: 3rem; color: #6c757d; opacity: 0.5;"></i>
						<h5 class="mt-3">All Verified Students Assigned</h5>
						<p class="text-muted">There are no verified students waiting to be assigned to a batch.</p>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection

@push('custom-js')
<script type="text/javascript">
	var isSingleMode = false;

    function toggleSelectionMode() {
        isSingleMode = !isSingleMode;
        if (isSingleMode) {
            $('#single_student_id').show();
            $('#checkAllTable').prop('disabled', true);
            $('.student-checkbox').prop('disabled', true);
            $('#checkAllTable').prop('checked', false);
            $('.student-checkbox').prop('checked', false);
        } else {
            $('#single_student_id').hide();
            $('#single_student_id').val(''); 
            $('#checkAllTable').prop('disabled', false);
            $('.student-checkbox').prop('disabled', false);
        }
    }

    function toggleAllTable(source) {
        $('.student-checkbox').prop('checked', source.checked);
    }

	function add_attendance(){
		var batch_id = $('#batch_id').val();
        var student_id = [];

		if (!batch_id) {
			alert('Please select a batch');
			return;
		}
        
        if (isSingleMode) {
            var singleVal = $('#single_student_id').val();
            if(singleVal) {
                student_id.push(singleVal);
            }
        } else {
            $('.student-checkbox:checked').each(function() {
                student_id.push($(this).val());
            });
        }
		
		if (!student_id || student_id.length === 0) {
			alert('Please select at least one student');
			return;
		}

		$.ajax({
			url: "{{ route('attendance_set') }}",
			type: "get",
			data:{student_id:student_id,batch_id:batch_id},
			dataType: "json",
			success: function(response){
				if (response.status == 1) {
					alert(response.msg || 'Students added to batch successfully');
                    setTimeout(function() {
						location.reload(); 
					}, 500);
				} else {
					alert(response.msg || 'Failed to add students');
				}
			},
			error: function() {
				alert('An error occurred. Please try again.');
			}
		});
	}
</script>
@endpush
