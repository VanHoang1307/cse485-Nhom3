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
            'evaluationCommittees',
            'applications'
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
     *
     * Chỉ cho phép xóa khi chưa có dữ liệu liên quan.
     */
    public function destroy(string $id)
    {
        $scholarship = ScholarshipProgram::withCount([
            'eligibilityRules',
            'scoringCriteria',
            'evaluationCommittees',
            'applications'
        ])->findOrFail($id);

        $hasRelatedData =
            $scholarship->eligibility_rules_count > 0 ||
            $scholarship->scoring_criteria_count > 0 ||
            $scholarship->evaluation_committees_count > 0 ||
            $scholarship->applications_count > 0;

        if ($hasRelatedData) {
            return redirect()
                ->route('scholarships.index')
                ->with(
                    'error',
                    'Không thể xóa học bổng vì đã có dữ liệu liên quan. Hãy đóng chương trình thay vì xóa.'
                );
        }

        $scholarship->delete();

        return redirect()
            ->route('scholarships.index')
            ->with(
                'success',
                'Xóa chương trình học bổng thành công.'
            );
    }

    /**
     * Đóng chương trình học bổng
     *
     * Không xóa dữ liệu lịch sử.
     */
    public function close(string $id)
    {
        $scholarship = ScholarshipProgram::findOrFail($id);

        if ($scholarship->status === 'closed') {
            return redirect()
                ->route('scholarships.index')
                ->with(
                    'error',
                    'Chương trình học bổng này đã được đóng.'
                );
        }

        $scholarship->update([
            'status' => 'closed'
        ]);

        return redirect()
            ->route('scholarships.index')
            ->with(
                'success',
                'Đã đóng chương trình học bổng thành công.'
            );
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
        ], [
            'name.required' => 'Vui lòng nhập tên chương trình học bổng.',
            'name.string' => 'Tên chương trình phải là chuỗi ký tự.',
            'name.max' => 'Tên chương trình không được vượt quá 255 ký tự.',

            'amount.required' => 'Vui lòng nhập số tiền học bổng.',
            'amount.numeric' => 'Số tiền phải là số.',
            'amount.min' => 'Số tiền học bổng không được nhỏ hơn 0.',

            'academic_year.required' => 'Vui lòng nhập năm học.',
            'academic_year.max' => 'Năm học không được vượt quá 20 ký tự.',

            'semester.required' => 'Vui lòng chọn học kỳ.',
            'semester.integer' => 'Học kỳ phải là số.',
            'semester.between' => 'Học kỳ chỉ được chọn 1 hoặc 2.',

            'start_date.required' => 'Vui lòng chọn ngày bắt đầu.',
            'start_date.date' => 'Ngày bắt đầu không hợp lệ.',

            'end_date.required' => 'Vui lòng chọn ngày kết thúc.',
            'end_date.date' => 'Ngày kết thúc không hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',

            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ]);
    }
}

