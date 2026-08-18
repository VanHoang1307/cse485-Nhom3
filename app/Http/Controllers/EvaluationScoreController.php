<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\EvaluationCommittee;
use App\Models\EvaluationScore;
use App\Models\ScoringCriterion;
use Illuminate\Http\Request;

class EvaluationScoreController extends Controller
{
    /**
     * Danh sách điểm đánh giá
     */
    public function index()
    {
        $scores = EvaluationScore::with([
            'application.student',
            'application.scholarshipProgram',
            'criterion',
            'committee'
        ])
            ->latest()
            ->paginate(10);

        return view(
            'evaluation_scores.index',
            compact('scores')
        );
    }

    /**
     * Form thêm điểm
     */
    public function create()
    {
        $applications = Application::with([
            'student',
            'scholarshipProgram'
        ])
            ->latest()
            ->get();

        $criteria = ScoringCriterion::with('scholarshipProgram')
            ->latest()
            ->get();

        $committees = EvaluationCommittee::with('scholarshipProgram')
            ->latest()
            ->get();

        return view(
            'evaluation_scores.create',
            compact(
                'applications',
                'criteria',
                'committees'
            )
        );
    }

    /**
     * Lấy tiêu chí và hội đồng theo hồ sơ
     */
    public function getApplicationData(Application $application)
    {
        $criteria = ScoringCriterion::where(
            'scholarship_program_id',
            $application->scholarship_program_id
        )
            ->orderBy('id')
            ->get([
                'id',
                'criteria_name',
                'max_score',
                'weight'
            ]);

        $committees = EvaluationCommittee::where(
            'scholarship_program_id',
            $application->scholarship_program_id
        )
            ->orderBy('id')
            ->get([
                'id',
                'committee_name',
                'chairman',
                'status'
            ]);

        return response()->json([
            'program' => $application->scholarshipProgram
                ? $application->scholarshipProgram->name
                : null,

            'criteria' => $criteria,

            'committees' => $committees,
        ]);
    }

