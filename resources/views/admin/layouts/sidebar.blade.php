<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu" style="background: #2a3042;">
  <div data-simplebar class="h-100">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <!-- Left Menu Start -->
      <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu">Menu</li>
        <li>
          <a href="{{ route('center_dashboard') }}" class="waves-effect">
            <i class="bx bx-home-circle"></i><span class="badge rounded-pill bg-info float-end"></span>
            <span key="t-dashboards">Dashboards</span>
          </a>
        </li>
        
        <li>
          <a href="{{ route('add_student') }}">
            <i class="bx bx-face"></i>
            <span key="t-layouts">New Student</span>
          </a>
        </li>
        <li>
          <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="bx bx-show"></i>
            <span key="t-layouts">View Student</span>
          </a>
          <ul class="sub-menu" aria-expanded="true">
            <li>
              <a href="{{ route('pending_student') }}" class="waves-effect">
                <i class="bx bx-file"></i>
                <span key="t-file-manager">Pending</span>
              </a>
            </li>
            <li>
              <a href="{{ route('verified_student') }}" class="waves-effect">
                <i class="bx bx-file"></i>
                <span key="t-file-manager">Verified</span>
              </a>
            </li>
            <li>
              <a href="{{ route('result_updated_student') }}" class="waves-effect">
                <i class="bx bx-file"></i>
                <span key="t-file-manager">Result Updated</span>
              </a>
            </li>
            <li>
              <a href="{{ route('result_out_student') }}" class="waves-effect">
                <i class="bx bx-file"></i>
                <span key="t-file-manager">Result Out</span>
              </a>
            </li>
            <li>
              <a href="{{ route('dispatched_student') }}" class="waves-effect">
                <i class="bx bx-file"></i>
                <span key="t-file-manager">Dispatched</span>
              </a>
            </li>
            <li>
              <a href="{{ route('block_student') }}" class="waves-effect">
                <i class="bx bx-file"></i>
                <span key="t-file-manager">Block</span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="{{ route('student_id_card') }}">
            <i class="bx bx-card"></i>
            <span key="t-layouts">Student ID Card</span>
          </a>
        </li>
        <li>
          <a href="{{ route('generate_admit_card') }}">
            <i class="bx bx-paste"></i>
            <span key="t-layouts">Generate Admit Card</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admit_card_list') }}">
            <i class="bx bx-chart"></i>
            <span key="t-layouts">View Admit Card</span>
          </a>
        </li>
         <li>
          <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="bx bx-chart"></i>
            <span key="t-layouts">Result</span>
          </a>
          <ul class="sub-menu" aria-expanded="true">
            <li>
              <a href="{{ route('set_result') }}" class="waves-effect">
                <i class="bx bx-file"></i>
                <span key="t-file-manager">Set Result</span>
              </a>
            </li>
            <li>
              <a href="{{ route('student_result_list') }}" class="waves-effect">
                <i class="bx bx-file"></i>
                <span key="t-file-manager">Result List</span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="{{ route('view_transaction') }}">
            <i class="bx bx-chart"></i>
            <span key="t-layouts">View Transaction</span>
          </a>
        </li>
        <li>
          <a href="{{ route('wallet_statement') }}">
            <i class="bx bxl-paypal"></i>
            <span key="t-layouts">Recharge History </span>
          </a>
        </li>
        <li>
          <a href="javascript: void(0);" class="has-arrow waves-effect">
            <i class="bx bx-paste"></i>
            <span key="t-layouts">Attendance</span>
          </a>
          <ul class="sub-menu" aria-expanded="true">
            <li>
              <a href="{{ route('attndance_batch') }}" class="waves-effect">
                <i class="bx bx-file"></i>
                <span key="t-file-manager">Manage Batch</span>
              </a>
            </li>
            <li>
              <a href="{{ route('make_attendance') }}" class="waves-effect">
                <i class="bx bx-file"></i>
                <span key="t-file-manager">Manage Attendance</span>
              </a>
            </li>
            <li>
              <a href="{{ route('attendance_report') }}" class="waves-effect">
                <i class="bx bx-file"></i>
                <span key="t-file-manager">Attendance Report</span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="{{ route('income_expense') }}">
            <i class="bx bx-transfer"></i>
            <span key="t-layouts">Income/Expense</span>
          </a>
        </li>
        <li>
          <a href="{{ route('set_fee') }}">
            <i class="bx bx-edit-alt"></i>
            <span key="t-layouts">Set Fee</span>
          </a>
        </li>
        <li>
          <a href="{{ route('search_to_pay') }}">
            <i class="bx bx-file-find"></i>
            <span key="t-layouts">Search To Pay</span>
          </a>
        </li>

        <li>
          <a href="{{ route('profile_update') }}">
            <i class="bx bx-user"></i>
            <span key="t-layouts">Profile</span>
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