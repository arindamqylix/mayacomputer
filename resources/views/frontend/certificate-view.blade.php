@extends('frontend.layouts.master')
@section('title','Certificate of Diploma')
@push('custom-css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Times+New+Roman&display=swap');
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    @page {
        size: landscape;
        margin: 0;
    }
    
    body {
        font-family: 'Times New Roman', Times, serif;
        background: #f0f0f0;
    }
    
    .certificate-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
        background: #f0f0f0;
    }
    
    .certificate {
        width: 297mm;
        height: 210mm;
        background: #ffffff;
        border: 3px solid #1a4c8c;
        padding: 15px 25px;
        position: relative;
    }
    
    .certificate-inner {
        width: 100%;
        height: 100%;
        position: relative;
    }
    
    /* Logo Section - Big Size at Top */
    .logo-section {
        width: 100%;
        text-align: center;
        padding: 20px 0;
        margin-bottom: 15px;
        border-bottom: 2px solid #1a4c8c;
    }
    
    .logo-section img {
        max-width: 100%;
        max-height: 200px;
        height: auto;
        width: auto;
        object-fit: contain;
    }
    
    /* Header Section */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 5px;
    }
    
    .logo-left {
        width: 80px;
        height: 80px;
    }
    
    .logo-left img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    
    .header-center {
        text-align: center;
        flex: 1;
        padding: 0 20px;
    }
    
    .main-title {
        font-size: 32px;
        font-weight: bold;
        color: #1a4c8c;
        letter-spacing: 8px;
        font-family: 'Times New Roman', Times, serif;
        text-transform: uppercase;
    }
    
    .hindi-title {
        font-size: 22px;
        color: #1a4c8c;
        margin: 5px 0;
        font-weight: bold;
    }
    
    .cin-number {
        font-size: 11px;
        margin: 8px 0 3px;
    }
    
    .cin-number span {
        color: #1a4c8c;
        font-weight: bold;
    }
    
    .cin-value {
        color: #000;
        font-weight: normal;
    }
    
    .reg-info {
        font-size: 11px;
        color: #000;
        line-height: 1.4;
    }
    
    .iso-certified {
        font-size: 14px;
        color: #cc0000;
        font-weight: bold;
        margin-top: 5px;
    }
    
    .qr-photo {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
    
    .qr-code {
        width: 70px;
        height: 70px;
        border: 1px solid #ccc;
    }
    
    .qr-code img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    
    /* Certificate Title */
    .certificate-title {
        text-align: center;
        margin: 15px 0 10px;
    }
    
    .certificate-title h1 {
        font-size: 36px;
        color: #1a4c8c;
        font-style: italic;
        font-weight: normal;
        font-family: 'Times New Roman', Times, serif;
    }
    
    /* Body Section */
    .body-section {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }
    
    .body-content {
        flex: 1;
        text-align: center;
        padding-right: 20px;
    }
    
    .awarded-text {
        font-size: 18px;
        font-weight: bold;
        color: #000;
        margin-bottom: 8px;
    }
    
    .student-name {
        font-size: 24px;
        color: #1a4c8c;
        font-weight: bold;
        margin-bottom: 8px;
    }
    
    .student-details {
        font-size: 14px;
        color: #000;
        line-height: 1.6;
        text-align: center;
        max-width: 650px;
        margin: 0 auto;
    }
    
    .student-details p {
        margin: 3px 0;
    }
    
    .passport-photo {
        width: 100px;
        height: 120px;
        border: 1px solid #ccc;
        margin-left: 20px;
    }
    
    .passport-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    /* Recommendation Section */
    .recommendation {
        text-align: center;
        margin: 15px 0 10px;
    }
    
    .recommendation p {
        font-size: 14px;
        font-weight: bold;
        color: #000;
    }
    
    .date-issue {
        font-size: 14px;
        font-weight: bold;
        color: #000;
        margin-top: 3px;
    }
    
    /* Logos Section */
    .logos-section {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 25px;
        margin: 20px 0;
        flex-wrap: wrap;
    }
    
    .logo-item {
        height: 50px;
        display: flex;
        align-items: center;
    }
    
    .logo-item img {
        height: 100%;
        width: auto;
        object-fit: contain;
    }
    
    /* Skill India Logo */
    .skill-india-logo {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .skill-india-logo .emblem {
        width: 40px;
        height: 45px;
    }
    
    .skill-india-logo .text {
        display: flex;
        flex-direction: column;
    }
    
    .skill-india-logo .skill-text {
        font-size: 18px;
        font-weight: bold;
        color: #1a4c8c;
        letter-spacing: 2px;
    }
    
    .skill-india-logo .hindi-text {
        font-size: 10px;
        color: #e67300;
    }
    
    /* Ministry Logo */
    .ministry-logo {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 8px;
        text-align: left;
        color: #000;
        line-height: 1.2;
    }
    
    .ministry-logo .emblem {
        width: 30px;
    }
    
    /* NSDC Logo */
    .nsdc-logo {
        display: flex;
        align-items: center;
        font-weight: bold;
        font-size: 14px;
        letter-spacing: 1px;
    }
    
    .nsdc-logo span {
        padding: 2px 4px;
    }
    
    .nsdc-n { background: #1a4c8c; color: white; }
    .nsdc-s { background: #e67300; color: white; }
    .nsdc-d { background: #228b22; color: white; }
    .nsdc-c { background: #cc0000; color: white; }
    
    /* Corporate Affairs */
    .corporate-logo {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .corporate-logo .emblem {
        width: 35px;
    }
    
    .corporate-logo .text {
        font-size: 9px;
        line-height: 1.2;
        text-align: left;
    }
    
    .corporate-logo .ministry-text {
        font-weight: bold;
    }
    
    /* DPIIT Logo */
    .dpiit-logo {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .dpiit-logo .dpiit-text {
        font-size: 20px;
        font-weight: bold;
        color: #1a4c8c;
    }
    
    .dpiit-logo .startup-text {
        font-size: 10px;
        color: #e67300;
    }
    
    /* Signature Section */
    .signature-section {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
        padding: 0 80px;
    }
    
    .signature-box {
        text-align: center;
        width: 200px;
    }
    
    .signature-line {
        border-top: 1px solid #000;
        margin-bottom: 5px;
    }
    
    .signature-title {
        font-size: 12px;
        color: #1a4c8c;
        text-decoration: underline;
    }
    
    /* Placeholder styles for images */
    .placeholder-logo {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #1a4c8c 0%, #2d6cb5 100%);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 10px;
        text-align: center;
        font-weight: bold;
    }
    
    .placeholder-qr {
        width: 70px;
        height: 70px;
        background: #f0f0f0;
        border: 1px solid #ccc;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 8px;
        color: #666;
    }
    
    .placeholder-photo {
        width: 100px;
        height: 120px;
        background: #f5f5f5;
        border: 1px solid #ccc;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 10px;
        color: #666;
    }
    
    .placeholder-emblem {
        width: 35px;
        height: 40px;
        background: #f0f0f0;
        border-radius: 3px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 6px;
        color: #666;
    }
    
    @media print {
        body {
            background: white;
            padding: 0;
        }
        .certificate {
            border: 3px solid #1a4c8c;
        }
    }
</style>
@endpush

@section('content')
@php
    $siteSettings = site_settings();
    $siteLogo = $siteSettings && !empty($siteSettings->site_logo) ? asset($siteSettings->site_logo) : null;
    $siteName = $siteSettings && !empty($siteSettings->name) ? $siteSettings->name : 'MAYA COMPUTER CENTER';
    $hindiName = 'माया कम्प्यूटर सेंटर';
    
    // Format data
    $studentName = strtoupper(trim($certificate->sl_name ?? 'N/A'));
    $fatherName = trim($certificate->sl_father_name ?? 'N/A');
    $regNo = trim($certificate->sl_reg_no ?? 'N/A');
    $courseName = trim($certificate->c_full_name ?? 'N/A');
    $durationMonths = intval($certificate->c_duration ?? 0);
    $duration = 'N/A';
    if ($durationMonths >= 12) {
        $duration = ($durationMonths / 12) . ' Months';
    } elseif ($durationMonths > 0) {
        $duration = $durationMonths . ' Months';
    }
    $percentage = 'N/A';
    if (!empty($certificate->sr_percentage)) {
        $percentage = number_format((float)$certificate->sr_percentage, 2) . '%';
    }
    $grade = trim($certificate->sr_grade ?? '');
    $gradeText = $grade ? 'with Grade ' . $grade . ' *' : '';
    $centerName = trim($certificate->cl_center_name ?? 'N/A');
    $centerCode = trim($certificate->cl_code ?? 'N/A');
    $centerAddress = trim($certificate->cl_center_address ?? 'N/A');
    $cinNo = trim($certificate->cl_cin_no ?? 'U85220DL2023PTC422329');
    
    // Issue date
    $issueDate = 'N/A';
    if (!empty($certificate->sc_issue_date)) {
        $issueDate = date('d-M-Y', strtotime($certificate->sc_issue_date));
    } elseif (!empty($certificate->created_at)) {
        $issueDate = date('d-M-Y', strtotime($certificate->created_at));
    } elseif (!empty($certificate->updated_at)) {
        $issueDate = date('d-M-Y', strtotime($certificate->updated_at));
    }
    
    // Photo
    $photoUrl = '';
    if (!empty($certificate->sl_photo)) {
        $photoPath = $certificate->sl_photo;
        if (strpos($photoPath, 'http') === 0) {
            $photoUrl = $photoPath;
        }
    }
    
    // Student relation
    $relation = 'S/o';
    if (strtoupper($certificate->sl_sex ?? '') === 'FEMALE') {
        $relation = 'D/o';
    }
    
    // Logo check
    $logoExists = false;
    if ($siteLogo) {
        $logoPath = str_replace(url('/'), '', $siteLogo);
        $logoPath = ltrim($logoPath, '/');
        $fullPath = public_path($logoPath);
        $logoExists = file_exists($fullPath);
    }
@endphp

<div class="certificate-wrapper">
    <div class="certificate">
        <div class="certificate-inner">
            <!-- Logo Section - Big Size at Top -->
            @if($logoExists && $siteLogo)
            <div class="logo-section">
                <img src="{{ $siteLogo }}" alt="{{ $siteName }} Logo">
            </div>
            @endif
            
            <!-- Header Section -->
            <div class="header">
                <div class="logo-left">
                    @if($logoExists && $siteLogo)
                        <img src="{{ $siteLogo }}" alt="Logo">
                    @else
                        <div class="placeholder-logo">
                            MAYA<br>COMPUTER<br>CENTER
                        </div>
                    @endif
                </div>
                
                <div class="header-center">
                    <div class="main-title">{{ $siteName }}</div>
                    <div class="hindi-title">{{ $hindiName }}</div>
                    <div class="cin-number">
                        <span>CIN:</span> <span class="cin-value">{{ $cinNo }}</span>
                    </div>
                    <div class="reg-info">
                        Reg. Under the Company Act.2013 MCA, Government of India<br>
                        Registered Under Skill India, Udyam & Startup India
                    </div>
                    <div class="iso-certified">An ISO 9001: 2015 Certified</div>
                </div>
                
                {{-- <div class="qr-photo">
                    <div class="placeholder-qr">QR Code</div>
                </div> --}}
            </div>

            <!-- Certificate Title -->
            <div class="certificate-title">
                <h1>Certificate of Diploma</h1>
            </div>

            <!-- Body Section -->
            <div class="body-section">
                <div class="body-content">
                    <div class="awarded-text">This Certificate / Diploma is Awarded to</div>
                    <div class="student-name">{{ $studentName }}</div>
                    <div class="student-details">
                        <p>{{ $relation }} – {{ $fatherName }}, Reg No. {{ $regNo }} on successfully</p>
                        <p>completion of {{ $courseName }} (Duration - {{ $duration }})</p>
                        <p>Course and secured {{ $percentage }} {{ $gradeText }} from our authorised Study Centre {{ $centerName }},</p>
                        <p>{{ $centerAddress }}, Centre Code {{ $centerCode }}</p>
                    </div>
                </div>
                <div class="passport-photo">
                    @if($certificate->sl_photo)
                        <img src="{{ asset($certificate->sl_photo) }}" alt="Student Photo" onerror="this.parentElement.innerHTML='<div class=\'placeholder-photo\'>Passport<br>Photo</div>'">
                    @else
                        <div class="placeholder-photo">Passport<br>Photo</div>
                    @endif
                </div>
            </div>

            <!-- Recommendation Section -->
            <div class="recommendation">
                <p>On the recommendation of the board of examination</p>
                <p class="date-issue">Date of Issue: {{ $issueDate }}</p>
            </div>

            <!-- Logos Section -->
            <div class="logos-section">
                <div class="skill-india-logo">
                    <div class="placeholder-emblem">Emblem</div>
                    <div class="text">
                        <span class="skill-text">Skill India</span>
                        <span class="hindi-text">कौशल भारत-कुशल भारत</span>
                    </div>
                </div>

                <div class="ministry-logo">
                    <div class="placeholder-emblem">Emblem</div>
                    <div>
                        <div>भारत सरकार</div>
                        <div>GOVERNMENT OF INDIA</div>
                        <div>MINISTRY OF</div>
                        <div>SKILL DEVELOPMENT</div>
                        <div>AND ENTREPRENEURSHIP</div>
                    </div>
                </div>

                <div class="nsdc-logo">
                    <span class="nsdc-n">N</span>
                    <span class="nsdc-s">S</span>
                    <span class="nsdc-d">D</span>
                    <span class="nsdc-c">C</span>
                </div>

                <div class="corporate-logo">
                    <div class="placeholder-emblem">Emblem</div>
                    <div class="text">
                        <div class="ministry-text">MINISTRY OF</div>
                        <div class="ministry-text">CORPORATE</div>
                        <div class="ministry-text">AFFAIRS</div>
                        <div style="font-size: 7px;">GOVERNMENT OF INDIA</div>
                    </div>
                </div>

                <div class="dpiit-logo">
                    <div class="placeholder-emblem">Emblem</div>
                    <span class="dpiit-text">DPIIT</span>
                    <span class="startup-text">#startupindia</span>
                </div>
            </div>

            <!-- Signature Section -->
            <div class="signature-section">
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-title">Center Head Signature</div>
                </div>
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-title">Authorized Signatory</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

