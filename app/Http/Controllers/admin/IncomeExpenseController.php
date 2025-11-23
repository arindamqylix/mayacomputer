<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\IncomeExpense;
use Auth;
use DB;
class IncomeExpenseController extends Controller
{
    public function income_expense(){
    	$wallet_balance = IncomeExpense::selectRaw('(SUM(CASE WHEN ie_type = "INCOME" THEN ie_amount ELSE 0 END) - SUM(CASE WHEN ie_type = "EXPENSE" THEN ie_amount ELSE 0 END)) AS wallet_balance')
                        ->where('ie_FK_of_admin_id', Auth::guard('admin')->user()->al_id)
                        ->first();
        
        $total_income = IncomeExpense::selectRaw('(SUM(CASE WHEN ie_type = "INCOME" THEN ie_amount ELSE 0 END)) AS total_income')
                        ->where('ie_FK_of_admin_id', Auth::guard('admin')->user()->al_id)
                        ->first();

        $total_expense = IncomeExpense::selectRaw('(SUM(CASE WHEN ie_type = "EXPENSE" THEN ie_amount ELSE 0 END)) AS total_expense')
                        ->where('ie_FK_of_admin_id', Auth::guard('admin')->user()->al_id)
                        ->first();

    	$income_expense['income_expense'] = DB::table('admin_login')
    					  ->join('income_expense', 'admin_login.al_id', 'income_expense.ie_FK_of_admin_id')
    					  ->get();
    	return view('admin.income_expense.index',$income_expense, compact('wallet_balance','total_income', 'total_expense'));
    }

    public function income_expense_create(Request $request){
    	$data = [
    		'ie_FK_of_admin_id'	=> Auth::guard('admin')->user()->al_id,
    		'ie_type'				=> $request->txn_type,
    		'ie_date'				=> $request->txn_date,
    		'ie_amount'				=> $request->txn_amount,
    		'ie_mode'				=> $request->txn_mode,
    		'ie_remarks'			=> $request->txn_remarks,
    	];

    	$insert = IncomeExpense::create($data);
    	if($insert):
    		return back()->with('success', 'Record Added Successfully!');
    	else:
    		return back()->with('error', 'Something Went Wrong!');
    	endif;
    }

    public function income_expense_delete($id){
    	$data = IncomeExpense::where('ie_id',$id)->delete();
    	if($insert):
    		return back()->with('success', 'Record Deleted Successfully!');
    	else:
    		return back()->with('error', 'Something Went Wrong!');
    	endif;
    }
}
