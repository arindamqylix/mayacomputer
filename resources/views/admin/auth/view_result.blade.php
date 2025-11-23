@extends('admin.layouts.master')
@section('title', 'Result List')
@push('custom-css')
    <style type="text/css">

    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-secondary text-white font-weight-bold">
                    Result List
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
                            <thead>
                                <tr class="table_main_row">
                                    <th>#ID</th>
                                    <th>Reg.No</th>
                                    <th>Student Name</th>
                                    <th>Percentage</th>
                                    <th>Grade</th>
                                    <th>Centre Name</th>
                                    <th>Centre Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($result as $data)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $data->sl_reg_no ?? '' }}</td>
                                        <td>{{ $data->sl_name ?? '' }}</td>
                                        <td>{{ $data->sr_percentage ?? '' }}%</td>
                                        <td>{{ $data->sr_grade ?? '' }}</td>
                                        <td>{{ $data->center_name ?? '' }}</td>
                                        <td>{{ $data->center_code ?? '' }}</td>
                                        <td>
                                            <a href="{{ route('generatePDF', $data->sr_id) }}" class="btn btn-info btn-sm"
                                                target="__blank" title="View Marksheet"><i class="fa-solid fa-eye"></i></a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-js')
@endpush
