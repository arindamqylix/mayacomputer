@extends('student.layouts.base')
@section('title', 'Payment for Document Re-Print')

	<style type="text/css">
		.reissue-payment-page { max-width: 640px; margin: 0 auto; }
		.payment-header {
			background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
			border: none;
			padding: 1.25rem 1.5rem;
			border-radius: 0.75rem 0.75rem 0 0;
			box-shadow: 0 2px 8px rgba(13, 110, 253, 0.25);
		}
		.payment-header h4 {
			color: white;
			margin: 0;
			font-weight: 600;
			font-size: 1.35rem;
			display: flex;
			align-items: center;
			gap: 0.6rem;
		}
		.modern-card {
			border: none;
			box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
			border-radius: 0.75rem;
			overflow: hidden;
			background: #fff;
		}
		.btn-back {
			color: #6c757d;
			text-decoration: none;
			font-size: 0.9rem;
			font-weight: 500;
			display: inline-flex;
			align-items: center;
			gap: 0.35rem;
			margin-bottom: 1.25rem;
			transition: color 0.2s;
		}
		.btn-back:hover { color: #0d6efd; }
		.payment-summary {
			background: linear-gradient(145deg, #f8fafc 0%, #f1f5f9 100%);
			border: 1px solid #e2e8f0;
			border-radius: 0.75rem;
			padding: 1.5rem 1.75rem;
			margin-bottom: 1.5rem;
		}
		.payment-summary .summary-label {
			font-size: 0.8rem;
			text-transform: uppercase;
			letter-spacing: 0.05em;
			color: #64748b;
			font-weight: 600;
			margin-bottom: 0.25rem;
		}
		.payment-amount {
			font-size: 2.25rem;
			font-weight: 700;
			color: #0f172a;
			margin-bottom: 1rem;
			letter-spacing: -0.02em;
		}
		.payment-amount .currency { font-size: 1.25rem; color: #64748b; font-weight: 600; }
		.doc-list {
			list-style: none;
			padding: 0;
			margin: 0;
			background: #fff;
			border-radius: 0.5rem;
			border: 1px solid #e2e8f0;
			overflow: hidden;
		}
		.doc-list li {
			padding: 0.75rem 1rem;
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 0.75rem;
			border-bottom: 1px solid #f1f5f9;
			font-size: 0.95rem;
		}
		.doc-list li:last-child { border-bottom: none; }
		.doc-list li i { color: #0d6efd; width: 1.25rem; }
		.doc-list .doc-amount { font-weight: 600; color: #0f172a; }
		.payment-info-card {
			background: #fff;
			border: 1px solid #e2e8f0;
			border-radius: 0.75rem;
			padding: 1.25rem 1.5rem;
			margin-bottom: 1.5rem;
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
		}
		.payment-info-card h6 {
			font-size: 0.9rem;
			font-weight: 600;
			color: #475569;
			margin-bottom: 1rem;
			display: flex;
			align-items: center;
			gap: 0.5rem;
		}
		.payment-info-card h6 i { color: #0d6efd; }
		.payment-info-row {
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 0.6rem 0;
			border-bottom: 1px solid #f1f5f9;
			font-size: 0.9rem;
		}
		.payment-info-row:last-child { border-bottom: none; }
		.payment-info-label { color: #64748b; font-weight: 500; }
		.payment-info-value { color: #0f172a; font-weight: 500; }
		.pay-card {
			background: linear-gradient(145deg, #0d6efd 0%, #0a58ca 100%);
			border: none;
			border-radius: 0.75rem;
			padding: 1.75rem;
			box-shadow: 0 4px 14px rgba(13, 110, 253, 0.35);
			margin-bottom: 0;
		}
		.pay-card .card-body { padding: 0; }
		.pay-card .pay-title {
			color: rgba(255,255,255,0.95);
			font-size: 1rem;
			font-weight: 600;
			margin-bottom: 1rem;
		}
		.pay-card .razorpay-button {
			background: #fff !important;
			color: #0d6efd !important;
			font-weight: 600 !important;
			padding: 0.85rem 2rem !important;
			border-radius: 0.5rem !important;
			border: none !important;
			font-size: 1.1rem !important;
			box-shadow: 0 2px 8px rgba(0,0,0,0.15);
			transition: transform 0.2s, box-shadow 0.2s;
		}
		.pay-card .razorpay-button:hover {
			transform: translateY(-1px);
			box-shadow: 0 4px 12px rgba(0,0,0,0.2);
		}
	</style>

@section('content')
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 reissue-payment-page">
				<div class="modern-card">
					<div class="payment-header">
						<h4>
							<i class="fa-solid fa-credit-card"></i>
							Payment for Document Re-Print
						</h4>
					</div>
					<div class="card-body p-4">
						<a href="{{ route('student.document_reissue') }}" class="btn-back">
							<i class="fa-solid fa-arrow-left"></i> Back to Requests
						</a>

						@if(session('error'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<i class="fa-solid fa-exclamation-circle"></i> {{ session('error') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
							</div>
						@endif

						<div class="payment-summary">
							<div class="summary-label">One-time payment for {{ $requests->count() }} document(s)</div>
							<div class="payment-amount"><span class="currency">₹</span> {{ number_format($totalAmount, 2) }}</div>
							<ul class="doc-list">
								@foreach($requests as $req)
									<li>
										<span><i class="fa-solid fa-file-lines"></i> {{ $req->drr_document_type }}</span>
										<span class="doc-amount">₹ {{ number_format($req->drr_amount, 2) }}</span>
									</li>
								@endforeach
							</ul>
						</div>

						<div class="payment-info-card">
							<h6><i class="fa-solid fa-info-circle"></i> Payment Details</h6>
							<div class="payment-info-row">
								<span class="payment-info-label">Student Name</span>
								<span class="payment-info-value">{{ $student->sl_name ?? 'N/A' }}</span>
							</div>
							<div class="payment-info-row">
								<span class="payment-info-label">Registration No</span>
								<span class="payment-info-value">{{ $student->sl_reg_no ?? 'N/A' }}</span>
							</div>
							<div class="payment-info-row">
								<span class="payment-info-label">Order ID</span>
								<span class="payment-info-value"><strong>{{ $orderId }}</strong></span>
							</div>
							<div class="payment-info-row">
								<span class="payment-info-label">Total Amount</span>
								<span class="payment-info-value"><strong>₹ {{ number_format($totalAmount, 2) }}</strong></span>
							</div>
						</div>

						<div class="pay-card card">
							<div class="card-body text-center">
								<p class="pay-title">Complete payment in one go for all selected documents</p>
								<form action="{{ route('student.document_reissue.payment.group.process', $group_id) }}"
									method="POST" id="razorpayForm">
									@csrf
									<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
									<input type="hidden" name="razorpay_order_id" value="{{ $orderId }}">
									<input type="hidden" name="razorpay_signature" id="razorpay_signature">
									<script src="https://checkout.razorpay.com/v1/checkout.js"
										data-key="rzp_test_Yyokf06rQ4WTfd"
										data-amount="{{ (int) round($totalAmount * 100) }}" data-currency="INR"
										data-order_id="{{ $orderId }}"
										data-buttontext="Pay ₹ {{ number_format($totalAmount, 2) }}"
										data-name="Maya Computer Center"
										data-description="Document Re-Print ({{ $requests->count() }} item(s))"
										data-prefill.name="{{ $student->sl_name ?? '' }}"
										data-prefill.email="{{ $student->sl_email ?? '' }}"
										data-prefill.contact="{{ $student->sl_mobile_no ?? '' }}"
										data-theme.color="#ffffff"
										data-callback="handlePaymentSuccess"></script>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('custom-script')
	<script>
		function handlePaymentSuccess(response) {
			document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
			document.getElementById('razorpay_signature').value = response.razorpay_signature;
			document.getElementById('razorpayForm').submit();
		}
	</script>
@endpush
