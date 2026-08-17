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
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }
    public function update(Request $request, Student $student)
    {
    $request->validate([

        'student_code' => 'required|unique:students,student_code,' . $student->id,

        'full_name' => 'required',

        'gender' => 'required',

        'faculty' => 'required',

        'major' => 'required',

        'class' => 'required',

        'email' => 'required|email|unique:students,email,' . $student->id,

        'gpa' => 'required|numeric|min:0|max:4',

        'training_score' => 'required|numeric|min:0|max:100',

        'status' => 'required'

    ]);

    $student->update($request->all());

    return redirect()
        ->route('students.index')
        ->with('success', 'Cập nhật sinh viên thành công!');
    }
    public function destroy(Student $student)
    {
    $student->delete();

    return redirect()
        ->route('students.index')
        ->with('success', 'Xóa sinh viên thành công!');
    }
}
