<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Transaction;
use App\Models\center\Center;
use DB;
use Auth;
class TransactionController extends Controller
{
    public function view_transaction(){
    	$transaction['transaction'] = DB::table('center_login')
    								  ->join('transaction', 'center_login.cl_id', 'transaction.t_FK_of_center_id')
    								  ->where('center_login.cl_id',Auth::guard('center')->user()->cl_id)
    								  ->get();
    	return view('center.view_transaction.index',$transaction);
    }
}
