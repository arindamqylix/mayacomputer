@extends('frontend.layouts.master')
@section('title','I-Card Verification')
@push('custom-css')
<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;700&display=swap');
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
.verification-I-Card-card {
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
/* ID Card Styles */
.id-card-display-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px 0;
}

.id-card-container {
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
}

.id-card-inner {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border: 3px solid #000077;
    border-radius: 15px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    position: relative;
}

.id-card-header {
    background: linear-gradient(135deg, #000077 0%, #000099 100%);
    color: #ffffff;
    padding: 20px 15px;
    text-align: center;
    position: relative;
}

.id-card-logo {
    margin-bottom: 10px;
}

.id-card-logo img {
    width: 70px;
    height: auto;
    max-height: 70px;
    filter: brightness(0) invert(1);
}

.id-card-logo-placeholder {
    width: 70px;
    height: 70px;
    border: 2px solid rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 10px;
    font-weight: bold;
    color: rgba(255, 255, 255, 0.8);
    background: rgba(255, 255, 255, 0.1);
}

.id-card-header-text h2 {
    font-size: 18px;
    font-weight: 700;
    margin: 5px 0;
    letter-spacing: 1px;
}

.id-card-header-text h3 {
    font-size: 14px;
    font-weight: 600;
    margin: 3px 0;
    font-family: 'Noto Sans Devanagari', sans-serif;
}

.id-card-header-text p {
    font-size: 12px;
    color: #ffd700;
    font-weight: 600;
    margin: 8px 0 0 0;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.id-card-body {
    display: flex;
    padding: 20px 15px;
    gap: 20px;
    align-items: flex-start;
}

.id-card-left {
    flex: 0 0 120px;
}

.id-card-photo-container {
    width: 120px;
    height: 140px;
    border: 3px solid #000077;
    border-radius: 8px;
    overflow: hidden;
    background: #f5f5f5;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.id-card-photo-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.id-card-photo-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #999;
    font-size: 40px;
}

.id-card-right {
    flex: 1;
}

.id-card-details {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.id-card-detail-row {
    display: flex;
    flex-direction: column;
    gap: 4px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e0e0e0;
}

.id-card-detail-row:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.id-card-label {
    font-size: 11px;
    font-weight: 600;
    color: #000077;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.id-card-value {
    font-size: 14px;
    font-weight: 600;
    color: #333;
    word-break: break-word;
}

.id-card-footer {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    padding: 15px;
    background: #f8f9fa;
    border-top: 2px solid #e0e0e0;
}

.id-card-qr {
    flex: 0 0 60px;
}

.qr-placeholder {
    width: 60px;
    height: 60px;
    border: 2px solid #333;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 10px;
    background: #ffffff;
    color: #333;
}

.id-card-signature {
    flex: 1;
    text-align: right;
    padding-left: 15px;
}

.signature-line {
    width: 100px;
    height: 1px;
    background: #333;
    margin: 0 0 5px auto;
}

.id-card-signature p {
    font-size: 9px;
    color: #666;
    margin: 0;
    font-weight: 600;
}

/* Loading Indicator */
.loading-indicator {
    text-align: center;
    padding: 30px;
    display: none;
}
.loading-indicator i {
    font-size: 48px;
    color: #000077;
    animation: spin 1s linear infinite;
}
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
/* ID Card Styles from view_id_card.blade.php */
.icard-display-container {
    margin-top: 30px;
}
.id-card-wrapper {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 30px 20px;
    border-radius: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.print-container {
    background: white;
    border-radius: 15px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    padding: 25px;
    max-width: 420px;
    width: 100%;
}
.id-card {
    width: 100%;
    max-width: 370px;
    background: #ffffff;
    border-radius: 8px;
    overflow: hidden;
    position: relative;
    border: 2px solid #000077;
    margin: 0 auto;
}
.id-header {
    background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
    padding: 10px 15px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.id-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100px;
    height: 100%;
    background: linear-gradient(135deg, #000077 0%, #000099 100%);
    clip-path: ellipse(100% 100% at 0% 50%);
    z-index: 1;
}
.id-header-logo {
    width: 70px;
    height: 70px;
    margin: 0 auto 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 2;
    background: #ffffff;
    border-radius: 50%;
    padding: 5px;
}
.id-header-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    max-width: 100%;
    max-height: 100%;
}
.logo-placeholder {
    width: 100%;
    height: 100%;
    background: #f0f0f0;
    border: 2px solid #000077;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: #000077;
    font-size: 10px;
    text-align: center;
}
.id-header-text {
    text-align: center;
    position: relative;
    z-index: 2;
}
.id-header-text .card-type {
    font-size: 14px;
    color: #ffffff;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}
.id-body {
    padding: 15px;
    display: flex;
    gap: 15px;
    align-items: flex-start;
    background: #ffffff;
}
.photo-section {
    flex: 0 0 100px;
}
.photo-container {
    width: 100px;
    height: 120px;
    border: 3px solid #000077;
    border-radius: 6px;
    background: #f8f9fa;
    overflow: hidden;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
}
.photo-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.photo-placeholder {
    width: 100%;
    height: 100%;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
}
.photo-placeholder i {
    font-size: 35px;
}
.info-section {
    flex: 1;
    min-width: 0;
}
.student-name {
    font-size: 16px;
    font-weight: 700;
    color: #000077;
    margin: 0 0 10px 0;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    line-height: 1.2;
}
.student-info {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 4px;
    padding: 10px;
}
.info-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 6px 0;
    border-bottom: 1px solid #f3f4f6;
}
.info-row:last-child {
    border-bottom: none;
    padding-bottom: 0;
}
.info-label {
    font-weight: 600;
    color: #374151;
    display: flex;
    align-items: center;
    gap: 6px;
    flex: 0 0 85px;
    font-size: 10px;
}
.info-label i {
    color: #000077;
    font-size: 12px;
    width: 14px;
    text-align: center;
    flex-shrink: 0;
}
.info-value {
    font-weight: 600;
    color: #1f2937;
    text-align: right;
    flex: 1;
    word-break: break-word;
    font-size: 10px;
    line-height: 1.3;
}
.id-footer {
    background: linear-gradient(135deg, #000077 0%, #000099 50%, #ffd700 100%);
    padding: 10px 15px;
    position: relative;
    overflow: hidden;
}
.id-footer::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 15px;
    background: repeating-linear-gradient(
        45deg,
        #000077,
        #000077 8px,
        #ffd700 8px,
        #ffd700 16px
    );
    opacity: 0.3;
}
.signature-section {
    text-align: center;
    position: relative;
    z-index: 1;
}
.signature-line {
    width: 100px;
    height: 2px;
    background: #ffffff;
    margin: 0 auto 4px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}
.signature-label {
    font-size: 9px;
    font-weight: 600;
    color: #ffffff;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
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
    .id-body {
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }
    .photo-section {
        flex: 0 0 auto;
    }
    .photo-container {
        width: 110px;
        height: 140px;
    }
    .info-section {
        width: 100%;
    }
    .student-name {
        text-align: center;
        font-size: 18px;
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
                    <h1 class="page-title">I-Card Verification</h1>
                    <ul>
                        <li>
                            <a class="active" href="{{url('/')}}">Home</a>
                        </li>
                        <li>I-Card Verification</li>
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
                <h2>Verify Your I-Card</h2>
            </div>
            
            <form id="icardVerifyForm">
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

        <!-- Loading Indicator -->
        <div class="verification-I-Card-card" id="loadingIndicator" style="display: none;">
            <div class="loading-indicator">
                <i class="fa fa-spinner fa-spin"></i>
                <p style="margin-top: 15px; color: #000077; font-weight: 600;">Verifying I-Card...</p>
            </div>
        </div>

        <!-- Error Message Container -->
        <div id="errorMessage" style="display: none;"></div>

        <!-- I-Card Display Container -->
        <div id="icardContainer" style="display: none;"></div>
    </div>
</div>
<!-- Registration Verification Section End -->
@endsection

@push('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
<script>
$(document).ready(function() {
    $('#icardVerifyForm').on('submit', function(e) {
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
        $('#icardContainer').hide().empty();
        $('#errorMessage').hide().empty();
        
        // Show loading
        $('#loadingIndicator').show();
        $('#verifyBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> <span>Verifying...</span>');
        
        // AJAX request
        $.ajax({
            url: "{{ route('verification.icard.data') }}",
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
                    // Generate ID card HTML
                    var cardHtml = generateIdCard(response.data);
                    $('#icardContainer').html(cardHtml).show();
                    
                    // Scroll to card
                    $('html, body').animate({
                        scrollTop: $('#icardContainer').offset().top - 100
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
    
    function formatDateForDB(dateString) {
        if (!dateString) return '';
        var date = new Date(dateString);
        if (isNaN(date.getTime())) return dateString;
        return date.toISOString().split('T')[0]; // Returns YYYY-MM-DD
    }
    
    function showError(message) {
        var errorHtml = '<div class="verification-I-Card-card">' +
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
    
    function generateIdCard(data) {
        // Get site settings for logo - exactly matching view_id_card.blade.php
        @php
            $siteSettings = site_settings();
            $logoPath = null;
            $siteName = 'MAYA COMPUTER CENTER';
            $logoExists = false;
            
            if($siteSettings) {
                $logoPath = !empty($siteSettings->site_logo) ? $siteSettings->site_logo : null;
                $siteName = !empty($siteSettings->name) ? $siteSettings->name : 'MAYA COMPUTER CENTER';
                
                if($logoPath) {
                    $fullPath = public_path($logoPath);
                    $logoExists = file_exists($fullPath);
                }
            }
        @endphp
        var siteLogo = @if($logoPath) '{{ asset($logoPath) }}' @else null @endif;
        var logoExists = @if($logoExists) true @else false @endif;
        var siteName = '{{ $siteName }}';
        var logoAbbr = siteName.substring(0, 5);
        
        // Photo URL - matching original format
        var baseUrl = '{{ url("/") }}';
        var photoUrl = data.sl_photo ? baseUrl + '/storage/student/' + data.sl_photo : '';
        var photoHtml = '';
        if (photoUrl && data.sl_photo) {
            photoHtml = '<img src="' + photoUrl + '" alt="Student Photo" onerror="this.onerror=null; this.parentElement.innerHTML=\'<div class=\\\'photo-placeholder\\\'><i class=\\\'fas fa-user\\\'></i></div>\'">';
        } else {
            photoHtml = '<div class="photo-placeholder"><i class="fas fa-user"></i></div>';
        }
        
        // Format DOB - matching original format
        var dobFormatted = data.sl_dob ? data.sl_dob : 'N/A';
        
        // Center info - matching original format
        var centerInfo = (data.cl_center_name || data.cl_name || 'N/A') + (data.cl_code ? ' - ' + data.cl_code : '');
        
        // Logo HTML - matching original logic exactly
        var logoHtml = '';
        if (logoExists && siteLogo) {
            logoHtml = '<img src="' + siteLogo + '" alt="' + siteName + ' Logo" onerror="this.style.display=\'none\'; this.nextElementSibling.style.display=\'flex\';">' +
                '<div class="logo-placeholder" style="display: none;">' + logoAbbr + '</div>';
        } else {
            logoHtml = '<div class="logo-placeholder">' + logoAbbr + '</div>';
        }
        
        // Generate card HTML - matching exact structure from view_id_card.blade.php
        var cardHtml = '<div class="verification-I-Card-card">' +
            '<div class="success-alert">' +
            '<i class="fa fa-check-circle"></i>' +
            '<div>' +
            '<strong style="font-size: 18px;">I-Card Verified Successfully!</strong>' +
            '<p style="margin: 5px 0 0 0; font-size: 14px;">Your ID card details have been verified and displayed below.</p>' +
            '</div>' +
            '</div>' +
            '<div class="icard-display-container">' +
            '<div class="id-card-wrapper">' +
            '<div class="print-container">' +
            '<div class="id-card">' +
            '<div class="id-header">' +
            '<div class="id-header-logo">' + logoHtml + '</div>' +
            '<div class="id-header-text">' +
            '<div class="card-type">Student ID Card</div>' +
            '</div>' +
            '</div>' +
            '<div class="id-body">' +
            '<div class="info-section">' +
            '<div class="student-name">' + (data.sl_name ? data.sl_name.toUpperCase() : 'N/A') + '</div>' +
            '<div class="student-info">' +
            '<div class="info-row">' +
            '<div class="info-label">' +
            '<i class="fas fa-hashtag"></i>' +
            '<span>Reg. No:</span>' +
            '</div>' +
            '<div class="info-value">' + (data.sl_reg_no || 'N/A') + '</div>' +
            '</div>' +
            '<div class="info-row">' +
            '<div class="info-label">' +
            '<i class="fas fa-graduation-cap"></i>' +
            '<span>Course:</span>' +
            '</div>' +
            '<div class="info-value">' + (data.c_short_name || data.c_full_name || 'N/A') + '</div>' +
            '</div>';
        
        if (data.sl_dob) {
            cardHtml += '<div class="info-row">' +
                '<div class="info-label">' +
                '<i class="fas fa-birthday-cake"></i>' +
                '<span>DOB:</span>' +
                '</div>' +
                '<div class="info-value">' + dobFormatted + '</div>' +
                '</div>';
        }
        
        if (data.sl_mobile_no || data.cl_mobile) {
            cardHtml += '<div class="info-row">' +
                '<div class="info-label">' +
                '<i class="fas fa-phone"></i>' +
                '<span>Mobile:</span>' +
                '</div>' +
                '<div class="info-value">' + (data.sl_mobile_no || data.cl_mobile || 'N/A') + '</div>' +
                '</div>';
        }
        
        if (data.cl_center_name || data.cl_name) {
            cardHtml += '<div class="info-row">' +
                '<div class="info-label">' +
                '<i class="fas fa-building"></i>' +
                '<span>Center:</span>' +
                '</div>' +
                '<div class="info-value" style="font-size: 9px;">' + centerInfo + '</div>' +
                '</div>';
        }
        
        cardHtml += '</div>' + // closes student-info
            '</div>' + // closes info-section
            '<div class="photo-section">' +
            '<div class="photo-container">' + photoHtml + '</div>' +
            '</div>' + // closes photo-section
            '</div>' + // closes id-body
            '<div class="id-footer">' +
            '<div class="signature-section">' +
            '<div class="signature-line"></div>' +
            '<div class="signature-label">Authorized Signatory</div>' +
            '</div>' + // closes signature-section
            '</div>' + // closes id-footer
            '</div>' + // closes id-card
            '</div>' + // closes print-container
            '</div>' + // closes id-card-wrapper
            '</div>' + // closes icard-display-container
            '</div>'; // closes verification-I-Card-card
        
        return cardHtml;
    }
});
</script>
@endpush