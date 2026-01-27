<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    // Home
    public function index()
    {
        // Fetch all homepage sections
        $counterStats = DB::table('cms_homepage_sections')->where('section_type', 'counter_stat')->where('status', 1)->orderBy('sort_order')->get();
        $aboutUsHeader = DB::table('cms_homepage_sections')->where('section_type', 'about_us_header')->where('status', 1)->first();
        $aboutUsItems = DB::table('cms_homepage_sections')->where('section_type', 'about_us_item')->where('status', 1)->orderBy('sort_order')->get();
        $whyChooseHeader = DB::table('cms_homepage_sections')->where('section_type', 'why_choose_header')->where('status', 1)->first();
        $whyChooseItems = DB::table('cms_homepage_sections')->where('section_type', 'why_choose_item')->where('status', 1)->orderBy('sort_order')->get();
        $serviceItems = DB::table('cms_homepage_sections')->where('section_type', 'service_item')->where('status', 1)->orderBy('sort_order')->get();
        $achievementHeader = DB::table('cms_homepage_sections')->where('section_type', 'achievement_header')->where('status', 1)->first();
        $achievementCounters = DB::table('cms_homepage_sections')->where('section_type', 'achievement_counter')->where('status', 1)->orderBy('sort_order')->get();
        $partnerHeader = DB::table('cms_homepage_sections')->where('section_type', 'partner_header')->where('status', 1)->first();
        $partnerItems = DB::table('cms_homepage_sections')->where('section_type', 'partner_item')->where('status', 1)->orderBy('sort_order')->get();

        return view('frontend.index', compact(
            'counterStats', 'aboutUsHeader', 'aboutUsItems',
            'whyChooseHeader', 'whyChooseItems', 'serviceItems',
            'achievementHeader', 'achievementCounters', 'partnerHeader', 'partnerItems'
        ));
    }

    // About
    public function aboutUs()
    {
        return view('frontend.about-us');
    }

    public function teacher()
    {
        return view('frontend.teacher');
    }


    // Verification
    public function registration()
    {
        return view('frontend.registration');
    }

    // AJAX endpoint to fetch registration card data
    public function getRegistrationCardData(Request $request)
    {
        $registrationNo = $request->input('registration_no');
        $dob = $request->input('dob');

        if (!$registrationNo || !$dob) {
            return response()->json([
                'success' => false,
                'message' => 'Registration number and date of birth are required'
            ], 400);
        }

        try {
            // Fetch student data with related center and course information
            $student = DB::table('student_login')
                ->join('center_login', 'student_login.sl_FK_of_center_id', '=', 'center_login.cl_id')
                ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
                ->where('student_login.sl_reg_no', $registrationNo)
                ->where('student_login.sl_dob', $dob)
                ->select(
                    'student_login.*',
                    'center_login.cl_code',
                    'center_login.cl_center_name',
                    'center_login.cl_name',
                    'center_login.cl_cin_no',
                    'course.c_full_name',
                    'course.c_duration',
                    'course.c_short_name'
                )
                ->first();

            if (!$student) {
                return response()->json([
                    'success' => false,
                    'message' => 'No record found with the provided registration number and date of birth'
                ], 404);
            }

            // Check if student is approved (status should be VERIFIED or higher)
            if ($student->sl_status == 'PENDING' || $student->sl_status == 'BLOCK') {
                return response()->json([
                    'success' => false,
                    'message' => 'Student registration is pending approval. Please contact your center or wait for admin approval.'
                ], 403);
            }

            return response()->json([
                'success' => true,
                'data' => $student
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching data: ' . $e->getMessage()
            ], 500);
        }
    }

    // Generate PDF for registration card
    public function generateRegistrationCardPDF(Request $request)
    {
        $registrationNo = $request->input('registration_no');
        $dob = $request->input('dob');

        if (!$registrationNo || !$dob) {
            return response()->json([
                'success' => false,
                'message' => 'Registration number and date of birth are required'
            ], 400);
        }

        try {
            // Fetch student data with related center and course information
            $student = DB::table('student_login')
                ->join('center_login', 'student_login.sl_FK_of_center_id', '=', 'center_login.cl_id')
                ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
                ->where('student_login.sl_reg_no', $registrationNo)
                ->where('student_login.sl_dob', $dob)
                ->select(
                    'student_login.*',
                    'center_login.cl_code',
                    'center_login.cl_center_name',
                    'center_login.cl_name',
                    'center_login.cl_cin_no',
                    'course.c_full_name',
                    'course.c_duration',
                    'course.c_short_name'
                )
                ->first();

            if (!$student) {
                abort(404, 'No record found with the provided registration number and date of birth');
            }

            // Check if student is approved (status should be VERIFIED or higher)
            if ($student->sl_status == 'PENDING' || $student->sl_status == 'BLOCK') {
                abort(403, 'Student registration is pending approval. Please contact your center or wait for admin approval.');
            }

            // Get site settings
            $siteSettings = site_settings();
            $siteLogo = $siteSettings && !empty($siteSettings->site_logo) ? $siteSettings->site_logo : 'logo.png';
            $siteName = $siteSettings && !empty($siteSettings->name) ? $siteSettings->name : 'MAYA COMPUTER CENTER';
            $siteEmail = $siteSettings && !empty($siteSettings->email) ? $siteSettings->email : 'mccsiswar@gmail.com';
            $sitePhone = $siteSettings && !empty($siteSettings->phone) ? $siteSettings->phone : '+91 8825148127';

            // Format dates - ensure proper date format handling
            $dobFormatted = 'N/A';
            if ($student->sl_dob) {
                // Handle YYYY-MM-DD format from database
                $dobTimestamp = strtotime($student->sl_dob);
                if ($dobTimestamp !== false) {
                    $dobFormatted = date('d-M-Y', $dobTimestamp);
                } else {
                    $dobFormatted = $student->sl_dob; // Use as-is if strtotime fails
                }
            }
            
            $validFrom = date('d-M-Y');
            $validTill = date('d-M-Y', strtotime('+1 year'));
            $issueDate = date('d-M-Y');
            
            if ($student->created_at) {
                $createdTimestamp = strtotime($student->created_at);
                if ($createdTimestamp !== false) {
                    $validFrom = date('d-M-Y', $createdTimestamp);
                    $validTill = date('d-M-Y', strtotime('+1 year', $createdTimestamp));
                    $issueDate = date('d-M-Y', $createdTimestamp);
                }
            }

            // Prepare data for PDF
            $data = [
                'student' => $student,
                'siteLogo' => $siteLogo,
                'siteName' => $siteName,
                'siteEmail' => $siteEmail,
                'sitePhone' => $sitePhone,
                'cinNo' => $student->cl_cin_no ?? 'U47411DL2023PTC422329',
                'dobFormatted' => $dobFormatted,
                'validFrom' => $validFrom,
                'validTill' => $validTill,
                'issueDate' => $issueDate,
            ];

            // Generate PDF
            $pdf = PDF::loadView('frontend.registration-card-pdf', $data);
            $pdf->setPaper('A4', 'portrait');
            
            return $pdf->download('Registration_Card_' . $registrationNo . '.pdf');

        } catch (\Exception $e) {
            abort(500, 'An error occurred while generating PDF: ' . $e->getMessage());
        }
    }

    public function icard()
    {
        return view('frontend.icard');
    }

    // AJAX endpoint to fetch I-Card data
    public function getIcardData(Request $request)
    {
        $registrationNo = $request->input('registration_no');
        $dob = $request->input('dob');

        if (!$registrationNo || !$dob) {
            return response()->json([
                'success' => false,
                'message' => 'Registration number and date of birth are required'
            ], 400);
        }

        try {
            // Fetch student data with related center and course information
            $student = DB::table('student_login')
                ->join('center_login', 'student_login.sl_FK_of_center_id', '=', 'center_login.cl_id')
                ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
                ->where('student_login.sl_reg_no', $registrationNo)
                ->where('student_login.sl_dob', $dob)
                ->select(
                    'student_login.*',
                    'center_login.cl_code',
                    'center_login.cl_center_name',
                    'center_login.cl_name',
                    'center_login.cl_mobile',
                    'course.c_full_name',
                    'course.c_short_name'
                )
                ->first();

            if (!$student) {
                return response()->json([
                    'success' => false,
                    'message' => 'No record found with the provided registration number and date of birth'
                ], 404);
            }

            // Check if student is approved (status should be VERIFIED or higher)
            if ($student->sl_status == 'PENDING' || $student->sl_status == 'BLOCK') {
                return response()->json([
                    'success' => false,
                    'message' => 'Student registration is pending approval. Please contact your center or wait for admin approval.'
                ], 403);
            }

            return response()->json([
                'success' => true,
                'data' => $student
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function result()
    {
        return view('frontend.result');
    }

    // AJAX endpoint to fetch result/marksheet data
    public function getResultData(Request $request)
    {
        $registrationNo = $request->input('registration_no');
        $dob = $request->input('dob');

        if (!$registrationNo || !$dob) {
            return response()->json([
                'success' => false,
                'message' => 'Registration number and date of birth are required'
            ], 400);
        }

        try {
            // Fetch result data with joins to student, course, and center tables
            $result = DB::table('set_result')
                ->join('student_login', 'set_result.sr_FK_of_student_id', '=', 'student_login.sl_id')
                ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
                ->join('center_login', 'set_result.sr_FK_of_center_id', '=', 'center_login.cl_id')
                ->where('student_login.sl_reg_no', $registrationNo)
                ->where('student_login.sl_dob', $dob)
                ->select(
                    'set_result.*',
                    'student_login.*',
                    'course.c_full_name',
                    'course.c_short_name',
                    'center_login.cl_name',
                    'center_login.cl_center_name',
                    'center_login.cl_code',
                    'center_login.cl_center_address'
                )
                ->first();

            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'No result found with the provided registration number and date of birth'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $result
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching data: ' . $e->getMessage()
            ], 500);
        }
    }

    // AJAX endpoint to fetch certificate data
    public function getCertificateData(Request $request)
    {
        $registrationNo = $request->input('registration_no');
        $dob = $request->input('dob');

        if (!$registrationNo || !$dob) {
            return response()->json([
                'success' => false,
                'message' => 'Registration number and date of birth are required'
            ], 400);
        }

        try {
            // First try to fetch from student_certificates table
            $certificate = DB::table('student_certificates')
                ->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
                ->join('set_result', 'student_certificates.sc_FK_of_result_id', '=', 'set_result.sr_id')
                ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
                ->join('center_login', 'student_certificates.sc_FK_of_center_id', '=', 'center_login.cl_id')
                ->where('student_login.sl_reg_no', $registrationNo)
                ->where('student_login.sl_dob', $dob)
                ->select(
                    'student_certificates.*',
                    'student_login.*',
                    'set_result.*',
                    'course.c_full_name',
                    'course.c_short_name',
                    'course.c_duration',
                    'center_login.cl_name',
                    'center_login.cl_center_name',
                    'center_login.cl_code',
                    'center_login.cl_center_address',
                    'center_login.cl_cin_no'
                )
                ->first();

            // If certificate not found, try fetching from set_result table directly (like result verification)
            if (!$certificate) {
                $certificate = DB::table('set_result')
                    ->join('student_login', 'set_result.sr_FK_of_student_id', '=', 'student_login.sl_id')
                    ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
                    ->join('center_login', 'set_result.sr_FK_of_center_id', '=', 'center_login.cl_id')
                    ->where('student_login.sl_reg_no', $registrationNo)
                    ->where('student_login.sl_dob', $dob)
                    ->select(
                        'set_result.*',
                        'student_login.*',
                        'course.c_full_name',
                        'course.c_short_name',
                        'course.c_duration',
                        'center_login.cl_name',
                        'center_login.cl_center_name',
                        'center_login.cl_code',
                        'center_login.cl_center_address',
                        'center_login.cl_cin_no'
                    )
                    ->first();
            }

            if (!$certificate) {
                return response()->json([
                    'success' => false,
                    'message' => 'No certificate found with the provided registration number and date of birth'
                ], 404);
            }

            // Check if student is approved (status should be VERIFIED or higher)
            if ($certificate->sl_status == 'PENDING' || $certificate->sl_status == 'BLOCK') {
                return response()->json([
                    'success' => false,
                    'message' => 'Student registration is pending approval. Certificate cannot be verified until admin approves the student.'
                ], 403);
            }

            return response()->json([
                'success' => true,
                'data' => $certificate
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function downloadDocument($slug)
    {
        $data = DB::table('cms_downloads')->where('slug',$slug)->first();
        return view('frontend.download-document', compact('data'));
    }

    public function typing()
    {
        return view('frontend.typing');
    }

    // Downloads
    public function franchisee()
    {
        return view('frontend.franchisee');
    }

    public function admission()
    {
        return view('frontend.admission');
    }

    public function companyCertificate()
    {
        return view('frontend.company-certificate');
    }

    public function pancard()
    {
        return view('frontend.pancard');
    }

    public function udyam()
    {
        return view('frontend.udyam');
    }

    public function startup()
    {
        return view('frontend.startup');
    }

    public function iso()
    {
        return view('frontend.iso');
    }

    public function trademark()
    {
        return view('frontend.trademark');
    }

    // Gallery
    public function gallery()
    {
        return view('frontend.gallery');
    }

    public function courseDetails($slug){
        // Try to find by slug first
        $data = DB::table('cms_course')->where('slug', $slug)->first();
        
        // If not found by slug, try by c_id (fallback)
        if(!$data && is_numeric($slug)) {
            $data = DB::table('cms_course')->where('c_id', $slug)->first();
        }
        
        // If course still not found, return 404
        if(!$data) {
            abort(404, 'Course not found');
        }
        
        // Get category name if exists
        if($data->category_id) {
            $category = DB::table('cms_course_category')->where('id', $data->category_id)->first();
            $data->category_name = $category->name ?? null;
        }
        
        // Get related courses from same category
        $relatedCourses = [];
        if($data->category_id) {
            $relatedCourses = DB::table('cms_course')
                ->where('category_id', $data->category_id)
                ->where('c_id', '!=', $data->c_id)
                ->whereNotNull('slug')
                ->limit(3)
                ->get();
        }
        
        // Get all categories for sidebar
        $allCategories = DB::table('cms_course_category')->where('status', 1)->get();
        
        return view('frontend.course-details', compact('data', 'relatedCourses', 'allCategories'));
    }

    public function coursesByCategory($slug){
        $category = DB::table('cms_course_category')->where('slug', $slug)->where('status', 1)->first();
        
        if(!$category) {
            abort(404);
        }
        
        $courses = DB::table('cms_course')->where('category_id', $category->id)->get();
        $categories = DB::table('cms_course_category')->where('status', 1)->get();
        
        return view('frontend.courses', compact('courses', 'category', 'categories'));
    }

    // Contact
    public function contact()
    {
        return view('frontend.contact');
    }

    // Store Contact Form Data
    public function storeContact(Request $request)
    {
        // Validate the request
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Combine first name and last name into name
        $name = trim($request->fname . ' ' . $request->lname);

        // Insert data into contact_requests table using Query Builder
        DB::table('contact_requests')->insert([
            'name' => $name,
            'email' => $request->email,
            'phone' => $request->phone ?? null,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Thank you! Your message has been sent successfully.');
    }

    public function paymentTerms()
    {
        // Try to fetch from cms_pages table, fallback to static view
        $page = DB::table('cms_pages')->where('slug', 'terms-and-conditions')->where('status', 1)->first();
        if($page) {
            return view('frontend.page', compact('page'));
        }
        return view('frontend.payment-terms');
    }

    public function paymentRefunds()
    {
        // Try to fetch from cms_pages table, fallback to static view
        $page = DB::table('cms_pages')->where('slug', 'refund-policy')->where('status', 1)->first();
        if($page) {
            return view('frontend.page', compact('page'));
        }
        return view('frontend.payment-refunds');
    }

    public function sitemap()
    {
        return view('frontend.sitemap');
    }

    public function disclaimer()
    {
        // Try to fetch from cms_pages table, fallback to static view
        $page = DB::table('cms_pages')->where('slug', 'disclaimer')->where('status', 1)->first();
        if($page) {
            return view('frontend.page', compact('page'));
        }
        return view('frontend.disclaimer');
    }

    // Dynamic page view
    public function page($slug)
    {
        $page = DB::table('cms_pages')->where('slug', $slug)->where('status', 1)->first();
        
        if(!$page) {
            abort(404, 'Page not found');
        }
        
        return view('frontend.page', compact('page'));
    }

    public function director()
    {
        return view('frontend.director');
    }

    public function course()
    {
        $courses = DB::table('cms_course')->get();
        $categories = DB::table('cms_course_category')->where('status', 1)->get();
        $category = null; // all courses
        
        return view('frontend.courses', compact('courses', 'categories', 'category'));
    }

    public function certificate()
    {
        return view('frontend.certificate');
    }

    public function showCertificate(Request $request)
    {
        $registrationNo = $request->input('registration_no');
        $dob = $request->input('dob');

        if (!$registrationNo || !$dob) {
            return redirect()->route('verification.certificate')
                ->with('error', 'Registration number and date of birth are required');
        }

        try {
            // First try to fetch from student_certificates table
            $certificate = DB::table('student_certificates')
                ->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
                ->join('set_result', 'student_certificates.sc_FK_of_result_id', '=', 'set_result.sr_id')
                ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
                ->join('center_login', 'student_certificates.sc_FK_of_center_id', '=', 'center_login.cl_id')
                ->where('student_login.sl_reg_no', $registrationNo)
                ->where('student_login.sl_dob', $dob)
                ->select(
                    'student_certificates.*',
                    'student_login.*',
                    'set_result.*',
                    'course.c_full_name',
                    'course.c_short_name',
                    'course.c_duration',
                    'center_login.cl_name',
                    'center_login.cl_center_name',
                    'center_login.cl_code',
                    'center_login.cl_center_address',
                    'center_login.cl_cin_no'
                )
                ->first();

            // If certificate not found, try fetching from set_result table directly
            if (!$certificate) {
                $certificate = DB::table('set_result')
                    ->join('student_login', 'set_result.sr_FK_of_student_id', '=', 'student_login.sl_id')
                    ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
                    ->join('center_login', 'set_result.sr_FK_of_center_id', '=', 'center_login.cl_id')
                    ->where('student_login.sl_reg_no', $registrationNo)
                    ->where('student_login.sl_dob', $dob)
                    ->select(
                        'set_result.*',
                        'student_login.*',
                        'course.c_full_name',
                        'course.c_short_name',
                        'course.c_duration',
                        'center_login.cl_name',
                        'center_login.cl_center_name',
                        'center_login.cl_code',
                        'center_login.cl_center_address',
                        'center_login.cl_cin_no'
                    )
                    ->first();
            }

            if (!$certificate) {
                return redirect()->route('verification.certificate')
                    ->with('error', 'No certificate found with the provided registration number and date of birth');
            }

            // Check if student is approved (status should be VERIFIED or higher)
            if ($certificate->sl_status == 'PENDING' || $certificate->sl_status == 'BLOCK') {
                return redirect()->route('verification.certificate')
                    ->with('error', 'Student registration is pending approval. Certificate cannot be verified until admin approves the student.');
            }

            return view('frontend.certificate-view', compact('certificate'));

        } catch (\Exception $e) {
            return redirect()->route('verification.certificate')
                ->with('error', 'An error occurred while fetching certificate: ' . $e->getMessage());
        }
    }

    // XML Sitemap for search engines
    public function sitemapXml()
    {
        $courses = DB::table('cms_course')->select('slug', 'updated_at')->get();
        $downloads = DB::table('cms_downloads')->select('slug', 'updated_at')->get();
        
        return response()->view('frontend.sitemap-xml', [
            'courses' => $courses,
            'downloads' => $downloads,
        ])->header('Content-Type', 'application/xml');
    }

    public function verifyCenter($code)
    {
        $center = DB::table('center_login')->where('cl_code', $code)->first();

        if (!$center) {
            return view('frontend.verify_center_error', ['message' => 'Center not found. Please scan a valid QR code.']);
        }
        
        // Ensure center is active
        if ($center->cl_account_status !== 'ACTIVE') {
             return view('frontend.verify_center_error', ['message' => 'This Center is not currently active.']);
        }

        return view('frontend.verify_center', compact('center'));
    }

    public function sendCenterVerificationOtp(Request $request)
    {
        $code = $request->input('center_code');
        $center = DB::table('center_login')->where('cl_code', $code)->first();
        
        if(!$center){
            return response()->json(['success' => false, 'message' => 'Center not found']);
        }
        
        $otp = rand(100000, 999999);
        Session::put('verify_otp_' . $code, $otp);
        Session::put('verify_otp_time_' . $code, time()); // Store time to check expiry if needed
        
        // Simple text email for OTP
        try {
            // Check if center has email
            if(!filter_var($center->cl_email, FILTER_VALIDATE_EMAIL)){
                 return response()->json(['success' => false, 'message' => 'Center does not have a valid email address.']);
            }

            Mail::raw("Your OTP for Center Certificate Verification is: $otp. Do not share this OTP with anyone.", function ($message) use ($center) {
                $message->to($center->cl_email)
                        ->subject('Verification OTP - Maya Computer Center');
            });
            
            return response()->json(['success' => true, 'message' => 'OTP sent to registered email address.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to send OTP: ' . $e->getMessage()]);
        }
    }

    public function verifyCenterOtp(Request $request)
    {
        $code = $request->input('center_code');
        $inputOtp = $request->input('otp');
        
        $sessionOtp = Session::get('verify_otp_' . $code);
        
        if($sessionOtp && $sessionOtp == $inputOtp){
            Session::put('verified_center_' . $code, true);
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false, 'message' => 'Invalid OTP']);
    }

    public function viewCenterCertificatePublic($code)
    {
        // Check if verified in session
        if (!Session::get('verified_center_' . $code)) {
             return redirect()->route('verify_center', $code)->with('error', 'Please verify with OTP first.');
        }

        $center = DB::table('center_login')->where('cl_code', $code)->first();
        if (!$center) {
            abort(404, 'Center not found');
        }
        
        // Optional: Ensure center is active for certificate view too
         if ($center->cl_account_status !== 'ACTIVE') {
            abort(403, 'Center is not active.');
        }
        
        $setting = DB::table('site_settings')->first();
        return view('center_certificate', compact('center', 'setting'));
    }
}
