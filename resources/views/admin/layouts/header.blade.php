
<header id="page-topbar">
                <div class="navbar-header" style="background: #ffffff;">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box" style="background: #ffffff;border-bottom: 1px solid #515151;">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('logo.png') }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('logo.png') }}" alt="" height="17">
                                </span>
                            </a>
                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('logo.png') }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('logo.png') }}" alt="" height="19">
                                </span>
                            </a>
                        </div>
                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>
                    <div class="d-flex">
                        <div class="d-flex">
                            <div style='margin-top:15px;margin-right:20px;font-size:15px'  class="d-none d-md-block d-lg-block text-bold">
                           {{-- <a href='quick_student' class='btn text-bold bg-info text-light' title='Student Registration'> <i class='fa fa-user-plus'></i> Quick Student </a>
                           <a href='' class='btn   text-bold bg-danger text-light' title='Dues'>Dues Balance - -320.00</a> --}}
                           <a href="{{ route('payment') }}" class='btn   text-bold bg-primary text-light' title='Dues'>Recharge Now</a>
                           <a href='' class='btn   text-bold bg-danger text-light' title='Dues'>Wallet Balance - {{ $center->cl_wallet_balance }}</a>
                           {{-- <a href='make_att_scan' class='btn   text-bold bg-dark text-light' title='Dues'>Make Attendance </a> --}}
                        </div>
                        @livewire('notification-bell')
                        
                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                            <i class="bx bx-fullscreen" style="color: #74788d !important;"></i>
                            </button>
                        </div>
                       
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @php
                                $setting = DB::table('site_settings')->first();
                                $adminLogo = $setting->admin_profile_logo ?? null;
                            @endphp
                            @if($adminLogo)
                                <img class="rounded-circle header-profile-user" src="{{ asset($adminLogo) }}"
                                alt="Header Avatar">
                            @else
                                <img class="rounded-circle header-profile-user" src="{{ asset('admin/assets/images/users/avatar-1.jpg') }}"
                                alt="Header Avatar">
                            @endif
                            <span class="d-none d-xl-inline-block ms-1" key="t-henry">Admin</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{ route('admin_profile_update') }}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('admin_logout') }}"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>