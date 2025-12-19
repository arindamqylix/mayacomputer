<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0" 
     style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); padding: 12px 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
  <div class="container-fluid px-0">
    <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">

      <!-- Search Bar -->
      <div class="d-flex align-items-center" style="padding: 8px 0px 14px 7px;">
        <form class="navbar-search form-inline" id="navbar-search-main">
          <div class="input-group input-group-merge search-bar">
            <span class="input-group-text" id="topbar-addon" style="background: rgba(255,255,255,0.2); border: none; color: white;">
              <svg class="icon icon-xs" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                   fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 
                         4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd"></path>
              </svg>
            </span>
            <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Search"
                   aria-label="Search" aria-describedby="topbar-addon" 
                   style="background: rgba(255,255,255,0.2); border: none; color: white; border-radius: 0 0.375rem 0.375rem 0;">
          </div>
        </form>
      </div>

      <!-- Navbar Right -->
      <ul class="navbar-nav align-items-center">

        <!-- User Dropdown -->
        <li class="nav-item dropdown ms-lg-3">
          <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown"
             aria-expanded="false" style="color: white;">
            <div class="media d-flex align-items-center">
              @if(auth()->user() && auth()->user()->sl_photo && file_exists(public_path(auth()->user()->sl_photo)))
                <img class="avatar rounded-circle" alt="User Avatar" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid rgba(255,255,255,0.3);"
                     src="{{ asset(auth()->user()->sl_photo) }}">
              @else
                <div class="avatar rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.3);">
                  <i class="fas fa-user text-white"></i>
                </div>
              @endif
              <div class="media-body ms-2 d-none d-lg-block">
                <span class="mb-0 fw-bold" style="color: white;">
                  @if(auth()->user() && auth()->user()->sl_name)
                    {{ auth()->user()->sl_name }}
                  @else
                    Student
                  @endif
                </span>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1" style="border-radius: 0.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            <a class="dropdown-item d-flex align-items-center" href="{{ route('student_logout') }}" style="padding: 0.75rem 1rem;">
                <i class="fas fa-sign-out-alt me-2" style="color: #dc2626;"></i> 
                <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>

    </div>
  </div>
</nav>
