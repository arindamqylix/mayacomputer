<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\student\AuthController;
use App\Http\Controllers\student\MarkSheetController;
use App\Http\Controllers\student\PaymentController;
use App\Http\Controllers\student\IdCardController;


Route::get('student/login', [AuthController::class, 'student_login'])->name('student_login');
Route::post('student/login', [AuthController::class, 'student_login_now'])->name('student_login');

Route::group(['prefix'=>'student', 'middleware'=>'student:student'], function(){
	Route::get('dashboard', [AuthController::class, 'student_dashboard'])->name('student_dashboard');
	Route::get('logout', [AuthController::class, 'student_logout'])->name('student_logout');

	// Marksheet
	Route::get('view-marksheet', [MarkSheetController::class, 'view_marksheet'])->name('view_marksheet');

	// View Payment
	Route::get('view-payment-history', [PaymentController::class, 'view_payment'])->name('view_payment');

	Route::get('view-id-card', [IdCardController::class, 'view_id_card'])->name('view_id_card');
});