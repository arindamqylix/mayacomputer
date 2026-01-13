@extends('admin.layouts.base')
@section('title', 'Income/Expense')
@push('custom-css')
<style type="text/css">
	.dataTables_wrapper{
		overflow: scroll !important;
	}
	
	/* Modern Card Header - Matching Logo Blue */
	.income-expense-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.income-expense-header h4 {
		color: white;
		margin: 0;
		font-weight: 600;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	
	.income-expense-header h4 i {
		font-size: 1.75rem;
	}
	
	/* Modern Card */
	.modern-card {
		border: none;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		border-radius: 0.5rem;
		overflow: hidden;
	}
	
	/* Stats Cards */
	.stats-section {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
		gap: 1.5rem;
		margin-bottom: 2rem;
	}
	
	.stat-card {
		background: #fff;
		border-radius: 12px;
		padding: 1.5rem;
		box-shadow: 0 4px 15px rgba(0,0,0,0.08);
		transition: all 0.3s ease;
		border: none;
		position: relative;
		overflow: hidden;
	}
	
	.stat-card::before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		height: 4px;
	}
	
	.stat-card.income-card::before {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
	}
	
	.stat-card.expense-card::before {
		background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
	}
	
	.stat-card.balance-card::before {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
	}
	
	.stat-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 8px 25px rgba(0,0,0,0.12);
	}
	
	.stat-card .icon-wrapper {
		width: 60px;
		height: 60px;
		border-radius: 12px;
		display: flex;
		align-items: center;
		justify-content: center;
		margin-bottom: 1rem;
		color: white;
		font-size: 1.5rem;
	}
	
	.stat-card.income-card .icon-wrapper {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
	}
	
	.stat-card.expense-card .icon-wrapper {
		background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
	}
	
	.stat-card.balance-card .icon-wrapper {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
	}
	
	.stat-card h3 {
		font-size: 1.75rem;
		font-weight: 700;
		color: #1e3a8a;
		margin: 0 0 0.5rem 0;
	}
	
	.stat-card p {
		margin: 0;
		color: #6c757d;
		font-size: 0.875rem;
		font-weight: 500;
	}
	
	/* Action Buttons */
	.btn-action-group {
		display: flex;
		gap: 0.75rem;
		align-items: center;
	}
	
	.btn-export {
		background: #6c757d;
		border: none;
		padding: 0.75rem 1.5rem;
		border-radius: 0.5rem;
		font-weight: 600;
		box-shadow: 0 2px 4px rgba(108, 117, 125, 0.3);
		transition: all 0.3s ease;
		color: white;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.btn-export:hover {
		background: #5a6268;
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(108, 117, 125, 0.4);
		color: white;
		text-decoration: none;
	}
	
	.btn-income {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		border: none;
		padding: 0.75rem 1.5rem;
		border-radius: 0.5rem;
		font-weight: 600;
		box-shadow: 0 4px 6px rgba(17, 153, 142, 0.3);
		transition: all 0.3s ease;
		color: white;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.btn-income:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(17, 153, 142, 0.4);
		background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%);
		color: white;
		text-decoration: none;
	}
	
	.btn-expense {
		background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
		border: none;
		padding: 0.75rem 1.5rem;
		border-radius: 0.5rem;
		font-weight: 600;
		box-shadow: 0 4px 6px rgba(235, 51, 73, 0.3);
		transition: all 0.3s ease;
		color: white;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.btn-expense:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(235, 51, 73, 0.4);
		background: linear-gradient(135deg, #f45c43 0%, #eb3349 100%);
		color: white;
		text-decoration: none;
	}
	
	/* Filter Section */
	.filter-section {
		background: #f8f9fa;
		padding: 1rem 1.5rem;
		border-bottom: 1px solid #e9ecef;
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
	
	.filter-select {
		border-radius: 0.5rem;
		border: 1px solid #dee2e6;
		padding: 0.5rem 1rem;
		transition: all 0.3s ease;
		font-weight: 600;
	}
	
	.filter-select:focus {
		border-color: #2563eb;
		box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
		outline: none;
	}
	
	/* Modern Table */
	.modern-table {
		margin: 0;
	}
	
	.modern-table thead th {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		font-weight: 600;
		text-transform: uppercase;
		font-size: 0.75rem;
		letter-spacing: 0.5px;
		padding: 1rem;
		border: none;
		white-space: nowrap;
	}
	
	.modern-table tbody td {
		padding: 1rem;
		vertical-align: middle;
		border-bottom: 1px solid #f0f0f0;
	}
	
	.modern-table tbody tr {
		transition: all 0.3s ease;
	}
	
	.modern-table tbody tr:hover {
		background-color: #f8f9ff;
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
	}
	
	/* Type Badge */
	.type-badge {
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.75rem;
		text-transform: uppercase;
		display: inline-block;
	}
	
	.type-badge.income {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
	}
	
	.type-badge.expense {
		background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
		color: white;
	}
	
	/* Amount Badge */
	.amount-badge {
		font-weight: 600;
		font-size: 0.875rem;
		display: inline-block;
	}
	
	.amount-badge.income {
		color: #11998e;
	}
	
	.amount-badge.expense {
		color: #eb3349;
	}
	
	/* Date Display */
	.date-display {
		color: #495057;
		font-weight: 500;
		font-family: 'Courier New', monospace;
		font-size: 0.875rem;
	}
	
	/* Mode Badge */
	.mode-badge {
		background: #e9ecef;
		color: #495057;
		padding: 0.25rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 500;
		font-size: 0.75rem;
		display: inline-block;
	}
	
	/* Delete Button */
	.btn-delete {
		background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
		border: none;
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.875rem;
		transition: all 0.3s ease;
		color: white;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.btn-delete:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(235, 51, 73, 0.4);
		background: linear-gradient(135deg, #f45c43 0%, #eb3349 100%);
		color: white;
		text-decoration: none;
	}
	
	/* Footer Summary */
	.table-footer-summary {
		background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
		color: white;
		font-weight: 600;
	}
	
	.table-footer-summary td {
		padding: 1rem;
		border: none;
	}
	
	/* Modal Styling */
	.modal-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		border: none;
	}
	
	.modal-header .modal-title {
		color: white;
		font-weight: 600;
	}
	
	.modal-header .btn-close {
		filter: invert(1);
	}
	
	.form-control, .form-select {
		border-radius: 0.5rem;
		border: 1px solid #dee2e6;
		padding: 0.75rem 1rem;
		transition: all 0.3s ease;
	}
	
	.form-control:focus, .form-select:focus {
		border-color: #2563eb;
		box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
		outline: none;
	}
	
	.btn-save {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		border: none;
		padding: 0.75rem 2rem;
		border-radius: 0.5rem;
		font-weight: 600;
		box-shadow: 0 4px 6px rgba(17, 153, 142, 0.3);
		transition: all 0.3s ease;
		color: white;
	}
	
	.btn-save:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(17, 153, 142, 0.4);
		background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%);
		color: white;
	}
