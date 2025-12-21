@extends('frontend.layouts.master')
@section('title','Registration Verification')
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
.verification-result-card {
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
                    <h1 class="page-title">Registration Verification</h1>
                    <ul>
                        <li>
                            <a class="active" href="{{url('/')}}">Home</a>
                        </li>
                        <li>Registration Verification</li>
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
                <h2>Verify Your Registration</h2>
                <p>Enter your Registration Number and Date of Birth to verify your registration details</p>
            </div>
            
            <form id="registrationVerifyForm">
                @csrf
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
        </div>

        <!-- Registration Card Display Area -->
        <div id="registrationCardContainer" style="display: none; margin-top: 40px;"></div>
        
        <!-- Loading Indicator -->
        <div id="loadingIndicator" style="display: none; text-align: center; padding: 40px;">
            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p style="margin-top: 20px; color: #666;">Fetching registration details...</p>
        </div>
        
        <!-- Error Message -->
        <div id="errorMessage" style="display: none;"></div>
    </div>
</div>
<!-- Registration Verification Section End -->
@endsection

@push('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#registrationVerifyForm').on('submit', function(e) {
        e.preventDefault();
        
        var registrationNo = $('#registration_no').val();
        var dob = $('#dob').val();
        
        if (!registrationNo || !dob) {
            alert('Please enter both Registration Number and Date of Birth');
            return;
        }
        
        // Ensure date is in YYYY-MM-DD format (matching database format)
        dob = formatDateForDB(dob);
        
        if (!dob) {
            alert('Please enter a valid date of birth');
            return;
        }
        
        // Hide previous results
        $('#registrationCardContainer').hide().empty();
        $('#errorMessage').hide().empty();
        
        // Show loading
        $('#loadingIndicator').show();
        $('#verifyBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Verifying...');
        
        // AJAX request
        $.ajax({
            url: "{{ route('verification.registration.card.data') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                registration_no: registrationNo,
                dob: dob
            },
            dataType: 'json',
            success: function(response) {
                $('#loadingIndicator').hide();
                $('#verifyBtn').prop('disabled', false).html('<i class="fa fa-check-circle"></i> <span>Verify Now</span>');
                
                if (response.success && response.data) {
                    // Store original DOB in YYYY-MM-DD format for PDF download
                    var originalDob = formatDateForDB($('#dob').val());
                    
                    // Generate registration card HTML
                    var cardHtml = generateRegistrationCard(response.data, originalDob);
                    $('#registrationCardContainer').html(cardHtml).show();
                    
                    // Bind PDF download button click event
                    $(document).off('click', '.btn-download-pdf').on('click', '.btn-download-pdf', function(e) {
                        e.preventDefault();
                        var regNo = $(this).data('reg-no');
                        var dob = $(this).data('dob'); // This is already in YYYY-MM-DD format
                        downloadRegistrationCardPDF(regNo, dob);
                    });
                    
                    // Scroll to card
                    $('html, body').animate({
                        scrollTop: $('#registrationCardContainer').offset().top - 100
                    }, 500);
                } else {
                    showError(response.message || 'No record found');
                }
            },
            error: function(xhr) {
                $('#loadingIndicator').hide();
                $('#verifyBtn').prop('disabled', false).html('<i class="fa fa-check-circle"></i> <span>Verify Now</span>');
                
                var errorMsg = 'An error occurred. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                showError(errorMsg);
            }
        });
    });
    
    function showError(message) {
        var errorHtml = '<div class="verification-result-card">' +
            '<div class="error-alert">' +
            '<i class="fa fa-times-circle"></i>' +
            '<div>' +
            '<strong style="font-size: 18px;">Error!</strong>' +
            '<p style="margin: 5px 0 0 0; font-size: 14px;">' + message + '</p>' +
            '</div>' +
            '</div>' +
            '</div>';
        $('#errorMessage').html(errorHtml).show();
    }
    
    function generateRegistrationCard(data, originalDob) {
        // Format dates for display
        var dob = formatDate(data.sl_dob);
        var validFrom = formatDate(data.created_at);
        var validTill = formatDate(addYear(data.created_at));
        var issueDate = formatDate(data.created_at);
        
        // Use original DOB in YYYY-MM-DD format for PDF download button
        var dbDob = originalDob || data.sl_dob || '';
        
        // Get site settings for logo and company info
        @php
            $siteSettings = site_settings();
            $siteLogo = $siteSettings && !empty($siteSettings->site_logo) ? asset($siteSettings->site_logo) : asset('logo.png');
            $siteName = $siteSettings && !empty($siteSettings->name) ? $siteSettings->name : 'MAYA COMPUTER CENTER';
            $siteEmail = $siteSettings && !empty($siteSettings->email) ? $siteSettings->email : 'mccsiswar@gmail.com';
            $sitePhone = $siteSettings && !empty($siteSettings->phone) ? $siteSettings->phone : '+91 8825148127';
        @endphp
        var siteLogo = '{{ $siteLogo }}';
        var siteName = '{{ $siteName }}';
        var siteEmail = '{{ $siteEmail }}';
        var sitePhone = '{{ $sitePhone }}';
        var cinNo = data.cl_cin_no || 'U47411DL2023PTC422329';
        
        // Photo URL
        var baseUrl = '{{ url("/") }}';
        var photoUrl = data.sl_photo ? baseUrl + '/' + data.sl_photo : '';
        var photoHtml = photoUrl && data.sl_photo
            ? '<img src="' + photoUrl + '" alt="Student Photo" onerror="this.parentElement.innerHTML=\'<span>Photo</span>\'">' 
            : '<span>Photo</span>';
        
        var cardHtml = `
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;700&display=swap');
                .reg-card-container {
                    width: 100%;
                    max-width: 8in;
                    margin: 0 auto;
                    background: white;
                    box-shadow: 0 0 15px rgba(0,0,0,0.2);
                    position: relative;
                    overflow: hidden;
                    margin-bottom: 40px;
                }
                .reg-card {
                    width: 100%;
                    position: relative;
                    padding: 12px;
                }
                .reg-outer-border {
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    border: 3px dashed #dc2626;
                    border-radius: 2px;
                }
                .reg-inner-border {
                    position: absolute;
                    top: 6px;
                    left: 6px;
                    right: 6px;
                    bottom: 6px;
                    border: 2px solid #1e3a8a;
                    border-radius: 2px;
                }
                .reg-content {
                    position: relative;
                    z-index: 1;
                    min-height: 5.5in;
                }
                .reg-header {
                    display: table;
                    width: 100%;
                    border-bottom: 2px solid #1e3a8a;
                    padding-bottom: 8px;
                    margin-bottom: 8px;
                }
                .reg-header-left, .reg-header-center, .reg-header-right {
                    display: table-cell;
                    vertical-align: middle;
                }
                .reg-header-left {
                    width: 70px;
                }
                .reg-header-left img {
                    width: 60px;
                    height: auto;
                }
                .reg-logo-placeholder {
                    width: 60px;
                    height: 60px;
                    border: 1px solid #1e3a8a;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 8px;
                    font-weight: bold;
                    color: #1e3a8a;
                    background: #f0f7ff;
                }
                .reg-header-center {
                    text-align: center;
                }
                .reg-main-title {
                    color: #1e3a8a;
                    font-size: 22px;
                    font-weight: bold;
                    letter-spacing: 1px;
                    margin-bottom: 2px;
                }
                .reg-hindi-title {
                    color: #1e3a8a;
                    font-size: 16px;
                    font-weight: bold;
                    font-family: 'Noto Sans Devanagari', sans-serif;
                    margin-bottom: 4px;
                }
                .reg-info {
                    font-size: 9px;
                    color: #333;
                    font-weight: bold;
                }
                .reg-iso-cert {
                    color: #dc2626;
                    font-size: 10px;
                    font-weight: bold;
                }
                .reg-header-right {
                    width: 70px;
                    text-align: center;
                }
                .reg-qr-box {
                    width: 55px;
                    height: 55px;
                    border: 1px solid #333;
                    margin: 0 auto;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-weight: bold;
                    font-size: 10px;
                    background: #fff;
                }
                .reg-title-bar {
                    background: #1e3a8a;
                    color: white;
                    text-align: center;
                    padding: 6px;
                    margin-bottom: 10px;
                }
                .reg-title-bar h2 {
                    font-size: 16px;
                    font-weight: bold;
                    letter-spacing: 2px;
                    margin: 0;
                }
                .reg-main-body {
                    display: table;
                    width: 100%;
                }
                .reg-left-section {
                    display: table-cell;
                    vertical-align: top;
                    width: 65%;
                    padding-right: 15px;
                }
                .reg-right-section {
                    display: table-cell;
                    vertical-align: top;
                    width: 35%;
                }
                .reg-info-table {
                    width: 100%;
                    border-collapse: collapse;
                }
                .reg-info-table tr {
                    border-bottom: 1px solid #e0e0e0;
                }
                .reg-info-table td {
                    padding: 5px 8px;
                    font-size: 11px;
                    vertical-align: top;
                }
                .reg-info-table .label {
                    width: 120px;
                    font-weight: bold;
                    color: #1e3a8a;
                    background: #f0f7ff;
                }
                .reg-info-table .value {
                    font-weight: 600;
                    color: #333;
                }
                .reg-info-table .colon {
                    width: 10px;
                    text-align: center;
                }
                .reg-photo-box {
                    width: 120px;
                    margin: 0 auto 10px;
                }
                .reg-photo-frame {
                    width: 110px;
                    height: 130px;
                    border: 2px solid #1e3a8a;
                    background: #f5f5f5;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto 8px;
                    color: #999;
                    font-size: 11px;
                    overflow: hidden;
                }
                .reg-photo-frame img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
                .reg-student-sign {
                    text-align: center;
                }
                .reg-sign-line {
                    border-bottom: 1px solid #333;
                    width: 100px;
                    margin: 0 auto 3px;
                }
                .reg-sign-label {
                    font-size: 8px;
                    color: #666;
                }
                .reg-validity-box {
                    background: #fef3c7;
                    border: 1px solid #f59e0b;
                    padding: 6px;
                    margin-top: 8px;
                    text-align: center;
                    border-radius: 4px;
                }
                .reg-validity-box p {
                    font-size: 10px;
                    margin: 2px 0;
                }
                .reg-validity-box .date {
                    font-weight: bold;
                    color: #1e3a8a;
                }
                .reg-footer {
                    margin-top: 10px;
                }
                .reg-footer-logos {
                    display: table;
                    width: 100%;
                    margin-bottom: 8px;
                }
                .reg-footer-logos td {
                    text-align: center;
                    vertical-align: middle;
                    padding: 0 5px;
                }
                .reg-logo-small {
                    width: 45px;
                    height: 30px;
                    border: 1px solid #ddd;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 6px;
                    font-weight: bold;
                    color: #666;
                    background: #f9f9f9;
                }
                .reg-footer-bottom {
                    display: table;
                    width: 100%;
                    border-top: 1px solid #1e3a8a;
                    padding-top: 8px;
                }
                .reg-footer-bottom td {
                    vertical-align: bottom;
                    padding: 0 5px;
                }
                .reg-footer-item {
                    text-align: center;
                }
                .reg-footer-item .label {
                    font-size: 9px;
                    font-weight: bold;
                    margin-bottom: 3px;
                }
                .reg-footer-item .value {
                    font-size: 10px;
                    font-weight: bold;
                }
                .reg-sig-space {
                    width: 80px;
                    height: 25px;
                    border-bottom: 1px solid #333;
                    margin: 0 auto 3px;
                }
                .reg-sig-label {
                    font-size: 8px;
                    font-weight: bold;
                }
                .reg-company-info {
                    text-align: center;
                    font-size: 8px;
                    color: #666;
                    margin-top: 5px;
                }
                .reg-company-info .highlight {
                    color: #1e3a8a;
                    font-weight: bold;
                }
                .reg-card-actions {
                    text-align: center;
                    margin-top: 20px;
                    margin-bottom: 20px;
                }
                .btn-download-pdf {
                    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
                    color: white;
                    border: none;
                    padding: 12px 30px;
                    border-radius: 8px;
                    font-size: 16px;
                    font-weight: 600;
                    cursor: pointer;
                    box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
                    transition: all 0.3s ease;
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                }
                .btn-download-pdf:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 6px 20px rgba(220, 38, 38, 0.4);
                }
                .btn-download-pdf i {
                    font-size: 18px;
                }
                @media print {
                    .reg-card-container {
                        box-shadow: none;
                    }
                    .reg-outer-border, .reg-inner-border, .reg-title-bar {
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }
                    .reg-card-actions {
                        display: none;
                    }
                }
            </style>
            <div class="reg-card-container" id="registrationCard">
                <div class="reg-card-actions">
                    <button class="btn-download-pdf" data-reg-no="${data.sl_reg_no || 'N/A'}" data-dob="${dbDob}">
                        <i class="fa fa-download"></i> Download PDF
                    </button>
                </div>
                <div class="reg-card">
                    <div class="reg-outer-border"></div>
                    <div class="reg-inner-border"></div>
                    <div class="reg-content">
                        <div class="reg-header">
                            <div class="reg-header-left">
                                <img src="${siteLogo}" alt="Logo" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="reg-logo-placeholder" style="display: none;">LOGO</div>
                            </div>
                            <div class="reg-header-center">
                                <h1 class="reg-main-title">${siteName}</h1>
                                <h2 class="reg-hindi-title">माया कम्प्यूटर सेंटर</h2>
                                <p class="reg-info">Reg. Under Company Act 2013, MCA, Govt. of India</p>
                                <p class="reg-iso-cert">An ISO 9001:2015 Certified</p>
                            </div>
                            <div class="reg-header-right">
                                <div class="reg-qr-box">QR</div>
                            </div>
                        </div>
                        <div class="reg-title-bar">
                            <h2>REGISTRATION CARD</h2>
                        </div>
                        <div class="reg-main-body">
                            <div class="reg-left-section">
                                <table class="reg-info-table">
                                    <tr>
                                        <td class="label">Registration No.</td>
                                        <td class="colon">:</td>
                                        <td class="value">${data.sl_reg_no || 'N/A'}</td>
                                    </tr>
                                    <tr>
                                        <td class="label">Student Name</td>
                                        <td class="colon">:</td>
                                        <td class="value">${(data.sl_name || 'N/A').toUpperCase()}</td>
                                    </tr>
                                    <tr>
                                        <td class="label">Father's Name</td>
                                        <td class="colon">:</td>
                                        <td class="value">${(data.sl_father_name || 'N/A').toUpperCase()}</td>
                                    </tr>
                                    <tr>
                                        <td class="label">Mother's Name</td>
                                        <td class="colon">:</td>
                                        <td class="value">${(data.sl_mother_name || 'N/A').toUpperCase()}</td>
                                    </tr>
                                    <tr>
                                        <td class="label">Date of Birth</td>
                                        <td class="colon">:</td>
                                        <td class="value">${dob}</td>
                                    </tr>
                                    <tr>
                                        <td class="label">Gender</td>
                                        <td class="colon">:</td>
                                        <td class="value">${(data.sl_sex || 'N/A').charAt(0).toUpperCase() + (data.sl_sex || '').slice(1)}</td>
                                    </tr>
                                    <tr>
                                        <td class="label">Course Name</td>
                                        <td class="colon">:</td>
                                        <td class="value">${(data.c_full_name || 'N/A').toUpperCase()}</td>
                                    </tr>
                                    <tr>
                                        <td class="label">Duration</td>
                                        <td class="colon">:</td>
                                        <td class="value">${formatDuration(data.c_duration)}</td>
                                    </tr>
                                    <tr>
                                        <td class="label">Center Code</td>
                                        <td class="colon">:</td>
                                        <td class="value">${data.cl_code || 'N/A'}</td>
                                    </tr>
                                    <tr>
                                        <td class="label">Center Name</td>
                                        <td class="colon">:</td>
                                        <td class="value">${data.cl_center_name || data.cl_name || 'N/A'}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="reg-right-section">
                                <div class="reg-photo-box">
                                    <div class="reg-photo-frame">
                                        ${photoHtml}
                                    </div>
                                    <div class="reg-student-sign">
                                        <div class="reg-sign-line"></div>
                                        <p class="reg-sign-label">Student's Signature</p>
                                    </div>
                                </div>
                                <div class="reg-validity-box">
                                    <p><strong>Valid From:</strong></p>
                                    <p class="date">${validFrom}</p>
                                    <p><strong>Valid Till:</strong></p>
                                    <p class="date">${validTill}</p>
                                </div>
                            </div>
                        </div>
                        <div class="reg-footer">
                            <table class="reg-footer-logos">
                                <tr>
                                    <td><div class="reg-logo-small">SKILL INDIA</div></td>
                                    <td><div class="reg-logo-small">MINISTRY</div></td>
                                    <td><div class="reg-logo-small">MSME</div></td>
                                    <td><div class="reg-logo-small">ISO</div></td>
                                    <td><div class="reg-logo-small">STARTUP</div></td>
                                    <td><div class="reg-logo-small">NCS</div></td>
                                </tr>
                            </table>
                            <table class="reg-footer-bottom">
                                <tr>
                                    <td width="25%">
                                        <div class="reg-footer-item">
                                            <p class="label">Date of Issue</p>
                                            <p class="value">${issueDate}</p>
                                        </div>
                                    </td>
                                    <td width="25%">
                                        <div class="reg-footer-item">
                                            <div class="reg-sig-space"></div>
                                            <p class="reg-sig-label">Center Head</p>
                                        </div>
                                    </td>
                                    <td width="25%">
                                        <div class="reg-footer-item">
                                            <div class="reg-sig-space"></div>
                                            <p class="reg-sig-label">Exam Controller</p>
                                        </div>
                                    </td>
                                    <td width="25%">
                                        <div class="reg-footer-item">
                                            <div class="reg-sig-space"></div>
                                            <p class="reg-sig-label">Authorized Signatory</p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="reg-company-info">
                                <span class="highlight">CIN: ${cinNo}</span> | 
                                <span class="highlight">www.mayacomputercenter.in</span> | 
                                Email: ${siteEmail} | Phone: ${sitePhone}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        return cardHtml;
    }
    
    // PDF download function - globally accessible
    function downloadRegistrationCardPDF(registrationNo, dob) {
        // Get the button that was clicked
        var btn = $('.btn-download-pdf');
        var originalHtml = btn.html();
        btn.prop('disabled', true);
        btn.html('<i class="fa fa-spinner fa-spin"></i> Generating PDF...');
        
        // Make AJAX request to generate PDF
        $.ajax({
            url: "{{ route('verification.registration.card.pdf') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                registration_no: registrationNo,
                dob: dob
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data) {
                // Create blob link to download
                var blob = new Blob([data], { type: 'application/pdf' });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'Registration_Card_' + registrationNo.replace(/\//g, '_') + '.pdf';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                window.URL.revokeObjectURL(link.href);
                
                // Reset button
                btn.prop('disabled', false);
                btn.html(originalHtml);
            },
            error: function(xhr) {
                alert('Error generating PDF. Please try again.');
                btn.prop('disabled', false);
                btn.html(originalHtml);
            }
        });
    }
    
    // Make function globally accessible
    window.downloadRegistrationCardPDF = downloadRegistrationCardPDF;
    
    // Format date to YYYY-MM-DD for database (matches DB column format)
    function formatDateForDB(dateString) {
        if (!dateString) return null;
        
        // If already in YYYY-MM-DD format, return as is
        if (/^\d{4}-\d{2}-\d{2}$/.test(dateString)) {
            return dateString;
        }
        
        // Try to parse and format the date
        var date = new Date(dateString);
        if (isNaN(date.getTime())) return null;
        
        var year = date.getFullYear();
        var month = String(date.getMonth() + 1).padStart(2, '0');
        var day = String(date.getDate()).padStart(2, '0');
        
        return year + '-' + month + '-' + day;
    }
    
    // Format date for display (e.g., 05-Oct-2000)
    function formatDate(dateString) {
        if (!dateString) return 'N/A';
        var date = new Date(dateString);
        if (isNaN(date.getTime())) return dateString;
        
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var day = String(date.getDate()).padStart(2, '0');
        var month = months[date.getMonth()];
        var year = date.getFullYear();
        
        return day + '-' + month + '-' + year;
    }
    
    function addYear(dateString) {
        if (!dateString) return null;
        var date = new Date(dateString);
        if (isNaN(date.getTime())) return null;
        date.setFullYear(date.getFullYear() + 1);
        return date.toISOString();
    }
    
    function formatDuration(duration) {
        if (!duration) return 'N/A';
        if (duration >= 12) {
            var years = duration / 12;
            return years + (years == 1 ? ' Year' : ' Years');
        } else {
            return duration + (duration == 1 ? ' Month' : ' Months');
        }
    }
});
</script>
@endpush