<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate - Maya Computer Center</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;700&family=Times+New+Roman&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap');

        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
        }

        .certificate-container {
            width: 297mm;
            /* A4 Landscape */
            height: 210mm;
            background: #fff;
            padding: 10mm;
            position: relative;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        /* Decorative Border */
        .border-wrapper {
            border: 3px solid #000080;
            height: 100%;
            width: 100%;
            padding: 3px;
            position: relative;
        }

        .inner-border {
            border: 2px solid #000;
            /* Pattern placeholder */
            border-image: repeating-linear-gradient(45deg, #000080, #000080 10px, transparent 10px, transparent 20px) 1;
            height: 100%;
            width: 100%;
            padding: 5mm;
            display: flex;
            flex-direction: column;
        }

        /* Watermark */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
            z-index: 0;
            width: 50%;
            pointer-events: none;
        }

        .content {
            position: relative;
            z-index: 1;
            text-align: center;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        /* Header Copied & Adjusted */
        /* Header Copied & Adjusted */
        .header {
            position: relative;
            margin-bottom: 5px;
            width: 100%;
        }

        .header-banner {
            width: 88%;
            height: auto;
             max-height: 153px;
            display: block;
        }

        .header-subtext {
            text-align: center;
            margin-top: -27px;
            /* More gap for landscape probably needed, but keeping consistent first */
            padding-left: 40px;
        }

        .reg-details {
            font-size: 11px;
            /* Slightly larger for cert */
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
            top: 31px;
            width: 80px;
            /* Kept 80px for Cert */
            height: 80px;
            border: 1px solid #ddd;
            background: #fff;
        }

        /* Certificate Titles */
        .title-section {
            margin: 10px 0 20px 0;
        }

        .cert-title {
            font-family: 'Playfair Display', serif;
            /* Or Monotype Corsiva equivalent */
            font-size: 36px;
            color: #008CB4;
            /* Cyan/Blue shade */
            font-weight: bold;
            margin: 0;
            text-decoration: underline;
            text-underline-offset: 5px;
            font-style: italic;
        }

        /* Student Content */
        .main-text {
            font-size: 16px;
            line-height: 1.6;
            color: #000;
            margin-top: 10px;
            font-style: italic;
        }

        .student-name {
            font-size: 22px;
            font-weight: bold;
            color: #000080;
            text-transform: uppercase;
            display: block;
            margin: 5px 0;
            font-family: "Times New Roman", Times, serif;
            font-style: normal;
        }

        .highlight-text {
            font-weight: bold;
            color: #000;
        }

        .student-photo {
            position: absolute;
            right: 20px;
            top: 240px;
            /* Moved down to avoid overlap */
            width: 100px;
            height: 120px;
            border: 1px solid #ccc;
            padding: 2px;
            background: #fff;
        }

        .student-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Footer Logos */
        .logo-footer {
            /* Removed margin-top: auto from here */
            border-top: 0px solid #ccc;
            padding-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .logo-strip {
            display: flex;
            width: 100%;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0;
            padding-bottom: 0;
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
            padding: 0 50px;
            margin-top: auto;
            /* Pushes to bottom */
            margin-bottom: 10px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: underline;
        }

        /* Print styles */
        @media print {
            body {
                background: none;
                padding: 0;
            }

            .certificate-container {
                box-shadow: none;
                margin: 0;
                page-break-after: always;
            }

            @page {
                size: A4 landscape;
                margin: 0;
            }
             .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="certificate-container">
        <div class="border-wrapper">
            <div class="inner-border">

                <!-- Watermark -->
                 <img src="@if(!empty($setting->document_logo) && file_exists(public_path($setting->document_logo))){{ asset($setting->document_logo) }}@else{{ asset('logo.png') }}@endif" class="watermark" alt="Watermark" style="opacity: 0.05;">


                <div class="content">

                    <!-- Header -->
                    <div class="header">
                         @if(!empty($setting->document_logo) && file_exists(public_path($setting->document_logo)))
                            <img src="{{ asset($setting->document_logo) }}" alt="Maya Computer Center Banner" class="header-banner">
                        @else
                            <img src="{{ asset('header_banner.png') }}" alt="Maya Computer Center Banner" class="header-banner">
                        @endif
                        <div class="header-subtext">
                            <p class="reg-details">CIN : U85220DL2023PTC422329</p>
                            <p class="reg-details">Reg. Under the Company Act.2013 MCA, Government of India</p>
                            <p class="reg-details">Registered Under Skill India, Udyam & Startup India</p>
                            <p class="iso-text">An ISO 9001: 2015 Certified</p>
                        </div>
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-certificate/'.$certificate->sc_certificate_number) }}"
                            alt="QR Code" class="qr-code">
                    </div>

                    <!-- Title -->
                    <div class="title-section">
                        <h2 class="cert-title">Certificate of Diploma</h2>
                    </div>

                    <!-- Student Photo -->
                    <div class="student-photo">
                         @if(!empty($certificate->sl_photo) && file_exists(public_path($certificate->sl_photo)))
                                <img src="{{ asset($certificate->sl_photo) }}" alt="Student Photo">
                            @else
                                <img src="https://via.placeholder.com/90x110?text=Photo" alt="Student Photo">
                            @endif
                    </div>

                    <!-- Main Text -->
                    <div class="main-text">
                        This Certificate / Diploma is Awarded to <br>
                        <span class="student-name">{{ strtoupper($certificate->sl_name ?? '') }}</span>

                        S/o â€“ <span class="highlight-text">{{ strtoupper($certificate->sl_father_name ?? '') }}</span>, Reg No, <span
                            class="highlight-text">{{ $certificate->sl_reg_no ?? 'N/A' }}</span> on successfully <br>
                        completion of <span class="highlight-text">{{ $certificate->c_full_name ?? '' }}</span>
                        (Duration - {{ $certificate->c_duration ?? '' }}) <br>
                        Course and secured <span class="highlight-text">{{ number_format($certificate->sr_percentage ?? 0, 2) }}%</span> with Grade <span
                            class="highlight-text">{{ strtoupper($certificate->sr_grade ?? 'N/A') }}</span> from our authorised Study Centre {{ $certificate->cl_center_name ?? '' }},
                        <br>
                        {{ $certificate->cl_center_address ?? '' }}, Centre Code {{ $certificate->cl_code ?? '' }}
                        <br><br>
                        <span class="highlight-text">On the recommendation of the board of examination</span><br>
                        <span class="highlight-text">Date of Issue: {{ $certificate->sc_issue_date ? \Carbon\Carbon::parse($certificate->sc_issue_date)->format('d-M-Y') : \Carbon\Carbon::now()->format('d-M-Y') }}</span>
                    </div>

                    <!-- Signatures -->
                    <div class="signatures">
                        <span>Center Head Signature</span>
                        <span>Authorized Signatory</span>
                    </div>

                    <!-- Logos Strip -->
                    <div class="logo-footer">
                        <div class="logo-strip">
                             @if(!empty($setting->certificate_footer_logos))
                                @php $logos = json_decode($setting->certificate_footer_logos); @endphp
                                @if(is_array($logos))
                                    @foreach($logos as $logo)
                                         <img src="{{ asset($logo) }}" alt="Logo" class="footer-logo">
                                    @endforeach
                                @endif
                            @else
                            <!-- Fallback logos if dynamic not set -->
                            <div style="text-align:center; width:100%; font-size:12px;">Footer Logos</div>
                            @endif
                        </div>
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
