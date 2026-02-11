@php
    $siteSettings = site_settings();
    $setting = $siteSettings;
    $siteLogo = $siteSettings && !empty($siteSettings->site_logo) ? asset($siteSettings->site_logo) : asset('logo.png');
    $siteName = $siteSettings && !empty($siteSettings->name) ? $siteSettings->name : 'MAYA COMPUTER CENTER';
    $siteEmail = $siteSettings && !empty($siteSettings->email) ? $siteSettings->email : 'mccsiswar@gmail.com';
    $sitePhone = $siteSettings && !empty($siteSettings->phone) ? $siteSettings->phone : '+91 8825148127';
    $siteAddress = $siteSettings && !empty($siteSettings->address) ? $siteSettings->address : '';
@endphp

<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        color: #333;
    }
    /* Header – centered */
    .header {
        position: relative;
        margin-bottom: 10px;
        width: 100%;
        text-align: center;
    }
    .header-banner {
        width: 75%;
        max-width: 400px;
        height: auto;
        max-height: 85px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        object-fit: contain;
        object-position: center top;
    }
    .header-subtext {
        text-align: center;
        margin-top: -12px;
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
    .qr-block {
        position: absolute;
        right: 0;
        top: 8px;
        text-align: center;
        width: 70px;
    }
    .qr-code {
        width: 70px;
        height: 70px;
        border: 1px solid #ddd;
        background: #fff;
        display: block;
    }
    .qr-sr-no {
        font-weight: bold;
        font-size: 11px;
        font-family: Arial, sans-serif;
        margin-top: 4px;
        line-height: 1.2;
        white-space: nowrap;
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
    .section-title {
        background-color: #000066;
        color: white;
        text-align: center;
        font-weight: bold;
        font-size: 14px;
        padding: 5px;
        text-transform: uppercase;
        font-family: Arial, sans-serif;
        margin-top: 10px;
        border: 1px solid #000066;
    }
</style>

<!-- Header – same structure as marksheet_diploma.blade.php -->
<div class="header">
    @if($setting && !empty($setting->document_logo) && file_exists(public_path($setting->document_logo)))
        <img src="{{ asset($setting->document_logo) }}" alt="Maya Computer Center Banner" class="header-banner">
    @else
        <img src="{{ asset('header_banner.png') }}" alt="Maya Computer Center Banner" class="header-banner">
    @endif
    <div class="header-subtext">
        <p class="reg-details" style="font-size: 16px;">CIN : U85220DL2023PTC422329</p>
        <p class="reg-details" style="font-size: 13px;">Reg. Under the Company Act.2013 MCA, Government of India</p>
        <p class="reg-details" style="font-size: 11px;">Registered Under NCT Delhi, Skill India, Udyam & Startup India</p>
        <p class="iso-text" style="font-size: 15px;">An ISO 9001: 2015 Certified</p>
        <p class="reg-details" style="font-size: 11px; margin-top: 2px;">Visit Our Website : mayacc.in</p>
    </div>
    <!-- <div class="qr-block">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url('invoice/' . ($recharge->cr_id ?? '')) }}"
            alt="QR Code" class="qr-code">
        <div class="qr-sr-no">INV. {{ $invoice_no }}</div>
    </div> -->
</div>

<div class="section-title">INVOICE &nbsp;|&nbsp; {{ $invoice_no }} &nbsp;|&nbsp; Date: {{ $invoice_date }}</div>

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

