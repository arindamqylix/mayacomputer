========== Left Sidebar Start ========== -->
<div class="vertical-menu" style="background: #2a3042;">
  <div data-simplebar class="h-100">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <!-- Left Menu Start -->
      <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu">Menu</li>
        <li>
          <a href="{{ route('student_dashboard') }}" class="waves-effect">
            <i class="bx bx-home-circle"></i><span class="badge rounded-pill bg-info float-end"></span>
            <span key="t-dashboards">Dashboards</span>
          </a>
        </li>
        <li>
          <a href="{{ route('view_marksheet') }}" class="waves-effect">
            <i class="bx bx-show"></i><span class="badge rounded-pill bg-info float-end"></span>
            <span key="t-dashboards">View Marksheet</span>
          </a>
        </li>
        <li>
          <a href="#" class="waves-effect">
            <i class="bx bx-show"></i><span class="badge rounded-pill bg-info float-end"></span>
            <span key="t-dashboards">View ID Card</span>
          </a>
        </li>
        <li>
          <a href="{{ route('view_payment') }}" class="waves-effect">
            <i class="bx bxs-credit-card"></i><span class="badge rounded-pill bg-info float-end"></span>
            <span key="t-dashboards">View Payment</span>
          </a>
        </li>
      
      </ul>
    </div>
    <!-- Sidebar -->
  </div>
</div>
<!-- Left Sidebar End