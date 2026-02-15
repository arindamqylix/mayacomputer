@php
    $siteSettings = site_settings();
    $siteLogo = $siteSettings && !empty($siteSettings->site_logo) ? asset($siteSettings->site_logo) : asset('logo.png');
    $siteName = $siteSettings && !empty($siteSettings->name) ? $siteSettings->name : 'MAYA COMPUTER CENTER';
    $siteEmail = $siteSettings && !empty($siteSettings->email) ? $siteSettings->email : 'mccsiswar@gmail.com';
    $sitePhone = $siteSettings && !empty($siteSettings->phone) ? $siteSettings->phone : '+91 8825148127';
    $siteAddress = $siteSettings && !empty($siteSettings->address) ? $siteSettings->address : '';

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

<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        color: #333;
    }

    /* Header - same as marksheet_diploma.blade.php: centered, 80% width, max-height 120px */
    .header {
        width: 100%;
        text-align: center;
        margin-bottom: 10px;
    }
    .header-banner {
        width: 80%;
        max-height: 120px;
        object-fit: contain;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .header-subtext {
        text-align: center;
        margin-top: -20px;
        padding-left: 0;
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

    .invoice-title-bar {
        text-align: center;
        background: #000077;
        color: white;
        padding: 5px;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th,
    table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .text-right {
        text-align: right;
    }

    .footer {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #ddd;
        text-align: center;
        font-size: 10px;
        color: #666;
    }
</style>

<!-- Header - same structure as marksheet_diploma.blade.php -->
<div class="header">
    <img src="{{ asset($logoPath) }}" alt="Maya Computer Center Banner" class="header-banner">
    <div class="header-subtext">
        <p class="reg-details" style="font-size: 14px;">CIN : U85220DL2023PTC422329</p>
        <p class="reg-details" style="font-size: 12px;">Reg. Under the Company Act.2013 MCA, Government of India</p>
        <p class="reg-details" style="font-size: 11px;">Registered Under NCT Delhi, Skill India, Udyam & Startup India</p>
        <p class="iso-text" style="font-size: 15px;">An ISO 9001: 2015 Certified</p>
        <p class="reg-details" style="font-size: 11px; margin-top: 2px;">Visit Our Website : mayacc.in</p>
    </div>
</div>

<div class="invoice-title-bar">
    <h1 style="margin: 0; font-size: 18px; text-transform: uppercase; letter-spacing: 1px;">TRANSACTION RECEIPT</h1>
    <p style="margin: 2px 0 0 0; font-size: 12px; color: #fff;">
        Receipt No: {{ $invoice_no }} | Date: {{ $invoice_date }}
    </p>
</div>

<div class="invoice-details">
    <table>
        <tr>
            <td style="width: 50%;">
                <strong>From:</strong><br>
                {{ $siteName }}<br>
                @if(!empty($siteAddress))
                    {!! nl2br(e($siteAddress)) !!}
                @endif<br>
                <strong>Email:</strong> {{ $siteEmail }}<br>
                <strong>Phone:</strong> {{ $sitePhone }}
            </td>
            <td style="width: 50%;">
                <strong>Center Details:</strong><br>
                {{ $center->cl_center_name ?? 'N/A' }}<br>
                @if(!empty($center->cl_center_address))
                    {!! nl2br(e($center->cl_center_address)) !!}
                @endif<br>
                <strong>Center Code:</strong> {{ $center->cl_code ?? 'N/A' }}<br>
                <strong>Email:</strong> {{ $center->cl_email ?? 'N/A' }}<br>
                <strong>Mobile:</strong> {{ $center->cl_mobile ?? 'N/A' }}
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th class="text-right">Transaction Amount (Rs)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{ $transaction->t_student_reg_no ? 'Docs fee for ' . $transaction->t_student_reg_no : 'Center Transaction' }}
                    <br>
                    <small>Txn ID: {{ $transaction->t_id }}</small>
                </td>
                <td class="text-right">Rs {{ number_format($transaction->t_amount, 2) }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right">Total Debit:</th>
                <th class="text-right">Rs {{ number_format($transaction->t_amount, 2) }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>This is a computer generated receipt and does not require a signature.</p>
        <p>{{ $siteName }} | {{ $siteEmail }} | {{ $sitePhone }}</p>
    </div>
</div>