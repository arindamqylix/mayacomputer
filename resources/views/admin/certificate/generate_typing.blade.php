@extends('admin.layouts.base')
@section('title', 'Generate Typing Certificate')
@push('custom-css')
    <style type="text/css">
        .generate-header {
            background: linear-gradient(135deg, #d00226 0%, #a0011d 100%);
            border: none;
            padding: 1.5rem;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .generate-header h4 {
            color: white;
            margin: 0;
            font-weight: 600;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .modern-card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .modern-table thead th {
            background: linear-gradient(135deg, #d00226 0%, #a0011d 100%);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 1rem;
            border: none;
        }

        .modern-table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
        }

        .btn-generate {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 600;
            font-size: 0.875rem;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-generate:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(245, 158, 11, 0.4);
            color: white;
        }

        .cert-form-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .cert-form-wrapper .form-control-sm {
            max-width: 90px;
            font-size: 0.875rem;
            padding: 0.375rem 0.5rem;
        }

        .speed-hindi-english {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            min-width: 7rem;
        }

        .speed-hindi-english label {
            font-size: 0.7rem;
            margin: 0;
            color: #6b7280;
        }

        .date-input {
            max-width: 140px !important;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="modern-card">
                    <div class="generate-header">
                        <h4>
                            <i class="fas fa-keyboard"></i>
                            Generate Typing Certificate
                        </h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($students->count() > 0)
                            <div class="table-responsive">
                                <table class="table modern-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Reg. No.</th>
                                            <th>Student Name</th>
                                            <th>Course</th>
                                            <th>Center</th>
                                            <th>Hindi / English (WPM)</th>
                                            <th>Accuracy (%)</th>
                                            <th>Issue Date & Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td><strong>{{ $student->sl_reg_no ?? 'N/A' }}</strong></td>
                                                <td>{{ $student->sl_name ?? 'N/A' }}</td>
                                                <td>{{ $student->c_short_name ?? $student->c_full_name ?? 'N/A' }}</td>
                                                <td>
                                                    {{ $student->cl_center_name ?? 'N/A' }}<br>
                                                    <small class="text-muted">({{ $student->cl_code ?? 'N/A' }})</small>
                                                </td>
                                                <form action="{{ route('admin.certificate_store') }}" method="POST"
                                                    class="cert-form-wrapper">
                                                    @csrf
                                                    <input type="hidden" name="type" value="TYPING">
                                                    <input type="hidden" name="student_id" value="{{ $student->sl_id }}">
                                                    <input type="hidden" name="course_id" value="{{ $student->c_id }}">
                                                    <td>
                                                        <div class="speed-hindi-english">
                                                            <label>Hindi
                                                                <input type="number" name="typing_speed_hindi"
                                                                    class="form-control form-control-sm" placeholder="H"
                                                                    required min="1" step="0.1">
                                                            </label>
                                                            <label>English
                                                                <input type="number" name="typing_speed_english"
                                                                    class="form-control form-control-sm" placeholder="E"
                                                                    required min="1" step="0.1">
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="typing_accuracy"
                                                            class="form-control form-control-sm" value="100" required min="1"
                                                            max="100">
                                                    </td>
                                                    <td>
                                                        <div class="cert-form-wrapper">
                                                            @php
                                                                $calculatedDate = date('Y-m-d');
                                                                if (!empty($student->sl_reg_date)) {
                                                                    try {
                                                                        $regDate = \Carbon\Carbon::parse($student->sl_reg_date);
                                                                        $duration = strtolower($student->c_duration ?? '');
                                                                        $num = (int) preg_replace('/[^0-9]/', '', $duration);

                                                                        if ($num > 0) {
                                                                            if (str_contains($duration, 'year') || str_contains($duration, 'Yr')) {
                                                                                $calculatedDate = $regDate->addYears($num)->format('Y-m-d');
                                                                            } elseif (str_contains($duration, 'month') || str_contains($duration, 'mon')) {
                                                                                $calculatedDate = $regDate->addMonths($num)->format('Y-m-d');
                                                                            }
                                                                        }
                                                                    } catch (\Exception $e) {
                                                                        // Fallback to today
                                                                    }
                                                                }
                                                            @endphp
                                                            <input type="date" name="issue_date"
                                                                class="form-control form-control-sm date-input"
                                                                value="{{ $calculatedDate }}" required
                                                                title="Select Certificate Issue Date">
                                                            <button type="submit" class="btn-generate">
                                                                <i class="fas fa-certificate"></i>
                                                                Generate
                                                            </button>
                                                        </div>
                                                    </td>
                                                </form>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                No students enrolled in Typing courses found for certificate generation.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection