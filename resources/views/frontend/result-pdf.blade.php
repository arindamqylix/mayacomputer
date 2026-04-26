<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Marksheet - {{ $data->sl_reg_no }}</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: 0;
            background: #fff;
            line-height: 1.2;
        }

        .marksheet-container {
            width: 210mm;
            height: 297mm;
            position: relative;
            padding: 5mm;
            margin: 0;
            overflow: hidden;
            page-break-after: always;
        }

        .border-pattern {
            padding: 2px;
            background: #fff;
            border: 1px solid #0f1d46;
            height: 100%;
        }

        .border-inner {
            border: 2px solid #0f1d46;
            padding: 2px;
            height: 100%;
        }

        .border-design {
            border: 1px solid #0f1d46;
            padding: 8px;
            height: 100%;
        }

        .content-area-white {
            background: #fff;
            padding: 8px;
            border: 1px solid #c5a059;
            height: 100%;
            position: relative;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 70%;
            transform: translate(-50%, -50%);
            opacity: 0.05;
            z-index: 0;
        }

        .content {
            position: relative;
            z-index: 1;
        }

        .header {
            text-align: center;
            margin-bottom: 5px;
            position: relative;
        }

        .header-banner {
            width: 80%;
            max-height: 90px;
            margin-bottom: 5px;
        }

        .header-subtext {
            margin-top: -12px;
        }

        .reg-details {
            font-size: 10px;
            font-weight: bold;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .iso-text {
            color: red;
            font-weight: bold;
            font-size: 11px;
            margin: 1px 0;
            font-family: Arial, sans-serif;
        }

        .hologram-wrapper {
            position: absolute;
            right: 0;
            top: 0;
            text-align: center;
        }

        .hologram-wrapper img {
            width: 55px;
        }

        .hologram-wrapper .sn-text {
            display: none;
        }

        .section-title {
            background: #000066;
            color: #fff;
            text-align: center;
            font-weight: bold;
            font-size: 13px;
            padding: 3px;
            text-transform: uppercase;
            margin: 5px 0;
        }

        .info-box {
            border: 1px solid #000066;
            padding: 5px;
            display: table;
            width: 100%;
        }

        .student-details {
            display: table-cell;
            width: 80%;
            font-size: 11px;
            vertical-align: top;
            text-align: left;
        }

        .info-row {
            margin-bottom: 2px;
            display: block;
        }

        .info-label {
            width: 120px;
            font-weight: bold;
            display: inline-block;
        }

        .info-value {
            font-weight: bold;
            text-transform: uppercase;
        }

        .photo-area {
            display: table-cell;
            width: 20%;
            text-align: right;
            vertical-align: top;
        }

        .student-photo {
            width: 80px;
            height: 95px;
            border: 1px solid #ccc;
        }

        .modules-box {
            border: 1px solid #000066;
            padding: 4px;
            font-size: 10px;
            margin-top: -1px;
            min-height: 40px;
        }

        .marks-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            margin-top: 5px;
        }

        .marks-table th {
            background: #000066;
            color: #fff;
            padding: 4px;
            border: 1px solid #fff;
        }

        .marks-table td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
            font-weight: bold;
        }

        .grading-info {
            font-size: 9px;
            font-weight: bold;
            margin-top: 4px;
        }

        .issue-date {
            font-size: 11px;
            font-weight: bold;
            margin-top: 5px;
        }

        .footer {
            margin-top: 15px;
        }

        .card-footer-row {
            display: table;
            width: 100%;
            margin-top: 5px;
        }

        .qr-section {
            display: table-cell;
            width: 30%;
            text-align: left;
            vertical-align: bottom;
        }

        .sign-section {
            display: table-cell;
            width: 70%;
            text-align: right;
            vertical-align: bottom;
        }

        .qr-code {
            width: 60px;
            border: 1px solid #ddd;
        }

        .stamp-wrap {
            position: relative;
            height: 80px;
            width: 180px;
            float: right;
        }
    </style>
</head>

