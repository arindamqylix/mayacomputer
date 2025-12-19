<!DOCTYPE html>
<html lang="en">
<head>
        <title>@yield('title')</title>
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../../assets/img/favicon/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="../../assets/img/favicon/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="../../assets/img/favicon/favicon-16x16.png" sizes="16x16" type="image/png">

    <link rel="mask-icon" href="../../assets/img/favicon/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="../../assets/img/favicon/favicon.ico">
    <meta name="msapplication-config" content="../../assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    
    <!-- Apex Charts -->
    <link type="text/css" href="/vendor/apexcharts/apexcharts.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Datepicker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/css/datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/css/datepicker-bs4.min.css">
    <link href="{{ asset('backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Fontawesome -->
    <link type="text/css" href="{{asset('public/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    
    <!-- Sweet Alert -->
    <link type="text/css" href="{{asset('public/vendor/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet">
    
    <!-- Notyf -->
    <link type="text/css" href="{{asset('public/vendor/notyf/notyf.min.css')}}" rel="stylesheet">
    
    <!-- Volt CSS -->
    <link type="text/css" href="{{asset('public/css/volt.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />


    <!-- Core -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <!-- Vendor JS -->
    <script src="{{asset('public//assets/js/on-screen.umd.min.js')}}"></script>

    <!-- Slider -->
    <script src="{{asset('public/assets/js/nouislider.min.js')}}"></script>

    <!-- Smooth scroll -->
    <script src="{{asset('public/assets/js/smooth-scroll.polyfills.min.js')}}"></script>

    <!-- Apex Charts -->
    <script src="{{asset('public/vendor/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Charts -->
    <script src="{{asset('public/assets/js/chartist.min.js')}}"></script>
    <script src="{{asset('public/assets/js/chartist-plugin-tooltip.min.js')}}"></script>

    <!-- Datepicker -->
    <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker.min.js"></script>

    <!-- Sweet Alerts 2 -->
    <script src="{{asset('public/assets/js/sweetalert2.all.min.js')}}"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

    <!-- Notyf -->
    <script src="{{asset('public/vendor/notyf/notyf.min.js')}}"></script>

    <!-- Simplebar -->
    <script src="{{asset('/assets/js/simplebar.min.js')}}"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    
    <!-- Volt JS -->
    <script src="{{asset('public//assets/js/volt.js')}}"></script>
    <script src="{{asset('public/assets/js/custom-script.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- dashboard init -->
@if(request()->routeIs('center_dashboard') || request()->is('center/dashboard'))
<script src="{{ asset('backend/assets/js/pages/dashboard.init.js') }}"></script>
@endif
<!-- Required datatable js -->
        <script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/select2/js/select2.min.js') }}"></script>
<!-- Datatable init js -->
<script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script>  
    @stack('custom-css')



</head>