</style>
@endpush

@section('content')
<div class="row mt-3">
	<div class="col-12">
		<!-- Stats Section -->
		<div class="stats-section">
			<div class="stat-card income-card">
				<div class="icon-wrapper">
					<i class="fas fa-arrow-down"></i>
				</div>
				<h3>₹{{ number_format($total_income->total_income ?? 0, 2) }}</h3>
				<p>Total Income</p>
			</div>
			<div class="stat-card expense-card">
				<div class="icon-wrapper">
					<i class="fas fa-arrow-up"></i>
				</div>
				<h3>₹{{ number_format($total_expense->total_expense ?? 0, 2) }}</h3>
				<p>Total Expense</p>
			</div>
			<div class="stat-card balance-card">
				<div class="icon-wrapper">
					<i class="fas fa-wallet"></i>
				</div>
				<h3>₹{{ number_format($wallet_balance->wallet_balance ?? 0, 2) }}</h3>
				<p>Current Balance</p>
			</div>
		</div>
		
		<div class="card modern-card">
			<div class="card-header income-expense-header">
				<div class="d-flex justify-content-between align-items-center">
					<h4>
						<i class="fas fa-chart-line"></i>
						Transaction History
					</h4>
					<div class="btn-action-group">
						<button class="btn-export" onclick="exportxls()">
							<i class="fas fa-file-excel"></i>
							Export
						</button>
						<button class="btn-income ls-modal" data-user="23" data-txn="INCOME">
							<i class="fas fa-plus"></i>
							<i class="fas fa-rupee-sign"></i> INCOME
						</button>
						<button class="btn-expense ls-modal" data-user="23" data-txn="EXPENSE">
							<i class="fas fa-minus"></i>
							<i class="fas fa-rupee-sign"></i> EXPENSE
						</button>
					</div>
				</div>
			</div>
			
			<!-- Filter Section -->
			<div class="filter-section">
				<div>
					<label class="me-2"><strong>Filter by Type:</strong></label>
					<form style="display: inline-block;">
						<select name='txn_type' onChange='submit()' class='filter-select'>
							<option value='' {{ !request('txn_type') ? 'selected' : '' }}>All Transactions</option>
							<option value='INCOME' {{ request('txn_type') == 'INCOME' ? 'selected' : '' }}>INCOME</option>
							<option value='EXPENSE' {{ request('txn_type') == 'EXPENSE' ? 'selected' : '' }}>EXPENSE</option>
						</select>
					</form>
				</div>
			</div>
			
			<div class="card-body p-0">
				@if(count($income_expense) > 0)
					<div class="table-responsive">
						<table id="datatable-buttons" class="table modern-table table-hover mb-0">
							<thead>
								<tr>
									<th><i class="fas fa-calendar-alt me-2"></i>Date</th>
									<th><i class="fas fa-tag me-2"></i>Txn Type</th>
									<th><i class="fas fa-rupee-sign me-2"></i>Amount</th>
									<th><i class="fas fa-credit-card me-2"></i>Mode</th>
									<th><i class="fas fa-comment me-2"></i>Remarks</th>
									<th><i class="fas fa-cog me-2"></i>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($income_expense as $data)
									<tr>
										<td>
											<span class="date-display">
												@if($data->ie_date)
													{{ \Carbon\Carbon::parse($data->ie_date)->format('d M, Y') }}
												@else
													N/A
												@endif
											</span>
										</td>
										<td>
											<span class="type-badge {{ strtolower($data->ie_type) }}">
												{{ $data->ie_type }}
											</span>
										</td>
										<td>
											<span class="amount-badge {{ strtolower($data->ie_type) }}">
												₹{{ number_format($data->ie_amount ?? 0, 2) }}
											</span>
										</td>
										<td>
											<span class="mode-badge">
												<i class="fas fa-{{ strtolower($data->ie_mode) == 'bank' ? 'university' : 'money-bill' }} me-1"></i>
												{{ $data->ie_mode ?? 'N/A' }}
											</span>
										</td>
										<td>
											<span class="text-muted">{{ $data->ie_remarks ?? 'N/A' }}</span>
										</td>
										<td>
											<a onclick="return confirm('Are you sure you want to delete this transaction?');" 
											   href="{{ route('admin_income_expense_delete', $data->ie_id) }}" 
											   class="btn-delete">
												<i class="fas fa-trash"></i>
												Delete
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr class="table-footer-summary">
									<td colspan="2" class="text-end fw-bold">Total Summary:</td>
									<td>
										<span style="color: #38ef7d;">
											INCOME: ₹{{ number_format($total_income->total_income ?? 0, 2) }}
										</span>
									</td>
									<td>
										<span style="color: #f45c43;">
											EXPENSE: ₹{{ number_format($total_expense->total_expense ?? 0, 2) }}
										</span>
									</td>
									<td>
										<span style="color: #ffffff; font-size: 1.1rem;">
											BALANCE: ₹{{ number_format($wallet_balance->wallet_balance ?? 0, 2) }}
										</span>
									</td>
									<td></td>
								</tr>
							</tfoot>
						</table>
					</div>
				@else
					<div class="text-center p-5">
						<i class="fas fa-chart-line" style="font-size: 4rem; color: #6c757d; opacity: 0.5;"></i>
						<h5 class="mt-3">No Transactions Found</h5>
						<p class="text-muted">Start by adding your first income or expense transaction.</p>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>

