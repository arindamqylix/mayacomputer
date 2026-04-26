<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Student ID Card - {{ $student->sl_name }}</title>
    <style>
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

        .id-card-container {
            width: 370px;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            border: 2px solid #000077;
            margin: 0 auto;
        }

        .id-header {
            background: #ffffff;
            padding: 5px;
            text-align: center;
            position: relative;
            border-bottom: 2px solid #000077;
        }

        .header-banner {
            width: 100%;
            height: auto;
            max-height: 80px;
            display: block;
            margin: 0 auto;
        }

        .header-subtext {
            text-align: center;
            margin-top: -10px;
        }

        .reg-details {
            font-size: 7px;
            font-weight: bold;
            margin: 1px 0;
            color: #000;
        }

        .iso-text {
            color: red;
            font-weight: bold;
            font-size: 8px;
            margin: 1px 0;
        }

        .id-header-text {
            text-align: center;
            background: #000077;
            padding: 5px 15px;
            width: 100%;
            margin-top: 5px;
        }

        .card-type {
            font-size: 14px;
            color: #ffffff;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .id-body {
            padding: 15px;
            background: #ffffff;
            position: relative;
            min-height: 160px;
        }

        .photo-section {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 100px;
        }

        .photo-container {
            width: 100px;
            height: 120px;
            border: 2px solid #000077;
            border-radius: 6px;
            background: #f8f9fa;
            overflow: hidden;
        }

        .photo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info-section {
            width: 230px;
        }

        .student-name {
            font-size: 14px;
            font-weight: 800;
            color: #000077;
            margin: 0 0 10px 0;
            text-transform: uppercase;
            border-left: 4px solid #ffd700;
            padding-left: 10px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-row {
            border-bottom: 1px solid #f1f1f1;
        }

        .info-label {
            font-weight: 700;
            color: #555;
            font-size: 9px;
            text-transform: uppercase;
            padding: 4px 0;
            width: 80px;
        }

        .info-value {
            font-weight: 600;
            color: #000;
            font-size: 10px;
            padding: 4px 0;
        }

        .id-footer {
            background: #ffffff;
            position: relative;
            border-top: 1px solid #eee;
        }

        .footer-content {
            padding: 10px 15px;
            min-height: 80px;
        }

        .qr-section {
            float: left;
            width: 80px;
        }

        .signature-wrapper {
            float: right;
            width: 140px;
            text-align: center;
            position: relative;
        }

        .footer-strip {
            height: 10px;
            width: 100%;
            background: #000077;
            clear: both;
        }

        .stamp-signature-area {
            position: relative;
            height: 60px;
        }

        .footer-stamp {
            position: absolute;
            top: -20px;
            left: 50%;
            margin-left: -50px;
            height: 100px;
            opacity: 0.8;
            z-index: 1;
        }

        .footer-sign {
            position: absolute;
            top: 10px;
            left: 50%;
            margin-left: -40px;
            height: 40px;
            z-index: 2;
        }

        .signature-label {
            font-size: 10px;
            font-weight: 800;
            color: #000077;
            text-transform: uppercase;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="id-card-container">
        <div class="id-header">
            @php
                if ($setting) {
                    if (!empty($setting->document_logo)) {
                        $logoPath = public_path(ltrim($setting->document_logo, '/'));
                    } elseif (!empty($setting->site_logo)) {
                        $logoPath = public_path(ltrim($setting->site_logo, '/'));
                    } else {
                        $logoPath = public_path('header_banner.png');
                    }
                } else {
                    $logoPath = public_path('header_banner.png');
                }
            @endphp

            @if(file_exists($logoPath))
                <img src="{{ $logoPath }}" class="header-banner">
            @endif

            <div class="header-subtext">
                <p class="reg-details" style="font-size: 14px;">CIN : U85220DL2023PTC422329</p>
                <p class="reg-details" style="font-size: 11px;">Reg. Under the Company Act.2013 MCA, Government of India
                </p>
                <p class="reg-details" style="font-size:9px;">Registered Under NCT Delhi, Skill India, Udyam & Startup
                    India</p>
                <p class="iso-text" style="font-size: 14px;">An ISO 9001: 2015 Certified</p>
                <p class="reg-details" style="font-size: 10px; margin-top: 2px;">Visit Our Website : https://mayacomputercenter.in</p>
            </div>

            <div class="id-header-text">
                <div class="card-type">Student ID Card</div>
            </div>
        </div>

        <div class="id-body">
            <div class="photo-section">
                <div class="photo-container">
                    @php
                        $photoPath = !empty($student->sl_photo) ? public_path(ltrim($student->sl_photo, '/')) : '';
                    @endphp
                    @if(!empty($photoPath) && file_exists($photoPath))
                        <img src="{{ $photoPath }}">
                    @endif
                </div>
            </div>

            <div class="info-section">
                <div class="student-name">{{ $student->sl_name ?? 'N/A' }}</div>

                <table class="info-table">
                    <tr class="info-row">
                        <td class="info-label">Reg. No:</td>
                        <td class="info-value" style="color: #000077;">{{ $student->sl_reg_no ?? 'N/A' }}</td>
                    </tr>
                    <tr class="info-row">
                        <td class="info-label">Course:</td>
                        <td class="info-value">{{ $student->c_short_name ?? $student->c_full_name ?? 'N/A' }}</td>
                    </tr>
                    <tr class="info-row">
                        <td class="info-label">Father:</td>
                        <td class="info-value">{{ strtoupper($student->sl_father_name ?? 'N/A') }}</td>
                    </tr>
                    @if($student->sl_dob)
                        <tr class="info-row">
                            <td class="info-label">DOB:</td>
                            <td class="info-value">{{ \Carbon\Carbon::parse($student->sl_dob)->format('d-m-Y') }}</td>
                        </tr>
                    @endif
                    @if($student->sl_mobile_no ?? $student->cl_mobile ?? null)
                        <tr class="info-row">
                            <td class="info-label">Mobile:</td>
                            <td class="info-value">{{ $student->sl_mobile_no ?? $student->cl_mobile ?? 'N/A' }}</td>
                        </tr>
                    @endif
                    @if($student->cl_center_name ?? $student->cl_name ?? null)
                        <tr class="info-row" style="border-bottom: none;">
                            <td class="info-label">Center:</td>
                            <td class="info-value" style="font-size: 8px;">
                                {{ ($student->cl_center_name ?? $student->cl_name ?? 'N/A') . ($student->cl_code ? ' - ' . $student->cl_code : '') }}
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>

        <div class="id-footer">
            <div class="footer-content">
                <div class="qr-section">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-center/' . ($student->cl_code ?? '')) }}"
                        style="width: 65px; height: 65px; border: 1px solid #ddd; background:white;">
                </div>

                <div class="signature-wrapper">
                    <div class="stamp-signature-area">
                        @php
                            $stampPath = !empty($setting->authorize_stamp) ? public_path(ltrim($setting->authorize_stamp, '/')) : '';
                            $sigPath = !empty($setting->authorize_signature) ? public_path(ltrim($setting->authorize_signature, '/')) : '';
                        @endphp
                        @if(!empty($stampPath) && file_exists($stampPath))
                            <img src="{{ $stampPath }}" class="footer-stamp">
                        @endif
                        @if(!empty($sigPath) && file_exists($sigPath))
                            <img src="{{ $sigPath }}" class="footer-sign">
                        @endif
                    </div>
                    <div class="signature-label">Authorized Signatory</div>
                </div>
                <div style="clear: both;"></div>
            </div>
            <div class="footer-strip"></div>
        </div>
    </div>
</body>

</html>