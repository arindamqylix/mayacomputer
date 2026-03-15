@extends('student.layouts.base')
@section('title', 'Certificate')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body text-center py-5 px-4">
                    <div class="mb-4">
                        <i class="fas fa-certificate text-muted" style="font-size: 4rem; opacity: 0.6;"></i>
                    </div>
                    <h4 class="mb-3">Certificate not yet available</h4>
                    <p class="text-muted mb-4 mx-auto" style="max-width: 480px;">
                        Your certificate will appear here once your center has generated it. This is usually done after your result is declared and your account is verified.
                    </p>
                    <p class="text-muted small mb-4">
                        If you have already completed your course and result is declared, please contact your center to generate the certificate.
                    </p>
                    <a href="{{ route('student_dashboard') }}" class="btn btn-primary px-4">
                        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
