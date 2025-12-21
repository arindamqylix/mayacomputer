@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maya Computer Center - Certificate of Completion</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', serif;
            background-color: #f5f5f5;
            padding: 20px;
            line-height: 1.4;
        }

        .certificate-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .certificate {
            position: relative;
            padding: 30px;
            background: white;
        }

        /* Decorative Border */
        .border-decoration {
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            border: 3px solid #1e3a8a;
            border-image: repeating-linear-gradient(45deg, #1e3a8a 0, #1e3a8a 10px, #dc2626 10px, #dc2626 20px) 3;
        }

        .certificate::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border: 1px solid #1e3a8a;
        }

        /* Header Section */
        .header {
            text-align: center;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .title-section {
            text-align: center;
            margin-bottom: 20px;
        }

        .main-logo {
            width: 150px;
            height: auto;
            display: block;
            margin: 0 auto 10px auto;
        }

        .hindi-title {
            font-size: 24px;
            color: #000080;
            margin: 5px 0;
        }

        .registration-info p {
            margin: 4px 0;
            font-size: 14px;
        }

        .iso-cert {
            color: #dc2626;
            font-size: 16px;
            font-weight: bold;
            margin: 8px 0;
        }

        .website {
            font-size: 12px;
            margin-top: 5px;
        }

        .website a {
            color: #1e3a8a;
            text-decoration: none;
        }

        .cin-number {
            text-align: left;
            margin-bottom: 15px;
            font-size: 12px;
            position: relative;
            z-index: 1;
        }

        /* Certificate Body */
        .cert-header {
            background: #1e3a8a;
            color: white;
            text-align: center;
            padding: 15px;
            margin-bottom: 25px;
            position: relative;
            z-index: 1;
        }

        .cert-header h3 {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .cert-body {
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .cert-content {
            text-align: center;
        }

        .cert-text {
            font-size: 18px;
            margin-bottom: 15px;
            font-style: italic;
        }

        .student-name {
            font-size: 32px;
            font-weight: bold;
            margin: 20px 0;
            color: #1e3a8a;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .course-details {
            font-size: 18px;
            margin: 15px 0;
            line-height: 1.6;
        }

        .course-name {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            margin: 10px 0;
        }

        .result-info {
            font-size: 16px;
            margin: 10px 0;
        }

        .result-details {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .result-item {
            text-align: center;
        }

        .result-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .result-value {
            font-size: 18px;
            font-weight: bold;
            color: #1e3a8a;
        }

        .authorization-text {
            font-size: 16px;
            font-style: italic;
            margin: 20px 0;
            line-height: 1.6;
        }

        .company-full-name {
            font-size: 18px;
            font-weight: bold;
            color: #1e3a8a;
            text-decoration: underline;
            margin-top: 15px;
        }

        .certificate-number {
            text-align: center;
            margin: 20px 0;
            font-size: 14px;
            color: #666;
        }

        .cert-number-value {
            font-weight: bold;
            color: #1e3a8a;
        }

        /* Logos Section */
        .logos-section {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 30px;
            text-align: center;
        }

        .logo-item {
            flex: 1;
            margin: 10px;
            min-width: 100px;
        }

        .logo-img {
            max-height: 60px;
            max-width: 120px;
            display: block;
            margin: 0 auto 8px auto;
        }

        .logo-item p {
            font-size: 10px;
            margin: 5px 0 0 0;
            line-height: 1.3;
        }

        /* Footer Section */
        .footer-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 30px;
            position: relative;
            z-index: 1;
        }

        .footer-item {
            text-align: center;
            flex: 1;
        }

        .footer-item p {
            font-size: 12px;
            margin-bottom: 5px;
        }

        .signature-space {
            height: 40px;
            border-bottom: 1px solid #333;
            width: 120px;
            margin: 10px auto 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .certificate {
                padding: 20px;
            }

            .student-name {
                font-size: 24px;
            }

            .result-details {
                flex-direction: column;
                gap: 15px;
            }

            .logos-section {
                flex-direction: column;
            }

            .footer-section {
                flex-direction: column;
                gap: 20px;
            }
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .certificate-container {
                box-shadow: none;
                max-width: none;
            }
        }
    </style>
</head>

<body>
    <div class="certificate-container">
        <div class="certificate">
            <!-- Decorative Border -->
            <div class="border-decoration"></div>
            
            <!-- Header Section -->
            <div class="header">
                <div class="title-section">
                    <img src="{{asset('document/images/logo.png')}}" alt="Maya Computer Center Logo" class="main-logo">
                    <h2 class="hindi-title">माया कम्प्यूटर सेंटर</h2>
                    <div class="registration-info">
                        <p><strong>Reg. Under the Company Act,2013 MCA, Government of India</strong></p>
                        <p><strong>Registered Under Skill India, Udyam & Startup India</strong></p>
                    </div>
                    <div class="iso-cert">
                        <p>An ISO 9001: 2015 Certified</p>
                    </div>
                    <div class="website">
                        <p>Our Website: <a href="https://mayacomputercenter.in/">https://mayacomputercenter.in/</a></p>
                    </div>
                </div>
            </div>

            <div class="cin-number">
                <p><strong>CIN:</strong> U47411DL2023PTC422329</p>
            </div>

            <!-- Certificate Body -->
            <div class="cert-header">
                <h3>CERTIFICATE OF COMPLETION</h3>
            </div>

            <div class="cert-body">
                <div class="cert-content">
                    <p class="cert-text"><em>This is to Certify that</em></p>
                    <p class="student-name">{{ $certificate->sl_name ?? 'N/A' }}</p>
                    <p class="course-details">
                        <em>has successfully completed the course</em>
                    </p>
                    <p class="course-name">{{ $certificate->c_full_name ?? 'N/A' }} ({{ $certificate->c_short_name ?? 'N/A' }})</p>
                    
                    <div class="result-details">
                        <div class="result-item">
                            <div class="result-label">Registration No.</div>
                            <div class="result-value">{{ $certificate->sl_reg_no ?? 'N/A' }}</div>
                        </div>
                        <div class="result-item">
                            <div class="result-label">Percentage</div>
                            <div class="result-value">{{ number_format($certificate->sr_percentage ?? 0, 2) }}%</div>
                        </div>
                        <div class="result-item">
                            <div class="result-label">Grade</div>
                            <div class="result-value">{{ $certificate->sr_grade ?? 'N/A' }}</div>
                        </div>
                    </div>

                    <p class="authorization-text">
                        <em>This certificate is issued by</em><br>
                        <span class="company-full-name">MAYA COMPUTER CENTER PRIVATE LIMITED</span><br>
                        <em>under the authorization of</em><br>
                        <strong>{{ $certificate->cl_center_name ?? 'N/A' }}</strong> (Center Code: {{ $certificate->cl_code ?? 'N/A' }})
                    </p>

                    <div class="certificate-number">
                        Certificate No: <span class="cert-number-value">{{ $certificate->sc_certificate_number ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- Logos Section -->
            <div class="logos-section">
                <div class="logo-item">
                    <img src="{{asset('document/images/iaf.jpg')}}" alt="IAF" class="logo-img">
                </div>
                <div class="logo-item">
                    <img src="{{asset('document/images/MSME-Logo.png')}}" alt="MSME" class="logo-img">
                </div>
                <div class="logo-item">
                    <img src="{{asset('document/images/iso_cert.png')}}" alt="ISO" class="logo-img">
                </div>
                <div class="logo-item">
                    <img src="{{asset('document/images/startupindia.jpg')}}" alt="Startup India" class="logo-img">
                </div>
                <div class="logo-item">
                    <img src="{{asset('document/images/skill_india.jpg')}}" alt="Skill India" class="logo-img">
                </div>
                <div class="logo-item">
                    <img src="{{asset('document/images/national_career_service.jpeg')}}" alt="NCS" class="logo-img">
                </div>
            </div>

            <!-- Footer Section -->
            <div class="footer-section">
                <div class="footer-item">
                    <p><strong><u>Issue Date</u></strong></p>
                    <p><strong>{{ $certificate->sc_issue_date ? Carbon::parse($certificate->sc_issue_date)->format('d-M-Y') : 'N/A' }}</strong></p>
                </div>
                <div class="footer-item">
                    <p><strong><u>Center</u></strong></p>
                    <p><strong>{{ $certificate->cl_center_name ?? 'N/A' }}</strong></p>
                </div>
                <div class="footer-item">
                    <p><strong><u>Authorized Signatory</u></strong></p>
                    <div class="signature-space"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

