<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Hiển thị danh sách sinh viên
    public function index()
    {
        $students = Student::orderBy('id', 'desc')->get();

        return view('students.index', compact('students'));
    }

    // Hiển thị form thêm sinh viên
    public function create()
    {
        return view('students.create');
    }

    // Lưu sinh viên
    public function store(Request $request)
    {
        $request->validate([
            'student_code' => 'required|unique:students',
            'full_name' => 'required',
            'gender' => 'required',
            'faculty' => 'required',
            'major' => 'required',
            'class' => 'required',
            'email' => 'required|email|unique:students',
            'gpa' => 'required|numeric|min:0|max:4',
            'training_score' => 'required|numeric|min:0|max:100',
        ]);

        Student::create($request->all());

        return redirect()
                ->route('students.index')
                ->with('success','Thêm sinh viên thành công!');
    }
}
