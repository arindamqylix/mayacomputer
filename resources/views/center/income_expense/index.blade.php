@extends('center.layouts.base')
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
		justify-content: space-between;
		gap: 0.75rem;
	}
	
	.income-expense-header h4 i {
		font-size: 1.75rem;
	}
	
	.income-expense-header .header-actions {
		display: flex;
		gap: 0.75rem;
		align-items: center;
		flex-wrap: wrap;
	}
	
	/* Modern Card */
	.modern-card {
		border: none;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		border-radius: 0.5rem;
		overflow: hidden;
		margin-bottom: 2rem;
	}
	
	/* Stats Cards */
	.stats-section {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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
	
	.stat-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 8px 25px rgba(0,0,0,0.12);
	}
	
	.stat-card.income-card::before {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
	}
	
	.stat-card.expense-card::before {
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
	}
	
	.stat-card.balance-card::before {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
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
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
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
		flex-wrap: wrap;
	}
	
	.btn-export {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		border: none;
		padding: 0.625rem 1.25rem;
		border-radius: 8px;
		font-weight: 600;
		box-shadow: 0 2px 4px rgba(102, 126, 234, 0.3);
		transition: all 0.3s ease;
		color: white;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		font-size: 0.875rem;
	}
	
	.btn-export:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(102, 126, 234, 0.4);
		color: white;
		text-decoration: none;
	}
	
	.btn-income {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		border: none;
		padding: 0.625rem 1.25rem;
		border-radius: 8px;
		font-weight: 600;
		box-shadow: 0 2px 4px rgba(17, 153, 142, 0.3);
		transition: all 0.3s ease;
		color: white;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		font-size: 0.875rem;
		cursor: pointer;
	}
	
	.btn-income:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(17, 153, 142, 0.4);
		color: white;
		text-decoration: none;
	}
	
	.btn-expense {
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
		border: none;
		padding: 0.625rem 1.25rem;
		border-radius: 8px;
		font-weight: 600;
		box-shadow: 0 2px 4px rgba(245, 87, 108, 0.3);
		transition: all 0.3s ease;
		color: white;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		font-size: 0.875rem;
		cursor: pointer;
	}
	
	.btn-expense:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(245, 87, 108, 0.4);
		color: white;
		text-decoration: none;
	}
	
	/* Filter Section */
	.filter-section {
		background: #fff;
		border-radius: 12px;
		padding: 1.5rem;
		box-shadow: 0 4px 15px rgba(0,0,0,0.08);
		margin-bottom: 2rem;
		border: 1px solid #e5e7eb;
	}
	
	.filter-section label {
		font-weight: 600;
		color: #1e3a8a;
		margin-bottom: 0.75rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
		font-size: 0.9375rem;
	}
	
	.filter-section label i {
		color: #2563eb;
		font-size: 1rem;
	}
	
	.filter-section select {
		border: 2px solid #e5e7eb;
		border-radius: 8px;
		padding: 0.75rem 1rem;
		font-size: 0.9375rem;
		transition: all 0.3s ease;
		color: #1e3a8a;
		min-height: 45px;
		width: 100%;
	}
	
	.filter-section select:focus {
		border-color: #2563eb;
		outline: none;
		box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
	}
	
	/* Enhanced Table */
	.modern-table {
		width: 100%;
		border-collapse: separate;
		border-spacing: 0;
	}
	
	.modern-table thead {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
	}
	
	.modern-table thead th {
		color: white;
		font-weight: 600;
		padding: 1rem;
		text-align: left;
		border: none;
		font-size: 0.875rem;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}
	
	.modern-table thead th:first-child {
		border-top-left-radius: 8px;
	}
	
	.modern-table thead th:last-child {
		border-top-right-radius: 8px;
	}
	
	.modern-table tbody tr {
		transition: all 0.2s ease;
		border-bottom: 1px solid #e5e7eb;
	}
	
	.modern-table tbody tr:hover {
		background: linear-gradient(90deg, #f8f9ff 0%, #ffffff 100%);
		transform: scale(1.01);
		box-shadow: 0 2px 8px rgba(0,0,0,0.05);
	}
	
	.modern-table tbody td {
		padding: 1rem;
		color: #374151;
		font-size: 0.875rem;
		vertical-align: middle;
	}
	
	/* Date Display */
	.date-display {
		color: #495057;
		font-weight: 500;
		font-family: 'Courier New', monospace;
		font-size: 0.875rem;
	}
	
	/* Type Badge */
	.type-badge {
		display: inline-block;
		padding: 0.375rem 0.75rem;
		border-radius: 6px;
		font-weight: 600;
		font-size: 0.8125rem;
		letter-spacing: 0.5px;
	}
	
	.type-badge.income {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
	}
	
	.type-badge.expense {
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
		color: white;
	}
	
	/* Amount Display */
	.amount-display {
		font-weight: 600;
		font-size: 0.9375rem;
	}
	
	.amount-display.income {
		color: #11998e;
	}
	
	.amount-display.expense {
		color: #f5576c;
	}
	
	/* Mode Badge */
	.mode-badge {
		display: inline-block;
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		padding: 0.375rem 0.75rem;
		border-radius: 6px;
		font-weight: 600;
		font-size: 0.8125rem;
		letter-spacing: 0.5px;
	}
	
	/* Remarks */
	.remarks-text {
		color: #495057;
		font-size: 0.875rem;
		max-width: 300px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
	
	/* Delete Button */
	.btn-delete {
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
		color: white;
		border: none;
		padding: 0.5rem 1rem;
		border-radius: 8px;
		font-weight: 600;
		font-size: 0.875rem;
		cursor: pointer;
		transition: all 0.3s ease;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		text-decoration: none;
	}
	
	.btn-delete:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(245, 87, 108, 0.4);
		color: white;
		text-decoration: none;
	}
	
	/* Summary Row */
	.summary-row {
		background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
		color: white;
		font-weight: 700;
	}
	
	.summary-row td {
		border-top: 2px solid #2563eb;
		color: white;
		font-size: 1rem;
		padding: 1rem;
	}
	
	/* Empty State */
	.empty-state {
		text-align: center;
		padding: 4rem 2rem;
		color: #6c757d;
	}
	
	.empty-state i {
		font-size: 4rem;
		margin-bottom: 1rem;
		opacity: 0.5;
		color: #2563eb;
	}
	
	.empty-state h5 {
		color: #1e3a8a;
		font-weight: 600;
		margin-bottom: 0.5rem;
	}
	
	.empty-state p {
		color: #6b7280;
		font-size: 0.9375rem;
	}
	
	/* Success/Error Messages */
	.alert-custom {
		border-radius: 8px;
		padding: 1rem 1.5rem;
		margin-bottom: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
		font-weight: 500;
	}
	
	.alert-success-custom {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		border: none;
		box-shadow: 0 4px 12px rgba(17, 153, 142, 0.3);
	}
	
	.alert-error-custom {
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
		color: white;
		border: none;
		box-shadow: 0 4px 12px rgba(245, 87, 108, 0.3);
	}
	
	/* Modal Styles */
	.modal-content {
		border-radius: 12px;
		border: none;
		box-shadow: 0 10px 40px rgba(0,0,0,0.2);
	}
	
	.modal-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		border-radius: 12px 12px 0 0;
		padding: 1.5rem;
		border: none;
	}
	
	.modal-header .modal-title {
		font-weight: 600;
		font-size: 1.25rem;
	}
	
	.modal-header .btn-close {
		filter: brightness(0) invert(1);
		opacity: 1;
	}
	
	.modal-body {
		padding: 2rem;
	}
	
	.modal-body .form-group label {
		font-weight: 600;
		color: #1e3a8a;
		margin-bottom: 0.5rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.modal-body .form-group label i {
		color: #2563eb;
		font-size: 0.875rem;
	}
	
	.modal-body .form-control {
		border: 2px solid #e5e7eb;
		border-radius: 8px;
		padding: 0.75rem 1rem;
		font-size: 0.9375rem;
		transition: all 0.3s ease;
	}
	
	.modal-body .form-control:focus {
		border-color: #2563eb;
		outline: none;
		box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
	}
	
	.modal-body .form-control[readonly] {
		background: #f8f9fa;
		font-weight: 600;
		color: #1e3a8a;
	}
	
	.btn-save-txn {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		border: none;
		padding: 0.75rem 2rem;
		border-radius: 8px;
		font-weight: 600;
		font-size: 1rem;
		cursor: pointer;
		transition: all 0.3s ease;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		width: 100%;
		justify-content: center;
	}
	
	.btn-save-txn:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(17, 153, 142, 0.4);
	}
