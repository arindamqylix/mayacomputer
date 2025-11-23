<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu" style="background: #2a3042;">
  <div data-simplebar class="h-100">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <!-- Left Menu Start -->
      <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu">Menu</li>
        <li>
          <a href="{{ route('admin_dashboard') }}" class="waves-effect">
            <i class="bx bx-home-circle"></i><span class="badge rounded-pill bg-info float-end"></span>
            <span key="t-dashboards">Dashboards</span>
          </a>
        </li>
        
        <li>
              <a href="{{ route('student_list') }}" class="waves-effect">
                <i class="bx bx-face"></i>
                <span key="t-file-manager">Student</span>
              </a>
            </li>

        <li>
              <a href="{{ route('center_list') }}" class="waves-effect">
                <i class="bx bxs-dashboard"></i>
                <span key="t-file-manager">Center</span>
              </a>
            </li>

        <li>
          <a href="{{ route('course_list') }}">
            <i class="bx bx-checkbox-checked"></i>
            <span key="t-layouts">Course</span>
          </a>
        </li>
        <li>
          <a href="{{ route('set_reg_fee') }}">
            <i class="bx bx-money"></i>
            <span key="t-layouts">Student Reg Fee</span>
          </a>
        </li>


        <li>
          <a href="#">
            <i class="bx bx-chart"></i>
            <span key="t-layouts">View Admit Card</span>
          </a>
        </li>

        <li>
          <a href="#">
            <i class="bx bx-checkbox-checked"></i>
            <span key="t-layouts">View Result</span>
          </a>
        </li>

        <li>
          <a href="{{ route('center_transaction_payment') }}">
            <i class="bx bx-chart"></i>
            <span key="t-layouts">Center Transaction</span>
          </a>
        </li>

        <li>
          <a href="{{ route('center_payment') }}">
            <i class="bx bxl-paypal"></i>
            <span key="t-layouts">Center Payment History</span>
          </a>
        </li>

        <li>
          <a href="{{ route('admin_income_expense') }}">
            <i class="bx bx-transfer"></i>
            <span key="t-layouts">Income/Expense</span>
          </a>
        </li>

        <li>
          <a href="#">
            <i class="bx bx-user"></i>
            <span key="t-layouts">Profile</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-user"></i>
            <span key="t-layouts">Site Settings</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin_logout') }}">
            <i class="bx bx-power-off"></i>
            <span key="t-layouts">Logout</span>
          </a>
        </li>
      </ul>
    </div>
    <!-- Sidebar -->
  </div>
</div>
<!-- Left Sidebar End -->