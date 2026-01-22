<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\center\AuthController;
use App\Http\Controllers\center\StudentController;
use App\Http\Controllers\center\GenerateAdmitController;
use App\Http\Controllers\center\IncomeExpenseController;
use App\Http\Controllers\center\SetFeeController;
use App\Http\Controllers\center\SearchPayController;
use App\Http\Controllers\center\AttendanceController;
use App\Http\Controllers\center\AttendanceSetController;
use App\Http\Controllers\center\WalletStatementController;
use App\Http\Controllers\center\TransactionController;
use App\Http\Controllers\center\RechargeController;
use App\Http\Controllers\center\ResultController;
use App\Http\Controllers\center\ProfileController;
use App\Http\Controllers\center\AttendanceSheetController;
use App\Http\Controllers\center\CertificateController;
use App\Http\Controllers\center\InvoiceController;
use App\Http\Controllers\center\SyllabusController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NotificationController;


Route::get('center/login', [AuthController::class, 'center_login'])->name('center_login');
Route::post('center/login', [AuthController::class, 'center_login_now'])->name('center_login');

Route::group(['prefix' => 'center', 'middleware' => 'center:center'], function () {
	Route::get('dashboard', [AuthController::class, 'center_dashboard'])->name('center_dashboard');
	Route::get('logout', [AuthController::class, 'center_logout'])->name('center_logout');

	// Recharge Wallet
	Route::get('payment-form', [RechargeController::class, 'payment_form'])->name('payment');
	Route::post('payment-form', [RechargeController::class, 'payment_details'])->name('payment');
	Route::get('payment-confirm', [RechargeController::class, 'payment_confirm'])->name('payment_confirm');
	Route::post('payment-confirm', [RechargeController::class, 'payment_confirm_now'])->name('payment_confirm');

	// Student
	Route::get('add-student', [StudentController::class, 'add_student'])->name('add_student');
	Route::post('add-student', [StudentController::class, 'add_student_now'])->name('add_student');
	Route::get('edit-student/{id}', [StudentController::class, 'edit_student'])->name('edit.student');
	Route::post('edit-student/{id}', [StudentController::class, 'update_student'])->name('edit.student');
	Route::get('delete-student/{id}', [StudentController::class, 'delete_student'])->name('delete.student');
	Route::get('get-course', [StudentController::class, 'get_course'])->name('get_course');
	Route::get('all-student-list', [StudentController::class, 'all_student'])->name('all_student');
	Route::get('pending-student-list', [StudentController::class, 'pending_student'])->name('pending_student');
	Route::get('verified-student-list', [StudentController::class, 'verified_student'])->name('verified_student');
	Route::get('result-updated-student-list', [StudentController::class, 'result_updated_student'])->name('result_updated_student');
	Route::get('result-out-student-list', [StudentController::class, 'result_out_student'])->name('result_out_student');
	Route::get('dispatched-student-list', [StudentController::class, 'dispatched_student'])->name('dispatched_student');
	Route::get('block-student-list', [StudentController::class, 'block_student'])->name('block_student');
	Route::get('print-student-application/{id}', [StudentController::class, 'student_application'])->name('student_application');
	Route::get('student-registration-card/{id}', [StudentController::class, 'registration_card'])->name('center.student_registration_card');
	// Set Attendance (Assign Batch)
	Route::get('set-attendance', [AttendanceSetController::class, 'index'])->name('set_attendance_page');
	Route::get('set-attendance-save', [AttendanceSetController::class, 'attendance_set'])->name('attendance_set');

	// Generate Student Id Card
	Route::get('student-id-card', [StudentController::class, 'student_id_card'])->name('student_id_card');
	Route::get('view-student-id-card/{id}', [StudentController::class, 'view_student_id_card'])->name('view_student_id_card');

    // Registration Card List
	Route::get('student-registration-card-list', [StudentController::class, 'student_registration_card_list'])->name('student_registration_card_list');
	
	// Center ID Card
	Route::get('center-id-card', [App\Http\Controllers\admin\CenterController::class, 'viewCenterIdCard'])->name('center.view_id_card');
	
	// Center Certificate
	Route::get('center-certificate', [App\Http\Controllers\admin\CenterController::class, 'viewCenterCertificate'])->name('center.view_certificate');

	// Generate Admit Card
	Route::get('generate-admit-card', [GenerateAdmitController::class, 'generate_admit_card'])->name('generate_admit_card');
	Route::post('generate-admit-card', [GenerateAdmitController::class, 'handle_admit_card'])->name('generate_admit_card');
	Route::get('/center/admit-card/edit/{id}', [GenerateAdmitController::class, 'edit_admit_card'])->name('edit_admit_card');
	Route::post('/center/admit-card/update/{id}', [GenerateAdmitController::class, 'update_admit_card'])->name('update_admit_card');

	Route::get('admit-card-list', [GenerateAdmitController::class, 'admit_card_list'])->name('admit_card_list');
	Route::get('print-admit-card/{id}', [GenerateAdmitController::class, 'print_admit_card'])->name('print_admit_card');

	// Result
	Route::get('set-result', [ResultController::class, 'set_result'])->name('set_result');
	Route::post('set-result', [ResultController::class, 'set_result_now'])->name('set_result');
	Route::get('edit-result/{id}', [ResultController::class, 'edit_result'])->name('edit_result');
	Route::post('edit-result/{id}', [ResultController::class, 'update_result'])->name('edit_result');
	Route::get('student-result-list', [ResultController::class, 'student_result_list'])->name('student_result_list');

	// Certificate
	Route::get('certificate-list', [CertificateController::class, 'certificate_list'])->name('center.certificate_list');
	Route::get('generate-certificate', [CertificateController::class, 'generate_certificate'])->name('center.certificate_generate');
	Route::post('generate-certificate', [CertificateController::class, 'generate_certificate_now'])->name('center.certificate_generate_now');
	Route::get('view-certificate/{id}', [CertificateController::class, 'view_certificate'])->name('center.certificate_view');

	// View Transaction
	Route::get('view-transaction', [TransactionController::class, 'view_transaction'])->name('view_transaction');

	// Wallet Statement
	Route::get('wallet-statement', [WalletStatementController::class, 'wallet_statement'])->name('wallet_statement');

	// Manage Attendance
	Route::get('attndance-batch', [AttendanceController::class, 'attndance_batch'])->name('attndance_batch');
	Route::post('attndance-batch', [AttendanceController::class, 'attndance_batch_create'])->name('attndance_batch');
	Route::get('delete-attndance-batch/{id}', [AttendanceController::class, 'attndance_batch_delete'])->name('attndance_batch_delete');
	// Make Attendance
	Route::get('make-attendance', [AttendanceController::class, 'make_attendance'])->name('make_attendance');
	Route::post('make-attendance', [AttendanceController::class, 'mark_attendance'])->name('mark_attendance');
	Route::post('make-attendance', [AttendanceController::class, 'save_attendance'])->name('save_attendance');
	Route::get('attendance-report', [AttendanceController::class, 'attendance_report'])->name('attendance_report');

	Route::get('attendance-sheet', [AttendanceSheetController::class, 'attendance_sheet'])->name('attendance_sheet');

	// Income/Expense
	Route::get('income-and-expense', [IncomeExpenseController::class, 'income_expense'])->name('income_expense');
	Route::post('income-and-expense', [IncomeExpenseController::class, 'income_expense_create'])->name('income_expense_create');
	Route::get('income-and-expense-delete/{id}', [IncomeExpenseController::class, 'income_expense_delete'])->name('income_expense_delete');

	// Set Fee
	Route::get('set-fee', [SetFeeController::class, 'set_fee'])->name('set_fee');
	Route::get('set-fees-amount', [SetFeeController::class, 'set_fee_amount'])->name('set_fee_amount');

	// Search to pay
	Route::get('search-to-pay', [SearchPayController::class, 'search_to_pay'])->name('search_to_pay');
	Route::get('fees-payment', [SearchPayController::class, 'fees_payment'])->name('fees_payment');
	Route::post('fees-payment', [SearchPayController::class, 'fees_payment_create'])->name('fees_payment');
	Route::get('print-receipt/{id}', [SearchPayController::class, 'print_receipt'])->name('print_receipt');

	// Profile Settings
	Route::get('profile-update', [ProfileController::class, 'profile_update'])->name('profile_update');
	Route::post('profile-update', [ProfileController::class, 'profile_update_now'])->name('profile_update');

	// Change Password
	Route::get('change-password', [ProfileController::class, 'change_password'])->name('change_password');
	Route::post('change-password', [ProfileController::class, 'change_password_save'])->name('change_password_save');

	// Chat
	Route::get('chat', [ChatController::class, 'index'])->name('center.chat');
	Route::get('chat/{recipientType}/{recipientId}', [ChatController::class, 'index'])->name('center.chat.with');

	// Notifications
	Route::get('notifications', [NotificationController::class, 'index'])->name('center.notifications.index');
	Route::post('notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('center.notifications.read');
	Route::post('notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('center.notifications.read-all');
	
	// Invoice
	Route::get('invoices/wallet-recharge', [InvoiceController::class, 'walletRechargeInvoices'])->name('center.invoice.wallet_recharge_list');
	Route::get('invoices/wallet-recharge/{id}', [InvoiceController::class, 'viewWalletRechargeInvoice'])->name('center.invoice.wallet_recharge_view');
	Route::get('invoices/wallet-recharge/{id}/download', [InvoiceController::class, 'downloadWalletRechargeInvoice'])->name('center.invoice.wallet_recharge_download');
	Route::get('invoices/student-payment', [InvoiceController::class, 'studentPaymentInvoices'])->name('center.invoice.student_payment_list');
	Route::get('invoices/student-payment/{id}', [InvoiceController::class, 'viewStudentPaymentInvoice'])->name('center.invoice.student_payment_view');
	Route::get('invoices/student-payment/{id}/download', [InvoiceController::class, 'downloadStudentPaymentInvoice'])->name('center.invoice.student_payment_download');
	
	// Syllabus
	Route::get('syllabus', [SyllabusController::class, 'index'])->name('center.syllabus.index');
	Route::get('syllabus/course/{id}', [SyllabusController::class, 'viewCourse'])->name('center.syllabus.view');
	// Courier Management
	Route::get('courier-details', [App\Http\Controllers\center\CourierController::class, 'index'])->name('center.courier.index');
	Route::post('courier-received', [App\Http\Controllers\center\CourierController::class, 'update_received'])->name('center.courier.received');
});
Route::get('admin/center-recharge', [RechargeController::class, 'center_recharge_by_admin'])->name('center.recharge');
Route::post('admin/center-recharge', [RechargeController::class, 'center_recharge_by_admin_now'])->name('center.recharge');