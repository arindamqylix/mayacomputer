@extends('center.layouts.base')
@section('title', 'Block Student List')
@push('custom-css')
	<style type="text/css">
		
	</style>
@endpush
@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header bg-secondary text-white font-weight-bold">
					Block Student List
					<span class='float-right' style='float:right'>
						<a href="{{ route('add_student') }}">  <button class="btn btn-success btn-sm" > Add New Student</button></a>
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
				    <table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
				        <thead>
					        <tr class="table_main_row">
					        	<th>Center Code</th>
					        	<th>Reg.No</th>
					            <th>Student Name</th>
					            <th>Date of Birth</th>
					            <th>Course</th>
					            <th>Status</th>
					            <th>Image</th>
					            <th>Action</th>
					        </tr>
				        </thead>
				        <tbody>
				        	@php $i=1; @endphp
				        	@foreach($student as $data) 
				        		<tr>
				        			<td>{{ $data->cl_code }}</td>
				        			<td>{{ $data->sl_reg_no }}</td>
				        			<td>
				        				<a href="{{ route('student_application', $data->sl_id) }}" target="__blank" >{{ $data->sl_name }}</a>
				        			</td>
				        			<td>{{ $data->sl_dob }}</td>
				        			<td>{{ $data->c_short_name}}</td>
				        			<td>{{ $data->sl_status}}</td>
				        			<td>
				        				<img style="width: 47px;" src="{{ asset('center/student_doc/').'/'.$data->sl_photo }}">
				        			</td>
				        			<td>
				        				<a href="{{ route('edit_student', $data->sl_id) }}" class="btn btn-primary btn-sm"><i class="fa-regular fa-eye"></i></a>
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
@push('custom-js')

@endpush