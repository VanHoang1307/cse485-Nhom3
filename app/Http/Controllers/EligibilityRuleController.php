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
        $scholarships = ScholarshipProgram::all();

        return view('eligibility_rules.create', compact('scholarships'));
    }

    /**
     * Lưu điều kiện mới
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        EligibilityRule::create($data);

        return redirect()
            ->route('eligibility-rules.index')
            ->with('success', 'Thêm điều kiện xét học bổng thành công');
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
        $rule = EligibilityRule::findOrFail($id);

        $scholarships = ScholarshipProgram::all();

        return view(
            'eligibility_rules.edit',
            compact('rule', 'scholarships')
        );
    }

    /**
     * Cập nhật điều kiện
     */
    public function update(Request $request, string $id)
    {
        $data = $this->validateData($request);

        $rule = EligibilityRule::findOrFail($id);

        $rule->update($data);

        return redirect()
            ->route('eligibility-rules.index')
            ->with('success', 'Cập nhật điều kiện thành công');
    }

    /**
     * Xóa điều kiện
     */
    public function destroy(string $id)
    {
        $rule = EligibilityRule::findOrFail($id);

        $rule->delete();

        return redirect()
            ->route('eligibility-rules.index')
            ->with('success', 'Xóa điều kiện thành công');
    }

    /**
     * Validate dữ liệu
     */
    private function validateData(Request $request)
    {
        return $request->validate([

            'scholarship_program_id' => [
                'required',
                'integer',
                'exists:scholarship_programs,id'
            ],

            'min_gpa' => [
                'required',
                'numeric',
                'min:0',
                'max:4'
            ],

            'min_credits' => [
                'required',
                'integer',
                'min:1'
            ],

            'allow_debt_subject' => [
                'required',
                'boolean'
            ],

            'note' => [
                'nullable',
                'string'
            ],

        ]);
    }
}