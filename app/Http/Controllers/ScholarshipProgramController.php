<?php

namespace App\Http\Controllers;

use App\Models\ScholarshipProgram;
use Illuminate\Http\Request;

class ScholarshipProgramController extends Controller
{
    /**
     * Hiển thị danh sách học bổng
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $scholarships = ScholarshipProgram::when($keyword, function ($query) use ($keyword) {

                $query->where('name', 'like', '%' . $keyword . '%');

            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('scholarships.index', compact(
            'scholarships',
            'keyword'
        ));
    }

    /**
     * Hiển thị form thêm mới
     */
    public function create()
    {
        return view('scholarships.create');
    }

    /**
     * Lưu học bổng mới
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        ScholarshipProgram::create($data);

        return redirect()
            ->route('scholarships.index')
            ->with('success', 'Thêm chương trình học bổng thành công.');
    }

    /**
     * Hiển thị chi tiết học bổng
     */
    public function show(string $id)
    {
        $scholarship = ScholarshipProgram::with([
            'eligibilityRules',
            'scoringCriteria',
            'evaluationCommittees'
        ])->findOrFail($id);

        return view('scholarships.show', compact('scholarship'));
    }

    /**
     * Hiển thị form chỉnh sửa
     */
    public function edit(string $id)
    {
        $scholarship = ScholarshipProgram::findOrFail($id);

        return view('scholarships.edit', compact('scholarship'));
    }

    /**
     * Cập nhật học bổng
     */
    public function update(Request $request, string $id)
    {
        $data = $this->validateData($request);

        $scholarship = ScholarshipProgram::findOrFail($id);

        $scholarship->update($data);

        return redirect()
            ->route('scholarships.index')
            ->with('success', 'Cập nhật chương trình học bổng thành công.');
    }

    /**
     * Xóa học bổng
     */
    public function destroy(string $id)
    {
        $scholarship = ScholarshipProgram::findOrFail($id);

        $scholarship->delete();

        return redirect()
            ->route('scholarships.index')
            ->with('success', 'Xóa chương trình học bổng thành công.');
    }

    /**
     * Validate dữ liệu
     */
    private function validateData(Request $request)
    {
        return $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0'
            ],

            'academic_year' => [
                'required',
                'string',
                'max:20'
            ],

            'semester' => [
                'required',
                'integer',
                'between:1,2'
            ],

            'start_date' => [
                'required',
                'date'
            ],

            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date'
            ],

            'status' => [
                'required',
                'in:draft,active,closed'
            ],

        ]);
    }
}