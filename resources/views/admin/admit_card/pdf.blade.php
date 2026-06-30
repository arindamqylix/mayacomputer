<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admit Card - {{ $student->sl_reg_no }}</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            padding: 20px;
        }

        .admit-card {
            width: 100%;
            border: 1px solid #ccc;
            padding: 10px;
            position: relative;
        }

        .header {
            text-align: center;
            margin-bottom: 5px;
        }

        .header-banner {
            width: 80%;
            max-height: 100px;
            display: block;
            margin: 0 auto;
        }

        .header-subtext {
            text-align: center;
            margin-top: -10px;
        }

        .header-subtext p {
            margin: 2px 0;
        }

        .card-title {
            text-align: center;
            color: green;
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
            border-top: 1px solid #eee;
            padding-top: 5px;
        }

        .blue-bar {
            background-color: #000066;
            color: white;
            padding: 5px 15px;
            font-weight: bold;
            font-size: 14px;
            margin-top: 10px;
        }

        .blue-bar table {
            width: 100%;
            color: white;
        }

        .details-section {
            border: 1px solid #ccc;
            border-top: none;
            padding: 10px;
            position: relative;
            min-height: 180px;
        }

        .info-table {
            width: 75%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 4px 5px;
            vertical-align: top;
            font-size: 13px;
        }

        .label {
            font-weight: bold;
            text-align: left;
            width: 150px;
        }

        .value {
            font-weight: bold;
            text-transform: uppercase;
        }

        .photo-sign-container {
            position: absolute;
            right: 10px;
            top: 10px;
            width: 110px;
            text-align: center;
        }

        .photo-box {
            width: 100px;
            height: 120px;
            border: 1px solid #000;
            margin-bottom: 2px;
            overflow: hidden;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sign-box {
            width: 100px;
            height: 35px;
            border: 1px solid #000;
            border-top: none;
            overflow: hidden;
        }

        .sign-box img {
            max-width: 100%;
            max-height: 100%;
        }

        .exam-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            border: 1px solid #000066;
        }

        .exam-table th {
            background-color: #000066;
            color: white;
            padding: 6px;
            font-size: 12px;
            border: 1px solid #fff;
        }

        .exam-table td {
            text-align: center;
            padding: 8px;
            font-size: 12px;
            border: 1px solid #ccc;
            font-weight: bold;
        }

        .footer-note {
            font-size: 9px;
            margin-top: 10px;
            text-align: justify;
        }

        .footer-row {
            margin-top: 20px;
            width: 100%;
        }

        .footer-row table {
            width: 100%;
            border-collapse: collapse;
        }

        .qr-section {
            width: 80px;
            text-align: left;
            vertical-align: bottom;
        }

        .qr-code {
            width: 70px;
            height: 70px;
            border: 1px solid #ccc;
        }

        .authority-section {
            width: 240px;
            text-align: right;
            vertical-align: bottom;
        }

        .controller-sig-overlap {
            position: relative;
            width: 240px;
            margin-left: auto;
            text-align: center;
        }

        .stamp-signature-wrapper {
            position: relative;
            height: 95px;
            width: 240px;
        }

        .auth-stamp {
            position: absolute;
            left: 50%;
            margin-left: -50px;
            height: 90px;
            opacity: 0.7;
            z-index: 1;
        }

        .auth-sign {
            position: absolute;
            left: 50%;
            margin-left: -40px;
            top: 22px;
            height: 45px;
            z-index: 2;
        }

        .authority-label {
            font-weight: bold;
            font-size: 13px;
            text-align: center;
            margin-top: -30px;
            padding-top: 4px;
            position: relative;
            z-index: 3;
            white-space: nowrap;
        }
    </style>
</head>

<body>
    @php
        $examYear = \Carbon\Carbon::parse($admit->exam_date)->year;
        $examAddress = $center->cl_center_address ?? 'N/A';
        $venueCenter = \DB::table('center_login')->where('cl_center_name', $admit->exam_venue)->orWhere('cl_name', $admit->exam_venue)->first();
        if ($venueCenter && !empty($venueCenter->cl_center_address)) {
            $examAddress = $venueCenter->cl_center_address;
        }
        $bannerPath = !empty($setting->document_logo) ? public_path(ltrim($setting->document_logo, '/')) : public_path('header_banner.png');
        $stampPath = !empty($setting->authorize_stamp) ? public_path(ltrim($setting->authorize_stamp, '/')) : '';
        $sigPath = !empty($setting->authorize_signature) ? public_path(ltrim($setting->authorize_signature, '/')) : '';
        $photoPath = student_media_public_path($student->sl_photo ?? null);
        $signPath = student_media_public_path($student->sl_signature ?? null);
    @endphp

    <div class="admit-card">
        <div class="header">
            @if(!empty($bannerPath) && file_exists($bannerPath))
                <img src="{{ $bannerPath }}" class="header-banner">
            @endif
            <div class="header-subtext">
                <p style="font-size: 14px;">CIN : U85220DL2023PTC422329</p>
                <p style="font-size: 11px;">Reg. Under the Company Act.2013 MCA, Government of India</p>
                <p style="font-size: 9px;">Registered Under NCT Delhi, Skill India, Udyam &amp; Startup India</p>
                <p style="font-size: 14px;">An ISO 9001: 2015 Certified</p>
                <p style="font-size: 10px;">Visit Our Website : https://mayacomputercenter.in</p>
            </div>
        </div>

        <div class="card-title">ADMIT CARD – {{ $examYear }}</div>

        <div class="blue-bar">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td align="left">Registration No. : {{ $student->sl_reg_no }}</td>
                    <td align="right">Year : {{ $examYear }}</td>
                </tr>
            </table>
        </div>

        <div class="details-section">
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
                    <td class="value">: {{ strtoupper(format_dob_display($student->sl_dob ?? null)) }} &nbsp; Gen: {{ strtoupper($student->sl_sex ?? '') }}</td>
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

            <div class="photo-sign-container">
                <div class="photo-box">
                    @if($photoPath)
                        <img src="{{ $photoPath }}">
                    @endif
                </div>
                <div class="sign-box">
                    @if($signPath)
                        <img src="{{ $signPath }}">
                    @endif
                </div>
            </div>
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
                    <td>{{ $admit->exam_venue }}</td>
                    <td>{{ $examAddress }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer-note">Note: Any kind of specific identifying marks made by student in the Answer Book is
            subject to non evaluation / or shall be treated as Unfairmeans. Bringing of Calculators / Phone or any other
            electronic gadget in side the examination hall shall be deemed as Unfairmeans &amp; breach of examination rules.
        </div>

        <div class="footer-row">
            <table>
                <tr>
                    <td class="qr-section">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-student/' . $student->sl_reg_no) }}"
                            class="qr-code">
                    </td>
                    <td class="authority-section">
                        <div class="controller-sig-overlap">
                            <div class="stamp-signature-wrapper">
                                @if(!empty($stampPath) && file_exists($stampPath))
                                    <img src="{{ $stampPath }}" class="auth-stamp">
                                @endif
                                @if(!empty($sigPath) && file_exists($sigPath))
                                    <img src="{{ $sigPath }}" class="auth-sign">
                                @endif
                            </div>
                            <div class="authority-label">Controller of Examination</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
