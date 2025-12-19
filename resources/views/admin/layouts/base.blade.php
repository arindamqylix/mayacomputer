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
    @if(request()->routeIs('admin_dashboard') || request()->is('admin/dashboard'))
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

    <style>
        .preview-img {
            max-width: 100px;
            margin-top: 8px;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 3px;
        }
    </style>
    
    @stack('custom-css')
    @livewireStyles

</head>

<body> 

    {{-- Nav --}}
    @include('admin.layouts.nav')
    @include('admin.layouts.sidenav')

     <main class="content">
        {{-- TopBar --}}
        @include('admin.layouts.topbar')

            @yield('content')

        {{-- Footer --}}
        @include('admin.layouts.footer')
    </main>

    {{-- Footer --}}
    @include('admin.layouts.footer2')

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
    <script src="{{ asset('vendor/livewire/livewire.js') }}"></script>

</body>

</html>