</style>
@endpush
@section('content')

<!-- Success/Error Messages -->
@if(session('success'))
	<div class="alert-success-custom">
		<i class="fas fa-check-circle"></i>
		<span>{{ session('success') }}</span>
	</div>
@endif

@if(session('error'))
	<div class="alert-error-custom">
		<i class="fas fa-exclamation-circle"></i>
		<span>{{ session('error') }}</span>
	</div>
@endif

<!-- Stats Cards -->
@php
	$totalIncome = $total_income->total_income ?? 0;
	$totalExpense = $total_expense->total_expense ?? 0;
	$balance = $wallet_balance->wallet_balance ?? 0;
@endphp
<div class="stats-section">
	<div class="stat-card income-card">
		<div class="icon-wrapper">
			<i class="fas fa-arrow-up"></i>
		</div>
		<h3>₹{{ number_format($totalIncome, 2) }}</h3>
		<p>Total Income</p>
	</div>
	<div class="stat-card expense-card">
		<div class="icon-wrapper">
			<i class="fas fa-arrow-down"></i>
		</div>
		<h3>₹{{ number_format($totalExpense, 2) }}</h3>
		<p>Total Expense</p>
	</div>
	<div class="stat-card balance-card">
		<div class="icon-wrapper">
			<i class="fas fa-wallet"></i>
		</div>
		<h3>₹{{ number_format($balance, 2) }}</h3>
		<p>Current Balance</p>
	</div>
