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
				        				@if(!empty($data->sl_photo))
				        					<img style="width: 35px;height: 37px; object-fit: cover; border-radius: 3px;" src="{{ asset($data->sl_photo) }}" alt="{{ $data->sl_name }}" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2735%27 height=%2737%27%3E%3Crect fill=%27%23ddd%27 width=%2735%27 height=%2737%27/%3E%3Ctext fill=%27%23999%27 font-family=%27sans-serif%27 font-size=%279%27 x=%2750%25%27 y=%2750%25%27 text-anchor=%27middle%27 dy=%27.3em%27%3ENo Photo%3C/text%3E%3C/svg%3E'">
				        				@else
				        					<img style="width: 35px;height: 37px; object-fit: cover; border-radius: 3px;" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='35' height='37'%3E%3Crect fill='%23ddd' width='35' height='37'/%3E%3Ctext fill='%23999' font-family='sans-serif' font-size='9' x='50%25' y='50%25' text-anchor='middle' dy='.3em'%3ENo Photo%3C/text%3E%3C/svg%3E" alt="No Photo">
				        				@endif
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