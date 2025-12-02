<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admit Card - Maya Computer Center</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            padding: 20px;
        }

        .admit-card {
            width: 8.5in;
            height: 5.6in;
            background: #fff;
            margin: 0 auto;
            padding: 15px 25px;
            border: 1px solid #ccc;
            position: relative;
        }

        /* Header Section */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 5px;
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
            font-weight: bold;
            color: #1a5276;
            letter-spacing: 2px;
        }

        .main-title-hindi {
            font-size: 22px;
            font-weight: bold;
            color: #1a5276;
            margin-top: 2px;
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
            color: #e74c3c;
            font-weight: bold;
            margin-top: 3px;
        }

        .admit-title {
            font-size: 14px;
            color: #c0392b;
            font-weight: bold;
            margin-top: 3px;
        }

        .header-right {
            text-align: right;
        }

        .qr-code {
            width: 70px;
            height: 70px;
            border: 1px solid #ddd;
        }

        /* Watermark */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 120px;
            color: rgba(200, 200, 200, 0.15);
            font-weight: bold;
            pointer-events: none;
            z-index: 0;
        }

        /* Registration Row */
        .reg-row {
            display: flex;
            background: linear-gradient(to bottom, #2980b9, #1a5276);
            color: #fff;
            font-weight: bold;
            font-size: 13px;
            margin-top: 10px;
        }

        .reg-row div {
            padding: 8px 15px;
            flex: 1;
        }

        .reg-row div:first-child {
            border-right: 1px solid #fff;
        }

        /* Student Details Section */
        .student-section {
            display: flex;
            background: linear-gradient(to bottom, #d6eaf8, #aed6f1);
            position: relative;
            z-index: 1;
        }

        .student-details {
            flex: 1;
            padding: 8px 0;
        }

        .detail-row {
            display: flex;
            padding: 4px 15px;
            font-size: 12px;
        }

        .detail-label {
            width: 140px;
            font-weight: bold;
            color: #1a5276;
            text-align: right;
            padding-right: 10px;
        }

        .detail-value {
            flex: 1;
            color: #333;
            font-weight: 600;
        }

        .detail-row-multi {
            display: flex;
            padding: 4px 15px;
            font-size: 12px;
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
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .photo-box {
            width: 90px;
            height: 110px;
            border: 1px dashed #1a5276;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #fff;
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
            color: #1a5276;
            margin-top: 5px;
            border-top: 1px solid #1a5276;
            padding-top: 3px;
            width: 90px;
            text-align: center;
        }

        /* Exam Details Table */
        .exam-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            position: relative;
            z-index: 1;
        }

        .exam-table thead {
            background: linear-gradient(to bottom, #1a3a5c, #0d2840);
            color: #fff;
        }

        .exam-table th {
            padding: 8px 10px;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            border: 1px solid #0d2840;
        }

        .exam-table td {
            padding: 8px 10px;
            font-size: 11px;
            text-align: center;
            border: 1px solid #ddd;
            background: #fff;
        }

        /* Note Section */
        .note-section {
            margin-top: 15px;
            font-size: 10px;
            color: #333;
            line-height: 1.4;
            position: relative;
            z-index: 1;
        }

        .note-section span {
            color: #c0392b;
        }

        /* Footer Section */
        .footer-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
            position: relative;
            z-index: 1;
        }

        .controller-sign {
            text-align: center;
        }

        .sign-line {
            width: 150px;
            border-top: 1px solid #333;
            margin-bottom: 5px;
        }

        .sign-text {
            font-size: 12px;
            font-weight: bold;
            color: #333;
        }

        @media print {
            body {
                background: #fff;
                padding: 0;
            }

            .admit-card {
                border: none;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="admit-card">
        <!-- Watermark -->
        <div class="watermark">TM</div>

        <!-- Header Section -->
        <div class="header">
            <div class="header-left">
                <img src="document/images/logo.png" alt="Logo" class="logo">
            </div>
            <div class="header-center">
                <div class="main-title">MAYA COMPUTER CENTER</div>
                <div class="main-title-hindi">माया कम्प्यूटर सेंटर</div>
                <div class="cin-text">CIN:<br>U47411DL2023PTC422329</div>
                <div class="reg-text">Reg. Under the Company Act.2013 MCA, Government of India</div>
                <div class="sub-reg-text">Registered Under Skill India, Udyam & Startup India</div>
                <div class="iso-text">An ISO 9001: 2015 Certified</div>
                <div class="admit-title">प्रवेश पत्र (ADMIT CARD) – 2024</div>
            </div>
            <div class="header-right">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=70x70&data=611230010001" alt="QR Code" class="qr-code">
            </div>
        </div>

        <!-- Registration Row -->
        <div class="reg-row">
            <div>Registration No.: <span>611230010001</span></div>
            <div>Registration Years: <span>2024</span></div>
        </div>

        <!-- Student Details Section -->
        <div class="student-section">
            <div class="student-details">
                <div class="detail-row">
                    <div class="detail-label">Student Name:</div>
                    <div class="detail-value">PRACHI KUMARI</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Father's Name:</div>
                    <div class="detail-value">PAPPU SAH</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Mother's Name:</div>
                    <div class="detail-value">AARTI KUMARI</div>
                </div>
                <div class="detail-row-multi">
                    <div class="detail-label">Date of Birth:</div>
                    <div class="detail-value">10/01/2010</div>
                    <div class="detail-label" style="width: 60px;">Gender:</div>
                    <div class="detail-value">Female</div>
                    <div class="detail-label" style="width: 70px;">Category:</div>
                    <div class="detail-value">EBC</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Center Code & Name:</div>
                    <div class="detail-value">61123001- XYZ COMPUTER CENTER, PHULPARAS</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Course Name:</div>
                    <div class="detail-value">Diploma in Computer Application (DCA)</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Course Duration:</div>
                    <div class="detail-value">6 Months</div>
                </div>
            </div>
            <div class="photo-section">
                <div class="photo-box">
                    <span class="photo-text">Picture</span>
                    <span class="photo-size">3.5X4.5CM</span>
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
                    <td>25/03/2025</td>
                    <td>10:30 AM To 12:30 PM</td>
                    <td>XYZ COMPUTER CENTER, PHULPARAS</td>
                    <td>Phulparas, Madhubani, Bihar</td>
                </tr>
            </tbody>
        </table>

        <!-- Note Section -->
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

    <script>
        // Auto print on load (optional)
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>

