@extends('student.layouts.base')
@section('title', 'Payment for Document Re-Print')
@push('custom-css')
	<style type="text/css">
		.payment-header {
			background: linear-gradient(135deg, #10b981 0%, #059669 100%);
			border: none;
			padding: 1.5rem;
			border-radius: 0.5rem 0.5rem 0 0;
		}

		.payment-header h4 {
			color: white;
			margin: 0;
			font-weight: 600;
			font-size: 1.5rem;
			display: flex;
			align-items: center;
			gap: 0.75rem;
		}

		.modern-card {
			border: none;
			box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
			border-radius: 0.5rem;
			overflow: hidden;
		}

		.payment-summary {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			border-radius: 0.5rem;
			padding: 2rem;
			margin-bottom: 2rem;
		}

		.payment-amount {
			font-size: 3rem;
			font-weight: 700;
			margin: 1rem 0;
		}

		.btn-back {
			background: #6c757d;
			color: white;
			padding: 0.75rem 1.5rem;
			border-radius: 0.5rem;
			font-weight: 600;
			text-decoration: none;
			margin-bottom: 1rem;
			display: inline-block;
		}

		.btn-back:hover {
			background: #5a6268;
			color: white;
		}

		.payment-info-card {
			background: #f8f9fa;
			border-radius: 0.5rem;
			padding: 1.5rem;
			margin-bottom: 2rem;
			border-left: 4px solid #667eea;
		}

		.payment-info-row {
			display: flex;
			justify-content: space-between;
			padding: 0.5rem 0;
			border-bottom: 1px solid #e9ecef;
		}

		.payment-info-row:last-child {
			border-bottom: none;
		}

		.payment-info-label {
			font-weight: 600;
			color: #495057;
		}

		.payment-info-value {
			color: #212529;
		}
	</style>
@endpush

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
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

						<div class="payment-summary text-center">
							<h5>Request ID: #{{ $reissueRequest->drr_id }}</h5>
							<div class="payment-amount">₹ {{ number_format($reissueRequest->drr_amount, 2) }}</div>
							<p class="mb-0">
								@php
									$dt = strtolower($reissueRequest->drr_document_type ?? '');
									$icon = 'id-card';
									if (str_contains($dt, 'certificate')) $icon = 'certificate';
									elseif (str_contains($dt, 'marksheet') || str_contains($dt, 'result')) $icon = 'file-lines';
								@endphp
								<i class="fa-solid fa-{{ $icon }}"></i> {{ $reissueRequest->drr_document_type }} Re-Print
							</p>
						</div>

						<div class="payment-info-card">
							<h6 class="mb-3"><i class="fa-solid fa-info-circle"></i> Payment Details</h6>
							<div class="payment-info-row">
								<span class="payment-info-label">Student Name:</span>
								<span class="payment-info-value">{{ $student->sl_name ?? 'N/A' }}</span>
							</div>
							<div class="payment-info-row">
								<span class="payment-info-label">Registration No:</span>
								<span class="payment-info-value">{{ $student->sl_reg_no ?? 'N/A' }}</span>
							</div>
							<div class="payment-info-row">
								<span class="payment-info-label">Order ID:</span>
								<span class="payment-info-value"><strong>{{ $orderId }}</strong></span>
							</div>
							<div class="payment-info-row">
								<span class="payment-info-label">Amount:</span>
								<span class="payment-info-value"><strong>₹
										{{ number_format($reissueRequest->drr_amount, 2) }}</strong></span>
							</div>
						</div>

						<div class="row">
							<div class="col-md-8 mx-auto">
								<div class="card">
									<div class="card-body text-center">
										<h5 class="card-title mb-4">Complete Payment</h5>

										<form
											action="{{ route('student.document_reissue.payment.process', $reissueRequest->drr_id) }}"
											method="POST" id="razorpayForm">
											@csrf
											<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
											<input type="hidden" name="razorpay_order_id" value="{{ $orderId }}">
											<input type="hidden" name="razorpay_signature" id="razorpay_signature">

											<script src="https://checkout.razorpay.com/v1/checkout.js"
												data-key="rzp_test_Yyokf06rQ4WTfd"
												data-amount="{{ $reissueRequest->drr_amount * 100 }}" data-currency="INR"
												data-order_id="{{ $orderId }}"
												data-buttontext="Pay ₹ {{ number_format($reissueRequest->drr_amount, 2) }}"
												data-name="Maya Computer Center"
												data-description="Document Re-Print - {{ $reissueRequest->drr_document_type }}"
												data-prefill.name="{{ $student->sl_name ?? '' }}"
												data-prefill.email="{{ $student->sl_email ?? '' }}"
												data-prefill.contact="{{ $student->sl_mobile_no ?? '' }}"
												data-theme.color="#667eea" data-callback="handlePaymentSuccess"
												data-prefill.notes.request_id="{{ $reissueRequest->drr_id }}"></script>
										</form>
									</div>
								</div>
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
			// Set the payment details in hidden fields
			document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
			document.getElementById('razorpay_signature').value = response.razorpay_signature;

			// Submit the form
			document.getElementById('razorpayForm').submit();
		}
	</script>
@endpush