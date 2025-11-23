@extends('center.layouts.base')
@section('title', 'Search To Pay')
@push('custom-css')
<style type="text/css">
	
</style>
@endpush
@section('content')
<!-- start page title -->
<div class="row">
	<div class="col-12">
		<div class="page-title-box d-sm-flex align-items-center justify-content-between">
			<h4 class="mb-sm-0 font-size-18">Pay Fee for {{ $student->sl_name }} </h4>
			<div class="page-title-right">
				
			</div>
		</div>
	</div>
</div>
<!-- end page title -->
<div class="row">
	<div class="col-lg-12">
		<!--<div class="card-header bg-secondary text-white -->
		<!--  Details of Fee -->
		<!--       </div>-->
		<div class="card">
			
			<div class="card-body">
				<div class='row'>
					<div class='col-4'>
						<form  method ='post' >
							@csrf
							<div class="form-group mb-2">
								<input type="hidden" name="student_id" value="{{ request()->get('student_id') }}">
								<label>Date of Payment</label>
								
								<input required="" class="form-control" name='paid_date' type='date'>
							</div>
							
							
							<div class="form-group mb-2">
								<label>Amount to Pay</label>
								<input class="form-control" value="{{ $student->sf_due }}" name='total_amount' type='text' readonly>
							</div>
							
							
							
							<div class="form-group has-error">
								<label class="control-label" for="inputError">Enter Amount to Pay</label>
								<input type="text" class="form-control" id="inputError"
								placeholder='' name='paid_amount' required>
							</div>
							<div class="form-group mb-2">
								<label>Remarks (About Fee)</label>
								<input class="form-control" name='remarks' required>
							</div>
							{{-- <div class="checkbox">
								<label>
									<input type="checkbox" value="yes" name='checksms'> Send SMS Also (if Internet Connection)
								</label>
							</div> --}}
							<button type="submit" class="btn btn-info">Make A Payment</button>
						</div>
						
					</form>
					
					
					
					<div class="col-lg-8">
						
						<!--    Basic Table  -->
						<div class="panel panel-default">
							<div class="panel-heading">
								Your Last Payment Details
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table">
										<thead >
											<tr>
												{{-- <th >Receipt Id</th> --}}
												<th>Paid date</th>
												<th>Total</th>
												<th>Paid Amount</th>
												<th>Remarks</th>
												
												
											</tr>
										</thead>
										<tbody>
											@foreach($payment_list as $data)
												<tr>
													{{-- <td>
														<a href="{{ route('print_receipt', $data->fp_FK_of_student_id) }}">{{ $data->fp_receipt_no }}</a>
													</td> --}}
													<td>{{ $data->fp_date }}</td>
													<td>{{ $data->fp_total_amount }}</td>
													<td>{{ $data->fp_amount }}</td>
													<td>{{ $data->fp_remarks }}</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
			</div>
		</div>
		<!-- end select2 -->
	</div>
	
</div>
<!-- end row -->
@endsection
@push('custom-js')
<script>
	
</script>
@endpush