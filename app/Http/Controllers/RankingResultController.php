<?php

namespace App\Http\Controllers;

use App\Models\RankingResult;
use App\Models\Application;
use Illuminate\Http\Request;

class RankingResultController extends Controller
{
    /**
     * Danh sách kết quả xếp hạng
     */
    public function index()
    {
        $results = RankingResult::with('application')
            ->orderBy('rank')
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
            ->orderBy('id', 'desc')
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
            'application_id' => 'required|exists:applications,id',
            'total_score' => 'required|numeric|min:0|max:100',
        ]);

        // Kiểm tra hồ sơ đã có kết quả xếp hạng chưa
        $exists = RankingResult::where(
            'application_id',
            $validated['application_id']
        )->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'application_id' =>
                        'Hồ sơ này đã có kết quả xếp hạng.'
                ]);
        }

        // Tạo kết quả
        RankingResult::create([
            'application_id' => $validated['application_id'],
            'total_score' => $validated['total_score'],
            'rank' => 0,
        ]);

        // Cập nhật lại toàn bộ thứ hạng
        $this->recalculateRanks();

        return redirect()
            ->route('ranking_results.index')
            ->with(
                'success',
                'Đã thêm kết quả và cập nhật thứ hạng thành công.'
            );
    }

    /**
     * Xem chi tiết kết quả
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
     * Form sửa kết quả
     */
    public function edit(RankingResult $rankingResult)
    {
        $applications = Application::with('student')
            ->orderBy('id', 'desc')
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
     * Cập nhật kết quả
     */
    public function update(
        Request $request,
        RankingResult $rankingResult
    ) {
        $validated = $request->validate([
            'application_id' =>
                'required|exists:applications,id',

            'total_score' =>
                'required|numeric|min:0|max:100',
        ]);

        $exists = RankingResult::where(
            'application_id',
            $validated['application_id']
        )
            ->where(
                'id',
                '!=',
                $rankingResult->id
            )
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'application_id' =>
                        'Hồ sơ này đã có kết quả xếp hạng.'
                ]);
        }

        $rankingResult->update([
            'application_id' =>
                $validated['application_id'],

            'total_score' =>
                $validated['total_score'],
        ]);

        // Tính lại thứ hạng
        $this->recalculateRanks();

        return redirect()
            ->route('ranking_results.index')
            ->with(
                'success',
                'Đã cập nhật kết quả xếp hạng.'
            );
    }

    /**
     * Xóa kết quả
     */
    public function destroy(
        RankingResult $rankingResult
    ) {
        $rankingResult->delete();

        // Tính lại thứ hạng sau khi xóa
        $this->recalculateRanks();

        return redirect()
            ->route('ranking_results.index')
            ->with(
                'success',
                'Đã xóa kết quả xếp hạng.'
            );
    }

    /**
     * Tính lại thứ hạng
     *
     * Điểm cao hơn sẽ xếp hạng cao hơn.
     */
    private function recalculateRanks()
    {
        $results = RankingResult::orderByDesc(
            'total_score'
        )->get();

        $rank = 1;

        foreach ($results as $result) {
            $result->update([
                'rank' => $rank,
            ]);

            $rank++;
        }
    }
}