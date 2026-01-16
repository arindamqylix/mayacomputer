@extends('center.layouts.base')
@section('title', 'Dashboard')
@push('custom-css')
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

body {
    background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
    font-family: 'Poppins', sans-serif;
}

/* Welcome Banner - Matching Logo Blue */
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

/* Stats Cards */
.stats-section {
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
}

.stat-card.student-card::before {
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
}

.stat-card.pending-card::before {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
}

.stat-card.verified-card::before {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.stat-card.dispatched-card::before {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
    color: white;
    font-size: 1.5rem;
}

.stat-card.student-card .icon-wrapper {
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
}

.stat-card.pending-card .icon-wrapper {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
}

.stat-card.verified-card .icon-wrapper {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.stat-card.dispatched-card .icon-wrapper {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

/* Profile Card */
.profile-card {
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    background: #fff;
    padding: 2rem;
    border: none;
    position: relative;
    overflow: hidden;
}

.profile-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
}

.profile-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0f0f0;
}

.profile-card-header h5 {
    font-weight: 700;
    color: #1e3a8a;
    font-size: 1.5rem;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-edit-profile {
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
    border: none;
    padding: 0.5rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 600;
    box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
    transition: all 0.3s ease;
    color: white;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-edit-profile:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(37, 99, 235, 0.4);
    color: white;
    text-decoration: none;
}

.profile-info-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 12px;
}

.profile-info-table tr {
    transition: all 0.3s ease;
}

.profile-info-table tr:hover {
    transform: translateX(5px);
}

.profile-info-table th {
    font-weight: 600;
    color: #1e3a8a;
    width: 30%;
    font-size: 0.9rem;
    padding: 12px 18px;
    background: #f8f9ff;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

.profile-info-table td {
    color: #495057;
    font-weight: 500;
    padding: 12px 18px;
    background: #ffffff;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

.profile-image-wrapper {
    text-align: center;
    padding: 1rem;
}

.profile-image-wrapper img {
    width: 150px;
    height: 180px;
    object-fit: cover;
    border-radius: 12px;
    border: 4px solid #fff;
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
    transition: all 0.3s ease;
}

.profile-image-wrapper img:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 30px rgba(37, 99, 235, 0.4);
}

/* Chart Card */
.chart-card {
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    background: #fff;
    padding: 2rem;
    border: none;
    position: relative;
    overflow: hidden;
}

.chart-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
}

.chart-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0f0f0;
}

.chart-card-header h5 {
    font-weight: 700;
    color: #1e3a8a;
    font-size: 1.25rem;
    margin: 0;
}

.chart-stats {
    text-align: right;
}

.chart-stats h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #1e3a8a;
    margin: 0;
}

.chart-stats .growth {
    color: #11998e;
    font-weight: 600;
    font-size: 0.875rem;
}

.chart-legend {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.chart-legend-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: #6c757d;
}

.chart-legend-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.chart-legend-dot.july {
    background: #1e3a8a;
}

.chart-legend-dot.august {
    background: #2563eb;
}

/* Responsive */
@media (max-width: 768px) {
    .welcome-banner {
        padding: 1.5rem;
    }
    
    .welcome-banner h2 {
        font-size: 1.5rem;
    }
    
    .stats-section {
        grid-template-columns: 1fr;
    }
    
    .profile-card, .chart-card {
        padding: 1.5rem;
    }
}
</style>
@endpush

