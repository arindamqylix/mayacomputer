

<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0" 
     style="background: #ffffff; padding: 6px;">
  <div class="container-fluid px-0">
    <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">

      <!-- Search Bar -->
      <div class="d-flex align-items-center" style="padding: 8px 0px 14px 7px;">
        <form class="navbar-search form-inline" id="navbar-search-main">
          <div class="input-group input-group-merge search-bar">
            <span class="input-group-text" id="topbar-addon">
              <svg class="icon icon-xs" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                   fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 
                         4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd"></path>
              </svg>
            </span>
            <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Search"
                   aria-label="Search" aria-describedby="topbar-addon">
          </div>
        </form>
      </div>

      <!-- Navbar Right -->
      <ul class="navbar-nav align-items-center">

        <!-- User Dropdown -->
        <li class="nav-item dropdown ms-lg-3">
          <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown"
             aria-expanded="false">
            <div class="media d-flex align-items-center">
              <img class="avatar rounded-circle" alt="User Avatar"
                   src="https://lh4.googleusercontent.com/proxy/ElNJBofC5Bx_BPHcyLtNKL6tb90TKY0O1RzSW4i8UB7ZzuVGqitPVR43wJbwCxCPwaNPCTmNhsp3PTEXaza1NivZS2LdfGHBqqDfmInrTtO_K1g8">
              <div class="media-body ms-2 d-none d-lg-block">
                <span class="mb-0 fw-bold text-gray-900">
                  @if(auth()->user() && auth()->user()->al_name)
                    {{ auth()->user()->al_name }} 
                  @else
                    User Name
                  @endif
                </span>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
            <div role="separator" class="dropdown-divider my-1"></div>
            

            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin_change_password') }}">
                <i class="fas fa-key me-2"></i> Change Password
            </a>

            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin_logout') }}">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>
        </div>

        </li>
      </ul>

    </div>
  </div>
</nav>
