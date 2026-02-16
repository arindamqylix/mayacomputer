@extends('frontend.layouts.master')
@section('title', $verified ? 'Certificate Verified - Maya Computer Center' : 'Certificate Verification - Maya Computer Center')

@push('custom-css')
<style>
    .verify-page-wrap {
        min-height: 70vh;
        padding: 50px 20px;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ec 100%);
    }
    .verify-card {
        max-width: 560px;
        margin: 0 auto;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        overflow: hidden;
        border: 1px solid #e8ecf0;
    }
    .verify-card-header {
        padding: 28px 24px;
        text-align: center;
    }
    .verify-card-header.verified {
        background: linear-gradient(135deg, #0d9488 0%, #059669 100%);
        color: #fff;
    }
    .verify-card-header.invalid {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        color: #fff;
    }
    .verify-card-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0 0 8px 0;
    }
    .verify-card-header p {
        margin: 0;
        font-size: 0.95rem;
        opacity: 0.95;
    }
    .verify-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 16px;
        border-radius: 50%;
        background: rgba(255,255,255,0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
    }
    .verify-card-body {
        padding: 24px 28px 32px;
    }
    .verify-detail-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.95rem;
    }
    .verify-detail-row:last-child { border-bottom: none; }
    .verify-detail-label {
        color: #64748b;
        font-weight: 500;
    }
    .verify-detail-value {
        color: #0f172a;
        font-weight: 600;
        text-align: right;
    }
    .verify-cta {
        text-align: center;
        margin-top: 24px;
    }
    .verify-cta a {
        display: inline-block;
        padding: 10px 24px;
        background: #0f172a;
        color: #fff;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .verify-cta a:hover { color: #fff; opacity: 0.9; }
</style>
@endpush

@section('content')
<div class="verify-page-wrap">
    <div class="verify-card">
        @if($verified)
            <div class="verify-card-header verified">
                <div class="verify-icon"><i class="fa fa-check"></i></div>
                <h1>Certificate Verified</h1>
                <p>This certificate has been verified by Maya Computer Center</p>
            </div>
            <div class="verify-card-body">
                <div class="verify-detail-row">
                    <span class="verify-detail-label">Certificate No.</span>
                    <span class="verify-detail-value">{{ $certificate->sc_certificate_number ?? $certificate_number }}</span>
                </div>
                <div class="verify-detail-row">
                    <span class="verify-detail-label">Student Name</span>
                    <span class="verify-detail-value">{{ strtoupper($certificate->sl_name ?? '') }}</span>
                </div>
                <div class="verify-detail-row">
                    <span class="verify-detail-label">Registration No.</span>
                    <span class="verify-detail-value">{{ $certificate->sl_reg_no ?? 'N/A' }}</span>
                </div>
                <div class="verify-detail-row">
                    <span class="verify-detail-label">Course</span>
                    <span class="verify-detail-value">{{ strtoupper($certificate->c_full_name ?? $certificate->c_short_name ?? '') }}</span>
                </div>
                <div class="verify-detail-row">
                    <span class="verify-detail-label">Grade / Percentage</span>
                    <span class="verify-detail-value">{{ $certificate->sr_grade ?? 'N/A' }} ({{ $certificate->sr_percentage ?? 'N/A' }}%)</span>
                </div>
                <div class="verify-detail-row">
                    <span class="verify-detail-label">Center</span>
                    <span class="verify-detail-value">{{ $certificate->cl_center_name ?? 'N/A' }} ({{ $certificate->cl_code ?? '' }})</span>
                </div>
                @if(!empty($certificate->sc_issue_date))
                <div class="verify-detail-row">
                    <span class="verify-detail-label">Date of Issue</span>
                    <span class="verify-detail-value">{{ \Carbon\Carbon::parse($certificate->sc_issue_date)->format('d-M-Y') }}</span>
                </div>
                @endif
                <div class="verify-cta">
                    <a href="{{ route('verification.certificate') }}">Verify another certificate</a>
                </div>
            </div>
        @else
            <div class="verify-card-header invalid">
                <div class="verify-icon"><i class="fa fa-times"></i></div>
                <h1>Certificate Not Found</h1>
                <p>This certificate number could not be verified</p>
            </div>
            <div class="verify-card-body">
                <div class="verify-detail-row">
                    <span class="verify-detail-label">Certificate No. entered</span>
                    <span class="verify-detail-value">{{ $certificate_number }}</span>
                </div>
                <p class="mb-0 mt-3 text-muted small">The certificate number may be incorrect, or the certificate may not have been issued yet. Please check the number or contact the center.</p>
                <div class="verify-cta">
                    <a href="{{ route('verification.certificate') }}">Try verification with Reg. No. & DOB</a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