@section('content')
<div class="container-fluid mt-4">
    <!-- Welcome Banner -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-banner">
                <div class="welcome-content">
                    <h2>👋 Welcome back, {{ Auth::guard('center')->user()->cl_director_name ?? 'Center Admin' }}!</h2>
                    <p>Here's a quick overview of your center at Maya Computer Center.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="stats-section">
                <a href="{{ route('all_student') }}" style="text-decoration:none; color:inherit;">
                    <div class="stat-card student-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3>{{ $all_student ?? 0 }}</h3>
                        <p>Total Students</p>
                    </div>
                </a>

                <a href="{{ route('pending_student') }}" style="text-decoration:none; color:inherit;">
                    <div class="stat-card pending-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>{{ $pending_student ?? 0 }}</h3>
                        <p>Pending Students</p>
                    </div>
                </a>

                <a href="{{ route('verified_student') }}" style="text-decoration:none; color:inherit;">
                    <div class="stat-card verified-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>{{ $verify_student ?? 0 }}</h3>
                        <p>Verified Students</p>
                    </div>
                </a>
                
                <a href="{{ route('dispatched_student') }}" style="text-decoration:none; color:inherit;">
                    <div class="stat-card dispatched-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h3>{{ $dispatched_student ?? 0 }}</h3>
                        <p>Dispatched Students</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Institution Profile -->
        <div class="col-lg-8 mb-4">
            <div class="profile-card">
                <div class="profile-card-header">
                    <h5>
                        <i class="fas fa-building"></i>
                        Institution Profile
                    </h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('center.view_id_card') }}" class="btn-edit-profile" target="_blank" style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: #000077; border: none;">
                            <i class="fas fa-id-card"></i>
                            View ID Card
                        </a>
                        <a href="{{ route('center.view_certificate') }}" class="btn-edit-profile" target="_blank" style="background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%); color: #ffffff; border: none;">
                            <i class="fas fa-certificate"></i>
                            View Certificate
                        </a>
                        <a href="{{ route('profile_update') }}" class="btn-edit-profile">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <table class="profile-info-table">
                            <tr>
                                <th><i class="fas fa-hashtag me-2"></i>Center Code</th>
                                <td><strong>{{ $data->cl_code ?? 'N/A' }}</strong></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-building me-2"></i>Center Name</th>
                                <td>{{ $data->cl_center_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-user-tie me-2"></i>Director's Name</th>
                                <td>{{ $data->cl_director_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-map-marker-alt me-2"></i>Address</th>
                                <td>{{ $data->cl_center_address ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-envelope me-2"></i>Email ID</th>
                                <td>
                                    <a href="mailto:{{ $data->cl_email ?? '#' }}" class="text-decoration-none">
                                        {{ $data->cl_email ?? 'N/A' }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-phone me-2"></i>Mobile</th>
                                <td>
                                    <a href="tel:{{ $data->cl_mobile ?? '#' }}" class="text-decoration-none">
                                        {{ $data->cl_mobile ?? 'N/A' }}
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <div class="profile-image-wrapper">
                            @if(!empty($data->cl_photo))
                                <img src="{{ asset($data->cl_photo) }}" 
                                     alt="Center Photo" 
                                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%27150%27 height=%27180%27%3E%3Crect fill=%27%23ddd%27 width=%27150%27 height=%27180%27/%3E%3Ctext fill=%27%23999%27 font-family=%27sans-serif%27 font-size=%2716%27 x=%2750%25%27 y=%2750%25%27 text-anchor=%27middle%27 dy=%27.3em%27%3ENo Photo%3C/text%3E%3C/svg%3E'">
                            @else
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='150' height='180'%3E%3Crect fill='%23ddd' width='150' height='180'/%3E%3Ctext fill='%23999' font-family='sans-serif' font-size='16' x='50%25' y='50%25' text-anchor='middle' dy='.3em'%3ENo Photo%3C/text%3E%3C/svg%3E" alt="No Photo">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Report Chart -->
        <div class="col-lg-4 mb-4">
            <div class="chart-card">
                <div class="chart-card-header">
                    <h5>
                        <i class="fas fa-chart-bar"></i>
                        Student Report
                    </h5>
                    <div class="chart-stats">
                        <h2>{{ $all_student ?? 0 }}</h2>
                        <div class="growth">
                            <i class="fas fa-arrow-up"></i> 18.2%
                        </div>
                    </div>
                </div>
                <div class="chart-legend">
                    <div class="chart-legend-item">
                        <span class="chart-legend-dot july"></span>
                        <span>July</span>
                    </div>
                    <div class="chart-legend-item">
                        <span class="chart-legend-dot august"></span>
                        <span>August</span>
                    </div>
                </div>
                <div class="mt-3" style="height: 200px;">
                    <canvas id="studentChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        // Student Report Chart
        const ctx = document.getElementById('studentChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    datasets: [
                        {
                            label: 'July',
                            data: [12, 19, 15, 25, 22, 18],
                            backgroundColor: '#1e3a8a',
                            borderRadius: 8
                        },
                        {
                            label: 'August',
                            data: [15, 22, 18, 30, 25, 20],
                            backgroundColor: '#2563eb',
                            borderRadius: 8
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f0f0f0'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
