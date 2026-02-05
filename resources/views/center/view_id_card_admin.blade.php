<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Center ID Card - {{ $data->cl_center_name ?? 'Center' }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Noto+Sans+Devanagari:wght@400;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 20px;
        }

        .print-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 25px;
            max-width: 420px;
            width: 100%;
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

        .id-header::before {
            display: none;
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
            border: 3px solid #000077;
            border-radius: 6px;
            background: #f8f9fa;
            overflow: hidden;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
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

        .photo-placeholder i {
            font-size: 35px;
        }

        .info-section {
            flex: 1;
            min-width: 0;
        }

        .center-name {
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

        .center-info {
            background: transparent;
            padding: 0;
        }

        .info-row {
            display: grid;
            grid-template-columns: 24px 85px 1fr;
            /* Wider label column */
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
            /* Align with text top */
        }

        .info-label-text {
            font-weight: 700;
            color: #555;
            font-size: 10px;
            text-transform: uppercase;
            white-space: nowrap;
            /* Prevent messy wrapping */
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
            width: auto;
            min-width: 140px;
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
            /* Slight overlap upwards */
            white-space: nowrap;
        }

        .sig-text-wrapper {
            position: relative;
            z-index: 0;
            width: 100%;
            text-align: center;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .print-container {
                box-shadow: none;
                padding: 0;
                max-width: 100%;
            }

            .id-card {
                box-shadow: none;
                border: 2px solid #000077;
            }

            .id-header,
            .id-body,
            .id-footer {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .no-print {
                display: none;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 20px 10px;
            }

            .print-container {
                padding: 20px;
            }

            .id-body {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }

            .photo-section {
                flex: 0 0 auto;
            }

            .photo-container {
                width: 110px;
                height: 140px;
            }

            .info-section {
                width: 100%;
            }

            .center-name {
                text-align: center;
                font-size: 18px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="print-container">
        <div class="id-card">
            <div class="id-header">
                @php
                    $siteSettings = site_settings();
                    $logoPath = null;
                    if ($siteSettings) {
                        if (!empty($siteSettings->document_logo) && file_exists(public_path($siteSettings->document_logo))) {
                            $logoPath = $siteSettings->document_logo;
                        } elseif (!empty($siteSettings->site_logo) && file_exists(public_path($siteSettings->site_logo))) {
                            $logoPath = $siteSettings->site_logo;
                        } else {
                            $logoPath = 'header_banner.png';
                        }
                    } else {
                        $logoPath = 'header_banner.png';
                    }
                @endphp

                <img src="{{ asset($logoPath) }}" alt="Banner" class="header-banner">

                <div class="header-subtext">
                    <p class="reg-details">Reg. Under the Company Act.2013 MCA, Government of India</p>
                    <p class="reg-details">Registered Under Skill India, Udyam & Startup India</p>
                    <p class="iso-text">An ISO 9001: 2015 Certified</p>
                    <p class="reg-details" style="font-size: 11px; margin-top: 2px;">Visit Our Website : mayacc.in</p>
                </div>

                <div class="id-header-text">
                    <div class="card-type">Center ID Card</div>
                </div>
            </div>

            <div class="id-body">
                <div class="info-section">
                    <div class="center-name">{{ $data->cl_center_name ?? 'N/A' }}</div>

                    <div class="center-info">
                        <div class="info-row">
                            <div class="info-label-icon"><i class="fas fa-hashtag"></i></div>
                            <div class="info-label-text">Center Code:</div>
                            <div class="info-value" style="font-weight: 800; color: #000077;">
                                {{ $data->cl_code ?? 'N/A' }}
                            </div>
                        </div>

                        @if($data->cl_director_name)
                            <div class="info-row">
                                <div class="info-label-icon"><i class="fas fa-user-tie"></i></div>
                                <div class="info-label-text">Director:</div>
                                <div class="info-value">{{ $data->cl_director_name }}</div>
                            </div>
                        @endif

                        @if($data->cl_center_address)
                            <div class="info-row">
                                <div class="info-label-icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div class="info-label-text">Address:</div>
                                <div class="info-value" style="font-size: 10px;">{{ $data->cl_center_address }}</div>
                            </div>
                        @endif

                        @if($data->cl_email)
                            <div class="info-row">
                                <div class="info-label-icon"><i class="fas fa-envelope"></i></div>
                                <div class="info-label-text">Email:</div>
                                <div class="info-value" style="font-size: 10px;">{{ $data->cl_email }}</div>
                            </div>
                        @endif

                        @if($data->cl_mobile)
                            <div class="info-row">
                                <div class="info-label-icon"><i class="fas fa-phone"></i></div>
                                <div class="info-label-text">Mobile:</div>
                                <div class="info-value">{{ $data->cl_mobile }}</div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="photo-section">
                    <div class="photo-container">
                        @if(!empty($data->cl_photo))
                            <img src="{{ asset($data->cl_photo) }}" alt="Center Photo"
                                onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'photo-placeholder\'><i class=\'fas fa-building\'></i></div>';">
                        @else
                            <div class="photo-placeholder">
                                <i class="fas fa-building"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="id-footer">
                <div class="footer-content">
                    <!-- Left: QR Code -->
                    <div class="qr-section">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-center/' . $data->cl_code) }}"
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
                                <img src="{{ asset($setting->authorize_signature) }}" class="footer-sign" alt="Sign">
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
    <div style="text-align: center; margin-top: 20px;" class="no-print">
        <button onclick="window.print()"
            style="padding: 10px 20px; font-size: 16px; background: #000066; color: white; border: none; cursor: pointer; border-radius: 5px; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">Print
            ID Card</button>
    </div>
</body>

</html>