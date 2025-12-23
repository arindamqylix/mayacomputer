@extends('frontend.layouts.master')
@section('title','Result Verification')
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
/* Marksheet Styles */
.marksheet-header {
    background: linear-gradient(90deg, #007bff, #00c6ff);
    color: #fff;
    padding: 15px;
    border-radius: 10px 10px 0 0;
}
.marksheet-header h4 {
    margin: 0;
    font-weight: bold;
    letter-spacing: 1px;
}
.student-photo {
    border: 2px solid #ddd;
    border-radius: 6px;
    padding: 3px;
    background: #fff;
}
.marksheet-card {
    background: #ffffff;
    border-radius: 0 0 10px 10px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin-top: 0;
}
.marksheet-card .table th {
    background: #f8f9fa;
    font-weight: 600;
}
.grade-box {
    font-size: 16px;
    font-weight: 600;
    background: #17a2b8;
    color: #fff;
    padding: 6px 15px;
    border-radius: 6px;
}
.note-section {
    font-size: 14px;
    background: #fefefe;
    border-left: 4px solid #007bff;
    padding: 15px;
    margin-top: 15px;
    border-radius: 5px;
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
    .marksheet-card {
        padding: 20px 15px;
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
                    <h1 class="page-title">Result Verification</h1>
                    <ul>
                        <li>
                            <a class="active" href="{{url('/')}}">Home</a>
                        </li>
                        <li>Result Verification</li>
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
                <h2>Verify Your Result</h2>
            </div>
            
            <form id="resultVerifyForm">
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
        </div>

        <!-- Loading Indicator -->
        <div class="verification-result-card" id="loadingIndicator" style="display: none;">
            <div style="text-align: center; padding: 30px;">
                <i class="fa fa-spinner fa-spin" style="font-size: 48px; color: #000077;"></i>
                <p style="margin-top: 15px; color: #000077; font-weight: 600;">Verifying Result...</p>
            </div>
        </div>

        <!-- Error Message Container -->
        <div id="errorMessage" style="display: none;"></div>

        <!-- Marksheet Display Container -->
        <div id="marksheetContainer" style="display: none;"></div>
    </div>
</div>
<!-- Registration Verification Section End -->
@endsection

@push('custom-js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#resultVerifyForm').on('submit', function(e) {
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
        $('#marksheetContainer').hide().empty();
        $('#errorMessage').hide().empty();
        
        // Show loading
        $('#loadingIndicator').show();
        $('#verifyBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> <span>Verifying...</span>');
        
        // AJAX request
        $.ajax({
            url: "{{ route('verification.result.data') }}",
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
                    // Generate marksheet HTML
                    var marksheetHtml = generateMarksheet(response.data);
                    $('#marksheetContainer').html(marksheetHtml).show();
                    
                    // Scroll to marksheet
                    $('html, body').animate({
                        scrollTop: $('#marksheetContainer').offset().top - 100
                    }, 500);
                } else {
                    showError(response.message || 'No result found');
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
    
    function generateMarksheet(data) {
        var baseUrl = '{{ url("/") }}';
        var photoUrl = data.sl_photo ? baseUrl + '/' + data.sl_photo : baseUrl + '/default-avatar.png';
        alert(photoUrl);
        
        var marksheetHtml = '<div class="verification-result-card">' +
            '<div class="success-alert">' +
            '<i class="fa fa-check-circle"></i>' +
            '<div>' +
            '<strong style="font-size: 18px;">Result Verified Successfully!</strong>' +
            '<p style="margin: 5px 0 0 0; font-size: 14px;">Your result details have been verified and displayed below.</p>' +
            '</div>' +
            '</div>' +
            '<div class="row mt-3">' +
            '<div class="col-12">' +
            '<div class="marksheet-header d-flex justify-content-between align-items-center">' +
            '<h4>PROVISIONAL MARKS STATEMENT</h4>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="marksheet-card">' +
            '<div class="row mb-4">' +
            '<div class="col-md-9">' +
            '<table class="table table-borderless">' +
            '<tr>' +
            '<td><strong>Course Name:</strong></td>' +
            '<td>' + (data.c_full_name || '') + ' (' + (data.c_short_name || '') + ')</td>' +
            '<td><strong>Reg. No:</strong></td>' +
            '<td>' + (data.sl_reg_no || '') + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td><strong>Student Name:</strong></td>' +
            '<td>' + (data.sl_name || '') + '</td>' +
            '<td><strong>Center Code:</strong></td>' +
            '<td>' + (data.cl_code || '') + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td><strong>Mother\'s Name:</strong></td>' +
            '<td>' + (data.sl_mother_name || '') + '</td>' +
            '<td><strong>Center Name:</strong></td>' +
            '<td>' + (data.cl_center_name || '') + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td><strong>Father\'s Name:</strong></td>' +
            '<td>' + (data.sl_father_name || '') + '</td>' +
            '<td><strong>Center Address:</strong></td>' +
            '<td>' + (data.cl_center_address || '') + '</td>' +
            '</tr>' +
            '</table>' +
            '</div>' +
            '<div class="col-md-3 text-center">' +
            '<img src="' + photoUrl + '" alt="Student Photo" class="student-photo" width="120" height="140" onerror="this.src=\'' + baseUrl + '/default-avatar.png\'">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="table-responsive">' +
            '<table class="table table-striped table-bordered text-center align-middle">' +
            '<thead class="table-primary">' +
            '<tr>' +
            '<th>Exam</th>' +
            '<th>Full Marks</th>' +
            '<th>Pass Marks</th>' +
            '<th>Marks Obtained</th>' +
            '</tr>' +
            '</thead>' +
            '<tbody>' +
            '<tr>' +
            '<td>' + (data.sr_written || '') + '</td>' +
            '<td>' + (data.sr_wr_full_marks || '') + '</td>' +
            '<td>' + (data.sr_wr_pass_marks || '') + '</td>' +
            '<td>' + (data.sr_wr_marks_obtained || '') + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>' + (data.sr_practical || '') + '</td>' +
            '<td>' + (data.sr_pr_full_marks || '') + '</td>' +
            '<td>' + (data.sr_pr_pass_marks || '') + '</td>' +
            '<td>' + (data.sr_pr_marks_obtained || '') + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>' + (data.sr_project || '') + '</td>' +
            '<td>' + (data.sr_ap_full_marks || '') + '</td>' +
            '<td>' + (data.sr_ap_pass_marks || '') + '</td>' +
            '<td>' + (data.sr_ap_marks_obtained || '') + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>' + (data.sr_viva || '') + '</td>' +
            '<td>' + (data.sr_vv_full_marks || '') + '</td>' +
            '<td>' + (data.sr_vv_pass_marks || '') + '</td>' +
            '<td>' + (data.sr_vv_marks_obtained || '') + '</td>' +
            '</tr>' +
            '<tr class="fw-bold table-secondary">' +
            '<td>Total</td>' +
            '<td>' + (data.sr_total_full_marks || '') + '</td>' +
            '<td>' + (data.sr_total_pass_marks || '') + '</td>' +
            '<td>' + (data.sr_total_marks_obtained || '') + '</td>' +
            '</tr>' +
            '</tbody>' +
            '</table>' +
            '</div>' +
            '<div class="d-flex justify-content-between align-items-center mt-3">' +
            '<div class="grade-box">' +
            'Percentage: ' + (data.sr_percentage || 'N/A') + '%' +
            '</div>' +
            '<div class="grade-box">' +
            'Grade: ' + (data.sr_grade || 'N/A') +
            '</div>' +
            '</div>' +
            '<div class="note-section mt-4">' +
            '<b>Notes & Explanation:</b>' +
            '<p>1. In case of any mistake being detected in the preparation of the Marks Statement at any stage or when it is brought to the notice of the concerned authority, we shall have the right to make necessary corrections.</p>' +
            '<p>2. This is a computer-generated Provisional Marks Statement and hence does not require a signature. For verification, refer to the original Marks Statement.</p>' +
            '<p>3. In case of any error in this statement of marks, it should be reported within 15 days.</p>' +
            '</div>' +
            '</div>' +
            '</div>';
        
        return marksheetHtml;
    }
});
</script>
@endpush