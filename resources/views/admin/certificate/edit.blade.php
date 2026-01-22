@extends('admin.layouts.base')
@section('title', 'Edit Certificate')

@section('content')
<div class="row mt-3">
    <div class="col-lg-8 offset-lg-2">
        <form action="{{ route('admin.update_certificate', $certificate->sc_id) }}" method="post">
            @csrf
            <div class="card">
                <div class="card-header bg-primary text-white font-weight-bold">
                    Edit Certificate Details
                </div>
                <div class="card-body"> 
                    <div class="alert alert-info">
                        <strong>Student:</strong> {{ $certificate->sl_name }} ({{ $certificate->sl_reg_no }}) <br>
                        <strong>Course:</strong> {{ $certificate->c_full_name }} <br>
                        <strong>Center:</strong> {{ $certificate->cl_center_name }}
                    </div>

                    <div class="form-group mb-3">
                        <label>Certificate Number</label>
                        <input type="text" name="certificate_number" value="{{ $certificate->sc_certificate_number }}" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Issue Date</label>
                        <input type="date" name="issue_date" value="{{ $certificate->sc_issue_date }}" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="GENERATED" {{ $certificate->sc_status == 'GENERATED' ? 'selected' : '' }}>GENERATED</option>
                            <option value="ISSUED" {{ $certificate->sc_status == 'ISSUED' ? 'selected' : '' }}>ISSUED</option>
                        </select>
                    </div>

                </div>

                <div class="card-footer bg-light text-right">
                    <a href="{{ route('admin.certificate_list') }}" class="btn btn-secondary btn-sm">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-sm">Update Certificate</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
