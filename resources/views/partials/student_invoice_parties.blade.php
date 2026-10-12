@php
    if (!isset($centerRow) || $centerRow === null) {
        $centerRow = $center ?? null;
    }
    if (!$centerRow && isset($student)) {
        $centerRow = (object) [
            'cl_center_name' => $student->cl_center_name ?? $student->cl_name ?? null,
            'cl_name' => $student->cl_name ?? null,
            'cl_center_address' => $student->cl_center_address ?? null,
            'cl_code' => $student->cl_code ?? null,
            'cl_email' => $student->cl_email ?? null,
            'cl_mobile' => $student->cl_mobile ?? null,
        ];
    }
    $centerLabel = $centerRow->cl_center_name ?? $centerRow->cl_name ?? 'N/A';
@endphp

<table>
    <tr>
        <td style="width: 50%; vertical-align: top;">
            <strong>From:</strong><br>
            {{ $centerLabel }}<br>
            @if(!empty($centerRow->cl_center_address))
                {!! nl2br(e($centerRow->cl_center_address)) !!}<br>
            @endif
            <strong>Center Code:</strong> {{ $centerRow->cl_code ?? 'N/A' }}<br>
            <strong>Email:</strong> {{ $centerRow->cl_email ?? 'N/A' }}<br>
            <strong>Mobile:</strong> {{ $centerRow->cl_mobile ?? 'N/A' }}
        </td>
        <td style="width: 50%; vertical-align: top;">
            <strong>Bill To:</strong><br>
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
    </tr>
</table>
