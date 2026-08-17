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
     * Danh sách điểm
     */
    public function index()
    {
        $scores = EvaluationScore::with([
            'application',
            'criterion',
            'committee',
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
        $applications = Application::orderBy(
            'id',
            'desc'
        )->get();

        $criteria = ScoringCriterion::orderBy(
            'id'
        )->get();

        $committees = EvaluationCommittee::orderBy(
            'id'
        )->get();

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
     * Lưu điểm
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'application_id' => [
                'required',
                'exists:applications,id',
            ],

            'criterion_id' => [
                'required',
                'exists:scoring_criteria,id',
            ],

            'committee_id' => [
                'required',
                'exists:evaluation_committees,id',
            ],

            'score' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],

            'comment' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'application_id.required' =>
                'Vui lòng chọn hồ sơ.',

            'criterion_id.required' =>
                'Vui lòng chọn tiêu chí.',

            'committee_id.required' =>
                'Vui lòng chọn hội đồng.',

            'score.required' =>
                'Vui lòng nhập điểm.',

            'score.numeric' =>
                'Điểm phải là số.',

            'score.min' =>
                'Điểm không được nhỏ hơn 0.',

            'score.max' =>
                'Điểm không được lớn hơn 100.',
        ]);

        EvaluationScore::create($validated);

        return redirect()
            ->route('evaluation_scores.index')
            ->with(
                'success',
                'Thêm điểm đánh giá thành công!'
            );
    }

    /**
     * Xem điểm
     */
    public function show(
        EvaluationScore $evaluationScore
    ) {
        $evaluationScore->load([
            'application',
            'criterion',
            'committee',
        ]);

        return view(
            'evaluation_scores.show',
            compact('evaluationScore')
        );
    }

    /**
     * Form sửa điểm
     */
    public function edit(
        EvaluationScore $evaluationScore
    ) {
        $applications = Application::orderBy(
            'id',
            'desc'
        )->get();

        $criteria = ScoringCriterion::orderBy(
            'id'
        )->get();

        $committees = EvaluationCommittee::orderBy(
            'id'
        )->get();

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
                'exists:applications,id',
            ],

            'criterion_id' => [
                'required',
                'exists:scoring_criteria,id',
            ],

            'committee_id' => [
                'required',
                'exists:evaluation_committees,id',
            ],

            'score' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],

            'comment' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $evaluationScore->update($validated);

        return redirect()
            ->route('evaluation_scores.index')
            ->with(
                'success',
                'Cập nhật điểm thành công!'
            );
    }

    /**
     * Xóa điểm
     */
    public function destroy(
        EvaluationScore $evaluationScore
    ) {
        $evaluationScore->delete();

        return redirect()
            ->route('evaluation_scores.index')
            ->with(
                'success',
                'Xóa điểm thành công!'
            );
    }
}