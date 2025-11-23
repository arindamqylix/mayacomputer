@php
    use Carbon\Carbon;
    $currentDate = Carbon::now();
    $expirationDate = $currentDate->copy()->addYears(3);
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="" type="image/png">
    <title>Maya Computer Center - Certificate of Authorization</title>
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
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 10px;
    position: relative;
    z-index: 1;
}

.logo-section {
    flex-shrink: 0;
}

.logo-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #1e3a8a;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid #1e3a8a;
}

.logo-inner {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #1e3a8a;
}

.logo-text {
    color: #1e3a8a;
    font-weight: bold;
    font-size: 12px;
}

.title-section {
    flex: 1;
    text-align: center;
    padding: 0 20px;
}

.main-title {
    color: #1e3a8a;
    font-size: 32px;
    font-weight: bold;
    letter-spacing: 2px;
    margin-bottom: 5px;
}

.hindi-title {
    color: #1e3a8a;
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
}

.registration-info {
    margin-bottom: 8px;
}

.registration-info p {
    font-size: 12px;
    margin: 2px 0;
    color: #333;
}

.iso-cert {
    color: #dc2626;
    font-size: 14px;
    font-weight: bold;
    margin: 8px 0;
}

.website {
    font-size: 11px;
    margin-top: 5px;
}

.website a {
    color: #1e3a8a;
    text-decoration: none;
}

.qr-section {
    flex-shrink: 0;
    text-align: center;
}

.qr-code {
    width: 60px;
    height: 60px;
    border: 2px solid #333;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 5px;
}

.qr-placeholder {
    font-size: 12px;
    font-weight: bold;
}

.qr-number {
    font-size: 10px;
    font-weight: bold;
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
    padding: 10px;
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
}

.cert-header h3 {
    font-size: 20px;
    font-style: italic;
    font-weight: normal;
}

.cert-body {
    display: flex;
    gap: 30px;
    margin-bottom: 30px;
    position: relative;
    z-index: 1;
}

.cert-content {
    flex: 1;
    text-align: center;
}

.cert-text {
    font-size: 16px;
    margin-bottom: 8px;
    font-style: italic;
}

.company-name {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
}

.represented-by {
    font-size: 16px;
    font-style: italic;
    margin-bottom: 8px;
}

.person-name {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
}

.office-text {
    font-size: 16px;
    font-style: italic;
    margin-bottom: 8px;
}

.address {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 15px;
    color: #333;
}

.center-code-label {
    font-size: 16px;
    font-style: italic;
    margin-bottom: 8px;
}

.center-code {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 15px;
    color: #333;
}

.authorization-text {
    font-size: 14px;
    font-style: italic;
    margin-bottom: 10px;
    line-height: 1.5;
}

.company-full-name {
    font-size: 16px;
    font-weight: bold;
    color: #1e3a8a;
    text-decoration: underline;
}

.photo-section {
    flex-shrink: 0;
}

.photo-frame {
    border: 2px solid #333;
    padding: 5px;
    background: white;
    width: 120px;
}

.photo-placeholder {
    width: 110px;
    height: 130px;
    background: #f0f0f0;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
}

.photo-placeholder img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.signature-area {
    text-align: center;
}

.signature-line {
    border-bottom: 1px solid #333;
    width: 80px;
    margin: 0 auto;
}

/* Logos Section */
.logos-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    gap: 15px;
    position: relative;
    z-index: 1;
}

.logo-item {
    text-align: center;
    flex: 1;
}

.logo-placeholder {
    width: 60px;
    height: 40px;
    background: #f0f0f0;
    border: 1px solid #ccc;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 5px;
    font-size: 10px;
    font-weight: bold;
}

.logo-item p {
    font-size: 8px;
    line-height: 1.2;
    color: #333;
}

