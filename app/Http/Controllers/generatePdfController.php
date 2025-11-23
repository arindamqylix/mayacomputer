<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use Auth;
class generatePdfController extends Controller
{
    public function generate_result($id)
    {
        // $data = [
        //     'title' => 'My PDF Title',
        //     'heading' => 'My PDF Heading',
        //     'content' => 'This is the content of the PDF.',
        // ];

        // $pdf = PDF::loadView('result_pdf', $data)->setPaper('a4', 'portrait');
        // return $pdf->stream('myPDF.pdf');

        $data = DB::table('set_result')
    				->join('student_login', 'set_result.sr_FK_of_student_id', 'student_login.sl_id')
    				->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
    				->join('center_login', 'set_result.sr_FK_of_center_id', 'center_login.cl_id')
    				->where('set_result.sr_id', $id)
    				->first();

        return view('result_pdf', compact('data'));
    }
}
