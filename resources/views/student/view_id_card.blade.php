<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student ID Card</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #eee;
    }
    .id-card {
        width: 350px;
        height: 500px;
        background: #fff;
        border: 2px solid #000080;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        margin: 40px auto;
        padding: 15px;
        position: relative;
    }
    .id-card header {
        text-align: center;
        border-bottom: 2px solid #000080;
        padding-bottom: 10px;
    }
    .id-card header img {
        width: 236px;
        margin-bottom: 5px;
    }
    .id-card header h1 {
        font-size: 18px;
        margin: 0;
        color: #000080;
    }
    .id-card header h2 {
        font-size: 14px;
        margin: 0;
        color: #d00000;
    }
    .profile {
        text-align: center;
        margin: 15px 0;
    }
    .profile img {
        width: 100px;
        height: 120px;
        border: 2px solid #000;
        border-radius: 6px;
    }
    .details {
        font-size: 14px;
        line-height: 1.6;
        padding: 0 10px;
    }
    .details strong {
        display: inline-block;
        width: 100px;
        color: #000080;
    }
    .footer {
        position: absolute;
        bottom: 15px;
        left: 0;
        right: 0;
        text-align: center;
    }
    .footer img {
        width: 70px;
        margin: 5px;
    }
    .qr {
        position: absolute;
        bottom: 15px;
        right: 15px;
    }
    .qr img {
        width: 70px;
    }
</style>
</head>
<body>

<div class="id-card">
    <header>
        <img src="{{asset('document/images/logo.png')}}" alt="Logo">
        <h2>Student ID Card</h2>
    </header>

    <div class="profile">
        <img src="{{ asset('storage/student/').'/'.$data->sl_photo }}" alt="Student Photo">
    </div>

    <div class="details">
        <p><strong>Name:</strong> {{ $data->sl_name }}</p>
        <p><strong>Course:</strong> {{ $data->c_short_name }}</p>
        <p><strong>Reg. No:</strong> {{ $data->sl_reg_no }}</p>
        <p><strong>DOB:</strong> {{$data->sl_dob}}</p>
        <p><strong>Mobile:</strong> {{ $data->cl_mobile }}</p>
        <p><strong>Center:</strong> {{ $data->cl_center_name }} - {{ $data->cl_code }}</p>
    </div>

    <!-- <div class="footer">
        <img src="sign.png" alt="Authorized Sign">
        <p>Authorized Signatory</p>
    </div> -->

</div>

</body>
</html>
