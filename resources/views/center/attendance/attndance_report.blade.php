@extends('center.layouts.base')
@section('title', 'Mark Attendance')

@push('custom-css')
<style>
    /* small styling to match your card look */
    .filter-row .form-control, .filter-row select { min-height: 38px; }
    .table-main th, .table-main td { vertical-align: middle; }
    .badge-yes { background: #28a745; color: #fff; padding: 5px 8px; border-radius: 4px; }
    .badge-no  { background: #dc3545; color: #fff; padding: 5px 8px; border-radius: 4px; }
    .badge-none { background: #6c757d; color: #fff; padding: 5px 8px; border-radius: 4px; }
    .export-btn { margin-left: 12px; }
    .page-actions { display:flex; gap:10px; align-items:center; }
    @media (max-width: 768px) {
        .page-actions { flex-direction: column; align-items: stretch; }
    }
</style>
@endpush

@section('content')
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">

            {{-- Header --}}
            <div class="card-header d-flex justify-content-between align-items-center bg-secondary text-white font-weight-bold">
                <div>Make Attendance</div>
                <div class="page-actions">
                    <button class="btn btn-primary btn-sm export-btn" onclick="exportVisibleTable()">Export</button>
                </div>
            </div>

            {{-- Body --}}
            <div class="card-body">

                {{-- Filters: batch, month (for report) + date (for marking) --}}
                <form method="GET" class="row filter-row mb-3" id="filterForm">
                    <div class="col-lg-4 mb-2">
                        <label><b>Select Batch</b></label>
                        <select name="batch_id" class="form-control" onchange="document.getElementById('filterForm').submit()">
                            <option value="">-- Select Batch --</option>
                            @foreach($batch as $b)
                                <option value="{{ $b->ab_id }}" {{ (string)($selectedBatchId ?? request('batch_id')) === (string)$b->ab_id ? 'selected' : '' }}>
                                    {{ $b->ab_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-4 mb-2">
                        <label><b>Select Month (Report)</b></label>
                        <select name="month" class="form-control" onchange="document.getElementById('filterForm').submit()">
                            <option value="">Select Month</option>
                            @foreach (range(0, 11) as $i)
                                @php
                                    $monthDate = now()->subMonths($i);
                                    $value = $monthDate->format('Y-m');  // e.g. 2025-02
                                    $label = $monthDate->format('F Y');  // e.g. February 2025
                                @endphp
                                <option value="{{ $value }}" {{ (string)($selectedMonth ?? request('month')) === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-4 mb-2">
                        <label><b>Select Date (Mark Attendance)</b></label>
                        <div class="d-flex gap-2">
                            <input type="date" name="att_date" class="form-control" value="{{ $selectedAttDate ?? request('att_date') }}">
                            <button class="btn btn-primary" type="submit">Filter</button>
                            <a href="{{ route('make_attendance') }}" class="btn btn-danger">Reset</a>
                        </div>
                    </div>
                </form>

                {{-- Mode 1: Mark Attendance (batch_id + att_date) --}}
                @if( ($selectedBatchId ?? request('batch_id')) && ($selectedAttDate ?? request('att_date')) )
                    @php
                        $attDate = \Carbon\Carbon::parse($selectedAttDate ?? request('att_date'));
                    @endphp

                    <h5 class="mb-3">Attendance for <b>{{ $attDate->format('d-M-Y (l)') }}</b></h5>

                    @if(isset($students) && $students->count() > 0)
                        <form action="{{ route('save_attendance') }}" method="POST">
                            @csrf
                            <input type="hidden" name="batch_id" value="{{ $selectedBatchId ?? request('batch_id') }}">
                            <input type="hidden" name="att_date" value="{{ $selectedAttDate ?? request('att_date') }}">

                            <div class="table-responsive">
                                <table id="attendance-mark-table" class="table table-bordered table-sm table-main w-100">
                                    <thead>
                                        <tr>
                                            <th style="width:10%">Roll</th>
                                            <th style="width:65%">Name</th>
                                            <th style="width:25%">Present</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $stu)
                                            <tr>
                                                <td>{{ $stu->sl_reg_no }}</td>
                                                <td>{{ $stu->sl_name }}</td>
                                                <td>
                                                    <input type="hidden" name="student_id[]" value="{{ $stu->sl_id }}">
                                                    <input type="checkbox"
                                                        name="attd[{{ $stu->sl_id }}]"
                                                        value="PRESENT"
                                                        {{ (isset($marked) && isset($marked[$stu->sl_id]) && $marked[$stu->sl_id] === 'PRESENT') ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <button class="btn btn-success mt-2">Save Attendance</button>
                        </form>
                    @else
                        <p class="text-danger">No students found in this batch.</p>
                    @endif

                @endif {{-- end mark attendance mode --}}

                {{-- Mode 2: Attendance Report (batch_id + month) --}}
                @if( ($selectedBatchId ?? request('batch_id')) && ($selectedMonth ?? request('month')) )

                    @php
                        // ensure $dates and $attendanceReport exist; controller should supply them
                        $displayMonth = \Carbon\Carbon::create($year ?? now()->year, $month ?? now()->month, 1)->format('F Y');
                    @endphp

                    <div class="card mt-3">
                        <div class="card-header bg-secondary text-white font-weight-bold">
                            Attendance Report — {{ $displayMonth }}
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
									<table id="datatable-buttons attendance-report-table" class="table table-bordered table-sm table-striped w-100">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="white-space: nowrap; font-size: 13px;">Student Name</th>
                                            @foreach ($dates as $d)
                                                <th style="white-space: nowrap; font-size: 12px;">{{ \Carbon\Carbon::parse($d)->format('d') }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($attendanceReport as $student => $attRow)
                                            <tr>
                                                <td class="text-left" style="white-space: nowrap;">{{ $student }}</td>
                                                @foreach ($dates as $d)
                                                    <td>
                                                        @php $val = $attRow[$d] ?? null; @endphp
                                                        @if($val === 'PRESENT')
                                                            <span class="badge-yes">✔</span>
                                                        @elseif($val === 'ABSENT')
                                                            <span class="badge-no">✘</span>
                                                        @else
                                                            <span class="badge-none">-</span>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @empty
                                            <tr><td colspan="{{ count($dates) + 1 }}">No attendance data available.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                @endif {{-- end report mode --}}

            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script>
/**
 * Export the visible table (whichever is present) to CSV.
 * It uses the first table found in .card-body.
 */
function exportVisibleTable() {
    // prefer the report table, else the mark table
    let table = document.getElementById('attendance-report-table') || document.getElementById('attendance-mark-table');
    if (!table) {
        alert('No table visible to export.');
        return;
    }

    // build CSV
    let csv = [];
    for (let r = 0; r < table.rows.length; r++) {
        let row = [], cols = table.rows[r].querySelectorAll('th, td');
        for (let c = 0; c < cols.length; c++) {
            let text = cols[c].innerText.replace(/\n/g, ' ').trim();
            // if a cell contains checkbox, export checked/unchecked
            let checkbox = cols[c].querySelector('input[type="checkbox"]');
            if (checkbox) {
                text = checkbox.checked ? 'PRESENT' : 'ABSENT';
            }
            // sanitize quotes
            text = text.replace(/"/g, '""');
            row.push('"' + text + '"');
        }
        csv.push(row.join(','));
    }

    let csvContent = csv.join('\n');
    let filename = 'attendance_export_' + (new Date()).toISOString().slice(0,10) + '.csv';

    // download
    let blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    if (navigator.msSaveBlob) { // IE 10+
        navigator.msSaveBlob(blob, filename);
    } else {
        let link = document.createElement("a");
        let url = URL.createObjectURL(blob);
        link.setAttribute("href", url);
        link.setAttribute("download", filename);
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
}
</script>
@endpush