    /**
     * Lưu điểm
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'application_id' => [
                'required',
                'integer',
                'exists:applications,id',
            ],

            'criterion_id' => [
                'required',
                'integer',
                'exists:scoring_criteria,id',
            ],

            'committee_id' => [
                'required',
                'integer',
                'exists:evaluation_committees,id',
            ],

            'score' => [
                'required',
                'numeric',
                'min:0',
            ],

            'comment' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'application_id.required' =>
                'Vui lòng chọn hồ sơ.',

            'application_id.exists' =>
                'Hồ sơ không tồn tại.',

            'criterion_id.required' =>
                'Vui lòng chọn tiêu chí.',

            'criterion_id.exists' =>
                'Tiêu chí không tồn tại.',

            'committee_id.required' =>
                'Vui lòng chọn hội đồng.',

            'committee_id.exists' =>
                'Hội đồng không tồn tại.',

            'score.required' =>
                'Vui lòng nhập điểm.',

            'score.numeric' =>
                'Điểm phải là số.',

            'score.min' =>
                'Điểm không được nhỏ hơn 0.',

            'comment.max' =>
                'Nhận xét không được vượt quá 1000 ký tự.',
        ]);

        // Lấy hồ sơ
        $application = Application::findOrFail(
            $validated['application_id']
        );

        // Lấy tiêu chí
        $criterion = ScoringCriterion::findOrFail(
            $validated['criterion_id']
        );

        // Lấy hội đồng
        $committee = EvaluationCommittee::findOrFail(
            $validated['committee_id']
        );

        /*
         * Tiêu chí phải thuộc chương trình
         * học bổng của hồ sơ
         */
        if (
            $criterion->scholarship_program_id
            != $application->scholarship_program_id
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'criterion_id' =>
                        'Tiêu chí không thuộc chương trình học bổng của hồ sơ.'
                ]);
        }

        /*
         * Hội đồng phải thuộc chương trình
         * học bổng của hồ sơ
         */
        if (
            $committee->scholarship_program_id
            != $application->scholarship_program_id
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'committee_id' =>
                        'Hội đồng không thuộc chương trình học bổng của hồ sơ.'
                ]);
        }

        /*
         * Điểm không được vượt quá
         * điểm tối đa của tiêu chí
         */
        if (
            (float) $validated['score']
            > (float) $criterion->max_score
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'score' =>
                        'Điểm không được vượt quá '
                        . number_format(
                            (float) $criterion->max_score,
                            2
                        )
                        . ' điểm của tiêu chí này.'
                ]);
        }

        /*
         * Kiểm tra đã chấm tiêu chí này
         * cho hồ sơ bằng hội đồng này chưa
         */
        $exists = EvaluationScore::where(
            'application_id',
            $validated['application_id']
        )
            ->where(
                'criterion_id',
                $validated['criterion_id']
            )
            ->where(
                'committee_id',
                $validated['committee_id']
            )
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'application_id' =>
                        'Hồ sơ này đã được chấm với tiêu chí và hội đồng đã chọn.'
                ]);
        }

        // Lưu điểm
        EvaluationScore::create($validated);

        return redirect()
            ->route('evaluation-scores.index')
            ->with(
                'success',
                'Thêm điểm đánh giá thành công!'
            );
    }

    /**
     * Xem chi tiết
     */
    public function show(EvaluationScore $evaluationScore)
    {
        $evaluationScore->load([
            'application.student',
            'application.scholarshipProgram',
            'criterion.scholarshipProgram',
            'committee.scholarshipProgram'
        ]);

        return view(
            'evaluation_scores.show',
            compact('evaluationScore')
        );
    }

    /**
     * Form sửa điểm
     */
    public function edit(EvaluationScore $evaluationScore)
    {
        $applications = Application::with([
            'student',
            'scholarshipProgram'
        ])
            ->latest()
            ->get();

        $criteria = ScoringCriterion::with('scholarshipProgram')
            ->latest()
            ->get();

        $committees = EvaluationCommittee::with('scholarshipProgram')
            ->latest()
            ->get();

        return view(
            'evaluation_scores.edit',
            compact(
                'evaluationScore',
                'applications',
                'criteria',
                'committees'
            )
        );
    }

    /**
     * Cập nhật điểm
     */
    public function update(
        Request $request,
        EvaluationScore $evaluationScore
    ) {
        $validated = $request->validate([
            'application_id' => [
                'required',
                'integer',
                'exists:applications,id',
            ],

            'criterion_id' => [
                'required',
                'integer',
                'exists:scoring_criteria,id',
            ],

            'committee_id' => [
                'required',
                'integer',
                'exists:evaluation_committees,id',
            ],

            'score' => [
                'required',
                'numeric',
                'min:0',
            ],

            'comment' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'application_id.required' =>
                'Vui lòng chọn hồ sơ.',

            'application_id.exists' =>
                'Hồ sơ không tồn tại.',

            'criterion_id.required' =>
                'Vui lòng chọn tiêu chí.',

            'criterion_id.exists' =>
                'Tiêu chí không tồn tại.',

            'committee_id.required' =>
                'Vui lòng chọn hội đồng.',

            'committee_id.exists' =>
                'Hội đồng không tồn tại.',

            'score.required' =>
                'Vui lòng nhập điểm.',

            'score.numeric' =>
                'Điểm phải là số.',

            'score.min' =>
                'Điểm không được nhỏ hơn 0.',

            'comment.max' =>
                'Nhận xét không được vượt quá 1000 ký tự.',
        ]);

        // Lấy hồ sơ
        $application = Application::findOrFail(
            $validated['application_id']
        );

        // Lấy tiêu chí
        $criterion = ScoringCriterion::findOrFail(
            $validated['criterion_id']
        );

        // Lấy hội đồng
        $committee = EvaluationCommittee::findOrFail(
            $validated['committee_id']
        );

        /*
         * Tiêu chí phải thuộc chương trình
         * của hồ sơ
         */
        if (
            $criterion->scholarship_program_id
            != $application->scholarship_program_id
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'criterion_id' =>
                        'Tiêu chí không thuộc chương trình học bổng của hồ sơ.'
                ]);
        }

        /*
         * Hội đồng phải thuộc chương trình
         * của hồ sơ
         */
        if (
            $committee->scholarship_program_id
            != $application->scholarship_program_id
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'committee_id' =>
                        'Hội đồng không thuộc chương trình học bổng của hồ sơ.'
                ]);
        }

        /*
         * Điểm không được vượt quá
         * max_score của tiêu chí
         */
        if (
            (float) $validated['score']
            > (float) $criterion->max_score
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'score' =>
                        'Điểm không được vượt quá '
                        . number_format(
                            (float) $criterion->max_score,
                            2
                        )
                        . ' điểm của tiêu chí này.'
                ]);
        }

        /*
         * Không cho trùng hồ sơ + tiêu chí + hội đồng
         */
        $exists = EvaluationScore::where(
            'application_id',
            $validated['application_id']
        )
            ->where(
                'criterion_id',
                $validated['criterion_id']
            )
            ->where(
                'committee_id',
                $validated['committee_id']
            )
            ->where(
                'id',
                '!=',
                $evaluationScore->id
            )
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'application_id' =>
                        'Hồ sơ, tiêu chí và hội đồng này đã có điểm đánh giá.'
                ]);
        }

        // Cập nhật điểm
        $evaluationScore->update($validated);

        return redirect()
            ->route('evaluation-scores.index')
            ->with(
                'success',
                'Cập nhật điểm thành công!'
            );
    }

    /**
     * Xóa điểm
     */
    public function destroy(EvaluationScore $evaluationScore)
    {
        $evaluationScore->delete();

        return redirect()
            ->route('evaluation-scores.index')
            ->with(
                'success',
                'Xóa điểm thành công!'
            );
    }
}