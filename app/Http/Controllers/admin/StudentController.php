<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\student\Student;
use App\Models\admin\Course;
use App\Models\admin\StudentRegFee;
use App\Models\center\Center;
use DB;
use Auth;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
class StudentController extends Controller
{
	public function student_list(Request $request)
	{
		$centers = DB::table('center_login')
			->orderBy('cl_center_name', 'asc')
			->get();

		$query = DB::table('student_login')
			->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
			->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id');

		if ($request->has('center_id') && !empty($request->center_id)) {
			$query->where('student_login.sl_FK_of_center_id', $request->center_id);
		}

		if ($request->has('status') && !empty($request->status)) {
			$query->where('student_login.sl_status', $request->status);
		}

		$student['student'] = $query->get();
		$student['centers'] = $centers;
		$student['selectedCenterId'] = $request->center_id;
		$student['selectedStatus'] = $request->status;

		return view('admin.student.index', $student);
	}

	public function add_student()
	{
		$center = Center::all();
		$course = Course::all();


		return view('admin.student.create', ['center' => $center, 'course' => $course]);
	}



	public function add_student_now(Request $request)
	{
		Log::info("----- Student Registration Start -----");
		Log::info("Incoming Request Data: ", $request->all());

		// $student_reg_fee = StudentRegFee::first(); // Old logic
        $course = Course::findOrFail($request->course_id); // Fetch course for price
		$center = Center::where('cl_id', $request->center_id)->first();

		if (!$center) {
			Log::error("Center not found for ID: " . $request->center_id);
			return redirect()->back()->with('error', 'Center not found.');
		}

		Log::info("Center found: {$center->cl_id}, Wallet Balance: {$center->cl_wallet_balance}");

		if ($center->cl_wallet_balance < $course->c_price) {
			Log::warning("Low wallet balance: Needed {$course->c_price}, Have {$center->cl_wallet_balance}");
			return redirect()->back()->with('error', 'Your Balance Is Low. Please Recharge');
		}

		// FILE UPLOAD LOGS
		$student_photo = null;
		$student_id_card = null;
		$student_educational_certificate = null;

		if ($request->hasFile('student_photo')) {
			Log::info("Uploading Student Photo...");
			$uploadedFile = $request->file('student_photo');
			$fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
			$uploadedFile->move(public_path('student'), $fileName);
			$student_photo = 'student/' . $fileName;
			Log::info("Student Photo stored at: " . $student_photo);
		}

		if ($request->hasFile('student_id_card')) {
			Log::info("Uploading Student ID Card...");
			$uploadedFile = $request->file('student_id_card');
			$fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
			$uploadedFile->move(public_path('student'), $fileName);
			$student_id_card = 'student/' . $fileName;
			Log::info("Student ID Card stored at: " . $student_id_card);
		}

		if ($request->hasFile('student_educational_certificate')) {
			Log::info("Uploading Educational Certificate...");
			$uploadedFile = $request->file('student_educational_certificate');
			$fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
			$uploadedFile->move(public_path('student'), $fileName);
			$student_educational_certificate = 'student/' . $fileName;
			Log::info("Educational Certificate stored at: " . $student_educational_certificate);
		}

		// REGISTRATION NUMBER LOGIC
		$centerCode = $center->cl_code ?? $center->cl_center_code ?? $center->cl_id;

		$countForCenter = Student::where('sl_FK_of_center_id', $request->center_id)->count();
		$nextSeq = $countForCenter + 1;
		$seqPadded = str_pad($nextSeq, 4, '0', STR_PAD_LEFT);

		$registrationDisplay = $centerCode . $seqPadded;

		Log::info("Generated Registration No: {$registrationDisplay}");

		DB::beginTransaction();
		try {

			Log::info("Creating Student Record...");

			$insert = Student::create([
				'sl_FK_of_course_id' => $request->course_id,
				'sl_FK_of_center_id' => $request->center_id,
				'sl_dob' => $request->date_of_birth,
				'sl_qualification' => $request->student_qualification,
				'sl_reg_no' => $registrationDisplay,
				'sl_sex' => $request->student_sex,
				'sl_address' => $request->student_address,
				'sl_name' => $request->student_name,
				'sl_photo' => $student_photo,
				'sl_id_card' => $student_id_card,
				'sl_mother_name' => $request->student_mother,
				'sl_mobile_no' => $request->student_mobile,
				'password' => Hash::make($request->student_mobile),
				'sl_father_name' => $request->student_father,
				'sl_educational_certificate' => $student_educational_certificate,
				'sl_email' => $request->student_email,
				'sl_status' => 'PENDING',
			]);

			Log::info("Student Created: ID {$insert->id}");

			DB::table('transaction')->insert([
				't_student_reg_no' => $insert->sl_reg_no,
				't_FK_of_center_id' => $request->center_id,
				't_amount' => $course->c_price,
			]);

			Log::info("Transaction Logged for Student {$insert->sl_reg_no}");

			$newBalance = $center->cl_wallet_balance - $course->c_price;
			Center::where('cl_id', $request->center_id)->update([
				'cl_wallet_balance' => $newBalance,
			]);

			Log::info("Wallet Updated: Old = {$center->cl_wallet_balance}, New = {$newBalance}");

			DB::commit();
			Log::info("----- Student Registration SUCCESS -----");

			// Redirect to registration card after successful registration
			return redirect()->route('student_registration_card', $insert->sl_id)->with('success', 'Student Registration Successfully! Registration No: ' . $registrationDisplay);

		} catch (\Exception $e) {
			DB::rollBack();

			Log::error("Student Registration FAILED: " . $e->getMessage(), [
				'trace' => $e->getTraceAsString()
			]);

			return redirect()->back()->with('error', 'Failed to register student. Please try again.');
		}
	}





