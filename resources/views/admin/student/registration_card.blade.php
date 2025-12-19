<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maya Computer Center - Registration Card</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .card-container {
            width: 8in;
            height: 5.5in;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
        }

        .card {
            width: 100%;
            height: 100%;
            position: relative;
            padding: 12px;
        }

        /* Border Design */
        .outer-border {
            position: absolute;
            top: 4px;
            left: 4px;
            right: 4px;
            bottom: 4px;
            border: 3px solid;
            border-image: repeating-linear-gradient(45deg, #1e3a8a 0, #1e3a8a 8px, #dc2626 8px, #dc2626 16px) 3;
        }

        .inner-border {
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            border: 1.5px solid #1e3a8a;
        }

        .content {
            position: relative;
            z-index: 1;
            height: 100%;
        }

        /* Header */
        .header {
            display: table;
            width: 100%;
            border-bottom: 2px solid #1e3a8a;
            padding-bottom: 8px;
            margin-bottom: 8px;
        }

        .header-left, .header-center, .header-right {
            display: table-cell;
            vertical-align: middle;
        }

        .header-left {
            width: 70px;
        }

        .header-left img {
            width: 60px;
            height: auto;
            border-radius: 50%;
        }

        .logo-placeholder {
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

        .header-center {
            text-align: center;
        }

        .main-title {
            color: #1e3a8a;
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }

        .hindi-title {
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

        .iso-cert {
            color: #dc2626;
            font-size: 10px;
            font-weight: bold;
        }

        .header-right {
            width: 70px;
            text-align: center;
        }

        .qr-box {
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

        /* Title Bar */
        .title-bar {
            background: #1e3a8a;
            color: white;
            text-align: center;
            padding: 6px;
            margin-bottom: 10px;
        }

        .title-bar h2 {
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        /* Main Body */
        .main-body {
            display: table;
            width: 100%;
        }

        .left-section {
            display: table-cell;
            vertical-align: top;
            width: 65%;
            padding-right: 15px;
        }

        .right-section {
            display: table-cell;
            vertical-align: top;
            width: 35%;
        }

        /* Info Table */
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table tr {
            border-bottom: 1px solid #e0e0e0;
        }

        .info-table td {
            padding: 5px 8px;
            font-size: 11px;
            vertical-align: top;
        }

        .info-table .label {
            width: 120px;
            font-weight: bold;
            color: #1e3a8a;
            background: #f0f7ff;
        }

        .info-table .value {
            font-weight: 600;
            color: #333;
            text-transform: uppercase;
        }

        .info-table .colon {
            width: 10px;
            text-align: center;
        }

        /* Photo Section */
        .photo-box {
            width: 120px;
            margin: 0 auto 10px;
        }

        .photo-frame {
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

        .photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .student-sign {
            text-align: center;
        }

        .sign-line {
            border-bottom: 1px solid #333;
            width: 100px;
            margin: 0 auto 3px;
        }

        .sign-label {
            font-size: 8px;
            color: #666;
        }

        /* Validity Box */
        .validity-box {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            padding: 6px;
            margin-top: 8px;
            text-align: center;
            border-radius: 4px;
        }

        .validity-box p {
            font-size: 10px;
            margin: 2px 0;
        }

        .validity-box .date {
            font-weight: bold;
            color: #1e3a8a;
        }

        /* Footer */
        .footer {
            position: absolute;
            bottom: 15px;
            left: 15px;
            right: 15px;
        }

        .footer-logos {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }

        .footer-logos td {
            text-align: center;
            vertical-align: middle;
            padding: 0 5px;
        }

        .logo-small {
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

        .footer-bottom {
            display: table;
            width: 100%;
            border-top: 1px solid #1e3a8a;
            padding-top: 8px;
        }

        .footer-bottom td {
            vertical-align: bottom;
            padding: 0 5px;
        }

        .footer-item {
            text-align: center;
        }

        .footer-item .label {
            font-size: 9px;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .footer-item .value {
            font-size: 10px;
            font-weight: bold;
        }

        .sig-space {
            width: 80px;
            height: 25px;
            border-bottom: 1px solid #333;
            margin: 0 auto 3px;
        }

        .sig-label {
            font-size: 8px;
            font-weight: bold;
        }

        /* Company Info */
        .company-info {
            text-align: center;
            font-size: 8px;
            color: #666;
            margin-top: 5px;
        }

        .company-info .highlight {
            color: #1e3a8a;
            font-weight: bold;
        }

        /* Print Button */
        .print-button {
            text-align: center;
            margin: 20px 0;
        }

        .print-button button {
            background: #1e3a8a;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .print-button button:hover {
            background: #1e40af;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        /* Print */
        @media print {
            body {
                background: white;
                padding: 0;
            }
            .card-container {
                box-shadow: none;
            }
            .outer-border, .inner-border, .title-bar {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="print-button">
        <button onclick="window.print()">
            <i class="fas fa-print"></i> Print Registration Card
        </button>
    </div>

    <div class="card-container">
        <div class="card">
            <!-- Borders -->
            <div class="outer-border"></div>
            <div class="inner-border"></div>

            <div class="content">
                <!-- Header -->
                <div class="header">
                    <div class="header-left">
                        @if(file_exists(public_path('logo.png')))
                            <img src="{{ asset('logo.png') }}" alt="Logo">
                        @else
                            <div class="logo-placeholder">LOGO</div>
                        @endif
                    </div>
                    <div class="header-center">
                        <h1 class="main-title">MAYA COMPUTER CENTER</h1>
                        <h2 class="hindi-title">माया कम्प्यूटर सेंटर</h2>
                        <p class="reg-info">Reg. Under Company Act 2013, MCA, Govt. of India</p>
                        <p class="iso-cert">An ISO 9001:2015 Certified</p>
                    </div>
                    <div class="header-right">
                        <div class="qr-box">QR</div>
                    </div>
                </div>

                <!-- Title Bar -->
                <div class="title-bar">
                    <h2>REGISTRATION CARD</h2>
                </div>

                <!-- Main Body -->
                <div class="main-body">
                    <div class="left-section">
                        <table class="info-table">
                            <tr>
                                <td class="label">Registration No.</td>
                                <td class="colon">:</td>
                                <td class="value">{{ $data->sl_reg_no ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="label">Student Name</td>
                                <td class="colon">:</td>
                                <td class="value">{{ strtoupper($data->sl_name ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td class="label">Father's Name</td>
                                <td class="colon">:</td>
                                <td class="value">{{ strtoupper($data->sl_father_name ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td class="label">Mother's Name</td>
                                <td class="colon">:</td>
                                <td class="value">{{ strtoupper($data->sl_mother_name ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td class="label">Date of Birth</td>
                                <td class="colon">:</td>
                                <td class="value">
                                    @if($data->sl_dob)
                                        {{ \Carbon\Carbon::parse($data->sl_dob)->format('d-M-Y') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Gender</td>
                                <td class="colon">:</td>
                                <td class="value">{{ strtoupper($data->sl_sex ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td class="label">Course Name</td>
                                <td class="colon">:</td>
                                <td class="value">{{ strtoupper($data->c_full_name ?? $data->c_short_name ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td class="label">Duration</td>
                                <td class="colon">:</td>
                                <td class="value">
                                    @if($data->c_duration)
                                        {{ $data->c_duration }} {{ $data->c_duration == '1' ? 'Year' : 'Years' }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Center Code</td>
                                <td class="colon">:</td>
                                <td class="value">{{ $data->cl_code ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="label">Center Name</td>
                                <td class="colon">:</td>
                                <td class="value">{{ strtoupper($data->cl_center_name ?? $data->cl_name ?? 'N/A') }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="right-section">
                        <div class="photo-box">
                            <div class="photo-frame">
                                @if($data->sl_photo && file_exists(public_path($data->sl_photo)))
                                    <img src="{{ asset($data->sl_photo) }}" alt="Student Photo">
                                @else
                                    Photo
                                @endif
                            </div>
                            <div class="student-sign">
                                <div class="sign-line"></div>
                                <p class="sign-label">Student's Signature</p>
                            </div>
                        </div>

                        <div class="validity-box">
                            <p><strong>Valid From:</strong></p>
                            <p class="date">{{ \Carbon\Carbon::now()->format('d-M-Y') }}</p>
                            <p><strong>Valid Till:</strong></p>
                            <p class="date">
                                @if($data->c_duration)
                                    {{ \Carbon\Carbon::now()->addYears($data->c_duration)->format('d-M-Y') }}
                                @else
                                    {{ \Carbon\Carbon::now()->addYear()->format('d-M-Y') }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="footer">
                    <!-- Logos -->
                    <table class="footer-logos">
                        <tr>
                            <td><div class="logo-small">SKILL INDIA</div></td>
                            <td><div class="logo-small">MINISTRY</div></td>
                            <td><div class="logo-small">MSME</div></td>
                            <td><div class="logo-small">ISO</div></td>
                            <td><div class="logo-small">STARTUP</div></td>
                            <td><div class="logo-small">NCS</div></td>
                        </tr>
                    </table>

                    <!-- Bottom Section -->
                    <table class="footer-bottom">
                        <tr>
                            <td width="25%">
                                <div class="footer-item">
                                    <p class="label">Date of Issue</p>
                                    <p class="value">{{ \Carbon\Carbon::now()->format('d-M-Y') }}</p>
                                </div>
                            </td>
                            <td width="25%">
                                <div class="footer-item">
                                    <div class="sig-space"></div>
                                    <p class="sig-label">Center Head</p>
                                </div>
                            </td>
                            <td width="25%">
                                <div class="footer-item">
                                    <div class="sig-space"></div>
                                    <p class="sig-label">Exam Controller</p>
                                </div>
                            </td>
                            <td width="25%">
                                <div class="footer-item">
                                    <div class="sig-space"></div>
                                    <p class="sig-label">Authorized Signatory</p>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <!-- Company Info -->
                    <div class="company-info">
                        <span class="highlight">CIN: U47411DL2023PTC422329</span> | 
                        <span class="highlight">www.mayacomputercenter.in</span> | 
                        Email: mccsiswar@gmail.com | Phone: +91 8825148127
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

