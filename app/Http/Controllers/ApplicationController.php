<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Student;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    // Danh sách hồ sơ
    public function index()
    {
        $applications = Application::with('student')
                            ->orderBy('id', 'desc')
                            ->get();

        return view('applications.index', compact('applications'));
    }

    // Form thêm hồ sơ
    public function create()
    {
        $students = Student::orderBy('full_name')->get();

        return view('applications.create', compact('students'));
    }

    // Lưu hồ sơ
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'scholarship_program_id' => 'required|integer',
            'application_code' => 'required|unique:applications',
            'apply_date' => 'required|date',
            'status' => 'required',
            'review_note' => 'nullable'
        ]);

        Application::create($request->all());

        return redirect()
            ->route('applications.index')
            ->with('success', 'Thêm hồ sơ thành công!');
    }
}