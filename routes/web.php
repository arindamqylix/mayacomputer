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
Route::get('/director', [PagesController::class, 'director'])->name('director');
Route::get('/teacher', [PagesController::class, 'teacher'])->name('teacher');
Route::get('/about-us', [PagesController::class, 'aboutus'])->name('aboutus');

// Courses
Route::get('/courses', [PagesController::class, 'course'])->name('courses');
Route::get('/courses/category/{slug}', [PagesController::class, 'coursesByCategory'])->name('courses.category');
Route::get('/courses-details/{slug}', [PagesController::class, 'courseDetails'])->name('courses.details');

// Verification
Route::get('/verification/registration', [PagesController::class, 'registration'])->name('verification.registration');
Route::get('/verification/icard', [PagesController::class, 'icard'])->name('verification.icard');
Route::get('/verification/result', [PagesController::class, 'result'])->name('verification.result');
Route::get('/verification/certificate', [PagesController::class, 'certificate'])->name('verification.certificate');
Route::get('/verification/typing', [PagesController::class, 'typing'])->name('verification.typing');

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

// Gallery
Route::get('/gallery', [PagesController::class, 'gallery'])->name('gallery');

// Contact
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');

