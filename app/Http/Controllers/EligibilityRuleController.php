<?php

namespace App\Http\Controllers;

use App\Models\EligibilityRule;
use App\Models\ScholarshipProgram;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

        // Hệ thống luôn không cho phép sinh viên nợ môn
        $data['allow_debt_subject'] = false;

        EligibilityRule::create($data);

        return redirect()
            ->route('eligibility-rules.index')
            ->with('success', 'Thêm điều kiện xét học bổng thành công.');
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

        return view('eligibility_rules.edit', compact('rule'));
    }

    /**
     * Cập nhật điều kiện
     */
    public function update(Request $request, string $id)
    {
        $rule = EligibilityRule::findOrFail($id);

        $data = $this->validateData($request, $rule->id);

        // Luôn đảm bảo không cho phép nợ môn
        $data['allow_debt_subject'] = false;

        $rule->update($data);

        return redirect()
            ->route('scholarships.show', $rule->scholarship_program_id)
            ->with('success', 'Cập nhật điều kiện xét học bổng thành công.');
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
            ->with('success', 'Xóa điều kiện xét học bổng thành công.');
    }

    /**
     * Validate dữ liệu
     */
    private function validateData(Request $request, $ruleId = null)
    {
        return $request->validate([
            'scholarship_program_id' => [
                'required',
                'integer',
                'exists:scholarship_programs,id',
                Rule::unique('eligibility_rules', 'scholarship_program_id')
                    ->ignore($ruleId),
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
            'scholarship_program_id.unique' =>
                'Chương trình học bổng này đã có điều kiện xét duyệt.',
        ]);
    }
}