@extends('admin.layouts.base')
@section('title', 'Dashboard')
@push('custom-css')
<style>
    .stat-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }
    .stat-icon.primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .stat-icon.success { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .stat-icon.warning { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    .stat-icon.info { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
    .stat-icon.danger { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
    .stat-icon.secondary { background: linear-gradient(135deg, #30cfd0 0%, #330867 100%); }
    .chart-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 20px;
    }
</style>
@endpush
@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
    <div class="col-12">
            <div class="card border-0 shadow-sm stat-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body p-4 text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold mb-2">👋 Welcome back, {{ Auth::guard('admin')->user()->al_name ?? 'Admin' }}!</h2>
                            <p class="mb-0 opacity-75">Here's a comprehensive overview of your platform analytics</p>
                        </div>
                        <div class="d-none d-md-block">
                            <i class="fas fa-chart-line" style="font-size: 64px; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Statistics Cards -->
    <div class="row mb-4">
        <div class="col-12 mb-3">
            <h4 class="section-title">
                <i class="fas fa-users text-primary me-2"></i>Student Analytics
            </h4>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('student_list') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2" style="font-size: 12px; letter-spacing: 0.5px;">Total Students</h6>
                                <h2 class="fw-bold mb-0 text-dark">{{ number_format($totalStudents) }}</h2>
                                <small class="text-success">
                                    <i class="fas fa-arrow-up"></i> {{ $recentStudents }} new this month
                                </small>
                            </div>
                            <div class="stat-icon primary">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('student_list', ['status' => 'PENDING']) }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2" style="font-size: 12px; letter-spacing: 0.5px;">Pending</h6>
                                <h2 class="fw-bold mb-0 text-dark">{{ number_format($pendingStudents) }}</h2>
                                <small class="text-warning">
                                    <i class="fas fa-clock"></i> Awaiting verification
                                </small>
                            </div>
                            <div class="stat-icon warning">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('student_list', ['status' => 'VERIFIED']) }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2" style="font-size: 12px; letter-spacing: 0.5px;">Verified</h6>
                                <h2 class="fw-bold mb-0 text-dark">{{ number_format($verifiedStudents) }}</h2>
                                <small class="text-success">
                                    <i class="fas fa-check-circle"></i> Active students
                                </small>
                            </div>
                            <div class="stat-icon success">
                                <i class="fas fa-check-double"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('admin.courier.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2" style="font-size: 12px; letter-spacing: 0.5px;">Dispatched</h6>
                                <h2 class="fw-bold mb-0 text-dark">{{ number_format($dispatchedStudents) }}</h2>
                                <small class="text-info">
                                    <i class="fas fa-truck"></i> Certificates sent
                                </small>
                            </div>
                            <div class="stat-icon info">
                                <i class="fas fa-paper-plane"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Center Statistics Cards -->
    <div class="row mb-4">
        <div class="col-12 mb-3">
            <h4 class="section-title">
                <i class="fas fa-building text-info me-2"></i>Center Analytics
            </h4>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('center_list') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2" style="font-size: 12px; letter-spacing: 0.5px;">Total Centers</h6>
                                <h2 class="fw-bold mb-0 text-dark">{{ number_format($totalCenters) }}</h2>
                                <small class="text-primary">
                                    <i class="fas fa-building"></i> All registered
                                </small>
                            </div>
                            <div class="stat-icon secondary">
                                <i class="fas fa-building"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('center_list') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2" style="font-size: 12px; letter-spacing: 0.5px;">Active Centers</h6>
                                <h2 class="fw-bold mb-0 text-dark">{{ number_format($activeCenters) }}</h2>
                                <small class="text-success">
                                    <i class="fas fa-check-circle"></i> Currently active
                                </small>
                            </div>
                            <div class="stat-icon success">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('course_list') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2" style="font-size: 12px; letter-spacing: 0.5px;">Total Courses</h6>
                                <h2 class="fw-bold mb-0 text-dark">{{ number_format($totalCourses) }}</h2>
                                <small class="text-info">
                                    <i class="fas fa-book"></i> Available courses
                                </small>
                            </div>
                            <div class="stat-icon info">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('center_transaction_payment') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2" style="font-size: 12px; letter-spacing: 0.5px;">Total Wallet Balance</h6>
                                <h2 class="fw-bold mb-0 text-dark">₹{{ number_format($totalWalletBalance, 2) }}</h2>
                                <small class="text-success">
                                    <i class="fas fa-wallet"></i> Center wallets
                                </small>
                            </div>
                            <div class="stat-icon danger">
                                <i class="fas fa-rupee-sign"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <!-- Student Registration Chart -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm chart-card">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-chart-line text-primary me-2"></i>Student Registrations (Last 6 Months)
                    </h5>
                        </div>
                <div class="card-body p-4">
                    <div id="studentChart" style="height: 350px;"></div>
                        </div>
                    </div>
                        </div>

        <!-- Students by Status Chart -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm chart-card">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-pie-chart text-success me-2"></i>Students by Status
                    </h5>
                    </div>
                <div class="card-body p-4">
                    <div id="statusChart" style="height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Center Charts Row -->
    <div class="row mb-4">
        <!-- Center Registration Chart -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm chart-card">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-chart-area text-info me-2"></i>Center Registrations (Last 6 Months)
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div id="centerChart" style="height: 350px;"></div>
                </div>
            </div>
</div>

        <!-- Top Centers Chart -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm chart-card">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-trophy text-warning me-2"></i>Top 5 Centers by Students
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div id="topCentersChart" style="height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Statistics Row -->
    <div class="row mb-4">
        <div class="col-lg-12 mb-4">
            <div class="card border-0 shadow-sm chart-card">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-book text-primary me-2"></i>Top 5 Courses by Enrollment
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div id="coursesChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script src="/vendor/apexcharts/apexcharts.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Student Monthly Chart
    var studentMonthlyOptions = {
        series: [{
            name: 'Students Registered',
            data: [
                @foreach($studentMonthlyData as $data)
                {{ $data->count }},
                @endforeach
            ]
        }],
        chart: {
            type: 'area',
            height: 350,
            toolbar: { show: true },
            zoom: { enabled: true }
        },
        dataLabels: { enabled: true },
        stroke: { curve: 'smooth', width: 2 },
        colors: ['#667eea'],
        xaxis: {
            categories: [
                @foreach($studentMonthlyData as $data)
                '{{ date("M Y", mktime(0, 0, 0, $data->month, 1, $data->year)) }}',
                @endforeach
            ]
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.3,
                stops: [0, 90, 100]
            }
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " students"
                }
            }
        }
    };
    var studentChart = new ApexCharts(document.querySelector("#studentChart"), studentMonthlyOptions);
    studentChart.render();

    // Students by Status Pie Chart
    var statusChartOptions = {
        series: [
            @foreach($studentsByStatus as $status)
            @if($status->count > 0){{ $status->count }},@endif
            @endforeach
        ],
        chart: {
            type: 'donut',
            height: 350
        },
        labels: [
            @foreach($studentsByStatus as $status)
            @if($status->count > 0)'{{ $statusLabels[$status->sl_status] ?? $status->sl_status }}',@endif
            @endforeach
        ],
        colors: ['#667eea', '#f093fb', '#4facfe', '#43e97b', '#fa709a', '#30cfd0'],
        legend: { position: 'bottom' },
        dataLabels: { enabled: true }
    };
    var statusChart = new ApexCharts(document.querySelector("#statusChart"), statusChartOptions);
    statusChart.render();

    // Center Monthly Chart
    var centerMonthlyOptions = {
        series: [{
            name: 'Centers Registered',
            data: [
                @foreach($centerMonthlyData as $data)
                {{ $data->count }},
                @endforeach
            ]
        }],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: { show: true }
        },
        colors: ['#4facfe'],
        xaxis: {
            categories: [
                @foreach($centerMonthlyData as $data)
                '{{ date("M Y", mktime(0, 0, 0, $data->month, 1, $data->year)) }}',
                @endforeach
            ]
        },
        dataLabels: { enabled: true },
        plotOptions: {
            bar: {
                borderRadius: 8,
                horizontal: false
            }
        }
    };
    var centerChart = new ApexCharts(document.querySelector("#centerChart"), centerMonthlyOptions);
    centerChart.render();

    // Top Centers Chart
    var topCentersOptions = {
        series: [{
            name: 'Students',
            data: [
                @foreach($topCentersByStudents as $center)
                {{ $center->student_count }},
                @endforeach
            ]
        }],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: { show: false }
        },
        colors: ['#43e97b'],
        plotOptions: {
            bar: {
                borderRadius: 8,
                horizontal: true
            }
        },
        dataLabels: { enabled: true },
        xaxis: {
            categories: [
                @foreach($topCentersByStudents as $center)
                '{{ \Illuminate\Support\Str::limit($center->cl_center_name, 20) }}',
                @endforeach
            ]
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " students"
                }
            }
        }
    };
    var topCentersChart = new ApexCharts(document.querySelector("#topCentersChart"), topCentersOptions);
    topCentersChart.render();

    // Top Courses Chart
    var coursesOptions = {
        series: [{
            name: 'Enrollments',
            data: [
                @foreach($studentsByCourse as $course)
                {{ $course->student_count }},
                @endforeach
            ]
        }],
        chart: {
            type: 'bar',
            height: 300,
            toolbar: { show: false }
        },
        colors: ['#fa709a'],
        plotOptions: {
            bar: {
                borderRadius: 8,
                horizontal: true
            }
        },
        dataLabels: { enabled: true },
        xaxis: {
            categories: [
                @foreach($studentsByCourse as $course)
                '{{ \Illuminate\Support\Str::limit($course->c_full_name, 25) }}',
                @endforeach
            ]
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " students"
                }
            }
        }
    };
    var coursesChart = new ApexCharts(document.querySelector("#coursesChart"), coursesOptions);
    coursesChart.render();
});
</script>
@endpush
