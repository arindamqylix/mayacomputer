<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maya Computer Center - Diploma Mark Sheet</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .marksheet-wrapper {
            width: 794px;
            margin: 0 auto;
            background: #fff;
            position: relative;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            padding: 8px;
        }
        .outer-border {
            border: 4px solid;
            border-image: repeating-linear-gradient(45deg, #1e3a8a 0, #1e3a8a 8px, #dc2626 8px, #dc2626 16px) 4;
            padding: 6px;
        }
        .inner-border {
            border: 2px solid #1e3a8a;
            padding: 20px;
        }
        /* Header */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 2px solid #1e3a8a;
            margin-bottom: 10px;
        }
        .header-table td {
            vertical-align: middle;
            padding: 5px;
        }
        .logo-cell {
            width: 80px;
        }
        .logo-cell img {
            width: 70px;
            height: auto;
        }
        .center-cell {
            text-align: center;
        }
        .qr-cell {
            width: 90px;
            text-align: center;
        }
        .main-title {
            color: #1e3a8a;
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 3px;
        }
        .hindi-title {
            color: #1e3a8a;
            font-size: 18px;
            font-weight: bold;
            font-family: 'Noto Sans Devanagari', sans-serif;
            margin-bottom: 5px;
        }
        .reg-info {
            font-size: 10px;
            color: #333;
            font-weight: bold;
        }
        .iso-cert {
            color: #dc2626;
            font-size: 12px;
            font-weight: bold;
            margin: 3px 0;
        }
        .website {
            font-size: 10px;
        }
        .website a {
            color: #1e3a8a;
            text-decoration: none;
        }
        .qr-box {
            width: 65px;
            height: 65px;
            border: 1px solid #333;
            margin: 0 auto 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
        }
        .qr-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .serial-no {
            font-size: 9px;
            font-weight: bold;
        }
        /* Title Bar */
        .title-bar {
            background: linear-gradient(to right, #1e3a8a, #3b82f6, #1e3a8a);
            color: white;
            text-align: center;
            padding: 8px;
            margin-bottom: 10px;
        }
        .title-bar h2 {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 3px;
        }
        /* Student Info */
        .student-section {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .student-section > tbody > tr > td {
            vertical-align: top;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 4px 6px;
            border: 1px solid #1e3a8a;
            font-size: 11px;
        }
        .info-table .label {
            background: #e8f0fe;
            font-weight: bold;
            color: #1e3a8a;
            width: 110px;
        }
        .info-table .value {
            font-weight: 600;
        }
        .photo-cell {
            width: 110px;
            text-align: center;
            vertical-align: top;
            padding-left: 10px;
        }
        .photo-frame {
            width: 100px;
            height: 120px;
            border: 2px solid #1e3a8a;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f5f5;
            color: #999;
            font-size: 12px;
            overflow: hidden;
        }
        .photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        /* Marks Table */
        .marks-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .marks-table th,
        .marks-table td {
            border: 1px solid #1e3a8a;
            padding: 5px 8px;
            font-size: 11px;
            text-align: center;
        }
        .marks-table th {
            background: linear-gradient(to bottom, #1e3a8a, #2563eb);
            color: white;
            font-weight: bold;
        }
        .marks-table tbody tr:nth-child(even) {
            background: #f0f7ff;
        }
        .marks-table .subject-name {
            text-align: left;
            font-weight: 600;
        }
        .marks-table .total-row {
            background: #1e3a8a !important;
            color: white;
            font-weight: bold;
        }
        .marks-table .result-row {
            background: linear-gradient(to right, #059669, #10b981) !important;
            color: white;
            font-weight: bold;
        }
        /* Grade Legend */
        .grade-legend {
            padding: 6px 10px;
            background: #f0f7ff;
            border: 1px solid #1e3a8a;
            margin-bottom: 10px;
            font-size: 10px;
        }
        .grade-legend strong {
            color: #1e3a8a;
        }
        /* Notes */
        .notes-section {
            padding: 8px;
            background: #fef9e7;
            border: 1px solid #f0e6d2;
            margin-bottom: 10px;
        }
        .notes-section h4 {
            color: #1e3a8a;
            font-size: 11px;
            margin-bottom: 5px;
            border-bottom: 1px solid #1e3a8a;
            padding-bottom: 3px;
        }
        .notes-section p {
            font-size: 9px;
            margin: 2px 0;
            line-height: 1.3;
        }
        /* Logos */
        .logos-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .logos-table td {
            text-align: center;
            padding: 5px;
            vertical-align: middle;
        }
        .logo-box {
            display: inline-block;
            width: 55px;
            height: 35px;
            border: 1px solid #ddd;
            background: #f9f9f9;
            font-size: 7px;
            font-weight: bold;
            color: #666;
            line-height: 35px;
            text-align: center;
        }
        .logo-label {
            font-size: 7px;
            color: #333;
            margin-top: 2px;
        }
        /* Footer */
        .footer-table {
            width: 100%;
            border-collapse: collapse;
            border-top: 1px solid #1e3a8a;
            padding-top: 8px;
        }
        .footer-table td {
            text-align: center;
            padding: 5px;
            vertical-align: top;
        }
        .footer-label {
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .footer-value {
            font-size: 11px;
            font-weight: bold;
        }
        .sig-space {
            width: 80px;
            height: 30px;
            border-bottom: 1px solid #333;
            margin: 5px auto;
        }
        .stamp-box {
            width: 60px;
            height: 50px;
            border: 1px dashed #999;
            margin: 0 auto;
            font-size: 9px;
            color: #999;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        /* CIN */
        .cin-footer {
            text-align: center;
            font-size: 9px;
            color: #666;
            margin-top: 8px;
            padding-top: 5px;
            border-top: 1px solid #eee;
        }
        .cin-footer strong {
            color: #1e3a8a;
        }
        @media print {
            body { background: white; padding: 0; }
            .marksheet-wrapper { box-shadow: none; }
            .outer-border, .title-bar, .marks-table th, .marks-table .total-row, .marks-table .result-row {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="marksheet-wrapper">
        <div class="outer-border">
            <div class="inner-border">
                <!-- Header -->
                <table class="header-table">
                    <tr>
                        <td class="logo-cell">
                            <img src="{{ asset('logo.png') }}" alt="Logo">
                        </td>
                        <td class="center-cell">
                            <h1 class="main-title">MAYA COMPUTER CENTER</h1>
                            <h2 class="hindi-title">माया कम्प्यूटर सेंटर</h2>
                            <p class="reg-info">Reg. Under the Company Act,2013 MCA, Government of India</p>
                            <p class="reg-info">Registered Under Skill India, Udyam &amp; Startup India</p>
                            <p class="iso-cert">An ISO 9001: 2015 Certified</p>
                            <p class="website">Website: <a href="https://mayacomputercenter.in/">https://mayacomputercenter.in/</a></p>
                        </td>
                        <td class="qr-cell">
                            <div class="qr-box">
                                @if(file_exists(public_path('document/images/certificate-qr.jpg')))
                                    <img src="{{ asset('document/images/certificate-qr.jpg') }}" alt="QR">
                                @else
                                    <span>QR</span>
                                @endif
                            </div>
                            <p class="serial-no">Sr. No.: {{ $data->sr_id ?? 'N/A' }}</p>
                            <p class="serial-no">Sl. No: {{ str_pad($data->sl_id ?? 0, 6, '0', STR_PAD_LEFT) }}</p>
                        </td>
                    </tr>
                </table>

                <!-- Title Bar -->
                <div class="title-bar">
                    <h2>DIPLOMA MARK SHEET</h2>
                </div>

                <!-- Student Info + Photo -->
                <table class="student-section">
                    <tr>
                        <td>
                            <table class="info-table">
                                <tr>
                                    <td class="label">Registration No.</td>
                                    <td class="value">{{ $data->sl_reg_no ?? 'N/A' }}</td>
                                    <td class="label">Roll No.</td>
                                    <td class="value">{{ $data->cl_code ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="label">Student Name</td>
                                    <td class="value" colspan="3">{{ strtoupper($data->sl_name ?? 'N/A') }}</td>
                                </tr>
                                <tr>
                                    <td class="label">Father's Name</td>
                                    <td class="value" colspan="3">{{ strtoupper($data->sl_father_name ?? 'N/A') }}</td>
                                </tr>
                                <tr>
                                    <td class="label">Mother's Name</td>
                                    <td class="value" colspan="3">{{ strtoupper($data->sl_mother_name ?? 'N/A') }}</td>
                                </tr>
                                <tr>
                                    <td class="label">Date of Birth</td>
                                    <td class="value">{{ \Carbon\Carbon::parse($data->sl_dob ?? now())->format('d-M-Y') }}</td>
                                    <td class="label">Gender</td>
                                    <td class="value">{{ ucfirst($data->sl_sex ?? 'N/A') }}</td>
                                </tr>
                                <tr>
                                    <td class="label">Course Name</td>
                                    <td class="value" colspan="3">{{ strtoupper($data->c_full_name ?? 'N/A') }}</td>
                                </tr>
                                <tr>
                                    <td class="label">Duration</td>
                                    <td class="value">{{ $data->c_duration ?? 'N/A' }} @if($data->c_duration) Months @endif</td>
                                    <td class="label">Session</td>
                                    <td class="value">{{ \Carbon\Carbon::parse($data->created_at ?? now())->format('Y') }}-{{ \Carbon\Carbon::parse($data->created_at ?? now())->addYear()->format('Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="label">Center Code</td>
                                    <td class="value">{{ $data->cl_code ?? 'N/A' }}</td>
                                    <td class="label">Center Name</td>
                                    <td class="value">{{ $data->cl_center_name ?? $data->cl_name ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </td>
                        <td class="photo-cell">
                            <div class="photo-frame">
                                @if(!empty($data->sl_photo) && file_exists(public_path($data->sl_photo)))
                                    <img src="{{ asset($data->sl_photo) }}" alt="Student Photo">
                                @else
                                    <span>Photo</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                </table>

                <!-- Marks Table -->
                <table class="marks-table">
                    <thead>
                        <tr>
                            <th style="width:50px;">S.NO.</th>
                            <th>SUBJECT / EXAMINATION</th>
                            <th style="width:90px;">FULL MARKS</th>
                            <th style="width:90px;">PASS MARKS</th>
                            <th style="width:100px;">MARKS OBTAINED</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $subjects = [
                                ['name' => $data->sr_written ?? 'Written Examination', 'full' => $data->sr_wr_full_marks ?? 0, 'pass' => $data->sr_wr_pass_marks ?? 0, 'obtained' => $data->sr_wr_marks_obtained ?? 0],
                                ['name' => $data->sr_practical ?? 'Practical Examination', 'full' => $data->sr_pr_full_marks ?? 0, 'pass' => $data->sr_pr_pass_marks ?? 0, 'obtained' => $data->sr_pr_marks_obtained ?? 0],
                                ['name' => $data->sr_project ?? 'Project Work / Assignment', 'full' => $data->sr_ap_full_marks ?? 0, 'pass' => $data->sr_ap_pass_marks ?? 0, 'obtained' => $data->sr_ap_marks_obtained ?? 0],
                                ['name' => $data->sr_viva ?? 'Viva Voce', 'full' => $data->sr_vv_full_marks ?? 0, 'pass' => $data->sr_vv_pass_marks ?? 0, 'obtained' => $data->sr_vv_marks_obtained ?? 0],
                            ];
                            $sno = 1;
                        @endphp
                        @foreach($subjects as $subject)
                            <tr>
                                <td>{{ $sno++ }}</td>
                                <td class="subject-name">{{ $subject['name'] }}</td>
                                <td>{{ $subject['full'] }}</td>
                                <td>{{ $subject['pass'] }}</td>
                                <td>{{ $subject['obtained'] }}</td>
                            </tr>
                        @endforeach
                        <tr class="total-row">
                            <td colspan="2" style="text-align:center;">TOTAL</td>
                            <td>{{ $data->sr_total_full_marks ?? 0 }}</td>
                            <td>{{ $data->sr_total_pass_marks ?? 0 }}</td>
                            <td>{{ $data->sr_total_marks_obtained ?? 0 }}</td>
                        </tr>
                        @php
                            $percentage = $data->sr_percentage ?? 0;
                            $grade = $data->sr_grade ?? 'F';
                            $result = ($percentage >= 40) ? 'PASS' : 'FAIL';
                            $division = '';
                            if ($percentage >= 60) {
                                $division = 'FIRST';
                            } elseif ($percentage >= 50) {
                                $division = 'SECOND';
                            } elseif ($percentage >= 40) {
                                $division = 'THIRD';
                            }
                        @endphp
                        <tr class="result-row">
                            <td colspan="5" style="padding:8px;">
                                RESULT: {{ $result }} &nbsp;&nbsp;|&nbsp;&nbsp; PERCENTAGE: {{ number_format($percentage, 2) }}% &nbsp;&nbsp;|&nbsp;&nbsp; GRADE: {{ $grade }} @if($division) &nbsp;&nbsp;|&nbsp;&nbsp; DIVISION: {{ $division }} @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Grade Legend -->
                <div class="grade-legend">
                    <strong>Grade Scale:</strong> &nbsp;&nbsp;
                    A+: 90% &amp; Above &nbsp;&nbsp;|&nbsp;&nbsp;
                    A: 80-89% &nbsp;&nbsp;|&nbsp;&nbsp;
                    B+: 70-79% &nbsp;&nbsp;|&nbsp;&nbsp;
                    B: 60-69% &nbsp;&nbsp;|&nbsp;&nbsp;
                    C: 50-59% &nbsp;&nbsp;|&nbsp;&nbsp;
                    D: 40-49% &nbsp;&nbsp;|&nbsp;&nbsp;
                    F: Below 40%
                </div>

                <!-- Notes -->
                <div class="notes-section">
                    <h4>Notes &amp; Explanation:</h4>
                    <p>1. In case of any mistake being detected in the preparation of the Marks Statement at any stage, we shall have the right to make necessary corrections.</p>
                    <p>2. This is a Computer generated Mark Sheet. For Verification, please visit our website or contact the head office.</p>
                    <p>3. In case of any error in this statement of marks, it should be reported within 15 days from the date of issue.</p>
                    <p>4. This Mark Sheet is valid only with the official stamp and authorized signature.</p>
                </div>

                <!-- Logos -->
                <table class="logos-table">
                    <tr>
                        <td><div class="logo-box">SKILL INDIA</div><p class="logo-label">SKILL INDIA</p></td>
                        <td><div class="logo-box">MINISTRY</div><p class="logo-label">MINISTRY OF SKILL DEV.</p></td>
                        <td><div class="logo-box">MSME</div><p class="logo-label">MSME</p></td>
                        <td><div class="logo-box">ISO</div><p class="logo-label">ISO 9001:2015</p></td>
                        <td><div class="logo-box">STARTUP</div><p class="logo-label">#startupindia</p></td>
                        <td><div class="logo-box">NCS</div><p class="logo-label">NATIONAL CAREER SERVICE</p></td>
                    </tr>
                </table>

                <!-- Footer -->
                <table class="footer-table">
                    <tr>
                        <td width="25%">
                            <p class="footer-label">Date of Issue</p>
                            <p class="footer-value">{{ \Carbon\Carbon::parse($data->created_at ?? now())->format('d-M-Y') }}</p>
                        </td>
                        <td width="25%">
                            <div class="stamp-box">Stamp</div>
                        </td>
                        <td width="25%">
                            <p class="footer-label">Examination Controller</p>
                            <div class="sig-space"></div>
                        </td>
                        <td width="25%">
                            <p class="footer-label">Authorized Signatory</p>
                            <div class="sig-space"></div>
                        </td>
                    </tr>
                </table>

                <!-- CIN Footer -->
                <div class="cin-footer">
                    <strong>CIN:</strong> U47411DL2023PTC422329 &nbsp;|&nbsp;
                    <strong>Corporate Office:</strong> Siswar, Phulparas, Madhubani, Bihar-847409
                </div>
            </div>
        </div>
    </div>
</body>
</html>

