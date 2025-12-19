<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student ID Card - {{ $data->sl_name ?? 'Student' }}</title>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
		
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
			padding: 20px;
		}
		
		.print-container {
			background: white;
			border-radius: 20px;
			box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
			padding: 2rem;
			max-width: 400px;
			width: 100%;
		}
		
		.id-card {
			width: 100%;
			height: auto;
			background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
			border-radius: 15px;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
			overflow: hidden;
			position: relative;
			border: 3px solid #2563eb;
		}
		
		.id-header {
			background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
			color: #fff;
			text-align: center;
			padding: 20px 15px;
			position: relative;
			overflow: hidden;
		}
		
		.id-header::before {
			content: '';
			position: absolute;
			top: -50%;
			right: -20%;
			width: 200px;
			height: 200px;
			background: rgba(255, 255, 255, 0.1);
			border-radius: 50%;
		}
		
		.id-header::after {
			content: '';
			position: absolute;
			bottom: -30%;
			left: -10%;
			width: 150px;
			height: 150px;
			background: rgba(255, 255, 255, 0.05);
			border-radius: 50%;
		}
		
		.id-header img {
			width: 80px;
			height: auto;
			display: block;
			margin: 0 auto 10px;
			position: relative;
			z-index: 1;
			filter: brightness(0) invert(1);
		}
		
		.id-header h2 {
			font-size: 18px;
			margin: 0;
			letter-spacing: 1px;
			font-weight: 700;
			position: relative;
			z-index: 1;
			text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
		}
		
		.id-body {
			padding: 25px 20px;
			text-align: center;
			position: relative;
		}
		
		.photo-container {
			margin: 0 auto 20px;
			width: 120px;
			height: 140px;
			border: 4px solid #2563eb;
			border-radius: 10px;
			background: #f8f9fa;
			overflow: hidden;
			box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
			position: relative;
		}
		
		.photo-container::before {
			content: '';
			position: absolute;
			top: -2px;
			left: -2px;
			right: -2px;
			bottom: -2px;
			background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
			border-radius: 10px;
			z-index: -1;
		}
		
		.photo-container img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			display: block;
		}
		
		.student-name {
			font-size: 22px;
			font-weight: 700;
			color: #1e3a8a;
			margin: 15px 0 10px;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}
		
		.student-info {
			background: #f8f9ff;
			border-radius: 10px;
			padding: 15px;
			margin-top: 15px;
			text-align: left;
		}
		
		.info-row {
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 8px 0;
			border-bottom: 1px solid #e9ecef;
		}
		
		.info-row:last-child {
			border-bottom: none;
		}
		
		.info-label {
			font-weight: 600;
			color: #495057;
			font-size: 13px;
			display: flex;
			align-items: center;
			gap: 8px;
		}
		
		.info-label i {
			color: #2563eb;
			font-size: 14px;
		}
		
		.info-value {
			font-weight: 500;
			color: #1e3a8a;
			font-size: 13px;
			text-align: right;
		}
		
		.id-footer {
			display: flex;
			justify-content: space-between;
			align-items: flex-end;
			padding: 20px;
			border-top: 2px solid #e9ecef;
			margin-top: 15px;
		}
		
		.qr-section {
			display: flex;
			flex-direction: column;
			align-items: center;
			gap: 8px;
		}
		
		.qr-code {
			width: 80px;
			height: 80px;
			border: 2px solid #2563eb;
			border-radius: 8px;
			overflow: hidden;
			background: white;
			padding: 5px;
			box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
		}
		
		.qr-code img {
			width: 100%;
			height: 100%;
			object-fit: contain;
		}
		
		.qr-label {
			font-size: 10px;
			color: #6c757d;
			font-weight: 600;
			text-transform: uppercase;
		}
		
		.signature-section {
			text-align: right;
			flex: 1;
		}
		
		.signature-line {
			width: 120px;
			height: 2px;
			background: #2563eb;
			margin: 0 0 5px auto;
			border-radius: 2px;
		}
		
		.signature-label {
			font-size: 12px;
			color: #1e3a8a;
			font-weight: 700;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}
		
		.validity-note {
			text-align: center;
			margin-top: 15px;
			padding-top: 15px;
			border-top: 1px dashed #dee2e6;
			font-size: 11px;
			color: #6c757d;
			font-style: italic;
		}
		
		.action-buttons {
			text-align: center;
			margin-top: 30px;
			display: flex;
			gap: 15px;
			justify-content: center;
		}
		
		.btn-print {
			background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
			color: white;
			border: none;
			padding: 12px 30px;
			border-radius: 10px;
			font-weight: 600;
			font-size: 14px;
			cursor: pointer;
			box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
			transition: all 0.3s ease;
			display: inline-flex;
			align-items: center;
			gap: 8px;
		}
		
		.btn-print:hover {
			transform: translateY(-2px);
			box-shadow: 0 6px 16px rgba(37, 99, 235, 0.5);
		}
		
		.btn-back {
			background: #6c757d;
			color: white;
			border: none;
			padding: 12px 30px;
			border-radius: 10px;
			font-weight: 600;
			font-size: 14px;
			cursor: pointer;
			box-shadow: 0 4px 12px rgba(108, 117, 125, 0.4);
			transition: all 0.3s ease;
			text-decoration: none;
			display: inline-flex;
			align-items: center;
			gap: 8px;
		}
		
		.btn-back:hover {
			transform: translateY(-2px);
			box-shadow: 0 6px 16px rgba(108, 117, 125, 0.5);
			color: white;
			text-decoration: none;
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
			
			.action-buttons {
				display: none;
			}
			
			.id-card {
				box-shadow: none;
				border: 2px solid #2563eb;
			}
			
			@page {
				margin: 0;
				size: A4 landscape;
			}
		}
	</style>
