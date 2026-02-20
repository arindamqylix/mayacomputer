<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marksheet - Maya Computer Center</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;700&family=Times+New+Roman&display=swap');

        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            /* Fix lint */
        }



        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
        }

        .marksheet-container {
            width: 210mm;
            /* A4 width */
            min-height: 297mm;
            background: #fff;
            padding: 10mm;
            position: relative;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        /* Border System from Certificate */
        .border-pattern {
            position: relative;
            padding: 5px;
            background: #fff;
            border: none;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .border-inner {
            border: 2px solid #0f1d46;
            padding: 3px;
            height: 100%;
            display: flex;
            flex-direction: column;
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
            display: flex;
            flex-direction: column;
        }

        .content-area-white {
            background-color: white;
            padding: 14px;
            height: 100%;
            border: 1px solid #c5a059;
            position: relative;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        /* Watermark */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
            z-index: 0;
            width: 70%;
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
        }

        .header-banner {
            width: 80%;
            max-height: 120px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
            margin-right: 87px;
        }

        .header-subtext {
            text-align: center;
            margin-top: -20px;
            padding: 0;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        .header-subtext p {
            margin: 2px 0;
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

        /* Hologram on right - same as center_certificate.blade.php */
        .hologram-wrapper {
            position: absolute;
            right: 10px;
            top: 10px;
            left: auto;
            z-index: 10;
            text-align: center;
        }
        .hologram-wrapper img {
            width: 80px;
            height: auto;
        }
        .hologram-wrapper .sn-text {
            display: block;
            font-size: 10px;
            font-weight: bold;
            margin-top: 2px;
        }

        /* Footer row: QR bottom-left, Authorized Signatory bottom-right - aligned on same baseline */
        .card-footer-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 10px;
            width: 100%;
            min-height: 72px;
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
        .qr-sr-no {
            font-weight: bold;
            font-size: 11px;
            font-family: Arial, sans-serif;
            margin-top: 4px;
            line-height: 1.2;
            white-space: nowrap;
        }

        /* Section Titles */
        .section-title {
            background-color: #000066;
            color: white;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            padding: 4px;
            text-transform: uppercase;
            font-family: Arial, sans-serif;
            margin-top: 6px;
            border: 1px solid #000066;
        }

        /* Student Info Box */
        .info-box {
            border: 1px solid #000066;
            padding: 5px;
            display: flex;
        }

        .student-details {
            flex-grow: 1;
            font-size: 13px;
        }

        .info-row {
            display: flex;
            margin-bottom: 3px;
        }

        .info-label {
            width: 140px;
            font-weight: bold;
        }

        .info-value {
            font-weight: bold;
            text-transform: uppercase;
            flex-grow: 1;
        }

        .photo-area {
            width: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .student-photo {
            width: 90px;
            height: 110px;
            border: 1px solid #ccc;
            object-fit: cover;
        }

        /* Modules Section */
        .modules-box {
            border: 1px solid #000066;
            padding: 4px 10px;
            font-size: 12px;
            margin-top: -1px;
            /* collapse border */
            margin-bottom: 0;
        }

        .module-item {
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .module-item strong {
            color: #000;
        }

        /* Marks Table */
        .marks-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 13px;
            border: 1px solid #000;
        }

        .marks-table th {
            background-color: #000066;
            color: white;
            padding: 4px 6px;
            border: 1px solid #fff;
            text-align: center;
        }

        .marks-table td {
            border: 1px solid #000;
            padding: 4px 6px;
            text-align: center;
            font-weight: bold;
        }

        /* Overall Percentage / Grade row - distinct from Total */
        .marks-table tr.grade-summary-row {
            background-color: #f0f4f8;
            color: #1a1a1a;
            font-weight: bold;
            border-top: 2px solid #000066;
        }

        .marks-table tr.grade-summary-row td {
            border: 1px solid #ccc;
            padding: 4px 6px;
        }

        /* Grading Details */
        .grading-info {
            font-size: 11px;
            font-weight: bold;
            margin-top: 4px;
            margin-bottom: 6px;
            white-space: nowrap;
        }

        .issue-date {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 6px;
        }

        /* Footer */
        .footer {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            width: 100%;
            padding-bottom: 4px;
        }

        .logo-strip {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-bottom: 12px;
        }

        .footer-logo {
            width: 90px;
            height: auto;
            object-fit: contain;
        }

        .auth-sign {
            text-align: right;
            font-weight: bold;
            font-size: 14px;
            margin-right: 20px;
        }

        /* Print styles - scale to 111% so marksheet fills A4 at 100% print scale */
        @media print {
            @page {
                size: A4 portrait;
                margin: 0;
            }

            body {
                background: white;
                padding: 0;
                margin: 0;
                width: 210mm;
                overflow: visible;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .marksheet-container {
                box-shadow: none;
                border: none;
                width: 189.19mm; /* 210/1.11 so scaled output is exactly A4 width */
                min-height: auto;
                margin: 0;
                padding: 4mm 4mm 2mm 4mm;
                overflow: hidden;
                page-break-after: avoid;
                transform: scale(1.11);
                transform-origin: top left;
            }
            .marksheet-container .border-design { padding: 8px 8px 5px 8px !important; }
            .marksheet-container .content-area-white { padding: 10px 10px 5px 10px !important; }
            .marksheet-container .logo-strip { margin-bottom: 4px !important; }
            .marksheet-container .card-footer-row { margin-top: 4px !important; min-height: 64px !important; }
            .marksheet-container .footer { padding-bottom: 0 !important; }
            .marksheet-container .grading-info { margin-bottom: 3px !important; }
            .marksheet-container .issue-date { margin-bottom: 3px !important; }

            /* Force background printing for marksheet elements */
            .marksheet-container * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* Explicitly enforce borders on all structured elements */
            .marks-table {
                border-collapse: collapse !important;
                border: 2px solid #000 !important;
                width: 100% !important;
            }

            .marks-table th {
                border: 1px solid #fff !important;
                /* White separation for headers */
                background-color: #000066 !important;
                color: #fff !important;
            }

            .marks-table td {
                border: 1px solid #000 !important;
                /* Forces black grid lines */
            }

            .info-box,
            .modules-box {
                border: 2px solid #000066 !important;
            }

            .section-title {
                border: 2px solid #000066 !important;
                background-color: #000066 !important;
                color: #fff !important;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body>

    <div class="marksheet-container">
        <div class="border-pattern">
            <div class="border-inner">
                <div class="border-design">
                    <div class="content-area-white">

                        <!-- Watermark -->
                        <img src="@if(!empty($setting->document_logo) && file_exists(public_path($setting->document_logo))){{ asset($setting->document_logo) }}@else{{ asset('logo.png') }}@endif"
                            class="watermark" alt="Watermark" style="opacity: 0.05;">

                        <div class="content">

                            <!-- Header -->
                            <div class="header">
                                @if(!empty($setting->document_logo) && file_exists(public_path($setting->document_logo)))
                                    <img src="{{ asset($setting->document_logo) }}" alt="Maya Computer Center Banner"
                                        class="header-banner">
                                @else
                                    <img src="{{ asset('header_banner.png') }}" alt="Maya Computer Center Banner"
                                        class="header-banner">
                                @endif
                                @if(!empty($setting->hologram) && file_exists(public_path($setting->hologram)))
                                    <div class="hologram-wrapper">
                                        <img src="{{ asset($setting->hologram) }}" alt="Hologram">
                                        <span class="sn-text">SN. MCC{{ str_pad($data->sl_id ?? 0, 5, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                @endif
                                <div class="header-subtext">
                                    <p class="reg-details" style="font-size: 16px;">CIN : U85220DL2023PTC422329</p>
                                    <p class="reg-details" style="font-size: 13px;">Reg. Under the Company Act.2013 MCA,
                                        Government of India</p>
                                    <p class="reg-details" style="font-size: 11px;">Registered Under NCT Delhi, Skill
                                        India,
                                        Udyam & Startup India</p>
                                    <p class="iso-text" style="font-size: 15px;">An ISO 9001: 2015 Certified</p>
                                    <p class="reg-details" style="font-size: 11px; margin-top: 2px;">Visit Our Website : mayacc.in</p>
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="section-title">Statement of Marks</div>

                            <!-- Student Details -->
                            <div class="info-box">
                                <div class="student-details">
                                    <div class="info-row"><span class="info-label">Registration No.</span> : <span
                                            class="info-value">&nbsp;{{ $data->sl_reg_no ?? 'N/A' }}
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Year : {{ $data->sc_issue_date ? \Carbon\Carbon::parse($data->sc_issue_date)->year : \Carbon\Carbon::parse($data->created_at)->year }}</span>
                                    </div>
                                    <div class="info-row"><span class="info-label">Student Name</span> : <span
                                            class="info-value">&nbsp;{{ strtoupper($data->sl_name ?? '') }}</span></div>
                                    <div class="info-row"><span class="info-label">Mother's Name</span> : <span
                                            class="info-value">&nbsp;{{ strtoupper($data->sl_mother_name ?? '') }}</span>
                                    </div>
                                    <div class="info-row"><span class="info-label">Father's Name</span> : <span
                                            class="info-value">&nbsp;{{ strtoupper($data->sl_father_name ?? '') }}</span>
                                    </div>
                                    <div class="info-row"><span class="info-label">Date of Birth</span> : <span
                                            class="info-value">&nbsp;{{ $data->sl_dob ?? 'N/A' }} &nbsp;&nbsp; Gender : {{ strtoupper($data->sl_sex ?? 'N/A') }} &nbsp;&nbsp; Category : {{ $data->sl_category ?? 'Gen' }}</span></div>
                                    <div class="info-row"><span class="info-label">Course Name</span> : <span
                                            class="info-value">&nbsp;{{ strtoupper($data->c_full_name ?? $data->c_short_name ?? '') }}</span>
                                    </div>
                                    <div class="info-row"><span class="info-label">Course Duration</span> : <span
                                            class="info-value"> &nbsp;@php $dur = $data->c_duration ?? 0; if(is_numeric($dur) && $dur >= 12){ echo (round($dur/12)==$dur/12 ? (int)($dur/12) : number_format($dur/12,1)) . (($dur/12)==1 ? ' Year' : ' Years'); } elseif(is_numeric($dur) && $dur > 0){ echo (int)$dur . ($dur==1 ? ' Month' : ' Months'); } else { echo $data->c_duration ?? 'N/A'; } @endphp</span></div>
                                    <div class="info-row"><span class="info-label">Center Name</span> : <span
                                            class="info-value">&nbsp;{{ strtoupper($data->cl_center_name ?? $data->cl_name ?? 'N/A') }}</span></div>
                                    <div class="info-row"><span class="info-label">Center Code & Address</span> : <span
                                            class="info-value"> &nbsp;{{ $data->cl_code ?? 'N/A' }} & {{ $data->cl_center_address ?? 'N/A' }}</span></div>
                                </div>
                                <div class="photo-area">
                                    @if(!empty($data->sl_photo) && file_exists(public_path($data->sl_photo)))
                                        <img src="{{ asset($data->sl_photo) }}" class="student-photo" alt="Student Photo">
                                    @else
                                        <img src="https://via.placeholder.com/90x110?text=Photo" class="student-photo"
                                            alt="Student Photo">
                                    @endif
                                </div>
                            </div>

                            <!-- Modules -->
                            @if(!empty($data->description))
                                <div class="section-title" style="margin-top: 0;">Modules Covered</div>
                                <div class="modules-box">
                                    {!! html_entity_decode($data->description) !!}
                                </div>
                            @endif

                            <!-- Marks Table -->
                            <table class="marks-table">
                                <thead>
                                    <tr>
                                        <th>Exam</th>
                                        <th>Full Marks</th>
                                        <th>Pass Marks</th>
                                        <th>Marks Obtained</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Written -->
                                    <tr>
                                        <td style="text-align: left;">{{ $data->sr_written ?? 'Written' }}</td>
                                        <td>{{ $data->sr_wr_full_marks ?? 100 }}</td>
                                        <td>{{ $data->sr_wr_pass_marks ?? 40 }}</td>
                                        <td>{{ $data->sr_wr_marks_obtained ?? 0 }}</td>
                                    </tr>

                                    <!-- Practical -->
                                    <tr>
                                        <td style="text-align: left;">{{ $data->sr_practical ?? 'Practical' }}</td>
                                        <td>{{ $data->sr_pr_full_marks ?? 100 }}</td>
                                        <td>{{ $data->sr_pr_pass_marks ?? 40 }}</td>
                                        <td>{{ $data->sr_pr_marks_obtained ?? 0 }}</td>
                                    </tr>

                                    <!-- Assignment / Project -->
                                    <tr>
                                        <td style="text-align: left;">{{ $data->sr_project ?? 'Assignment / Project' }}
                                        </td>
                                        <td>{{ $data->sr_ap_full_marks ?? 100 }}</td>
                                        <td>{{ $data->sr_ap_pass_marks ?? 40 }}</td>
                                        <td>{{ $data->sr_ap_marks_obtained ?? 0 }}</td>
                                    </tr>

                                    <!-- Viva Voce -->
                                    <tr>
                                        <td style="text-align: left;">{{ $data->sr_viva ?? 'Viva Voce' }}</td>
                                        <td>{{ $data->sr_vv_full_marks ?? 100 }}</td>
                                        <td>{{ $data->sr_vv_pass_marks ?? 40 }}</td>
                                        <td>{{ $data->sr_vv_marks_obtained ?? 0 }}</td>
                                    </tr>

                                    <tr style="background:#000066; color:#fff;">
                                        <td>Total</td>
                                        <td>{{ ($data->sr_wr_full_marks + $data->sr_pr_full_marks + $data->sr_ap_full_marks + $data->sr_vv_full_marks) }}
                                        </td>
                                        <td>{{ ($data->sr_wr_pass_marks + $data->sr_pr_pass_marks + $data->sr_ap_pass_marks + $data->sr_vv_pass_marks)  }}
                                        </td>
                                        <td>{{ ($data->sr_wr_marks_obtained + $data->sr_pr_marks_obtained + $data->sr_ap_marks_obtained + $data->sr_vv_marks_obtained) }}
                                        </td>
                                    </tr>
                                    <tr class="grade-summary-row">
                                        <td>Overall Percentage</td>
                                        <td>{{ number_format($data->sr_percentage ?? 0, 2) }}%</td>
                                        <td>Grade</td>
                                        <td>{{ strtoupper($data->sr_grade ?? 'N/A') }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="grading-info">
                                Grade A: 85-100%. Grade B: 70-84%. Grade C: 55- 69%. Grade D: 40-54%. Fail: Below 40%.
                            </div>

                            <div class="issue-date">
                                Date of Issue:
                                {{ $data->sc_issue_date ? \Carbon\Carbon::parse($data->sc_issue_date)->format('d-M-Y') : \Carbon\Carbon::now()->format('d-M-Y') }}
                            </div>

                            <!-- Footer -->
                            <div class="footer">
                                <div class="logo-strip">
                                    @if(!empty($setting->certificate_footer_logos))
                                        @php $logos = json_decode($setting->certificate_footer_logos); @endphp
                                        @if(is_array($logos))
                                            @foreach($logos as $logo)
                                                <img src="{{ asset($logo) }}" alt="Logo" class="footer-logo">
                                            @endforeach
                                        @endif
                                    @endif
                                </div>

                                <!-- Footer row: QR bottom-left, Authorized Signatory bottom-right - aligned -->
                                <div class="card-footer-row">
                                    <div class="qr-code-wrap">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-result/' . ($data->sl_reg_no ?? '')) }}" alt="QR Code - Scan to verify" class="qr-code">
                                        <div class="qr-sr-no">SN. MCC{{ str_pad($data->sl_id ?? 0, 5, '0', STR_PAD_LEFT) }}</div>
                                        <div class="qr-sr-no" style="font-size:9px;margin-top:2px;">Scan to verify</div>
                                    </div>
                                    <div class="signatures-wrapper" style="flex-shrink: 0;">
                                        <div class="sig-section right-sig"
                                            style="text-align: center; position: relative; width: 220px;">
                                            <div class="sig-images"
                                                style="position: relative; height: 110px; width: 220px; margin: 0 auto;">
                                                @if(!empty($setting->authorize_stamp) && file_exists(public_path($setting->authorize_stamp)))
                                                    <img src="{{ asset($setting->authorize_stamp) }}" class="stamp-img"
                                                        style="position: absolute; height: 110px; z-index: 1; top: 0; left: 50%; transform: translateX(-50%); opacity: 1;"
                                                        alt="Stamp">
                                                @endif
                                                @if(!empty($setting->authorize_signature) && file_exists(public_path($setting->authorize_signature)))
                                                    <img src="{{ asset($setting->authorize_signature) }}" class="sign-img"
                                                        style="position: absolute; height: 46px; z-index: 2; bottom: 26px; left: 51%; transform: translateX(-50%);"
                                                        alt="Sign">
                                                @endif
                                            </div>
                                            <div class="sig-label"
                                                style="padding-top: 5px; font-weight: bold; font-size: 14px; margin-top: -34px;">
                                                Authorized Signatory</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Print Button (Hidden in Print Mode) -->
        <div style="text-align: center; margin-top: 20px;" class="no-print">
            <button onclick="window.print()"
                style="padding: 10px 20px; font-size: 16px; background: #000066; color: white; border: none; cursor: pointer;">Print
                Marksheet</button>
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