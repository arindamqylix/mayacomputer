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
use App\Http\Controllers\admin\CmsCourseCategoryController;
use App\Http\Controllers\admin\CmsDirectorController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\AboutUsController;
use App\Http\Controllers\admin\HomepageController;
use App\Http\Controllers\admin\GenerateAdmitController;
use App\Http\Controllers\admin\WhatsAppTemplateController;
use App\Http\Controllers\admin\CertificateController;
use App\Http\Controllers\admin\CourierController;
use App\Http\Controllers\admin\DocumentReissueController;
use App\Http\Controllers\admin\InvoiceController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NotificationController;


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
	Route::get('center-toggle-profile-edit', [CenterController::class, 'toggle_profile_edit'])->name('center.toggle_profile_edit');
	Route::get('center-reset-password', [CenterController::class, 'reset_center_password'])->name('center.reset_password');
	Route::get('center-certificate/{id}', [CenterController::class, 'center_certificate'])->name('view_center_certificate');
	Route::get('center-id-card/{id}', [CenterController::class, 'viewCenterIdCardAdmin'])->name('admin.view_center_id_card');
	Route::get('center-renew/{id}', [App\Http\Controllers\admin\CenterRenewalController::class, 'renew'])->name('admin.center.renew');
	Route::post('center-renew/{id}', [App\Http\Controllers\admin\CenterRenewalController::class, 'renewNow'])->name('admin.center.renew.now');

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
	Route::get('student-registration-card/{id}', [StudentController::class, 'registration_card'])->name('student_registration_card');
	Route::get('get-reg-no', [StudentController::class, 'get_reg_no'])->name('get_reg_no');

	

	// Course
	Route::get('course-list', [CourseController::class, 'course_list'])->name('course_list');
	Route::get('add-course', [CourseController::class, 'add_course'])->name('add_course');
	Route::post('add-course', [CourseController::class, 'add_course_now'])->name('add_course');
	Route::get('edit-course/{id}', [CourseController::class, 'edit_course'])->name('edit_course');
	Route::post('edit-course/{id}', [CourseController::class, 'update_course'])->name('edit_course');
	Route::get('delete-course/{id}', [CourseController::class, 'delete_course'])->name('delete_course');

	// Course Syllabus
	Route::get('syllabus-list', [App\Http\Controllers\admin\SyllabusController::class, 'index'])->name('admin.syllabus.index');
	Route::get('syllabus-add', [App\Http\Controllers\admin\SyllabusController::class, 'create'])->name('admin.syllabus.create');
	Route::post('syllabus-store', [App\Http\Controllers\admin\SyllabusController::class, 'store'])->name('admin.syllabus.store');
	Route::get('syllabus-edit/{id}', [App\Http\Controllers\admin\SyllabusController::class, 'edit'])->name('admin.syllabus.edit');
	Route::post('syllabus-update/{id}', [App\Http\Controllers\admin\SyllabusController::class, 'update'])->name('admin.syllabus.update');
	Route::get('syllabus-delete/{id}', [App\Http\Controllers\admin\SyllabusController::class, 'destroy'])->name('admin.syllabus.delete');

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

	// Generate Admit Card
	Route::get('generate-admit-card', [GenerateAdmitController::class, 'generate_admit_card'])->name('admin.generate_admit_card');
	Route::post('generate-admit-card', [GenerateAdmitController::class, 'handle_admit_card'])->name('admin.handle_admit_card');
	Route::get('admit-card-list', [GenerateAdmitController::class, 'admit_card_list'])->name('admin.admit_card_list');
	Route::get('admit-card/edit/{id}', [GenerateAdmitController::class, 'edit_admit_card'])->name('admin.edit_admit_card');
	Route::post('admit-card/update/{id}', [GenerateAdmitController::class, 'update_admit_card'])->name('admin.update_admit_card');
	Route::get('print-admit-card/{id}', [GenerateAdmitController::class, 'print_admit_card'])->name('admin.print_admit_card');
	Route::get('admit-card/delete/{id}', [GenerateAdmitController::class, 'delete_admit_card'])->name('admin.delete_admit_card');

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
	Route::delete('contact-requests/{id}', [ContactRequestController::class, 'destroy'])->name('contact.destroy');

	// Pages Management
	Route::get('/pages', [PageController::class, 'index'])->name('pages.list');
	Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
	Route::post('/pages/store', [PageController::class, 'store'])->name('pages.store');
	Route::get('/pages/edit/{id}', [PageController::class, 'edit'])->name('pages.edit');
	Route::put('/pages/update/{id}', [PageController::class, 'update'])->name('pages.update');
	Route::delete('/pages/{id}', [PageController::class, 'destroy'])->name('pages.destroy');

	// Homepage Sections Management
	Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage.index');
	Route::post('/homepage/store', [HomepageController::class, 'store'])->name('homepage.store');
	Route::get('/homepage/edit/{id}', [HomepageController::class, 'edit'])->name('homepage.edit');
	Route::put('/homepage/update/{id}', [HomepageController::class, 'update'])->name('homepage.update');
	Route::delete('/homepage/{id}', [HomepageController::class, 'destroy'])->name('homepage.destroy');

	// Course Category
	Route::get('/courses-category', [CmsCourseCategoryController::class, 'courseCategory'])->name('course.category.list');
    Route::get('/courses-category/add', [CmsCourseCategoryController::class, 'createCourseCategory'])->name('add.course.category');
    Route::post('/courses-category/store', [CmsCourseCategoryController::class, 'storeCourseCategory'])->name('store.course.category');
    Route::get('/courses-category/edit/{id}', [CmsCourseCategoryController::class, 'editCourseCategory'])->name('edit.course.category');
    Route::post('/courses-category/update/{id}', [CmsCourseCategoryController::class, 'updateCourseCategory'])->name('update.course.category');
    Route::get('/courses-category/delete/{id}', [CmsCourseCategoryController::class, 'destroyCourseCategory'])->name('delete.course.category');

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

	// About Us
	Route::get('/about-us', [AboutUsController::class, 'index'])->name('about_us.list');
    Route::get('/about-us/create', [AboutUsController::class, 'create'])->name('about_us.create');
    Route::post('/about-us/store', [AboutUsController::class, 'store'])->name('about_us.store');
    Route::get('/about-us/edit/{id}', [AboutUsController::class, 'edit'])->name('about_us.edit');
    Route::put('/about-us/update/{id}', [AboutUsController::class, 'update'])->name('about_us.update');
    Route::delete('/about-us/{id}', [AboutUsController::class, 'destroy'])->name('about_us.destroy');

	/* ============ CMS Route End =========== */

	// Chat
	Route::get('chat', [ChatController::class, 'index'])->name('admin.chat');
	Route::get('chat/{recipientType}/{recipientId}', [ChatController::class, 'index'])->name('admin.chat.with');

	// Notifications
	Route::get('notifications', [NotificationController::class, 'index'])->name('admin.notifications.index');
	Route::post('notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('admin.notifications.read');
	Route::post('notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('admin.notifications.read-all');

	// WhatsApp Templates
	Route::get('whatsapp-templates', [WhatsAppTemplateController::class, 'index'])->name('admin.whatsapp_templates.index');
	Route::get('whatsapp-templates/create', [WhatsAppTemplateController::class, 'create'])->name('admin.whatsapp_templates.create');
	Route::post('whatsapp-templates/store', [WhatsAppTemplateController::class, 'store'])->name('admin.whatsapp_templates.store');
	Route::get('whatsapp-templates/edit/{id}', [WhatsAppTemplateController::class, 'edit'])->name('admin.whatsapp_templates.edit');
	Route::put('whatsapp-templates/update/{id}', [WhatsAppTemplateController::class, 'update'])->name('admin.whatsapp_templates.update');
	Route::delete('whatsapp-templates/delete/{id}', [WhatsAppTemplateController::class, 'destroy'])->name('admin.whatsapp_templates.destroy');

	// Certificate
	Route::get('certificate-list', [CertificateController::class, 'certificate_list'])->name('admin.certificate_list');
	Route::get('certificate/generate', [CertificateController::class, 'generate_certificate'])->name('admin.certificate_generate');
	Route::post('certificate/generate', [CertificateController::class, 'generate_certificate_now'])->name('admin.certificate_store');
	Route::get('certificate/view/{id}', [CertificateController::class, 'view_certificate'])->name('admin.view_certificate');
	Route::get('certificate/delete/{id}', [CertificateController::class, 'delete_certificate'])->name('admin.delete_certificate');
	
	// Result
	Route::get('set-result', [App\Http\Controllers\admin\ResultController::class, 'set_result'])->name('admin.set_result');
	Route::post('set-result', [App\Http\Controllers\admin\ResultController::class, 'set_result_now'])->name('admin.set_result');
	Route::get('result-list', [App\Http\Controllers\admin\ResultController::class, 'result_list'])->name('admin.result_list');
	Route::get('result/edit/{id}', [App\Http\Controllers\admin\ResultController::class, 'edit_result'])->name('admin.edit_result');
	Route::post('result/update/{id}', [App\Http\Controllers\admin\ResultController::class, 'update_result'])->name('admin.update_result');
	Route::get('result/delete/{id}', [App\Http\Controllers\admin\ResultController::class, 'delete_result'])->name('admin.delete_result');
	
	// Courier
	Route::get('courier', [CourierController::class, 'index'])->name('admin.courier.index');
	Route::get('courier/center-students/{centerId}', [CourierController::class, 'getCenterStudents'])->name('admin.courier.center_students');
	Route::post('courier/dispatch', [CourierController::class, 'update_dispatch'])->name('admin.courier.update');
	Route::get('courier/dispatch/{id}', [CourierController::class, 'dispatch'])->name('admin.courier.dispatch');
	Route::post('courier/dispatch/{id}', [CourierController::class, 'update_single_dispatch'])->name('admin.courier.update_single');
	
	// Document Reissue
	Route::get('document-reissue', [DocumentReissueController::class, 'index'])->name('admin.document_reissue.index');
	Route::get('document-reissue/{id}', [DocumentReissueController::class, 'show'])->name('admin.document_reissue.show');
	Route::post('document-reissue/{id}/status', [DocumentReissueController::class, 'updateStatus'])->name('admin.document_reissue.update_status');
	Route::get('document-reissue/{id}/approve', [DocumentReissueController::class, 'approve'])->name('admin.document_reissue.approve');
	Route::get('document-reissue/{id}/complete', [DocumentReissueController::class, 'complete'])->name('admin.document_reissue.complete');
	Route::post('document-reissue/{id}/reject', [DocumentReissueController::class, 'reject'])->name('admin.document_reissue.reject');
	
	// Invoice
	Route::get('invoices/center-recharge', [InvoiceController::class, 'centerRechargeInvoices'])->name('admin.invoice.center_recharge_list');
	Route::get('invoices/center-recharge/{id}', [InvoiceController::class, 'viewCenterRechargeInvoice'])->name('admin.invoice.center_recharge_view');
	Route::get('invoices/center-recharge/{id}/download', [InvoiceController::class, 'downloadCenterRechargeInvoice'])->name('admin.invoice.center_recharge_download');
});