@extends('frontend.layouts.master')
@section('title', 'Student Registration Card - Maya Computer Center')

@push('custom-css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;700&family=Times+New+Roman&display=swap');

    .card-outer-wrap {
        background: #f0f0f0;
        padding: 40px 15px;
        min-height: 80vh;
    }

    .card-container {
        width: 100%;
        max-width: 210mm;
        margin: 0 auto;
        background: #fff;
        padding: 2mm 10mm;
        padding-bottom: 20mm;
        border: 1px solid #ccc;
        position: relative;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
    }

    .header-banner-section {
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
        text-transform: uppercase;
    }

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
    }

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
        overflow: hidden;
    }

    .photo-placeholder img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .signature-box {
        border-top: 1px solid #000;
        width: 100%;
        min-height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        color: #ccc;
        padding: 4px;
    }

    .signature-box img {
        max-height: 36px;
        width: auto;
        object-fit: contain;
    }

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

    .qr-sr-no {
        font-size: 10px;
        font-weight: 600;
        margin-top: 4px;
        text-align: center;
        color: #333;
    }

    .controller-sign {
        flex-shrink: 0;
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

    .auth-stamp {
        position: absolute;
        height: 130px;
        width: auto;
        object-fit: contain;
        opacity: 0.8;
        z-index: 1;
    }

    .auth-sign {
        position: relative;
        height: 50px;
        width: auto;
        object-fit: contain;
        z-index: 2;
        margin-bottom: 5px;
    }

    .controller-sig-label {
        font-weight: bold;
        font-size: 14px;
        color: #333;
        margin-top: -30px;
        position: relative;
        z-index: 3;
    }

    .action-buttons {
        text-align: center;
        margin-top: 30px;
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .btn-download {
        background: #dc3545;
        color: white;
        padding: 10px 25px;
        border-radius: 5px;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        border: none;
        cursor: pointer;
    }

    .btn-print {
        background: #000066;
        color: white;
        padding: 10px 25px;
        border-radius: 5px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    @media print {
        .card-outer-wrap {
            background: none;
            padding: 0;
        }
        .action-buttons {
            display: none;
        }
        .rs-header, .rs-footer, .rs-breadcrumbs {
            display: none !important;
        }
        .card-container {
            box-shadow: none;
            border: none;
        }
    }

    @media (max-width: 768px) {
        .card-container {
            padding: 2mm 5mm;
        }
        .details-section {
            flex-direction: column;
            padding-right: 10px;
        }
        .photo-box {
            position: relative;
            right: 0;
            top: 0;
            margin: 20px auto 10px;
        }
        .label {
            width: 120px;
            font-size: 12px;
        }
        .value {
            font-size: 12px;
        }
        .blue-bar {
            font-size: 12px;
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endpush

@section('content')
<div class="card-outer-wrap">
    <div class="container">
        <div class="card-container">
            <div class="header-banner-section">
                @if(!empty($setting->document_logo))
                    <img src="{{ asset($setting->document_logo) }}" alt="Maya Computer Center Banner" class="header-banner">
                @else
                    <img src="{{ asset('header_banner.png') }}" alt="Maya Computer Center Banner" class="header-banner">
                @endif
                <div class="header-subtext">
                    <p class="reg-details" style="font-size: 14px;">CIN : U85220DL2023PTC422329</p>
                    <p class="reg-details" style="font-size: 12px;">Reg. Under the Company Act.2013 MCA, Government of India</p>
                    <p class="reg-details" style="font-size: 11px;">Registered Under NCT Delhi, Skill India, Udyam & Startup India</p>
                    <p class="iso-text" style="font-size: 15px;">An ISO 9001: 2015 Certified</p>
                    <p class="reg-details" style="font-size: 11px; margin-top: 2px;">Visit Our Website : mayacc.in</p>
                </div>
            </div>

            <div class="card-title">
                पंजीयन पत्रक (REGISTRATION CARD) – {{ \Carbon\Carbon::parse($student->created_at)->year }}
            </div>

            <div class="blue-bar">
                <span>Registration No. &nbsp;&nbsp;: {{ $student->sl_reg_no }}</span>
                <span>Year : {{ \Carbon\Carbon::parse($student->created_at)->year }}</span>
            </div>

            <div class="details-section">
                <table class="info-table">
                    <tr>
                        <td class="label">Student Name</td>
                        <td class="value">: {{ strtoupper($student->sl_name) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Mother's Name</td>
                        <td class="value">: {{ strtoupper($student->sl_mother_name) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Father's Name</td>
                        <td class="value">: {{ strtoupper($student->sl_father_name) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Date of Birth</td>
                        <td class="value">: {{ $student->sl_dob }} &nbsp;&nbsp; Gender : {{ strtoupper($student->sl_sex) }} &nbsp;&nbsp; Category : {{ $student->sl_category ?? 'Gen' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Course Name</td>
                        <td class="value">: {{ strtoupper($student->c_full_name) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Course Duration</td>
                        <td class="value">: 
                            @php 
                                $dur = $student->c_duration; 
                                if(is_numeric($dur) && $dur >= 12){ 
                                    echo (round($dur/12)==$dur/12 ? (int)($dur/12) : number_format($dur/12,1)) . (($dur/12)==1 ? ' Year' : ' Years'); 
                                } elseif(is_numeric($dur) && $dur > 0){ 
                                    echo (int)$dur . ($dur==1 ? ' Month' : ' Months'); 
                                } else { 
                                    echo $dur; 
                                } 
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Center Name</td>
                        <td class="value">: {{ strtoupper($student->cl_center_name) }}</td>
                    </tr>
                    <tr>
                        <td class="label">Center Code & Address</td>
                        <td class="value">: {{ $student->cl_code }} & {{ $student->cl_center_address }}</td>
                    </tr>
                </table>

                <div class="photo-box">
                    <div class="photo-placeholder">
                        @if(!empty($student->sl_photo))
                            <img src="{{ asset($student->sl_photo) }}" alt="Student Photo">
                        @else
                            Picture<br><br>1.2 in X 1.5 in
                        @endif
                    </div>
                    <div class="signature-box">
                        @if(!empty($student->sl_signature))
                            <img src="{{ asset($student->sl_signature) }}" alt="Student Signature">
                        @else
                            Student Signature
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-footer-row">
                <div class="qr-code-wrap">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-student/' . $student->sl_reg_no) }}" alt="QR Code" class="qr-code">
                    <div class="qr-sr-no">Scan to verify</div>
                </div>
                <div class="controller-sign">
                    <div class="controller-sig-overlap">
                        <div class="controller-sig-area">
                            @if(!empty($setting->authorize_stamp))
                                <img src="{{ asset($setting->authorize_stamp) }}" class="auth-stamp" alt="Stamp">
                            @endif
                            @if(!empty($setting->authorize_signature))
                                <img src="{{ asset($setting->authorize_signature) }}" class="auth-sign" alt="Signature">
                            @endif
                        </div>
                        <div class="controller-sig-label">Controller of Examination</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <form action="{{ route('verification.registration.card.pdf') }}" method="POST">
                @csrf
                <input type="hidden" name="registration_no" value="{{ $student->sl_reg_no }}">
                <input type="hidden" name="dob" value="{{ $student->sl_dob }}">
                <button type="submit" class="btn-download">
                    <i class="fa fa-download"></i> Download PDF
                </button>
            </form>
            <button onclick="window.print()" class="btn-print">
                <i class="fa fa-print"></i> Print Card
            </button>
        </div>
    </div>
</div>
@endsection