</div>

<!-- Filter Section -->
<div class="filter-section">
	<form method="GET" action="{{ route('income_expense') }}">
		<label for="txn_type">
			<i class="fas fa-filter"></i>
			Filter by Transaction Type
		</label>
		<select name="txn_type" id="txn_type" class="form-control" onchange="this.form.submit()">
			<option value="">All Transactions</option>
			<option value="INCOME" {{ request('txn_type') == 'INCOME' ? 'selected' : '' }}>INCOME</option>
			<option value="EXPENSE" {{ request('txn_type') == 'EXPENSE' ? 'selected' : '' }}>EXPENSE</option>
		</select>
	</form>
</div>

<!-- Main Card -->
<div class="card modern-card">
	<div class="income-expense-header">
		<h4>
			<span style="display: flex; align-items: center; gap: 0.75rem;">
				<i class="fas fa-chart-line"></i>
				Transaction History
			</span>
			<div class="header-actions">
				<button class="btn-export" onclick="exportxls()">
					<i class="fas fa-file-excel"></i> Export
				</button>
				<button class="btn-income ls-modal" data-user="{{ Auth::guard('center')->user()->cl_id }}" data-txn="INCOME">
					<i class="fas fa-plus"></i> ₹ INCOME
				</button>
				<button class="btn-expense ls-modal" data-user="{{ Auth::guard('center')->user()->cl_id }}" data-txn="EXPENSE">
					<i class="fas fa-minus"></i> ₹ EXPENSE
				</button>
			</div>
		</h4>
	</div>
	<div class="card-body" style="padding: 2rem;">
		@if(count($income_expense) > 0)
			<div class="table-responsive">
				<table id="datatable-buttons" class="table modern-table">
					<thead>
						<tr>
							<th>Date</th>
							<th>Txn Type</th>
							<th>Amount</th>
							<th>Mode</th>
							<th>Remarks</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($income_expense as $data)
							@php
								$isIncome = $data->ie_type === 'INCOME';
							@endphp
							<tr>
								<td>
									<span class="date-display">{{ \Carbon\Carbon::parse($data->ie_date)->format('d M, Y') }}</span>
								</td>
								<td>
									<span class="type-badge {{ strtolower($data->ie_type) }}">{{ $data->ie_type }}</span>
								</td>
								<td>
									<span class="amount-display {{ strtolower($data->ie_type) }}">
										₹{{ number_format($data->ie_amount, 2) }}
									</span>
								</td>
								<td>
									<span class="mode-badge">{{ $data->ie_mode }}</span>
								</td>
								<td>
									<span class="remarks-text" title="{{ $data->ie_remarks }}">{{ $data->ie_remarks }}</span>
								</td>
								<td>
									<a 
										onclick="return confirm('Are you sure you want to delete this transaction?');" 
										href="{{ route('income_expense_delete', $data->ie_id) }}" 
										class="btn-delete"
									>
										<i class="fas fa-trash"></i>
										Delete
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr class="summary-row">
							<td colspan="2"><strong>Total</strong></td>
							<td>
								<strong>INCOME: ₹{{ number_format($totalIncome, 2) }}</strong>
							</td>
							<td>
								<strong>EXPENSE: ₹{{ number_format($totalExpense, 2) }}</strong>
							</td>
							<td>
								<strong>BALANCE: ₹{{ number_format($balance, 2) }}</strong>
							</td>
							<td></td>
						</tr>
					</tfoot>
				</table>
			</div>
		@else
			<div class="empty-state">
				<i class="fas fa-receipt"></i>
				<h5>No Transactions Found</h5>
				<p>Start by adding your first income or expense transaction.</p>
			</div>
		@endif
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="appmodal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('income_expense_create') }}" method="POST" id="insert_frm" enctype="multipart/form-data">
					@csrf
					<div class="form-group mb-3">
						<label for="txn_type">
							<i class="fas fa-tag"></i>
							Transaction Type
						</label>
						<input id="created_by" type="hidden" required>
						<input class="form-control" id="txn_type" name="txn_type" maxlength="8" readonly required>
					</div>
					<div class="form-group mb-3">
						<label for="txn_date">
							<i class="fas fa-calendar"></i>
							Transaction Date
						</label>
						<input class="form-control" type="date" name="txn_date" id="txn_date" required>
					</div>
					<div class="form-group mb-3">
						<label for="txn_amount">
							<i class="fas fa-rupee-sign"></i>
							Transaction Amount
						</label>
						<input class="form-control" type="number" value="" name="txn_amount" id="txn_amount" required autofocus step="0.01" min="0">
					</div>
					
					<div class="form-group mb-3">
						<label for="txn_mode">
							<i class="fas fa-credit-card"></i>
							Transaction Mode
						</label>
						<select name="txn_mode" id="txn_mode" class="form-control" required>
							<option value="">-- Select Mode --</option>
							<option value="BANK">BANK</option>
							<option value="CASH">CASH</option>
						</select>
					</div>
					
					<div class="form-group mb-3">
						<label for="txn_remarks">
							<i class="fas fa-comment"></i>
							Remarks
						</label>
						<input class="form-control" placeholder="Details of Transaction" name="txn_remarks" id="txn_remarks" required>
					</div>

					<button class="btn-save-txn" type="submit">
						<i class="fas fa-save"></i>
						Save Transaction
					</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@push('custom-js')
