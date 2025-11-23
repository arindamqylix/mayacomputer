<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ContactRequestController extends Controller
{
    public function index()
    {
        $contacts  = DB::table('contact_requests')->latest()->paginate(20);
        return view('admin.cms.contact_requests.index', compact('contacts'));
    }

    // Frontend: store contact form
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        DB::table('contact_requests')->insert([
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'subject'    => $request->subject,
            'message'    => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Your request has been submitted successfully.');
    }

    // Admin: delete request
    public function destroy($id)
    {
        DB::table('contact_requests')->where('id', $id)->delete();
        return back()->with('success', 'Request deleted successfully.');
    }
}
