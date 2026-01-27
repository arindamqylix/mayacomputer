<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Center Verification - {{ $center->cl_center_name }}</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f8f9fa; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .card { background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 500px; width: 90%; text-align: center; }
        .success-icon { color: #28a745; font-size: 48px; margin-bottom: 1rem; }
        h1 { font-size: 24px; color: #333; margin-bottom: 0.5rem; }
        p { color: #666; margin: 0.5rem 0; }
        .details { text-align: left; margin: 1.5rem 0; background: #f9f9f9; padding: 1rem; border-radius: 5px; }
        .detail-row { display: flex; justify-content: space-between; margin-bottom: 0.5rem; padding-bottom: 0.5rem; border-bottom: 1px solid #eee; }
        .detail-row:last-child { border-bottom: none; }
        .detail-row:last-child { margin-bottom: 0; padding-bottom: 0; }
        .label { font-weight: bold; color: #555; font-size: 14px; }
        .value { color: #333; font-weight: 500; font-size: 14px; text-align: right; }
        .btn { display: inline-block; padding: 12px 25px; background-color: #0f1d46; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; transition: background 0.3s; margin-top: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.2); }
        .btn:hover { background-color: #0a1330; }
        .status-badge { display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; }
        .status-active { background: #d4edda; color: #155724; }
        
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

        <a href="{{ route('verify_center.certificate', $center->cl_code) }}" class="btn">View Certificate</a>
    </div>
</body>
</html>