<script>
	$(document).ready(function() {
		// Check if DataTable is already initialized and destroy it first
		if ($.fn.DataTable) {
			// Destroy existing DataTable instance if it exists
			if ($.fn.DataTable.isDataTable('#datatable-buttons')) {
				$('#datatable-buttons').DataTable().destroy();
			}
			
			// Initialize DataTable only if table exists and has data
			if ($('#datatable-buttons').length && $('#datatable-buttons tbody tr').length > 0) {
				var table = $('#datatable-buttons').DataTable({
					"order": [[0, "desc"]], // Sort by date descending
					"pageLength": 25,
					"language": {
						"search": "",
						"searchPlaceholder": "Search transactions..."
					},
					"dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
				});
			}
		}
		
		// Modal handling
		$(document).on('click', '.ls-modal', function(e) {
			e.preventDefault();
			var modal = new bootstrap.Modal(document.getElementById('appmodal'));
			modal.show();
			
			var txn_type = $(this).attr("data-txn");
			$("#created_by").val($(this).attr("data-user"));
			$("#txn_type").val(txn_type);
			$("#exampleModalCenterTitle").html(txn_type + " ENTRY");
			
			// Set today's date as default
			var today = new Date().toISOString().split('T')[0];
			$("#txn_date").val(today);
			
			// Reset form
			$("#insert_frm")[0].reset();
			$("#txn_type").val(txn_type);
			$("#created_by").val($(this).attr("data-user"));
		});
	});
	
	function exportxls() {
		var table = document.getElementById('datatable-buttons');
		if (!table) {
			alert('No table visible to export.');
			return;
		}

		// Build CSV
		var csv = [];
		for (var r = 0; r < table.rows.length; r++) {
			var row = [], cols = table.rows[r].querySelectorAll('th, td');
			for (var c = 0; c < cols.length; c++) {
				var text = cols[c].innerText.replace(/\n/g, ' ').trim();
				// Sanitize quotes
				text = text.replace(/"/g, '""');
				row.push('"' + text + '"');
			}
			csv.push(row.join(','));
		}

		var csvContent = csv.join('\n');
		var filename = 'income_expense_' + (new Date()).toISOString().slice(0,10) + '.csv';

		// Download
		var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
		if (navigator.msSaveBlob) {
			navigator.msSaveBlob(blob, filename);
		} else {
			var link = document.createElement("a");
			var url = URL.createObjectURL(blob);
			link.setAttribute("href", url);
			link.setAttribute("download", filename);
			link.style.visibility = 'hidden';
			document.body.appendChild(link);
			link.click();
			document.body.removeChild(link);
		}
	}
</script>
@endpush
