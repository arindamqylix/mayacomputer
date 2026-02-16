<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\generatePdfController;
use App\Http\Controllers\PagesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/admin_route.php';
require __DIR__.'/center_route.php';
require __DIR__.'/student_route.php';

Route::get('center/generate-pdf/{id}', [App\Http\Controllers\generatePdfController::class, 'generate_result'])->name('generatePDF');

// Home
Route::get('/', [PagesController::class, 'index'])->name('index');

// About
Route::get('/directors', [PagesController::class, 'director'])->name('director');
Route::get('/teacher', [PagesController::class, 'teacher'])->name('teacher');
Route::get('/about-us', [PagesController::class, 'aboutus'])->name('aboutus');

// Courses
Route::get('/course', [PagesController::class, 'course'])->name('courses');
Route::get('/courses/category/{slug}', [PagesController::class, 'coursesByCategory'])->name('courses.category');
Route::get('/courses-details/{slug}', [PagesController::class, 'courseDetails'])->name('courses.details');

// Verification
Route::get('/verification/registration', [PagesController::class, 'registration'])->name('verification.registration');
Route::post('/verification/registration-card-data', [PagesController::class, 'getRegistrationCardData'])->name('verification.registration.card.data');
Route::post('/verification/registration-card-pdf', [PagesController::class, 'generateRegistrationCardPDF'])->name('verification.registration.card.pdf');
Route::get('/verification/icard', [PagesController::class, 'icard'])->name('verification.icard');
Route::post('/verification/icard-data', [PagesController::class, 'getIcardData'])->name('verification.icard.data');
Route::get('/verification/result', [PagesController::class, 'result'])->name('verification.result');
Route::post('/verification/result-data', [PagesController::class, 'getResultData'])->name('verification.result.data');
Route::get('/verification/certificate', [PagesController::class, 'certificate'])->name('verification.certificate');
Route::get('/verification/certificate/view', [PagesController::class, 'showCertificate'])->name('verification.certificate.view');
Route::post('/verification/certificate-data', [PagesController::class, 'getCertificateData'])->name('verification.certificate.data');
Route::get('verify-certificate/{certificate_number}', [PagesController::class, 'verifyCertificateByNumber'])->name('verify_certificate');
Route::get('/verification/typing', [PagesController::class, 'typing'])->name('verification.typing');
Route::get('verify-center/{code}', [PagesController::class, 'verifyCenter'])->name('verify_center');
Route::post('verify-center/send-otp', [PagesController::class, 'sendCenterVerificationOtp'])->name('verify_center.send_otp');
Route::post('verify-center/verify-otp', [PagesController::class, 'verifyCenterOtp'])->name('verify_center.verify_otp');
Route::get('verify-center/certificate/{code}', [PagesController::class, 'viewCenterCertificatePublic'])->name('verify_center.certificate');

// Downloads
Route::get('/downloads/{slug}', [PagesController::class, 'downloadDocument'])->name('downloads.document');
Route::get('/downloads/admission-form', [PagesController::class, 'admission'])->name('downloads.admission');
Route::get('/downloads/company-certificate', [PagesController::class, 'companyCertificate'])->name('downloads.certificate.company');
Route::get('/downloads/pan-card', [PagesController::class, 'pancard'])->name('downloads.pancard');
Route::get('/downloads/udyam-registration', [PagesController::class, 'udyam'])->name('downloads.udyam');
Route::get('/downloads/startup-india', [PagesController::class, 'startup'])->name('downloads.startup');
Route::get('/downloads/iso-certificate', [PagesController::class, 'iso'])->name('downloads.iso');
Route::get('/downloads/trademark', [PagesController::class, 'trademark'])->name('downloads.trademark');


Route::get('/terms-and-conditions', [PagesController::class, 'paymentTerms'])->name('paymentTerms');
Route::get('/refund-policy', [PagesController::class, 'paymentRefunds'])->name('paymentRefunds');
Route::get('/sitemap', [PagesController::class, 'sitemap'])->name('sitemap');
Route::get('/sitemap.xml', [PagesController::class, 'sitemapXml'])->name('sitemap.xml');
Route::get('/disclaimer', [PagesController::class, 'disclaimer'])->name('disclaimer');
// Dynamic page route (should be last to catch any page slugs)
Route::get('/page/{slug}', [PagesController::class, 'page'])->name('page.show');

// Gallery
Route::get('/our-gallery', [PagesController::class, 'gallery'])->name('gallery');

// Contact
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::post('/contact', [PagesController::class, 'storeContact'])->name('contact.store');

