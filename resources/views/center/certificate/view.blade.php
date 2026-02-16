<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Diploma</title>
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
            height: 209mm;
            /* Fixed height for A4 */
            background-color: white;
            padding: 6px;
            position: relative;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            overflow: hidden;
        }

        /* Border System */
        .border-pattern {
            position: relative;
            padding: 6px;
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
            padding: 10px;
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
            padding: 5px 30px 12px 30px;
            height: 100%;
            border: 1px solid #c5a059;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
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
            max-height: 120px;
            /* Reduced to fit */
            object-fit: contain;
        }

        .header-subtext {
            margin-top: -26px;
            position: relative;
            left: 50px;
            /* Shift to right as requested */
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
        }

        .qr-wrapper img {
            width: 70px;
            height: 70px;
            border: 1px solid #ddd;
            margin-bottom: 5px;
        }

        .qr-wrapper .sn-top-right {
            font-size: 12px;
            font-weight: bold;
            display: block;
            margin-top: 4px;
            white-space: nowrap;
            text-align: center;
            font-family: 'Times New Roman', serif;
        }

        .hologram-wrapper {
            position: absolute;
            left: 10px;
            /* Left side */
            top: 10px;
            /* Top place */
            z-index: 10;
        }

        .hologram-wrapper img {
            width: 80px;
            /* Adjust size as needed */
            height: auto;
        }

        .sn-text {
            display: block;
            font-size: 10px;
            font-weight: bold;
        }

        /* Content */
        /* Title Bar */
        .title-bar {
            background-color: #0f1d46;
            /* Solid Navy */
            color: #fff;
            text-align: center;
            padding: 1px 0;
            /* Reduced Height */
            margin: 3px -30px;
            border-top: 1px solid #c5a059;
            border-bottom: 1px solid #c5a059;
        }

        .title-bar h2 {
            font-family: 'Cinzel', serif;
            font-size: 26px;
            margin: 0;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .main-content {
            text-align: center;
            padding: 0 160px 0 50px;
            position: relative;
        }

        .certify-text {
            font-style: italic;
            font-size: 20px;
            color: #444;
            margin-bottom: 5px;
        }

        .center-name {
            font-size: 22px;
            /* Reduced from 24px */
            font-weight: bold;
            color: #000;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .student-details {
            font-size: 16px;
            line-height: 1.45;
            margin-top: 5px;
            color: #000;
        }

        .company-name {
            color: #002060;
            font-weight: 800;
            font-style: normal;
            text-decoration: underline;
            text-transform: uppercase;
            font-size: 20px;
            display: block;
            margin-top: 5px;
        }

        /* Photo - aligned beside content, clear spacing from right border */
        .photo-box {
            position: absolute;
            top: 8px;
            right: 20px;
            width: 100px;
            height: 130px;
            border: 1px solid #000;
            background: #fff;
            padding: 2px;
            box-sizing: border-box;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Footer Section - sits close below main content, no extra gap */
        .footer-section {
            margin-top: 10px;
            padding-bottom: 3px;
        }

        .footer-logos {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 4px;
            margin-bottom: 1px;
            border-top: 1px solid #eee;
            padding-top: 2px;
            flex-wrap: nowrap;
        }

        .footer-logo {
            height: 48px;
            width: auto;
            max-width: 180px;
            object-fit: contain;
            display: block;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            align-items: stretch;
            padding: 0 20px;
            gap: 10px;
            margin-top: 1px;
        }

        .sig-block {
            display: flex;
            flex-direction: column;
            text-align: center;
            width: 200px;
            min-width: 180px;
        }

        .sig-date-area {
            height: 78px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
            text-align: center;
            flex-shrink: 0;
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
            border-bottom: 1px solid #ccc;
            padding-bottom: 2px;
            display: inline-block;
            min-width: 100px;
        }

        /* Stamp & signature - same size as center_certificate.blade.php (both blocks) */
        .sig-overlap-container {
            display: flex;
            flex-direction: column;
            position: relative;
            width: 200px;
            min-width: 180px;
            text-align: center;
        }

        .sig-area {
            position: relative;
            height: 110px;
            width: 200px;
            margin: 0 auto;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .stamp-img {
            position: absolute;
            height: 130px;
            width: auto;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            object-fit: contain;
            opacity: 0.8;
            z-index: 1;
        }

        .sign-img {
            position: absolute;
            height: 50px;
            width: auto;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            object-fit: contain;
            z-index: 2;
        }

        .sig-line {
            padding-top: 4px;
            margin-top: -31px;
            min-height: 18px;
            font-weight: bold;
            font-size: 14px;
            color: #333;
            line-height: 1.3;
        }

        @page {
            size: A4 landscape;
            margin: 0;
        }

        @media print {
            body {
                padding: 0;
                margin: 0;
            }

            .certificate-container {
                width: 297mm;
                height: 209mm;
                box-shadow: none;
                border: none;
            }

            .no-print {
                display: none;
            }

            * {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
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
                                    <div
                                        style="font-weight: bold; font-size: 14px; text-align: center; margin-bottom: 5px;">
                                        Certificate No. : <span
                                            style="font-family: 'DotGothic16', sans-serif; font-size: 16px; letter-spacing: 5px;">{{ $certificate->sc_certificate_number }}</span>
                                    </div>
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
                                <p class="reg-details" style="font-size:12px;">Registered Under NCT Delhi, Skill India,
                                    Udyam & Startup India</p>
                                <p class="iso-text">An ISO 9001: 2015 Certified</p>
                                <p class="reg-details" style="font-size: 11px; margin-top: 2px;">Visit Our Website : mayacc.in</p>
                            </div>
                            <div class="qr-wrapper">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-certificate/' . $certificate->sc_certificate_number) }}"
                                    alt="QR">
                                <span class="sn-top-right">SN. MCC{{ str_pad($certificate->sl_id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>

                        <div class="title-bar">
                            <h2>Certificate of Diploma</h2>
                        </div>

                        <!-- Middle Content -->
                        <div class="main-content">
                            <div class="certify-text"
                                style="font-family: 'Times New Roman', serif; font-weight: bold; font-size: 16px; margin-top: 10px;">
                                THIS CERTIFICATE / DIPLOMA IS AWARDED TO</div>
                            <div class="center-name"
                                style="color: blue; font-family: 'Times New Roman', serif; font-size: 26px; font-weight: bold; margin: 8px 0;">
                                {{ strtoupper($certificate->sl_name ?? '') }}
                            </div>

                            <div class="student-details" style="font-family: 'Times New Roman', serif; font-style: italic; font-size: 18px; line-height: 1.5; color: #000;">
                                S/o – <b>{{ ucwords(strtolower($certificate->sl_father_name ?? '')) }}</b> , Reg No.
                                <b>{{ $certificate->sl_reg_no }}</b> on successfully completion of<br>
                                <b>{{ $certificate->c_full_name ?? '' }}</b> ( Duration -
                                {{ $certificate->c_duration ?? '' }} ) Course and secured
                                <b>{{ number_format($certificate->sr_percentage ?? 0, 2) }}%</b> with Grade
                                <b>{{ strtoupper($certificate->sr_grade ?? '') }} *</b> from our authorised Study Centre
                            </div>

                            <div class="center-study-details"
                                style="font-family: 'Times New Roman', serif; font-style: italic; font-size: 18px; color: #000; font-weight: bold; line-height: 1.6;">
                                {{ $certificate->cl_center_name ?? '' }} , {{ $certificate->cl_center_address ?? '' }}
                                <br>
                                Centre Code {{ $certificate->cl_code ?? '' }}
                            </div>

                            <div class="recommendation-text"
                                style="margin-top: 5px; font-family: 'Times New Roman', serif; font-weight: bold; font-size: 16px; color: #000;">
                                On the recommendation of the board of examination
                            </div>

                            <!-- Photo Positioned Absolute in Content Area -->
                            <div class="photo-box">
                                @if(!empty($certificate->sl_photo) && file_exists(public_path($certificate->sl_photo)))
                                    <img src="{{ asset($certificate->sl_photo) }}" alt="Student">
                                @else
                                    <img src="https://via.placeholder.com/100x130?text=PHOTO" alt="Photo">
                                @endif
                            </div>

                            <div class="authorization-text"
                                style="margin-top: 4px; font-size:14px;">
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
                                    <img src="https://via.placeholder.com/100x40?text=Partner+Logos" class="footer-logo"
                                        alt="Logos">
                                @endif
                            </div>

                            <div class="signatures">
                                <div class="sig-block">
                                    <div class="sig-date-area">
                                        <div class="sig-title">Date of Issue</div>
                                        <div class="date-val">
                                            {{ $certificate->sc_issue_date ? \Carbon\Carbon::parse($certificate->sc_issue_date)->format('d-M-Y') : 'N/A' }}
                                        </div>
                                    </div>
                                    <div class="sig-line">&nbsp;</div>
                                </div>

                                <div class="sig-overlap-container">
                                    <div class="sig-area">
                                        @if(!empty($certificate->cl_center_stamp) && file_exists(public_path($certificate->cl_center_stamp)))
                                            <img src="{{ asset($certificate->cl_center_stamp) }}" class="stamp-img" alt="Center Stamp">
                                        @endif
                                        @if(!empty($certificate->cl_authorized_signature) && file_exists(public_path($certificate->cl_authorized_signature)))
                                            <img src="{{ asset($certificate->cl_authorized_signature) }}" class="sign-img" alt="Center Sign">
                                        @endif
                                    </div>
                                    <div class="sig-line">Center Head Signature</div>
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
        <button onclick="window.print()"
            style="padding: 10px 20px; background: #0f1d46; color: white; border: none; cursor: pointer; border-radius: 5px; font-weight:bold; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">PRINT
            CERTIFICATE</button>
    </div>

</body>

</html>