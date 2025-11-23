<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Recharge;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Auth;
use Session;
use  App\Models\center\Center;
use DB;
class RechargeController extends Controller
{
    public function payment_form(){
    	return view('center.payment_form');
    	
    }

    public function payment_details(Request $request){
    	$api = new Api('rzp_test_Yyokf06rQ4WTfd', 'JJKf3XS4Od0o063uU3kdkVAK');
        $order  = $api->order->create(array('receipt' => '123', 'amount' => $request->amount * 100 , 'currency' => 'INR')); // Creates order
        $orderId = $order['id']; 

        $data = [
            'cr_FK_of_center_id'        => Auth::guard('center')->user()->cl_id,
            'cr_payment_id'             => $orderId,
            'cr_amount'                 => $request->amount,
        ];

        $insert = Recharge::create($data);

        $details = array(
            'order_id'      => $orderId,
            'amount'        => $request->amount
        );

        Session::put('order_id', $orderId);
        Session::put('amount' , $request->amount);

        if($insert):
            return redirect()->route('payment_confirm');
        else:
             return back();
        endif;
    }

    public function payment_confirm(){
    	return view('center.payment_confirm');
    }

    public function payment_confirm_now(Request $request){
    	$data = $request->all();
   
        $recharge = Recharge::where('cr_payment_id', $data['razorpay_order_id'])->first();
        $recharge->cr_status = 1;
        $recharge->cr_razorpay_id = $data['razorpay_payment_id'];

        $api = new Api('rzp_test_Yyokf06rQ4WTfd', 'JJKf3XS4Od0o063uU3kdkVAK');
        

        try{
            $attributes = array(
                 'razorpay_signature' => $data['razorpay_signature'],
                 'razorpay_payment_id' => $data['razorpay_payment_id'],
                 'razorpay_order_id' => $data['razorpay_order_id']
            );
            $order = $api->utility->verifyPaymentSignature($attributes);
            $success = true;
        }catch(SignatureVerificationError $e){

            $succes = false;
        }

        if($success):
        	$recharge->save();
        	$center_id = Center::where('cl_id', Auth::guard('center')->user()->cl_id)->first();
        	$center = Center::where('cl_id', Auth::guard('center')->user()->cl_id)->update([

        		'cl_wallet_balance'			=> $center_id->cl_wallet_balance + $recharge->cr_amount
        	]);
        	return redirect()->route('center_dashboard')->with('success', 'Payment Successfull!');
        else:
        	return redirect()->route('center_dashboard')->with('error', 'Payment Failed!');
        endif;
    }
    
    public function center_recharge_by_admin(){
        $center['center'] = Center::where('cl_code', '!=', '61123000')->get();
        return view('admin.center_recharge', $center);
    }
    
    public function center_recharge_by_admin_now(Request $request){
        $data = [
            'cr_FK_of_center_id'        => $request->center_id,
            'cr_amount'                 => $request->amount,
            'cr_status'                 => 1,
            'cr_deposit_by'             => 'Admin'
        ];
        
        $insert = DB::table('center_recharge')->insert($data);
        $center_id = Center::where('cl_id', $request->center_id)->first();
        
        
        
        if($insert):
            $center = Center::where('cl_id', $request->center_id)->update([
        	    'cl_wallet_balance'			=> $center_id->cl_wallet_balance + $request->amount
            ]);
            return back()->with('success', 'Center Recharge Successfully!');
        else:
            return back()->with('error', 'Something Went Wrong!');
        endif;
    }
}
