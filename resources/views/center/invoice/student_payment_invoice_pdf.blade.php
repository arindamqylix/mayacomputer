@php
    $forPdf = $forPdf ?? false;
    $centerRow = $center ?? null;
    $amount = (float) ($student->total_course_fee ?? $payment->fp_total_amount ?? 0);
    $courseName = $student->course_name ?? 'Course Fee';
    if (!empty($student->c_short_name)) {
        $courseName .= ' (' . $student->c_short_name . ')';
    }
@endphp

@include('partials.invoice_mcc_header', [
    'forPdf' => $forPdf,
    'documentTitle' => 'STUDENT INVOICE',
    'metaLabel' => 'Invoice No',
    'invoice_no' => $invoice_no,
    'invoice_date' => $invoice_date,
])

<div class="invoice-details">
    <table>
        <tr>
            <td style="width: 50%;">
                <strong>From:</strong><br>
                {{ site_settings()->name ?? 'MAYA COMPUTER CENTER' }}<br>
                @if(!empty(site_settings()->address))
                    {!! nl2br(e(site_settings()->address)) !!}<br>
                @endif
                <strong>Email:</strong> {{ site_settings()->email ?? 'mccsiswar@gmail.com' }}<br>
                <strong>Phone:</strong> {{ site_settings()->phone ?? '+91 8825148127' }}
            </td>
            <td style="width: 50%;">
                <strong>Center Details:</strong><br>
                {{ $centerRow->cl_center_name ?? $centerRow->cl_name ?? 'N/A' }}<br>
                @if(!empty($centerRow->cl_center_address))
                    {!! nl2br(e($centerRow->cl_center_address)) !!}<br>
                @endif
                <strong>Center Code:</strong> {{ $centerRow->cl_code ?? 'N/A' }}<br>
                <strong>Email:</strong> {{ $centerRow->cl_email ?? 'N/A' }}<br>
                <strong>Mobile:</strong> {{ $centerRow->cl_mobile ?? 'N/A' }}
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td style="width: 50%;">
                <strong>Student Details:</strong><br>
                {{ $student->sl_name ?? 'N/A' }}<br>
                @if(!empty($student->sl_address))
                    {!! nl2br(e($student->sl_address)) !!}<br>
                @endif
                <strong>Registration No:</strong> {{ $student->sl_reg_no ?? 'N/A' }}<br>
                <strong>Mobile:</strong> {{ $student->sl_mobile_no ?? 'N/A' }}<br>
                @if(!empty($student->sl_email))
                    <strong>Email:</strong> {{ $student->sl_email }}<br>
                @endif
            </td>
            <td style="width: 50%; vertical-align: top;">
                <strong>Payment Summary</strong><br>
                <strong>Receipt No:</strong> {{ $payment->fp_receipt_no ?? 'N/A' }}<br>
                <strong>Payment Date:</strong> {{ $invoice_date }}<br>
                @if(!empty($payment->fp_remarks))
                    <strong>Remarks:</strong> {{ $payment->fp_remarks }}
                @endif
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th class="text-right">Amount (Rs)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    Course fee — {{ $courseName }} for {{ $student->sl_reg_no ?? 'N/A' }}
                    <br>
                    <small>Payment ID: {{ $payment->fp_id }}</small>
                </td>
                <td class="text-right">Rs {{ number_format($amount, 2) }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right">Total Amount:</th>
                <th class="text-right">Rs {{ number_format($amount, 2) }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>This is a computer generated invoice and does not require a signature.</p>
        <p>{{ site_settings()->name ?? 'MAYA COMPUTER CENTER' }} | {{ site_settings()->email ?? '' }} | {{ site_settings()->phone ?? '' }}</p>
    </div>
</div>
