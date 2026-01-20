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
            flex-grow: 1;
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
            top: 20px;
            width: 70px;
            height: 70px;
            border: 1px solid #ddd;
            background: #fff;
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

        .controller-sign {
            margin-top: 100px;
            /* More spacing since no table */
            text-align: right;
            padding-right: 20px;
            font-weight: bold;
            font-size: 14px;
            font-family: Arial, sans-serif;
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
             .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="card-container">
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
                </div>
                 <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-student/'.$data->sl_reg_no) }}"
                            alt="QR Code" class="qr-code">
            </div>

            <!-- Title -->
            <div class="card-title">
                पंजीयन पत्रक (REGISTRATION CARD) – {{ \Carbon\Carbon::parse($data->created_at)->year }}
            </div>
            <!-- TM Symbol simulation -->
            <!-- <div class="tm-symbol">TM</div> -->

            <!-- Blue Strip -->
            <div class="blue-bar">
                <span>Registration No.: &nbsp; {{ $data->sl_reg_no ?? 'N/A' }}</span>
                <span>Registration Years: {{ \Carbon\Carbon::parse($data->created_at)->year }}</span>
            </div>

            <!-- Student Details -->
            <div class="details-section">
                <table class="info-table">
                    <tr>
                        <td class="label">Student Name:</td>
                        <td class="value">{{ strtoupper($data->sl_name ?? '') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Father’s Name:</td>
                        <td class="value">{{ strtoupper($data->sl_father_name ?? '') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Mother’s Name:</td>
                        <td class="value">{{ strtoupper($data->sl_mother_name ?? '') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Date of Birth:</td>
                        <td class="value">{{ $data->sl_dob ?? 'N/A' }} &nbsp;&nbsp;&nbsp;&nbsp; <span
                                style="font-weight:normal; font-style:italic;">Gender:</span> {{ ucfirst($data->sl_sex ?? 'N/A') }}
                            &nbsp;&nbsp;&nbsp;&nbsp; <span
                                style="font-weight:normal; font-style:italic;">Category:</span> {{ $data->sl_category ?? 'Gen' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Center Code & Name:</td>
                        <td class="value">{{ $data->cl_code ?? '' }}- {{ strtoupper($data->cl_center_name ?? '') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Course Name:</td>
                        <td class="value">{{ strtoupper($data->c_full_name ?? $data->c_short_name ?? '') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Course Duration:</td>
                        <td class="value">{{ $data->c_duration ?? 'N/A' }}</td>
                    </tr>
                </table>

                <div class="photo-box">
                    <div class="photo-placeholder">
                         @if(!empty($data->sl_photo) && file_exists(public_path($data->sl_photo)))
                            <img src="{{ asset($data->sl_photo) }}" alt="Student Photo">
                        @else
                            Picture<br><br>1.2 in X 1.5 in
                        @endif
                    </div>
                    <div class="signature-box">Student Signature</div>
                </div>
            </div>

            <div class="controller-sign">
                Controller of Examination
            </div>

        </div>
    </div>
    
              <!-- Print Button (Hidden in Print Mode) -->
    <div style="text-align: center; margin-top: 20px;" class="no-print">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; background: #000066; color: white; border: none; cursor: pointer;">Print Registration Card</button>
    </div>

</body>

</html>
