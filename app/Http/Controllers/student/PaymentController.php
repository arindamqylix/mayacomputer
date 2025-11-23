<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\center\FeesPayment;
use DB;
use Auth;

class PaymentController extends Controller
{
    public function view_payment()
    {
        $payment_list['payment_list'] = FeesPayment::where('fp_FK_of_student_id', Auth::guard('student')->user()->sl_id)->get();
        // dd($student, $payment_list);

        return view('student.view_payment_history', $payment_list);
    }
}
