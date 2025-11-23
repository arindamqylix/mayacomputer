@extends('admin.layouts.base')
@section('title', 'Student List')
	<style type="text/css">
		.dataTables_wrapper{
                overflow: scroll !important;
            }
	</style>
@section('content')
<div class="row mt-3" >
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header bg-secondary text-white font-weight-bold">
					Student List
					<span class='float-right' style='float:right'>
						<a href="{{ route('add_new_student') }}">  <button class="btn btn-success btn-sm" > Add New Student</button></a>
				</div>
			<div class="card-body">
				<div class="card-body">{{-- 
					<form method="get" action="{{ route('admission.list') }}">
						<div class="row">
							<div class="col-lg-3">
								<label>From Date</label>
								<input required="" type="date" value="{{ $from_date }}" class="form-control" name="from_date">
							</div>
							<div class="col-lg-3">
								<label>To Date</label>
								<input required="" type="date" value="{{ $to_date }}" class="form-control" name="to_date">
							</div>
							<div class="col-lg-3">
								<label></label>
								<button style="margin-top: 26px; "class="btn btn-primary">Filter&nbsp;<i class="fa-solid fa-filter"></i></button>
								<a href="{{ route('admission.list') }}" style="margin-top: 26px; "class="btn btn-danger">Reset&nbsp;<i class="fa-solid fa-ban"></i></a>
							</div>
						</div>	
					</form> --}}
				    <table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100" style="overflow: scroll;">
				        <thead>
					        <tr class="table_main_row">
					        	<th>Center Code</th>
					        	<th>Reg.No</th>
					            <th>Student Name</th>
					            <th>Image</th>
					            <th>Date of Birth</th>
					            <th>Course</th>
					            <th>Status</th>
					  
					            <th>Action</th>
					            <th>Operation</th>
					        </tr>
				        </thead>
				        <tbody>
				        	@php $i=1; @endphp
				        	@foreach($student as $data) 
				        		<tr>
				        			<td>{{ $data->cl_code }}</td>
				        			<td>{{ $data->sl_reg_no }}</td>
				        			<td><a href="{{ route('student_application_view', $data->sl_id) }}" target="__blank">{{ $data->sl_name }}</a></td>
				        			<td>
				        				<img style="width: 35px;height: 37px;" src="{{ asset($data->sl_photo) }}">
				        			</td>
				        			<td>{{ date($data->sl_dob,strtotime(date('Y-m-d'))) }}</td>
				        			<td>{{ $data->c_short_name }}</td>
				        			<td>{{ $data->sl_status }}</td>
				        			<td>
				        				<form method="get">
				        					@csrf
				        					<select name="student_status" onchange="studentStatus(this.value,{{ $data->sl_id }});">
				        						<option>--Select--</option>
				        						<option value="PENDING">PENDING</option>
				        						<option value="VERIFIED">VERIFIED</option>
				        						<option value="RESULT UPDATED">RESULT UPDATED</option>
				        						<option value="RESULT OUT">RESULT OUT</option>
				        						<option value="DISPATCHED">DISPATCHED</option>
				        						<option value="BLOCK">BLOCK</option>
				        					</select>
				        				</form>
				        			</td>
				        			<td>
				        				<!-- <a href="#" title="Print Certificate" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>

				        				<a href="#" title="Print Marksheet" class="btn btn-success btn-sm"><i class="fa fa-print"></i></a>

				        				<a href="#" title="Send Certificate" class="btn btn-warning btn-sm"><i class="fa fa-share-square"></i></a> -->

				        				<a href="{{ route('edit_student', $data->sl_id) }}" 
										title="Edit Student" 
										class="btn btn-sm btn-primary">
											<i class="fa fa-pencil-alt"></i>
										</a>
				        				<a onclick="return confirm('Are You Sure to delete?');" href="{{ route('delete_student', $data->sl_id) }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a> 
				        			</td>
				        		</tr>
				        	@endforeach
				        </tbody>
				    </table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
<script type="text/javascript">
	function studentStatus(status,student_id){
		$.ajax({
			url : "{{ route('student_status_updated') }}",
			method: "get",
			data:{status:status,student_id:student_id},
			dataType: "json",
			success: function(response){
				if(response.status == 1){
					alert(response.msg);
					location.reload();
				}else{
					alert(response.msg);
				}
			}
		});
	}
</script>