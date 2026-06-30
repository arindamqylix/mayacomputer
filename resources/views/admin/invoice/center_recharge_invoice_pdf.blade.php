@php
    $siteSettings = site_settings();
    $setting = $siteSettings;
    $siteName = $siteSettings && !empty($siteSettings->name) ? $siteSettings->name : 'MAYA COMPUTER CENTER';
    $siteEmail = $siteSettings && !empty($siteSettings->email) ? $siteSettings->email : 'mccsiswar@gmail.com';
    $sitePhone = $siteSettings && !empty($siteSettings->phone) ? $siteSettings->phone : '+91 8825148127';
    $siteAddress = $siteSettings && !empty($siteSettings->address) ? $siteSettings->address : '';

    $logoPath = 'header_banner.png';
    if ($siteSettings) {
        if (!empty($siteSettings->document_logo) && file_exists(public_path(ltrim($siteSettings->document_logo, '/')))) {
            $logoPath = ltrim($siteSettings->document_logo, '/');
        } elseif (file_exists(public_path('header_banner.png'))) {
            $logoPath = 'header_banner.png';
        }
    }
    $bannerSrc = file_exists(public_path($logoPath)) ? public_path($logoPath) : public_path('header_banner.png');
@endphp

<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        color: #333;
    }

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
        margin-bottom: 8px;
    }

    .invoice-meta {
        text-align: center;
        font-size: 12px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .invoice-details {
        margin-top: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    table th, table td {
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
    .total-section {
        margin-top: 20px;
        border-top: 2px solid #333;
        padding-top: 10px;
    }
    .amount-in-words {
        margin-top: 10px;
        font-style: italic;
        color: #666;
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

<div class="header">
    <img src="{{ $bannerSrc }}" alt="Maya Computer Center Banner" class="header-banner">
    <div class="header-subtext">
        <p class="reg-details" style="font-size: 14px;">CIN : U85220DL2023PTC422329</p>
        <p class="reg-details" style="font-size: 12px;">Reg. Under the Company Act.2013 MCA, Government of India</p>
        <p class="reg-details" style="font-size: 11px;">Registered Under NCT Delhi, Skill India, Udyam & Startup India</p>
        <p class="iso-text" style="font-size: 15px;">An ISO 9001: 2015 Certified</p>
        <p class="reg-details" style="font-size: 11px; margin-top: 2px;">Visit Our Website : https://mayacomputercenter.in</p>
    </div>
</div>

<div class="invoice-title-bar">
    <h1 style="margin: 0; font-size: 18px; letter-spacing: 1px;">Wallet Invoice</h1>
</div>
<p class="invoice-meta">
    Invoice No: {{ $invoice_no }} | Date: {{ $invoice_date }}
</p>

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
                <strong>To:</strong><br>
                {{ $recharge->center->cl_center_name ?? 'N/A' }}<br>
                @if(!empty($recharge->center->cl_center_address))
                    {!! nl2br(e($recharge->center->cl_center_address)) !!}
                @endif<br>
                <strong>Center Code:</strong> {{ $recharge->center->cl_code ?? 'N/A' }}<br>
                <strong>Email:</strong> {{ $recharge->center->cl_email ?? 'N/A' }}<br>
                <strong>Mobile:</strong> {{ $recharge->center->cl_mobile ?? 'N/A' }}
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th class="text-right">Amount (Rs.)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Wallet Recharge - Payment ID: {{ $recharge->cr_razorpay_id ?? $recharge->cr_payment_id }}</td>
                <td class="text-right">Rs. {{ number_format($recharge->cr_amount, 2) }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right">Total Amount:</th>
                <th class="text-right">Rs. {{ number_format($recharge->cr_amount, 2) }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="total-section">
        <p><strong>Payment Method:</strong> {{ $recharge->cr_razorpay_id ? 'Razorpay' : 'Online Payment' }}</p>
        <p><strong>Transaction ID:</strong> {{ $recharge->cr_razorpay_id ?? $recharge->cr_payment_id }}</p>
    </div>

    <div class="footer">
        <p>This is a computer generated invoice and does not require a signature.</p>
        <p>{{ $siteName }} | {{ $siteEmail }} | {{ $sitePhone }}</p>
    </div>
</div>

