<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marksheet</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            background-image: url("{{ asset('document/images/marksheet_bg.jpg') }}");
            background-size: contain;
            background-repeat: no-repeat;
        }
        .marksheet-content{
            padding: 100px;
            width: 840px;
        }
        .statement-body-content > div , .courses-body > div{
            margin-top: 10px;
            font-weight: bold;
        }
        .red-text{
            color: rgb(211, 1, 46);
        }
        .blue-text{
            color: rgb(31, 26, 100);
        }
        th{
            background-color: rgb(0, 1, 115);
            color: white;
            padding: 5px;
            margin: 0;
        }
        td{
            padding: 0;
        }
        table{
            border: 1px solid black;
            text-align: center;
        }
    </style>
</head>
<body>
    <div>
        <button id="print" onclick="print_result();">Print</button>
    </div>
    <div class="marksheet-content" style="margin-top: 20px;">
        <div class="company-details" style="display: flex; flex-direction: column; align-items: center; width: 100%;">
            <div style="display: flex; flex-direction: row;">
                <div class="company-logo" style="margin-left: 20px;">
                    <img src="{{ asset('document/images/logo.png') }}" alt="logo" style="width: 70%;">
                </div>
                <div class="topsill">
                    <img src="{{ asset('document/images/top_sill.png') }}" alt="top-sill" width="120px" height="120px">
                </div>
            </div>
            <div class="company-info" style="display: flex; flex-direction: row;">
                <div class="cin" style="display: flex; flex-direction: column; align-items: center;">
                    <div>
                        CIN:
                    </div>
                    <div>
                        {{ $data->cl_cin_no }}
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
                {{-- <div class="qr">
                    <img src="{{ asset('document/images/certificate-qr.jpg') }}" alt="qr"  width="100px" height="100px">
                </div> --}}
            </div>
        </div>
        <hr style="border: 2px solid rgb(0, 1, 115);">
        <hr style="border: 2px solid rgb(0, 1, 115);">
        <div class="statement-of-marks">
            <div class="statement-head" style="display: flex; width: 100%; justify-content: center;">
                <div style="border: none; border-radius: 5px; color: white; background-color: rgb(0, 1, 115); padding: 10px 40px;">
                    <div>Statement of Marks</div>
                </div>
            </div>
            <div class="statement-body" style="display: flex; flex-direction: row; justify-content: space-evenly; width: 100%; padding: 50px;">
                <div class="statement-body-content">
                    <div style="display: flex; flex-direction: row; justify-content: space-between;">
                        <div>Registration No. :</div> <div>{{ $data->sl_reg_no }}</div>
                    </div>
                    <div style="display: flex; flex-direction: row; justify-content: space-between;">
                        <div>Student's Name :</div> <div>{{ $data->sl_name }}</div>
                    </div>
                    <div style="display: flex; flex-direction: row; justify-content: space-between;">
                        <div>Mother's Name :</div> <div>{{ $data->sl_mother_name }}</div>
                    </div>
                    <div style="display: flex; flex-direction: row; justify-content: space-between;">
                        <div>Father's Name :</div> <div>{{ $data->sl_father_name }}</div>
                    </div>
                    <div style="display: flex; flex-direction: row; justify-content: space-between;">
                        <div>Course Name :</div> <div>{{ $data->c_full_name }} ({{ $data->c_short_name }})</div>
                    </div>
                    <div style="display: flex; flex-direction: row; justify-content: space-between;">
                        <div>Course Duration :</div> <div>{{ $data->c_duration }} Months</div>
                    </div>
                    <div style="display: flex; flex-direction: row; justify-content: space-between;">
                        <div>Study Centre Name :</div> <div>{{ $data->cl_center_name }}</div>
                    </div>
                    <div style="display: flex; flex-direction: row; justify-content: space-between;">
                        <div>Centre Code & Address :</div> <div>{{ $data->cl_code }} & {{ $data->cl_center_address }}</div>
                    </div>
                </div>
                <div>
                    <img src="{{ asset('storage/student/').'/'.$data->sl_photo }}" alt="passport_photo" width="100%" height="100px">
                </div>
            </div>
        </div>
        <div class="course-modules" style="width: 100%; margin: 0 20px;">
            <div class="course-head" style="display: flex; width: 100%; justify-content: center;">
                <div style="border: none; border-radius: 5px; color: white; background-color: rgb(0, 1, 115); padding: 10px 40px;">
                    <div>Modules Covered</div>
                </div>
            </div>
            <div class="courses-body" style="display: flex; flex-direction: column; padding: 20px; border: 1px solid black; border-radius: 15px; margin-top: -20px;">
                <div>M1: DCA: (Fundamental, MS-DOS, MS-Windows, MS-Word, MS-Excel, MS-PowerPoint, MS-Acces, HTML, Internet, Multimedla, Networking, System Maintenance)</div>
                <div>M2: CFA: (Accounting Introduction, Accunts Only, Accounts Only, Accounts with Inventory)</div>
                <div>M3: DTP (Adobe Pagemaker, Adobe Photoshop, CorelDraw, Mr.Photo Printing)</div>
                <div>M4: Assignment / Project</div>
            </div>
        </div>          
        <div class="marks" style="font-weight: bolder; margin-top: 20px;">
            <table style="width: 100%; margin-left: 20px;">
                <tr>
                    <th>Exam</th>
                    <th>Full Marks</th>
                    <th>Pass Marks</th>
                    <th>Marks Obtained</th>
                </tr>
                <tr>
                    <td>Written</td>
                    <td>{{ $data->sr_wr_full_marks }}</td>
                    <td>{{ $data->sr_wr_pass_marks }}</td>
                    <td>{{ $data->sr_wr_marks_obtained }}</td>
                </tr>
                <tr>
                    <td>Practical</td>
                    <td>{{ $data->sr_pr_full_marks }}</td>
                    <td>{{ $data->sr_pr_pass_marks }}</td>
                    <td>{{ $data->sr_pr_marks_obtained }}</td>
                </tr>
                <tr>
                    <td>Assignment / Project</td>
                    <td>{{ $data->sr_ap_full_marks }}</td>
                    <td>{{ $data->sr_ap_pass_marks }}</td>
                    <td>{{ $data->sr_ap_marks_obtained   }}</td>
                </tr>
                <tr>
                    <td>Viva Voce</td>
                    <td>{{ $data->sr_vv_full_marks }}</td>
                    <td>{{ $data->sr_vv_pass_marks }}</td>
                    <td>{{ $data->sr_vv_marks_obtained   }}</td>
                </tr>
                <tfoot>
                    <tr>
                        <td>Total</td>
                        <td>{{ $data->sr_total_full_marks }}</td>
                        <td>{{ $data->sr_total_pass_marks }}</td>
                        <td>{{ $data->sr_total_marks_obtained }}</td>
                    </tr>
                    <tr>
                        <td><div style="color: white; background-color: rgb(0, 1, 115);">Overall Percentage</div></td>
                        <td>{{ $data->sr_percentage }}</td>
                        <td><div style="color: white; background-color: rgb(0, 1, 115);">Grade</div></td>
                        <td>{{ $data->sr_grade }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="grades" style="font-weight: bold; width: 100%;">
            <p style="display: flex; justify-content: center;">Grade A: 85-100%. Grade B: 70-84%. Grade C: 55-69%. Grade D: 40-54%. Fail: Below 40%</p>
        </div>
        <div class="marksheet-companies" style="display: flex; flex-direction: row; width: 100%; justify-content: space-evenly;">
            <div style="display: flex; align-content: center; flex-wrap: wrap;">
                <img src="{{ asset('document/images/iaf.jpg') }}" alt="iaf" width="100%" height="75px">
            </div>
            <div style="display: flex; align-content: center; flex-wrap: wrap;">
                <img src="{{ asset('document/images/MSME-Logo.png') }}" alt="msme" width="100%" height="100px">
            </div>
            <div style="display: flex; align-content: center; flex-wrap: wrap;">
                <img src="{{ asset('document/images/iso_cert.png') }}" alt="iso" width="100%" height="75px">
            </div>
            <div style="display: flex; align-content: center; flex-wrap: wrap;">
                <img src="{{ asset('document/images/startupindia.jpg') }}" alt="startupindia" width="100%" height="36px">
            </div>
            <div style="display: flex; align-content: center; flex-wrap: wrap;">
                <img src="{{ asset('document/images/skill_india.jpg') }}" alt="skillindia" width="100%" height="60px">
            </div>
            <div style="display: flex; align-content: center; flex-wrap: wrap;">
                <img src="{{ asset('document/images/national_career_service.jpeg') }}" alt="ncs" width="100%" height="50px">
            </div>
        </div>
        <div class="marksheet-stamps-details" style="display: flex; flex-direction: row; justify-content: space-evenly;">
            <div style="margin-left: 20px;">
                <img src="{{ asset('document/images/sill.png') }}" alt="sill" width="120px" height="100px">
            </div>
            <div class="marksheet-details" style="display: flex; flex-direction: column; font-weight: bold; width: 100%; align-items: center;">
                <div class="red-text">Certified By:</div>
                <div class="norm-bold-text">M/s. Maya Computer Center Private Limited</div>
                <div class="red-text">Registered Office</div>
                <div class="norm-bold-text">C-81, F/F, Gali No-01, Jitar Nagar, Near By Gurudwara, Delhi-110051</div>
                <div class="red-text">Corporate Office</div>
                <div class="norm-bold-text">Siswar, Phulparas, Madhubani, Bihar-847409</div>
                <div class="blue-text">Visit: www.mayacomputercenter.in</div>
            </div>
            <div>
                <img src="{{ asset('document/images/auth_sign_overlay.jpg') }}" alt="auth_sign" width="100%" height="100px">
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        function print_result(){
            $('#print').hide();
            window.print();
            
        }
    </script>
</body>
</html>