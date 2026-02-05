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

        /* Header */
        .header {
            position: relative;
            margin-bottom: 5px;
            width: 100%;
            border-bottom: none;
            padding-bottom: 0;
        }

        .header-banner {
            width: 88%;
            height: auto;
             max-height: 120px; 
            display: block;
        }

        .header-subtext {
            text-align: center;
            margin-top: -20px;
            padding-left: 40px;
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

        .qr-code {
            position: absolute;
            right: 0;
            top: 21px;
            width: 70px;
            height: 70px;
            border: 1px solid #ddd;
            background: #fff;
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

        /* Registration Blue Bar */
        .blue-bar {
            background-color: #000066;
            /* Dark Navy */
            color: white;
            padding: 5px 15px;
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 14px;
            font-family: Arial, sans-serif;
            border: 1px solid #000;
        }

        /* Student Details */
        .details-section {
            border: 1px solid #ccc;
            border-top: none;
            display: flex;
            padding: 10px;
            position: relative;
            background-color: #f9f9f980;
            /* Slight transp for watermark */
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
            font-style: italic;
            text-align: right;
            width: 160px;
            padding-right: 10px;
            color: #000;
        }

        .value {
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
        }

        .photo-box {
            width: 120px;
            height: 140px;
            border: 2px solid #000;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: absolute;
            right: 20px;
            top: 20px;
            background: #fff;
            text-align: center;
        }

        .photo-placeholder {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ccc;
            font-size: 10px;
            width: 100%;
        }
        
         .photo-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        .signature-box {
            border-top: 1px solid #000;
            width: 100%;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: #ccc;
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
            margin-top: 40px;
            display: flex;
            justify-content: flex-end;
            align-items: flex-end;
            padding-right: 20px;
            font-family: Arial, sans-serif;
        }
        .controller-sig-overlap {
            position: relative;
            width: 160px;
            text-align: center;
        }
        .controller-sig-area {
            position: relative;
            height: 85px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .controller-sig-area .auth-stamp {
            position: absolute;
            height: 95px;
            width: auto;
            max-width: 140px;
            object-fit: contain;
            opacity: 0.85;
            z-index: 1;
        }
        .controller-sig-area .auth-sign {
            position: relative;
            height: 38px;
            max-width: 90px;
            object-fit: contain;
            z-index: 2;
        }
        .controller-sig-label {
            padding-top: 4px;
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
         <img src="@if(!empty($setting->document_logo) && file_exists(public_path($setting->document_logo))){{ asset($setting->document_logo) }}@else{{ asset('logo.png') }}@endif" class="watermark" alt="Watermark" style="opacity: 0.05;">


        <div class="content">
            <!-- Header Section -->
            <div class="header">
                 @if(!empty($setting->document_logo) && file_exists(public_path($setting->document_logo)))
                    <img src="{{ asset($setting->document_logo) }}" alt="Maya Computer Center Banner" class="header-banner">
                @else
                    <img src="{{ asset('header_banner.png') }}" alt="Maya Computer Center Banner" class="header-banner">
                @endif
                <div class="header-subtext">
                    <p class="reg-details">Reg. Under the Company Act.2013 MCA, Government of India</p>
                    <p class="reg-details">Registered Under Skill India, Udyam & Startup India</p>
                    <p class="iso-text">An ISO 9001: 2015 Certified</p>
                    <p class="reg-details" style="font-size: 11px; margin-top: 2px;">Visit Our Website : mayacc.in</p>
                </div>
                 <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-student/'.$student->sl_reg_no) }}"
                            alt="QR Code" class="qr-code">
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
                <span>Year : {{ \Carbon\Carbon::parse($student->created_at)->year }}</span>
            </div>

            <!-- Student Details -->
            <div class="details-section">
                <table class="info-table">
                    <tr>
                        <td class="label">Student Name</td>
                        <td class="value" colspan="2">: {{ strtoupper($student->sl_name) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Father’s Name</td>
                        <td class="value" colspan="2">: {{ strtoupper($student->sl_mother_name) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Mother’s Name</td>
                        <td class="value" colspan="2">: {{ strtoupper($student->sl_father_name) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Date of Birth</td>
                        <td class="value" colspan="2">: {{ $student->sl_dob ?? 'N/A' }} &nbsp;&nbsp; Gender : {{ strtoupper($student->sl_sex ?? 'N/A') }} &nbsp;&nbsp; Category : {{ $student->sl_category ?? 'Gen' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Course Name</td>
                        <td class="value" colspan="2">: {{ strtoupper($course->c_full_name ?? $course->c_short_name ?? '') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Course Duration</td>
                        <td class="value" colspan="2">: @php $dur = $course->c_duration ?? 0; if(is_numeric($dur) && $dur >= 12){ echo (round($dur/12)==$dur/12 ? (int)($dur/12) : number_format($dur/12,1)) . (($dur/12)==1 ? ' Year' : ' Years'); } elseif(is_numeric($dur) && $dur > 0){ echo (int)$dur . ($dur==1 ? ' Month' : ' Months'); } else { echo $course->c_duration ?? 'N/A'; } @endphp</td>
                    </tr>
                    <tr>
                        <td class="label">Center Name</td>
                        <td class="value" colspan="2">: {{ strtoupper($center->cl_center_name ?? '') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Center Code & Address</td>
                        <td class="value" colspan="2">: {{ $center->cl_code ?? '' }} & {{ $center->cl_center_address ?? 'N/A' }}</td>
                    </tr>
                </table>

                <div class="photo-box">
                    <div class="photo-placeholder">
                         @if(!empty($student->sl_photo) && file_exists(public_path($student->sl_photo)))
                            <img src="{{ asset($student->sl_photo) }}" alt="Student Photo">
                        @else
                            Picture<br><br>1.2 in X 1.5 in
                        @endif
                    </div>
                    <div class="signature-box">Student Signature</div>
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
    
                  <!-- Print Button (Hidden in Print Mode) -->
    <div style="text-align: center; margin-top: 20px;" class="no-print">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; background: #000066; color: white; border: none; cursor: pointer;">Print Admit Card</button>
    </div>

</body>

</html>
