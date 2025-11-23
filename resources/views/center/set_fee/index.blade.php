@extends('center.layouts.base')
@section('title', 'Set Fee')
@push('custom-css')
<style type="text/css">
	
</style>
@endpush
@section('content')
<div class="row mt-3">
	<div class="col-12">
		<div class="page-title-box d-sm-flex align-items-center justify-content-between">
			<div class="page-title-right">
				<form>
					<select name='course_id' onChange='submit()' class='h6 form-control'>
						<option value='' selected>--Select Course--</option>
						@foreach($course as $data)
							<option value="{{ $data->c_id }}" @if(request()->get('course_id') == $data->c_id) selected @endif>{{ $data->c_short_name }} [{{ $data->c_full_name }}]</option>
						@endforeach
					</select>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- end page title -->
<div class="card mb-4">
	<div class='card-header bg-secondary text-white font-weight-bold'>
		<h4 class="mb-sm-0 font-size-18">Set Fee</h4>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
				<thead>
					<tr class="table_main_row">
						<th>Reg.No</th>
						<th>Student Name</th>
						<th>Mobile No</th>
						<th>Course Fee</th>
					</tr>
				</thead>
				<tbody>
					@php
						$income = 0;
						$expense = 0;
					@endphp
					@foreach($student as $data)
						<tr>
							<td>{{ $data->sl_reg_no }}</td>
							<td>{{ $data->sl_name }}</td>
							<td>{{ $data->sl_mobile_no }}</td>
							<td>
								<input type="number" id="fees_amount_{{ $data->sl_id }}" name="fees" value="{{ $data->c_price }}">
								<button onclick="set_fee({{ $data->sl_id }})" class="btn btn-sm btn-danger">Set Fee</button>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			
		</div>
		
	</div>
</div>
@endsection
@push('custom-js')
<script>
	function set_fee(student_id){
		var fees_amount = $('#fees_amount_'+student_id).val();
		$.ajax({
			url: "{{ route('set_fee_amount') }}",
			type: "get",
			data:{student_id,fees_amount},
			dataType: "json",
			success: function(response){
				if(response.status == 1){
					alert(response.msg);
				}
			}
		});
	}
</script>
@endpush