@extends('student.layouts.base')
@section('title', 'Student Dashboard')
<style>

body {
    background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
    font-family: 'Poppins', sans-serif;
    min-height: 100vh;
}

/* Welcome Banner - Enhanced */
.welcome-banner {
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
    border-radius: 20px;
    padding: 2.5rem;
    color: #fff;
    box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}

.welcome-banner::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.welcome-banner::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -5%;
    width: 200px;
    height: 200px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
}

.welcome-content {
    position: relative;
    z-index: 1;
}

.welcome-banner h2 {
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-size: 2rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.welcome-banner p {
    margin: 0;
    opacity: 0.95;
    font-size: 1.1rem;
    font-weight: 400;
}

/* Quick Stats Cards */
.quick-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: #fff;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border: none;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.stat-card .icon-wrapper {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
    color: white;
    font-size: 1.5rem;
}

.stat-card h3 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1e3a8a;
    margin: 0 0 0.5rem 0;
}

.stat-card p {
    margin: 0;
    color: #6c757d;
    font-size: 0.875rem;
    font-weight: 500;
}

/* Profile Card - Enhanced */
.card-profile {
    border-radius: 20px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    border: none;
    position: relative;
}

.card-profile::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
}

.card-profile:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 35px rgba(37, 99, 235, 0.2);
}

.profile-image-wrapper {
    position: relative;
    display: inline-block;
    margin-bottom: 1.5rem;
}

.card-profile img {
    width: 140px;
    height: 140px;
    object-fit: cover;
    border-radius: 50%;
    border: 5px solid #fff;
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
    transition: all 0.3s ease;
}

.card-profile:hover img {
    transform: scale(1.08);
    box-shadow: 0 10px 30px rgba(37, 99, 235, 0.4);
}

.status-indicator {
    position: absolute;
    bottom: 10px;
    right: 10px;
    width: 20px;
    height: 20px;
    background: #10b981;
    border: 3px solid #fff;
    border-radius: 50%;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

.card-profile h5 {
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: #1e3a8a;
    font-size: 1.5rem;
}

.reg-number-badge {
    background: #f8f9ff;
    color: #2563eb;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
    display: inline-block;
    margin: 0.5rem 0;
    font-family: 'Courier New', monospace;
}

.badge-course {
    font-size: 0.875rem;
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    display: inline-block;
    margin-top: 0.5rem;
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}

/* Info Card - Enhanced */
.info-card {
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    background: #fff;
    padding: 2rem;
    border: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.info-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
}

.info-card:hover {
    box-shadow: 0 12px 35px rgba(0,0,0,0.12);
}

.info-card h5 {
    font-weight: 700;
    margin-bottom: 1.5rem;
    color: #1e3a8a;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.student-info-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 12px;
}

.student-info-table tr {
    transition: all 0.3s ease;
}

.student-info-table tr:hover {
    transform: translateX(8px);
}

.student-info-table td {
    padding: 16px 20px;
    background: #f8f9ff;
    border-radius: 12px;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.student-info-table tr:hover td {
    background: #f0f4ff;
    border-color: #2563eb;
}

.table-label {
    font-weight: 600;
    color: #1e3a8a;
    width: 40%;
    font-size: 0.95rem;
}

.student-info-table td:last-child {
    color: #495057;
    font-weight: 500;
    background: #ffffff;
}

/* Quick Actions */
.quick-actions {
    margin-top: 2rem;
}

.quick-actions h5 {
    font-weight: 700;
    color: #1e3a8a;
    margin-bottom: 1.5rem;
    font-size: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
}

.action-btn {
    background: #fff;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 1.5rem 1rem;
    text-align: center;
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.action-btn:hover {
    transform: translateY(-5px);
    border-color: #2563eb;
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.2);
    text-decoration: none;
}

.action-btn .icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    transition: all 0.3s ease;
}

.action-btn:hover .icon {
    transform: scale(1.1) rotate(5deg);
}

.action-btn span {
    color: #495057;
    font-weight: 600;
    font-size: 0.875rem;
    transition: all 0.3s ease;
}

.action-btn:hover span {
    color: #2563eb;
}

/* Status Badge */
.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-block;
}

.status-pending {
    background-color: #fff3cd;
    color: #856404;
}

.status-verified {
    background-color: #d1ecf1;
    color: #0c5460;
}

.status-result-out {
    background-color: #cce5ff;
    color: #004085;
}

