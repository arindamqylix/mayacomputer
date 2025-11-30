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

    public function certificate()
    {
        return view('frontend.certificate');
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
        $data = DB::table('course')->where('slug',$slug)->first();
        return view('frontend.course-details', compact('data'));
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
}