	public function login_as_student($id)
	{
		$student = Student::where('sl_id', $id)->first();
		if ($student) {
			Auth::guard('student')->login($student);
			return redirect()->route('student_dashboard')->with('success', 'Logged in as ' . $student->sl_name);
		}
		return back()->with('error', 'Student not found');
	}

	public function get_reg_no(Request $request)
	{
		$student_reg = Student::where('sl_FK_of_center_id', $request->center_id)->first();
		if ($student_reg):
			$data = [
				'msg' => 'Success',
				'reg_no' => $student_reg->sl_reg_no,
				'status' => 1
			];
		else:
			$data = [
				'msg' => 'Enter Center Code With 4 Digit Number',
				'status' => 0
			];
		endif;

		return response()->json($data);
	}


	public function edit_student($id)
	{
		// Fetch student record using DB::table
		$student = DB::table('student_login')->where('sl_id', $id)->first(); // adjust primary key column if not 'id'
		if (!$student) {
			return redirect()->route('student_list')->with('error', 'Student not found.');
		}

		// Fetch centers and courses for selects
		$centers = DB::table('center_login')->orderBy('cl_name')->get();
		$courses = DB::table('course')->orderBy('c_short_name')->get();

		// return view (make sure your blade expects $student, $center, $course as in previous view)
		return view('admin.student.edit', [
			'student' => $student,
			'center'  => $centers,
			'course'  => $courses,
		]);
	}

