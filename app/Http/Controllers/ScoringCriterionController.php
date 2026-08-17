<?php

namespace App\Http\Controllers;

use App\Models\ScoringCriterion;
use App\Models\ScholarshipProgram;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ScoringCriterionController extends Controller
{
    public function index()
    {
        $criteria = ScoringCriterion::with('scholarshipProgram')
            ->latest()
            ->get();

        return view('scoring_criteria.index', compact('criteria'));
    }

    public function create()
    {
        $programs = ScholarshipProgram::all();

        return view('scoring_criteria.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        ScoringCriterion::create($data);

        return redirect()
            ->route('scoring-criteria.index')
            ->with('success', 'Thêm tiêu chí chấm điểm thành công.');
    }

    public function show(ScoringCriterion $scoringCriterion)
    {
        $scoringCriterion->load('scholarshipProgram');

        return view(
            'scoring_criteria.show',
            compact('scoringCriterion')
        );
    }

    public function edit(ScoringCriterion $scoringCriterion)
    {
        $programs = ScholarshipProgram::all();

        return view(
            'scoring_criteria.edit',
            compact('scoringCriterion', 'programs')
        );
    }

    public function update(
        Request $request,
        ScoringCriterion $scoringCriterion
    ) {
        $data = $this->validateData(
            $request,
            $scoringCriterion->id
        );

        $scoringCriterion->update($data);

        return redirect()
            ->route('scoring-criteria.index')
            ->with('success', 'Cập nhật tiêu chí chấm điểm thành công.');
    }

    public function destroy(ScoringCriterion $scoringCriterion)
    {
        $scoringCriterion->delete();

        return redirect()
            ->route('scoring-criteria.index')
            ->with('success', 'Xóa tiêu chí chấm điểm thành công.');
    }

    private function validateData(Request $request, $criterionId = null)
    {
        return $request->validate([
            'scholarship_program_id' => [
                'required',
                'integer',
                'exists:scholarship_programs,id',
            ],

            'criteria_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('scoring_criteria', 'criteria_name')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'scholarship_program_id',
                            $request->scholarship_program_id
                        );
                    })
                    ->ignore($criterionId),
            ],

            'max_score' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],

            'weight' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],

            'description' => [
                'nullable',
                'string',
            ],
        ], [
            'criteria_name.unique' =>
                'Tiêu chí này đã tồn tại trong chương trình học bổng đã chọn.',
        ]);
    }
}