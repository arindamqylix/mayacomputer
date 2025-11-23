@extends('admin.layouts.base')
@section('title', 'Course List')
@push('custom-css')
	<style type="text/css">
		
	</style>
@endpush
@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header bg-secondary text-white font-weight-bold">
					Course List
					<span class='float-right' style='float:right'>
						<a href="{{ route('add_course') }}">  <button class="btn btn-success btn-sm" > Add New Course</button></a>
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
					        	<th>#ID</th>
					        	<th>Course Name</th>
					            <th>Price</th>
					            <th>Duration</th>
					            <th>Created At</th>
					            <th>Action</th>
					        </tr>
				        </thead>
				        <tbody>
				        	@php $i=1; @endphp
				        	@foreach($course as $data) 
				        		<tr>
				        			<td>{{ $i++ }}</td>
				        			<td>{{ $data->c_full_name }}[{{ $data->c_short_name }}]</td>
				        			<td>{{ $data->c_price }}</td>
				        			<td>{{ $data->c_duration }}</td>
				        			<td>{{ $data->created_at }}</td>
				        			<td>
				        				<a href="{{ route('edit_course', $data->c_id) }}" class="btn btn-primary btn-sm"><i class="fa-regular fa-eye"></i></a>
				        				<a onclick="return confirm('Are You Sure to delete?');" href="{{ route('delete_course', $data->c_id) }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
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