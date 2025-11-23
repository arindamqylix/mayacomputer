@extends('center.layouts.master')
@section('title', 'Change Password')
@push('custom-css')
    <style type="text/css">
        .form-section-heading {
            background: linear-gradient(to right, #4e73df, #825ee4);
            padding: 12px;
            height: 44px;
        }

        .form-section-heading h5 {
            color: #fff;
        }

        .card-body input {
            border-radius: 15px;
            padding: 8px;
        }
    </style>
@endpush
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Change Password</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row justify-content-center">
        <div class="col-lg-6">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Change Password</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('change_password_save') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <div class="input-group auth-pass-inputgroup">
                                <input type="password" class="form-control" placeholder="Enter new password"
                                    aria-label="Password" aria-describedby="password-addon" name="new_password"
                                    minlength="6">
                                <button class="btn btn-light " type="button" id="password-addon"><i
                                        class="mdi mdi-eye-outline"></i></button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Confirm Password</label>
                            <div class="input-group auth-pass-inputgroup">
                                <input type="password" class="form-control" placeholder="Confirm password"
                                    aria-label="Password" aria-describedby="password-addon" name="confirm_password"
                                    minlength="6">
                                <button class="btn btn-light " type="button" id="password-addon"><i
                                        class="mdi mdi-eye-outline"></i></button>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg">
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('custom-js')
@endpush
