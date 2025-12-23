<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CourseSyllabus;
use App\Models\admin\Course;
use DB;
use File;

class SyllabusController extends Controller
{
    // List all course syllabus
    public function index()
    {
        $syllabus = DB::table('course_syllabus')
            ->join('course', 'course_syllabus.cs_FK_of_course_id', '=', 'course.c_id')
            ->select('course_syllabus.*', 'course.c_full_name', 'course.c_short_name')
            ->orderBy('course.c_full_name')
            ->orderBy('course_syllabus.cs_order')
            ->get();
        
        return view('admin.syllabus.index', compact('syllabus'));
    }

    // Show form to add syllabus
    public function create()
    {
        $courses = Course::all();
        return view('admin.syllabus.create', compact('courses'));
    }

    // Store new syllabus
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|integer|exists:course,c_id',
            'type' => 'required|in:video,pdf',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required_if:type,video|nullable|url',
            'pdf_file' => 'required_if:type,pdf|nullable|file|mimes:pdf|max:10240',
            'order' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive'
        ]);

        $pdfFilePath = null;
        
        // Handle PDF file upload
        if ($request->type == 'pdf' && $request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('course_syllabus'), $filename);
            $pdfFilePath = 'course_syllabus/' . $filename;
        }

        // Extract YouTube video ID from URL if it's a full URL
        $videoUrl = $request->video_url;
        if ($request->type == 'video' && $videoUrl) {
            // Convert YouTube URLs to embed format
            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $videoUrl, $matches)) {
                $videoId = $matches[1];
                $videoUrl = 'https://www.youtube.com/embed/' . $videoId;
            }
        }

        $syllabus = CourseSyllabus::create([
            'cs_FK_of_course_id' => $request->course_id,
            'cs_type' => $request->type,
            'cs_title' => $request->title,
            'cs_description' => $request->description,
            'cs_video_url' => $request->type == 'video' ? $videoUrl : null,
            'cs_pdf_file' => $pdfFilePath,
            'cs_order' => $request->order ?? 0,
            'cs_status' => $request->status
        ]);

        if ($syllabus) {
            return redirect()->route('admin.syllabus.index')->with('success', 'Syllabus added successfully!');
        } else {
            return back()->with('error', 'Failed to add syllabus!');
        }
    }

    // Show edit form
    public function edit($id)
    {
        $syllabus = CourseSyllabus::findOrFail($id);
        $courses = Course::all();
        return view('admin.syllabus.edit', compact('syllabus', 'courses'));
    }

    // Update syllabus
    public function update(Request $request, $id)
    {
        $syllabus = CourseSyllabus::findOrFail($id);
        
        $request->validate([
            'course_id' => 'required|integer|exists:course,c_id',
            'type' => 'required|in:video,pdf',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => ($request->type == 'video' && !$syllabus->cs_video_url) ? 'required|url' : 'nullable|url',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'order' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive'
        ]);

        $pdfFilePath = $syllabus->cs_pdf_file;

        // Handle PDF file upload
        if ($request->type == 'pdf' && $request->hasFile('pdf_file')) {
            // Delete old PDF if exists
            if ($syllabus->cs_pdf_file && File::exists(public_path($syllabus->cs_pdf_file))) {
                File::delete(public_path($syllabus->cs_pdf_file));
            }
            
            $file = $request->file('pdf_file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('course_syllabus'), $filename);
            $pdfFilePath = 'course_syllabus/' . $filename;
        }

        // Extract YouTube video ID from URL if it's a full URL
        $videoUrl = $request->video_url;
        if ($request->type == 'video' && $videoUrl) {
            // Convert YouTube URLs to embed format
            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $videoUrl, $matches)) {
                $videoId = $matches[1];
                $videoUrl = 'https://www.youtube.com/embed/' . $videoId;
            }
        }

        $update = $syllabus->update([
            'cs_FK_of_course_id' => $request->course_id,
            'cs_type' => $request->type,
            'cs_title' => $request->title,
            'cs_description' => $request->description,
            'cs_video_url' => $request->type == 'video' ? $videoUrl : null,
            'cs_pdf_file' => $request->type == 'pdf' ? $pdfFilePath : null,
            'cs_order' => $request->order ?? 0,
            'cs_status' => $request->status
        ]);

        if ($update) {
            return redirect()->route('admin.syllabus.index')->with('success', 'Syllabus updated successfully!');
        } else {
            return back()->with('error', 'Failed to update syllabus!');
        }
    }

    // Delete syllabus
    public function destroy($id)
    {
        $syllabus = CourseSyllabus::findOrFail($id);
        
        // Delete PDF file if exists
        if ($syllabus->cs_pdf_file && File::exists(public_path($syllabus->cs_pdf_file))) {
            File::delete(public_path($syllabus->cs_pdf_file));
        }
        
        $delete = $syllabus->delete();
        
        if ($delete) {
            return redirect()->route('admin.syllabus.index')->with('success', 'Syllabus deleted successfully!');
        } else {
            return back()->with('error', 'Failed to delete syllabus!');
        }
    }
}

