<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Authorization</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Noto+Sans+Devanagari:wght@700&family=Open+Sans:wght@400;600;700&family=Playfair+Display:wght@700&family=DotGothic16&display=swap');

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

        /* A4 Landscape Dimensions */
        .certificate-container {
            width: 297mm;
            height: 209mm; /* Fixed height for A4 */
            background-color: white;
            padding: 10px;
            position: relative;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin: 0 auto;
            overflow: hidden;
        }

        /* Border System */
        .border-pattern {
            position: relative;
            padding: 10px;
            background: #fff;
            border: none;
            height: 100%;
        }
        
        .border-inner {
            border: 2px solid #0f1d46;
            padding: 3px;
            height: 100%;
        }

        .border-design {
            border: 1px solid #0f1d46;
            padding: 15px;
            height: 100%;
            background-image: 
                linear-gradient(45deg, #0f1d46 25%, transparent 25%, transparent 75%, #0f1d46 75%, #0f1d46),
                linear-gradient(45deg, #0f1d46 25%, transparent 25%, transparent 75%, #0f1d46 75%, #0f1d46);
            background-position: 0 0, 10px 10px;
            background-size: 20px 20px;
            background-repeat: repeat;
        }

        .content-area-white {
            background-color: white;
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200'%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' font-family='Arial, sans-serif' font-weight='bold' font-size='10' fill='%230f1d46' opacity='0.05' transform='rotate(-45 100 100)'%3EMAYA COMPUTER CENTER PRIVATE LIMITED%3C/text%3E%3C/svg%3E");
            padding: 5px 30px 25px 30px;
            height: 100%;
            border: 1px solid #c5a059;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Distribute vertical space */
        }

        /* Header */
        .header {
            position: relative;
            width: 100%;
            text-align: center;
            margin-bottom: 5px;
        }

        .header-banner {
            width: 80%;
            max-height: 120px; /* Reduced to fit */
            object-fit: contain;
        }

        .header-subtext {
            margin-top: -26px;
            position: relative;
            left: 50px; /* Shift to right as requested */
        }

        .reg-details {
            font-size: 15px;
            font-weight: bold;
            margin: 1px 0;
            color: #000;
        }

        .iso-text {
            color: red;
            font-weight: bold;
            font-size: 15px;
            margin: 2px 0;
        }

        .qr-wrapper {
            position: absolute;
            right: 10px;
            top: 10px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100px;
        }

        .qr-wrapper img {
            width: 80px;
            height: 80px;
            border: 1px solid #ddd;
            margin-bottom: 2px;
        }

        .hologram-wrapper {
            position: absolute;
            left: 10px; /* Left side */
            top: 10px;  /* Top place */
            z-index: 10;
        }

        .hologram-wrapper img {
            width: 80px; /* Adjust size as needed */
            height: auto;
        }

        .sn-text {
            font-size: 12px;
            font-weight: bold;
            font-family: 'DotGothic16', sans-serif;
        }

        /* Content */
        /* Title Bar */
        .title-bar {
            background-color: #0f1d46; /* Solid Navy */
            color: #fff;
            text-align: center;
            padding: 1px 0; /* Reduced Height */
            margin: 5px -30px; /* Reduced from 10px */
            border-top: 1px solid #c5a059;
            border-bottom: 1px solid #c5a059;
        }

        .title-bar h2 {
            font-family: 'Cinzel', serif; /* Simple Professional Font */
            font-size: 30px; /* Reduced Size */
            margin: 0;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .main-content {
            text-align: center;
            padding: 0 50px;
            position: relative;
            flex-grow: 1;
        }

        .certify-text {
            font-style: italic;
            font-size: 20px;
            color: #444;
            margin-bottom: 5px;
        }

        .center-name {
            font-size: 22px; /* Reduced from 24px */
            font-weight: bold;
            color: #000;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .represented-by {
            font-style: italic;
            font-size: 20px;
            margin-bottom: 2px;
        }

        .person-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .address-box {
            margin-bottom: 5px;
        }

        .address {
            font-weight: bold;
            font-size: 13px;
            max-width: 90%;
            margin: 0 auto;
            line-height: 1.3;
        }

        .center-code {
            font-size: 20px;
            font-weight: bold;
            margin: 5px 0;
        }

        .authorization-text {
            font-style: italic;
            font-size: 15px;
            margin: 5px auto;
            max-width: 90%;
        }

        .company-name {
            color: #002060;
            font-weight: 800; /* Extra Bold */
            font-style: normal; /* Remove Italic */
            text-decoration: underline; /* Add Underline */
            text-transform: uppercase;
            font-size: 20px; /* Increased Size */
            display: block;
            margin-top: 5px;
        }

        /* Photo */
        .photo-box {
            position: absolute;
            top: 40px;
            right: 0;
            width: 100px;
            height: 130px;
            border: 1px solid #000;
            background: #fff;
            padding: 2px;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Footer Section */
        .footer-section {
            margin-top: auto;
            padding-bottom: 10px;
        }

        .footer-logos {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 5px;
            border-top: 1px solid #eee;
            padding-top: 5px;
        }

        .footer-logo {
            height: 40px;
            width: auto;
            object-fit: contain;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            align-items: flex-end; /* CRITICAL FIX: Align bottom */
            padding: 0 20px;
        }

        .sig-block {
            text-align: center;
            width: 180px;
        }

        .sig-title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .date-val {
            font-size: 15px;
            font-weight: bold;
            border-bottom: 1px solid #ccc; /* Subtle underline for alignment */
            padding-bottom: 2px;
            display: inline-block;
            min-width: 100px;
        }

        .sig-overlap-container {
            position: relative;
            width: 200px;
            text-align: center;
        }

        .sig-area {
            position: relative;
            height: 110px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .stamp-img {
            position: absolute;
            height: 130px;
            opacity: 0.8;
            z-index: 1;
        }

        .sign-img {
            position: relative;
            height: 50px;
            z-index: 2;
            margin-bottom: 5px;
        }

        .sig-line {
            /* border-top: 1px solid #0f1d46; */
            padding-top: 4px;
            margin-top: -31px;
            font-weight: bold;
            font-size: 14px;
            color: #333;
        }

        @page { size: A4 landscape; margin: 0; }
        @media print {
            body { padding: 0; margin: 0; }
            .certificate-container { width: 297mm; height: 209mm; box-shadow: none; border: none; }
            .no-print { display: none; }
            * { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>

    <div class="certificate-container">
        <div class="border-pattern">
            <div class="border-inner">
                <div class="border-design">
                    <div class="content-area-white">

                        <!-- Top Section -->
                        <div class="header">
                            @if(!empty($setting->hologram) && file_exists(public_path($setting->hologram)))
                                <div class="hologram-wrapper">
                                     <div style="font-weight: bold; font-size: 14px; text-align: center; margin-bottom: 2px;">Certificate No. : {{ str_pad($center->cl_id, 3, '0', STR_PAD_LEFT) }}</div>
                                     <img src="{{ asset($setting->hologram) }}" alt="Hologram">
                                </div>
                            @endif

                             @if(!empty($setting->document_logo) && file_exists(public_path($setting->document_logo)))
                                <img src="{{ asset($setting->document_logo) }}" alt="Header Banner" class="header-banner">
                            @else
                                <img src="{{ asset('header_banner.png') }}" alt="Header Banner" class="header-banner">
                            @endif
                            <div class="header-subtext">
                                <p class="reg-details">CIN : U85220DL2023PTC422329</p>
                                <p class="reg-details">Reg. Under the Company Act.2013 MCA, Government of India</p>
                                <p class="reg-details" style="font-size:12px;">Registered Under NCT Delhi, Skill India, Udyam & Startup India</p>
                                <p class="iso-text">An ISO 9001: 2015 Certified</p>
                            </div>
                            <div class="qr-wrapper">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-center/'.$center->cl_code) }}" alt="QR">
                                <span class="sn-text">SN: MCC0{{ $center->cl_id }}</span>
                            </div>
                        </div>

                        <div class="title-bar">
                            <h2>Certificate of Authorization</h2>
                        </div>

                        <!-- Middle Content -->
                        <div class="main-content">
                            <div class="certify-text">This is to Certify that</div>
                            <div class="center-name">M/s. {{ strtoupper($center->cl_center_name ?? '') }}</div>
                            <div class="represented-by">Represented by</div>
                            <div class="person-name">{{ strtoupper($center->cl_director_name ?? '') }}</div>
                            
                            <div class="address-box">
                                <div class="address-label" style="font-style:italic; font-size:20px;">Having its Office at</div>
                                <div class="address">{{ $center->cl_center_address ?? '' }}</div>
                            </div>

                            <div class="center-code">
                                Center Code: {{ $center->cl_code ?? '' }}
                            </div>

                            <!-- Photo Positioned Absolute in Content Area -->
                            <div class="photo-box">
                                 @if(!empty($center->cl_photo) && file_exists(public_path($center->cl_photo)))
                                    <img src="{{ asset($center->cl_photo) }}" alt="Director">
                                @else
                                    <img src="https://via.placeholder.com/100x130?text=PHOTO" alt="Photo">
                                @endif
                            </div>

                            <div class="authorization-text">
                                Authorized to conduct different academic and technical programs
                                under the symbol and banner of
                                <span class="company-name">MAYA COMPUTER CENTER PRIVATE LIMITED</span>
                            </div>
                        </div>

                        <!-- Bottom Section -->
                        <div class="footer-section">
                            <div class="footer-logos">
                                 @if(!empty($setting->certificate_footer_logos))
                                    @php $logos = json_decode($setting->certificate_footer_logos); @endphp
                                    @if(is_array($logos))
                                        @foreach($logos as $logo)
                                            <img src="{{ asset($logo) }}" class="footer-logo" alt="Partner">
                                        @endforeach
                                    @endif
                                @else
                                    <img src="https://via.placeholder.com/100x40?text=Partner+Logos" class="footer-logo" alt="Logos">
                                @endif
                            </div>

                            <div class="signatures">
                                <div class="sig-block">
                                    <div class="sig-title">Date of Registration</div>
                                    <div class="date-val">{{ $center->cl_registration_date ? \Carbon\Carbon::parse($center->cl_registration_date)->format('d-M-Y') : 'N/A' }}</div>
                                </div>

                                <div class="sig-block">
                                    <div class="sig-title">Valid Upto</div>
                                    <div class="date-val">{{ $center->cl_valid_till ? \Carbon\Carbon::parse($center->cl_valid_till)->format('d-M-Y') : 'N/A' }}</div>
                                </div>

                                <div class="sig-overlap-container">
                                    <div class="sig-area">
                                        @if(!empty($setting->authorize_stamp) && file_exists(public_path($setting->authorize_stamp)))
                                             <img src="{{ asset($setting->authorize_stamp) }}" class="stamp-img" alt="Stamp">
                                        @endif
                                         @if(!empty($setting->authorize_signature) && file_exists(public_path($setting->authorize_signature)))
                                             <img src="{{ asset($setting->authorize_signature) }}" class="sign-img" alt="Sign">
                                        @endif
                                    </div>
                                    <div class="sig-line">Authorized Signatory</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div style="text-align: right; position: fixed; top: 10px; right: 20px; z-index: 1000;" class="no-print">
        <button onclick="window.print()" style="padding: 10px 20px; background: #0f1d46; color: white; border: none; cursor: pointer; border-radius: 5px; font-weight:bold; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">PRINT CERTIFICATE</button>
    </div>

</body>
</html>