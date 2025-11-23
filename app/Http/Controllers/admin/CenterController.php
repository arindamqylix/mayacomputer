<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Center; 
use Hash;
use Illuminate\Support\Facades\Storage;
class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function center_list()
    {
        $center['center'] = Center::orderBy('cl_id', 'DESC')->get();
        return view('admin.center.index', $center);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_center()
    {
        return view('admin.center.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_center_now(Request $request)
    {
        // Fetch last center record
        $lastInvoice = Center::orderBy('cl_id', 'desc')->first();

        // If no center exists, start from 61123000
        if (!$lastInvoice) {
            $nextInvoiceNumber = '61123000';
        } else {
            // Take last cl_code and increment
            $lastInvoiceNumber = (int) $lastInvoice->cl_code;
            $nextInvoiceNumber = str_pad($lastInvoiceNumber + 1, 8, '0', STR_PAD_LEFT);
        }

        // File uploads (using Laravel storage/public)
        $photo = $center_stamp = $center_signature = $director_adhar = $director_pan = null;

        // --------------- USE SYMLINK STORAGE -----------------

        // Save Center Photo
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('center', $file, $filename);
            $photo = 'center/' . $filename;
        }

        // Save Center Stamp
        if ($request->hasFile('center_stamp')) {
            $file = $request->file('center_stamp');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('center', $file, $filename);
            $center_stamp = 'center/' . $filename;
        }

        // Save Center Signature
        if ($request->hasFile('center_signature')) {
            $file = $request->file('center_signature');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('center', $file, $filename);
            $center_signature = 'center/' . $filename;
        }

        // Save Director Aadhar
        if ($request->hasFile('director_adhar')) {
            $file = $request->file('director_adhar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('center', $file, $filename);
            $director_adhar = 'center/' . $filename;
        }

        // Save Director PAN
        if ($request->hasFile('director_pan')) {
            $file = $request->file('director_pan');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('center', $file, $filename);
            $director_pan = 'center/' . $filename;
        }

        // ------------------------------------------------------

        // Insert data
        $data = [
            'cl_code'               => $nextInvoiceNumber,
            'cl_center_name'        => $request->center_name,
            'cl_director_name'      => $request->director_name,
            'cl_center_address'     => $request->center_address,
            'cl_name'               => $request->center_name,
            'cl_photo'              => $photo,
            'cl_center_stamp'       => $center_stamp,
            'cl_center_signature'   => $center_signature,
            'cl_director_adhar'     => $director_adhar,
            'cl_wallet_balance'     => $request->cl_wallet_balance,
            'cl_director_pan'       => $director_pan,
            'cl_director_education' => $request->director_education,
            'cl_mobile'             => $request->center_mobile,
            'password'              => Hash::make($request->center_mobile),
            'cl_account_status'     => 'APPROVED',
            'cl_email'              => $request->center_email,
        ];

        $insert = Center::create($data);

        if ($insert) {
            return redirect()->route('center_list')->with('success', 'Center Added Successfully!');
        } else {
            return back()->with('error', 'Failed to Add Center!');
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function edit_center($id)
    {
        $data = Center::where('cl_id',$id)->first();
        return view('admin.center.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_center(Request $request, $id)
    {
        $exist = Center::findOrFail($id);

        // Keep old values by default
        $photo            = $exist->cl_photo;
        $center_stamp     = $exist->cl_center_stamp;
        $center_signature = $exist->cl_center_signature;
        $director_adhar   = $exist->cl_director_adhar;
        $director_pan     = $exist->cl_director_pan;

        // Directory inside storage/app/public
        $dir = 'center';

        // Helper to upload file
        $upload = function ($file) use ($dir) {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs($dir, $file, $filename);
            return $dir . '/' . $filename; // DB value
        };

        // Upload new Center Photo
        if ($request->hasFile('photo')) {
            $photo = $upload($request->file('photo'));
        }

        // Upload new Center Stamp
        if ($request->hasFile('center_stamp')) {
            $center_stamp = $upload($request->file('center_stamp'));
        }

        // Upload new Center Signature
        if ($request->hasFile('center_signature')) {
            $center_signature = $upload($request->file('center_signature'));
        }

        // Upload Director Aadhar
        if ($request->hasFile('director_adhar')) {
            $director_adhar = $upload($request->file('director_adhar'));
        }

        // Upload Director PAN
        if ($request->hasFile('director_pan')) {
            $director_pan = $upload($request->file('director_pan'));
        }

        // Prepare update data
        $data = [
            'cl_center_name'        => $request->center_name,
            'cl_director_name'      => $request->director_name,
            'cl_center_address'     => $request->center_address,
            'cl_name'               => $request->center_name,
            'cl_photo'              => $photo,
            'cl_center_stamp'       => $center_stamp,
            'cl_center_signature'   => $center_signature,
            'cl_director_adhar'     => $director_adhar,
            'cl_director_pan'       => $director_pan,
            'cl_wallet_balance'     => $request->cl_wallet_balance,
            'cl_director_education' => $request->director_education,
            'cl_mobile'             => $request->center_mobile,
            'password'              => Hash::make($request->center_mobile),
            'cl_email'              => $request->center_email,
        ];

        $update = $exist->update($data);

        if ($update) {
            return redirect()->route('center_list')->with('success', 'Center Updated Successfully!');
        } else {
            return back()->with('error', 'Failed to Update Center!');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_center($id)
    {
        try {
            $data = Center::where('cl_id',$id)->delete();
            return back()->with('success', 'Center Deleted Successfully!');
        } catch (Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }
    
    public function center_status(Request $request){
        $center = Center::where('cl_code', $request->center_code)->update([
            'cl_account_status'     => $request->center_status
        ]);
        
        if($center):
            $data = [
                'msg'   => 'Center Status Updated Successfully!',
                'status'    => 1,
            ];
        else:
            $data = [
                'msg'   => 'Something Went Wrong!',
                'status'    => 0,
            ];
        endif;
        
        return response()->json($data);
    }
    
    public function center_certificate($id){
        $center = Center::where('cl_id',$id)->first();
        return view('center_certificate', compact('center'));
    }
}