/* Responsive */
@media (max-width: 768px) {
    .welcome-banner {
        padding: 1.5rem;
    }
    
    .welcome-banner h2 {
        font-size: 1.5rem;
    }
    
    .quick-stats {
        grid-template-columns: 1fr;
    }
    
    .action-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>

@section('content')
<div class="container-fluid mt-4">
    <!-- Welcome Banner -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-banner">
                <div class="welcome-content">
                    <h2>👋 Welcome back, {{ Auth::user()->sl_name ?? 'Student' }}!</h2>
                    <p>Here's a quick overview of your account at Maya Computer Center.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="quick-stats">
                <div class="stat-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3>{{ $data->c_short_name ?? 'N/A' }}</h3>
                    <p>Course</p>
                </div>
                <div class="stat-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-hashtag"></i>
                    </div>
                    <h3>{{ $data->sl_reg_no ?? 'N/A' }}</h3>
                    <p>Registration No.</p>
                </div>
                <div class="stat-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3>{{ $data->cl_code ?? 'N/A' }}</h3>
                    <p>Center Code</p>
                </div>
                <div class="stat-card">
                    <div class="icon-wrapper">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h3>
                        @php
                            $status = strtolower(str_replace(' ', '-', $data->sl_status ?? 'PENDING'));
                        @endphp
                        <span class="status-badge status-{{ $status }}">
                            {{ $data->sl_status ?? 'PENDING' }}
                        </span>
                    </h3>
                    <p>Account Status</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Profile Card -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card-profile">
                <div class="profile-image-wrapper">
                   
                    <span class="status-indicator"></span>
                </div>
                <h5>{{ $data->sl_name ?? 'N/A' }}</h5>
                <div class="reg-number-badge">
                    <i class="fas fa-id-card me-2"></i>
                    {{ $data->sl_reg_no ?? 'N/A' }}
                </div>
                <div>
                    <span class="badge-course">
                        <i class="fas fa-graduation-cap me-1"></i>
                        {{ $data->c_short_name ?? 'N/A' }}
                    </span>
                </div>
                <p class="small mt-2 text-muted mb-2">{{ $data->c_full_name ?? 'N/A' }}</p>
                <div class="mt-3">
                    <i class="fas fa-birthday-cake me-2 text-danger"></i>
                    <span class="text-muted">
                        @if($data->sl_dob)
                            {{ \Carbon\Carbon::parse($data->sl_dob)->format('d M, Y') }}
                        @else
                            N/A
                        @endif
                    </span>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <h5>
                    <i class="fas fa-bolt"></i>
                    Quick Actions
                </h5>
                <div class="action-grid">
                    <a href="{{ route('view_registration_card') }}" class="action-btn">
                        <div class="icon">
                            <i class="fas fa-address-card"></i>
                        </div>
                        <span>Registration Card</span>
                    </a>
                    <a href="{{ route('view_id_card') }}" class="action-btn">
                        <div class="icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <span>ID Card</span>
                    </a>
                    <a href="{{ route('view_admit_card') }}" class="action-btn">
                        <div class="icon">
                            <i class="fas fa-ticket"></i>
                        </div>
                        <span>Admit Card</span>
                    </a>
                    <a href="{{ route('view_marksheet') }}" class="action-btn">
                        <div class="icon">
                            <i class="fas fa-file-lines"></i>
                        </div>
                        <span>Result</span>
                    </a>
                    <a href="{{ route('student.view_certificate') }}" class="action-btn">
                        <div class="icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <span>Certificate</span>
                    </a>
                    <a href="{{ route('view_payment') }}" class="action-btn">
                        <div class="icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <span>Payments</span>
                    </a>
                    <a href="{{ route('student.chat') }}" class="action-btn">
                        <div class="icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <span>Chat</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="col-lg-8 col-md-6 mb-4">
            <div class="info-card">
                <h5>
                    <i class="fas fa-info-circle"></i>
                    Student Information
                </h5>
                <table class="student-info-table">
                    <tr>
                        <td class="table-label"><i class="fas fa-user me-2"></i>Mother's Name</td>
                        <td>{{ $data->sl_mother_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="table-label"><i class="fas fa-user me-2"></i>Father's Name</td>
                        <td>{{ $data->sl_father_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="table-label"><i class="fas fa-book me-2"></i>Course Title</td>
                        <td>{{ $data->c_full_name ?? 'N/A' }} ({{ $data->c_short_name ?? 'N/A' }})</td>
                    </tr>
                    <tr>
                        <td class="table-label"><i class="fas fa-clock me-2"></i>Course Duration</td>
                        <td>
                            @if($data->c_duration)
                                {{ $data->c_duration }} {{ $data->c_duration == '1' ? 'Month' : 'Months' }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="table-label"><i class="fas fa-hashtag me-2"></i>Center Code</td>
                        <td><strong>{{ $data->cl_code ?? 'N/A' }}</strong></td>
                    </tr>
                    <tr>
                        <td class="table-label"><i class="fas fa-building me-2"></i>Center Name</td>
                        <td>{{ $data->cl_center_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="table-label"><i class="fas fa-map-marker-alt me-2"></i>Center Address</td>
                        <td>{{ $data->cl_center_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="table-label"><i class="fas fa-phone me-2"></i>Contact Number</td>
                        <td>
                            <a href="tel:{{ $data->cl_mobile ?? '8825148127' }}" class="text-decoration-none">
                                <i class="fas fa-phone-alt me-1"></i>
                                {{ $data->cl_mobile ?? '8825148127' }}
                            </a>
                        </td>
                    </tr>
                    @if($data->cl_email)
                    <tr>
                        <td class="table-label"><i class="fas fa-envelope me-2"></i>Email</td>
                        <td>
                            <a href="mailto:{{ $data->cl_email }}" class="text-decoration-none">
                                {{ $data->cl_email }}
                            </a>
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


