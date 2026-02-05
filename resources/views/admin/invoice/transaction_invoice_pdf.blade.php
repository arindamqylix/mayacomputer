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

<!-- Header -->
<div class="header-container"
    style="text-align: center; margin-bottom: 10px; border-bottom: 2px solid #000077; padding-bottom: 5px;">
    <img src="{{ asset($logoPath) }}" alt="Banner" style="width: 100%; max-height: 80px; object-fit: contain;">

    <div style="text-align: center; margin-top: -10px;">
        <p style="font-size: 8px; font-weight: bold; margin: 2px 0; color: #000; font-family: Arial, sans-serif;">Reg.
            Under the Company Act.2013 MCA, Government of India</p>
        <p style="font-size: 8px; font-weight: bold; margin: 2px 0; color: #000; font-family: Arial, sans-serif;">
            Registered Under Skill India, Udyam & Startup India</p>
        <p style="color: red; font-weight: bold; font-size: 8px; margin: 2px 0; font-family: Arial, sans-serif;">An ISO
            9001: 2015 Certified</p>
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
                <th class="text-right">Transaction Amount (₹)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{ $transaction->t_student_reg_no ? 'Docs fee for ' . $transaction->t_student_reg_no : 'Center Transaction' }}
                    <br>
                    <small>Txn ID: {{ $transaction->t_id }}</small>
                </td>
                <td class="text-right">₹ {{ number_format($transaction->t_amount, 2) }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right">Total Debit:</th>
                <th class="text-right">₹ {{ number_format($transaction->t_amount, 2) }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>This is a computer generated receipt and does not require a signature.</p>
        <p>{{ $siteName }} | {{ $siteEmail }} | {{ $sitePhone }}</p>
    </div>
</div>