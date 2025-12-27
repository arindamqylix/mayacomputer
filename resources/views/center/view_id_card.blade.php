<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Center ID Card - {{ $data->cl_center_name ?? 'Center' }}</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Noto+Sans+Devanagari:wght@400;700&display=swap');
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px 20px;
    }
    
    .print-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        padding: 25px;
        max-width: 420px;
        width: 100%;
    }
    
    .id-card {
        width: 100%;
        max-width: 370px;
        background: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        border: 2px solid #000077;
        margin: 0 auto;
    }
    
    .id-header {
        background: #ffffff;
        padding: 0;
        text-align: center;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    
    .id-header::before {
        display: none;
    }
    
    .id-header-logo {
        width: 100%;
        height: 160px;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 2;
        background: #ffffff;
        border-radius: 0;
        padding: 10px 15px;
    }
    
    .id-header-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        max-width: 100%;
        max-height: 160px;
    }
    
    .logo-placeholder {
        width: 100%;
        height: 160px;
        background: #f0f0f0;
        border: none;
        border-radius: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #000077;
        font-size: 24px;
        text-align: center;
    }
    
    .id-header-text {
        text-align: center;
        position: relative;
        z-index: 3;
        background: linear-gradient(135deg, #000077 0%, #000099 100%);
        padding: 10px 15px;
        width: 100%;
    }
    
    .id-header-text .card-type {
        font-size: 14px;
        color: #ffffff;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }
    
    .id-body {
        padding: 15px;
        display: flex;
        gap: 15px;
        align-items: flex-start;
        background: #ffffff;
    }
    
    .photo-section {
        flex: 0 0 100px;
    }
    
    .photo-container {
        width: 100px;
        height: 120px;
        border: 3px solid #000077;
        border-radius: 6px;
        background: #f8f9fa;
        overflow: hidden;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
    }
    
    .photo-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    
    .photo-placeholder {
        width: 100%;
        height: 100%;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
    }
    
    .photo-placeholder i {
        font-size: 35px;
    }
    
    .info-section {
        flex: 1;
        min-width: 0;
    }
    
    .center-name {
        font-size: 16px;
        font-weight: 700;
        color: #000077;
        margin: 0 0 10px 0;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        line-height: 1.2;
    }
    
    .center-info {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        padding: 10px;
    }
    
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 6px 0;
        border-bottom: 1px solid #f3f4f6;
    }
    
    .info-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    
    .info-label {
        font-weight: 600;
        color: #374151;
        display: flex;
        align-items: center;
        gap: 6px;
        flex: 0 0 85px;
        font-size: 10px;
    }
    
    .info-label i {
        color: #000077;
        font-size: 12px;
        width: 14px;
        text-align: center;
        flex-shrink: 0;
    }
    
    .info-value {
        font-weight: 600;
        color: #1f2937;
        text-align: right;
        flex: 1;
        word-break: break-word;
        font-size: 10px;
        line-height: 1.3;
    }
    
    .id-footer {
        background: linear-gradient(135deg, #000077 0%, #000099 50%, #ffd700 100%);
        padding: 10px 15px;
        position: relative;
        overflow: hidden;
    }
    
    .id-footer::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 15px;
        background: repeating-linear-gradient(
            45deg,
            #000077,
            #000077 8px,
            #ffd700 8px,
            #ffd700 16px
        );
        opacity: 0.3;
    }
    
    .signature-section {
        text-align: center;
        position: relative;
        z-index: 1;
    }
    
    .signature-line {
        width: 100px;
        height: 2px;
        background: #ffffff;
        margin: 0 auto 4px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }
    
    .signature-label {
        font-size: 9px;
        font-weight: 600;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }
    
    @media print {
        body {
            background: white;
            padding: 0;
        }
        
        .print-container {
            box-shadow: none;
            padding: 0;
            max-width: 100%;
        }
        
        .id-card {
            box-shadow: none;
            border: 2px solid #000077;
        }
        
        .id-header, .id-body, .id-footer {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
    
    @media (max-width: 480px) {
        body {
            padding: 20px 10px;
        }
        
        .print-container {
            padding: 20px;
        }
        
        .id-body {
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        
        .photo-section {
            flex: 0 0 auto;
        }
        
        .photo-container {
            width: 110px;
            height: 140px;
        }
        
        .info-section {
            width: 100%;
        }
        
        .center-name {
            text-align: center;
            font-size: 18px;
        }
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<div class="print-container">
    <div class="id-card">
        <div class="id-header">
            <div class="id-header-logo">
                @php
                    $siteSettings = site_settings();
                    $logoPath = null;
                    $siteName = 'MAYA COMPUTER CENTER';
                    
                    if($siteSettings) {
                        $logoPath = !empty($siteSettings->site_logo) ? $siteSettings->site_logo : null;
                        $siteName = !empty($siteSettings->name) ? $siteSettings->name : 'MAYA COMPUTER CENTER';
                    }
                    
                    $logoExists = false;
                    if($logoPath) {
                        $fullPath = public_path($logoPath);
                        $logoExists = file_exists($fullPath);
                    }
                @endphp
                @if($logoExists)
                    <img src="{{ asset($logoPath) }}" alt="{{ $siteName }} Logo" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="logo-placeholder" style="display: none;">{{ substr($siteName, 0, 5) }}</div>
                @else
                    <div class="logo-placeholder">{{ substr($siteName, 0, 5) }}</div>
                @endif
            </div>
            <div class="id-header-text">
                <div class="card-type">Center ID Card</div>
            </div>
        </div>
        
        <div class="id-body">
            <div class="info-section">
                <div class="center-name">{{ $data->cl_center_name ?? 'N/A' }}</div>
                
                <div class="center-info">
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-hashtag"></i>
                            <span>Center Code:</span>
                        </div>
                        <div class="info-value">{{ $data->cl_code ?? 'N/A' }}</div>
                    </div>
                    
                    @if($data->cl_director_name)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-user-tie"></i>
                            <span>Director:</span>
                        </div>
                        <div class="info-value">{{ $data->cl_director_name }}</div>
                    </div>
                    @endif
                    
                    @if($data->cl_center_address)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Address:</span>
                        </div>
                        <div class="info-value" style="font-size: 9px;">{{ $data->cl_center_address }}</div>
                    </div>
                    @endif
                    
                    @if($data->cl_email)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-envelope"></i>
                            <span>Email:</span>
                        </div>
                        <div class="info-value" style="font-size: 9px;">{{ $data->cl_email }}</div>
                    </div>
                    @endif
                    
                    @if($data->cl_mobile)
                    <div class="info-row">
                        <div class="info-label">
                            <i class="fas fa-phone"></i>
                            <span>Mobile:</span>
                        </div>
                        <div class="info-value">{{ $data->cl_mobile }}</div>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="photo-section">
                <div class="photo-container">
                    @if(!empty($data->cl_photo))
                        <img src="{{ asset($data->cl_photo) }}" alt="Center Photo" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'photo-placeholder\'><i class=\'fas fa-building\'></i></div>';">
                    @else
                        <div class="photo-placeholder">
                            <i class="fas fa-building"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="id-footer">
            <div class="signature-section">
                <div class="signature-line"></div>
                <div class="signature-label">Authorized Signatory</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

