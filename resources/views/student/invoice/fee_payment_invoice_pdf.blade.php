@php
    $forPdf = $forPdf ?? false;
    $centerRow = (object) [
        'cl_center_name' => $student->cl_center_name ?? $student->cl_name ?? null,
        'cl_name' => $student->cl_name ?? null,
        'cl_center_address' => $student->cl_center_address ?? null,
        'cl_code' => $student->cl_code ?? null,
        'cl_email' => $student->cl_email ?? null,
        'cl_mobile' => $student->cl_mobile ?? null,
    ];
    $amount = (float) ($student->total_course_fee ?? $payment->fp_total_amount ?? 0);
    $courseName = $student->course_name ?? 'Course Fee';
    if (!empty($student->c_short_name)) {
        $courseName .= ' (' . $student->c_short_name . ')';
    }
    $footerCenter = $centerRow->cl_center_name ?? $centerRow->cl_name ?? 'MAYA COMPUTER CENTER';
@endphp

@include('partials.invoice_mcc_header', [
    'forPdf' => $forPdf,
    'documentTitle' => 'STUDENT INVOICE',
    'metaLabel' => 'Invoice No',
    'invoice_no' => $invoice_no,
    'invoice_date' => $invoice_date,
])

<div class="invoice-details">
    @include('partials.student_invoice_parties', compact('centerRow', 'student'))

    <table>
        <tr>
            <td style="width: 50%;"></td>
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
        <p>{{ $footerCenter }} | {{ $centerRow->cl_email ?? '' }} | {{ $centerRow->cl_mobile ?? '' }}</p>
    </div>
</div>
