<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\WalletStatement;
use App\Models\center\Recharge;
use App\Models\center\center;
use Auth;
use DB;

class CenterPaymentController extends Controller
{
    public function center_payment(){
    	$wallet_statement['wallet_statement'] = DB::table('center_login')
    											->join('center_recharge', 'center_login.cl_id', 'center_recharge.cr_FK_of_center_id')
    											->get();

    	return view('admin.center_payment_history', $wallet_statement);
    }

    public function center_transaction_payment(){
    	$transaction['transaction'] = DB::table('center_login')
    								  ->join('transaction', 'center_login.cl_id', 'transaction.t_FK_of_center_id')
    								  ->get();
    	return view('admin.center_transaction_history',$transaction);
    }
}
