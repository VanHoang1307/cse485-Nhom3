<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ScholarshipProgram;
use App\Models\Student;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Danh sách hồ sơ
     */
    public function index()
    {
        $applications = Application::with([
            'student',
            'scholarshipProgram'
        ])
            ->latest()
            ->get();

        return view(
            'applications.index',
            compact('applications')
        );
    }

    /**
     * Chi tiết hồ sơ
     */
    public function show(Application $application)
    {
        $application->load([
            'student',
            'scholarshipProgram',
            'documents',
            'evaluationScores',
            'rankingResult'
        ]);

        return view(
            'applications.show',
            compact('application')
        );
    }

    /**
     * Form thêm hồ sơ
     */
    public function create()
    {
        $students = Student::orderBy('full_name')->get();

        $scholarships = ScholarshipProgram::where(
            'status',
            'active'
        )
            ->orderBy('name')
            ->get();

        return view(
            'applications.create',
            compact(
                'students',
                'scholarships'
            )
        );
    }

    /**
     * Lưu hồ sơ
     */
    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        Application::create($validated);

        return redirect()
            ->route('applications.index')
            ->with(
                'success',
                'Thêm hồ sơ học bổng thành công!'
            );
    }

    /**
     * Form sửa hồ sơ
     */
    public function edit(Application $application)
    {
        $students = Student::orderBy('full_name')->get();

        $scholarships = ScholarshipProgram::orderBy('name')
            ->get();

        return view(
            'applications.edit',
            compact(
                'application',
                'students',
                'scholarships'
            )
        );
    }

    /**
     * Cập nhật hồ sơ
     */
    public function update(
        Request $request,
        Application $application
    ) {
        $validated = $this->validateData(
            $request,
            $application->id
        );

        $application->update($validated);

        return redirect()
            ->route('applications.index')
            ->with(
                'success',
                'Cập nhật hồ sơ thành công!'
            );
    }

    /**
     * Xóa hồ sơ
     */
    public function destroy(Application $application)
    {
        $application->loadCount([
            'documents',
            'evaluationScores'
        ]);

        $hasRankingResult = $application
            ->rankingResult()
            ->exists();

        if (
            $application->documents_count > 0 ||
            $application->evaluation_scores_count > 0 ||
            $hasRankingResult
        ) {
            return redirect()
                ->route('applications.index')
                ->with(
                    'error',
                    'Không thể xóa hồ sơ vì đã có minh chứng, điểm đánh giá hoặc kết quả xếp hạng liên quan.'
                );
        }

        $application->delete();

        return redirect()
            ->route('applications.index')
            ->with(
                'success',
                'Xóa hồ sơ thành công!'
            );
    }

    /**
     * Validation dùng chung cho Store và Update
     */
    private function validateData(
        Request $request,
        ?int $applicationId = null
    ) {
        /*
         * Chuẩn hóa trạng thái về chữ thường.
         *
         * Form có thể gửi:
         * Pending
         * Approved
         * Rejected
         *
         * Database sẽ lưu:
         * pending
         * approved
         * rejected
         */
        if ($request->has('status')) {
            $request->merge([
                'status' => strtolower(
                    trim($request->input('status'))
                )
            ]);
        }

        return $request->validate([
            'student_id' => [
                'required',
                'integer',
                'exists:students,id'
            ],

            'scholarship_program_id' => [
                'required',
                'integer',
                'exists:scholarship_programs,id'
            ],

            'application_code' => [
                'required',
                'string',
                'max:50',
                'unique:applications,application_code,' .
                    $applicationId
            ],

            'apply_date' => [
                'required',
                'date'
            ],

            'status' => [
                'required',
                'in:pending,approved,rejected'
            ],

            'review_note' => [
                'nullable',
                'string',
                'max:1000'
            ],
        ], [
            'student_id.required' =>
                'Vui lòng chọn sinh viên.',

            'student_id.exists' =>
                'Sinh viên không tồn tại.',

            'scholarship_program_id.required' =>
                'Vui lòng chọn chương trình học bổng.',

            'scholarship_program_id.exists' =>
                'Chương trình học bổng không tồn tại.',

            'application_code.required' =>
                'Vui lòng nhập mã hồ sơ.',

            'application_code.unique' =>
                'Mã hồ sơ đã tồn tại.',

            'apply_date.required' =>
                'Vui lòng chọn ngày nộp hồ sơ.',

            'apply_date.date' =>
                'Ngày nộp hồ sơ không hợp lệ.',

            'status.required' =>
                'Vui lòng chọn trạng thái hồ sơ.',

            'status.in' =>
                'Trạng thái hồ sơ không hợp lệ.',

            'review_note.max' =>
                'Ghi chú không được vượt quá 1000 ký tự.',
        ]);
    }
}