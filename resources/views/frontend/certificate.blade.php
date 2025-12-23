@extends('frontend.layouts.master')
@section('title','Certificate Verification')
@push('custom-css')
<style>
.verification-page-wrapper {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 60vh;
    padding: 60px 0;
}
.verification-form-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
    padding: 50px 40px;
    margin-bottom: 40px;
}
.verification-form-card .section-title {
    text-align: center;
    margin-bottom: 35px;
}
.verification-form-card .section-title h2 {
    font-size: 32px;
    font-weight: 700;
    color: #000077;
    margin-bottom: 10px;
    position: relative;
    display: inline-block;
}
.verification-form-card .section-title h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #d00226 0%, #ff6b35 100%);
    border-radius: 2px;
}
.verification-form-card .section-title p {
    color: #666;
    font-size: 15px;
    margin-top: 20px;
    margin-bottom: 0;
}
.form-row-aligned {
    display: flex;
    align-items: flex-end;
    gap: 20px;
    flex-wrap: wrap;
}
.verification-form-group {
    position: relative;
    margin-bottom: 0;
    flex: 1;
    min-width: 200px;
    display: flex;
    flex-direction: column;
}
.verification-form-group label {
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
    display: block;
    font-size: 14px;
    white-space: nowrap;
}
.verification-form-group .input-wrapper {
    position: relative;
}
.verification-form-group .input-wrapper i {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: #000077;
    font-size: 18px;
    z-index: 1;
}
.verification-form-group .form-control {
    width: 100%;
    height: 55px;
    padding: 12px 15px 12px 50px;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    font-size: 15px;
    transition: all 0.3s ease;
    background: #fafafa;
}
.verification-form-group .form-control:focus {
    border-color: #000077;
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(0, 0, 119, 0.1);
    outline: none;
}
.verification-form-group input[type="date"].form-control {
    padding-right: 15px;
}
.verify-btn-wrapper {
    flex: 0 0 auto;
    min-width: 150px;
}
.verify-btn {
    width: 100%;
    height: 55px;
    background: linear-gradient(135deg, #000077 0%, #000099 100%);
    color: #ffffff;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}
.verify-btn:hover {
    background: linear-gradient(135deg, #000099 0%, #0000bb 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 119, 0.3);
}
.verify-btn i {
    font-size: 18px;
}
.verification-Certificate-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
    padding: 40px;
    margin-top: 30px;
    animation: fadeInUp 0.5s ease;
}
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.success-alert {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
    padding: 20px 25px;
    border-radius: 12px;
    margin-bottom: 30px;
    text-align: center;
    border-left: 5px solid #28a745;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}
.success-alert i {
    font-size: 28px;
    color: #28a745;
}
.error-alert {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    color: #721c24;
    padding: 20px 25px;
    border-radius: 12px;
    text-align: center;
    border-left: 5px solid #dc3545;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}
.error-alert i {
    font-size: 28px;
    color: #dc3545;
}
.student-info-wrapper {
    display: flex;
    gap: 30px;
    flex-wrap: wrap;
}
.student-photo-section {
    flex: 0 0 200px;
    text-align: center;
}
.student-photo {
    width: 200px;
    height: 240px;
    object-fit: cover;
    border-radius: 15px;
    border: 4px solid #000077;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}
.student-photo-placeholder {
    width: 200px;
    height: 240px;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    border: 4px solid #000077;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}
.student-photo-placeholder i {
    font-size: 80px;
    color: #ccc;
}
.student-details-section {
    flex: 1;
    min-width: 300px;
}
.info-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}
.info-table tr {
    border-bottom: 1px solid #f0f0f0;
}
.info-table tr:last-child {
    border-bottom: none;
}
.info-table th {
    width: 180px;
    background: linear-gradient(135deg, #000077 0%, #000099 100%);
    color: #ffffff;
    padding: 16px 20px;
    font-weight: 600;
    font-size: 14px;
    text-align: left;
    border-radius: 8px 0 0 8px;
}
.info-table td {
    padding: 16px 20px;
    font-size: 15px;
    color: #333;
    background: #f8f9fa;
    border-radius: 0 8px 8px 0;
}
.info-table td strong {
    color: #000077;
    font-size: 16px;
}
.verified-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: #ffffff;
    padding: 8px 20px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 14px;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}
.verified-badge i {
    font-size: 16px;
}
@media (max-width: 768px) {
    .verification-form-card {
        padding: 30px 20px;
    }
    .verification-form-card .section-title h2 {
        font-size: 24px;
    }
    .form-row-aligned {
        flex-direction: column;
        align-items: stretch;
    }
    .verification-form-group {
        margin-bottom: 20px;
        min-width: 100%;
    }
    .verify-btn-wrapper {
        min-width: 100%;
        margin-top: 10px;
    }
    .student-info-wrapper {
        flex-direction: column;
        align-items: center;
    }
    .student-photo-section {
        flex: 0 0 auto;
    }
    .info-table th {
        width: 120px;
        font-size: 13px;
        padding: 12px 15px;
    }
    .info-table td {
        font-size: 14px;
        padding: 12px 15px;
    }
}
</style>
@endpush
@section('content')
@php
	$data = DB::table('site_settings')->where('id','1')->first();
@endphp
<!-- Breadcrumbs Start -->
<div class="rs-breadcrumbs bg7 breadcrumbs-overlay" style="background-image: url({{ breadcrumb_image() }});">
    <div class="breadcrumbs-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="page-title">Certificate Verification</h1>
                    <ul>
                        <li>
                            <a class="active" href="{{url('/')}}">Home</a>
                        </li>
                        <li>Certificate Verification</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumbs End -->

<!-- Registration Verification Section Start -->
<div class="verification-page-wrapper">
    <div class="container">
        <div class="verification-form-card">
            <div class="section-title">
                <h2>Verify Your Certificate</h2>
                <p>Enter your Registration Number and Date of Birth to verify your certificate details</p>
            </div>
            
            <form action="{{ route('verification.certificate.view') }}" method="GET" id="certificateVerifyForm">
                <div class="form-row-aligned">
                    <div class="verification-form-group">
                        <label for="registration_no">
                            <i class="fa fa-id-card"></i> Registration Number
                        </label>
                        <div class="input-wrapper">
                            <i class="fa fa-id-card"></i>
                            <input type="text" name="registration_no" id="registration_no" 
                                class="form-control" 
                                placeholder="Enter your registration number" 
                                value="{{ request('registration_no') }}"
                                required>
                        </div>
                    </div>
                    <div class="verification-form-group">
                        <label for="dob">
                            <i class="fa fa-calendar"></i> Date of Birth
                        </label>
                        <div class="input-wrapper">
                            <i class="fa fa-calendar"></i>
                            <input type="date" name="dob" id="dob" 
                                class="form-control" 
                                value="{{ request('dob') }}"
                                required>
                        </div>
                    </div>
                    <div class="verify-btn-wrapper">
                        <button type="submit" class="verify-btn" id="verifyBtn">
                            <i class="fa fa-check-circle"></i>
                            <span>Verify Now</span>
                        </button>
                    </div>
                </div>
            </form>
            
            @if(session('error'))
                <div class="verification-Certificate-card" style="margin-top: 30px;">
                    <div class="error-alert">
                        <i class="fa fa-times-circle"></i>
                        <div>
                            <strong style="font-size: 18px;">Error!</strong>
                            <p style="margin: 5px 0 0 0; font-size: 14px;">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- Registration Verification Section End -->
@endsection