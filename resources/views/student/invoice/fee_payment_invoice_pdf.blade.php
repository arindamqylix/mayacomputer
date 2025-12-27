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

<!-- Logo Section - Big Size at Top -->
@if($siteSettings && !empty($siteSettings->site_logo) && file_exists(public_path($siteSettings->site_logo)))
<div style="width: 100%; text-align: center; padding: 20px 0; margin-bottom: 20px; border-bottom: 2px solid #333;">
    <img src="{{ $siteLogo }}" alt="{{ $siteName }} Logo" style="max-width: 100%; max-height: 200px; height: auto; width: auto; object-fit: contain;">
</div>
@endif

<div class="invoice-header">
    <table>
        <tr>
            <td style="width: 30%;">
                @if(file_exists(public_path($siteSettings->site_logo ?? '')))
                    <img src="{{ $siteLogo }}" alt="{{ $siteName }}" style="max-width: 150px; max-height: 80px;">
                @else
                    <h2 style="margin: 0; color: #2c3e50;">{{ $siteName }}</h2>
                @endif
            </td>
            <td style="width: 70%; text-align: right;">
                <h1 class="invoice-title">INVOICE</h1>
                <div class="company-info">
                    <p style="margin: 2px 0;"><strong>Invoice No:</strong> {{ $invoice_no }}</p>
                    <p style="margin: 2px 0;"><strong>Date:</strong> {{ $invoice_date }}</p>
                </div>
            </td>
        </tr>
    </table>
</div>

<div class="invoice-details">
    <table>
        <tr>
            <td style="width: 50%;">
                <strong>From:</strong><br>
                {{ $student->cl_center_name ?? 'N/A' }}<br>
                @if(!empty($student->cl_center_address))
                    {!! nl2br(e($student->cl_center_address)) !!}
                @endif<br>
                <strong>Center Code:</strong> {{ $student->cl_code ?? 'N/A' }}<br>
                <strong>Email:</strong> {{ $student->cl_email ?? 'N/A' }}<br>
                <strong>Mobile:</strong> {{ $student->cl_mobile ?? 'N/A' }}
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