	/**
	 * Update student via DB::table
	 */
	public function update_student(Request $request, $id)
	{
		// Basic validation - extend as needed
		// $validator = Validator::make($request->all(), [
		// 	'course_id' => 'required',
		// 	'date_of_birth' => 'nullable|date',
		// 	'student_qualification' => 'nullable|string|max:255',
		// 	'student_sex' => 'nullable|string|max:20',
		// 	'student_address' => 'nullable|string',
		// 	'student_name' => 'required|string|max:255',
		// 	'student_mother' => 'nullable|string|max:255',
		// 	'student_father' => 'nullable|string|max:255',
		// 	'student_mobile' => 'required|string|max:20',
		// 	'student_email' => 'nullable|email|max:255',
		// 	'student_photo' => 'nullable|file|mimes:jpeg,png,jpg|max:5120',
		// 	'student_id_card' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
		// 	'student_educational_certificate' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
		// ]);

		// if ($validator->fails()) {
		// 	return redirect()->back()->withErrors($validator)->withInput();
		// }

		try {
			$student = Student::findOrFail($id);

			// Current stored file paths relative to storage/app/public (e.g. "student/123.jpg" or null)
			$currentPhoto = $student->sl_photo; // expected like "student/xxx.jpg"
			$currentIdCard = $student->sl_id_card;
			$currentEduCert = $student->sl_educational_certificate;

			// Upload new Student Photo
			if ($request->hasFile('student_photo')) {
				// delete old file if exists
				if ($currentPhoto && file_exists(public_path($currentPhoto))) {
					@unlink(public_path($currentPhoto));
				}

				$uploadedFile = $request->file('student_photo');
				$fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
				$uploadedFile->move(public_path('student'), $fileName);
				$currentPhoto = 'student/' . $fileName;
			}

			// Upload new ID Card
			if ($request->hasFile('student_id_card')) {
				// delete old file if exists
				if ($currentIdCard && file_exists(public_path($currentIdCard))) {
					@unlink(public_path($currentIdCard));
				}

				$uploadedFile = $request->file('student_id_card');
				$fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
				$uploadedFile->move(public_path('student'), $fileName);
				$currentIdCard = 'student/' . $fileName;
			}

			// Upload new Educational Certificate
			if ($request->hasFile('student_educational_certificate')) {
				// delete old file if exists
				if ($currentEduCert && file_exists(public_path($currentEduCert))) {
					@unlink(public_path($currentEduCert));
				}

				$uploadedFile = $request->file('student_educational_certificate');
				$fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
				$uploadedFile->move(public_path('student'), $fileName);
				$currentEduCert = 'student/' . $fileName;
			}

			// Prepare update data
			$updateData = [
				'sl_FK_of_course_id' => $request->course_id,
				'sl_dob' => $request->date_of_birth ?: null,
				'sl_qualification' => $request->student_qualification ?: null,
				'sl_sex' => $request->student_sex ?: null,
				'sl_address' => $request->student_address ?: null,
				'sl_name' => $request->student_name,
				'sl_mother_name' => $request->student_mother ?: null,
				'sl_mobile_no' => $request->student_mobile,
				// Uncomment below line if you want to reset password to mobile on update:
				'password' => Hash::make($request->student_mobile),
				'sl_father_name' => $request->student_father ?: null,
				'sl_email' => $request->student_email ?: null,
				'sl_photo' => $currentPhoto,
				'sl_id_card' => $currentIdCard,
				'sl_educational_certificate' => $currentEduCert,
				'updated_at' => now(),
			];

			$student->update($updateData);

			return redirect()->back()->with('success', 'Student Updated Successfully!');
		} catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return redirect()->back()->with('error', 'Student not found.');
		} catch (\Exception $e) {
			Log::error('update_student error: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
			return redirect()->back()->with('error', 'Something went wrong. Please try again.');
		}
	}


