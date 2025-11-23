@extends('center.layouts.base')
@section('title', 'Generate Admit Student')
@push('custom-css')
<style type="text/css">
		
</style>
@endpush
@section('content')
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-secondary text-white font-weight-bold">
                Admit Card Issue
            </div>

            <div class="card-body">

                <form method="POST" id="insert_frm">
                    @csrf

                    <div class="row">
                        <!-- LEFT SIDE -->
                        <div class="col-md-6">

                            <div class="form-group mb-3">
                                <label>Select Registration No</label>
                                <select name="reg_no" class="form-select" required>
                                    <option value="">Select</option>
                                    @foreach($students as $val)
                                        <option value="{{ $val->sl_id }}">
                                            [{{ $val->sl_reg_no }}] {{ $val->sl_name }} - {{ $val->c_full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label>Exam Date</label>
                                <input class="form-control" name="exam_date" type="date" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Exam Time</label>
                                <input class="form-control" name="exam_time" type="time" required>
                            </div>

                        </div>

                        <!-- RIGHT SIDE -->
                        <div class="col-md-6">

                            <div class="form-group mb-3">
                                <label>Exam Venue</label>
                                <input type="text" class="form-control" name="exam_venue" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Notice</label>
                                <input type="text" class="form-control" name="exam_notice">
                            </div>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-danger btn-block mt-2" id="insert_btn">
                        Create Admit Card
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>


@endsection
@push('custom-js')
@endpush