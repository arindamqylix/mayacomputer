<!DOCTYPE html>
<html lang="en">
<head>
        <title>Center Login</title>
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

    <!-- Fontawesome -->
    <link type="text/css" href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    
    <!-- Sweet Alert -->
    <link type="text/css" href="/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    
    <!-- Notyf -->
    <link type="text/css" href="/vendor/notyf/notyf.min.css" rel="stylesheet">
    
    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('public/css/volt.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2.5rem 2rem;
            text-align: center;
            color: white;
        }
        .login-logo {
            max-width: 180px;
            max-height: 80px;
            margin-bottom: 1rem;
            object-fit: contain;
        }
        .login-logo-text {
            font-size: 1.75rem;
            font-weight: 700;
            color: white;
            margin: 0;
        }
        .login-body {
            padding: 2.5rem 2rem;
        }
        .login-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }
        .login-subtitle {
            color: #718096;
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }
        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        .input-group-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px 0 0 10px;
        }
        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
            color: white;
        }
        .alert {
            border-radius: 10px;
            border: none;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        .alert-danger {
            background: #fee;
            color: #c33;
            border-left: 4px solid #c33;
        }
        .icon-wrapper {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <!-- Core -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <!-- Vendor JS -->
    <script src="/assets/js/on-screen.umd.min.js"></script>

    <!-- Slider -->
    <script src="/assets/js/nouislider.min.js"></script>

    <!-- Smooth scroll -->
    <script src="/assets/js/smooth-scroll.polyfills.min.js"></script>

    <!-- Apex Charts -->
    <script src="/vendor/apexcharts/apexcharts.min.js"></script>

    <!-- Charts -->
    <script src="/assets/js/chartist.min.js"></script>
    <script src="/assets/js/chartist-plugin-tooltip.min.js"></script>

    <!-- Datepicker -->
    <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker.min.js"></script>

    <!-- Sweet Alerts 2 -->
    <script src="/assets/js/sweetalert2.all.min.js"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

    <!-- Notyf -->
    <script src="/vendor/notyf/notyf.min.js"></script>

    <!-- Simplebar -->
    <script src="/assets/js/simplebar.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    
    <!-- Volt JS -->
    <script src="/assets/js/volt.js"></script>
    <script src="/assets/js/custom-script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>



</head>

<body> 
<main>
    <div class="login-container">
        <div class="login-card">
            <!-- Login Header with Logo -->
            <div class="login-header">
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
                    <img src="{{ asset($logoPath) }}" alt="{{ $siteName }} Logo" class="login-logo">
                @else
                    <h2 class="login-logo-text">{{ $siteName }}</h2>
                @endif
                <p class="mb-0" style="opacity: 0.9;">Center Portal</p>
            </div>

            <!-- Login Body -->
            <div class="login-body">
                <h2 class="login-title text-center">Welcome Back!</h2>
                <p class="login-subtitle text-center">Sign in to continue to your center dashboard</p>

                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ Session::get('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('center_login') }}">
                    @csrf
                    
                    <!-- Center Code Field -->
                    <div class="mb-4">
                        <label for="center_code" class="form-label">
                            <i class="fas fa-building me-2"></i>Center Code
                        </label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <div class="icon-wrapper">
                                    <i class="fas fa-building"></i>
                                </div>
                            </span>
                            <input type="text" name="center_code" class="form-control"
                                placeholder="Enter your center code" id="center_code" autofocus required
                                value="{{ old('center_code') }}">
                        </div>
                        @error('center_code')
                            <div class="text-danger small mt-1">
                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-4">
                        <label for="mobile" class="form-label">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon2">
                                <div class="icon-wrapper">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </span>
                            <input name="mobile" type="password" placeholder="Enter your password"
                                class="form-control" id="mobile" required>
                        </div>
                        @error('mobile')
                            <div class="text-danger small mt-1">
                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-login">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
</body>

</html>