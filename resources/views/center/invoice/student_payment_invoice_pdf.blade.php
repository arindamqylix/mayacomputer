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
                <h1 class="invoice-title">FEE PAYMENT RECEIPT</h1>
                <div class="company-info">
                    <p style="margin: 2px 0;"><strong>Receipt No:</strong> {{ $invoice_no }}</p>
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
                <strong>Student Details:</strong><br>
                <strong>Name:</strong> {{ $student->sl_name ?? 'N/A' }}<br>
                <strong>Registration No:</strong> {{ $student->sl_reg_no ?? 'N/A' }}<br>
                <strong>Course:</strong> {{ $student->course_name ?? 'N/A' }}<br>
                <strong>Mobile:</strong> {{ $student->sl_mobile_no ?? 'N/A' }}<br>
                <strong>Email:</strong> {{ $student->sl_email ?? 'N/A' }}
            </td>
            <td style="width: 50%;">
                <strong>Center Details:</strong><br>
                <strong>Center Name:</strong> {{ $center->cl_center_name ?? 'N/A' }}<br>
                <strong>Center Code:</strong> {{ $center->cl_code ?? 'N/A' }}<br>
                <strong>Address:</strong> {{ $center->cl_center_address ?? '' }}<br>
                <strong>Email:</strong> {{ $center->cl_email ?? 'N/A' }}<br>
                <strong>Mobile:</strong> {{ $center->cl_mobile ?? 'N/A' }}
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th class="text-right">Total Amount (₹)</th>
                <th class="text-right">Paid Amount (₹)</th>
                <th class="text-right">Due Amount (₹)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Course Fee Payment</td>
                <td class="text-right">₹ {{ number_format($payment->fp_total_amount, 2) }}</td>
                <td class="text-right">₹ {{ number_format($payment->fp_amount, 2) }}</td>
                <td class="text-right">₹ {{ number_format($payment->fp_total_amount - $payment->fp_amount, 2) }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right">Total Paid:</th>
                <th colspan="3" class="text-right">₹ {{ number_format($payment->fp_amount, 2) }}</th>
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

