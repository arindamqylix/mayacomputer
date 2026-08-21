<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admit Card - Maya Computer Center</title>
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

        .admit-card {
            width: 210mm;
            /* A4 width */
            height: auto;
            background: #fff;
            padding: 2mm 10mm;
            padding-bottom: 20mm;
            border: 1px solid #ccc;
            position: relative;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Watermark */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
            z-index: 0;
            width: 60%;
            pointer-events: none;
        }

        .content {
            position: relative;
            z-index: 1;
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

        /* Footer row: QR bottom-left, Controller bottom-right - same as marksheet_diploma.blade.php */
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
            text-align: center;
            width: 70px;
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
            /* Light green as per image */
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
            width: 160px;
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

        /* Exam Table */
        .exam-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #000066;
        }

        .exam-table th {
            background-color: #000066;
            color: white;
            padding: 8px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            border: 1px solid #fff;
        }

        .exam-table td {
            text-align: center;
            padding: 10px;
            background-color: #e6eefc;
            /* Light blue tint */
            border: 1px solid #ccc;
            font-weight: bold;
            font-size: 14px;
        }

        .exam-table td:last-child {
            /* Address specific formatting if needed */
        }

        /* Footer */
        .footer-note {
            font-size: 10px;
            margin-top: 15px;
            line-height: 1.4;
            color: #333;
            text-align: justify;
        }

        .controller-sign {
            flex-shrink: 0;
            margin-left: auto;
            font-family: Arial, sans-serif;
        }

        .controller-sig-overlap {
            position: relative;
            width: 240px;
            text-align: center;
            margin-left: auto;
        }

        .controller-sig-area {
            position: relative;
            height: 110px;
            width: 240px;
            margin: 0 auto;
        }

        .controller-sig-area .auth-stamp {
            position: absolute;
            left: 50%;
            margin-left: -65px;
            height: 130px;
            width: auto;
            object-fit: contain;
            opacity: 0.8;
            z-index: 1;
        }

        .controller-sig-area .auth-sign {
            position: absolute;
            left: 50%;
            margin-left: -45px;
            top: 28px;
            height: 50px;
            width: auto;
            object-fit: contain;
            z-index: 2;
        }

        .controller-sig-label {
            padding-top: 4px;
            margin-top: -31px;
            font-weight: bold;
            font-size: 14px;
            color: #333;
            white-space: nowrap;
            text-align: center;
            position: relative;
            z-index: 3;
        }

        /* Print styles */
        @media print {
            body {
                background: none;
                padding: 0;
            }

            .admit-card {
                box-shadow: none;
                border: none;
                width: 100%;
                height: auto;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="admit-card">
        <!-- Background Logo / Watermark -->
        <img src="@if(!empty($setting->document_logo) && file_exists(public_path($setting->document_logo))){{ asset($setting->document_logo) }}@else{{ asset('logo.png') }}@endif"
            class="watermark" alt="Watermark" style="opacity: 0.05;">


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
                प्रवेश पत्र (ADMIT CARD) – {{ \Carbon\Carbon::parse($admit->exam_date)->year }}
            </div>
            <!-- TM Symbol simulation -->
            <!-- <div class="tm-symbol">TM</div> -->

            <!-- Blue Strip -->
            <div class="blue-bar">
                <span>Registration No. &nbsp;&nbsp;: {{ $student->sl_reg_no }}</span>
                <span>Year : {{ \Carbon\Carbon::parse($admit->exam_date)->year }}</span>
            </div>

            <!-- Student Details -->
            <div class="details-section">
                <div class="details-main">
                <table class="info-table">
                    <tr>
                        <td class="label">Student Name</td>
                        <td class="value" colspan="2">: {{ strtoupper($student->sl_name ?? '') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Father's Name</td>
                        <td class="value" colspan="2">: {{ strtoupper($student->sl_father_name ?? '') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Mother's Name</td>
                        <td class="value" colspan="2">: {{ strtoupper($student->sl_mother_name ?? '') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Date of Birth</td>
                        <td class="value" colspan="2">: {!! format_dob_display_html($student->sl_dob ?? null, 'N/A', true) !!} &nbsp;&nbsp; Gen: {{ strtoupper($student->sl_sex ?? '') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Course Name</td>
                        <td class="value" colspan="2">: {{ strtoupper($course->c_full_name ?? $course->c_short_name ?? '') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Center Name</td>
                        <td class="value" colspan="2">: {{ strtoupper($center->cl_center_name ?? $center->cl_name ?? '') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Center Code</td>
                        <td class="value" colspan="2">: {{ $center->cl_code ?? '' }}</td>
                    </tr>
                </table>
                </div>

                <div class="photo-column">
                    <div class="photo-frame">
                        @php $photoUrl = student_media_url($student->sl_photo ?? null); @endphp
                        @if($photoUrl)
                            <img src="{{ $photoUrl }}" alt="Student Photo">
                        @else
                            <span class="photo-empty">Picture<br>1.2 in × 1.5 in</span>
                        @endif
                    </div>
                    <div class="signature-frame">
                        @php $signUrl = student_media_url($student->sl_signature ?? null); @endphp
                        @if($signUrl)
                            <img src="{{ $signUrl }}" alt="Student Signature">
                        @else
                            Signature
                        @endif
                    </div>
                </div>
            </div>

            <!-- Exam Table -->
            <table class="exam-table">
                <thead>
                    <tr>
                        <th>Date of Exam</th>
                        <th>Time of Exam</th>
                        <th>Name of Exam Center</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($admit->exam_date)->format('d/m/Y') }}</td>
                        <td>{{ $admit->exam_time }}</td>
                        <td>{!! nl2br(e($admit->exam_venue)) !!}</td>
                        <td>
                            @php
                                $examCenter = \DB::table('center_login')->where('cl_center_name', $admit->exam_venue)->first();
                                $examAddress = $examCenter ? $examCenter->cl_center_address : $center->cl_center_address;
                            @endphp
                            {{ $examAddress ?? 'N/A' }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Footer -->
            <div class="footer-note">
                Note: Any kind of specific identifying marks made by student in the Answer Book is subject to non
                evaluation / or shall be treated as Unfairmeans. Bringing of Calculators / Phone or any other electronic
                gadget in side the examination hall shall be deemed as Unfairmeans & breach of examination rules.
            </div>

            <!-- Footer row: QR bottom-left, Controller bottom-right - same as marksheet_diploma -->
            <div class="card-footer-row">
                <div class="qr-code-wrap">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-admit-card/' . ($admit->ac_id ?? '')) }}"
                        alt="QR Code - Scan to verify" class="qr-code">
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
    <div style="text-align: center; margin-top: 20px;" class="no-print">
        <button type="button" onclick="window.print()"
            style="padding: 10px 20px; font-size: 16px; background: #dc3545; color: white; border: none; cursor: pointer; border-radius: 5px; font-weight: bold;">
            <i class="fa fa-print"></i> Print Admit Card
        </button>
    </div>

</body>

</html>