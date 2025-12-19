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
            <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
            Sign Out
          </a>
        </div>
      </div>
      <div class="collapse-close d-md-none">
        <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
          aria-expanded="true" aria-label="Toggle navigation">
          <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </a>
      </div>
    </div>
    <ul class="nav flex-column pt-3 pt-md-0">

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

      <li class="nav-item {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
        <a href="{{ route('center_dashboard') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-gauge"></i></span>
          <span class="sidebar-text">Dashboard</span>
        </a>
      </li>

      <li class="nav-item {{ Request::segment(2) == 'chat' ? 'active' : '' }}">
        <a href="{{ route('center.chat') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-comments"></i></span>
          <span class="sidebar-text">Chat</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('add_student') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-user-plus"></i></span>
          <span class="sidebar-text">Add Student</span>
        </a>
      </li>

      <li class="nav-item">
        <span class="nav-link collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-student" aria-expanded="false">
          <span>
            <span class="sidebar-icon"><i class="fa-solid fa-users"></i></span>
            <span class="sidebar-text">View Student</span>
          </span>
          <span class="link-arrow"><i class="fa-solid fa-chevron-right"></i></span>
        </span>
        <div class="multi-level collapse" role="list" id="submenu-student" aria-expanded="false">
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

      <li class="nav-item">
        <a href="{{ route('student_id_card') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-regular fa-id-card"></i></span>
          <span class="sidebar-text">Student ID Card</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('generate_admit_card') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-ticket"></i></span>
          <span class="sidebar-text">Generate Admit Card</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admit_card_list') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-list"></i></span>
          <span class="sidebar-text">View Admit Card</span>
        </a>
      </li>

      <li class="nav-item">
        <span class="nav-link collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-result" aria-expanded="false">
          <span>
            <span class="sidebar-icon"><i class="fa-solid fa-graduation-cap"></i></span>
            <span class="sidebar-text">Result</span>
          </span>
          <span class="link-arrow"><i class="fa-solid fa-chevron-right"></i></span>
        </span>
        <div class="multi-level collapse" role="list" id="submenu-result" aria-expanded="false">
          <ul class="flex-column nav">
            <li class="nav-item"><a href="{{ route('set_result') }}" class="nav-link"><span class="sidebar-text">Set Result</span></a></li>
            <li class="nav-item"><a href="{{ route('student_result_list') }}" class="nav-link"><span class="sidebar-text">Result List</span></a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a href="{{ route('view_transaction') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-receipt"></i></span>
          <span class="sidebar-text">View Transaction</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('wallet_statement') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-wallet"></i></span>
          <span class="sidebar-text">Recharge History</span>
        </a>
      </li>

      <li class="nav-item">
          <a href="{{ route('set_fee') }}" class="nav-link">
              <span class="sidebar-icon"><i class="fa-solid fa-wallet"></i></span>
              <span class="sidebar-text">Set Fee</span>
          </a>
      </li>

      <li class="nav-item">
        <span class="nav-link collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-attendance" aria-expanded="false">
          <span>
            <span class="sidebar-icon"><i class="fa-solid fa-calendar-check"></i></span>
            <span class="sidebar-text">Attendance</span>
          </span>
          <span class="link-arrow"><i class="fa-solid fa-chevron-right"></i></span>
        </span>
        <div class="multi-level collapse" role="list" id="submenu-attendance" aria-expanded="false">
          <ul class="flex-column nav">
            <li class="nav-item"><a href="{{ route('attndance_batch') }}" class="nav-link"><span class="sidebar-text">Manage Batch</span></a></li>
            <li class="nav-item"><a href="{{ route('make_attendance') }}" class="nav-link"><span class="sidebar-text">Manage Attendance</span></a></li>
            <li class="nav-item"><a href="{{route('attendance_report')}}" class="nav-link"><span class="sidebar-text">Attendance Report</span></a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a href="{{ route('income_expense') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-chart-line"></i></span>
          <span class="sidebar-text">Income/Expense</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('search_to_pay') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-magnifying-glass-dollar"></i></span>
          <span class="sidebar-text">Search To Pay</span>
        </a>
      </li>

      


      

    </ul>
  </div>
</nav>
