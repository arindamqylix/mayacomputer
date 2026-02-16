@extends('frontend.layouts.master')
@section('title', $verified ? 'Result / Marksheet Verified - Maya Computer Center' : 'Result Verification - Maya Computer Center')

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
                <h1>Result / Marksheet Verified</h1>
                <p>This result has been verified by Maya Computer Center</p>
            </div>
            <div class="verify-card-body">
                <div class="verify-detail-row">
                    <span class="verify-detail-label">Registration No.</span>
                    <span class="verify-detail-value">{{ $data->sl_reg_no ?? $reg_no }}</span>
                </div>
                <div class="verify-detail-row">
                    <span class="verify-detail-label">Student Name</span>
                    <span class="verify-detail-value">{{ strtoupper($data->sl_name ?? '') }}</span>
                </div>
                <div class="verify-detail-row">
                    <span class="verify-detail-label">Course</span>
                    <span class="verify-detail-value">{{ strtoupper($data->c_full_name ?? $data->c_short_name ?? '') }}</span>
                </div>
                <div class="verify-detail-row">
                    <span class="verify-detail-label">Percentage</span>
                    <span class="verify-detail-value">{{ $data->sr_percentage ?? 'N/A' }}%</span>
                </div>
                <div class="verify-detail-row">
                    <span class="verify-detail-label">Grade</span>
                    <span class="verify-detail-value">{{ $data->sr_grade ?? 'N/A' }}</span>
                </div>
                <div class="verify-detail-row">
                    <span class="verify-detail-label">Center</span>
                    <span class="verify-detail-value">{{ $data->cl_center_name ?? 'N/A' }} ({{ $data->cl_code ?? '' }})</span>
                </div>
                <div class="verify-cta">
                    <a href="{{ route('verification.result') }}">Verify another result</a>
                </div>
            </div>
        @else
            <div class="verify-card-header invalid">
                <div class="verify-icon"><i class="fa fa-times"></i></div>
                <h1>Result Not Found</h1>
                <p>This registration number could not be verified</p>
            </div>
            <div class="verify-card-body">
                <div class="verify-detail-row">
                    <span class="verify-detail-label">Registration No. scanned</span>
                    <span class="verify-detail-value">{{ $reg_no }}</span>
                </div>
                <p class="mb-0 mt-3 text-muted small">The registration number may be incorrect, or the result may not be available yet. Please check or use the verification page with Reg. No. and DOB.</p>
                <div class="verify-cta">
                    <a href="{{ route('verification.result') }}">Try verification with Reg. No. & DOB</a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
