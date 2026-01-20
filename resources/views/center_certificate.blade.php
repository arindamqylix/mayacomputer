<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Authorization</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Noto+Sans+Devanagari:wght@700&family=Open+Sans:wght@400;600;700&family=Playfair+Display:wght@700&display=swap');

        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
        }

        body {
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            font-family: 'Open Sans', sans-serif;
        }

        .certificate-container {
            width: 1000px;
            /* Approximate landscape proportion */
            background-color: white;
            padding: 10px;
            border: 1px solid #ddd;
            position: relative;
        }

        .border-pattern {
            border: 3px solid #6a1b6a;
            /* Purple outer border */
            padding: 3px;
            height: 100%;
        }

        .inner-border {
            border: 2px dashed #6a1b6a;
            padding: 20px;
            height: 100%;
            position: relative;
        }

        /* Corner decorations (simulated) */
        .corner {
            position: absolute;
            width: 30px;
            height: 30px;
            border: 2px solid #6a1b6a;
            z-index: 1;
        }

        .top-left {
            top: 5px;
            left: 5px;
            border-right: none;
            border-bottom: none;
        }

        .top-right {
            top: 5px;
            right: 5px;
            border-left: none;
            border-bottom: none;
        }

        .bottom-left {
            bottom: 5px;
            left: 5px;
            border-right: none;
            border-top: none;
        }

        .bottom-right {
            bottom: 5px;
            right: 5px;
            border-left: none;
            border-top: none;
        }

        /* Header Copied & Adjusted */
        .header {
            position: relative;
            margin-bottom: 5px;
            width: 100%;
        }

        .header-banner {
            width: 88%;
            height: auto;
             max-height: 162px;
            display: block;
        }

        .header-subtext {
            text-align: center;
            margin-top: -27px;
            padding-left: 40px;
        }

        .reg-details {
            font-size: 11px;
            font-weight: bold;
            margin: 2px 0;
            color: #000;
            font-family: Arial, sans-serif;
        }

        .iso-text {
            color: red;
            font-weight: bold;
            font-size: 13px;
            margin: 4px 0;
            font-family: Arial, sans-serif;
        }

        .qr-code {
            position: absolute;
            right: 0;
            top: 28px;
            width: 80px;
            height: 80px;
            border: 1px solid #ddd;
            background: #fff;
        }

        /* Title Bar */
        .title-bar {
            background-color: #0f1d46;
            color: white;
            text-align: center;
            padding: 8px 0;
            margin: 10px 0 20px 0;
            position: relative;
        }

        .title-bar h2 {
            font-family: 'Great Vibes', cursive;
            font-size: 32px;
            margin: 0;
            font-weight: normal;
            letter-spacing: 1px;
        }

        /* Main Content */
        .content {
            text-align: center;
            position: relative;
            padding: 0 40px;
        }

        .certify-text {
            font-style: italic;
            font-size: 16px;
            color: #333;
            margin-bottom: 15px;
        }

        .center-name {
            font-size: 24px;
            font-weight: bold;
            color: #000;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .represented-by {
            font-style: italic;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .person-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .address-label {
            font-style: italic;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .address {
            font-weight: bold;
            font-size: 14px;
            max-width: 60%;
            margin: 0 auto 10px auto;
        }

        .center-code-label {
            font-style: italic;
            font-size: 14px;
        }

        .center-code {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Photo Box */
        .photo-box {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 120px;
            height: 150px;
            border: 1px solid #000;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Authorization Text */
        .authorization-text {
            font-style: italic;
            font-size: 14px;
            margin: 20px auto;
            max-width: 80%;
            line-height: 1.5;
        }

        .company-name {
            color: #002060;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 16px;
            display: block;
            margin-top: 5px;
        }

        /* Footer Logos */
        .footer-logos {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
            align-items: center;
        }

        .footer-logo {
            width: 90px;
            height: auto;
            object-fit: contain;
        }

        /* Signatures */
        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
            padding: 0 40px;
        }

        .signature-block {
            text-align: center;
            width: 200px;
        }

        .signature-title {
            font-weight: bold;
            font-size: 12px;
            text-decoration: underline;
            margin-bottom: 5px;
        }

        .date-val {
            font-weight: bold;
            font-size: 12px;
        }

        .signature-line {
            margin-top: 40px;
            /* Space for signature */
            border-top: 1px solid #000;
            padding-top: 5px;
            font-weight: bold;
            font-size: 12px;
        }

        /* Print Settings */
        @media print {
            body {
                background: none;
                padding: 0;
            }

            .certificate-container {
                width: 100%;
                border: none;
            }
             .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="certificate-container">
        <div class="border-pattern">
            <div class="inner-border">

                <!-- Header -->
                <div class="header">
                     @if(!empty($setting->document_logo) && file_exists(public_path($setting->document_logo)))
                        <img src="{{ asset($setting->document_logo) }}" alt="Maya Computer Center Banner" class="header-banner">
                    @else
                        <img src="{{ asset('header_banner.png') }}" alt="Maya Computer Center Banner" class="header-banner">
                    @endif
                    <div class="header-subtext">
                        <p class="reg-details">Reg. Under the Company Act.2013 MCA, Government of India</p>
                        <p class="reg-details">Registered Under Skill India, Udyam & Startup India</p>
                        <p class="iso-text">An ISO 9001: 2015 Certified</p>
                    </div>
                     <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-center/'.$center->cl_code) }}"
                            alt="QR Code" class="qr-code">
                </div>

                <div class="title-bar">
                    <h2>Certificate of Authorization</h2>
                </div>

                <div class="content">
                    <div class="certify-text">This is Certify that</div>
                    <div class="center-name">{{ strtoupper($center->cl_center_name ?? '') }}</div>

                    <div class="represented-by">Represented by</div>
                    <div class="person-name">{{ strtoupper($center->cl_director_name ?? '') }}</div>

                    <div class="address-label">Having its Office at</div>
                    <div class="address">{{ $center->cl_center_address ?? '' }}</div>

                    <div class="center-code-label">Center Code</div>
                    <div class="center-code">{{ $center->cl_code ?? '' }}</div>

                    <!-- Photo Box on Right -->
                    <div class="photo-box">
                         @if(!empty($center->cl_photo) && file_exists(public_path($center->cl_photo)))
                            <img src="{{ asset($center->cl_photo) }}" alt="Photo">
                        @else
                            <img src="https://via.placeholder.com/120x150?text=PHOTO" alt="Photo">
                        @endif
                    </div>

                    <div class="authorization-text">
                        Authorized to conduct different academic and technical programs<br>
                        under the symbol and banner of
                        <span class="company-name">MAYA COMPUTER CENTER PRIVATE LIMITED</span>
                    </div>
                </div>

                <div class="footer-logos">
                     @if(!empty($setting->certificate_footer_logos))
                        @php $logos = json_decode($setting->certificate_footer_logos); @endphp
                        @if(is_array($logos))
                            @foreach($logos as $logo)
                                    <img src="{{ asset($logo) }}" alt="Logo" class="footer-logo">
                            @endforeach
                        @endif
                    @else
                    <!-- Fallback -->
                    <img src="https://via.placeholder.com/100x40?text=Logos" alt="Logos" class="footer-logo">
                    @endif
                </div>

                <div class="signatures">
                    <div class="signature-block">
                        <div class="signature-title">Date of Registration</div>
                        <div class="date-val">{{ $center->cl_registration_date ? \Carbon\Carbon::parse($center->cl_registration_date)->format('d-M-Y') : 'N/A' }}</div>
                    </div>

                    <div class="signature-block">
                        <div class="signature-title">Valid Upto</div>
                         <div class="date-val">{{ $center->cl_valid_till ? \Carbon\Carbon::parse($center->cl_valid_till)->format('d-M-Y') : 'N/A' }}</div>
                    </div>

                    <div class="signature-block">
                        <!-- Space for signature image if exists, otherwise text label at bottom -->
                         @if(!empty($center->cl_center_signature) && file_exists(public_path($center->cl_center_signature)))
                             <img src="{{ asset($center->cl_center_signature) }}" style="height: 40px; margin-top: 10px;" alt="Sign">
                             <div class="signature-line" style="border-top:none; margin-top:5px;">Authorized Signatory</div>
                        @else
                            <div style="height: 20px;"></div>
                            <div class="signature-line">Authorized Signatory</div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
    
          <!-- Print Button (Hidden in Print Mode) -->
    <div style="text-align: center; margin-top: 20px;" class="no-print">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; background: #000066; color: white; border: none; cursor: pointer;">Print Certificate</button>
    </div>

</body>

</html>