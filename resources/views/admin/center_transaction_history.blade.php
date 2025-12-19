@extends('admin.layouts.base')
@section('title', 'Center Transaction History')
@push('custom-css')
<style type="text/css">
	.dataTables_wrapper{
		overflow: scroll !important;
	}
	
	/* Modern Card Header - Matching Logo Blue */
	.transaction-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.transaction-header h4 {
		color: white;
		margin: 0;
		font-weight: 600;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	
	.transaction-header h4 i {
		font-size: 1.75rem;
	}
	
	/* Modern Card */
	.modern-card {
		border: none;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		border-radius: 0.5rem;
		overflow: hidden;
	}
	
	/* Search Section */
	.search-section {
		background: #f8f9fa;
		padding: 1.5rem;
		border-bottom: 1px solid #e9ecef;
	}
	
	.search-input-wrapper {
		position: relative;
	}
	
	.search-input-wrapper i {
		position: absolute;
		left: 15px;
		top: 50%;
		transform: translateY(-50%);
		color: #6c757d;
	}
	
	.search-input-wrapper input {
		padding-left: 45px;
		border-radius: 0.5rem;
		border: 1px solid #dee2e6;
		transition: all 0.3s ease;
	}
	
	.search-input-wrapper input:focus {
		border-color: #2563eb;
		box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
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
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		font-size: 1.5rem;
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
	
	/* Amount Badge */
	.amount-badge {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.875rem;
		display: inline-block;
	}
	
	/* Date Display */
	.date-display {
		color: #495057;
		font-weight: 500;
		font-family: 'Courier New', monospace;
		font-size: 0.875rem;
	}
	
	/* Center Badge */
	.center-badge {
		background: #e9ecef;
		color: #495057;
		padding: 0.25rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 500;
		font-size: 0.875rem;
		display: inline-block;
	}
	
	.center-code-badge {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 0.25rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.75rem;
		font-family: 'Courier New', monospace;
		display: inline-block;
	}
	
	/* Description */
	.description-text {
		color: #495057;
		font-size: 0.875rem;
		max-width: 300px;
	}
	
	/* ID Badge */
	.id-badge {
		background: #f8f9fa;
		color: #495057;
		padding: 0.25rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.875rem;
		display: inline-block;
		font-family: 'Courier New', monospace;
	}
	
	/* Empty State */
	.empty-state {
		text-align: center;
		padding: 3rem;
		color: #6c757d;
	}
	
	.empty-state i {
		font-size: 4rem;
		margin-bottom: 1rem;
		opacity: 0.5;
	}
</style>
@endpush

@section('content')
<div class="row mt-3">
	<div class="col-12">
		<!-- Stats Section -->
		<div class="stats-section">
			<div class="stat-card">
				<div class="icon-wrapper">
					<i class="fas fa-exchange-alt"></i>
				</div>
				<h3>{{ count($transaction) }}</h3>
				<p>Total Transactions</p>
			</div>
			<div class="stat-card">
				<div class="icon-wrapper">
					<i class="fas fa-rupee-sign"></i>
				</div>
				<h3>₹{{ number_format(collect($transaction)->sum('t_amount') ?? 0, 2) }}</h3>
				<p>Total Amount</p>
			</div>
			<div class="stat-card">
				<div class="icon-wrapper">
					<i class="fas fa-building"></i>
				</div>
				<h3>{{ collect($transaction)->unique('cl_id')->count() }}</h3>
				<p>Centers Involved</p>
			</div>
		</div>
		
		<div class="card modern-card">
			<div class="card-header transaction-header">
				<h4>
					<i class="fas fa-history"></i>
					Transaction History
				</h4>
			</div>
			
			<!-- Search Section -->
			<div class="search-section">
				<div class="row">
					<div class="col-md-6">
						<div class="search-input-wrapper">
							<i class="fas fa-search"></i>
							<input type="text" id="searchInput" class="form-control" placeholder="Search by center code, center name, amount, description...">
						</div>
					</div>
				</div>
			</div>
			
			<div class="card-body p-0">
				@if(count($transaction) > 0)
					<div class="table-responsive">
						<table id="datatable-buttons" class="table modern-table table-hover mb-0">
							<thead>
								<tr>
									<th><i class="fas fa-hashtag me-2"></i>#ID</th>
									<th><i class="fas fa-calendar-alt me-2"></i>Txn Date</th>
									<th><i class="fas fa-code me-2"></i>Center Code</th>
									<th><i class="fas fa-building me-2"></i>Center Name</th>
									<th><i class="fas fa-rupee-sign me-2"></i>Amount</th>
									<th><i class="fas fa-file-alt me-2"></i>Description</th>
								</tr>
							</thead>
							<tbody>
								@php
									$i = 1;
									$totalAmount = 0;
								@endphp
								@foreach($transaction as $data)
									@php
										$totalAmount += $data->t_amount ?? 0;
									@endphp
									<tr>
										<td>
											<span class="id-badge">#{{ $i++ }}</span>
										</td>
										<td>
											<span class="date-display">
												@if($data->created_at)
													{{ \Carbon\Carbon::parse($data->created_at)->format('d M, Y h:i A') }}
												@else
													N/A
												@endif
											</span>
										</td>
										<td>
											<span class="center-code-badge">
												{{ $data->cl_code ?? 'N/A' }}
											</span>
										</td>
										<td>
											<span class="center-badge">
												<i class="fas fa-building me-1"></i>
												{{ $data->cl_center_name ?? 'N/A' }}
											</span>
										</td>
										<td>
											<span class="amount-badge">
												₹{{ number_format($data->t_amount ?? 0, 2) }}
											</span>
										</td>
										<td>
											<span class="description-text">
												<i class="fas fa-file-invoice me-1"></i>
												Docs fee for {{ $data->t_student_reg_no ?? 'N/A' }}
											</span>
										</td>
									</tr>
								@endforeach
							</tbody>
							@if(count($transaction) > 0)
							<tfoot>
								<tr style="background: #f8f9fa;">
									<td colspan="4" class="text-end fw-bold">
										<i class="fas fa-calculator me-2"></i>Total:
									</td>
									<td>
										<span class="amount-badge" style="font-size: 1rem;">
											₹{{ number_format($totalAmount, 2) }}
										</span>
									</td>
									<td></td>
								</tr>
							</tfoot>
							@endif
						</table>
					</div>
				@else
					<div class="empty-state">
						<i class="fas fa-exchange-alt"></i>
						<h5>No Transactions Found</h5>
						<p>Transaction history will appear here once centers start making payments.</p>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection

@push('custom-js')
<script>
	$(document).ready(function() {
		// Initialize DataTable if available
		if ($.fn.DataTable) {
			var table = $('#datatable-buttons').DataTable({
				"order": [[1, "desc"]], // Sort by transaction date descending
				"pageLength": 25,
				"language": {
					"search": "",
					"searchPlaceholder": "Search..."
				},
				"dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
				"footerCallback": function (row, data, start, end, display) {
					// Footer callback for totals if needed
				}
			});
			
			// Custom search input
			$('#searchInput').on('keyup', function() {
				table.search(this.value).draw();
			});
		} else {
			// Fallback search if DataTable is not available
			$('#searchInput').on('keyup', function() {
				var value = $(this).val().toLowerCase();
				$('table tbody tr').filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
				});
			});
		}
	});
</script>
@endpush
