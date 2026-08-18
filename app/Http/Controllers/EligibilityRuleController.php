<?php

namespace App\Http\Controllers;

use App\Models\EligibilityRule;
use App\Models\ScholarshipProgram;
use Illuminate\Http\Request;

class EligibilityRuleController extends Controller
{
    /**
     * Hiển thị danh sách điều kiện xét học bổng
     */
    public function index()
    {
        $rules = EligibilityRule::with('scholarshipProgram')
            ->latest()
            ->get();

        return view('eligibility_rules.index', compact('rules'));
    }

    /**
     * Hiển thị form thêm điều kiện
     */
    public function create()
    {
        $scholarshipPrograms = ScholarshipProgram::latest()->get();

        return view(
            'eligibility_rules.create',
            compact('scholarshipPrograms')
        );
    }

    /**
     * Lưu điều kiện mới
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        // Hệ thống không cho phép sinh viên nợ môn
        $data['allow_debt_subject'] = false;

        EligibilityRule::create($data);

        return redirect()
            ->route('eligibility-rules.index')
            ->with(
                'success',
                'Thêm điều kiện xét học bổng thành công.'
            );
    }

    /**
     * Hiển thị chi tiết điều kiện
     */
    public function show(string $id)
    {
        $rule = EligibilityRule::with('scholarshipProgram')
            ->findOrFail($id);

        return view('eligibility_rules.show', compact('rule'));
    }

    /**
     * Hiển thị form chỉnh sửa
     */
    public function edit(string $id)
    {
        $rule = EligibilityRule::with('scholarshipProgram')
            ->findOrFail($id);

        $scholarshipPrograms = ScholarshipProgram::latest()->get();

        return view(
            'eligibility_rules.edit',
            compact('rule', 'scholarshipPrograms')
        );
    }

    /**
     * Cập nhật điều kiện
     */
    public function update(Request $request, string $id)
    {
        $rule = EligibilityRule::findOrFail($id);

        $data = $this->validateData($request);

        // Luôn đảm bảo không cho phép nợ môn
        $data['allow_debt_subject'] = false;

        $rule->update($data);

        return redirect()
            ->route(
                'scholarships.show',
                $rule->scholarship_program_id
            )
            ->with(
                'success',
                'Cập nhật điều kiện xét học bổng thành công.'
            );
    }

    /**
     * Xóa điều kiện
     */
    public function destroy(string $id)
    {
        $rule = EligibilityRule::findOrFail($id);

        $scholarshipId = $rule->scholarship_program_id;

        $rule->delete();

        return redirect()
            ->route('scholarships.show', $scholarshipId)
            ->with(
                'success',
                'Xóa điều kiện xét học bổng thành công.'
            );
    }

    /**
     * Validate dữ liệu
     *
     * Một chương trình học bổng có thể có nhiều điều kiện xét duyệt.
     */
    private function validateData(Request $request)
    {
        return $request->validate([
            'scholarship_program_id' => [
                'required',
                'integer',
                'exists:scholarship_programs,id',
            ],

            'min_gpa' => [
                'required',
                'numeric',
                'min:0',
                'max:4',
            ],

            'min_credits' => [
                'required',
                'integer',
                'min:1',
            ],

            'note' => [
                'nullable',
                'string',
            ],
        ], [
            'scholarship_program_id.required' =>
                'Vui lòng chọn chương trình học bổng.',

            'scholarship_program_id.integer' =>
                'Chương trình học bổng không hợp lệ.',

            'scholarship_program_id.exists' =>
                'Chương trình học bổng không tồn tại.',

            'min_gpa.required' =>
                'Vui lòng nhập GPA tối thiểu.',

            'min_gpa.numeric' =>
                'GPA tối thiểu phải là số.',

            'min_gpa.min' =>
                'GPA tối thiểu không được nhỏ hơn 0.',

            'min_gpa.max' =>
                'GPA tối thiểu không được lớn hơn 4.',

            'min_credits.required' =>
                'Vui lòng nhập số tín chỉ tối thiểu.',

            'min_credits.integer' =>
                'Số tín chỉ tối thiểu phải là số nguyên.',

            'min_credits.min' =>
                'Số tín chỉ tối thiểu phải lớn hơn hoặc bằng 1.',

            'note.string' =>
                'Ghi chú phải là chuỗi ký tự.',
        ]);
    }
}