<body>
    <div class="marksheet-container">
        <div class="border-pattern">
            <div class="border-inner">
                <div class="border-design">
                    <div class="content-area-white">
                        <img src="{{ !empty($setting->document_logo) ? public_path($setting->document_logo) : public_path('logo.png') }}"
                            class="watermark">
                        <div class="content">
                            <div class="header">
                                <img src="{{ !empty($setting->document_logo) ? public_path($setting->document_logo) : public_path('header_banner.png') }}"
                                    class="header-banner">
                                @if(!empty($setting->hologram))
                                    <div class="hologram-wrapper">
                                        <img src="{{ public_path($setting->hologram) }}">
                                        <span class="sn-text">SN.
                                            MCC{{ str_pad($data->sl_id, 5, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                @endif
                                <div class="header-subtext">
                                    <p class="reg-details" style="font-size: 14px;">CIN : U85220DL2023PTC422329</p>
                                    <p class="reg-details">Reg. Under the Company Act.2013 MCA, Govt. of India</p>
                                    <p class="reg-details">Registered Under NCT Delhi, Skill India, Udyam & Startup
                                        India</p>
                                    <p class="iso-text">An ISO 9001: 2015 Certified</p>
                                    <p class="reg-details" style="font-size: 10px;">Visit Our Website : https://mayacomputercenter.in</p>
                                </div>
                            </div>
                            <div class="section-title">Statement of Marks</div>
                            <div class="info-box">
                                <div class="student-details">
                                    <div class="info-row"><span class="info-label">Registration No.</span>: <span
                                            class="info-value">{{ $data->sl_reg_no }} &nbsp; Year:
                                            {{ $data->sc_issue_date ? \Carbon\Carbon::parse($data->sc_issue_date)->year : \Carbon\Carbon::parse($data->created_at)->year }}</span>
                                    </div>
                                    <div class="info-row"><span class="info-label">Student Name</span>: <span
                                            class="info-value">{{ strtoupper($data->sl_name) }}</span></div>
                                    <div class="info-row"><span class="info-label">Mother's Name</span>: <span
                                            class="info-value">{{ strtoupper($data->sl_mother_name) }}</span></div>
                                    <div class="info-row"><span class="info-label">Father's Name</span>: <span
                                            class="info-value">{{ strtoupper($data->sl_father_name) }}</span></div>
                                    <div class="info-row"><span class="info-label">Date of Birth</span>: <span
                                            class="info-value">{{ $data->sl_dob }} &nbsp; Gender:
                                            {{ strtoupper($data->sl_sex) }}</span></div>
                                    <div class="info-row"><span class="info-label">Course Name</span>: <span
                                            class="info-value">{{ strtoupper($data->c_full_name) }}</span></div>
                                    <div class="info-row"><span class="info-label">Center Name</span>: <span
                                            class="info-value">{{ strtoupper($data->cl_center_name ?? $data->cl_name) }}</span>
                                    </div>
                                    <div class="info-row"><span class="info-label">Center Code</span>: <span
                                            class="info-value">{{ $data->cl_code }}</span></div>
                                </div>
                                <div class="photo-area">
                                    @if(!empty($data->sl_photo))
                                        <img src="{{ public_path($data->sl_photo) }}" class="student-photo">
                                    @endif
                                </div>
                            </div>
                            @if(!empty($data->description))
                                <div class="section-title" style="margin-top:0;">Modules Covered</div>
                                <div class="modules-box">{!! html_entity_decode($data->description) !!}</div>
                            @endif
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
                                    <tr>
                                        <td style="text-align:left;">{{ $data->sr_written ?? 'Written' }}</td>
                                        <td>{{ $data->sr_wr_full_marks }}</td>
                                        <td>{{ $data->sr_wr_pass_marks }}</td>
                                        <td>{{ $data->sr_wr_marks_obtained }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">{{ $data->sr_practical ?? 'Practical' }}</td>
                                        <td>{{ $data->sr_pr_full_marks }}</td>
                                        <td>{{ $data->sr_pr_pass_marks }}</td>
                                        <td>{{ $data->sr_pr_marks_obtained }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">{{ $data->sr_project ?? 'Assignment' }}</td>
                                        <td>{{ $data->sr_ap_full_marks }}</td>
                                        <td>{{ $data->sr_ap_pass_marks }}</td>
                                        <td>{{ $data->sr_ap_marks_obtained }}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">{{ $data->sr_viva ?? 'Viva' }}</td>
                                        <td>{{ $data->sr_vv_full_marks }}</td>
                                        <td>{{ $data->sr_vv_pass_marks }}</td>
                                        <td>{{ $data->sr_vv_marks_obtained }}</td>
                                    </tr>
                                    <tr style="background:#000066; color:#fff;">
                                        <td>Total</td>
                                        <td>{{ ($data->sr_wr_full_marks + $data->sr_pr_full_marks + $data->sr_ap_full_marks + $data->sr_vv_full_marks) }}
                                        </td>
                                        <td>{{ ($data->sr_wr_pass_marks + $data->sr_pr_pass_marks + $data->sr_ap_pass_marks + $data->sr_vv_pass_marks) }}
                                        </td>
                                        <td>{{ ($data->sr_wr_marks_obtained + $data->sr_pr_marks_obtained + $data->sr_ap_marks_obtained + $data->sr_vv_marks_obtained) }}
                                        </td>
                                    </tr>
                                    <tr style="background:#f0f4f8;">
                                        <td>Percentage</td>
                                        <td>{{ number_format($data->sr_percentage, 2) }}%</td>
                                        <td>Grade</td>
                                        <td>{{ strtoupper($data->sr_grade) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="grading-info">Grade A: 85-100%. Grade B: 70-84%. Grade C: 55-69%. Grade D:
                                40-54%. Fail: < 40%.</div>
                                    <div class="issue-date">Date of Issue:
                                        {{ $data->sc_issue_date ? \Carbon\Carbon::parse($data->sc_issue_date)->format('d-M-Y') : now()->format('d-M-Y') }}
                                    </div>
                                    <div class="footer">
                                        <div class="card-footer-row">
                                            <div class="qr-section">
                                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-result/' . $data->sl_reg_no) }}"
                                                    class="qr-code">
                                                <div style="font-size:8px; font-weight:bold;">SN.
                                                    MCC{{ str_pad($data->sl_id, 5, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                            <div class="sign-section">
                                                <div class="stamp-wrap">
                                                    @if(!empty($setting->authorize_stamp))
                                                        <img src="{{ public_path($setting->authorize_stamp) }}"
                                                            style="position:absolute; height:80px; top:0; left:50%; transform:translateX(-50%);">
                                                    @endif
                                                    @if(!empty($setting->authorize_signature))
                                                        <img src="{{ public_path($setting->authorize_signature) }}"
                                                            style="position:absolute; height:35px; bottom:15px; left:50%; transform:translateX(-50%);">
                                                    @endif
                                                </div>
                                                <div
                                                    style="font-weight:bold; font-size:12px; margin-top:5px; clear:both;">
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
</body>

</html>