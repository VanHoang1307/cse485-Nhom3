<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\RankingResult;
use Illuminate\Http\Request;

class RankingResultController extends Controller
{
    /**
     * Danh sách kết quả xếp hạng
     */
    public function index()
    {
        $results = RankingResult::with([
            'application.student',
            'application.scholarshipProgram',
        ])
            ->orderBy('ranking')
            ->paginate(10);

        return view(
            'ranking_results.index',
            compact('results')
        );
    }

    /**
     * Form tạo kết quả xếp hạng
     */
    public function create()
    {
        $applications = Application::with([
            'student',
            'scholarshipProgram',
            'evaluationScores.criterion',
            'evaluationScores.committee',
        ])
            ->latest()
            ->get();

        return view(
            'ranking_results.create',
            compact('applications')
        );
    }

    /**
     * Lưu kết quả xếp hạng
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'application_id' => [
                'required',
                'integer',
                'exists:applications,id',
                'unique:ranking_results,application_id',
            ],
        ], [
            'application_id.required' =>
                'Vui lòng chọn hồ sơ.',

            'application_id.exists' =>
                'Hồ sơ không tồn tại.',

            'application_id.unique' =>
                'Hồ sơ này đã có kết quả xếp hạng.',
        ]);

        $application = Application::with([
            'evaluationScores.criterion',
            'evaluationScores.committee',
        ])->findOrFail(
            $validated['application_id']
        );

        /*
         * Hồ sơ phải có ít nhất một điểm đánh giá
         */
        if ($application->evaluationScores->isEmpty()) {
            return back()
                ->withInput()
                ->withErrors([
                    'application_id' =>
                        'Hồ sơ này chưa có điểm đánh giá. Vui lòng chấm điểm trước khi xếp hạng.',
                ]);
        }

        /*
         * Tính tổng điểm tự động
         */
        $totalScore = $this->calculateTotalScore($application);

        /*
         * Tạo kết quả xếp hạng
         */
        RankingResult::create([
            'application_id' => $application->id,
            'total_score' => $totalScore,
            'ranking' => 0,
            'result' => 'Not Qualified',
        ]);

        /*
         * Tính lại thứ hạng toàn bộ hồ sơ
         */
        $this->recalculateRankings();

        return redirect()
            ->route('ranking-results.index')
            ->with(
                'success',
                'Tạo kết quả xếp hạng thành công!'
            );
    }

    /**
     * Tính tổng điểm theo trọng số tiêu chí
     *
     * Nếu một tiêu chí có nhiều hội đồng cùng chấm,
     * hệ thống lấy điểm trung bình của các hội đồng.
     */
    private function calculateTotalScore(
        Application $application
    ): float {
        $totalScore = 0;

        /*
         * Chỉ lấy các điểm có tiêu chí hợp lệ
         */
        $scoresByCriterion = $application
            ->evaluationScores
            ->filter(function ($evaluationScore) {
                return $evaluationScore->criterion !== null;
            })
            ->groupBy('criterion_id');

        foreach ($scoresByCriterion as $scores) {

            $criterion = $scores->first()->criterion;

            $maxScore = (float) $criterion->max_score;
            $weight = (float) $criterion->weight;

            /*
             * Bỏ qua tiêu chí không có điểm tối đa
             */
            if ($maxScore <= 0) {
                continue;
            }

            /*
             * Tính điểm trung bình của các hội đồng
             */
            $averageScore = $scores->avg(function ($evaluationScore) {
                return (float) $evaluationScore->score;
            });

            /*
             * Chuẩn hóa điểm:
             *
             * Điểm / Điểm tối đa * Trọng số
             */
            $convertedScore =
                ($averageScore / $maxScore) * $weight;

            $totalScore += $convertedScore;
        }

        return round($totalScore, 2);
    }

    /**
     * Tính lại thứ hạng toàn bộ kết quả
     */
    private function recalculateRankings(): void
    {
        $results = RankingResult::orderByDesc('total_score')
            ->orderBy('id')
            ->get();

        foreach ($results as $index => $result) {

            $ranking = $index + 1;

            $result->update([
                'ranking' => $ranking,

                'result' => $ranking <= 10
                    ? 'Qualified'
                    : 'Not Qualified',
            ]);
        }
    }

    /**
     * Xem chi tiết kết quả
     */
    public function show(RankingResult $rankingResult)
    {
        $rankingResult->load([
            'application.student',
            'application.scholarshipProgram',
            'application.evaluationScores.criterion',
            'application.evaluationScores.committee',
        ]);

        return view(
            'ranking_results.show',
            compact('rankingResult')
        );
    }

    /**
     * Form sửa kết quả
     */
    public function edit(RankingResult $rankingResult)
    {
        $rankingResult->load([
            'application.student',
            'application.scholarshipProgram',
            'application.evaluationScores.criterion',
            'application.evaluationScores.committee',
        ]);

        return view(
            'ranking_results.edit',
            compact('rankingResult')
        );
    }

    /**
     * Cập nhật kết quả xếp hạng
     */
    public function update(
        Request $request,
        RankingResult $rankingResult
    ) {
        $validated = $request->validate([
            'application_id' => [
                'required',
                'integer',
                'exists:applications,id',
                'unique:ranking_results,application_id,' . $rankingResult->id,
            ],
        ], [
            'application_id.required' =>
                'Vui lòng chọn hồ sơ.',

            'application_id.exists' =>
                'Hồ sơ không tồn tại.',

            'application_id.unique' =>
                'Hồ sơ này đã có kết quả xếp hạng.',
        ]);

        $application = Application::with([
            'evaluationScores.criterion',
            'evaluationScores.committee',
        ])->findOrFail(
            $validated['application_id']
        );

        /*
         * Hồ sơ phải có điểm đánh giá
         */
        if ($application->evaluationScores->isEmpty()) {
            return back()
                ->withInput()
                ->withErrors([
                    'application_id' =>
                        'Hồ sơ này chưa có điểm đánh giá. Vui lòng chấm điểm trước khi xếp hạng.',
                ]);
        }

        /*
         * Tính lại tổng điểm
         */
        $totalScore = $this->calculateTotalScore($application);

        /*
         * Cập nhật kết quả
         */
        $rankingResult->update([
            'application_id' => $application->id,
            'total_score' => $totalScore,
        ]);

        /*
         * Tính lại thứ hạng
         */
        $this->recalculateRankings();

        return redirect()
            ->route('ranking-results.index')
            ->with(
                'success',
                'Cập nhật kết quả xếp hạng thành công!'
            );
    }

    /**
     * Xóa kết quả xếp hạng
     */
    public function destroy(
        RankingResult $rankingResult
    ) {
        $rankingResult->delete();

        /*
         * Tính lại thứ hạng sau khi xóa
         */
        $this->recalculateRankings();

        return redirect()
            ->route('ranking-results.index')
            ->with(
                'success',
                'Xóa kết quả xếp hạng thành công!'
            );
    }
}