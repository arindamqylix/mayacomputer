<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class WhatsAppTemplateController extends Controller
{
    public function index()
    {
        $templates = DB::table('whatsapp_templates')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.whatsapp_templates.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.whatsapp_templates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'template_name' => 'required|string|max:255|unique:whatsapp_templates,template_name',
            'message' => 'required|string',
            'variables' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $variables = null;
        if ($request->variables) {
            // Convert comma-separated variables to JSON array
            $varArray = array_map('trim', explode(',', $request->variables));
            $variables = json_encode($varArray);
        }

        DB::table('whatsapp_templates')->insert([
            'template_name' => $request->template_name,
            'message' => $request->message,
            'variables' => $variables,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.whatsapp_templates.index')->with('success', 'WhatsApp Template Created Successfully!');
    }

    public function edit($id)
    {
        $template = DB::table('whatsapp_templates')
            ->where('id', $id)
            ->first();

        if (!$template) {
            return redirect()->route('admin.whatsapp_templates.index')->with('error', 'Template not found');
        }

        // Decode variables from JSON to comma-separated string
        $variablesString = '';
        if ($template->variables) {
            $varArray = json_decode($template->variables, true);
            if (is_array($varArray)) {
                $variablesString = implode(', ', $varArray);
            }
        }

        return view('admin.whatsapp_templates.edit', compact('template', 'variablesString'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'template_name' => 'required|string|max:255|unique:whatsapp_templates,template_name,' . $id,
            'message' => 'required|string',
            'variables' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $variables = null;
        if ($request->variables) {
            // Convert comma-separated variables to JSON array
            $varArray = array_map('trim', explode(',', $request->variables));
            $variables = json_encode($varArray);
        }

        DB::table('whatsapp_templates')
            ->where('id', $id)
            ->update([
                'template_name' => $request->template_name,
                'message' => $request->message,
                'variables' => $variables,
                'status' => $request->status,
                'updated_at' => now(),
            ]);

        return redirect()->route('admin.whatsapp_templates.index')->with('success', 'WhatsApp Template Updated Successfully!');
    }

    public function destroy($id)
    {
        DB::table('whatsapp_templates')
            ->where('id', $id)
            ->delete();

        return redirect()->route('admin.whatsapp_templates.index')->with('success', 'WhatsApp Template Deleted Successfully!');
    }
}

