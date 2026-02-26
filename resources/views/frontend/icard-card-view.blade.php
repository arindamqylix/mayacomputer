@extends('frontend.layouts.master')
@section('title', 'Student ID Card - ' . ($data->sl_name ?? 'Student'))

@push('custom-css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Noto+Sans+Devanagari:wght@400;700&display=swap');

        .icard-outer-wrap {
            background: #f5f7fa;
            padding: 60px 0;
            min-height: 70vh;
        }

        .id-card-display-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .print-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            padding: 25px;
            max-width: 420px;
            width: 100%;
            margin-bottom: 30px;
        }

        .id-card {
            width: 100%;
            max-width: 370px;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            border: 2px solid #000077;
            margin: 0 auto;
        }

        .id-header {
            background: #ffffff;
            padding: 5px;
            text-align: center;
            position: relative;
            border-bottom: 2px solid #000077;
            display: block;
        }

        .header-banner {
            width: 100%;
            height: auto;
            max-height: 80px;
            display: block;
            margin: 0 auto;
        }

        .header-subtext {
            text-align: center;
            margin-top: -10px;
        }

        .reg-details {
            font-size: 7px;
            font-weight: bold;
            margin: 1px 0;
            color: #000;
            font-family: Arial, sans-serif;
        }

        .iso-text {
            color: red;
            font-weight: bold;
            font-size: 8px;
            margin: 1px 0;
            font-family: Arial, sans-serif;
        }

        .id-header-text {
            text-align: center;
            position: relative;
            z-index: 3;
            background: #000077;
            padding: 5px 15px;
            width: 100%;
            margin-top: 5px;
        }

        .id-header-text .card-type {
            font-size: 14px;
            color: #ffffff;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .id-body {
            padding: 15px 15px 10px;
            display: flex;
            gap: 15px;
            align-items: flex-start;
            background: #ffffff;
        }

        .photo-section {
            flex: 0 0 100px;
        }

        .photo-container {
            width: 100px;
            height: 120px;
            border: 2px solid #000077;
            border-radius: 6px;
            background: #f8f9fa;
            overflow: hidden;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        .photo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .photo-placeholder {
            width: 100%;
            height: 100%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }

        .info-section {
            flex: 1;
            min-width: 0;
        }

        .student-name {
            font-size: 14px;
            font-weight: 800;
            color: #000077;
            margin: 0 0 15px 0;
            text-transform: uppercase;
            line-height: 1.3;
            display: block;
            border-left: 4px solid #ffd700;
            padding-left: 10px;
        }

        .info-row {
            display: grid;
            grid-template-columns: 24px 85px 1fr;
            align-items: start;
            padding: 5px 0;
            border-bottom: 1px solid #f1f1f1;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label-icon {
            color: #000077;
            font-size: 11px;
            text-align: center;
            padding-top: 2px;
        }

        .info-label-text {
            font-weight: 700;
            color: #555;
            font-size: 10px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .info-value {
            font-weight: 600;
            color: #000;
            text-align: left;
            font-size: 11px;
            line-height: 1.3;
            word-break: break-word;
        }

        .id-footer {
            background: #ffffff;
            padding: 0;
            margin-top: 10px;
            position: relative;
        }

        .footer-content {
            padding: 5px 15px 10px;
            position: relative;
            min-height: 80px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-end;
        }

        .signature-wrapper {
            position: relative;
            width: 140px;
            text-align: center;
        }

        .footer-strip {
            height: 12px;
            width: 100%;
            background: linear-gradient(90deg, #000077 0%, #000099 50%, #ffd700 100%);
        }

        .signature-section {
            position: relative;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: flex-end;
            height: 60px;
            margin-bottom: 2px;
            z-index: 2;
        }

        .footer-stamp {
            position: absolute;
            bottom: -16px;
            left: 50%;
            transform: translateX(-50%);
            height: 102px;
            opacity: 0.9;
            z-index: 1;
        }

        .footer-sign {
            position: absolute;
            bottom: 18px;
            left: 50%;
            transform: translateX(-50%);
            height: 35px;
            z-index: 2;
            display: block;
        }

        .signature-label {
            font-size: 11px;
            font-weight: 800;
            color: #000077;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 0;
            margin-top: -10px;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn-download {
            background: #dc3545;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-print {
            background: #000077;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-download:hover,
        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        @media print {
            .icard-outer-wrap {
                padding: 0;
                background: white;
            }

            .rs-header,
            .rs-footer,
            .rs-breadcrumbs,
            .action-buttons {
                display: none !important;
            }

            .print-container {
                box-shadow: none;
                padding: 0;
                max-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .id-body {
                flex-direction: column-reverse;
                align-items: center;
            }

            .photo-section {
                margin-bottom: 15px;
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
                        <h1 class="page-title">I-Card Verification</h1>
                        <ul>
                            <li><a class="active" href="{{url('/')}}">Home</a></li>
                            <li>I-Card View</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumbs End -->

    <div class="icard-outer-wrap">
        <div class="container">
            <div class="id-card-display-section">
                <div class="print-container">
                    <div class="id-card">
                        <div class="id-header">
                            @php
                                $logoPath = null;
                                if ($setting) {
                                    if (!empty($setting->document_logo) && file_exists(public_path($setting->document_logo))) {
                                        $logoPath = $setting->document_logo;
                                    } elseif (!empty($setting->site_logo) && file_exists(public_path($setting->site_logo))) {
                                        $logoPath = $setting->site_logo;
                                    } else {
                                        $logoPath = 'header_banner.png';
                                    }
                                } else {
                                    $logoPath = 'header_banner.png';
                                }
                            @endphp

                            <img src="{{ asset($logoPath) }}" alt="Banner" class="header-banner">

                            <div class="header-subtext">
                                <p class="reg-details" style="font-size: 14px;">CIN : U85220DL2023PTC422329</p>
                                <p class="reg-details" style="font-size: 11px;">Reg. Under the Company Act.2013 MCA,
                                    Government of India</p>
                                <p class="reg-details" style="font-size:9px;">Registered Under NCT Delhi, Skill India, Udyam
                                    & Startup India</p>
                                <p class="iso-text" style="font-size: 14px;">An ISO 9001: 2015 Certified</p>
                                <p class="reg-details" style="font-size: 10px; margin-top: 2px;">Visit Our Website :
                                    mayacc.in</p>
                            </div>

                            <div class="id-header-text">
                                <div class="card-type">Student ID Card</div>
                            </div>
                        </div>

                        <div class="id-body">
                            <div class="info-section">
                                <div class="student-name">{{ $data->sl_name ?? 'N/A' }}</div>

                                <div class="student-info">
                                    <div class="info-row">
                                        <div class="info-label-icon"><i class="fas fa-hashtag"></i></div>
                                        <div class="info-label-text">Reg. No:</div>
                                        <div class="info-value" style="font-weight: 800; color: #000077;">
                                            {{ $data->sl_reg_no ?? 'N/A' }}
                                        </div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label-icon"><i class="fas fa-graduation-cap"></i></div>
                                        <div class="info-label-text">Course:</div>
                                        <div class="info-value">{{ $data->c_short_name ?? $data->c_full_name ?? 'N/A' }}
                                        </div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label-icon"><i class="fas fa-user-friends"></i></div>
                                        <div class="info-label-text">Father:</div>
                                        <div class="info-value">{{ strtoupper($data->sl_father_name ?? 'N/A') }}</div>
                                    </div>

                                    @if($data->sl_dob)
                                        <div class="info-row">
                                            <div class="info-label-icon"><i class="fas fa-birthday-cake"></i></div>
                                            <div class="info-label-text">DOB:</div>
                                            <div class="info-value">
                                                {{ \Carbon\Carbon::parse($data->sl_dob)->format('d-m-Y') }}
                                            </div>
                                        </div>
                                    @endif

                                    @if($data->sl_mobile_no ?? $data->cl_mobile ?? null)
                                        <div class="info-row">
                                            <div class="info-label-icon"><i class="fas fa-phone"></i></div>
                                            <div class="info-label-text">Mobile:</div>
                                            <div class="info-value">{{ $data->sl_mobile_no ?? $data->cl_mobile ?? 'N/A' }}</div>
                                        </div>
                                    @endif

                                    @if($data->cl_center_name ?? $data->cl_name ?? null)
                                        <div class="info-row">
                                            <div class="info-label-icon"><i class="fas fa-building"></i></div>
                                            <div class="info-label-text">Center:</div>
                                            <div class="info-value" style="font-size: 9px;">
                                                {{ ($data->cl_center_name ?? $data->cl_name ?? 'N/A') . ($data->cl_code ? ' - ' . $data->cl_code : '') }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="photo-section">
                                <div class="photo-container">
                                    @if(!empty($data->sl_photo))
                                        <img src="{{ asset($data->sl_photo) }}" alt="Student Photo"
                                            onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'photo-placeholder\'><i class=\'fas fa-user\'></i></div>';">
                                    @else
                                        <div class="photo-placeholder">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="id-footer">
                            <div class="footer-content">
                                <!-- Left: QR Code -->
                                <div class="qr-section">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-center/' . ($data->cl_code ?? '')) }}"
                                        alt="QR"
                                        style="width: 70px; height: 70px; border: 1px solid #ddd; padding: 2px; background:white;">
                                </div>

                                <!-- Right: Signature -->
                                <div class="signature-wrapper">
                                    <div class="signature-section">
                                        @if(!empty($setting->authorize_stamp) && file_exists(public_path($setting->authorize_stamp)))
                                            <img src="{{ asset($setting->authorize_stamp) }}" class="footer-stamp" alt="Stamp">
                                        @endif

                                        @if(!empty($setting->authorize_signature) && file_exists(public_path($setting->authorize_signature)))
                                            <img src="{{ asset($setting->authorize_signature) }}" class="footer-sign"
                                                alt="Sign">
                                        @endif
                                    </div>
                                    <div class="sig-text-wrapper">
                                        <div class="signature-label">Authorized Signatory</div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-strip"></div>
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    {{-- Download button will be implemented if PDF route is available --}}
                    <form action="{{ route('verification.icard.pdf') }}" method="POST">
                        @csrf
                        <input type="hidden" name="registration_no" value="{{ $data->sl_reg_no }}">
                        <input type="hidden" name="dob" value="{{ $data->sl_dob }}">
                        <button type="submit" class="btn-download">
                            <i class="fas fa-download"></i> Download PDF
                        </button>
                    </form>
                    <button onclick="window.print()" class="btn-print">
                        <i class="fas fa-print"></i> Print ID Card
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection