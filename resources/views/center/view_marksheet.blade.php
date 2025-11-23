@extends('student.layouts.master')
@section('title', 'Marksheet')
@push('custom-css')
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">PROVISIONAL MARKS STATEMENT</h4>
                <div class="page-title-right">

                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th colspan='4'>
                            <center>
                                <h3> PROVISIONAL MARKS STATEMENT</h3>
                        </th>
                        <td rowspan='2'>
                            <center> <img src="{{ asset('center/student_doc/') . '/' . $data->sl_photo }}"
                                    lt='Student Photo' Width='100px' height='120px'> </center>
                        </td>
                    </tr>

                    <tr>
                        <td> <label> Course Name : </label> </td>
                        <td width='300'> {{ $data->c_full_name }}
                            ({{ $data->c_short_name }} ) </td>
                        <td> <label> Reg. No. </label> </td>
                        <td colspan='1'> {{ $data->sl_reg_no }} </td>
                    </tr>
                    <tr>

                    <tr>
                        <td> <label> Student Name : </label> </td>
                        <td> {{ $data->sl_name }} </td>
                        <td> <label> Center Code : </label> </td>
                        <td colspan='2'> {{ $data->cl_code }} </td>
                    </tr>

                    <tr>
                        <td> <label> Mother's Name : </label> </td>
                        <td> {{ $data->sl_mother_name }} </td>
                        <td> <label> Center Name : </label> </td>
                        <td colspan='2'> {{ $data->cl_center_name }} </td>
                    </tr>


                    <tr>
                        <td> <label> Father's Name : </label> </td>
                        <td> {{ $data->sl_father_name }} </td>
                        <td> <label> Center Address : </label> </td>
                        <td colspan='2'> {{ $data->cl_center_address }} </td>
                    </tr>
                </table>
                <table class='table text-center'>
                    <tr>
                        <th colspan='5'> </th>
                    </tr>

                    <tr bgcolor='pink'>
                        <!--<th> # </th>-->
                        <th> Exam </th>
                        <th> Full Marks </th>
                        <th> Pass Marks </th>
                        <th> Marks Obtained </th>
                    </tr>
                    <tr>
                        <td align='left'>{{ $data->sr_written }} </td>
                        <td>{{ $data->sr_wr_full_marks }} </td>
                        <td>{{ $data->sr_wr_pass_marks }} </td>
                        <td align='center'>{{ $data->sr_wr_marks_obtained }} </td>
                    </tr>

                    <tr>
                        <td align='left'>{{ $data->sr_practical }} </td>
                        <td>{{ $data->sr_pr_full_marks }} </td>
                        <td>{{ $data->sr_pr_pass_marks }} </td>
                        <td align='center'> {{ $data->sr_pr_marks_obtained }} </td>
                    </tr>

                    <tr>
                        <td align='left'>{{ $data->sr_project }} </td>
                        <td>{{ $data->sr_ap_full_marks }} </td>
                        <td>{{ $data->sr_ap_pass_marks }} </td>
                        <td align='center'> {{ $data->sr_ap_marks_obtained }} </td>
                    </tr>

                    <tr>
                        <td align='left'>{{ $data->sr_viva }} </td>
                        <td>{{ $data->sr_vv_full_marks }} </td>
                        <td>{{ $data->sr_vv_pass_marks }} </td>
                        <td align='center'> {{ $data->sr_vv_marks_obtained }} </td>
                    </tr>


                    <tr>
                        <th> Total </th>
                        <th> {{ $data->sr_total_full_marks }} </th>
                        <th> {{ $data->sr_total_pass_marks }} </th>
                        <th> {{ $data->sr_total_marks_obtained }} </th>
                    </tr>
                    <tr class='bg-info text-white'>
                        <TD COLSPAN='2'> </TD>
                        <td class='but'> Percentage &nbsp; &nbsp; &nbsp; &nbsp; {{ $data->sr_percentage }}% </td>
                        <td> Grade &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
                            {{ $data->sr_grade }} </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan='4' style='text-align:justify'>
                            <b>Notes & Explanation :</b>
                            <p>1. In case of any mistake being detected in the preparation of the Marks Statement at any
                                stage or when it is brought to the notice of the
                                concerned authority, we shall have the right to make necessary corrections. </p>

                            <p>2. This is a Computer generated Provisional Marks Statement and hence does not require
                                Signature. For Verification refer to Original Marks
                                Statement. </p>
                            <p>3. In case of any error in this statement of marks it should be reported within 15 days.</p>
                        </td>


                </table>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection
