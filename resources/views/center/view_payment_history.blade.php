@extends('student.layouts.master')
@section('title', 'Payment History')
@push('custom-css')
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 font-size-18">YOUR LAST PAYMENT DETAILS</h4>
                    <div class="page-title-right">
                        <!-- You can add filters or buttons here if needed -->
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    {{-- <th>Receipt Id</th> --}}
                                    <th>Paid Date</th>
                                    <th>Total</th>
                                    <th>Paid Amount</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payment_list as $data)
                                    <tr>
                                        {{-- <td>
                                        <a href="{{ route('print_receipt', $data->fp_FK_of_student_id) }}">{{ $data->fp_receipt_no }}</a>
                                    </td> --}}
                                        <td>{{ $data->fp_date }}</td>
                                        <td>{{ $data->fp_total_amount }}</td>
                                        <td>{{ $data->fp_amount }}</td>
                                        <td>{{ $data->fp_remarks }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->


@endsection
