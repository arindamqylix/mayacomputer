<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PagesController extends Controller
{
    // Home
    public function index()
    {
        return view('frontend.index');
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

    public function icard()
    {
        return view('frontend.icard');
    }

    public function result()
    {
        return view('frontend.result');
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

    public function paymentTerms()
    {
        return view('frontend.payment-terms');
    }

    public function paymentRefunds()
    {
        return view('frontend.payment-refunds');
    }

    public function sitemap()
    {
        return view('frontend.sitemap');
    }

    public function disclaimer()
    {
        return view('frontend.disclaimer');
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
}
