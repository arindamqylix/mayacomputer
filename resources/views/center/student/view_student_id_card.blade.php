<!-- <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Student ID Card</title>
	<style>
		body {
			font-family: 'Segoe UI', sans-serif;
			background: #f3f3f3;
			display: flex;
			justify-content: center;
			padding: 30px;
		}

		.id-card-holder {
			width: 300px;
			background: #fff;
			border-radius: 12px;
			box-shadow: 0 4px 15px rgba(0,0,0,0.2);
			overflow: hidden;
			text-align: center;
			padding: 15px;
			position: relative;
		}

		.header img {
			width: 140px;
			display: block;
			margin: 5px auto 10px;
		}

		.photo {
			margin: 12px 0;
		}
		.photo img {
			width: 95px;
			height: 115px;
			object-fit: cover;
			border-radius: 6px;
			border: 3px solid #2a3042;
			background: #eee;
		}

		h2 {
			font-size: 18px;
			margin: 6px 0 2px;
			font-weight: 600;
			color: #2a3042;
		}

		h3 {
			font-size: 13px;
			margin: 2px 0;
			color: #444;
			font-weight: 500;
		}

		.details {
			text-align: left;
			margin: 12px 0;
			font-size: 12px;
			color: #333;
			line-height: 1.4;
		}
		.details p { margin: 4px 0; }

		.qr-code {
			margin-top: 10px;
		}
		.qr-code img {
			width: 70px;
			height: 70px;
			border: 1px solid #ccc;
			border-radius: 5px;
			padding: 4px;
			background: #fff;
		}

		.signature {
			margin-top: 14px;
			font-size: 12px;
			text-align: right;
			color: #222;
		}
		.signature p {
			margin: 3px 0;
		}

		.footer {
			margin-top: 8px;
			font-size: 11px;
			color: #666;
			text-align: center;
			border-top: 1px solid #ddd;
			padding-top: 6px;
		}

		.print-btn {
			margin-top: 20px;
			padding: 8px 20px;
			border: none;
			background: #0073e6;
			color: #fff;
			font-size: 14px;
			font-weight: 500;
			border-radius: 6px;
			cursor: pointer;
		}

		@media print {
			.print-btn { display: none; }
			body { background: none; }
		}
	</style>
</head>
<body>
	<div class="id-card-holder">
		<div class="header">
			<img src="https://mayacomputercenter.in/images/header.png" alt="Institute Logo">
		</div>

		<div class="photo">
			<img src="{{ asset('center/student_doc/').'/'.$data->sl_photo }}" alt="Student Photo">
		</div>

		<h2>{{ $data->sl_name }}</h2>
		<h3>Reg. No: {{ $data->sl_reg_no }}</h3>
		<h3>Course: {{ $data->c_short_name }}</h3>

		<div class="qr-code">
			<img src="{{ asset('center/student_doc/qr/'.$data->sl_reg_no.'.png') }}" alt="QR Code">
		</div>

		<div class="details">
			<p><b>{{ $data->cl_center_name }}</b></p>
			<p>{{ $data->cl_center_address }}</p>
			<p>Ph: {{ $data->cl_mobile }}</p>
		</div>

		<div class="signature">
			<p>___________________</p>
			<p><b>Authorized Signature</b></p>
		</div>

		<div class="footer">
			<p><em>Valid for academic year only</em></p>
		</div>
	</div>

	<center>
		<button class="print-btn" onclick="this.style.display='none'; window.print();">Print</button>
	</center>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student ID Card</title>
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: #e9ecef;
    }
    .id-card {
        width: 350px;
        height: 520px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.25);
        overflow: hidden;
        margin: 30px auto;
        position: relative;
        border: 3px solid #2a3042;
    }
    .id-header {
        background: #2a3042;
        color: #fff;
        text-align: center;
        padding: 18px 10px;
    }
    .id-header img {
        width: 70px;
        display: block;
        margin: 0 auto 10px;
    }
    .id-header h2 {
        font-size: 20px;
        margin: 0;
        letter-spacing: 1px;
    }
    .id-body {
        padding: 20px;
        text-align: center;
    }
    .photo {
        width: 110px;
        height: 130px;
        border: 2px solid #2a3042;
        margin: 0 auto 15px;
        background: #eee;
        border-radius: 6px;
        overflow: hidden;
    }
    .photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .id-body h3 {
        margin: 8px 0 4px;
        font-size: 20px;
        color: #2a3042;
    }
    .id-body p {
        margin: 2px 0;
        font-size: 14px;
        color: #444;
    }
    .details {
        text-align: left;
        margin-top: 18px;
        font-size: 14px;
        line-height: 1.5;
    }
    .details p {
        margin: 6px 0;
    }
    .details b {
        color: #2a3042;
    }
    .id-footer {
        position: absolute;
        bottom: 20px;
        left: 20px;
        right: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .id-footer .qr {
        width: 65px;
        height: 65px;
        border: 1px solid #2a3042;
        border-radius: 4px;
        overflow: hidden;
    }
    .id-footer .qr img {
        width: 100%;
        height: 100%;
    }
    .id-footer .sign {
        text-align: right;
        font-size: 13px;
    }
    .id-footer .sign p {
        margin: 4px 0;
    }
    .id-footer .sign b {
        color: #2a3042;
    }
</style>
</head>
<body>
    <div class="id-card">
        <div class="id-header">
            <img src="logo.png" alt="Logo">
            <h2>MAYA COMPUTER CENTER PVT LTD</h2>
        </div>
        <div class="id-body">
            <div class="photo">
                <img src="{{asset('storage/student/'.$data->sl_photo)}}" alt="Student Photo">
            </div>
            <h3>{{ $data->sl_name??'' }}</h3>
            <p><b>Reg No:</b> {{ $data->sl_reg_no }}</p>
            <div class="details">
                <p><b>Course:</b> {{ $data->c_short_name }}</p>
                <!-- <p><b>Batch:</b> 2024-25</p> -->
                <p><b>DOB:</b> {{$data->sl_dob??''}}</p>
                <p><b>Contact:</b> {{ $data->sl_mobile_no }}</p>
            </div>
        </div>
        <div class="id-footer">
            <div>
                <!-- <img src="qrcode.png" alt="QR Code"> -->
            </div>
            <div class="sign">
                <p>________________</p>
                <p><b>Principal</b></p>
            </div>
        </div>
    </div>
</body>
</html>