	public function delete_student($id)
	{
		try {
			DB::beginTransaction();
			
			$student = DB::table('student_login')->where('sl_id', $id)->first();
			
			if (!$student) {
				return redirect()->back()->with('error', 'Student not found!');
			}
			
			// Delete related records first (if needed, database should handle CASCADE)
			// Delete student results if any
			DB::table('set_result')->where('sr_FK_of_student_id', $id)->delete();
			
			// Delete student certificates if any
			DB::table('student_certificates')->where('sc_FK_of_student_id', $id)->delete();
			
			// Delete student fees if any
			DB::table('set_fee')->where('sf_FK_of_student_id', $id)->delete();
			
			// Delete fees payments if any
			DB::table('fees_payment')->where('fp_FK_of_student_id', $id)->delete();
			
			// Delete student admit cards if any
			DB::table('student_admit_cards')->where('student_id', $id)->delete();
			
			// Delete transactions if any
			DB::table('transaction')->where('t_student_reg_no', $student->sl_reg_no)->delete();
			
			// Delete student files if exist
			if ($student->sl_photo && file_exists(public_path($student->sl_photo))) {
				@unlink(public_path($student->sl_photo));
			}
			if ($student->sl_id_card && file_exists(public_path($student->sl_id_card))) {
				@unlink(public_path($student->sl_id_card));
			}
			if ($student->sl_educational_certificate && file_exists(public_path($student->sl_educational_certificate))) {
				@unlink(public_path($student->sl_educational_certificate));
			}
			
			// Finally delete the student
			DB::table('student_login')->where('sl_id', $id)->delete();
			
			DB::commit();
			return redirect()->back()->with('success', 'Student and all related records deleted successfully!');
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error('delete_student error: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
			return redirect()->back()->with('error', 'Failed to delete student. Please try again.');
		}
	}

	public function student_status_updated(Request $request)
	{
		$student = Student::where('sl_id', $request->student_id)->update([
			'sl_status' => $request->status
		]);
		if ($student):
			$data = [
				'msg' => 'Student Status Updated Successfully!',
				'status' => 1
			];
		else:
			$data = [
				'msg' => 'Something Went Wrong!',
				'status' => 0
			];
		endif;

		return response()->json($data);
	}

	public function student_application($id)
	{
		$data = DB::table('student_login')
			->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
			->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
			->where('student_login.sl_id', $id)
			->first();
		return view('admin.student.student_application', compact('data'));
	}

	public function registration_card($id)
	{
		$data = DB::table('student_login')
			->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
			->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
			->select('student_login.*', 'center_login.cl_center_name', 'center_login.cl_code', 'center_login.cl_name', 'course.c_full_name', 'course.c_short_name', 'course.c_duration')
			->where('student_login.sl_id', $id)
			->first();
		
		if (!$data) {
			return redirect()->route('student_list')->with('error', 'Student not found.');
		}
		
        $setting = DB::table('site_settings')->first();
        
		return view('admin.student.registration_card', compact('data', 'setting'));
	}

	public function set_reg_fee()
	{
		$student_reg_fee = StudentRegFee::first();
		return view('admin.set_reg_fee', compact('student_reg_fee'));
	}

	public function update_reg_fee(Request $request)
	{
		$student_reg_fee = StudentRegFee::first();

		$update = StudentRegFee::where('srf_id', $student_reg_fee->srf_id)->update([
			'srf_amount' => $request->amount

		]);

		return back()->with('success', 'Registration Fees Updated Successfully!');
	}

	// student result
	public function student_result_list()
	{

		$result['result'] = DB::table('set_result')
			->join('student_login', 'set_result.sr_FK_of_student_id', '=', 'student_login.sl_id')
			->join('center_login', 'set_result.sr_FK_of_center_id', '=', 'center_login.cl_id')
			->select(
				'set_result.*',
				'student_login.sl_name',
				'student_login.sl_id',
				'student_login.sl_email',
				'student_login.sl_reg_no',
				'student_login.sl_father_name',
				'student_login.sl_mother_name',
				'student_login.sl_dob',
				'student_login.sl_sex',
				'student_login.sl_photo',
				'center_login.cl_name as center_name',
				'center_login.cl_center_name',
				'center_login.cl_code as center_code',
				'center_login.cl_code'
			)
			->get();

		return view('admin.auth.view_result', $result);
	}
	public function student_reg_card_list(Request $request)
	{
		$centers = DB::table('center_login')
			->orderBy('cl_center_name', 'asc')
			->get();

		$query = DB::table('student_login')
			->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
			->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
			->orderBy('student_login.sl_id', 'desc');

		if ($request->has('center_id') && !empty($request->center_id)) {
			$query->where('student_login.sl_FK_of_center_id', $request->center_id);
		}

		$student = $query->get();
		$selectedCenterId = $request->center_id;

		return view('admin.student.reg_card_list', compact('student', 'centers', 'selectedCenterId'));
	}

	public function student_id_card_list(Request $request)
	{
		$centers = DB::table('center_login')
			->orderBy('cl_center_name', 'asc')
			->get();

		$query = DB::table('student_login')
			->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
			->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
			->orderBy('student_login.sl_id', 'desc');

		if ($request->has('center_id') && !empty($request->center_id)) {
			$query->where('student_login.sl_FK_of_center_id', $request->center_id);
		}

		$student = $query->get();
		$selectedCenterId = $request->center_id;

		return view('admin.student.id_card_list', compact('student', 'centers', 'selectedCenterId'));
	}

    public function student_id_card($id)
    {
        $data = DB::table('student_login')
			->leftJoin('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
			->leftJoin('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
			->where('student_login.sl_id', $id)
			->select(
				'student_login.*',
				'center_login.cl_center_name', 
				'center_login.cl_name',
				'center_login.cl_code', 
				'center_login.cl_mobile',
				'course.c_short_name', 
				'course.c_full_name'
			)
			->first();

        if (!$data) {
			return redirect()->back()->with('error', 'Student not found.');
		}

        return view('admin.student.id_card', compact('data'));
    }
}
