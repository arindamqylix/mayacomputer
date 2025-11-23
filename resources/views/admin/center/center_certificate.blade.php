
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authorization Certificate</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            background-image: url("{{asset('document/images/certificate_bg.jpg')}}");
            background-size: contain;
            background-repeat: no-repeat;
        }
        .auth-content{
            padding: 100px;
            width: 1000px;
        }
        span{
            font-weight: bolder;
        }
        .red-text{
            color: rgb(211, 1, 46);
        }
        .blue-text{
            color: rgb(31, 26, 100);
        }
    </style>
</head>
<body>
    <div class="auth-content">
        <div class="company-details-serial" style="display: flex; flex-direction: row;">
            <div class="company-details" style="display: flex; flex-direction: column; align-items: center; width: 100%;">
                <div style="display: flex; flex-direction: row;">
                    <div class="company-logo" style="margin-left: 20px;">
                        <img src="{{asset('document/images/logo.png')}}" alt="logo" style="width: 100%;">
                    </div>
                </div>
                <div class="company-info" style="display: flex; flex-direction: row;">
                    <div class="cin" style="display: flex; flex-direction: column; align-items: center;">
                        <div>
                            CIN:
                        </div>
                        <div>
                            U47411DL2023PTC422329
                        </div>
                    </div>
                    <div class="company-address-iso" style="display: flex; flex-direction: column; align-items: center;">
                        <div class="company-address" style="font-weight: bold; display: flex; flex-direction: column; align-items: center;">
                            <div>Regd. Under the Company Act. 2013 Ministry of Corporate Affairs Government of India</div>
                            <div>MSME Registration No. UDYAM-DL-02-0059128, NCS ID: S19E57-2059243605757</div>
                            <div>Skill India Registration No: TP262941, Startap India Registration No:</div>
                        </div>
                        <div class="company-iso" style="font-weight: bold; color: rgb(245, 7, 187);">
                            An <strong>ISO 9001: 2015</strong> Certified
                        </div>
                    </div>
                </div>
            </div>
            <div class="serial" style="display: flex; flex-direction: column; justify-content: flex-end;">
                <img src="{{asset('document/images/top_sill.png')}}" alt="sill" width="220px" height="200px">
                <div style="display: flex; justify-content: center; font-weight: bolder;">Sl No : 00{{$center->cl_id}}</div>
            </div>
        </div>
        <hr style="border: 2px solid rgb(1, 114, 94);">
        <div class="auth-head" style="display: flex; flex-direction: row; justify-content: center;">
            <div style="display: flex; flex-direction: column; align-items: center;">
                <div style="font-weight: bolder; font-size: xx-large;"><u>Authorization Certificate</u></div>
                <div style="font-weight: bold; font-size: large;"><i>This is to certify that</i></div>
                <div class="center-name" style="font-size: x-large; font-weight: bolder;"><i>M/s. Maya Computer Center</i></div>
                <div class="represent" style="font-weight: bold; font-size: large;"><i>Represented by <span style="font-size: x-large;">Mr. Pappu Sah</span></i></div>
            </div>
            <div>
                <img src="{{ asset($data->cl_photo) }}" alt="passport_photo" width="100%" height="100px">
            </div>
        </div>
        <div class="center-details" style="display: flex; flex-direction: column; align-items: center; font-size: large;">
            <div style="font-weight: 500;"><i>Having its Office at </i><span>Siswar Phulparas</span>, Dist : <span>Madhubani</span>, State : <span>Bihar</span>, PIN Code: <span>847409</span></div>
            <div style="font-weight: bold;">Authorised to conduct different academic technical programs</div>
            <div style="font-weight: bold;">under the symbol and banner of</div>
        </div>
        <div style="display: flex; justify-content: center;">
            <div style="color: rgb(31, 26, 100); font-weight: bolder; font-size: x-large; margin-top: 5px;">MAYA COMPUTER CENTER PRIVATE LIMITED</div>
        </div>
        <div class="dates" style="display: flex; flex-direction: row; justify-content: space-around; margin-top: 20px; font-weight: bold; font-size: large;">
            <div>
                
                @php
                    use Carbon\Carbon;
                    $currentDate = Carbon::now();
                    $expirationDate = $currentDate->copy()->addYears(3);
                @endphp
                
                <div><u>Date Of Registration</u></div>
                <div>{{$center->created_at->format('d-M-Y')}}</div>
            </div>
            <div style="color: rgb(1, 114, 94);">
                <div><u>CENTER CODE</u></div>
                <div>{{$center->cl_code}}</div>
            </div>
            <div>
                <div><u>Date Of Expiry</u></div>
                <div>{{ $expirationDate->format('d-M-Y') }}</div>
            </div>
        </div>
        <div class="auth-companies" style="display: flex; flex-direction: row; width: 100%; justify-content: space-evenly; margin-top: 20px;">
            <div style="display: flex; align-content: center; flex-wrap: wrap;">
                <img src="{{asset('document/images/iaf.jpg')}}" alt="iaf" width="100%" height="75px">
            </div>
            <div style="display: flex; align-content: center; flex-wrap: wrap;">
                <img src="{{asset('document/images/MSME-Logo.png')}}" alt="msme" width="100%" height="100px">
            </div>
            <div style="display: flex; align-content: center; flex-wrap: wrap;">
                <img src="{{asset('document/images/iso_cert.png')}}" alt="iso" width="100%" height="75px">
            </div>
            <div style="display: flex; align-content: center; flex-wrap: wrap;">
                <img src="{{asset('document/images/startupindia.jpg')}}" alt="startupindia" width="100%" height="36px">
            </div>
            <div style="display: flex; align-content: center; flex-wrap: wrap;">
                <img src="{{asset('document/images/skill_india.jpg')}}" alt="skillindia" width="100%" height="60px">
            </div>
            <div style="display: flex; align-content: center; flex-wrap: wrap;">
                <img src="{{asset('document/images/national_career_service.jpeg')}}" alt="ncs" width="100%" height="50px">
            </div>
        </div>
        <div class="auth-details-stamps" style="display: flex; flex-direction: row; margin-top: 20px;">
            <div class="auth-details" style="display: flex; flex-direction: column; font-weight: bold; width: 100%; align-items: center;">
                <div class="red-text">Certified By:</div>
                <div class="norm-bold-text">M/s. Maya Computer Center Private Limited</div>
                <div class="red-text">Registered Office</div>
                <div class="norm-bold-text">C-81, F/F, Gali No-01, Jitar Nagar, Near By Gurudwara, Delhi-110051</div>
                <div class="red-text">Corporate Office</div>
                <div class="norm-bold-text">Siswar, Phulparas, Madhubani, Bihar-847409</div>
                <div class="blue-text">Visit: www.mayacomputercenter.in</div>
            </div>
            <div class="sill">
                <img src="{{asset('document/images/sill.png')}}" alt="sill" width="150px" height="100%">
            </div>
            <div class="sign">
                <img src="{{asset('document/images/auth_sign_overlay.jpg')}}" alt="auth_sign" width="200px" height="100%">
            </div>
        </div>
    </div>
</body>
</html>