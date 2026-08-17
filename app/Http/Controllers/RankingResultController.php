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
        $results = RankingResult::with('application')
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
        $applications = Application::with('student')
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
                'exists:applications,id',
                'unique:ranking_results,application_id'
            ],

            'total_score' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
        ], [
            'application_id.required' => 'Vui lòng chọn hồ sơ.',

            'application_id.exists' => 'Hồ sơ không tồn tại.',

            'application_id.unique' => 'Hồ sơ này đã có kết quả xếp hạng.',

            'total_score.required' => 'Vui lòng nhập tổng điểm.',

            'total_score.numeric' => 'Tổng điểm phải là số.',

            'total_score.min' => 'Tổng điểm không được nhỏ hơn 0.',

            'total_score.max' => 'Tổng điểm không được lớn hơn 100.',
        ]);

        /*
         * Tạm thời để ranking = 0.
         * Sau khi thêm bản ghi sẽ tính lại toàn bộ.
         */
        $validated['ranking'] = 0;
        $validated['result'] = 'Not Qualified';

        RankingResult::create($validated);

        /*
         * Tính lại thứ hạng cho toàn bộ kết quả.
         */
        $this->recalculateRankings();

        return redirect()
            ->route('ranking-results.index')
            ->with(
                'success',
                'Thêm kết quả xếp hạng thành công!'
            );
    }

    /**
     * Tính lại toàn bộ thứ hạng
     */
    private function recalculateRankings()
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
     * Xem chi tiết
     */
    public function show(RankingResult $rankingResult)
    {
        $rankingResult->load([
            'application.student'
        ]);

        return view(
            'ranking_results.show',
            compact('rankingResult')
        );
    }

    /**
     * Form sửa
     */
    public function edit(RankingResult $rankingResult)
    {
        $applications = Application::with('student')
            ->latest()
            ->get();

        return view(
            'ranking_results.edit',
            compact(
                'rankingResult',
                'applications'
            )
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
                'exists:applications,id',
                'unique:ranking_results,application_id,' . $rankingResult->id
            ],

            'total_score' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
        ], [
            'application_id.required' => 'Vui lòng chọn hồ sơ.',

            'application_id.exists' => 'Hồ sơ không tồn tại.',

            'application_id.unique' => 'Hồ sơ này đã có kết quả xếp hạng.',

            'total_score.required' => 'Vui lòng nhập tổng điểm.',

            'total_score.numeric' => 'Tổng điểm phải là số.',

            'total_score.min' => 'Tổng điểm không được nhỏ hơn 0.',

            'total_score.max' => 'Tổng điểm không được lớn hơn 100.',
        ]);

        $rankingResult->update($validated);

        /*
         * Sau khi sửa điểm,
         * tính lại toàn bộ thứ hạng.
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
         * Sau khi xóa,
         * tính lại thứ hạng.
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