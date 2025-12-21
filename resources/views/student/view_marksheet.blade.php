@extends('student.layouts.base')
@section('title', 'Marksheet')

<style>
    .marksheet-header {
        background: linear-gradient(90deg, #007bff, #00c6ff);
        color: #fff;
        padding: 15px;
        border-radius: 10px 10px 0 0;
    }
    .marksheet-header h4 {
        margin: 0;
        font-weight: bold;
        letter-spacing: 1px;
    }
    .student-photo {
        border: 2px solid #ddd;
        border-radius: 6px;
        padding: 3px;
        background: #fff;
    }
    .table th {
        background: #f8f9fa;
        font-weight: 600;
    }
    .grade-box {
        font-size: 16px;
        font-weight: 600;
        background: #17a2b8;
        color: #fff;
        padding: 6px 15px;
        border-radius: 6px;
    }
    .note-section {
        font-size: 14px;
        background: #fefefe;
        border-left: 4px solid #007bff;
        padding: 15px;
        margin-top: 15px;
        border-radius: 5px;
    }
</style>

@section('content')
<div class="row mt-3">
    <div class="col-12">
        <div class="marksheet-header d-flex justify-content-between align-items-center">
            <h4>PROVISIONAL MARKS STATEMENT</h4>
        </div>
    </div>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-9">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Course Name:</strong></td>
                        <td>{{ $data->c_full_name ?? '' }} ({{ $data->c_short_name ?? '' }})</td>
                        <td><strong>Reg. No:</strong></td>
                        <td>{{ $data->sl_reg_no ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Student Name:</strong></td>
                        <td>{{ $data->sl_name ?? '' }}</td>
                        <td><strong>Center Code:</strong></td>
                        <td>{{ $data->cl_code ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mother's Name:</strong></td>
                        <td>{{ $data->sl_mother_name ?? '' }}</td>
                        <td><strong>Center Name:</strong></td>
                        <td>{{ $data->cl_center_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Father's Name:</strong></td>
                        <td>{{ $data->sl_father_name ?? '' }}</td>
                        <td><strong>Center Address:</strong></td>
                        <td>{{ $data->cl_center_address ?? '' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-3 text-center">
                @if(!empty($data->sl_photo))
                    <img src="{{ asset('center/student_doc/'.$data->sl_photo) }}" 
                         alt="Student Photo" class="student-photo" width="120" height="140">
                @else
                    <img src="{{ asset('default-avatar.png') }}" 
                         alt="No Photo" class="student-photo" width="120" height="140">
                @endif
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Exam</th>
                        <th>Full Marks</th>
                        <th>Pass Marks</th>
                        <th>Marks Obtained</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $data->sr_written ?? '' }}</td>
                        <td>{{ $data->sr_wr_full_marks ?? '' }}</td>
                        <td>{{ $data->sr_wr_pass_marks ?? '' }}</td>
                        <td>{{ $data->sr_wr_marks_obtained ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>{{ $data->sr_practical ?? '' }}</td>
                        <td>{{ $data->sr_pr_full_marks ?? '' }}</td>
                        <td>{{ $data->sr_pr_pass_marks ?? '' }}</td>
                        <td>{{ $data->sr_pr_marks_obtained ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>{{ $data->sr_project ?? '' }}</td>
                        <td>{{ $data->sr_ap_full_marks ?? '' }}</td>
                        <td>{{ $data->sr_ap_pass_marks ?? '' }}</td>
                        <td>{{ $data->sr_ap_marks_obtained ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>{{ $data->sr_viva ?? '' }}</td>
                        <td>{{ $data->sr_vv_full_marks ?? '' }}</td>
                        <td>{{ $data->sr_vv_pass_marks ?? '' }}</td>
                        <td>{{ $data->sr_vv_marks_obtained ?? '' }}</td>
                    </tr>
                    <tr class="fw-bold table-secondary">
                        <td>Total</td>
                        <td>{{ $data->sr_total_full_marks ?? '' }}</td>
                        <td>{{ $data->sr_total_pass_marks ?? '' }}</td>
                        <td>{{ $data->sr_total_marks_obtained ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="grade-box">
                Percentage: {{ $data->sr_percentage ?? 'N/A' }}%
            </div>
            <div class="grade-box">
                Grade: {{ $data->sr_grade ?? 'N/A' }}
            </div>
        </div>

        <div class="note-section mt-4">
            <b>Notes & Explanation:</b>
            <p>1. In case of any mistake being detected in the preparation of the Marks Statement at any stage or when it is brought to the notice of the concerned authority, we shall have the right to make necessary corrections.</p>   
            <p>2. This is a computer-generated Provisional Marks Statement and hence does not require a signature. For verification, refer to the original Marks Statement.</p>
            <p>3. In case of any error in this statement of marks, it should be reported within 15 days.</p>
        </div>
    </div>
</div>

@endsection
