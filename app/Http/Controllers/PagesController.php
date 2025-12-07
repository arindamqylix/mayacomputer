<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
