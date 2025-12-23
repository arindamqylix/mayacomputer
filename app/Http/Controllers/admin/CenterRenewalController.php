<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Center;
use Carbon\Carbon;
use DB;

class CenterRenewalController extends Controller
{
    // Show renewal page for a center
    public function renew($id)
    {
        $center = Center::findOrFail($id);
        return view('admin.center.renew', compact('center'));
    }

    // Process renewal
    public function renewNow(Request $request, $id)
    {
        $center = Center::findOrFail($id);
        
        // Get current valid_till date or registration date
        $currentValidTill = $center->cl_valid_till ? Carbon::parse($center->cl_valid_till) : Carbon::parse($center->cl_registration_date);
        
        // Calculate new valid_till date (5 years from current valid_till or from now if expired)
        if ($currentValidTill->isPast()) {
            // If already expired, start from today
            $newValidTill = Carbon::now()->addYears(5);
            $registrationDate = Carbon::now();
        } else {
            // If not expired, extend from current valid_till
            $newValidTill = $currentValidTill->copy()->addYears(5);
            $registrationDate = $center->cl_registration_date ? Carbon::parse($center->cl_registration_date) : Carbon::now();
        }

        $update = $center->update([
            'cl_valid_till' => $newValidTill->format('Y-m-d'),
            'cl_registration_date' => $registrationDate->format('Y-m-d'),
        ]);

        if ($update) {
            return redirect()->route('center_list')->with('success', 'Center registration renewed successfully! Valid till: ' . $newValidTill->format('d/m/Y'));
        } else {
            return back()->with('error', 'Failed to renew center registration!');
        }
    }
}

