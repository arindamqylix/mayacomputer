<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admit Card - {{ $student->sl_name ?? 'Student' }}</title>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
		
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		
		body {
			font-family: 'Poppins', sans-serif;
			background: #f0f0f0;
			padding: 20px;
		}
		
		.print-container {
			background: white;
			border-radius: 15px;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
			padding: 2rem;
			max-width: 8.5in;
			margin: 0 auto;
		}
		
		.admit-card {
			width: 100%;
			background: #fff;
			border: 3px solid #2563eb;
			border-radius: 10px;
			padding: 20px 25px;
			position: relative;
			overflow: hidden;
		}
		
		/* Watermark */
		.watermark {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%) rotate(-45deg);
			font-size: 120px;
			color: rgba(37, 99, 235, 0.05);
			font-weight: bold;
			pointer-events: none;
			z-index: 0;
		}
		
		/* Header Section */
		.header {
			display: flex;
			justify-content: space-between;
			align-items: flex-start;
			margin-bottom: 15px;
			position: relative;
			z-index: 1;
		}
		
		.header-left {
			display: flex;
			align-items: flex-start;
		}
		
		.logo {
			width: 80px;
			height: auto;
			margin-right: 10px;
		}
		
		.header-center {
			text-align: center;
			flex: 1;
		}
		
		.main-title {
			font-size: 28px;
			font-weight: 700;
			color: #1e3a8a;
			letter-spacing: 2px;
			margin-bottom: 5px;
		}
		
		.main-title-hindi {
			font-size: 22px;
			font-weight: 700;
			color: #1e3a8a;
			margin-bottom: 5px;
		}
		
		.cin-text {
			font-size: 9px;
			color: #333;
			margin-top: 5px;
		}
		
		.reg-text {
			font-size: 11px;
			color: #333;
			margin-top: 2px;
		}
		
		.sub-reg-text {
			font-size: 10px;
			color: #333;
		}
		
		.iso-text {
			font-size: 12px;
			color: #dc2626;
			font-weight: bold;
			margin-top: 3px;
		}
		
		.admit-title {
			font-size: 16px;
			color: #dc2626;
			font-weight: bold;
			margin-top: 8px;
			text-transform: uppercase;
		}
		
		.header-right {
			text-align: right;
		}
		
		.qr-code {
			width: 70px;
			height: 70px;
			border: 2px solid #2563eb;
			border-radius: 5px;
			padding: 5px;
			background: white;
		}
		
		.qr-code img {
			width: 100%;
			height: 100%;
		}
		
		/* Registration Row */
		.reg-row {
			display: flex;
			background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
			color: #fff;
			font-weight: 600;
			font-size: 13px;
			margin-top: 15px;
			border-radius: 5px;
			overflow: hidden;
			position: relative;
			z-index: 1;
		}
		
		.reg-row div {
			padding: 10px 15px;
			flex: 1;
		}
		
		.reg-row div:first-child {
			border-right: 1px solid rgba(255, 255, 255, 0.3);
		}
		
		/* Student Details Section */
		.student-section {
			display: flex;
			background: linear-gradient(135deg, #f8f9ff 0%, #e9ecef 100%);
			border-radius: 8px;
			margin-top: 15px;
			position: relative;
			z-index: 1;
		}
		
		.student-details {
			flex: 1;
			padding: 15px 0;
		}
		
		.detail-row {
			display: flex;
			padding: 6px 15px;
			font-size: 12px;
		}
		
		.detail-label {
			width: 140px;
			font-weight: 600;
			color: #1e3a8a;
			text-align: right;
			padding-right: 10px;
		}
		
		.detail-value {
			flex: 1;
			color: #333;
			font-weight: 500;
		}
		
		.detail-row-multi {
			display: flex;
			padding: 6px 15px;
			font-size: 12px;
			flex-wrap: wrap;
		}
		
		.detail-row-multi .detail-label {
			width: 140px;
		}
		
		.detail-row-multi .detail-value {
			width: auto;
			margin-right: 20px;
		}
		
		.photo-section {
			width: 120px;
			padding: 15px;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
		}
		
		.photo-box {
			width: 90px;
			height: 110px;
			border: 2px solid #2563eb;
			border-radius: 5px;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			background: #fff;
			overflow: hidden;
		}
		
		.photo-box img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}
		
		.photo-text {
			font-size: 10px;
			color: #666;
		}
		
		.photo-size {
			font-size: 9px;
			color: #888;
		}
		
		.student-sign {
			font-size: 10px;
			color: #1e3a8a;
			margin-top: 8px;
			border-top: 1px solid #2563eb;
			padding-top: 5px;
			width: 90px;
			text-align: center;
			font-weight: 600;
		}
		
		/* Exam Details Table */
		.exam-table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 15px;
			position: relative;
			z-index: 1;
			border-radius: 8px;
			overflow: hidden;
		}
		
		.exam-table thead {
			background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
			color: #fff;
		}
		
		.exam-table th {
			padding: 10px;
			font-size: 12px;
			font-weight: 600;
			text-align: center;
			border: 1px solid rgba(255, 255, 255, 0.2);
		}
		
		.exam-table td {
			padding: 10px;
			font-size: 11px;
			text-align: center;
			border: 1px solid #dee2e6;
			background: #fff;
			font-weight: 500;
		}
		
		/* Note Section */
		.note-section {
			margin-top: 15px;
			font-size: 10px;
			color: #333;
			line-height: 1.6;
			position: relative;
			z-index: 1;
			background: #fff3cd;
			padding: 12px;
			border-radius: 5px;
			border-left: 4px solid #ffc107;
		}
		
		.note-section strong {
			color: #1e3a8a;
		}
		
		.note-section span {
			color: #dc2626;
			font-weight: 600;
		}
		
		/* Footer Section */
		.footer-section {
			display: flex;
			justify-content: flex-end;
			margin-top: 25px;
			position: relative;
			z-index: 1;
		}
		
		.controller-sign {
			text-align: center;
		}
		
		.sign-line {
			width: 150px;
			border-top: 2px solid #2563eb;
			margin-bottom: 5px;
		}
		
		.sign-text {
			font-size: 12px;
			font-weight: 700;
			color: #1e3a8a;
		}
		
		/* Action Buttons */
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
				background: #fff;
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
			
			.admit-card {
				border: 2px solid #2563eb;
				box-shadow: none;
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
		<div class="admit-card">
			<!-- Watermark -->
			<div class="watermark">ADMIT CARD</div>
			
			<!-- Header Section -->
			<div class="header">
				<div class="header-left">
					@if(file_exists(public_path('logo.png')))
						<img src="{{ asset('logo.png') }}" alt="Logo" class="logo">
					@else
						<div style="width: 80px; height: 80px; background: #2563eb; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">MCC</div>
					@endif
				</div>
				<div class="header-center">
					<div class="main-title">MAYA COMPUTER CENTER</div>
					<div class="main-title-hindi">माया कम्प्यूटर सेंटर</div>
					<div class="cin-text">CIN: U47411DL2023PTC422329</div>
					<div class="reg-text">Reg. Under the Company Act.2013 MCA, Government of India</div>
					<div class="sub-reg-text">Registered Under Skill India, Udyam & Startup India</div>
					<div class="iso-text">An ISO 9001: 2015 Certified</div>
					<div class="admit-title">प्रवेश पत्र (ADMIT CARD)</div>
				</div>
				<div class="header-right">
					@if(file_exists(public_path('center/student_doc/qr/'.$admit->reg_no.'.png')))
						<div class="qr-code">
							<img src="{{ asset('center/student_doc/qr/'.$admit->reg_no.'.png') }}" alt="QR Code">
						</div>
					@else
						<div class="qr-code" style="display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 10px;">
							QR Code
						</div>
					@endif
				</div>
			</div>
			
			<!-- Registration Row -->
			<div class="reg-row">
				<div>Registration No.: <span>{{ $admit->reg_no ?? $student->sl_reg_no ?? 'N/A' }}</span></div>
				<div>Registration Year: <span>{{ \Carbon\Carbon::parse($admit->created_at ?? now())->format('Y') }}</span></div>
			</div>
			
			<!-- Student Details Section -->
			<div class="student-section">
				<div class="student-details">
					<div class="detail-row">
						<div class="detail-label">Student Name:</div>
						<div class="detail-value">{{ $student->sl_name ?? 'N/A' }}</div>
					</div>
					@if($student->sl_father_name)
					<div class="detail-row">
						<div class="detail-label">Father's Name:</div>
						<div class="detail-value">{{ $student->sl_father_name }}</div>
					</div>
					@endif
					@if($student->sl_mother_name)
					<div class="detail-row">
						<div class="detail-label">Mother's Name:</div>
						<div class="detail-value">{{ $student->sl_mother_name }}</div>
					</div>
					@endif
					<div class="detail-row-multi">
						@if($student->sl_dob)
						<div class="detail-label">Date of Birth:</div>
						<div class="detail-value">{{ \Carbon\Carbon::parse($student->sl_dob)->format('d/m/Y') }}</div>
						@endif
						@if($student->sl_sex)
						<div class="detail-label" style="width: 60px;">Gender:</div>
						<div class="detail-value">{{ $student->sl_sex }}</div>
						@endif
					</div>
					@if($center)
					<div class="detail-row">
						<div class="detail-label">Center Code & Name:</div>
						<div class="detail-value">{{ $center->cl_code ?? '' }} - {{ $center->cl_center_name ?? 'N/A' }}</div>
					</div>
					@endif
					@if($course)
					<div class="detail-row">
						<div class="detail-label">Course Name:</div>
						<div class="detail-value">{{ $course->c_full_name ?? $course->c_short_name ?? 'N/A' }}</div>
					</div>
					@endif
					@if($course && $course->c_duration)
					<div class="detail-row">
						<div class="detail-label">Course Duration:</div>
						<div class="detail-value">{{ $course->c_duration }} Months</div>
					</div>
					@endif
				</div>
				<div class="photo-section">
					<div class="photo-box">
						@if(!empty($student->sl_photo))
							<img src="{{ asset('storage/student/'.$student->sl_photo) }}" alt="Student Photo" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
							<div style="display: none; flex-direction: column; align-items: center; justify-content: center; height: 100%;">
								<span class="photo-text">Picture</span>
								<span class="photo-size">3.5X4.5CM</span>
							</div>
						@else
							<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%;">
								<span class="photo-text">Picture</span>
								<span class="photo-size">3.5X4.5CM</span>
							</div>
						@endif
					</div>
					<div class="student-sign">Student Signature</div>
				</div>
			</div>
			
			<!-- Exam Details Table -->
			<table class="exam-table">
				<thead>
					<tr>
						<th>Date of Exam</th>
						<th>Time of Exam</th>
						<th>Name of Exam Center</th>
						<th>Address</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							@if($admit->exam_date)
								{{ \Carbon\Carbon::parse($admit->exam_date)->format('d/m/Y') }}
							@else
								N/A
							@endif
						</td>
						<td>
							@if($admit->exam_time)
								{{ \Carbon\Carbon::parse($admit->exam_time)->format('h:i A') }}
							@else
								N/A
							@endif
						</td>
						<td>{{ $admit->exam_venue ?? 'N/A' }}</td>
						<td>{{ $center->cl_center_address ?? 'N/A' }}</td>
					</tr>
				</tbody>
			</table>
			
			<!-- Note Section -->
			@if($admit->exam_notice)
			<div class="note-section">
				<strong>Notice:</strong> {{ $admit->exam_notice }}
			</div>
			@endif
			
			<div class="note-section">
				<strong>Note:</strong> Any kind of specific identifying marks made by student in the Answer Book is subject to non evaluation / or shall be treated as <span>Unfairmeans</span>. Bringing of Calculators / Phone or any other electronic gadget in side the examination hall shall be deemed as <span>Unfairmeans</span> & breach of examination rules.
			</div>
			
			<!-- Footer Section -->
			<div class="footer-section">
				<div class="controller-sign">
					<div class="sign-line"></div>
					<div class="sign-text">Controller of Examination</div>
				</div>
			</div>
		</div>
		
		<div class="action-buttons">
			<a href="{{ route('admit_card_list') }}" class="btn-back">
				<i class="fas fa-arrow-left"></i>
				Back to List
			</a>
			<button class="btn-print" onclick="window.print();">
				<i class="fas fa-print"></i>
				Print Admit Card
			</button>
		</div>
	</div>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>
