@extends('center.layouts.base')
@section('title', 'Search To Pay')
@push('custom-css')
<style type="text/css">
	
</style>
@endpush
@section('content')
<div class="row">
	<div class="col-12">
		<div class="page-title-box d-sm-flex align-items-center justify-content-between">
			<h4 class="mb-sm-0 font-size-18">SEARCH TO PAYMENT</h4>
		</div>
	</div>
</div>
<!-- end page title -->
<div class="card mb-4">
	{{-- <div class='card-header bg-secondary text-white font-weight-bold'>
		Set Fee For {{ $course_name->c_full_name }}
	</div> --}}
	<div class="card-body">
		<div class="table-responsive">
			<table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
				<thead>
					<tr class="table_main_row">
						<th>Reg.No</th>
						<th>Student Name</th>
						<th>Course</th>
						<th>Total Fee</th>
						<th>Total Paid</th>
						<th>Dues Amount</th>
						<th>Action</th>
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
							<td>{{ $data->c_short_name }}</td>
							<td>{{ $data->sf_amount }}</td>
							<td>{{ $data->sf_paid }}</td>
							<td>{{ $data->sf_due }}</td>
							<td>
								@if($data->sf_due == 0)
									<a class="btn btn-danger btn-sm">No Dues</a>
								@else
									<a href="{{ route('fees_payment', ['student_id'=>$data->sf_FK_of_student_id]) }}" class="btn btn-success btn-sm">Pay Fee</a>
								@endif
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