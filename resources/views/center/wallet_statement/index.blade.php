@extends('center.layouts.base')
@section('title', 'Set Fee')
@push('custom-css')
<style type="text/css">
	
</style>
@endpush
@section('content')

<!-- end page title -->
<div class="card mb-4 mt-3">
	<div class="card-header bg-secondary text-white font-weight-bold">
		Recharge History
		{{-- <span class='float-right' style='float:right'>
			<a href="{{ route('generate_admit_card') }}">  <button class="btn btn-success btn-sm" >Generate New Admit</button></a> --}}
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
				<thead>
					<tr class="table_main_row">
						<th>#ID</th>
						<th>Amount</th>
						<th>Deposit Through</th>
						<th>Status</th>
						<th>Payment Date</th>
					</tr>
				</thead>
				<tbody>
					@php
						$i=1;
					@endphp
					@foreach($wallet_statement as $data)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $data->cr_amount }} ₹</td>
							<td> 
							    @if($data->cr_deposit_by)
							        Admin
							    @else
							        Razorpay
							    @endif
							</td>
							<td>
								@if($data->cr_status == 0)
									PENDING
								@else
									COMPLETE
								@endif
							</td>
							<td>{{ $data->created_at }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			
		</div>
		
	</div>
</div>
@endsection
@push('custom-js')

@endpush