</head>
<body>
	<div class="print-container">
		<div class="id-card">
			<div class="id-header">
				@if(file_exists(public_path('logo.png')))
					<img src="{{ asset('logo.png') }}" alt="Maya Computer Center Logo">
				@else
					<div style="width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 10px; margin: 0 auto 10px;"></div>
				@endif
				<h2>MAYA COMPUTER CENTER PVT LTD</h2>
			</div>
			
			<div class="id-body">
				<div class="photo-container">
					@if(!empty($data->sl_photo))
						<img src="{{ asset('storage/student/'.$data->sl_photo) }}" alt="Student Photo" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
						<div style="display: none; width: 100%; height: 100%; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 12px;">No Photo</div>
					@else
						<div style="width: 100%; height: 100%; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 12px;">No Photo</div>
					@endif
				</div>
				
				<div class="student-name">{{ $data->sl_name ?? 'N/A' }}</div>
				
				<div class="student-info">
					<div class="info-row">
						<div class="info-label">
							<i class="fas fa-hashtag"></i>
							<span>Registration No:</span>
						</div>
						<div class="info-value">{{ $data->sl_reg_no ?? 'N/A' }}</div>
					</div>
					<div class="info-row">
						<div class="info-label">
							<i class="fas fa-graduation-cap"></i>
							<span>Course:</span>
						</div>
						<div class="info-value">{{ $data->c_short_name ?? 'N/A' }}</div>
					</div>
					@if($data->sl_dob)
					<div class="info-row">
						<div class="info-label">
							<i class="fas fa-birthday-cake"></i>
							<span>Date of Birth:</span>
						</div>
						<div class="info-value">{{ \Carbon\Carbon::parse($data->sl_dob)->format('d M, Y') }}</div>
					</div>
					@endif
					@if($data->sl_mobile_no)
					<div class="info-row">
						<div class="info-label">
							<i class="fas fa-phone"></i>
							<span>Contact:</span>
						</div>
						<div class="info-value">{{ $data->sl_mobile_no }}</div>
					</div>
					@endif
					@if($data->cl_center_name)
					<div class="info-row">
						<div class="info-label">
							<i class="fas fa-building"></i>
							<span>Center:</span>
						</div>
						<div class="info-value" style="font-size: 11px;">{{ $data->cl_center_name }}</div>
					</div>
					@endif
				</div>
			</div>
			
			<div class="id-footer">
				<div class="qr-section">
					@if(file_exists(public_path('center/student_doc/qr/'.$data->sl_reg_no.'.png')))
						<div class="qr-code">
							<img src="{{ asset('center/student_doc/qr/'.$data->sl_reg_no.'.png') }}" alt="QR Code">
						</div>
						<div class="qr-label">Scan QR Code</div>
					@else
						<div class="qr-code" style="display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 10px;">
							No QR
						</div>
						<div class="qr-label">QR Code</div>
					@endif
				</div>
				
				<div class="signature-section">
					<div class="signature-line"></div>
					<div class="signature-label">Principal</div>
				</div>
			</div>
			
			<div class="validity-note">
				<em>Valid for academic year only</em>
			</div>
		</div>
		
		<div class="action-buttons">
			<a href="{{ route('student_id_card') }}" class="btn-back">
				<i class="fas fa-arrow-left"></i>
				Back to List
			</a>
			<button class="btn-print" onclick="window.print();">
				<i class="fas fa-print"></i>
				Print ID Card
			</button>
		</div>
	</div>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>
