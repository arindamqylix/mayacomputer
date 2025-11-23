<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- Bootstrap Css -->
        <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- DataTables -->
         <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/assets/libs/select2/css/select2.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />  
        <!-- App Css-->
        <link href="{{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        <!--Toaster CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
        <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
        <style type="text/css">
            .noti-icon i{
                color: #fff !important;
            }
            .custom-button{
                background: linear-gradient(to right, #ff416c, #ff4b2b);
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                transition: background 0.3s ease;
                color: #eff2f7!important;
            }
            #selectedImage{
                width: 78px !important;
                border: 1px solid #0a4067 !important;
                height: 70px !important;
                border-radius: 3px !important;
            }
            .table_main_row{
                background: #cbe2ff !important;
            }
            .table_img{
                width: 60px;
                height: 60px;
                border-radius: 40px;
            }
            .dataTables_wrapper{
                overflow-x: scroll;
            }
        </style>
        @stack('custom-css')
    </head>
    <body data-sidebar="dark">
        <!-- <body data-layout="horizontal" data-topbar="dark"> -->
        <!-- Begin page -->
        <div id="layout-wrapper">
            @include('center.layouts.header')
            @include('center.layouts.sidebar')
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                <footer class="footer" style="background: #f2f2f5;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6" style="color: #74788d;">
                                © Copyright Mayacomputer Center. All Rights Reserve</div>
                            <div class="col-sm-6" style="color: #74788d;">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Developed by <a href="#" target="_blank">Bharat Tech Lab</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer> 
            </div>
        </div>
    @include('center.layouts.script')
    @stack('custom-js')
    </body>
    </html>