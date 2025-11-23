@extends('student.layouts.base')
@section('title', 'Student Dashboard')

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

body {
    background-color: #f5f7fa;
    font-family: 'Poppins', sans-serif;
}

/* Welcome Banner */
.welcome-banner {
    background: linear-gradient(135deg, #4e54c8, #8f94fb);
    border-radius: 16px;
    padding: 30px;
    color: #fff;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}

/* Profile Card */
.card-profile {
    border-radius: 16px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    padding: 30px 20px;
    text-align: center;
}

.card-profile img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    border: 5px solid #fff;
    box-shadow: 0 3px 12px rgba(0,0,0,0.15);
    margin-bottom: 15px;
}

.card-profile h5 {
    font-weight: 600;
    margin-bottom: 5px;
}

.badge-course {
    font-size: 0.75rem;
    background: #6f42c1;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    display: inline-block;
    margin-top: 5px;
}

/* Info Table */
.info-card {
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    background: #fff;
    padding: 20px;
}

.student-info-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
}

.student-info-table td {
    padding: 12px 15px;
    background: #f9f9fb;
    border-radius: 8px;
}

.table-label {
    font-weight: 600;
    color: #333;
}
</style>
@section('content')
<div class="container-fluid mt-4">
<div class="row mt-4 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm p-4 bg-primary text-white rounded-3">
            <h2 class="fw-bold mb-1">👋 Welcome back, {{ Auth::user()->sl_name ?? 'Admin' }}!</h2>
            <p class="mb-0">Here’s a quick overview of your account at Maya Computer Center.</p>
        </div>
    </div>
</div>
    <div class="row justify-content-center">
        <!-- Profile Card -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card-profile">
                <img src="{{ asset('storage/student/').'/'.$data->sl_photo }}" alt="Student Photo">
                <h5>{{ $data->sl_name }}</h5>
                <p class="text-muted mb-1">{{ $data->sl_reg_no }}</p>
                <span class="badge-course">{{ $data->c_short_name }}</span>
                <p class="small mt-2">{{ $data->c_full_name }}</p>
                <div class="mt-3 text-muted">
                    <i class="fa fa-birthday-cake me-2 text-danger"></i> {{$data->sl_dob}}
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="col-lg-8 col-md-6 mb-4">
            <div class="info-card">
                <h5 class="fw-bold mb-4">📋 Student Information</h5>
                <table class="student-info-table">
                    <tr>
                        <td class="table-label">Mother's Name</td>
                        <td>{{ $data->sl_mother_name }}</td>
                    </tr>
                    <tr>
                        <td class="table-label">Father's Name</td>
                        <td>{{ $data->sl_father_name }}</td>
                    </tr>
                    <tr>
                        <td class="table-label">Course Title</td>
                        <td>{{ $data->c_full_name }} ({{ $data->c_short_name }})</td>
                    </tr>
                    <tr>
                        <td class="table-label">Course Duration</td>
                        <td>{{ $data->c_duration }} Months</td>
                    </tr>
                    <tr>
                        <td class="table-label">Center Code</td>
                        <td>{{ $data->cl_code }}</td>
                    </tr>
                    <tr>
                        <td class="table-label">Center Name</td>
                        <td>{{ $data->cl_center_name }}</td>
                    </tr>
                    <tr>
                        <td class="table-label">Center Address</td>
                        <td>{{ $data->cl_center_address }}</td>
                    </tr>
                    <tr>
                        <td class="table-label">Contact Number</td>
                        <td>8825148127</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-js')
<script>
  document.addEventListener('DOMContentLoaded', function(){
    @if(isset($convId))
      window.livewire.emitTo('chat.conversation-window','openConversation', {{ $convId }});
      // optionally start echo subscription
      if (typeof startConversationEcho === 'function') startConversationEcho({{ $convId }});
    @endif
  });
</script>
@endpush