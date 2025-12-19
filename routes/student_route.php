<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\student\AuthController;
use App\Http\Controllers\student\MarkSheetController;
use App\Http\Controllers\student\PaymentController;
use App\Http\Controllers\student\IdCardController;
use App\Http\Controllers\student\RegistrationCardController;
use App\Http\Controllers\student\AdmitCardController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NotificationController;


Route::get('student/login', [AuthController::class, 'student_login'])->name('student_login');
Route::post('student/login', [AuthController::class, 'student_login_now'])->name('student_login');

Route::group(['prefix'=>'student', 'middleware'=>'student:student'], function(){
	Route::get('dashboard', [AuthController::class, 'student_dashboard'])->name('student_dashboard');
	Route::get('logout', [AuthController::class, 'student_logout'])->name('student_logout');

	// Registration Card
	Route::get('view-registration-card', [RegistrationCardController::class, 'view_registration_card'])->name('view_registration_card');

	// Admit Card
	Route::get('view-admit-card', [AdmitCardController::class, 'view_admit_card'])->name('view_admit_card');

	// Marksheet
	Route::get('view-marksheet', [MarkSheetController::class, 'view_marksheet'])->name('view_marksheet');

	// View Payment
	Route::get('view-payment-history', [PaymentController::class, 'view_payment'])->name('view_payment');

	Route::get('view-id-card', [IdCardController::class, 'view_id_card'])->name('view_id_card');

	// Chat
	Route::get('chat', [ChatController::class, 'index'])->name('student.chat');
	Route::get('chat/{recipientType}/{recipientId}', [ChatController::class, 'index'])->name('student.chat.with');

	// Notifications
	Route::get('notifications', [NotificationController::class, 'index'])->name('student.notifications.index');
	Route::post('notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('student.notifications.read');
	Route::post('notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('student.notifications.read-all');
});