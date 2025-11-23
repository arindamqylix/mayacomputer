<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\SetFee;
use App\Models\center\FeesPayment;
use DB;
use Auth;
class SearchPayController extends Controller
{
    public function search_to_pay(){
    	$student['student'] = DB::table('student_login')
    							->join('set_fee', 'student_login.sl_id', 'set_fee.sf_FK_of_student_id')
    							->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
    							->where('set_fee.sf_FK_of_center_id', Auth::guard('center')->user()->cl_id)
    							->get();

    	return view('center.search_to_pay.index',$student);
    }

    public function fees_payment(){
    	$student = DB::table('student_login')
    					->join('set_fee', 'student_login.sl_id','set_fee.sf_FK_of_student_id')
    					->where('set_fee.sf_FK_of_student_id',request()->get('student_id'))
    					->first();

    	$payment_list['payment_list'] = FeesPayment::where('fp_FK_of_student_id', request()->get('student_id'))->get();

    	return view('center.fees_payment.index', compact('student'),$payment_list);
    }

    public function fees_payment_create(Request $request){

    	// Get the latest invoice number from the database
		$latestInvoice = FeesPayment::latest()->first();

		if ($latestInvoice) {
		    // Extract the number part of the invoice number and increment it
		    $lastNumber = (int) substr($latestInvoice->fp_receipt_no, -4);
		    $newNumber = $lastNumber + 1;
		} else {
		    // If there are no existing invoices, start with 1
		    $newNumber = 1;
		}

		// Generate the new invoice number with leading zeros
		$newInvoiceNumber = str_pad($newNumber, 4, '0', STR_PAD_LEFT);

    	$data = [
    		'fp_receipt_no'				=> $newInvoiceNumber,
    		'fp_FK_of_student_id'		=> $request->student_id,
    		'fp_FK_of_center_id'		=> Auth::guard('center')->user()->cl_id,
    		'fp_date'					=> $request->paid_date,
    		'fp_total_amount'			=> $request->total_amount,
    		'fp_amount'					=> $request->paid_amount,
    		'fp_remarks'				=> $request->remarks
    	];

    	$fees_payment = FeesPayment::create($data);

    	$set_fee = SetFee::where('sf_FK_of_student_id', $request->student_id)->first();
  		$update_set_fee_table = SetFee::where('sf_FK_of_student_id', $request->student_id)->update([
  				'sf_paid'		=> $set_fee->sf_paid + $request->paid_amount,
  				'sf_due'		=> $set_fee->sf_due - $request->paid_amount
  			]);

  		return back()->with('success', 'Payment Created Successfully!');
    }

    public function print_receipt($id){

    	$print_receipt = DB::table('student_login')
    					 ->join('set_fee', 'student_login.sl_id', 'set_fee.sf_FK_of_student_id')
    					 ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
    					 
    					 ->where('set_fee.sf_FK_of_student_id',$id)
    					 ->first();

    	return view('center.fees_payment.print_receipt', compact('print_receipt'));
    }
}
