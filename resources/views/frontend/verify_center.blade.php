<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Center Verification - {{ $center->cl_center_name }}</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f8f9fa; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .card { background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 500px; width: 90%; text-align: center; }
        .success-icon { color: #28a745; font-size: 48px; margin-bottom: 1rem; }
        h1 { font-size: 24px; color: #333; margin-bottom: 0.5rem; }
        p { color: #666; margin: 0.5rem 0; }
        .details { text-align: left; margin: 1.5rem 0; background: #f9f9f9; padding: 1rem; border-radius: 5px; }
        .detail-row { display: flex; justify-content: space-between; margin-bottom: 0.5rem; padding-bottom: 0.5rem; border-bottom: 1px solid #eee; }
        .detail-row:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .label { font-weight: bold; color: #555; font-size: 14px; }
        .value { color: #333; font-weight: 500; font-size: 14px; text-align: right; }
        .btn { display: inline-block; padding: 12px 25px; background-color: #0f1d46; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; transition: background 0.3s; margin-top: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.2); cursor: pointer; border:none; width: 100%; }
        .btn:hover { background-color: #0a1330; }
        .status-badge { display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; }
        .status-active { background: #d4edda; color: #155724; }
        
        /* OTP Section */
        #otp-section { display: none; margin-top: 20px; text-align: left; }
        input[type="text"] { width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; font-size: 16px; letter-spacing: 2px; text-align: center; }
        .alert { padding: 10px; margin-bottom: 10px; border-radius: 5px; font-size: 14px; display: none; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        
        .loader {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #0f1d46;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: inline-block;
            vertical-align: middle;
            margin-right: 5px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @media(max-width: 480px) {
            .detail-row { flex-direction: column; }
            .value { text-align: left; margin-top: 2px; }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="success-icon">✓</div>
        <h1>Center Verified</h1>
        <p>This center is successfully registered with us.</p>
        
        <div class="details">
            <div class="detail-row">
                <span class="label">Center Name:</span>
                <span class="value">{{ $center->cl_center_name }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Center Code:</span>
                <span class="value">{{ $center->cl_code }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Director Name:</span>
                <span class="value">{{ $center->cl_director_name }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Registration Date:</span>
                <span class="value">{{ \Carbon\Carbon::parse($center->cl_registration_date)->format('d-M-Y') }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Status:</span>
                <span class="value">
                    <span class="status-badge status-active">Verified & Active</span>
                </span>
            </div>
        </div>

        <div id="action-area">
             <div class="alert alert-success" id="success-msg"></div>
             <div class="alert alert-danger" id="error-msg"></div>
             
             <button id="send-otp-btn" class="btn">Authentic View (Owner Only)</button>
             
             <div id="otp-section">
                 <p style="font-size: 14px; margin-bottom: 10px;">An OTP has been sent to the center's registered email address. Please enter it below to view the full certificate.</p>
                 <input type="text" id="otp-input" placeholder="Enter 6-digit OTP" maxlength="6">
                 <button id="verify-otp-btn" class="btn">Verify & View Certificate</button>
             </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var centerCode = "{{ $center->cl_code }}";
            var token = $('meta[name="csrf-token"]').attr('content');

            $('#send-otp-btn').click(function() {
                var btn = $(this);
                btn.html('<div class="loader"></div> Sending OTP...').prop('disabled', true);
                $('#error-msg').hide();
                $('#success-msg').hide();

                $.ajax({
                    url: "{{ route('verify_center.send_otp') }}",
                    type: 'POST',
                    data: {
                        _token: token,
                        center_code: centerCode
                    },
                    success: function(response) {
                        btn.hide();
                        if (response.success) {
                            $('#otp-section').fadeIn();
                            $('#success-msg').text(response.message).fadeIn();
                        } else {
                            btn.html('Authentic View (Owner Only)').prop('disabled', false).show();
                            $('#error-msg').text(response.message).fadeIn();
                        }
                    },
                    error: function() {
                        btn.html('Authentic View (Owner Only)').prop('disabled', false).show();
                        $('#error-msg').text('Something went wrong. Please try again.').fadeIn();
                    }
                });
            });

            $('#verify-otp-btn').click(function() {
                var otp = $('#otp-input').val();
                if (otp.length < 6) {
                    $('#error-msg').text('Please enter a valid 6-digit OTP.').fadeIn();
                    return;
                }

                var btn = $(this);
                btn.html('<div class="loader"></div> Verifying...').prop('disabled', true);
                $('#error-msg').hide();

                $.ajax({
                    url: "{{ route('verify_center.verify_otp') }}",
                    type: 'POST',
                    data: {
                        _token: token,
                        center_code: centerCode,
                        otp: otp
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = "{{ route('verify_center.certificate', $center->cl_code) }}";
                        } else {
                            btn.html('Verify & View Certificate').prop('disabled', false);
                            $('#error-msg').text(response.message).fadeIn();
                        }
                    },
                    error: function() {
                        btn.html('Verify & View Certificate').prop('disabled', false);
                        $('#error-msg').text('Something went wrong. Please try again.').fadeIn();
                    }
                });
            });
        });
    </script>
</body>
</html>
