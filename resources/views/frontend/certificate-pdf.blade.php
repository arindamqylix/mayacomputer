<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Certificate of Diploma</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        @page {
            size: A4 landscape;
            margin: 0px;
        }

        .container {
            width: 1080px;
            height: 750px;
            padding: 10px;
            margin: 0 auto;
        }

        .outer-border {
            border: 3px dashed #0f1d46;
            padding: 5px;
            height: 100%;
        }

        .inner-border {
            border: 2px solid #0f1d46;
            padding: 3px;
            height: 100%;
        }

        .design-border {
            border: 2px solid #0f1d46;
            padding: 5px;
            height: 100%;
        }

        .content-area {
            border: 1px solid #c5a059;
            height: 100%;
            position: relative;
            padding: 10px 20px;
            background-color: #fff;
        }

        /* Watermark */
        .watermark {
            position: absolute;
            top: 250px;
            left: 50%;
            transform: translateX(-50%) rotate(-30deg);
            color: #0f1d46;
            opacity: 0.04;
            font-size: 55px;
            font-weight: bold;
            white-space: nowrap;
            letter-spacing: 2px;
            z-index: 1;
        }

        .main-content {
            position: relative;
            z-index: 10;
        }

        /* Header section */
        table.header-table {
            width: 100%;
            margin-bottom: 5px;
            border-collapse: collapse;
        }

        table.header-table td {
            vertical-align: top;
            text-align: center;
        }

        /* certificate Title */
        .certificate-title {
            background-color: #0f1d46;
            color: #fff;
            text-align: center;
            padding: 6px 0;
            margin: 10px -20px 15px -20px;
            border-top: 2px solid #c5a059;
            border-bottom: 2px solid #c5a059;
            font-family: 'Times New Roman', Times, serif;
            font-size: 26px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        /* Body content */
        .body-text {
            text-align: center;
            padding: 0 150px 0 50px;
            position: relative;
            min-height: 200px;
        }

        .awarded-to {
            font-family: 'Times New Roman', Times, serif;
            font-size: 18px;
            font-style: italic;
            color: #333;
            margin-bottom: 8px;
        }

        .student-name {
            font-family: 'Times New Roman', Times, serif;
            font-size: 24px;
            font-weight: bold;
            color: #0f1d46;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .description {
            font-family: 'Times New Roman', Times, serif;
            font-size: 16px;
            font-style: italic;
            line-height: 1.8;
            color: #000;
        }

        .study-center {
            font-family: 'Times New Roman', Times, serif;
            font-size: 16px;
            font-style: italic;
            font-weight: bold;
            margin-top: 15px;
            color: #000;
        }

        .recommendation {
            font-family: 'Times New Roman', Times, serif;
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 10px;
            color: #000;
        }

        .company-name {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18px;
            font-weight: bold;
            color: #0f1d46;
            text-decoration: underline;
            text-transform: uppercase;
        }

        /* Photo */
        .photo-container {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 100px;
            height: 120px;
            border: 2px solid #000;
            padding: 2px;
        }

        .photo-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Footer Logos */
        .footer-logos {
            text-align: center;
            margin-top: 15px;
            padding-top: 5px;
            border-top: 1px dashed #ccc;
        }

        .footer-logos img {
            height: 40px;
            max-width: 160px;
            display: inline-block;
            margin: 0 5px;
        }

        /* Signatures */
        table.signatures-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table.signatures-table td {
            width: 33.33%;
            text-align: center;
            vertical-align: bottom;
        }

        .border-bottom-line {
            border-bottom: 1px solid #333;
            display: inline-block;
            width: 150px;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 14px;
            padding-bottom: 2px;
        }

        .signature-title {
            font-weight: bold;
            font-size: 13px;
            color: #000;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="outer-border">
            <div class="inner-border">
                <div class="design-border">
                    <div class="content-area">
                        <!-- Watermark -->
                        <div class="watermark">MAYA COMPUTER CENTER PRIVATE LIMITED</div>

                        <div class="main-content">
                            <!-- Header -->
                            <table class="header-table">
                                <tr>
                                    <td style="width: 25%; text-align: left; padding-left: 10px;">
                                        @if(!empty($setting->hologram) && file_exists(public_path($setting->hologram)))
                                            <div style="font-weight: bold; font-size: 13px; margin-bottom: 5px;">
                                                Certificate No. :<br>
                                                <span
                                                    style="font-family: 'Times New Roman', serif; font-size: 16px; letter-spacing: 2px;">{{ $certificate->sc_certificate_number }}</span>
                                            </div>
                                            <img src="{{ public_path($setting->hologram) }}"
                                                style="width: 80px; height: auto;">
                                        @endif
                                    </td>
                                    <td style="width: 50%;">
                                        @if(!empty($setting->document_logo) && file_exists(public_path($setting->document_logo)))
                                            <img src="{{ public_path($setting->document_logo) }}" style="height: 80px;">
                                        @else
                                            <img src="{{ public_path('header_banner.png') }}" style="height: 80px;">
                                        @endif
                                        <div style="font-size: 13px; font-weight: bold; margin-top: 5px;">CIN :
                                            U85220DL2023PTC422329</div>
                                        <div style="font-size: 13px; font-weight: bold;">Reg. Under the Company Act.2013
                                            MCA, Government of India</div>
                                        <div style="font-size: 10px; font-weight: bold;">Registered Under NCT Delhi,
                                            Skill India, Udyam & Startup India</div>
                                        <div style="font-size: 13px; font-weight: bold; color: red;">An ISO 9001: 2015
                                            Certified</div>
                                        <div style="font-size: 10px; font-weight: bold;">Visit Our Website : mayacc.in
                                        </div>
                                    </td>
                                    <td style="width: 25%; text-align: right; padding-right: 10px;">
                                        <div style="border: 1px solid #ddd; padding: 2px; display: inline-block;">
                                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('verify-certificate/' . ($certificate->sc_certificate_number ?? '')) }}"
                                                style="width: 70px; height: 70px;">
                                        </div>
                                        <div
                                            style="font-size: 10px; font-weight: bold; font-family: 'Times New Roman', serif; margin-top: 5px;">
                                            SN. MCC{{ str_pad($certificate->sl_id ?? 0, 5, '0', STR_PAD_LEFT) }}</div>
                                        <div style="font-size: 9px; font-weight: bold;">Scan to verify</div>
                                    </td>
                                </tr>
                            </table>

                            <!-- Title Bar -->
                            <div class="certificate-title">CERTIFICATE OF DIPLOMA</div>

                            <!-- Body Text -->
                            <div class="body-text">
                                <div class="awarded-to">THIS CERTIFICATE / DIPLOMA IS AWARDED TO</div>
                                <div class="student-name">{{ strtoupper($certificate->sl_name ?? '') }}</div>

                                <div class="description">
                                    S/o – <b>{{ ucwords(strtolower($certificate->sl_father_name ?? '')) }}</b> , Reg No.
                                    <b>{{ $certificate->sl_reg_no }}</b> on successfully completion of<br>
                                    <b>{{ $certificate->c_full_name ?? '' }}</b> ( Duration -
                                    {{ $certificate->c_duration ?? '' }} ) Course and secured
                                    <b>{{ number_format($certificate->sr_percentage ?? 0, 2) }}%</b> with Grade
                                    <b>{{ strtoupper($certificate->sr_grade ?? '') }} *</b> from our authorised Study
                                    Centre
                                </div>

                                <div class="study-center">
                                    {{ $certificate->cl_center_name ?? '' }} ,
                                    {{ $certificate->cl_center_address ?? '' }}<br>
                                    Centre Code {{ $certificate->cl_code ?? '' }}
                                </div>

                                <div class="recommendation">On the recommendation of the board of examination</div>
                                <div class="company-name">MAYA COMPUTER CENTER PRIVATE LIMITED</div>

                                <!-- Student Photo -->
                                <div class="photo-container">
                                    @if(!empty($certificate->sl_photo) && file_exists(public_path($certificate->sl_photo)))
                                        <img src="{{ public_path($certificate->sl_photo) }}" alt="Student">
                                    @else
                                        <div
                                            style="text-align: center; margin-top: 50px; font-size: 12px; font-weight: bold;">
                                            PHOTO</div>
                                    @endif
                                </div>
                            </div>

                            <!-- Footer Logos -->
                            <div class="footer-logos">
                                @if(!empty($setting->certificate_footer_logos))
                                    @php $logos = json_decode($setting->certificate_footer_logos); @endphp
                                    @if(is_array($logos))
                                        @foreach($logos as $logo)
                                            @if(file_exists(public_path($logo)))
                                                <img src="{{ public_path($logo) }}">
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            </div>

                            <!-- Signatures -->
                            <table class="signatures-table">
                                <tr>
                                    <td>
                                        <div style="font-weight: bold; font-size: 13px; margin-bottom: 5px;">Date of
                                            Issue</div>
                                        <div class="border-bottom-line">
                                            {{ $certificate->sc_issue_date ? \Carbon\Carbon::parse($certificate->sc_issue_date)->format('d-M-Y') : 'N/A' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="position: relative; height: 60px;">
                                            @if(!empty($certificate->cl_center_stamp) && file_exists(public_path($certificate->cl_center_stamp)))
                                                <img src="{{ public_path($certificate->cl_center_stamp) }}"
                                                    style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); max-height: 80px; max-width: 100px; z-index: 1;">
                                            @endif
                                            @if(!empty($certificate->cl_authorized_signature) && file_exists(public_path($certificate->cl_authorized_signature)))
                                                <img src="{{ public_path($certificate->cl_authorized_signature) }}"
                                                    style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); height: 35px; z-index: 2;">
                                            @endif
                                        </div>
                                        <div class="signature-title">Center Head Signature</div>
                                    </td>
                                    <td>
                                        <div style="position: relative; height: 60px;">
                                            @if(!empty($setting->authorize_stamp) && file_exists(public_path($setting->authorize_stamp)))
                                                <img src="{{ public_path($setting->authorize_stamp) }}"
                                                    style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); max-height: 80px; max-width: 100px; z-index: 1;">
                                            @endif
                                            @if(!empty($setting->authorize_signature) && file_exists(public_path($setting->authorize_signature)))
                                                <img src="{{ public_path($setting->authorize_signature) }}"
                                                    style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); height: 35px; z-index: 2;">
                                            @endif
                                        </div>
                                        <div class="signature-title">Authorized Signatory</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>