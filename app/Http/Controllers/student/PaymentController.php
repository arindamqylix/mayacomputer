<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Auth;

class PaymentController extends Controller
{
    public function view_payment()
    {
        $student = Auth::guard('student')->user();

        $payment_list = student_fee_payments_query($student)
            ->orderByDesc('fp_id')
            ->get();

        return view('student.view_payment_history', compact('payment_list'));
    }
}
