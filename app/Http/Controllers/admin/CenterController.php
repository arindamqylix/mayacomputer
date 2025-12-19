<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Center; 
use Hash;
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

        // File uploads
        $photo = $center_stamp = $center_signature = $director_adhar = $director_pan = null;

        // Save Center Photo
        if ($request->hasFile('photo')) {
            $uploadedFile = $request->file('photo');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('center'), $fileName);
            $photo = 'center/' . $fileName;
        }

        // Save Center Stamp
        if ($request->hasFile('center_stamp')) {
            $uploadedFile = $request->file('center_stamp');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('center'), $fileName);
            $center_stamp = 'center/' . $fileName;
        }

        // Save Center Signature
        if ($request->hasFile('center_signature')) {
            $uploadedFile = $request->file('center_signature');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('center'), $fileName);
            $center_signature = 'center/' . $fileName;
        }

        // Save Director Aadhar
        if ($request->hasFile('director_adhar')) {
            $uploadedFile = $request->file('director_adhar');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('center'), $fileName);
            $director_adhar = 'center/' . $fileName;
        }

        // Save Director PAN
        if ($request->hasFile('director_pan')) {
            $uploadedFile = $request->file('director_pan');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('center'), $fileName);
            $director_pan = 'center/' . $fileName;
        }

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

        // Upload new Center Photo
        if ($request->hasFile('photo')) {
            // delete old file if exists
            if ($photo && file_exists(public_path($photo))) {
                @unlink(public_path($photo));
            }

            $uploadedFile = $request->file('photo');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('center'), $fileName);
            $photo = 'center/' . $fileName;
        }

        // Upload new Center Stamp
        if ($request->hasFile('center_stamp')) {
            // delete old file if exists
            if ($center_stamp && file_exists(public_path($center_stamp))) {
                @unlink(public_path($center_stamp));
            }

            $uploadedFile = $request->file('center_stamp');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('center'), $fileName);
            $center_stamp = 'center/' . $fileName;
        }

        // Upload new Center Signature
        if ($request->hasFile('center_signature')) {
            // delete old file if exists
            if ($center_signature && file_exists(public_path($center_signature))) {
                @unlink(public_path($center_signature));
            }

            $uploadedFile = $request->file('center_signature');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('center'), $fileName);
            $center_signature = 'center/' . $fileName;
        }

        // Upload Director Aadhar
        if ($request->hasFile('director_adhar')) {
            // delete old file if exists
            if ($director_adhar && file_exists(public_path($director_adhar))) {
                @unlink(public_path($director_adhar));
            }

            $uploadedFile = $request->file('director_adhar');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('center'), $fileName);
            $director_adhar = 'center/' . $fileName;
        }

        // Upload Director PAN
        if ($request->hasFile('director_pan')) {
            // delete old file if exists
            if ($director_pan && file_exists(public_path($director_pan))) {
                @unlink(public_path($director_pan));
            }

            $uploadedFile = $request->file('director_pan');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('center'), $fileName);
            $director_pan = 'center/' . $fileName;
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