<body> 

    {{-- Nav --}}
    @include('center.layouts.nav')
    @include('center.layouts.sidenav')

     <main class="content">
        {{-- TopBar --}}
        @include('center.layouts.topbar')

            @yield('content')

        {{-- Footer --}}
        @include('center.layouts.footer')
    </main>

    {{-- Footer --}}
    @include('center.layouts.footer2')

    @if(session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
    @endif

    @if(session('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif

    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    @stack('custom-script')
    @stack('custom-js')
    <script src="{{ asset('vendor/livewire/livewire.js') }}"></script>
    
    <style>
        /* Modern Center Sidebar Styling - Matching Logo Blue Colors */
        .sidebar {
            background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 50%, #2563eb 100%) !important;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(30, 64, 175, 0.1) 100%);
            pointer-events: none;
        }
        
        .sidebar-inner {
            position: relative;
            z-index: 1;
        }
        
        /* Logo/Brand Section - Proper Logo Display */
        .sidebar .nav-item:first-child .nav-link {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.2) 0%, rgba(30, 64, 175, 0.2) 100%);
            border-radius: 0.75rem;
            padding: 1rem 0.75rem !important;
            margin-bottom: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            justify-content: center;
            min-height: 90px;
            display: flex;
            align-items: center;
        }
        
        .sidebar .nav-item:first-child .nav-link:hover {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.3) 0%, rgba(30, 64, 175, 0.3) 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        
        .sidebar .nav-item:first-child .sidebar-icon {
            margin-right: 0 !important;
        }
        
        .sidebar .nav-item:first-child .sidebar-icon img {
            width: 100% !important;
            height: auto !important;
            max-width: 200px !important;
            max-height: 80px !important;
            min-height: 60px !important;
            object-fit: contain;
            border-radius: 0;
            box-shadow: none;
            display: block;
        }
        
        .sidebar .nav-item:first-child .sidebar-text {
            display: block; /* Show text if logo not available */
            color: white !important;
            font-weight: 700;
            text-align: center;
        }
        
        /* Navigation Links - Reduced Size */
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            border-radius: 0.5rem;
            margin-bottom: 0.15rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            padding: 0.4rem 0.6rem !important;
            font-size: 0.875rem !important;
        }
        
        .sidebar .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        
        .sidebar .nav-link:hover {
            color: #ffffff !important;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.2) 0%, rgba(30, 64, 175, 0.2) 100%);
            transform: translateX(3px);
            padding-left: 0.75rem !important;
        }
        
        .sidebar .nav-link:hover::before {
            transform: scaleY(1);
        }
        
        /* Active State */
        .sidebar .nav-item.active > .nav-link,
        .sidebar .nav-link.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%) !important;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
            font-weight: 600;
        }
        
        .sidebar .nav-item.active > .nav-link::before,
        .sidebar .nav-link.active::before {
            transform: scaleY(1);
            width: 4px;
        }
        
        /* Icons - Smaller Size */
        .sidebar .sidebar-icon {
            color: rgba(255, 255, 255, 0.7) !important;
            transition: all 0.3s ease;
            width: 18px;
            text-align: center;
            font-size: 0.875rem !important;
        }
        
        .sidebar .nav-link:hover .sidebar-icon,
        .sidebar .nav-item.active .sidebar-icon {
            color: #ffffff !important;
            transform: scale(1.1);
        }
        
        /* Submenu/Dropdown - Compact Size */
        .sidebar .multi-level {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 0.375rem;
            margin-top: 0.2rem;
            padding: 0.1rem 0;
            border-left: 2px solid rgba(37, 99, 235, 0.3);
        }
        
        .sidebar .multi-level .nav-link {
            padding-left: 2.2rem !important;
            font-size: 0.75rem !important;
            padding-top: 0.2rem !important;
            padding-bottom: 0.2rem !important;
            padding-right: 0.5rem !important;
            margin-bottom: 0.05rem !important;
        }
        
        .sidebar .multi-level .nav-link:hover {
            background: rgba(37, 99, 235, 0.15);
            transform: translateX(2px);
            padding-left: 2.4rem !important;
        }
        
        .sidebar .multi-level .sidebar-text {
            font-size: 0.75rem !important;
            font-weight: 500;
        }
        
        /* Dropdown Parent Items */
        .sidebar .nav-link[data-bs-toggle="collapse"] {
            padding: 0.4rem 0.6rem !important;
        }
        
        .sidebar .nav-link[data-bs-toggle="collapse"] .sidebar-text {
            font-size: 0.875rem !important;
        }
        
        /* Text - Smaller Size */
        .sidebar .sidebar-text {
            color: rgba(255, 255, 255, 0.85);
            transition: all 0.3s ease;
            font-size: 0.875rem !important;
        }
        
        .sidebar .nav-link:hover .sidebar-text {
            color: #ffffff;
        }
        
        /* Link Arrow */
        .sidebar .link-arrow {
            color: rgba(255, 255, 255, 0.6);
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover .link-arrow {
            color: #ffffff;
        }
        
        .sidebar .nav-link[aria-expanded="true"] .link-arrow {
            transform: rotate(90deg);
            color: #ffffff;
        }
        
        /* Scrollbar Styling */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            border-radius: 10px;
        }
        
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
        }
    </style>

</body>

</html>