<!-- Modal for Add Income/Expense -->
<div class="modal fade" id="appmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('admin_income_expense_create') }}" method="post" id='insert_frm' enctype='multipart/form-data'>
					@csrf
					<div class="form-group mb-3">
						<label><i class="fas fa-tag me-2"></i>Transaction Type</label>
						<input id='created_by' type='hidden' required>
						<input class="form-control" id='txn_type' name='txn_type' maxlength='8' readonly required>
					</div>
					<div class="form-group mb-3">
						<label><i class="fas fa-calendar-alt me-2"></i>Transaction Date</label>
						<input class="form-control" type='date' value='{{ date('Y-m-d') }}' name='txn_date' required>
					</div>
					<div class="form-group mb-3">
						<label><i class="fas fa-rupee-sign me-2"></i>Transaction Amount</label>
						<input class="form-control" type='number' step="0.01" min="0" value='' name='txn_amount' placeholder="Enter amount" required autofocus>
					</div>
					<div class="form-group mb-3">
						<label><i class="fas fa-credit-card me-2"></i>Transaction Mode</label>
						<select name='txn_mode' class='form-select' required>
							<option value='' selected>-- Select Mode --</option>
							<option value='BANK'>BANK</option>
							<option value='CASH'>CASH</option>
						</select>
					</div>
					<div class="form-group mb-3">
						<label><i class="fas fa-comment me-2"></i>Remarks</label>
						<input class="form-control" placeholder="Details of Transaction" name='txn_remarks' required>
					</div>
					<button class="btn btn-save w-100" type="submit">
						<i class="fas fa-save me-2"></i>Save Transaction
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@push('custom-script')
<script>
	$(document).ready(function() {
		// Modal trigger handler
		$(document).on('click', '.ls-modal', function(e) {
			e.preventDefault();
			
			var txn_type = $(this).attr("data-txn");
			var user_id = $(this).attr("data-user");
			
			// Set form values
			$("#created_by").val(user_id);
			$("#txn_type").val(txn_type);
			
			// Update modal title
			var icon = txn_type === 'INCOME' ? 'arrow-down' : 'arrow-up';
			$("#exampleModalCenterTitle").html('<i class="fas fa-' + icon + ' me-2"></i>' + txn_type + " ENTRY");
			
			// Update modal button color based on type
			if (txn_type === 'INCOME') {
				$('#insert_frm .btn-save').css('background', 'linear-gradient(135deg, #11998e 0%, #38ef7d 100%)');
			} else {
				$('#insert_frm .btn-save').css('background', 'linear-gradient(135deg, #eb3349 0%, #f45c43 100%)');
			}
			
			// Reset form
			$('#insert_frm')[0].reset();
			$("#txn_type").val(txn_type); // Re-set transaction type after reset
			$('input[name="txn_date"]').val('{{ date('Y-m-d') }}'); // Set today's date
			
			// Show modal using Bootstrap 5
			var modal = new bootstrap.Modal(document.getElementById('appmodal'));
			modal.show();
		});
		
		// Form validation
		$('#insert_frm').on('submit', function(e) {
			const amount = parseFloat($('input[name="txn_amount"]').val());
			if (isNaN(amount) || amount <= 0) {
				e.preventDefault();
				if (typeof toastr !== 'undefined') {
					toastr.error('Please enter a valid amount');
				} else {
					alert('Please enter a valid amount');
				}
				return false;
			}
			
			$('.btn-save').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Saving...');
		});
	});
</script>
@endpush
