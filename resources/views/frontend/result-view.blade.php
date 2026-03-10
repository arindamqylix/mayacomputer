@extends('frontend.layouts.master')
@section('title', 'Verified Marksheet - ' . $data->sl_reg_no)

@push('custom-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;700&family=Times+New+Roman&display=swap');

        .result-view-page {
            background: #f4f7f6;
            padding: 50px 0;
        }

        .action-bar-container {
            margin-bottom: 30px;
        }

        .action-bar {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 12px 25px;
            font-size: 15px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none !important;
            transition: all 0.3s;
            color: #fff !important;
        }

        .btn-print {
            background: #000066;
        }

        .btn-download {
            background: #dc2626;
        }

        .btn-back {
            background: #6b7280;
        }

        .btn-action:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Marksheet Styles */
        .marksheet-wrapper {
            display: flex;
            justify-content: center;
            overflow-x: auto;
            padding: 20px;
        }

        .marksheet-container {
            width: 210mm;
            min-height: 297mm;
            background: #fff;
            padding: 10mm;
            position: relative;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            transform: scale(1);
            transform-origin: top center;
        }

        .border-pattern {
            position: relative;
            padding: 5px;
            background: #fff;
            height: 100%;
            border: none;
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

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.05;
            z-index: 0;
            width: 70%;
            pointer-events: none;
        }

        .content {
            position: relative;
            z-index: 1;
            font-family: "Times New Roman", Times, serif;
        }

        .header-doc {
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
        }

        .header-subtext {
            text-align: center;
            margin-top: -10px;
            padding: 0;
        }

        .reg-details {
            font-size: 11px;
            font-weight: bold;
            margin: 2px 0;
            color: #000;
            font-family: Arial, sans-serif;
        }

        .iso-text {
            color: red;
            font-weight: bold;
            font-size: 14px;
            margin: 2px 0;
            font-family: Arial, sans-serif;
        }

        .hologram-wrapper {
            position: absolute;
            right: 10px;
            top: 10px;
            z-index: 10;
            text-align: center;
        }

        .hologram-wrapper img {
            width: 70px;
        }

        .hologram-wrapper .sn-text {
            display: block;
            font-size: 10px;
            font-weight: bold;
        }

        .section-title-doc {
            background-color: #000066;
            color: white;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            padding: 5px;
            text-transform: uppercase;
            font-family: Arial, sans-serif;
            margin: 10px 0;
        }

        .info-box {
            border: 1px solid #000066;
            padding: 8px;
            display: flex;
            margin-bottom: 10px;
        }

        .student-details {
            flex-grow: 1;
            font-size: 14px;
        }

        .info-row {
            display: flex;
            margin-bottom: 4px;
        }

        .info-label {
            width: 150px;
            font-weight: bold;
        }

        .info-value {
            font-weight: bold;
            text-transform: uppercase;
            flex-grow: 1;
        }

        .photo-area {
            width: 110px;
            display: flex;
            justify-content: center;
        }

        .student-photo {
            width: 100px;
            height: 120px;
            border: 1px solid #ccc;
            object-fit: cover;
        }

        .modules-box {
            border: 1px solid #000066;
            padding: 10px;
            font-size: 12px;
            margin-top: -1px;
        }

        .marks-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 13px;
            border: 1px solid #000;
            margin-top: 15px;
        }

        .marks-table th {
            background-color: #000066;
            color: white;
            padding: 6px;
            border: 1px solid #fff;
        }

        .marks-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            font-weight: bold;
        }

        .grade-summary-row {
            background-color: #f0f4f8;
        }

        .grading-info {
            font-size: 11px;
            font-weight: bold;
            margin-top: 5px;
        }

        .issue-date {
            font-size: 12px;
            font-weight: bold;
            margin-top: 5px;
        }

        .footer-doc {
            margin-top: auto;
            padding-top: 20px;
        }

        .logo-strip {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .footer-logo {
            height: 40px;
        }

        .card-footer-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .qr-wrap {
            text-align: center;
        }

        .qr-code-img {
            width: 80px;
            height: 80px;
            border: 1px solid #ddd;
        }

        .sig-wrap {
            text-align: center;
            width: 250px;
        }

        .sig-img-container {
            position: relative;
            height: 100px;
        }

        .stamp-doc {
            position: absolute;
            height: 100px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
        }

        .sign-doc {
            position: absolute;
            height: 45px;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
        }

        @media print {

            header,
            footer,
            .rs-breadcrumbs,
            .action-bar-container {
                display: none !important;
            }

            body {
                background: #fff;
                padding: 0;
                margin: 0;
            }

            .result-view-page {
                padding: 0;
            }

            .marksheet-wrapper {
                padding: 0;
                margin: 0;
            }

            .marksheet-container {
                box-shadow: none;
                width: 100%;
                padding: 0;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs bg7 breadcrumbs-overlay" style="background-image: url({{ breadcrumb_image() }});">
        <div class="breadcrumbs-inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="page-title">Marks Statement</h1>
                        <ul>
                            <li><a class="active" href="{{url('/')}}">Home</a></li>
                            <li><a href="{{ route('verification.result') }}">Result Verification</a></li>
                            <li>Statement</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumbs End -->

    <div class="result-view-page">
        <div class="container">

            <div class="action-bar-container">
                <div class="action-bar">
                    <button onclick="window.print()" class="btn-action btn-print">
                        <i class="fas fa-print"></i> Print Marksheet
                    </button>
                    <form action="{{ route('verification.result.pdf') }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="registration_no" value="{{ $data->sl_reg_no }}">
                        <input type="hidden" name="dob" value="{{ $data->sl_dob }}">
                        <button type="submit" class="btn-action btn-download">
                            <i class="fas fa-download"></i> Download PDF
                        </button>
                    </form>
                    <a href="{{ route('verification.result') }}" class="btn-action btn-back">
                        <i class="fas fa-arrow-left"></i> Back to Verification
                    </a>
                </div>
            </div>

            <div class="marksheet-wrapper">
                <div class="marksheet-container">
                    <div class="border-pattern">
                        <div class="border-inner">
                            <div class="border-design">
                                <div class="content-area-white">
                                    <!-- Watermark -->
                                    <img src="@if(!empty($setting->document_logo)){{ asset($setting->document_logo) }}@else{{ asset('logo.png') }}@endif"
                                        class="watermark">

                                    <div class="content">
                                        <!-- Header -->
                                        <div class="header-doc">
                                            @if(!empty($setting->document_logo))
                                                <img src="{{ asset($setting->document_logo) }}" class="header-banner">
                                            @else
                                                <img src="{{ asset('header_banner.png') }}" class="header-banner">
                                            @endif

                                            @if(!empty($setting->hologram))
                                                <div class="hologram-wrapper">
                                                    <img src="{{ asset($setting->hologram) }}">
                                                    
                                                </div>
                                            @endif

                                            <div class="header-subtext">
                                                <p class="reg-details" style="font-size: 16px;">CIN : U85220DL2023PTC422329
                                                </p>
                                                <p class="reg-details" style="font-size: 13px;">Reg. Under the Company
                                                    Act.2013 MCA, Govt. of India</p>
                                                <p class="reg-details" style="font-size: 11px;">Registered Under NCT Delhi,
                                                    Skill India, Udyam & Startup India</p>
                                                <p class="iso-text" style="font-size: 15px;">An ISO 9001: 2015 Certified</p>
                                                <p class="reg-details" style="font-size: 11px; margin-top: 2px;">Visit Our
                                                    Website : mayacc.in</p>
                                            </div>
                                        </div>

                                        <div class="section-title-doc">Statement of Marks</div>

                                        <div class="info-box">
                                            <div class="student-details">
                                                <div class="info-row"><span class="info-label">Registration No.</span> :
                                                    <span class="info-value">&nbsp;{{ $data->sl_reg_no }} &nbsp;&nbsp;&nbsp;
                                                        Year :
                                                        {{ $data->sc_issue_date ? \Carbon\Carbon::parse($data->sc_issue_date)->year : \Carbon\Carbon::parse($data->created_at)->year }}</span>
                                                </div>
                                                <div class="info-row"><span class="info-label">Student Name</span> : <span
                                                        class="info-value">&nbsp;{{ strtoupper($data->sl_name) }}</span>
                                                </div>
                                                <div class="info-row"><span class="info-label">Mother's Name</span> : <span
                                                        class="info-value">&nbsp;{{ strtoupper($data->sl_mother_name) }}</span>
                                                </div>
                                                <div class="info-row"><span class="info-label">Father's Name</span> : <span
                                                        class="info-value">&nbsp;{{ strtoupper($data->sl_father_name) }}</span>
                                                </div>
                                                <div class="info-row"><span class="info-label">Date of Birth</span> : <span
                                                        class="info-value">&nbsp;{{ $data->sl_dob }} &nbsp;&nbsp; Gender :
                                                        {{ strtoupper($data->sl_sex) }}</span></div>
                                                <div class="info-row"><span class="info-label">Course Name</span> : <span
                                                        class="info-value">&nbsp;{{ strtoupper($data->c_full_name) }}</span>
                                                </div>
                                                <div class="info-row"><span class="info-label">Center Name</span> : <span
                                                        class="info-value">&nbsp;{{ strtoupper($data->cl_center_name ?? $data->cl_name) }}</span>
                                                </div>
                                                <div class="info-row"><span class="info-label">Center Code</span> : <span
                                                        class="info-value">&nbsp;{{ $data->cl_code }}</span></div>
                                            </div>
                                            <div class="photo-area">
                                                @if(!empty($data->sl_photo))
                                                    <img src="{{ asset($data->sl_photo) }}" class="student-photo">
                                                @else
                                                    <img src="https://via.placeholder.com/100x120?text=Photo"
                                                        class="student-photo">
                                                @endif
                                            </div>
                                        </div>

                                        @if(!empty($data->description))
                                            <div class="section-title-doc" style="margin-top: 0;">Modules Covered</div>
                                            <div class="modules-box">
                                                {!! html_entity_decode($data->description) !!}
                                            </div>
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
                                                    <td style="text-align: left;">{{ $data->sr_written ?? 'Written' }}</td>
                                                    <td>{{ $data->sr_wr_full_marks ?? 100 }}</td>
                                                    <td>{{ $data->sr_wr_pass_marks ?? 40 }}</td>
                                                    <td>{{ $data->sr_wr_marks_obtained }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left;">{{ $data->sr_practical ?? 'Practical' }}
                                                    </td>
                                                    <td>{{ $data->sr_pr_full_marks ?? 100 }}</td>
                                                    <td>{{ $data->sr_pr_pass_marks ?? 40 }}</td>
                                                    <td>{{ $data->sr_pr_marks_obtained }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left;">{{ $data->sr_project ?? 'Assignment' }}
                                                    </td>
                                                    <td>{{ $data->sr_ap_full_marks ?? 100 }}</td>
                                                    <td>{{ $data->sr_ap_pass_marks ?? 40 }}</td>
                                                    <td>{{ $data->sr_ap_marks_obtained }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left;">{{ $data->sr_viva ?? 'Viva' }}</td>
                                                    <td>{{ $data->sr_vv_full_marks ?? 100 }}</td>
                                                    <td>{{ $data->sr_vv_pass_marks ?? 40 }}</td>
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
                                                <tr class="grade-summary-row">
                                                    <td>Percentage</td>
                                                    <td>{{ number_format($data->sr_percentage, 2) }}%</td>
                                                    <td>Grade</td>
                                                    <td>{{ strtoupper($data->sr_grade) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="grading-info">Grade A: 85-100%. Grade B: 70-84%. Grade C: 55-69%. Grade
                                            D: 40-54%. Fail: Below 40%.</div>
                                        <div class="issue-date">Date of Issue:
                                            {{ $data->sc_issue_date ? \Carbon\Carbon::parse($data->sc_issue_date)->format('d-M-Y') : now()->format('d-M-Y') }}
                                        </div>

                                        <div class="footer-doc">
                                            <div class="logo-strip">
                                                @if(!empty($setting->certificate_footer_logos))
                                                    @php $logos = json_decode($setting->certificate_footer_logos); @endphp
                                                    @if(is_array($logos))
                                                        @foreach($logos as $logo)
                                                            <img src="{{ asset($logo) }}" class="footer-logo">
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </div>

                                            <div class="card-footer-row">
                                                <div class="qr-wrap">
                                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-result/' . $data->sl_reg_no) }}"
                                                        class="qr-code-img">
                                                    <div style="font-size:10px; font-weight:bold; margin-top:5px;">SN.
                                                        MCC{{ str_pad($data->sl_id, 5, '0', STR_PAD_LEFT) }}</div>
                                                </div>
                                                <div class="sig-wrap">
                                                    <div class="sig-img-container">
                                                        @if(!empty($setting->authorize_stamp))
                                                            <img src="{{ asset($setting->authorize_stamp) }}" class="stamp-doc">
                                                        @endif
                                                        @if(!empty($setting->authorize_signature))
                                                            <img src="{{ asset($setting->authorize_signature) }}"
                                                                class="sign-doc">
                                                        @endif
                                                    </div>
                                                    <div style="font-weight:bold; font-size:14px; margin-top: 5px;">
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
            </div>

        </div>
    </div>
@endsection