<nav id="sidebarMenu" class="sidebar d-lg-block text-white collapse" data-simplebar>
  <div class="sidebar-inner px-2 pt-3">
    <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
      <div class="d-flex align-items-center">
        <div class="avatar-lg me-4">
          <img src="/assets/img/team/profile-picture-3.jpg" class="card-img-top rounded-circle border-white"
            alt="Bonnie Green">
        </div>
        <div class="d-block">
          <h2 class="h5 mb-3">Hi, Jane</h2>
          <a href="/login" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
            <i class="fa-solid fa-right-from-bracket me-1"></i>
            Sign Out
          </a>
        </div>
      </div>
      <div class="collapse-close d-md-none">
        <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
          aria-expanded="true" aria-label="Toggle navigation">
          <i class="fa-solid fa-xmark"></i>
        </a>
      </div>
    </div>
    <ul class="nav flex-column pt-3 pt-md-0">

      <!-- Logo -->
      <li class="nav-item">
        <a href="{{ route('center_dashboard') }}" class="nav-link d-flex align-items-center justify-content-center">
          <span class="sidebar-icon" style="width: 100%; display: flex; justify-content: center; align-items: center;">
            @php
              $siteSettings = site_settings();
              $logoPath = null;
              $siteName = 'MAYA COMPUTER';
              if($siteSettings) {
                $logoPath = !empty($siteSettings->site_logo) ? $siteSettings->site_logo : null;
                $siteName = !empty($siteSettings->name) ? $siteSettings->name : 'MAYA COMPUTER';
              }
              $logoExists = false;
              if($logoPath) {
                $fullPath = public_path($logoPath);
                $logoExists = file_exists($fullPath);
              }
            @endphp
            @if($logoExists)
              <img src="{{ asset($logoPath) }}" alt="{{ $siteName }} Logo" style="max-width: 200px; max-height: 80px; min-height: 60px; width: auto; height: auto; object-fit: contain; display: block;">
            @else
              <span class="sidebar-text" style="display: block; font-size: 1.25rem; font-weight: 700; color: white; text-align: center; padding: 0.5rem;">{{ $siteName }}</span>
            @endif
          </span>
        </a>
      </li>

      <!-- Dashboard -->
      <li class="nav-item {{ Request::segment(1) == 'center' && Request::segment(2) == 'dashboard' ? 'active' : '' }}">
        <a href="{{ route('center_dashboard') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-gauge"></i></span>
          <span class="sidebar-text">Dashboard</span>
        </a>
      </li>

      <!-- Add Student -->
      <li class="nav-item {{ Request::routeIs('add_student') ? 'active' : '' }}">
        <a href="{{ route('add_student') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-user-plus"></i></span>
          <span class="sidebar-text">Add Student</span>
        </a>
      </li>

      <!-- View Student (same as admin structure) -->
      @php
        $viewStudentActive = Request::routeIs('pending_student') || Request::routeIs('verified_student') || Request::routeIs('result_updated_student') || Request::routeIs('result_out_student') || Request::routeIs('dispatched_student') || Request::routeIs('block_student');
      @endphp
      <li class="nav-item">
        <span class="nav-link {{ $viewStudentActive ? '' : 'collapsed' }} d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-student" aria-expanded="{{ $viewStudentActive ? 'true' : 'false' }}">
          <span>
            <span class="sidebar-icon"><i class="fa-solid fa-users"></i></span>
            <span class="sidebar-text">View Student</span>
          </span>
          <span class="link-arrow"><i class="fa-solid fa-chevron-right"></i></span>
        </span>
        <div class="multi-level collapse {{ $viewStudentActive ? 'show' : '' }}" role="list" id="submenu-student" aria-expanded="{{ $viewStudentActive ? 'true' : 'false' }}">
          <ul class="flex-column nav">
            <li class="nav-item"><a href="{{ route('pending_student') }}" class="nav-link"><span class="sidebar-text">Pending</span></a></li>
            <li class="nav-item"><a href="{{ route('verified_student') }}" class="nav-link"><span class="sidebar-text">Verified</span></a></li>
            <li class="nav-item"><a href="{{ route('result_updated_student') }}" class="nav-link"><span class="sidebar-text">Result Updated</span></a></li>
            <li class="nav-item"><a href="{{ route('result_out_student') }}" class="nav-link"><span class="sidebar-text">Result Out</span></a></li>
            <li class="nav-item"><a href="{{ route('dispatched_student') }}" class="nav-link"><span class="sidebar-text">Dispatched</span></a></li>
            <li class="nav-item"><a href="{{ route('block_student') }}" class="nav-link"><span class="sidebar-text">Block</span></a></li>
          </ul>
        </div>
      </li>

      <!-- Student Reg Card (same label as admin) -->
      <li class="nav-item {{ Request::routeIs('student_registration_card_list') ? 'active' : '' }}">
        <a href="{{ route('student_registration_card_list') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-address-card"></i></span>
          <span class="sidebar-text">Student Reg Card</span>
        </a>
      </li>

      <!-- Student ID Card -->
      <li class="nav-item {{ Request::routeIs('student_id_card') ? 'active' : '' }}">
        <a href="{{ route('student_id_card') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-id-card"></i></span>
          <span class="sidebar-text">Student ID Card</span>
        </a>
      </li>

      <!-- Admit Card (collapsible, same as admin) -->
      @php $admitActive = Request::routeIs('generate_admit_card') || Request::routeIs('admit_card_list'); @endphp
      <li class="nav-item">
        <span class="nav-link {{ $admitActive ? '' : 'collapsed' }} d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-admit" aria-expanded="{{ $admitActive ? 'true' : 'false' }}">
          <span>
            <span class="sidebar-icon"><i class="fa-solid fa-ticket"></i></span>
            <span class="sidebar-text">Admit Card</span>
          </span>
          <span class="link-arrow"><i class="fa-solid fa-chevron-right"></i></span>
        </span>
        <div class="multi-level collapse {{ $admitActive ? 'show' : '' }}" role="list" id="submenu-admit" aria-expanded="{{ $admitActive ? 'true' : 'false' }}">
          <ul class="flex-column nav">
            <li class="nav-item"><a href="{{ route('generate_admit_card') }}" class="nav-link"><span class="sidebar-text">Generate Admit Card</span></a></li>
            <li class="nav-item"><a href="{{ route('admit_card_list') }}" class="nav-link"><span class="sidebar-text">View Admit Card</span></a></li>
          </ul>
        </div>
      </li>

      <!-- Result (collapsible, same as admin) -->
      @php $resultActive = Request::routeIs('set_result') || Request::routeIs('student_result_list'); @endphp
      <li class="nav-item">
        <span class="nav-link {{ $resultActive ? '' : 'collapsed' }} d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-result" aria-expanded="{{ $resultActive ? 'true' : 'false' }}">
          <span>
            <span class="sidebar-icon"><i class="fa-solid fa-file-lines"></i></span>
            <span class="sidebar-text">Result</span>
          </span>
          <span class="link-arrow"><i class="fa-solid fa-chevron-right"></i></span>
        </span>
        <div class="multi-level collapse {{ $resultActive ? 'show' : '' }}" role="list" id="submenu-result" aria-expanded="{{ $resultActive ? 'true' : 'false' }}">
          <ul class="flex-column nav">
            <li class="nav-item"><a href="{{ route('set_result') }}" class="nav-link"><span class="sidebar-text">Set Result</span></a></li>
            <li class="nav-item"><a href="{{ route('student_result_list') }}" class="nav-link"><span class="sidebar-text">Result List</span></a></li>
          </ul>
        </div>
      </li>

      <!-- Certificates (collapsible, same as admin: Generate + Typing + List) -->
      @php
        $certificateActive = Request::routeIs('center.certificate_generate') || Request::routeIs('center.typing_certificate_generate') || Request::routeIs('center.certificate_list');
      @endphp
      <li class="nav-item">
        <span class="nav-link {{ $certificateActive ? '' : 'collapsed' }} d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-certificate" aria-expanded="{{ $certificateActive ? 'true' : 'false' }}">
          <span>
            <span class="sidebar-icon"><i class="fa-solid fa-certificate"></i></span>
            <span class="sidebar-text">Certificates</span>
          </span>
          <span class="link-arrow"><i class="fa-solid fa-chevron-right"></i></span>
        </span>
        <div class="multi-level collapse {{ $certificateActive ? 'show' : '' }}" role="list" id="submenu-certificate" aria-expanded="{{ $certificateActive ? 'true' : 'false' }}">
          <ul class="flex-column nav">
            <li class="nav-item"><a href="{{ route('center.certificate_generate') }}" class="nav-link"><span class="sidebar-text">Generate Certificate</span></a></li>
            <li class="nav-item"><a href="{{ route('center.typing_certificate_generate') }}" class="nav-link"><span class="sidebar-text">Generate Typing Certificate</span></a></li>
            <li class="nav-item"><a href="{{ route('center.certificate_list') }}" class="nav-link"><span class="sidebar-text">Certificate List</span></a></li>
          </ul>
        </div>
      </li>

      <!-- Courier (same label as admin) -->
      <li class="nav-item {{ Request::routeIs('center.courier.*') ? 'active' : '' }}">
        <a href="{{ route('center.courier.index') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-truck"></i></span>
          <span class="sidebar-text">Courier</span>
        </a>
      </li>

      <!-- View Transaction -->
      <li class="nav-item {{ Request::routeIs('view_transaction') ? 'active' : '' }}">
        <a href="{{ route('view_transaction') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-receipt"></i></span>
          <span class="sidebar-text">View Transaction</span>
        </a>
      </li>

      <!-- Recharge History -->
      <li class="nav-item {{ Request::routeIs('wallet_statement') ? 'active' : '' }}">
        <a href="{{ route('wallet_statement') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-clock-rotate-left"></i></span>
          <span class="sidebar-text">Recharge History</span>
        </a>
      </li>

      <!-- Set Fee -->
      <li class="nav-item {{ Request::routeIs('set_fee') ? 'active' : '' }}">
        <a href="{{ route('set_fee') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-wallet"></i></span>
          <span class="sidebar-text">Set Fee</span>
        </a>
      </li>

      <!-- Search To Pay -->
      <li class="nav-item {{ Request::routeIs('search_to_pay') ? 'active' : '' }}">
        <a href="{{ route('search_to_pay') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-magnifying-glass-dollar"></i></span>
          <span class="sidebar-text">Search To Pay</span>
        </a>
      </li>

      <!-- Attendance (collapsible) -->
      @php $attendanceActive = Request::routeIs('attndance_batch') || Request::routeIs('set_attendance_page') || Request::routeIs('make_attendance') || Request::routeIs('attendance_report'); @endphp
      <li class="nav-item">
        <span class="nav-link {{ $attendanceActive ? '' : 'collapsed' }} d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-attendance" aria-expanded="{{ $attendanceActive ? 'true' : 'false' }}">
          <span>
            <span class="sidebar-icon"><i class="fa-solid fa-calendar-check"></i></span>
            <span class="sidebar-text">Attendance</span>
          </span>
          <span class="link-arrow"><i class="fa-solid fa-chevron-right"></i></span>
        </span>
        <div class="multi-level collapse {{ $attendanceActive ? 'show' : '' }}" role="list" id="submenu-attendance" aria-expanded="{{ $attendanceActive ? 'true' : 'false' }}">
          <ul class="flex-column nav">
            <li class="nav-item"><a href="{{ route('attndance_batch') }}" class="nav-link"><span class="sidebar-text">Manage Batch</span></a></li>
            <li class="nav-item"><a href="{{ route('set_attendance_page') }}" class="nav-link"><span class="sidebar-text">Set Attendance</span></a></li>
            <li class="nav-item"><a href="{{ route('make_attendance') }}" class="nav-link"><span class="sidebar-text">Manage Attendance</span></a></li>
            <li class="nav-item"><a href="{{ route('attendance_report') }}" class="nav-link"><span class="sidebar-text">Attendance Report</span></a></li>
          </ul>
        </div>
      </li>

      <!-- Income/Expense -->
      <li class="nav-item {{ Request::routeIs('income_expense') ? 'active' : '' }}">
        <a href="{{ route('income_expense') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-chart-line"></i></span>
          <span class="sidebar-text">Income/Expense</span>
        </a>
      </li>

      <!-- Invoices (collapsible) -->
      @php $invoiceActive = Request::routeIs('center.invoice.wallet_recharge_list') || Request::routeIs('center.invoice.student_payment_list'); @endphp
      <li class="nav-item">
        <span class="nav-link {{ $invoiceActive ? '' : 'collapsed' }} d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-invoice" aria-expanded="{{ $invoiceActive ? 'true' : 'false' }}">
          <span>
            <span class="sidebar-icon"><i class="fa-solid fa-file-invoice"></i></span>
            <span class="sidebar-text">Invoices</span>
          </span>
          <span class="link-arrow"><i class="fa-solid fa-chevron-right"></i></span>
        </span>
        <div class="multi-level collapse {{ $invoiceActive ? 'show' : '' }}" role="list" id="submenu-invoice" aria-expanded="{{ $invoiceActive ? 'true' : 'false' }}">
          <ul class="flex-column nav">
            <li class="nav-item"><a href="{{ route('center.invoice.wallet_recharge_list') }}" class="nav-link"><span class="sidebar-text">Wallet Recharge</span></a></li>
            <li class="nav-item"><a href="{{ route('center.invoice.student_payment_list') }}" class="nav-link"><span class="sidebar-text">Student Payment</span></a></li>
          </ul>
        </div>
      </li>

      <!-- Course Syllabus -->
      <li class="nav-item {{ Request::routeIs('center.syllabus.*') ? 'active' : '' }}">
        <a href="{{ route('center.syllabus.index') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-book-open"></i></span>
          <span class="sidebar-text">Course Syllabus</span>
        </a>
      </li>

    </ul>
  </div>
</nav>
