<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\WalletStatement;
use App\Models\center\Recharge;
use App\Models\center\center;
use Auth;
class WalletStatementController extends Controller
{
    public function wallet_statement(){
    	$wallet_statement['wallet_statement'] = Recharge::where('cr_FK_of_center_id', Auth::guard('center')->user()->cl_id)->get();
    	return view('center.wallet_statement.index',$wallet_statement);
    }
}
