@extends('center.layouts.base')
@section('title', 'Income/Expense')
@push('custom-css')
<style type="text/css">
	
</style>
@endpush
@section('content')
<div class="row">
	<div class="col-12">
		<div class="page-title-box d-sm-flex align-items-center justify-content-between">
			<h4 class="mb-sm-0 font-size-18">Manage Income /Expense</h4>
			<div class="page-title-right">
				<form>
					<select name='txn_type' onChange='submit()' class='h6'>
						<option value='' selected></option>
						<option value='INCOME' >INCOME</option>
						<option value='EXPENSE' >EXPENSE</option>
					</select>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- end page title -->
<div class="card mb-4">
	<div class='card-header bg-secondary text-white font-weight-bold'>
		Transaction History
		<span style='float:right'>
			<button class='btn btn-primary btn-sm' onClick ='exportxls()'> <i class='fa fa-file-excel'></i> Export </button>
			<button class='ls-modal btn btn-success btn-sm' data-user='23' data-txn='INCOME' >+ <i class='fa fa-inr'></i> INCOME</button>
			<button class='ls-modal btn btn-danger btn-sm' data-user='23' data-txn='EXPENSE' >- <i class='fa fa-inr'></i> EXPENSE</button>
		</span>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
				<thead>
					<tr class="table_main_row">
						<th>Date</th>
						<th>Txn Type</th>
						<th>Amount</th>
						<th>Mode</th>
						<th>Remarks</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@php
						$income = 0;
						$expense = 0;
					@endphp
					@foreach($income_expense as $data)
						<tr>
							<td>{{ $data->ie_date }}</td>
							<td>{{ $data->ie_type }}</td>
							<td>{{ $data->ie_amount }}</td>
							<td>{{ $data->ie_mode }}</td>
							<td>{{ $data->ie_remarks }}</td>
							<td>
								<a onclick="return confirm('Are You Sure to delete?');" href="{{ route('income_expense_delete', $data->ie_id) }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
				<tfoot>
				<tr class='bg-dark text-light'>
					<td colspan='3' >Total</td>
					<td> INCOME :  {{ $total_income->total_income }}</td>
					<td> EXPENSE :  {{ $total_expense->total_expense }}</td>
					<td> BALANCE :  {{ $wallet_balance->wallet_balance }}</td>
				</tr>
				</tfoot>
			</table>
			
		</div>
		
	</div>
</div>
<div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id='appmodal'>
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">  </h5>
				<button type="button" class="bootbox-close-button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action ="{{ route('income_expense_create') }}" method ='post' id='insert_frm'    enctype='multipart/form-data'>
					@csrf
					<div class="form-group mb-3">
						<label> Transaction Type</label>
						<input  id='created_by' type='hidden' required>
						<input class="form-control" id ='txn_type' name='txn_type' maxlength='8' readonly required>
					</div>
					<div class="form-group mb-3">
						<label>Txn Date</label>
						<input class="form-control"  type='date' name='txn_date' required>
					</div>
					<div class="form-group mb-3">
						<label>Txn Amount</label>
						<input class="form-control"  type='number' value ='' name='txn_amount' required autofocus>
					</div>
					
					<div class="form-group mb-3">
						<label>Txn Mode</label>
						<select name ='txn_mode' class='form-control'>
							<option value='' selected></option>
							<option value='BANK' >BANK</option>
							<option value='CASH' >CASH</option>
						</select>
					</div>
					
					<div class="form-group mb-3">
						<label>Remarks </label>
						<input class="form-control" placeholder="Details of Transaction" name='txn_remarks' required>
					</div>

				<button class="btn btn-success" type="submit">Save Txn </button>
				</form>
				
				
			</div>
		</div>
	</div>
</div>
@endsection
@push('custom-js')
<script>
	$(document).on('click','.ls-modal',function(e){
		e.preventDefault();
		$('#appmodal').modal('show');
		var txn_type = $(this).attr("data-txn");
		$("#created_by").val($(this).attr("data-user"));
		$("#txn_type").val(txn_type);
		$("#exampleModalCenterTitle").html(txn_type + " ENTRY")
	});
</script>
@endpush