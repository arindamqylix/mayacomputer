<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admit Card - Maya Computer Center</title>
    @php $forPdf = $forPdf ?? false; @endphp
    <style>
        @if(!$forPdf)
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;700&display=swap');
        @endif

        @if($forPdf)
        @page { margin: 0; size: A4 portrait; }
        @endif

        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: {{ $forPdf ? '0' : '20px' }};
            background-color: {{ $forPdf ? '#fff' : '#f0f0f0' }};
        }

        .admit-card {
            width: {{ $forPdf ? '100%' : '210mm' }};
            max-width: 210mm;
            height: auto;
            background: #fff;
            padding: 2mm 10mm 20mm;
            border: 1px solid #ccc;
            position: relative;
            margin: 0 auto;
            @if(!$forPdf)
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            @endif
        }

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

        .header {
            text-align: center;
            margin-bottom: 5px;
        }

        .header-banner {
            width: 80%;
            max-height: 120px;
            display: block;
            margin: 0 auto;
        }

        .header-subtext {
            text-align: center;
            margin-top: -20px;
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

        .card-title {
            text-align: center;
            color: green;
            font-size: 18px;
            font-weight: bold;
            margin: 5px 0 10px 0;
            font-family: {{ $forPdf ? "'noto devanagari', " : '' }}"Times New Roman", Times, serif;
        }

        .card-title-hindi {
            font-family: {{ $forPdf ? "'noto devanagari', " : "'Noto Sans Devanagari', " }}"Times New Roman", Times, serif;
        }

        .blue-bar {
            background-color: #000066;
            color: white;
            padding: 5px 15px;
            font-weight: bold;
            font-size: 14px;
            font-family: Arial, sans-serif;
            border: 1px solid #000;
            border-bottom: none;
        }

        .blue-bar-table {
            width: 100%;
            border-collapse: collapse;
        }

        .blue-bar-table td {
            color: #ffffff;
            font-weight: bold;
            font-size: 14px;
            font-family: Arial, sans-serif;
        }

        .details-section {
            border: 1px solid #ccc;
            border-top: none;
            background-color: #f9f9f980;
        }

        .details-layout {
            width: 100%;
            border-collapse: collapse;
        }

        .details-main-cell {
            vertical-align: top;
            padding: 10px 8px 10px 12px;
        }

        .photo-cell {
            vertical-align: top;
            width: 108px;
            padding: 10px 12px 10px 0;
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

        .photo-frame {
            width: 102px;
            height: 127px;
            border: 2px solid #000;
            background: #fff;
            overflow: hidden;
            text-align: center;
            margin-left: auto;
        }

        .photo-frame img {
            width: 102px;
            height: 127px;
            object-fit: contain;
        }

        .photo-empty {
            font-size: 9px;
            color: #999;
            line-height: 1.35;
            padding-top: 45px;
        }

        .signature-frame {
            width: 102px;
            height: 38px;
            border: 2px solid #000;
            border-top: 1px solid #000;
            background: #fff;
            overflow: hidden;
            text-align: center;
            margin-left: auto;
        }

        .signature-frame img {
            max-width: 98px;
            max-height: 34px;
        }

        .sig-empty {
            font-size: 8px;
            color: #999;
            padding-top: 12px;
        }

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
            border: 1px solid #ccc;
            font-weight: bold;
            font-size: 14px;
        }

        .footer-note {
            font-size: 10px;
            margin-top: 15px;
            line-height: 1.4;
            color: #333;
            text-align: justify;
        }

        .footer-row {
            width: 100%;
            border-collapse: collapse;
            margin-top: 24px;
        }

        .qr-section {
            width: 80px;
            vertical-align: bottom;
        }

        .qr-code {
            width: 70px;
            height: 70px;
            border: 1px solid #ddd;
            background: #fff;
            display: block;
        }

        .authority-section {
            vertical-align: bottom;
            text-align: right;
        }

        .controller-sig-overlap {
            width: 240px;
            margin-left: auto;
            text-align: center;
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
            z-index: 2;
        }

        .controller-sig-label {
            margin-top: -31px;
            font-weight: bold;
            font-size: 14px;
            color: #333;
            text-align: center;
            position: relative;
            z-index: 3;
        }

        @if(!$forPdf)
        @media print {
            @page { size: A4 portrait; margin: 0; }
            body { background: white; padding: 0; margin: 0; }
            .admit-card { box-shadow: none; border: none; width: 210mm; margin: 0; padding: 10mm; }
            .no-print { display: none !important; }
        }
        @endif
    </style>
</head>

<body>
    @php
        $examYear = \Carbon\Carbon::parse($admit->exam_date)->year;
        $watermarkSrc = admit_card_public_img($setting->document_logo ?? null, $forPdf)
            ?? admit_card_public_img('logo.png', $forPdf);
        $bannerSrc = admit_card_public_img($setting->document_logo ?? null, $forPdf)
            ?? admit_card_public_img('header_banner.png', $forPdf);
        $stampSrc = admit_card_public_img($setting->authorize_stamp ?? null, $forPdf);
        $authSignSrc = admit_card_public_img($setting->authorize_signature ?? null, $forPdf);
        $photoSrc = $forPdf
            ? student_media_public_path($student->sl_photo ?? null)
            : student_media_url($student->sl_photo ?? null);
        $signSrc = $forPdf
            ? student_media_public_path($student->sl_signature ?? null)
            : student_media_url($student->sl_signature ?? null);
        $examCenter = \DB::table('center_login')->where('cl_center_name', $admit->exam_venue)->first();
        $examAddress = ($examCenter && $examCenter->cl_center_address)
            ? $examCenter->cl_center_address
            : ($center->cl_center_address ?? 'N/A');
        $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode(url('verify-admit-card/' . ($admit->ac_id ?? '')));
    @endphp

    <div class="admit-card">
        @if($watermarkSrc)
            <img src="{{ $watermarkSrc }}" class="watermark" alt="">
        @endif

        <div class="content">
            <div class="header">
                @if($bannerSrc)
                    <img src="{{ $bannerSrc }}" alt="Maya Computer Center Banner" class="header-banner">
                @endif
                <div class="header-subtext">
                    <p class="reg-details" style="font-size: 14px;">CIN : U85220DL2023PTC422329</p>
                    <p class="reg-details" style="font-size: 12px;">Reg. Under the Company Act.2013 MCA, Government of India</p>
                    <p class="reg-details" style="font-size: 11px;">Registered Under NCT Delhi, Skill India, Udyam &amp; Startup India</p>
                    <p class="iso-text" style="font-size: 15px;">An ISO 9001: 2015 Certified</p>
                    <p class="reg-details" style="font-size: 11px; margin-top: 2px;">Visit Our Website : https://mayacomputercenter.in</p>
                </div>
            </div>

            <div class="card-title"><span class="card-title-hindi">प्रवेश पत्र</span> (ADMIT CARD) – {{ $examYear }}</div>

            <div class="blue-bar">
                <table class="blue-bar-table" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="left">Registration No. &nbsp;&nbsp;: {{ $student->sl_reg_no }}</td>
                        <td align="right">Year : {{ $examYear }}</td>
                    </tr>
                </table>
            </div>

            <div class="details-section">
                <table class="details-layout" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="details-main-cell">
                            <table class="info-table">
                                <tr>
                                    <td class="label">Student Name</td>
                                    <td class="value">: {{ strtoupper($student->sl_name ?? '') }}</td>
                                </tr>
                                <tr>
                                    <td class="label">Father's Name</td>
                                    <td class="value">: {{ strtoupper($student->sl_father_name ?? '') }}</td>
                                </tr>
                                <tr>
                                    <td class="label">Mother's Name</td>
                                    <td class="value">: {{ strtoupper($student->sl_mother_name ?? '') }}</td>
                                </tr>
                                <tr>
                                    <td class="label">Date of Birth</td>
                                    <td class="value">: {!! format_dob_display_html($student->sl_dob ?? null, 'N/A', true) !!} &nbsp;&nbsp; Gen: {{ strtoupper($student->sl_sex ?? '') }}</td>
                                </tr>
                                <tr>
                                    <td class="label">Course Name</td>
                                    <td class="value">: {{ strtoupper($course->c_full_name ?? $course->c_short_name ?? '') }}</td>
                                </tr>
                                <tr>
                                    <td class="label">Center Name</td>
                                    <td class="value">: {{ strtoupper($center->cl_center_name ?? $center->cl_name ?? '') }}</td>
                                </tr>
                                <tr>
                                    <td class="label">Center Code</td>
                                    <td class="value">: {{ $center->cl_code ?? '' }}</td>
                                </tr>
                            </table>
                        </td>
                        <td class="photo-cell">
                            <div class="photo-frame">
                                @if($photoSrc)
                                    <img src="{{ $photoSrc }}" alt="Student Photo">
                                @else
                                    <div class="photo-empty">Picture<br>1.2 in × 1.5 in</div>
                                @endif
                            </div>
                            <div class="signature-frame">
                                @if($signSrc)
                                    <img src="{{ $signSrc }}" alt="Student Signature">
                                @else
                                    <div class="sig-empty">Signature</div>
                                @endif
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

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
                        <td>{{ $examAddress }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="footer-note">
                Note: Any kind of specific identifying marks made by student in the Answer Book is subject to non
                evaluation / or shall be treated as Unfairmeans. Bringing of Calculators / Phone or any other electronic
                gadget in side the examination hall shall be deemed as Unfairmeans &amp; breach of examination rules.
            </div>

            <table class="footer-row" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="qr-section">
                        <img src="{{ $qrUrl }}" alt="QR Code" class="qr-code">
                    </td>
                    <td class="authority-section">
                        <div class="controller-sig-overlap">
                            <div class="controller-sig-area">
                                @if($stampSrc)
                                    <img src="{{ $stampSrc }}" class="auth-stamp" alt="Stamp">
                                @endif
                                @if($authSignSrc)
                                    <img src="{{ $authSignSrc }}" class="auth-sign" alt="Signature">
                                @endif
                            </div>
                            <div class="controller-sig-label">Controller of Examination</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    @if(!$forPdf)
    <div style="text-align: center; margin-top: 20px;" class="no-print">
        <button type="button" onclick="window.print()"
            style="padding: 10px 20px; font-size: 16px; background: #dc3545; color: white; border: none; cursor: pointer; border-radius: 5px; font-weight: bold;">
            <i class="fa fa-print"></i> Print Admit Card
        </button>
    </div>
    @endif
</body>

</html>
