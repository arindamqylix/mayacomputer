@php
    $siteSettings = site_settings();
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
    .invoice-header {
        border-bottom: 2px solid #333;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }
    .invoice-title {
        font-size: 28px;
        font-weight: bold;
        color: #2c3e50;
        margin: 0;
    }
    .company-info {
        margin-top: 10px;
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
    .footer {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #ddd;
        text-align: center;
        font-size: 10px;
        color: #666;
    }
</style>

<!-- New Header Structure -->
@php
    $siteSettings = site_settings();
    $logoPath = null;
    if($siteSettings) {
         if(!empty($siteSettings->document_logo) && file_exists(public_path($siteSettings->document_logo))){
             $logoPath = $siteSettings->document_logo;
         } elseif(!empty($siteSettings->site_logo) && file_exists(public_path($siteSettings->site_logo))){
             $logoPath = $siteSettings->site_logo;
         } else {
             $logoPath = 'header_banner.png';
         }
    } else {
         $logoPath = 'header_banner.png';
    }
@endphp

<div class="header-container" style="text-align: center; margin-bottom: 10px; border-bottom: 2px solid #000077; padding-bottom: 5px;">
    <img src="{{ asset($logoPath) }}" alt="Banner" style="width: 100%; max-height: 80px; object-fit: contain;">
    
    <div style="text-align: center; margin-top: -10px;">
        <p style="font-size: 8px; font-weight: bold; margin: 2px 0; color: #000; font-family: Arial, sans-serif;">Reg. Under the Company Act.2013 MCA, Government of India</p>
        <p style="font-size: 8px; font-weight: bold; margin: 2px 0; color: #000; font-family: Arial, sans-serif;">Registered Under Skill India, Udyam & Startup India</p>
        <p style="color: red; font-weight: bold; font-size: 8px; margin: 2px 0; font-family: Arial, sans-serif;">An ISO 9001: 2015 Certified</p>
    </div>
</div>

<div class="invoice-title-bar" style="text-align: center; background: #000077; color: white; padding: 5px; margin-bottom: 20px;">
    <h1 style="margin: 0; font-size: 18px; text-transform: uppercase; letter-spacing: 1px;">INVOICE</h1>
    <p style="margin: 2px 0 0 0; font-size: 12px; color: #fff;">
        Invoice No: {{ $invoice_no }} | Date: {{ $invoice_date }}
    </p>
</div>

<div class="invoice-details">
    <table>
        <tr>
            <td style="width: 50%;">
                <strong>From:</strong><br>
                {{ $center->cl_center_name ?? 'N/A' }}<br>
                @if(!empty($center->cl_center_address))
                    {!! nl2br(e($center->cl_center_address)) !!}
                @endif<br>
                <strong>Center Code:</strong> {{ $center->cl_code ?? 'N/A' }}<br>
                <strong>Email:</strong> {{ $center->cl_email ?? 'N/A' }}<br>
                <strong>Mobile:</strong> {{ $center->cl_mobile ?? 'N/A' }}
            </td>
            <td style="width: 50%;">
                <strong>To:</strong><br>
                {{ $student->sl_name ?? 'N/A' }}<br>
                @if(!empty($student->sl_address))
                    {!! nl2br(e($student->sl_address)) !!}
                @endif<br>
                <strong>Registration No:</strong> {{ $student->sl_reg_no ?? 'N/A' }}<br>
                <strong>Mobile:</strong> {{ $student->sl_mobile_no ?? 'N/A' }}<br>
                <strong>Email:</strong> {{ $student->sl_email ?? 'N/A' }}
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Item Name</th>
                <th class="text-right">Quantity</th>
                <th class="text-right">Amount (₹)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>
                    @php
                        $courseName = $student->course_name ?? 'Course Fee';
                        $courseShort = $student->c_short_name ?? '';
                        if ($courseShort) {
                            $courseName .= ' (' . $courseShort . ')';
                        }
                    @endphp
                    {{ $courseName }}
                </td>
                <td class="text-right">1</td>
                <td class="text-right">₹ {{ number_format($student->total_course_fee ?? $payment->fp_total_amount ?? 0, 2) }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">Total Amount:</th>
                <th class="text-right">₹ {{ number_format($student->total_course_fee ?? $payment->fp_total_amount ?? 0, 2) }}</th>
            </tr>
        </tfoot>
    </table>

    @if($payment->fp_remarks)
    <div class="total-section">
        <p><strong>Remarks:</strong> {{ $payment->fp_remarks }}</p>
    </div>
    @endif

    <div class="footer">
        <p>This is a computer generated receipt and does not require a signature.</p>
        <p>{{ $siteName }} | {{ $siteEmail }} | {{ $sitePhone }}</p>
    </div>
</div>

