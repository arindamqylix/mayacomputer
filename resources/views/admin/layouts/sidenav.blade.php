<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
  <div class="sidebar-inner px-2 pt-3">

    <!-- User Card -->
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

    <!-- Sidebar Menu -->
    <ul class="nav flex-column pt-3 pt-md-0">

      <!-- Logo / Home -->
      <li class="nav-item">
        <a href="{{ route('admin_dashboard') }}" class="nav-link d-flex align-items-center">
          <span class="sidebar-icon me-3">
            <img src="{{ asset('logo.png') }}" height="20" width="20" alt="Logo">
          </span>
          <span class="mt-1 ms-1 sidebar-text">Mayacomputer</span>
        </a>
      </li>

      <!-- Dashboard -->
      <li class="nav-item {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
        <a href="{{ route('admin_dashboard') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-gauge"></i></span>
          <span class="sidebar-text">Dashboard</span>
        </a>
      </li>

      <!-- Add Student -->
      <li class="nav-item {{ Request::segment(1) == 'student' ? 'active' : '' }}">
        <a href="{{ route('student_list') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-user-graduate"></i></span>
          <span class="sidebar-text">Add Student</span>
        </a>
      </li>

      <!-- Center List -->
      <li class="nav-item {{ Request::segment(1) == 'center' ? 'active' : '' }}">
        <a href="{{ route('center_list') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-building"></i></span>
          <span class="sidebar-text">Center List</span>
        </a>
      </li>

      <!-- Course -->
      <li class="nav-item {{ Request::segment(1) == 'course' ? 'active' : '' }}">
        <a href="{{ route('course_list') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-book"></i></span>
          <span class="sidebar-text">Course</span>
        </a>
      </li>

      <!-- Student Reg Fee -->
      <li class="nav-item {{ Request::segment(1) == 'set_reg_fee' ? 'active' : '' }}">
        <a href="{{ route('set_reg_fee') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-money-bill-wave"></i></span>
          <span class="sidebar-text">Student Reg Fee</span>
        </a>
      </li>

      <!-- Admit Card -->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-id-card"></i></span>
          <span class="sidebar-text">View Admit Card</span>
        </a>
      </li>

      <!-- Result -->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-file-lines"></i></span>
          <span class="sidebar-text">View Result</span>
        </a>
      </li>

      <!-- Center Transaction -->
      <li class="nav-item {{ Request::segment(1) == 'center_transaction_payment' ? 'active' : '' }}">
        <a href="{{ route('center_transaction_payment') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-arrows-rotate"></i></span>
          <span class="sidebar-text">Center Transaction</span>
        </a>
      </li>

      <!-- Center Payment History -->
      <li class="nav-item {{ Request::segment(1) == 'center_payment' ? 'active' : '' }}">
        <a href="{{ route('center_payment') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-clock-rotate-left"></i></span>
          <span class="sidebar-text">Center Payment History</span>
        </a>
      </li>

      <!-- Income / Expense -->
      <li class="nav-item {{ Request::segment(1) == 'admin_income_expense' ? 'active' : '' }}">
        <a href="{{ route('admin_income_expense') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-chart-line"></i></span>
          <span class="sidebar-text">Income/Expense</span>
        </a>
      </li>
 

      <!-- CMS Section Label -->
      <li class="nav-item mt-3 px-3">
        <span class="text-uppercase text-muted small fw-bold">CMS</span>
      </li>

      <li class="nav-item">
        <span class="nav-link collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-aboutus" aria-expanded="false">
          <span>
            <span class="sidebar-icon"><i class="fa-solid fa-circle-info"></i></span>
            <span class="sidebar-text">About Us</span>
          </span>
          <span class="link-arrow"><i class="fa-solid fa-chevron-right"></i></span>
        </span>
        <div class="multi-level collapse" role="list" id="submenu-aboutus" aria-expanded="false">
          <ul class="flex-column nav">
            <li class="nav-item"><a href="{{ route('director_list') }}" class="nav-link"><span class="sidebar-text">Director</span></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><span class="sidebar-text">Teacher</span></a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a href="{{ route('course.list') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-book"></i></span>
          <span class="sidebar-text">Course</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('all_download_form') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-download"></i></span>
          <span class="sidebar-text">Downloads</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('all_gallery') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-image"></i></span>
          <span class="sidebar-text">Gallery</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('contact.index') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-envelope"></i></span>
          <span class="sidebar-text">Contact Request</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('site_settings.edit') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-gear"></i></span>
          <span class="sidebar-text">Site Settings</span>
        </a>
      </li>

    </ul>
  </div>
</nav>
