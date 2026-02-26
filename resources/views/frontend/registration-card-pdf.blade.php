<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration Card - {{ $student->sl_reg_no }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Times New Roman', serif;
            background: white;
            padding: 30px;
        }
        
        .reg-card-container {
            width: 100%;
            background: white;
            position: relative;
            padding: 10px;
        }
        
        .reg-card {
            width: 100%;
            position: relative;
            padding: 15px;
            border: 1px solid #ccc;
        }
        
        .reg-outer-border {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 3px dashed #dc2626;
        }
        
        .reg-inner-border {
            position: absolute;
            top: 6px;
            left: 6px;
            right: 6px;
            bottom: 6px;
            border: 2px solid #000066;
        }
        
        .reg-content {
            position: relative;
            z-index: 1;
        }
        
        .reg-header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }
        
        .header-banner {
            width: 80%;
            max-height: 100px;
            display: block;
            margin: 0 auto;
        }
        
        .header-subtext {
            text-align: center;
            margin-top: -10px;
        }
        
        .reg-subtext-line {
            font-size: 11px;
            font-weight: bold;
            margin: 1px 0;
            color: #000;
            font-family: Arial, sans-serif;
        }
        
        .reg-iso-cert {
            color: red;
            font-weight: bold;
            font-size: 14px;
            margin: 2px 0;
            font-family: Arial, sans-serif;
        }
        
        .reg-title {
            text-align: center;
            color: green;
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0;
            text-transform: uppercase;
        }
        
        .blue-bar {
            background-color: #000066;
            color: white;
            padding: 5px 15px;
            font-weight: bold;
            font-size: 14px;
            font-family: Arial, sans-serif;
            margin-bottom: 0;
            display: block;
            width: 100%;
        }
        
        .blue-bar table {
            width: 100%;
            color: white;
        }
        
        .details-section {
            border: 1px solid #ccc;
            margin-top: 0;
            padding: 10px;
            position: relative;
            background: #fff;
        }
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .info-table td {
            padding: 6px 5px;
            vertical-align: top;
            font-size: 14px;
        }
        
        .label {
            font-weight: bold;
            font-style: italic;
            text-align: right;
            width: 150px;
            color: #000;
        }
        
        .value {
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
        }
        
        .photo-sign-container {
            position: absolute;
            right: 20px;
            top: 20px;
            width: 120px;
            text-align: center;
        }
        
        .photo-box {
            width: 110px;
            height: 130px;
            border: 2px solid #000;
            margin: 0 auto;
            background: #fff;
            overflow: hidden;
        }
        
        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .sign-box {
            width: 110px;
            height: 40px;
            border: 1px solid #000;
            border-top: none;
            margin: 0 auto;
            background: #fff;
            display: block;
        }
        
        .sign-box img {
            max-width: 100%;
            max-height: 100%;
        }
        
        .sign-label {
            font-size: 10px;
            margin-top: 2px;
            color: #333;
        }
        
        .footer-row {
            margin-top: 30px;
            width: 100%;
        }
        
        .footer-row table {
            width: 100%;
        }
        
        .qr-section {
            width: 100px;
            text-align: center;
        }
        
        .qr-code {
            width: 80px;
            height: 80px;
            border: 1px solid #ccc;
        }
        
        .qr-label {
            font-size: 10px;
            margin-top: 5px;
            font-weight: bold;
        }
        
        .authority-section {
            text-align: center;
            position: relative;
            width: 250px;
        }
        
        .stamp-signature-wrap {
            position: relative;
            height: 100px;
            width: 200px;
            margin: 0 auto;
        }
        
        .auth-stamp {
            position: absolute;
            top: 0;
            left: 50%;
            margin-left: -65px;
            height: 120px;
            opacity: 0.8;
            z-index: 1;
        }
        
        .auth-sign {
            position: absolute;
            top: 30px;
            left: 50%;
            margin-left: -50px;
            height: 60px;
            z-index: 2;
        }
        
        .authority-label {
            font-weight: bold;
            font-size: 15px;
            margin-top: 10px;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="reg-card-container">
        <div class="reg-card">
            <div class="reg-outer-border"></div>
            <div class="reg-inner-border"></div>
            
            <div class="reg-content">
                <!-- Header -->
                <div class="reg-header">
                    @php
                        $bannerPath = '';
                        if(!empty($setting->document_logo)) {
                            $bannerPath = public_path(ltrim($setting->document_logo, '/'));
                        } else {
                            $bannerPath = public_path('header_banner.png');
                        }
                    @endphp
                    @if(!empty($bannerPath) && file_exists($bannerPath))
                        <img src="{{ $bannerPath }}" class="header-banner">
                    @endif
                    
                    <div class="header-subtext">
                        <p class="reg-subtext-line" style="font-size: 14px;">CIN : U85220DL2023PTC422329</p>
                        <p class="reg-subtext-line" style="font-size: 12px;">Reg. Under the Company Act.2013 MCA, Government of India</p>
                        <p class="reg-subtext-line" style="font-size: 11px;">Registered Under NCT Delhi, Skill India, Udyam & Startup India</p>
                        <p class="reg-iso-cert">An ISO 9001: 2015 Certified</p>
                        <p class="reg-subtext-line" style="font-size: 11px;">Visit Our Website : mayacc.in</p>
                    </div>
                </div>

                <!-- Title -->
                <div class="reg-title">
                    REGISTRATION CARD – {{ \Carbon\Carbon::parse($student->created_at)->year }}
                </div>

                <!-- Blue Bar -->
                <div class="blue-bar">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="left" style="color: white; font-weight: bold;">Registration No. : {{ $student->sl_reg_no }}</td>
                            <td align="right" style="color: white; font-weight: bold;">Year : {{ \Carbon\Carbon::parse($student->created_at)->year }}</td>
                        </tr>
                    </table>
                </div>

                <!-- Main Content Row -->
                <div class="details-section">
                    <table class="info-table">
                        <tr>
                            <td class="label">Student Name</td>
                            <td class="value">: {{ strtoupper($student->sl_name) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Mother's Name</td>
                            <td class="value">: {{ strtoupper($student->sl_mother_name) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Father's Name</td>
                            <td class="value">: {{ strtoupper($student->sl_father_name) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Date of Birth</td>
                            <td class="value">: {{ $student->sl_dob }} &nbsp;&nbsp; Gender : {{ strtoupper($student->sl_sex) }} &nbsp;&nbsp; Category : {{ $student->sl_category ?? 'Gen' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Course Name</td>
                            <td class="value">: {{ strtoupper($student->c_full_name) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Course Duration</td>
                            <td class="value">: 
                                @php 
                                    $dur = $student->c_duration; 
                                    if(is_numeric($dur) && $dur >= 12){ 
                                        echo (round($dur/12)==$dur/12 ? (int)($dur/12) : number_format($dur/12,1)) . (($dur/12)==1 ? ' Year' : ' Years'); 
                                    } elseif(is_numeric($dur) && $dur > 0){ 
                                        echo (int)$dur . ($dur==1 ? ' Month' : ' Months'); 
                                    } else { 
                                        echo $dur; 
                                    } 
                                @endphp
                            </td>
                        </tr>
                        <tr>
                            <td class="label">Center Name</td>
                            <td class="value">: {{ strtoupper($student->cl_center_name) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Center Code & Address</td>
                            <td class="value">: {{ $student->cl_code }} & {{ $student->cl_center_address }}</td>
                        </tr>
                    </table>

                    <!-- Photo & Sign box (Manual positioning for PDF) -->
                    <div class="photo-sign-container">
                        <div class="photo-box">
                            @php
                                $photoPath = '';
                                if(!empty($student->sl_photo)) {
                                    $photoPath = public_path(ltrim($student->sl_photo, '/'));
                                }
                            @endphp
                            @if(!empty($photoPath) && file_exists($photoPath))
                                <img src="{{ $photoPath }}">
                            @endif
                        </div>
                        <div class="sign-box">
                            @php
                                $signPath = '';
                                if(!empty($student->sl_signature)) {
                                    $signPath = public_path(ltrim($student->sl_signature, '/'));
                                }
                            @endphp
                            @if(!empty($signPath) && file_exists($signPath))
                                <img src="{{ $signPath }}">
                            @endif
                        </div>
                        <p class="sign-label">Student Signature</p>
                    </div>
                </div>

                <!-- Footer Section -->
                <div class="footer-row">
                    <table width="100%">
                        <tr>
                            <td class="qr-section" width="120">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-student/' . $student->sl_reg_no) }}" class="qr-code">
                                <p class="qr-label">Scan to verify</p>
                            </td>
                            <td class="authority-section" align="right">
                                <div class="stamp-signature-wrap">
                                    @php
                                        $stampPath = '';
                                        if(!empty($setting->authorize_stamp)) {
                                            $stampPath = public_path(ltrim($setting->authorize_stamp, '/'));
                                        }
                                        $sigPath = '';
                                        if(!empty($setting->authorize_signature)) {
                                            $sigPath = public_path(ltrim($setting->authorize_signature, '/'));
                                        }
                                    @endphp
                                    @if(!empty($stampPath) && file_exists($stampPath))
                                        <img src="{{ $stampPath }}" class="auth-stamp">
                                    @endif
                                    @if(!empty($sigPath) && file_exists($sigPath))
                                        <img src="{{ $sigPath }}" class="auth-sign">
                                    @endif
                                </div>
                                <div class="authority-label">Controller of Examination</div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