/* Footer Section */
.footer-section {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
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
    
    .header {
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }
    
    .main-title {
        font-size: 24px;
    }
    
    .cert-body {
        flex-direction: column;
        align-items: center;
    }
    
    .logos-section {
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .logo-item {
        min-width: 100px;
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
}
.logo-img {
    max-height: 60px; /* Adjust height */
    max-width: 120px; /* Adjust width */
    display: block;
    margin: 0 auto 8px auto;
}
.logo-item p {
    font-size: 12px;
    margin: 5px 0 0 0;
    line-height: 1.3;
}
.title-section {
    text-align: center;
    margin-bottom: 20px;
}
.main-logo {
    width: 100%;   /* adjust according to design */
    height: auto;
    display: block;
    margin: 0 auto 10px auto;
}
.hindi-title {
    font-size: 24px;
    color: #000080;
    margin: 5px 0;
}
.registration-info p,
.iso-cert p,
.website p {
    margin: 4px 0;
    font-size: 16px;
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
                    <!-- Logo instead of H1 -->
                    <img src="{{asset('document/images/logo.png')}}" alt="Maya Computer Center Logo" class="main-logo">

                    <h2 class="hindi-title">माया कम्प्यूटर सेंटर</h2>

                    <div class="registration-info">
                        <p><strong>Reg. Under the Company Act,2013 MCA, Government of India</strong></p>
                        <p><strong>Registered Under Skill India, Udyam & Startup India</strong></p>
                    </div>

                    <div class="iso-cert">
                        <p><strong>An ISO 9001: 2015 Certified</strong></p>
                    </div>

                    <div class="website">
                        <p>Our Website: <a href="https://mayacomputercenter.in/">https://mayacomputercenter.in/</a></p>
                    </div>
                </div>

                
                <!-- <div class="qr-section">
                    <div class="qr-code">
                        <div class="qr-placeholder">QR</div>
                    </div>
                    <p class="qr-number">66123040127</p>
                </div> -->
            </div>

            <div class="cin-number">
                <p><strong>CIN:</strong> U47411DL2023PTC422329</p>
            </div>

            <!-- Certificate Body -->
            <div class="cert-header">
                <h3>Certificate of Authorization</h3>
            </div>

            <div class="cert-body">
                <div class="cert-content">
                    <p class="cert-text"><em>This is Certify that</em></p>
                    <p class="company-name"><strong>{{$center->cl_center_name ?? ''}}</strong></p>
                    <p class="represented-by"><em>Represented by</em></p>
                    <p class="person-name"><strong>{{$center->cl_director_name ?? ''}}</strong></p>
                    <p class="office-text"><em>Having its Office at</em></p>
                    <p class="address"><strong>{{$center->cl_center_address ?? ''}}</strong></p>
                    <p class="center-code-label"><em>Center Code</em></p>
                    <p class="center-code"><strong>{{$center->cl_code}}</strong></p>
                    <p class="authorization-text"><em>Authorized to conduct different academic and technical programs<br>
                    under the symbol and banner of</em></p>
                    <p class="company-full-name"><strong>MAYA COMPUTER CENTER PRIVATE LIMITED</strong></p>
                </div>
                
                <div class="photo-section">
                    <div class="photo-frame">
                        <div class="photo-placeholder">
                            <img src="{{asset($center->cl_photo)}}" alt="">
                        </div>
                        <div class="signature-area">
                            <div class="signature-line"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logos Section -->
            <div class="logos-section">
                <div class="logo-item">
                    <img src="{{asset('document/images/skill_india.jpg')}}" alt="Skill India" class="logo-img">
                </div>
                <div class="logo-item">
                    <img src="ministry.png" alt="Ministry of Skill Development" class="logo-img">
                    <p>MINISTRY OF SKILL DEVELOPMENT AND ENTREPRENEURSHIP</p>
                </div>
                <div class="logo-item">
                    <img src="nsdc.png" alt="NSDC" class="logo-img">
                    <p>NATIONAL SKILL DEVELOPMENT CORPORATION</p>
                </div>
                <div class="logo-item">
                    <img src="corporate.png" alt="Ministry of Corporate Affairs" class="logo-img">
                    <p>MINISTRY OF CORPORATE AFFAIRS<br>GOVERNMENT OF INDIA</p>
                </div>
                <div class="logo-item">
                    <img src="dpiit.png" alt="DPIIT" class="logo-img">
                    <p>#startupindia</p>
                </div>
            </div>

            <!-- Footer Section -->
            <div class="footer-section">
                <div class="footer-item">
                    <p><strong><u>Date of Registration</u></strong></p>
                    <p><strong>{{$center->created_at->format('d-M-Y')}}</strong></p>
                </div>
                <div class="footer-item">
                    <p><strong><u>Date of Registration</u></strong></p>
                    <p><strong>{{ $expirationDate->format('d-M-Y') }}</strong></p>
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