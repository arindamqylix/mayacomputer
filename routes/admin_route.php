 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CenterController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\admin\CenterPaymentController;
use App\Http\Controllers\admin\IncomeExpenseController;
use App\Http\Controllers\admin\DownloadController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\SiteSettingController;
use App\Http\Controllers\admin\ContactRequestController;
use App\Http\Controllers\admin\CmsCourseController;
use App\Http\Controllers\admin\CmsDirectorController;


Route::get('admin/login', [AuthController::class, 'admin_login'])->name('admin_login');
Route::post('admin/login', [AuthController::class, 'admin_login_now'])->name('admin_login');

Route::group(['prefix'=>'admin', 'middleware'=>'admin:admin'], function(){
	Route::get('dashboard', [AuthController::class, 'admin_dashboard'])->name('admin_dashboard');
	Route::get('logout', [AuthController::class, 'admin_logout'])->name('admin_logout');
	
	// Center
	Route::get('center-list', [CenterController::class, 'center_list'])->name('center_list');
	Route::get('add-center', [CenterController::class, 'add_center'])->name('add_center');
	Route::post('add-center', [CenterController::class, 'add_center_now'])->name('add_center'); 
	Route::get('edit-center/{id}', [CenterController::class, 'edit_center'])->name('edit_center');
	Route::post('edit-center/{id}', [CenterController::class, 'update_center'])->name('edit_center'); 
	Route::get('delete-center/{id}', [CenterController::class, 'delete_center'])->name('delete_center'); 
	Route::get('center-account-status', [CenterController::class, 'center_status'])->name('center.status');
	Route::get('center-certificate/{id}', [CenterController::class, 'center_certificate'])->name('view_center_certificate');

	// Student
	Route::get('add-new-student', [StudentController::class, 'add_student'])->name('add_new_student');
	Route::post('add-new-student', [StudentController::class, 'add_student_now'])->name('add_new_student');
	Route::get('student-list', [StudentController::class, 'student_list'])->name('student_list');
	Route::get('add-student', [StudentController::class, 'add_student'])->name('add_student');
	Route::post('add-student', [StudentController::class, 'add_student_now'])->name('add_student');
	Route::get('edit-student/{id}', [StudentController::class, 'edit_student'])->name('edit_student');
	Route::post('edit-student/{id}', [StudentController::class, 'update_student'])->name('edit_student');
	Route::get('delete-student/{id}', [StudentController::class, 'delete_student'])->name('delete_student');
	Route::get('student-status-update', [StudentController::class, 'student_status_updated'])->name('student_status_updated');
	Route::get('print-student-application/{id}', [StudentController::class, 'student_application'])->name('student_application_view');
	Route::get('get-reg-no', [StudentController::class, 'get_reg_no'])->name('get_reg_no');

	// Course
	Route::get('course-list', [CourseController::class, 'course_list'])->name('course_list');
	Route::get('add-course', [CourseController::class, 'add_course'])->name('add_course');
	Route::post('add-course', [CourseController::class, 'add_course_now'])->name('add_course');
	Route::get('edit-course/{id}', [CourseController::class, 'edit_course'])->name('edit_course');
	Route::post('edit-course/{id}', [CourseController::class, 'update_course'])->name('edit_course');
	Route::get('delete-course/{id}', [CourseController::class, 'delete_course'])->name('delete_course');

	// Upadate Student Registration Fees
	Route::get('set-student-registration-fees', [StudentController::class, 'set_reg_fee'])->name('set_reg_fee');
	Route::post('set-student-registration-fees', [StudentController::class, 'update_reg_fee'])->name('set_reg_fee');

	// Center Transaction
	Route::get('center-transaction-history', [CenterPaymentController::class, 'center_transaction_payment'])->name('center_transaction_payment');

	//center Payment History
	Route::get('center-payment-history', [CenterPaymentController::class, 'center_payment'])->name('center_payment');

	// Income/Expense
	Route::get('income-and-expense', [IncomeExpenseController::class, 'income_expense'])->name('admin_income_expense');
	Route::post('income-and-expense', [IncomeExpenseController::class, 'income_expense_create'])->name('admin_income_expense_create');
	Route::get('income-and-expense-delete/{id}', [IncomeExpenseController::class, 'income_expense_delete'])->name('admin_income_expense_delete');

	// View Result
	Route::get('student-result-list', [StudentController::class, 'student_result_list'])->name('student_result_view');

	// Change Password
	Route::get('change-password', [AuthController::class, 'change_password'])->name('admin_change_password');
	Route::post('change-password', [AuthController::class, 'change_password_save'])->name('admin_change_password_save');

	// Profile Settings
	Route::get('profile-update', [AuthController::class, 'profile_update'])->name('admin_profile_update');
	Route::post('profile-update', [AuthController::class, 'profile_update_now'])->name('admin_profile_update');

	/* ============ CMS Route Start=========== */

	// Download
	Route::get('all-download-form', [DownloadController::class, 'all_download_form'])->name('all_download_form');
	Route::get('add-download-form', [DownloadController::class, 'add_download_form'])->name('add_download_form');
	Route::post('add-download-form', [DownloadController::class, 'handle_download_form'])->name('handle_download_form');
	Route::get('edit-download-form/{id}', [DownloadController::class, 'edit_download_form'])->name('edit_download_form');
	Route::post('edit-download-form/{id}', [DownloadController::class, 'update_download_form'])->name('edit_download_form');
	Route::get('delete-download-form/{id}', [DownloadController::class, 'delete_download_form'])->name('delete_download_form');

	// Gallery
	Route::get('all-gallery', [GalleryController::class, 'all_gallery'])->name('all_gallery');
	Route::get('add-gallery', [GalleryController::class, 'add_gallery'])->name('add_gallery');
	Route::post('add-gallery', [GalleryController::class, 'handle_gallery'])->name('handle_gallery');
	Route::get('edit-gallery/{id}', [GalleryController::class, 'edit_gallery'])->name('edit_gallery');
	Route::post('edit-gallery/{id}', [GalleryController::class, 'update_gallery'])->name('edit_gallery');
	Route::get('delete-gallery/{id}', [GalleryController::class, 'delete_gallery'])->name('delete_gallery');

	// Banner
	Route::get('all-banner', [BannerController::class, 'all_banner'])->name('all_banner');
	Route::get('add-banner', [BannerController::class, 'add_banner'])->name('add_banner');
	Route::post('add-banner', [BannerController::class, 'handle_banner'])->name('handle_banner');
	Route::get('edit-banner/{id}', [BannerController::class, 'edit_banner'])->name('edit_banner');
	Route::post('edit-banner/{id}', [BannerController::class, 'update_banner'])->name('edit_banner');
	Route::get('delete-banner/{id}', [BannerController::class, 'delete_banner'])->name('delete_banner');

	// Site Settings
	Route::get('site-settings', [SiteSettingController::class, 'edit'])->name('site_settings.edit');
	Route::post('site-settings', [SiteSettingController::class, 'update'])->name('site_settings.update');

	// Contact Request 
	Route::get('/contact-requests', [ContactRequestController::class, 'index'])->name('contact.index');
	Route::get('contact-requests/{id}', [ContactRequestController::class, 'destroy'])->name('contact.destroy');

	// Course
	Route::get('/courses', [CmsCourseController::class, 'index'])->name('course.list');
    Route::get('/courses/add', [CmsCourseController::class, 'create'])->name('add.course');
    Route::post('/courses/store', [CmsCourseController::class, 'store'])->name('store.course');
    Route::get('/courses/edit/{id}', [CmsCourseController::class, 'edit'])->name('edit.course');
    Route::post('/courses/update/{id}', [CmsCourseController::class, 'update'])->name('update.course');
    Route::get('/courses/delete/{id}', [CmsCourseController::class, 'destroy'])->name('delete.course');

	// Director
	Route::get('/directors', [CmsDirectorController::class, 'index'])->name('director_list');
    Route::get('/directors/add', [CmsDirectorController::class, 'create'])->name('add_director');
    Route::post('/directors/store', [CmsDirectorController::class, 'store'])->name('store_director');
    Route::get('/directors/edit/{id}', [CmsDirectorController::class, 'edit'])->name('edit_director');
    Route::post('/directors/update/{id}', [CmsDirectorController::class, 'update'])->name('update_director');
    Route::get('/directors/delete/{id}', [CmsDirectorController::class, 'destroy'])->name('delete_director');

	/* ============ CMS Route End =========== */
});