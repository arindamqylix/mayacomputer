<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Student;
use App\Models\admin\Course;
use App\Models\admin\StudentRegFee;
use App\Models\center\Center;
use App\Models\center\Attendance;
use Auth;
use DB;
use Hash;
class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            define('CENTER_ID', Auth::guard('center')->user()->cl_id);
            return $next($request);
        });
    }

    public function all_student()
    {
        $student['student'] = DB::table('student_login')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->where('student_login.sl_FK_of_center_id', CENTER_ID)
            ->get();
        return view('center.student.all_student', $student);
    }

    public function pending_student()
    {
        $student['student'] = DB::table('student_login')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->where('student_login.sl_FK_of_center_id', CENTER_ID)
            ->where('student_login.sl_status', 'PENDING')
            ->get();
        return view('center.student.pending_student', $student);
    }

    public function verified_student()
    {
        $student['student'] = DB::table('student_login')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->where('student_login.sl_FK_of_center_id', CENTER_ID)
            ->where('student_login.sl_status', 'VERIFIED')
            ->get();

        $attendance_batch['attendance_batch'] = Attendance::where('ab_status', 'ACTIVE')->get();
        return view('center.student.verified_student', $student, $attendance_batch);
    }

    public function result_updated_student()
    {
        $student['student'] = DB::table('student_login')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->where('student_login.sl_FK_of_center_id', CENTER_ID)
            ->where('student_login.sl_status', 'RESULT UPDATED')
            ->get();
        return view('center.student.result_updated_student', $student);
    }

    public function result_out_student()
    {
        $student['student'] = DB::table('student_login')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->where('student_login.sl_FK_of_center_id', CENTER_ID)
            ->where('student_login.sl_status', 'RESULT OUT')
            ->get();
        return view('center.student.result_out_student', $student);
    }

    public function dispatched_student()
    {
        $student['student'] = DB::table('student_login')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->where('student_login.sl_FK_of_center_id', CENTER_ID)
            ->where('student_login.sl_status', 'DISPATCHED')
            ->get();
        return view('center.student.dispatched_student', $student);
    }

    public function block_student()
    {
        $student['student'] = DB::table('student_login')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->where('student_login.sl_FK_of_center_id', CENTER_ID)
            ->where('student_login.sl_status', 'BLOCK')
            ->get();
        return view('center.student.block_student', $student);
    }

    public function student_application($id)
    {
        $data = DB::table('student_login')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->where('student_login.sl_id', $id)
            ->first();
        return view('center.student.student_application', compact('data'));
    }

    public function registration_card($id)
    {
        $data = DB::table('student_login')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->select('student_login.*', 'center_login.cl_center_name', 'center_login.cl_code', 'center_login.cl_name', 'center_login.cl_center_address', 'course.c_full_name', 'course.c_short_name', 'course.c_duration')
            ->where('student_login.sl_id', $id)
            ->where('student_login.sl_FK_of_center_id', CENTER_ID) // Ensure center can only view their own students
            ->first();

        if (!$data) {
            return redirect()->route('pending_student')->with('error', 'Student not found.');
        }

        // Check if student is approved (status should be VERIFIED or higher)
        if ($data->sl_status == 'PENDING' || $data->sl_status == 'BLOCK') {
            return redirect()->route('pending_student')->with('error', 'Student registration is pending approval. Registration card cannot be generated until admin approves the student.');
        }

        $setting = DB::table('site_settings')->first();

        return view('admin.student.registration_card', compact('data', 'setting'));
    }

    public function add_student()
    {
        $course['course'] = Course::all();
        $student_reg_no = Student::where('sl_FK_of_center_id', auth::guard('center')->user()->cl_id)->latest()->first();
        $code = auth::guard('center')->user()->cl_code;
        return view('center.student.create', $course, compact('student_reg_no', 'code'));
    }

    public function add_student_now(Request $request)
    {
        // basic validation (extend as needed)
        $request->validate([
            'student_name' => 'required|string',
            'student_mobile' => 'required',
            'course_id' => 'required|integer',
            'reg_date' => 'required|date',
            'category' => 'required|string',
            // add other rules...
        ]);

        // $student_reg_fee = StudentRegFee::first(); // Old logic
        $course = Course::findOrFail($request->course_id); // Fetch course for price
        $center = Center::where('cl_id', Auth::guard('center')->user()->cl_id)->firstOrFail();

        // Check if balance is sufficient for the course price
        if ($center->cl_wallet_balance < $course->c_price) {
            return back()->with('error', 'Your Balance Is Low (' . $center->cl_wallet_balance . '). Required for this course: ' . $course->c_price . '. Please Recharge');
        }

        // handle files (default null)
        $student_photo = null;
        $student_id_card = null;
        $student_educational_certificate = null;

        if ($request->hasFile('student_photo')) {
            $uploadedFile = $request->file('student_photo');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('student'), $fileName);
            $student_photo = 'student/' . $fileName;
        }

        if ($request->hasFile('student_id_card')) {
            $uploadedFile = $request->file('student_id_card');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('student'), $fileName);
            $student_id_card = 'student/' . $fileName;
        }

        // FIXED: use correct input name 'student_educational_certificate'
        if ($request->hasFile('student_educational_certificate')) {
            $uploadedFile = $request->file('student_educational_certificate');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('student'), $fileName);
            $student_educational_certificate = 'student/' . $fileName;
        }

        $student_signature = null;
        if ($request->hasFile('student_signature')) {
            $uploadedFile = $request->file('student_signature');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('student'), $fileName);
            $student_signature = 'student/' . $fileName;
        }

        // Generate registration number per-center, concurrency safe
        // Use center code if available, otherwise fall back to cl_id
        $centerCode = $center->cl_code ?? $center->cl_id; // adjust attribute name if different
        $centerCode = (string) $centerCode;

        try {
            DB::beginTransaction();

            // Lock the rows for this center and get the last reg_no
            // Here we attempt to fetch the last student for this center ordered by reg_no desc with FOR UPDATE
            $lastStudent = Student::where('sl_FK_of_center_id', $center->cl_id)
                ->where('sl_reg_no', 'like', $centerCode . '%')
                ->orderBy('sl_reg_no', 'desc')
                ->lockForUpdate()
                ->first();

            if ($lastStudent) {
                // Extract numeric suffix after centerCode
                $lastRegNo = $lastStudent->sl_reg_no;
                $suffix = substr($lastRegNo, strlen($centerCode)); // e.g. "0004"
                $lastSeq = intval($suffix);
                $nextSeq = $lastSeq + 1;
            } else {
                // first student for this center
                $nextSeq = 1;
            }

            // zero-pad to 4 digits (0001, 0002, ...)
            $suffixPadded = str_pad($nextSeq, 4, '0', STR_PAD_LEFT);
            $newRegNo = $centerCode . $suffixPadded;

            // prepare data
            $data = [
                'sl_FK_of_course_id' => $request->course_id,
                'sl_FK_of_center_id' => $center->cl_id,
                'sl_reg_date' => $request->reg_date,
                'sl_category' => $request->category,
                'sl_dob' => $request->date_of_birth,
                'sl_qualification' => $request->student_qualification,
                'sl_reg_no' => $newRegNo,
                'sl_sex' => $request->student_sex,
                'sl_address' => $request->student_address,
                'sl_name' => $request->student_name,
                'sl_photo' => $student_photo,
                'sl_id_card' => $student_id_card,
                'sl_mother_name' => $request->student_mother,
                'sl_mobile_no' => $request->student_mobile,
                // hash the password (do not store raw mobile)
                'password' => Hash::make($request->student_mobile),
                'sl_father_name' => $request->student_father,
                'sl_educational_certificate' => $student_educational_certificate,
                'sl_signature' => $student_signature,
                'sl_email' => $request->student_email,
                'sl_status' => 'PENDING',
            ];

            // create student
            $insert = Student::create($data);

            // insert payment transaction (use Eloquent model if you have one; here we keep your original table)
            DB::table('transaction')->insert([
                't_student_reg_no' => $insert->sl_reg_no,
                't_FK_of_center_id' => $center->cl_id,
                't_amount' => $course->c_price, // Deduct course price
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // deduct wallet balance
            $center->cl_wallet_balance = $center->cl_wallet_balance - $course->c_price; // Deduct course price
            $center->save();

            DB::commit();

            // Redirect to registration card after successful registration
            return redirect()->route('center.student_registration_card', $insert->sl_id)->with('success', 'Student Registration Successfully! Reg No: ' . $newRegNo);
        } catch (\Exception $e) {
            DB::rollBack();
            // log error if you want: \Log::error($e);
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit_student($id)
    {
        $course['course'] = Course::all();
        $student_reg_no = Student::where('sl_FK_of_center_id', auth::guard('center')->user()->cl_id)->latest()->first();
        $code = auth::guard('center')->user()->cl_code;
        $data = Student::where('sl_id', $id)->first();

        return view('center.student.edit', $course, compact('student_reg_no', 'code', 'data'));
    }

    public function update_student(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        // Existing file names
        $student_photo = $student->sl_photo;
        $student_id_card = $student->sl_id_card;
        $student_educational_certificate = $student->sl_educational_certificate;

        // Upload new Student Photo
        if ($request->hasFile('student_photo')) {
            // delete old file if exists
            if ($student_photo && file_exists(public_path($student_photo))) {
                @unlink(public_path($student_photo));
            }

            $uploadedFile = $request->file('student_photo');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('student'), $fileName);
            $student_photo = 'student/' . $fileName;
        }

        // Upload new ID Card
        if ($request->hasFile('student_id_card')) {
            // delete old file if exists
            if ($student_id_card && file_exists(public_path($student_id_card))) {
                @unlink(public_path($student_id_card));
            }

            $uploadedFile = $request->file('student_id_card');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('student'), $fileName);
            $student_id_card = 'student/' . $fileName;
        }

        // Upload new Educational Certificate
        if ($request->hasFile('student_educational_certificate')) {
            // delete old file if exists
            if ($student_educational_certificate && file_exists(public_path($student_educational_certificate))) {
                @unlink(public_path($student_educational_certificate));
            }

            $uploadedFile = $request->file('student_educational_certificate');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('student'), $fileName);
            $student_educational_certificate = 'student/' . $fileName;
        }

        $student_signature = $student->sl_signature;

        // Upload new Signature
        if ($request->hasFile('student_signature')) {
            // delete old file if exists
            if ($student_signature && file_exists(public_path($student_signature))) {
                @unlink(public_path($student_signature));
            }

            $uploadedFile = $request->file('student_signature');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('student'), $fileName);
            $student_signature = 'student/' . $fileName;
        }

        // Update student data
        $student->update([
            'sl_FK_of_course_id' => $request->course_id,
            'sl_dob' => $request->date_of_birth,
            'sl_qualification' => $request->student_qualification,
            'sl_sex' => $request->student_sex,
            'sl_address' => $request->student_address,
            'sl_name' => $request->student_name,
            'sl_mother_name' => $request->student_mother,
            'sl_mobile_no' => $request->student_mobile,
            'password' => Hash::make($request->student_mobile),
            'sl_father_name' => $request->student_father,
            'sl_email' => $request->student_email,

            // Updated files
            'sl_photo' => $student_photo,
            'sl_id_card' => $student_id_card,
            'sl_educational_certificate' => $student_educational_certificate,
            'sl_signature' => $student_signature,
        ]);

        return back()->with('success', 'Student Updated Successfully!');
    }

    public function delete_student($id)
    {
        $student = Student::findOrFail($id);

        // Delete Student Photo
        if (!empty($student->sl_photo) && file_exists(public_path($student->sl_photo))) {
            @unlink(public_path($student->sl_photo));
        }

        // Delete ID Card
        if (!empty($student->sl_id_card) && file_exists(public_path($student->sl_id_card))) {
            @unlink(public_path($student->sl_id_card));
        }

        // Delete Educational Certificate
        if (!empty($student->sl_educational_certificate) && file_exists(public_path($student->sl_educational_certificate))) {
            @unlink(public_path($student->sl_educational_certificate));
        }

        // Delete Signature
        if (!empty($student->sl_signature) && file_exists(public_path($student->sl_signature))) {
            @unlink(public_path($student->sl_signature));
        }

        // Delete student record
        $student->delete();

        return back()->with('success', 'Student Deleted Successfully!');
    }

    public function get_course(Request $request)
    {
        $get_course = Course::where('c_id', $request->course_id)->first();
        if ($get_course):
            $data = [
                'msg' => $get_course->c_duration,
                'price' => $get_course->c_price,
                'status' => 1
            ];
        else:
            $data = [
                'msg' => "Something Went Wrong!",
                'price' => '',
                'status' => 0
            ];
        endif;
        return response()->json($data);
    }

    public function student_id_card()
    {
        $student['student'] = DB::table('student_login')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->where('student_login.sl_FK_of_center_id', Auth::guard('center')->user()->cl_id)
            ->select(
                'student_login.*',
                'center_login.cl_code',
                'center_login.cl_center_name',
                'course.c_full_name',
                'course.c_short_name'
            )
            ->orderBy('student_login.sl_id', 'DESC')
            ->get();

        return view('center.student.id_card_list', $student);
    }

    public function student_registration_card_list()
    {
        $student['student'] = DB::table('student_login')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->where('student_login.sl_FK_of_center_id', Auth::guard('center')->user()->cl_id)
            ->select(
                'student_login.*',
                'center_login.cl_code',
                'center_login.cl_center_name',
                'course.c_full_name',
                'course.c_short_name'
            )
            ->orderBy('student_login.sl_id', 'DESC')
            ->get();

        return view('center.student.registration_card_list', $student);
    }

    public function view_student_id_card($id)
    {
        $data = DB::table('student_login')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->where('student_login.sl_id', $id)
            ->where('student_login.sl_FK_of_center_id', CENTER_ID) // Ensure center can only view their own students
            ->first();

        if (!$data) {
            return redirect()->route('student_id_card')->with('error', 'Student not found.');
        }

        // Check if student is approved (status should be VERIFIED or higher)
        if ($data->sl_status == 'PENDING' || $data->sl_status == 'BLOCK') {
            return redirect()->route('student_id_card')->with('error', 'Student registration is pending approval. ID Card cannot be generated until admin approves the student.');
        }

        $setting = DB::table('site_settings')->first();
        return view('center.student.view_student_id_card', compact('data', 'setting'));
    }
}
