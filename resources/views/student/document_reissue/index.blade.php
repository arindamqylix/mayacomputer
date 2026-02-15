@extends('student.layouts.base')
@section('title', 'Re-Print Documents')
<style type="text/css">
	.reissue-header {
		background: #f8f9fa;
		border-bottom: 1px solid #e9ecef;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}

	.reissue-header h4 {
		color: #343a40;
		margin: 0;
		font-weight: 700;
		font-size: 1.25rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}

	.modern-card {
		border: none;
		box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
		border-radius: 0.75rem;
		overflow: hidden;
		background: #ffffff;
	}

	.request-form-card {
		background: #f9fafb;
		border: 1px solid #e5e7eb;
		border-radius: 0.5rem;
		padding: 1.5rem;
		margin-bottom: 2rem;
	}

	.request-form-card h5 {
		color: #374151;
		font-weight: 600;
		font-size: 1.1rem;
	}

	.form-group label {
		font-weight: 500;
		color: #374151;
		margin-bottom: 0.5rem;
		font-size: 0.875rem;
	}

	.form-select,
	.form-control {
		border-radius: 0.375rem;
		border: 1px solid #d1d5db;
		padding: 0.625rem 0.875rem;
		transition: all 0.2s;
		font-size: 0.875rem;
	}

	.form-select:focus,
	.form-control:focus {
		border-color: #4f46e5;
		box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
		outline: none;
	}

	.btn-submit {
		background: #0d6efd;
		color: white;
		padding: 0.625rem 1.5rem;
		border-radius: 0.375rem;
		font-weight: 500;
		border: none;
		transition: all 0.2s;
		font-size: 0.875rem;
	}

	.btn-submit:hover {
		background: #0b5ed7;
		color: white;
		transform: translateY(-1px);
	}

	.price-display {
		background: #ecfdf5;
		color: #065f46;
		border: 1px solid #a7f3d0;
		padding: 0.75rem 1.25rem;
		border-radius: 0.375rem;
		margin-top: 1rem;
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	.price-display.hidden {
		display: none;
	}

	.price-label {
		font-weight: 500;
		font-size: 0.875rem;
	}

	.price-amount {
		font-weight: 700;
		font-size: 1.25rem;
		color: #059669;
	}

	.request-table {
		width: 100%;
		border-collapse: separate;
		border-spacing: 0;
	}

	.request-table thead th {
		background: #f3f4f6;
		color: #4b5563;
		font-weight: 600;
		padding: 0.75rem 1rem;
		text-align: left;
		font-size: 0.75rem;
		text-transform: uppercase;
		letter-spacing: 0.05em;
		border-bottom: 1px solid #e5e7eb;
	}

	.request-table tbody td {
		padding: 1rem;
		border-bottom: 1px solid #e5e7eb;
		vertical-align: middle;
		font-size: 0.875rem;
		color: #1f2937;
	}

	.request-table tbody tr:hover {
		background-color: #f9fafb;
	}

	.status-badge {
		padding: 0.25rem 0.625rem;
		border-radius: 9999px;
		font-size: 0.75rem;
		font-weight: 500;
		display: inline-flex;
		align-items: center;
		gap: 0.25rem;
	}

	.status-pending {
		background-color: #fef3c7;
		color: #92400e;
	}

	.status-paid {
		background-color: #dbeafe;
		color: #1e40af;
	}

	.status-processing {
		background-color: #e0e7ff;
		color: #3730a3;
	}

	.status-completed {
		background-color: #d1fae5;
		color: #065f46;
	}

	.status-rejected {
		background-color: #fee2e2;
		color: #991b1b;
	}

	.btn-view {
		background: #ffffff;
		color: #4b5563;
		border: 1px solid #d1d5db;
		padding: 0.375rem 0.75rem;
		border-radius: 0.375rem;
		text-decoration: none;
		font-size: 0.75rem;
		font-weight: 500;
		display: inline-flex;
		align-items: center;
		gap: 0.25rem;
		transition: all 0.2s;
	}

	.btn-view:hover {
		background: #f3f4f6;
		color: #1f2937;
		border-color: #9ca3af;
	}

	.btn-pay {
		background: #198754;
		color: white;
		padding: 0.375rem 0.75rem;
		border-radius: 0.375rem;
		text-decoration: none;
		font-size: 0.75rem;
		font-weight: 500;
		display: inline-flex;
		align-items: center;
		gap: 0.25rem;
		margin-left: 0.5rem;
		transition: all 0.2s;
	}

	.btn-pay:hover {
		background: #157347;
		color: white;
	}
</style>

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="modern-card">
					<div class="reissue-header">
						<h4>
							<i class="fa-solid fa-file-circle-plus"></i>
							Re-Print Documents
						</h4>
					</div>
					<div class="card-body p-4">
						@if(session('success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<i class="fa-solid fa-check-circle"></i> {{ session('success') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
							</div>
						@endif

						@if(session('error'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<i class="fa-solid fa-exclamation-circle"></i> {{ session('error') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
							</div>
						@endif

						@if(session('info'))
							<div class="alert alert-info alert-dismissible fade show" role="alert">
								<i class="fa-solid fa-info-circle"></i> {{ session('info') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
							</div>
						@endif

						<!-- Request Form -->
						<div class="request-form-card">
							<h5 class="mb-4">
								<i class="fa-solid fa-file-circle-plus"></i> Request New Document Re-Print
							</h5>
							<p class="text-muted small mb-3">Only documents that have been generated for you are shown. You can select multiple documents and submit together.</p>

							<form action="{{ route('student.document_reissue.store') }}" method="POST" id="reissueForm">
								@csrf

								<div class="form-group mb-3">
									<label class="d-block">
										<i class="fa-solid fa-file-lines"></i> Select Document Type(s) <span class="text-danger">*</span>
									</label>
									@if($documentTypes->isEmpty())
										<div class="alert alert-warning mb-0">No document types available for re-print yet. Once your Result, Certificate, ID Card, or Registration Card is generated, they will appear here.</div>
									@else
										<div class="border rounded p-3 bg-white">
											@foreach($documentTypes as $type)
												<div class="form-check mb-2">
													<input class="form-check-input doc-type-check" type="checkbox" name="document_type[]" value="{{ $type->dt_id }}" id="doc_type_{{ $type->dt_id }}" data-price="{{ $type->dt_amount }}">
													<label class="form-check-label" for="doc_type_{{ $type->dt_id }}">
														{{ $type->dt_name }} — ₹ {{ number_format($type->dt_amount, 2) }}
													</label>
												</div>
											@endforeach
										</div>
									@endif
								</div>

								<div class="form-group mb-3 mt-3">
									<label for="remarks">
										<i class="fa-solid fa-comment"></i> Remarks (Optional)
									</label>
									<input type="text" class="form-control" id="remarks" name="remarks"
										placeholder="Enter any additional information or reason...">
								</div>

								@if($documentTypes->isNotEmpty())
									<div class="price-display hidden" id="priceDisplay">
										<div class="price-label">Total Amount (<span id="selectedCount">0</span> selected):</div>
										<div class="price-amount" id="priceAmount">₹ 0.00</div>
									</div>

									<div class="mt-3">
										<button type="submit" class="btn-submit" id="btnSubmit" disabled>
											<i class="fa-solid fa-paper-plane"></i> Submit Request(s) & Proceed to Payment
										</button>
									</div>
								@endif
							</form>
						</div>

						<hr class="my-4">

						<!-- My Requests -->
						<h5 class="mb-4">
							<i class="fa-solid fa-clock-rotate-left"></i> My Requests
						</h5>

						@if($requestGroups->count() > 0)
							<div class="table-responsive">
								<table class="table request-table">
									<thead>
										<tr>
											<th>Request</th>
											<th>Document(s)</th>
											<th>Total Amount</th>
											<th>Payment Status</th>
											<th>Request Status</th>
											<th>Requested Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($requestGroups as $group)
											<tr>
												<td><strong>#{{ $group->items->first()->drr_id }}{{ $group->items->count() > 1 ? ' (+' . ($group->items->count() - 1) . ')' : '' }}</strong></td>
												<td>
													@foreach($group->items as $req)
														<i class="fa-solid fa-file-lines"></i> {{ $req->drr_document_type }}@if(!$loop->last), @endif
													@endforeach
												</td>
												<td><strong>₹ {{ number_format($group->total_amount, 2) }}</strong></td>
												<td>
													@if($group->payment_status == 'PAID')
														<span class="status-badge status-paid">Paid</span>
													@elseif($group->payment_status == 'FAILED')
														<span class="status-badge status-rejected">Failed</span>
													@else
														<span class="status-badge status-pending">Pending</span>
													@endif
												</td>
												<td>
													@if($group->request_status == 'COMPLETED')
														<span class="status-badge status-completed">Completed</span>
													@elseif($group->request_status == 'PROCESSING')
														<span class="status-badge status-processing">Processing</span>
													@elseif($group->request_status == 'REJECTED')
														<span class="status-badge status-rejected">Rejected</span>
													@elseif($group->request_status == 'PAID')
														<span class="status-badge status-paid">Paid</span>
													@else
														<span class="status-badge status-pending">Pending</span>
													@endif
												</td>
												<td>{{ \Carbon\Carbon::parse($group->requested_at)->format('d M, Y') }}</td>
												<td>
													<a href="{{ route('student.document_reissue.show', $group->items->first()->drr_id) }}"
														class="btn-view">
														<i class="fa-solid fa-eye"></i> View
													</a>
													@if($group->payment_status == 'PENDING')
														<a href="{{ route('student.document_reissue.payment.group', $group->group_id) }}"
															class="btn-pay">
															<i class="fa-solid fa-credit-card"></i> Pay
														</a>
													@endif
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						@else
							<div class="alert alert-info text-center">
								<i class="fa-solid fa-info-circle"></i>
								No re-print requests found. Request a document re-print above.
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('custom-script')
	<script>
		$(document).ready(function () {
			function updateTotal() {
				var total = 0;
				var count = 0;
				$('.doc-type-check:checked').each(function () {
					total += parseFloat($(this).data('price')) || 0;
					count++;
				});
				$('#priceAmount').text('₹ ' + total.toFixed(2));
				$('#selectedCount').text(count);
				if (count > 0) {
					$('#priceDisplay').removeClass('hidden');
					$('#btnSubmit').prop('disabled', false);
				} else {
					$('#priceDisplay').addClass('hidden');
					$('#btnSubmit').prop('disabled', true);
				}
			}
			$('.doc-type-check').on('change', updateTotal);
			updateTotal();
			$('#reissueForm').on('submit', function () {
				if ($('.doc-type-check:checked').length === 0) {
					alert('Please select at least one document type.');
					return false;
				}
			});
		});
	</script>
@endpush