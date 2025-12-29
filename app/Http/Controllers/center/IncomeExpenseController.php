<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\IncomeExpense;
use Auth;
use DB;
class IncomeExpenseController extends Controller
{
    public function income_expense(Request $request){
    	$centerId = Auth::guard('center')->user()->cl_id;
    	
    	// Calculate totals using DB::table for better null handling
    	$wallet_balance = DB::table('income_expense')
                        ->selectRaw('COALESCE(SUM(CASE WHEN ie_type = "INCOME" THEN ie_amount ELSE 0 END) - SUM(CASE WHEN ie_type = "EXPENSE" THEN ie_amount ELSE 0 END), 0) AS wallet_balance')
                        ->where('ie_FK_of_center_id', $centerId)
                        ->first();
        
        $total_income = DB::table('income_expense')
                        ->selectRaw('COALESCE(SUM(CASE WHEN ie_type = "INCOME" THEN ie_amount ELSE 0 END), 0) AS total_income')
                        ->where('ie_FK_of_center_id', $centerId)
                        ->first();

        $total_expense = DB::table('income_expense')
                        ->selectRaw('COALESCE(SUM(CASE WHEN ie_type = "EXPENSE" THEN ie_amount ELSE 0 END), 0) AS total_expense')
                        ->where('ie_FK_of_center_id', $centerId)
                        ->first();

    	$query = DB::table('income_expense')
    				->where('ie_FK_of_center_id', $centerId);
    	
    	// Filter by transaction type if provided
    	if($request->has('txn_type') && $request->txn_type != '') {
    		$query->where('ie_type', $request->txn_type);
    	}
    	
    	$income_expense['income_expense'] = $query->orderBy('ie_date', 'desc')->get();
    	
    	return view('center.income_expense.index',$income_expense, compact('wallet_balance','total_income', 'total_expense'));
    }

    public function income_expense_create(Request $request){
    	$data = [
    		'ie_FK_of_center_id'	=> Auth::guard('center')->user()->cl_id,
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
    	if($data):
    		return back()->with('success', 'Record Deleted Successfully!');
    	else:
    		return back()->with('error', 'Something Went Wrong!');
    	endif;
    }
}
