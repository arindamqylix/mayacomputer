<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\DocumentType;

class DocumentTypeController extends Controller
{
    public function index()
    {
        $types = DocumentType::orderBy('dt_id', 'desc')->get();
        return view('admin.document_settings.index', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dt_name' => 'required|string|max:255',
            'dt_amount' => 'required|numeric|min:0',
        ]);

        DocumentType::create([
            'dt_name' => $request->dt_name,
            'dt_amount' => $request->dt_amount,
            'dt_status' => 'ACTIVE'
        ]);

        return redirect()->back()->with('success', 'Document Type Added Successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dt_name' => 'required|string|max:255',
            'dt_amount' => 'required|numeric|min:0',
            'dt_status' => 'required|in:ACTIVE,INACTIVE'
        ]);

        $type = DocumentType::findOrFail($id);
        $type->update($request->all());

        return redirect()->back()->with('success', 'Document Type Updated Successfully');
    }

    public function destroy($id)
    {
        $type = DocumentType::findOrFail($id);
        $type->delete();

        return redirect()->back()->with('success', 'Document Type Deleted Successfully');
    }
}
