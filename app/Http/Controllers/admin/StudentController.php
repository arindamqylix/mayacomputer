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
	public function student_list()
	{
		$student['student'] = DB::table('student_login')
			->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
			->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
			->get();
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

		$student_reg_fee = StudentRegFee::first();
		$center = Center::where('cl_id', $request->center_id)->first();

		if (!$center) {
			Log::error("Center not found for ID: " . $request->center_id);
			return redirect()->back()->with('error', 'Center not found.');
		}

		Log::info("Center found: {$center->cl_id}, Wallet Balance: {$center->cl_wallet_balance}");

		if ($center->cl_wallet_balance < $student_reg_fee->srf_amount) {
			Log::warning("Low wallet balance: Needed {$student_reg_fee->srf_amount}, Have {$center->cl_wallet_balance}");
			return redirect()->back()->with('error', 'Your Balance Is Low. Please Recharge');
		}

		// FILE UPLOAD LOGS
		$student_photo = null;
		$student_id_card = null;
		$student_educational_certificate = null;

		if ($request->hasFile('student_photo')) {
			Log::info("Uploading Student Photo...");
			$path = $request->file('student_photo')->store('student', 'public');
			Log::info("Student Photo stored at: " . $path);
			$student_photo = 'storage/' . $path;
		}

		if ($request->hasFile('student_id_card')) {
			Log::info("Uploading Student ID Card...");
			$path = $request->file('student_id_card')->store('student', 'public');
			Log::info("Student ID Card stored at: " . $path);
			$student_id_card = 'storage/' . $path;
		}

		if ($request->hasFile('student_educational_certificate')) {
			Log::info("Uploading Educational Certificate...");
			$path = $request->file('student_educational_certificate')->store('student', 'public');
			Log::info("Educational Certificate stored at: " . $path);
			$student_educational_certificate = 'storage/' . $path;
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
				't_amount' => $student_reg_fee->srf_amount,
			]);

			Log::info("Transaction Logged for Student {$insert->sl_reg_no}");

			$newBalance = $center->cl_wallet_balance - $student_reg_fee->srf_amount;
			Center::where('cl_id', $request->center_id)->update([
				'cl_wallet_balance' => $newBalance,
			]);

			Log::info("Wallet Updated: Old = {$center->cl_wallet_balance}, New = {$newBalance}");

			DB::commit();
			Log::info("----- Student Registration SUCCESS -----");

			return redirect()->route('student_list')->with('success', 'Student Registration Successfully! Registration No: ' . $registrationDisplay);

		} catch (\Exception $e) {
			DB::rollBack();

			Log::error("Student Registration FAILED: " . $e->getMessage(), [
				'trace' => $e->getTraceAsString()
			]);

			return redirect()->back()->with('error', 'Failed to register student. Please try again.');
		}
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
				if ($currentPhoto && Storage::disk('public')->exists($currentPhoto)) {
					Storage::disk('public')->delete($currentPhoto);
				}

				$image = $request->file('student_photo');
				$filename = time() . '_' . preg_replace('/\s+/', '_', $image->getClientOriginalName());
				// store in storage/app/public/student
				$image->storeAs('student', $filename, 'public');
				$currentPhoto = 'student/' . $filename; // store relative path in DB
			}

			// Upload new ID Card
			if ($request->hasFile('student_id_card')) {
				if ($currentIdCard && Storage::disk('public')->exists($currentIdCard)) {
					Storage::disk('public')->delete($currentIdCard);
				}

				$file = $request->file('student_id_card');
				$filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
				$file->storeAs('student', $filename, 'public');
				$currentIdCard = 'student/' . $filename;
			}

			// Upload new Educational Certificate
			if ($request->hasFile('student_educational_certificate')) {
				if ($currentEduCert && Storage::disk('public')->exists($currentEduCert)) {
					Storage::disk('public')->delete($currentEduCert);
				}

				$file = $request->file('student_educational_certificate');
				$filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
				$file->storeAs('student', $filename, 'public');
				$currentEduCert = 'student/' . $filename;
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
		$student = DB::table('student_login')->where('sl_id', $id)->first();
		DB::table('student_login')->where('sl_id', $id)->delete();
		return redirect()->back()->with('success', 'Student Deleted Successfully!');
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
				'center_login.cl_center_name as center_name',
				'center_login.cl_code as center_code'
			)
			->get();

		return view('admin.view_result', $result);
	}
}
