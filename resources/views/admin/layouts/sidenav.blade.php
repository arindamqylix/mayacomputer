<nav id="sidebarMenu" class="sidebar d-lg-block text-white collapse" data-simplebar>
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
        <a href="{{ route('admin_dashboard') }}" class="nav-link d-flex align-items-center justify-content-center">
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
      <li class="nav-item {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
        <a href="{{ route('admin_dashboard') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-gauge"></i></span>
          <span class="sidebar-text">Dashboard</span>
        </a>
      </li>

      <!-- Chat -->
      <li class="nav-item {{ Request::segment(2) == 'chat' ? 'active' : '' }}">
        <a href="{{ route('admin.chat') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-comments"></i></span>
          <span class="sidebar-text">Chat</span>
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
        <span class="nav-link collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-admit" aria-expanded="false">
          <span>
            <span class="sidebar-icon"><i class="fa-solid fa-ticket"></i></span>
            <span class="sidebar-text">Admit Card</span>
          </span>
          <span class="link-arrow"><i class="fa-solid fa-chevron-right"></i></span>
        </span>
        <div class="multi-level collapse" role="list" id="submenu-admit" aria-expanded="false">
          <ul class="flex-column nav">
            <li class="nav-item"><a href="{{ route('admin.generate_admit_card') }}" class="nav-link"><span class="sidebar-text">Generate Admit Card</span></a></li>
            <li class="nav-item"><a href="{{ route('admin.admit_card_list') }}" class="nav-link"><span class="sidebar-text">View Admit Card</span></a></li>
          </ul>
        </div>
      </li>

      <!-- Result -->
      <li class="nav-item">
        <span class="nav-link collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-result" aria-expanded="false">
          <span>
            <span class="sidebar-icon"><i class="fa-solid fa-file-lines"></i></span>
            <span class="sidebar-text">Result</span>
          </span>
          <span class="link-arrow"><i class="fa-solid fa-chevron-right"></i></span>
        </span>
        <div class="multi-level collapse" role="list" id="submenu-result" aria-expanded="false">
          <ul class="flex-column nav">
            <li class="nav-item"><a href="{{ route('admin.set_result') }}" class="nav-link"><span class="sidebar-text">Set Result</span></a></li>
            <li class="nav-item"><a href="{{ route('admin.result_list') }}" class="nav-link"><span class="sidebar-text">Result List</span></a></li>
          </ul>
        </div>
      </li>

      <!-- Certificate -->
      <li class="nav-item">
        <span class="nav-link collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-certificate" aria-expanded="false">
          <span>
            <span class="sidebar-icon"><i class="fa-solid fa-certificate"></i></span>
            <span class="sidebar-text">Certificates</span>
          </span>
          <span class="link-arrow"><i class="fa-solid fa-chevron-right"></i></span>
        </span>
        <div class="multi-level collapse" role="list" id="submenu-certificate" aria-expanded="false">
          <ul class="flex-column nav">
            <li class="nav-item"><a href="{{ route('admin.certificate_generate') }}" class="nav-link"><span class="sidebar-text">Generate Certificate</span></a></li>
            <li class="nav-item"><a href="{{ route('admin.certificate_list') }}" class="nav-link"><span class="sidebar-text">Certificate List</span></a></li>
          </ul>
        </div>
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
        <a href="{{ route('all_banner') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-book"></i></span>
          <span class="sidebar-text">Banner</span>
        </a>
      </li>

      <li class="nav-item {{ Request::segment(2) == 'homepage' ? 'active' : '' }}">
        <a href="{{ route('homepage.index') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-house"></i></span>
          <span class="sidebar-text">Homepage Sections</span>
        </a>
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
            <li class="nav-item"><a href="{{ route('about_us.list') }}" class="nav-link"><span class="sidebar-text">About Us Sections</span></a></li>
            <li class="nav-item"><a href="{{ route('director_list') }}" class="nav-link"><span class="sidebar-text">Director & Teacher</span></a></li>
            
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <span class="nav-link collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-course" aria-expanded="false">
          <span>
            <span class="sidebar-icon"><i class="fa-solid fa-book"></i></span>
            <span class="sidebar-text">Course</span>
          </span>
          <span class="link-arrow"><i class="fa-solid fa-chevron-right"></i></span>
        </span>
        <div class="multi-level collapse" role="list" id="submenu-course" aria-expanded="false">
          <ul class="flex-column nav">
            <li class="nav-item"><a href="{{ route('course.category.list') }}" class="nav-link"><span class="sidebar-text">Category</span></a></li>
            <li class="nav-item"><a href="{{ route('course.list') }}" class="nav-link"><span class="sidebar-text">Course</span></a></li>
            
          </ul>
        </div>
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

      <li class="nav-item {{ Request::segment(2) == 'contact-requests' ? 'active' : '' }}">
        <a href="{{ route('contact.index') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-envelope"></i></span>
          <span class="sidebar-text">Contact Request</span>
        </a>
      </li>

      <li class="nav-item {{ Request::segment(2) == 'pages' ? 'active' : '' }}">
        <a href="{{ route('pages.list') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-file-lines"></i></span>
          <span class="sidebar-text">Pages</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('site_settings.edit') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-solid fa-gear"></i></span>
          <span class="sidebar-text">Site Settings</span>
        </a>
      </li>

      <li class="nav-item {{ Request::segment(2) == 'whatsapp-templates' ? 'active' : '' }}">
        <a href="{{ route('admin.whatsapp_templates.index') }}" class="nav-link">
          <span class="sidebar-icon"><i class="fa-brands fa-whatsapp"></i></span>
          <span class="sidebar-text">WhatsApp Templates</span>
        </a>
      </li>

    </ul>
  </div>
</nav>
