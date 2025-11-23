@extends('center.layouts.base')
@section('title', 'Manage Batch')
@push('custom-css')
<style type="text/css">
		
</style>
@endpush
@section('content')
<!-- start page title -->
<div class="card-header bg-secondary text-white font-weight-bold">
	Manage Batch
	<span class='float-right' style='float:right'>
		<a href="{{ route('student_list') }}">  <button class="btn btn-dark btn-sm" > View All </button></a>
	<button class="btn btn-success btn-sm" id="update_btn" accesskey="s"> SAVE </button></span>
</div>
<!-- end page title -->
<div class="card ">
	<div class="card-body">
		<div class="row">
			<div class="col-md-4" >
				<!-- Form Elements -->
				<form method="post" id='insert_frm' enctype='multipart/form-data'>
					@csrf
					<div class="form-group">
						<label>Batch Name</label>
						
						<input class="form-control" placeholder="Batch Name" name='batch_name'  required  >
					</div>
					
					<div class="form-group">
						<label>Start Time</label>
						
						<input class="form-control" value='' name='start_time' type='time' required  >
					</div>
					
					<div class="form-group">
						<label>End Name</label>
						<input class="form-control" value='' name='end_time' type='time'  required  >
					</div>
					
					<div class="form-group">
						<label>Status</label>
						<select class="form-control" name='status' required>
							<option value='ACTIVE' >ACTIVE</option>
							<option value='PENDING' >PENDING</option>
							<option value='BLOCK' >BLOCK</option>
							
						</select>
					</div>
					<button type="submit" class="btn btn-danger btn-block mt-2" id='insert_btn'> Save </button>
				</form>
				
			</div>
			
			
			<div class="col-lg-8">
				
				<!--    Basic Table  -->
				<table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
					<thead >
						<tr>
							<th>Batch Name </th>
							<th>Start Time </th>
							<th>End Time </th>
							<th>Status</th>
							<th>Operation</th>
						</tr>
					</thead>
					<tbody>
						@foreach($attndance_batch as $data)
							<tr>
								<td>{{ $data->ab_name }}</td>
								<td>{{ $data->ab_start_time }}</td>
								<td>{{ $data->ab_end_time }}</td>
								<td>{{ $data->ab_status }}</td>
								<td>
									<a onclick="return confirm('Are You Sure to delete?');" href="{{ route('attndance_batch_delete', $data->ab_id) }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		
	</div>
</div>
<!-- end row -->
@endsection
@push('custom-js')
@endpush