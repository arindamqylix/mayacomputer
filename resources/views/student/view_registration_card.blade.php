<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Card - Maya Computer Center</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;700&family=Times+New+Roman&display=swap');

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

        .card-container {
            width: 210mm;
            /* A4 width */
            height: auto;
            background: #fff;
            padding: 2mm 10mm;
            padding-bottom: 20mm;
            border: 1px solid #ccc;
            position: relative;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .content {
            position: relative;
            z-index: 1;
            flex-grow: 1;
        }

        /* Header - same as center_certificate.blade.php: centered, 80% width, max-height 120px */
        .header {
            position: relative;
            width: 100%;
            text-align: center;
            margin-bottom: 5px;
            border-bottom: none;
            padding-bottom: 0;
        }

        .header-banner {
            width: 80%;
            max-height: 120px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .header-subtext {
            text-align: center;
            margin-top: -20px;
            padding-left: 0;
        }

        .reg-details {
            font-size: 10px;
            font-weight: bold;
            margin: 1px 0;
            color: #000;
            font-family: Arial, sans-serif;
        }

        .iso-text {
            color: red;
            font-weight: bold;
            font-size: 12px;
            margin: 2px 0;
            font-family: Arial, sans-serif;
        }

        /* Footer row: QR left, Controller right - aligned on same baseline */
        .card-footer-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 24px;
            width: 100%;
            min-height: 90px;
        }

        .qr-code-wrap {
            flex-shrink: 0;
        }

        .qr-code {
            width: 70px;
            height: 70px;
            border: 1px solid #ddd;
            background: #fff;
            display: block;
        }

        .qr-code-wrap .qr-sr-no {
            font-size: 10px;
            font-weight: 600;
            margin-top: 4px;
            text-align: center;
            color: #333;
        }

        /* Title strip */
        .card-title {
            text-align: center;
            color: green;
            font-size: 18px;
            font-weight: bold;
            margin: 5px 0 10px 0;
            text-transform: uppercase;
        }

        .tm-symbol {
            color: #ddd;
            font-size: 24px;
            position: absolute;
            right: 25%;
            top: 130px;
        }

        /* Registration Blue Bar - aligned with details section */
        .blue-bar {
            background-color: #000066;
            color: white;
            padding: 5px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            font-size: 14px;
            font-family: Arial, sans-serif;
            border: 1px solid #000;
            border-bottom: none;
        }

        /* Student Details */
        .details-section {
            border: 1px solid #ccc;
            border-top: none;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 10px 12px;
            background-color: #f9f9f980;
        }

        .details-main {
            flex: 1;
            min-width: 0;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .info-table td {
            padding: 4px 5px;
            vertical-align: top;
        }

        .label {
            font-weight: bold;
            font-style: normal;
            text-align: left;
            width: 175px;
            padding-right: 10px;
            color: #000;
        }

        .value {
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
        }

        .photo-column {
            flex: 0 0 102px;
            width: 102px;
        }

        .photo-frame {
            width: 102px;
            height: 127px;
            border: 2px solid #000;
            background: #fff;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center center;
            display: block;
        }

        .photo-empty {
            font-size: 9px;
            color: #999;
            line-height: 1.35;
            padding: 6px 4px;
        }

        .signature-frame {
            width: 102px;
            height: 38px;
            border: 2px solid #000;
            border-top: 1px solid #000;
            background: #fff;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8px;
            color: #999;
        }

        .signature-frame img {
            max-width: 96%;
            max-height: 34px;
            width: auto;
            height: auto;
            object-fit: contain;
            display: block;
        }

        /* Stamp & signature - same size as center_certificate.blade.php */
        .controller-sign {
            flex-shrink: 0;
            font-family: Arial, sans-serif;
        }

        .controller-sig-overlap {
            position: relative;
            width: 200px;
            text-align: center;
        }

        .controller-sig-area {
            position: relative;
            height: 110px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .controller-sig-area .auth-stamp {
            position: absolute;
            height: 130px;
            width: auto;
            object-fit: contain;
            opacity: 0.8;
            z-index: 1;
        }

        .controller-sig-area .auth-sign {
            position: relative;
            height: 50px;
            width: auto;
            object-fit: contain;
            z-index: 2;
            margin-bottom: 5px;
        }

        .controller-sig-label {
            padding-top: 4px;
            margin-top: -31px;
            font-weight: bold;
            font-size: 14px;
            color: #333;
            white-space: nowrap;
        }

        /* Print styles */
        @media print {
            body {
                background: none;
                padding: 0;
            }

            .card-container {
                box-shadow: none;
                border: none;
                width: 100%;
                height: auto;
            }
        }
    </style>
</head>

<body>

    <div class="card-container">
        <div class="content">
            <!-- Header Section -->
            <div class="header">
                @if(!empty($setting->document_logo) && file_exists(public_path($setting->document_logo)))
                    <img src="{{ asset($setting->document_logo) }}" alt="Maya Computer Center Banner" class="header-banner">
                @else
                    <img src="{{ asset('header_banner.png') }}" alt="Maya Computer Center Banner" class="header-banner">
                @endif
                <div class="header-subtext">
                    <p class="reg-details" style="font-size: 14px;">CIN : U85220DL2023PTC422329</p>
                    <p class="reg-details" style="font-size: 12px;">Reg. Under the Company Act.2013 MCA, Government of
                        India</p>
                    <p class="reg-details" style="font-size: 11px;">Registered Under NCT Delhi, Skill India, Udyam &
                        Startup India</p>
                    <p class="iso-text" style="font-size: 15px;">An ISO 9001: 2015 Certified</p>
                    <p class="reg-details" style="font-size: 11px; margin-top: 2px;">Visit Our Website : https://mayacomputercenter.in</p>
                </div>
            </div>

            <!-- Title -->
            <div class="card-title">
                पंजीयन पत्रक (REGISTRATION CARD) – {{ \Carbon\Carbon::now()->year }}
            </div>

            <!-- Blue Strip -->
            <div class="blue-bar">
                <span>Registration No. &nbsp;&nbsp;: {{ $data->sl_reg_no ?? 'N/A' }}</span>
                <span>Year : {{ \Carbon\Carbon::parse($data->created_at ?? now())->year }}</span>
            </div>

            <!-- Student Details -->
            <div class="details-section">
                <div class="details-main">
                <table class="info-table">
                    <tr>
                        <td class="label">Student Name</td>
                        <td class="value" colspan="2">: {{ strtoupper($data->sl_name ?? '') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Mother's Name</td>
                        <td class="value" colspan="2">: {{ strtoupper($data->sl_mother_name ?? '') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Father's Name</td>
                        <td class="value" colspan="2">: {{ strtoupper($data->sl_father_name ?? '') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Date of Birth</td>
                        <td class="value" colspan="2">:
                            {!! format_dob_display_html($data->sl_dob, 'N/A', true) !!}
                            &nbsp;&nbsp; Gen : {{ strtoupper($data->sl_sex ?? 'N/A') }} &nbsp;&nbsp; Cat :
                            {{ $data->sl_category ?? 'Gen' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Course Name</td>
                        <td class="value" colspan="2">:
                            {{ strtoupper($data->c_full_name ?? $data->c_short_name ?? '') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Course Duration</td>
                        <td class="value" colspan="2">:
                            @php $dur = $data->c_duration ?? 0;
                                if (is_numeric($dur) && $dur >= 12) {
                                    echo (round($dur / 12) == $dur / 12 ? (int) ($dur / 12) : number_format($dur / 12, 1)) . (($dur / 12) == 1 ? ' Year' : ' Years');
                                } elseif (is_numeric($dur) && $dur > 0) {
                                    echo (int) $dur . ($dur == 1 ? ' Month' : ' Months');
                                } else {
                                    echo $data->c_duration ?? 'N/A';
                            } @endphp
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Center Name</td>

                                                <td class="value" colspan="2">: {{ strtoupper($data->cl_center_name ?? $data->cl_name ?? '') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Center Code & Address</td>
                        <td class="value" colspan="2">: {{ $data->cl_code ?? '' }} &
                        {{ $data->cl_center_address ?? 'N/A' }}</td>
                    </tr>
            </table>
                </div>

                <div class="photo-column">
                    <div class="photo-frame">
                        @php $photoUrl = student_media_url($data->sl_photo ?? null); @endphp
                        @if($photoUrl)
                            <img src="{{ $photoUrl }}" alt="Student Photo">
                        @else
                            <span class="photo-empty">Picture<br>1.2 in × 1.5 in</span>
                        @endif
                    </div>
                    <div class="signature-frame">
                        @php $signUrl = student_media_url($data->sl_signature ?? null); @endphp
                        @if($signUrl)
                            <img src="{{ $signUrl }}" alt="Student Signature">
                        @else
                            Signature
                        @endif
                    </div>
                </div>
            </div>

            <!-- Footer row: QR bottom-left, Controller bottom-right, aligned -->
            <div class="card-footer-row">
                <div class="qr-code-wrap">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-student/' . ($data->sl_reg_no ?? '')) }}"
                    alt="QR Code" class="qr-code">
                    <div class="qr-sr-no">Scan to verify</div>
                </div>
            <div class="controller-sign">
                    <div class="controller-sig-overlap">
                        <div class="controller-sig-area">
                            @if(!empty($setting->authorize_stamp) && file_exists(public_path($setting->authorize_stamp)))
                                <img src="{{ asset($setting->authorize_stamp) }}" class="auth-stamp" alt="Stamp">
                            @endif
                            @if(!empty($setting->authorize_signature) && file_exists(public_path($setting->authorize_signature)))
                                <img src="{{ asset($setting->authorize_signature) }}" class="auth-sign" alt="Signature">
                            @endif
                        </div>
                        <div class="controller-sig-label">Controller of Examination</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Print Button (Hidden in Print Mode) -->
    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <a href="{{ route('view_registration_card') }}"
            style="display: inline-block; padding: 10px 20px; font-size: 16px; background: #2563eb; color: white; border: none; cursor: pointer; border-radius: 5px; font-weight: bold; text-decoration: none; margin-right: 10px;">
            <i class="fa fa-arrow-left"></i> Back to List
        </a>
        <button type="button" onclick="window.print()"
            style="padding: 10px 20px; font-size: 16px; background: #dc3545; color: white; border: none; cursor: pointer; border-radius: 5px; font-weight: bold;">
            <i class="fa fa-print"></i> Print Registration Card
        </button>
    </div>
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>

</body>

</html>