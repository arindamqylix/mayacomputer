<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration Card - {{ $student->sl_reg_no }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: white;
            padding: 20px;
        }
        
        .reg-card-container {
            width: 100%;
            max-width: 8in;
            margin: 0 auto;
            background: white;
            position: relative;
            overflow: hidden;
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
            max-height: 60px;
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
    </style>
</head>
<body>
    <div class="reg-card-container">
        <div class="reg-card">
            <div class="reg-outer-border"></div>
            <div class="reg-inner-border"></div>
            <div class="reg-content">
                <div class="reg-header">
                    <div class="reg-header-left">
                        @php
                            $logoPath = '';
                            if (!empty($siteLogo)) {
                                // Convert asset path to public path
                                $logoPath = str_replace(url('/'), '', $siteLogo);
                                $logoPath = ltrim($logoPath, '/');
                                $logoPath = public_path($logoPath);
                            }
                        @endphp
                        @if(!empty($logoPath) && file_exists($logoPath))
                            <img src="{{ $logoPath }}" alt="Logo">
                        @else
                            <div class="reg-logo-placeholder">LOGO</div>
                        @endif
                    </div>
                    <div class="reg-header-center">
                        <h1 class="reg-main-title">{{ $siteName }}</h1>
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
                                <td class="value">{{ $student->sl_reg_no ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="label">Student Name</td>
                                <td class="colon">:</td>
                                <td class="value">{{ strtoupper($student->sl_name ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td class="label">Father's Name</td>
                                <td class="colon">:</td>
                                <td class="value">{{ strtoupper($student->sl_father_name ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td class="label">Mother's Name</td>
                                <td class="colon">:</td>
                                <td class="value">{{ strtoupper($student->sl_mother_name ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td class="label">Date of Birth</td>
                                <td class="colon">:</td>
                                <td class="value">{{ $dobFormatted }}</td>
                            </tr>
                            <tr>
                                <td class="label">Gender</td>
                                <td class="colon">:</td>
                                <td class="value">{{ ucfirst($student->sl_sex ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td class="label">Course Name</td>
                                <td class="colon">:</td>
                                <td class="value">{{ strtoupper($student->c_full_name ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td class="label">Duration</td>
                                <td class="colon">:</td>
                                <td class="value">
                                    @php
                                        $duration = null;
                                        if ($student->c_duration) {
                                            // Convert to numeric value (handle string values like "12" or "12 months")
                                            $duration = floatval($student->c_duration);
                                        }
                                    @endphp
                                    @if($duration !== null && $duration > 0)
                                        @if($duration >= 12)
                                            @php
                                                $years = $duration / 12;
                                            @endphp
                                            {{ number_format($years, ($years == intval($years) ? 0 : 1)) }} {{ $years == 1 ? 'Year' : 'Years' }}
                                        @else
                                            {{ intval($duration) }} {{ $duration == 1 ? 'Month' : 'Months' }}
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Center Code</td>
                                <td class="colon">:</td>
                                <td class="value">{{ $student->cl_code ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="label">Center Name</td>
                                <td class="colon">:</td>
                                <td class="value">{{ $student->cl_center_name ?? $student->cl_name ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="reg-right-section">
                        <div class="reg-photo-box">
                            <div class="reg-photo-frame">
                                @php
                                    $photoPath = '';
                                    if (!empty($student->sl_photo)) {
                                        $photoPath = public_path(ltrim($student->sl_photo, '/'));
                                    }
                                @endphp
                                @if(!empty($photoPath) && file_exists($photoPath))
                                    <img src="{{ $photoPath }}" alt="Student Photo">
                                @else
                                    <span>Photo</span>
                                @endif
                            </div>
                            <div class="reg-student-sign">
                                <div class="reg-sign-line"></div>
                                <p class="reg-sign-label">Student's Signature</p>
                            </div>
                        </div>
                        <div class="reg-validity-box">
                            <p><strong>Valid From:</strong></p>
                            <p class="date">{{ $validFrom }}</p>
                            <p><strong>Valid Till:</strong></p>
                            <p class="date">{{ $validTill }}</p>
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
                                    <p class="value">{{ $issueDate }}</p>
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
                        <span class="highlight">CIN: {{ $cinNo }}</span> | 
                        <span class="highlight">www.mayacomputercenter.in</span> | 
                        Email: {{ $siteEmail }} | Phone: {{ $sitePhone }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

